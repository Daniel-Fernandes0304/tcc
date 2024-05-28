<?php
$this->layout("base", $data);
use Source\Models\Login;

$dadosUsuario = $this->user = Login::user();

$tipo = Login::user()->tipo;

if ($_SESSION['nivelAcesso'] !== '1') {
    redirect('/home/'); // Redireciona o usuário para uma página de erro ou login
    exit; // Impede a execução de mais scripts
}
?>
<!--FEATURED-->
<link rel="stylesheet" href="<?= CONF_URL_BASE ?>/views/assets/css/senha.css" />
<div class="conteudo_home">
    <div class="sidebar">
        <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none"
            onclick="toggleMenu()">
            <span class="fs-4">Menu</span>
        </a>


        <ul id="menuItems" class="nav nav-pills flex-column mb-auto" style="display: none;">
            <li class="nav-item">
                <a href="<?= CONF_URL_BASE ?>/import" class="nav-link" onclick="showMenuItem('Importar')">Importar</a>
            </li>
            <li class="nav-item">
                <a href="<?= CONF_URL_BASE ?>/novo" class="nav-link" onclick="showMenuItem('Novo')">Novo</a>
            </li>
            <li class="nav-item">
                <a href="<?= CONF_URL_BASE ?>/searchequip" class="nav-link"
                    onclick="showMenuItem('Pesquisar')">Pesquisar</a>
            </li>
            <li class="nav-item">
                <a href="<?= CONF_URL_BASE ?>/usuario" class="nav-link" onclick="showMenuItem('Usuário')">Usuário</a>
            </li>
            <li class="nav-item">
                <a href="<?= CONF_URL_BASE ?>/altsenha" class="nav-link" onclick="showMenuItem('Senha')">Senha</a>
            </li>
            <li class="nav-item">
                <a href="<?= CONF_URL_BASE ?>/sair" class="nav-link" onclick="showMenuItem('Sair')">Sair</a>
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
    <div class="formulario_home">

        <div class="form-group">
            <form class="auth_form" method="post" name="formulario">
                <p class="formulario-text_home"><b>Alterar Senha</b> </p>
                <span name="resultado-pesquisa" id="resultado-pesquisa"></span>
                <input type="text" name="nome" id='nomeUsuario' class="form-control" autocomplete="off" placeholder="Usuário:" required>
                <input type="password" name="senhaUser" id='senhaUser' class="form-control" placeholder="Mudar senha(min 5 caracteres):" required>
                <input type="password" name="csenha" id='csenha' class="form-control" placeholder="Confirme Senha:" required>
                <input type="hidden" name="id" id="id" value="" />
                <div class="botao_meio_home">
                    <button type="submit" name='alterar' id='alterar' class="auth_form_btn btn btn-danger">OK</button>
                    <button type="reset" class="btn btn-danger">Cancelar</button>
            </form>
        </div>
    </div>
</div>
</div>
<script src="<?= CONF_URL_BASE ?>/views/assets/js/usuarios.js" defer></script>