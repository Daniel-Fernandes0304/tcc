<?php
use Source\Models\Login;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="mit" content="2023-05-08T08:25:41-03:00+199254">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="<?=$this->e($description)?>">





    <title><?=$this->e($title)?></title>


    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>


<div class="header">
        <div class="logo_header" style="justify-content: center;">
            <div id="dov">
            <a href="<?=CONF_URL_BASE?>/home"><img src="/tcc2/views/assets/images/logo-senai.png" alt="SENAI Logo"> </a>
            </div>
        </div> 
    <?php if ($this->user = Login::user()) { ?> 
        <div class="user" style="text-align: center; float: right;">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person"
                viewBox="0 0 16 16">
                <path
                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
            </svg>
       
            <?= $this->user->nome ?>
    <?php } ?>
        </div>
    </div>
</div>

<!--CONTENT-->

<?=$this->section('content')?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>