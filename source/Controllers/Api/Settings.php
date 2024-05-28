<?php

namespace Source\Controllers\Api;

use Source\Core\Controller;
use Source\Models\Login;
use Source\Models\User;
use Source\Models\Setting;

class Settings extends Api{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void{
        $settings = (new Setting())->find()->fetch(true);

        if(!$settings) {
            $this->call(
                404,
                "not_found",
                "Estrutura da agenda não configurada."
            )->back();
            return;
        }
        foreach($settings as $item) {
            $response["settings"][] = $item->data();
        }

        $this->back($response);
    }
}