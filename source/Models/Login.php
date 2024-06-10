<?php

namespace Source\Models;

use Source\Core\Session;

class Login extends User
{
    private $session;
    public function __construct()
    {
        parent::__construct("user", ["id"], ["email", "password"]);
        $this->session = new Session();
    }

    public static function user()
    {
        $session = new Session();
        if (!$session->has('idUser')) {
            return null;
        }

        return (new User())->findById($session->get("idUser"));
    }

    public static function logout()
    {
        $session = new Session();
        $session->unset("idUser");

    }

    public function logar(string $email, string $password, bool $save = false): bool
    {
        if (!is_email($email)) {
            $message = [
                'type' => 'warning',
                'message' => 'O E-mail informado é invalido.'
            ];
            $this->session->set("message", $message);
            return false;
        }

        if ($save) {
            setcookie("Email", $email, time() + 604800, "/");
        } else {
            setcookie("Email", null, time() - 3600, "/");
        }

        if (!is_passwd($password)) {
            $message = [
                'type' => 'warning',
                'message' => 'O formato da senha informada é invalido.'
            ];
            $this->session->set("message", $message);
            return false;
        }

        $user = new User();
        $result = $user->find("email = :email", "email=" . $email)->fetch();

        if (!$result) {
            $message = [
                'type' => 'warning',
                'message' => 'O E-mail não está cadastrado.'
            ];
            $this->session->set("message", $message);
            return false;
        }

        if (!password_verify($password, $result->senha)) {
            $message = [
                'type' => 'warning',
                'message' => 'A senha informada incorreta.'
            ];
            $this->session->set("message", $message);
            return false;
        }

        $nivelAcesso = '1';

        // Verifica se o nível de acesso está definido no resultado do banco de dados e atualiza a variável $nivelAcesso
        if (isset($result->tipo) && !empty($result->tipo)) {
            $nivelAcesso = $result->tipo;
        }

        // Armazena o nível de acesso na sessão
        $this->session->set("nivelAcesso", $nivelAcesso);

        //Se passou por todas as validações acima, Login efetivo
        $message = [
            'type' => 'sucess',
            'message' => 'Login efetuado com sucesso.'
        ];

        $this->session->set("message", $message);
        $this->session->set("idUser", $result->id);
        $this->session->set("nomeUser", $result->nome);
        return true;
    }
}