<?php

/**
 * Carregamento automatico de arquivos
 */
require __DIR__."/vendor/autoload.php";
/**
 * Configurações do meu sistema de rota
 */
use CoffeeCode\Router\Router;
$objRouter = new Router(CONF_URL_BASE);
$objRouter->namespace("Source\Controllers");

/**
 * ROTAS GERAIS DE NAVEGAÇÃO
 */
$objRouter->get("/", "Web:login");


/**
 * ROTAS DE DENTRO DO SISTEMA
 */
$objRouter->get("/home", "App:home");

$objRouter->get("/usuario", "App:usuario");
$objRouter->post("/usuario", "App:usuario");

$objRouter->get("/altsenha", "App:altsenha");
$objRouter->post("/altsenha", "App:altsenha");

$objRouter->get("/import", "App:importar");
$objRouter->post("/import", "App:importar");

$objRouter->get("/importconfirm", "App:importconfirm");
$objRouter->post("/importconfirm", "App:importconfirm");

$objRouter->post("/searchequip", "App:search_equipment");
$objRouter->get("/searchequip", "App:search_equipment");

$objRouter->post("/novo", "App:novo_equip");
$objRouter->get("/novo", "App:novo_equip");

$objRouter->get("/busca-patrimonio/{chave}", "App:search_patrimonio");

$objRouter->get("/busca-usuarios/{chaveid}", "App:search_users");
/**
 * ROTAS DE AUTENTICAÇÃO
 */
$objRouter->post("/entrar", "Web:entrar");
$objRouter->get("/sair", "App:logout");

/**
 * ROTAS DE ERROS
 */
$objRouter->get("/ops/{errcode}", "Web:error");

$objRouter->dispatch();

/*
 * ERROR REDIRECT - Controla caso do Dispatch não consiga entregar uma rota funcionando
 */
if ($objRouter->error()){
    $objRouter->redirect("/ops/{$objRouter->error()}");
}

