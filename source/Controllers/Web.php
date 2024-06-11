<?php

namespace Source\Controllers;

use CoffeeCode\Router\Router;
use Source\Core\Controller;
use Source\Models\Login;
use Source\Core\Session;


class Web extends Controller
{
    public function __construct()
    {
        parent::__construct(CONF_VIEW_PATH);
    }

    public function login()
    {
        $data = [
            'title' => "Entra - " . CONF_SITE_NAME,
            'description' => CONF_SITE_DESC,
            'url' => "/"
        ];
        echo $this->objView->render('login', ["data" => $data]);

    }

    public function register()
    {
        $data = [
            'title' => "Cadastrar - " . CONF_SITE_NAME,
            'description' => CONF_SITE_DESC,
            'url' => "/cadastro"
        ];
        echo $this->objView->render('register', ["data" => $data]);

    }

    public function entrar(array $data): void
    {
        if (!$data) {
            return;
        }

        if (empty($data['email']) || empty($data['password'])) {
            return;
        }
        $user = new Login();
        $result = $user->logar($data['email'], $data['password']);

        if (!$result) {
            redirect("/");
            echo '<script> alert ("Usuário ou senha incorreto!"); location.href=("login.php")</script>';
        }
        redirect("/home");

    }


    /**
     * Site Nav Error
     * @param array $data
     */
    public function error(array $data): void
    {
        $data = [
            'title' => $data['errcode'] . " Ooooops. Conteúdo indisponível :/",
            'description' => "Sentimos muito, mas o conteúdo que você tentou acessar não existe, está indisponível no momento ou foi removido :/",
            'code' => $data['errcode'],
            'url' => "/error",
            'linkTitle' => 'Continue navegando'
        ];
        echo $this->objView->render('error', ["data" => $data]);
    }

}