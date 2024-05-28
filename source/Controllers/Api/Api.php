<?php

namespace Source\Controllers\Api;

use Source\Core\Controller;
use Source\Models\Login;
use Source\Models\Schedule;


class Api extends Controller
{
    protected $user;
    protected $headers;
    protected $response;

    public function __construct()
    {
        parent::__construct("/");
        header('Content-Type: application/json; charset=UTF-8');
        //recebe as informações que estão vindo no cabeçalho da API
        $this->headers = getallheaders();

        // Valida para que seja feita apenas 1 requisição por segundo
        $request = $this->requestLimit("Api", 1, 1);
        if(!$request){
            exit;
        }

        //Valida se o usuário está logado e pode consumir APIs
        //A não ser em caso da rota ser de cadastro de usuario
        if($_GET['route'] != "/me/novo") {
        $login = $this->login();
        if(!$login){
            exit;
         }
      }
   }

    /**
     * @param int $code
     * @param string|null $type
     * @param string|null $messagem
     * @param string $rule
     * @return $this
     * Metodo responsavel por montar a resposta que será enviada ao usuario,
     * através do metodo back que será criado abaixo
     */
    protected function call(int $code, string $type = null, string $message = null, string $rule = "errors"): Api
    {
        http_response_code($code);

        if(!empty($type)){
            $this->response = [
                $rule => [
                    "type" => $type,
                    "message" => (!empty($message) ? $message : null)
                ]
            ];
        }
        return $this;
    }

    /**
     * @param array|null $response
     * @return $this
     * Responsavel por retornar a mensagem de retorno ao usuário, metodo chamado e concatenado com o Back.
     */

    protected function back(array $response = null): Api
    {
        if((!empty($response))){
            $this->response = (!empty($this->response) ? array_merge($this->response, $response) : $response);
        }

        echo json_encode($this->response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return $this;
    }

    /**
     * @return bool
     * Responsavel por realizar o Login na camada de API
     */
    private function login(): bool
    {
        //Validação para não deixar receber mais do que 3 requisições de login por minuto e attempt true para indicar
        //que não deverá ter manipulação no arquivo do usuário pois é um teste
        $request = $this->requestLimit("ApiLogin", 3, 60, true);
        if(!$request){
            return false;
        }

        //verifica se veio informações de email e senha através da requisição, se não veo enviar erro 400 (verificar no restapi
        //os códigos de erro), e a mensagem de erro e false. caso contrario parte para fazer o login.
        if(empty($this->headers["email"]) || empty($this->headers["password"])){
            $this->call(
                400,
                "auth_empty",
                "Favor informe o e-mail e senha"
            )->back();
            return false;
        }

        $objLogin = new Login();
        $result = $objLogin->logar($this->headers['email'],$this->headers['password']);
        if(!$result){
            // aqui é acessado caso o usuário tente e não consiga logar
            // assim vou incrementar as tentativas de login para não deixar passar das 3 por minuto

            $this->requestLimit("ApiLogin", 3, 60);

            $this->call(
                401,
                "invalid_auth",
                "Verifique os dados. Usuário ou senha inválido."
            )->back();
            return false;
        }

        $this->user = $result;
        return true;

    }

    protected function requestLimit(string $endpoint, int $limit, int $seconds, bool $attempt = false) :bool
    {
        //Verifica se veio na requisição o e-mail, se existir cria uma chave criptografada com base no e-mail do usuário
        //para seguir em frente.
        $userToken = (!empty($this->headers["email"]) ? base64_encode($this->headers["email"]) : null);

        //Caso não tenha sido informado o e-mail na requisição, cria um call, comunicação com usuário para dar o retorno
        // retorna ela e o false.
        if (!$userToken && $_GET['route'] != "/me/novo" ) {
            $this->call(
                code: 400,
                type: "invalid_data",
                message: "Você precisa informar e-mail e senha para continuar"
            )->back();
            return false;
        }

        //Se passou na validação de cima do e-mail e criou o token do usuário baseado no e-mail vamos continuar aqui
        //Criar/Apontar o diretório onde estará nosso JSON que irá auxiliar na manipulação dos dados do banco

        $cacheDir = __DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/requests";
   
        if (!file_exists($cacheDir) || !is_dir($cacheDir)) {
            mkdir($cacheDir, 0755);
        }

        //Após verificar a existencia da pasta e criar a mesma se ela não existir, devemos criar um arquivo individual
        //para cada usuário logado em nosso sistema

        $cacheFile = $cacheDir . "/" . $userToken . ".json";
     
        if (!file_exists($cacheFile) || !is_file($cacheFile)) {
            fopen($cacheFile, "w");
        }

        //Pego dos dados existentes do arquivo Json e carrego ele na em uma variavel para que possamos trabalhar com ele
        $userCache = json_decode(file_get_contents($cacheFile));
        $cache = (array)$userCache; // Transformo os dados em um array para eu manipular dentro do sistema

        //Processo para salvar dados no arquivo de cache do usuário
        $save = function ($cacheFile, $cache) {
            $saveCache = fopen($cacheFile, "w");
            fwrite($saveCache, json_encode($cache, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            fclose($saveCache);
        };

        //Tendo todo o processo acima, agora vamos montar a validação, se não existir a requisição(endpoint)
        // e se o limit de tempo não estiver estourado, ele segue para salvar os dados no arquivo.
        if (empty($cache[$endpoint]) || $cache[$endpoint]->time <= time()) {
            //verifico se não é somente um teste
            if (!$attempt) {
                $cache[$endpoint] = [
                    "limit" => $limit,
                    "requests" => 1,
                    "time" => time() + $seconds
                ];

                $save($cacheFile, $cache);
            }
            return true;
        }
        if ($cache[$endpoint]->requests >= $limit) {
            $this->call(
                code: 400,
                type: "request_limit",
                message: "Você atingiu o limite de requisições para essa ação"
            )->back();
            return false;
        }

        //incrementar a requisição
        if (!$attempt) {
            $cache[$endpoint] = [
                "limit" => $limit,
                "requests" => $cache[$endpoint]->requests + 1,
                "time" => $cache[$endpoint]->time
            ];

            //passou por todos as validações chegou aqui incrementou a requisição vamos salvar os dados no arquivo
            $save($cacheFile, $cache);
        }
        // e retornar true
        return true;
    }
}