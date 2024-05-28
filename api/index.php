<?php
ob_start();
/**
 * Carregamento automatico de arquivos
 */
require __DIR__."/../vendor/autoload.php";
/**
 * Configurações do meu sistema de rota
 */
use CoffeeCode\Router\Router;
$objRouter = new Router(CONF_URL_API);
$objRouter->namespace("Source\Controllers\Api");

//Rotas de usuarios
$objRouter->group("/me");
$objRouter->get("/", "Users:index");
$objRouter->post("/novo", "Users:create");
$objRouter->get("/{user_id}", "Users:read");
$objRouter->put("/atualiza", "Users:update");
$objRouter->delete("/deleta", "Users:delete");

//Rotas de consultas
$objRouter->group("/schedule");
$objRouter->get("/", "Schedules:index");
$objRouter->post("/novo", "Schedules:create");
$objRouter->get("/{key}", "Schedules:read");
$objRouter->put("/atualiza/{schedule_id}", "Schedules:update");
$objRouter->delete("/deleta/{schedule_id}", "Schedules:delete");

//Rotas de estrutura da agenda
$objRouter->group("/settings");
$objRouter->get("/", "Settings:index");

/**
 * ROTAS DE ERROS
 */

$objRouter->dispatch();

/*
 * ERROR REDIRECT - Controla caso do Dispatch não consiga entregar uma rota funcionando
 */
if ($objRouter->error()){
    header('content-Type: application/json; charset=UTF-8');
    http_response_code(404);

    echo json_encode([
        "errors" => [
            "type"=>"endpoint_not_found", 
            "message"=>"Não foi possível encontrar sua rota"
        ]
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

ob_end_flush();

