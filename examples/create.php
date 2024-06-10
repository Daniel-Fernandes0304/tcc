<?php

require __DIR__ . "/../vendor/autoload.php";

use Source\Models\User;

$user = new User();
$user->nome = "Tiago Pereira Ramos";
$user->email = "tiago.ramos@sp.senai.br";
$user->senha = password_hash("12345678",CONF_PASSWD_ALGO,CONF_PASSWD_OPTION);
$user->rg = "12345678";
$user->cpf = "12345678";
$user->crm = "12345678";
$user->cep = "19015011";
$user->logradouro = "Rua Barão do Rio Branco";
$user->numero = "1838";
$user->complemento = "";
$user->bairro = "Vila Santa Helena";
$user->cidade = "Presidente Prudente";
$user->estado = "SP";
$user->tipo = "1";
$user->convenio = "2";
$user->celular = "18997230626";
$user->conv_numero = "12345678";

$user->save();

var_dump($user);