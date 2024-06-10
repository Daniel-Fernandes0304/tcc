<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class TableData extends DataLayer
{

    public function __construct()
    {
        parent::__construct("tbl_data", ["num_invent", "dt_incorp", "nome_equipamento", "localizacao", "ambiente", "codigo"], "id", true);

    }

}