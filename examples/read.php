<?php

require __DIR__ . "/../vendor/autoload.php";

//use CoffeeCode\DataLayer\Connect;

/*$conn = Connect::getInstance();
$error = Connect::getError();

if($error){
    echo $error->getMessage();
    die();
}

$query = $conn->query("select * from usuario_tiago");

//tenho a query pronta
//var_dump($query);

var_dump($query->fetchAll());*/

use Source\Models\User;
use Source\Models\Login;
use Source\Models\Settings;
use Source\Models\Schedule;

use Source\Core\Session;
/*
//Fazendo Login
$objLogin = new Login();
//$list = $user->findByEmail("tiago_pereira7@hotmail.com");
$list = $objLogin->logar("cursos@upinside.com.br", "12345678");
var_dump($list);
var_dump((new Session())->get("message"));
echo (new Session())->get("message")['message'];


// Listando todos os Usuarios
*/
$objUser = new User();
$list = $objUser->find()->fetch(true);

//var_dump($user);

//var_dump($list);
//exemplo listagem de usuario + suas consultas
/** @var  $userItem User */
/*
foreach ($list as $userItem){
    //var_dump($userItem->first_name)."<br>";
    var_dump($userItem->data())."<br>";
    foreach ($userItem->schedules() as $schedule)
    var_dump($schedule->data());
}


/*$dSemana = date('w', strtotime('2023-08-28'));
$objSettings = new \Source\Models\Schedule();
$list = $objSettings->find()->fetch(true);
var_dump($objSettings);
var_dump($list);*/
/**
 * @var $consulta Schedule
 */
$objSchedule = new Schedule();
$list = $objSchedule->find()->fetch(true);
//var_dump($list);
foreach ($list as $consulta){

    $paciente = $consulta->patients();
    echo $consulta->paciente ."-". $paciente->nome."<br>";
}