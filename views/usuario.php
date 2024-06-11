<?php
$this->layout("base", $data);
use Source\Models\Login;

$dadosUsuario = $this->user = Login::user();
$msg = '';

$tipo = Login::user()->tipo;

if ($_SESSION['nivelAcesso'] !== '1') {
    redirect('/home/'); // Redireciona o usuário para uma página de erro ou login
    exit; // Impede a execução de mais scripts
}
?>

<link rel="stylesheet" href="<?= CONF_URL_BASE ?>/views/assets/css/usu.css" />
<div class="conteudo_home">
    <div class="conteudo">
        <div class="formulario">



            <div class="form-group">
                <div class="formularioss"><b>CADASTRAR</b>
                </div>
                <form class="auth_form" method="post" name="formulario" enctype='multipart/form-data'>
                    <label for="text" class="usu">Nome: </label>
                    <input type="text" name="nome_user" class="input-com-icone form-control" placeholder="Usuário"
                        required>
                    <label for="email" class="usu">Email:</label>
                    <input type="email" name="email_user" class="input-com-icone-email form-control "
                        placeholder="Email" required>
                    <label for="senha" class="usu">Senha:</label>
                    <input type="password" name="senha_user" class="input-com-icone-senha form-control"
                        placeholder="Senha" required>
                    <label for="tipo" class="usu">Tipo</label>
                    <select name="tipo_user" id="tipo" placeholder="Tipo" class="input-com-icone-senha1 form-control">
                        <option id="adm" value="1">Administrador</option>
                        <option id="comum" value="3">Comum</option>
                    </select>
                    <br>
                    <button type="submit" name="cadastrar" class="ini">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
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