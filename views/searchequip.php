<?php
$this->layout("base", $data);
use Source\Models\Login;
use Source\Models\TableData;

$tipo = Login::user()->tipo;
$patrimonios = [];

$selectOption = '';
$nomeEquipamento = '';
// Pesquisa por filtro
if ($_POST && !empty($_POST['pesquisa'])) {
    // Salva o nome do equipamento pesquisado
    $nomeEquipamento = trim($_POST['pesquisa']);

    $tableData = new TableData();
    // Salva a opção que vai ser filtrada (nome, número de equipamento e código da sala)
    $selectOption = $_POST['equipamento'];
    // Verifica a opção que foi escolhida, e faz a pesquisa com base no filtro selecionado.
    if ($selectOption === 'nome') {
        $patrimonios = $tableData->find("nome_equipamento LIKE :nome_equipamento", "nome_equipamento={$nomeEquipamento}%", '*')->fetch(true);
    } elseif ($selectOption === 'num_patrimonio') {
        $patrimonios = $tableData->find("num_invent = :num_invent", "num_invent=$nomeEquipamento", '*')->fetch(true);
    } elseif ($selectOption === 'sala') {
        $patrimonios = $tableData->find("codigo = :codigo", "codigo=$nomeEquipamento", '*')->fetch(true);
    }
}

?>

<link rel="stylesheet" href="<?= CONF_URL_BASE ?>/views/assets/css/pesquisa.css" />


<div class="conteudo">
    <div class="pesquisa">
        <div class="menu-lateral">
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
        </div>

        <form class="auth_form" method="post" name="formulario">
            <div style='position: relative; top: 100px; display: flex; gap: 10px;'>
                <input type="radio" name="equipamento" id="equipamento" value='nome' checked <?= ($selectOption === 'nome') ? 'checked' : '' //Deixa o 'input radio' com check para salvar o filtro escolhido ?>>Nome Equipamento
                <input type="radio" name="equipamento" id="equipamento" value='num_patrimonio'
                    <?= ($selectOption === 'num_patrimonio') ? 'checked' : '' ?>>N° Patrimônio
                <input type="radio" name="equipamento" id="equipamento" value='sala' <?= ($selectOption === 'sala') ? 'checked' : '' ?>>Código da Sala
            </div>
            <br>
            <input type="text" id="nomeEquipment" name="pesquisa" autocomplete="off" placeholder="Pesquisa...."
                required />
            <button type="submit" class="enviar">Enviar</button>
        </form>
        <!-- Exibe resultados da pesquisa -->
        <?php if (!empty($patrimonios)): ?>
            <div class="resultados">
                <table class="tabela-patrimonios">
                    <thead>
                        <tr>
                            <th>NI</th>
                            <th>Data de Incorporação</th>
                            <th>Nome Equipamento</th>
                            <th>Observações</th>
                            <th>Código da Sala</th>
                        </tr>
                    </thead>
                    <?php foreach ($patrimonios as $patrimonio): ?>
                        <div class="resultado">
                            <tbody>
                                <tr>
                                    <td><?= $patrimonio->num_invent; ?></td>
                                    <td><?= $patrimonio->dt_incorp; ?></td>
                                    <td><?= $patrimonio->nome_equipamento; ?></td>
                                    <td><?= $patrimonio->observacoes; ?></td>
                                    <td><?= $patrimonio->codigo; ?></td>
                                </tr>
                            </tbody>
                        </div>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php elseif ($_POST): ?>
            <p style='color: red;'>Nenhum patrimônio encontrado.</p>
        <?php endif; ?>
    </div>

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
<!-- <script src="<?= CONF_URL_BASE ?>/views/assets/js/patrimonio.js" defer></script> -->