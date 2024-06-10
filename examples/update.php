<?php

require __DIR__ . "/../vendor/autoload.php";

use Source\Models\User;

$user = (new User())->findById(86);
//agora passo somente o que eu quero mudar;
$user->first_name = "Nome ALterado";

$user->save();

var_dump($user);