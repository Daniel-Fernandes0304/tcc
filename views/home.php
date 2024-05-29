<?php
$this->layout("base", $data);
use Source\Models\Login;

$tipo = Login::user()->tipo;
?>
<!--FEATURED-->
<link rel="stylesheet" href="<?= CONF_URL_BASE ?>/views/assets/css/home.css" />
<div class="conteudo_home">

    <div id="animation">Bem vindo ao SENAI</div>

    <script>
        setTimeout(function () {
            var element = document.getElementById('animation');
            element.style.animation = 'none';
            element.style.opacity = 1;
        }, 10000);
    </script>
    <div class="sidebar">
        <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none"
            onclick="toggleMenu()">
            <span class="fs-4">Menu</span>
        </a>
        <ul id="menuItems" class="nav nav-pills flex-column mb-auto" style="display: none;">
            <li class="nav-item">
                <a href="<?= CONF_URL_BASE ?>/import" class="nav-link">
                    <button class="btn btn-link" onclick="showMenuItem('Importar')">Importar</button>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= CONF_URL_BASE ?>/novo" class="nav-link">
                    <button class="btn btn-link" onclick="showMenuItem('Novo')">Novo</button>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= CONF_URL_BASE ?>/searchequip" class="nav-link">
                    <button class="btn btn-link" onclick="showMenuItem('Pesquisar')">Pesquisar</button>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= CONF_URL_BASE ?>/usuario" class="nav-link">
                    <button class="btn btn-link" onclick="showMenuItem('Usuário')">Usuário</button>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= CONF_URL_BASE ?>/altsenha" class="nav-link">
                    <button class="btn btn-link" onclick="showMenuItem('Senha')">Senha</button>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= CONF_URL_BASE ?>/sair" class="nav-link">
                    <button class="btn btn-link" onclick="showMenuItem('Sair')">Sair</button>
                </a>
            </li>
        </ul>
    </div>


    <script>
        function toggleMenu() {
            var menu = document.getElementById("menuItems");
            if (menu.style.display === "none") {
                menu.style.display = "block";
            } else {
                menu.style.display = "none";
            }
        }
    </script>
</div>