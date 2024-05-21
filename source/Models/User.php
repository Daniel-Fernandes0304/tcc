<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class User extends DataLayer{
    
    public function __construct()
    {
        parent::__construct("users", [], "id", true);
    }

    public function save(): bool
    {
        //verificar se o e-mail já existe se não.
        parent::save();
        return true;
    }
}

