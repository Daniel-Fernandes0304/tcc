<?php

require __DIR__ . "/../vendor/autoload.php";

use Source\Models\User;

$user = (new User())->findById(87);

if($user)
{
    $user->destroy();
}
else{
    var_dump($user);
}