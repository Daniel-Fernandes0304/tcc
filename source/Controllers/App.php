<?php

namespace Source\Controllers;


use http\Env\Request;
use Source\Core\Controller;

use Source\Models\Login;
use Source\Models\User;
use Source\Models\TableData;

class App extends Controller
{
    public function __construct()
    {
        parent::__construct(CONF_VIEW_PATH);

        if (!$this->user = Login::user()) {
            redirect("/");
        }
    }

    public function home()
    {
        $data = [
            'title' => "Home - " . CONF_SITE_NAME,
            'description' => CONF_SITE_DESC,
            'url' => "/home"
        ];

        echo $this->objView->render('home', ["data" => $data]);
    }

    //CADASTRAR NOVO USUÁRIO
    public function usuario(array $form)
    {

        $msg = '';
        // Cadastra novos usuários, após enviar as informações
        if ($form) {

            if (isset($_POST["cadastrar"])) {
                $objUser = new User();
            }
            // Salva os dados vindos do form no banco de dados
            $objUser->nome = $form['nome_user'];
            $objUser->email = $form['email_user'];
            $objUser->senha = $form['senha_user'];
            $objUser->senha = password_hash($form['senha_user'], CONF_PASSWD_ALGO, CONF_PASSWD_OPTION);
            $objUser->tipo = $form['tipo_user'];
            $result = $objUser->save();
            if ($result) {
                $msg = "Cadastro atualizado com sucesso.";
            } else {
                $msg = "Erro ao realizar cadastro.";
            }
        }

        $data = [
            'title' => "usuario - " . CONF_SITE_NAME,
            'description' => CONF_SITE_DESC,
            'url' => "/usuario",
        ];
        echo $this->objView->render('usuario', ["data" => $data]);
    }



    // ALTERAR SENHA
    public function altsenha(array $form)
    {
        $msg = "";
        // Troca a senha do usuário através do id dele
        if ($form) {
            $user = new User();
            $user->id = $form['id'];
            $user->senha = password_hash($form['senhaUser'], CONF_PASSWD_ALGO, CONF_PASSWD_OPTION);

            $result = $user->save();

            if ($result) {
                $msg = "Cadastro atualizado com sucesso.";
            } else {
                $msg = "Erro ao atualizar o cadastro.";
            }
        }

        $data = [
            'title' => "Altsenha - " . CONF_SITE_NAME,
            'description' => CONF_SITE_DESC,
            'url' => "/altsenha",
            'msg' => $msg
        ];
        echo $this->objView->render('altsenha', ["data" => $data]);

    }

    //PESQUISA NOME DO USUÁRIO
    public function search_users(array $form)
    {
        $nomeUsuario = filter_var($form['chaveid'], FILTER_SANITIZE_STRIPPED);

        if (!empty($nomeUsuario)) {
            $objUser = new User();
            $result = $objUser->find("nome LIKE :nome", "nome=%{$nomeUsuario}%", 'id, nome, senha')->fetch(true);
            if ($result) {
                foreach ($result as $user) {
                    $dados[] = [
                        'id' => $user->id,
                        'nome' => $user->nome,
                        'senhaUser' => $user->senha
                    ];
                }
                $retorno = ['status' => true, 'dados' => $dados];
            } else {
                $retorno = ['status' => false, 'msg' => "Usuario não encontrado."];
            }
        } else {
            $retorno = ['status' => false, 'msg' => "Usuario não encontrado."];
        }
        echo json_encode($retorno);
    }

    // CRIAR NOVO EQUIPAMENTO
    public function novo_equip(array $form)
    {
        $msg = "";

        if ($form) {

            if (isset($_POST["salvar"])) {
                $objTableData = new TableData();
            }
            // Manda os dados vindos do 'form' para o banco de dados
            $objTableData->num_invent = $form['numeInvent'];
            $objTableData->instituicao = $form['instituicao'];
            $objTableData->nome_equipamento = $form['nomeequip'];
            $objTableData->tag = $form['tag'];
            $objTableData->observacoes = $form['observacao'];
            $objTableData->descricao = $form['descricao'];
            $objTableData->dt_incorp = date('Y-m-d', strtotime($form['data']));
            $objTableData->marca = $form['marca'];
            $objTableData->serie = $form['serie'];
            $objTableData->valor = $form['valor'];
            $objTableData->codigo = $form['sala'];
            $objTableData->localizacao = $form['local'];
            $objTableData->bloco = $form['bloco'];
            $objTableData->ambiente = $form['ambiente'];
            $objTableData->equip_emprestado = $form['emprest_equip'];
            $objTableData->status = $form['status_equip'];
            $result = $objTableData->save();
            if ($result) {
                echo '<script> alert("Item cadastrado com sucesso!"); </script>';
            } else {
                echo '<script> alert("Erro ao cadastrar o item!"); </script>';
            }
        } {
            $data = [
                'title' => "Novo - " . CONF_SITE_NAME,
                'description' => CONF_SITE_DESC,
                'url' => "/novoequip",
                'msg' => $msg

            ];
            echo $this->objView->render('novoequip', ["data" => $data]);
        }
    }

    // PAGINA DE IMPORTAÇÃO
    public function importar(array $form)
    {
        $data = [
            'title' => "Importar - " . CONF_SITE_NAME,
            'description' => CONF_SITE_DESC,
            'url' => "/import"

        ];
        echo $this->objView->render('import', ["data" => $data]);
    }

    // PÁGINA DE PROCURAR EQUIPAMENTO
    public function search_equipment(array $form)
    {

        $data = [
            'title' => "Pesquisar - " . CONF_SITE_NAME,
            'description' => CONF_SITE_DESC,
            'url' => "/searchequip"
        ];
        echo $this->objView->render('searchequip', ["data" => $data]);
    }

    public function logout()
    {
        $this->user = Login::logout();

        $data = [
            'title' => "Login - " . CONF_SITE_NAME,
            'description' => CONF_SITE_DESC,
            'url' => "/",
            'mensagem' => "Você foi desconectado com suceso. Até a próxima :)."
        ];

        echo $this->objView->render('login', ["data" => $data]);
    }
}