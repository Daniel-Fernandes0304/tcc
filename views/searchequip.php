<?php 
$this->layout("base", $data); 
use Source\Models\Login;
use Source\Models\TableData;
$tipo = Login::user()->tipo;
$patrimonios = [];

if ($_POST && !empty($_POST['nome_equipamento'])) {
    $nomeEquipamento = filter_var($_POST['nome_equipamento'], FILTER_SANITIZE_STRING);
    $tableData = new TableData();
    $patrimonios = $tableData->find("num_invent = :num_invent", "num_invent=$nomeEquipamento", '*')->fetch(true);
}
?>

<link rel="stylesheet" href="<?= CONF_URL_BASE ?>/views/assets/css/pesquisa.css"/>


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
                    <a href="<?=CONF_URL_BASE?>/import" class="nav-link" onclick="showMenuItem('Importar')">Importar</a>
                </li>
                <li class="nav-item">
                    <a href="<?=CONF_URL_BASE?>/novo" class="nav-link" onclick="showMenuItem('Novo')">Novo</a>
                </li>
                <li class="nav-item">
                    <a href="<?=CONF_URL_BASE?>/searchequip" class="nav-link" onclick="showMenuItem('Pesquisar')">Pesquisar</a>
                </li>
                <li class="nav-item">
                    <a href="<?=CONF_URL_BASE?>/usuario" class="nav-link" onclick="showMenuItem('Usuário')">Usuário</a>
                </li>
                <li class="nav-item">
                    <a href="<?=CONF_URL_BASE?>/altsenha" class="nav-link" onclick="showMenuItem('Senha')">Senha</a>
                </li>

                <li class="nav-item">
                    <a href="<?=CONF_URL_BASE?>/sair" class="nav-link" onclick="showMenuItem('Sair')">Sair</a>
                </li>

            </ul>
        </div>
    </div>  
    
            <form class="auth_form" method="post" name="formulario">
                <input type="text" id="nomeEquipment" name="nome_equipamento" autocomplete="off" placeholder="Pesquisa...." />
                <button type="submit" class="enviar">Enviar</button>
                <span name="resultado-pesquisa" id="resultado-pesquisa2"></span>
                <input type="hidden" name="id" id="idPatr" value="" />  
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
            <!-- Adicione mais <th> aqui para outros detalhes do patrimônio -->
                    </tr>
                </thead>
                <?php foreach ($patrimonios as $patrimonio): ?>
                    <div class="resultado">        
                        <tbody>
                                <tr>
                                <td><?= htmlspecialchars($patrimonio->num_invent); ?></td>
                                <td><?= htmlspecialchars($patrimonio->dt_incorp); ?></td>
                                <td><?= htmlspecialchars($patrimonio->nome_equipamento); ?></td>
                                <td><?= htmlspecialchars($patrimonio->observacoes); ?></td>
                                <td><?= htmlspecialchars($patrimonio->codigo); ?></td>
                <!-- Adicione mais <td> aqui para outros detalhes do patrimônio -->
                            </tr>
                        </tbody>
                    </div>
                <?php endforeach; ?>
            </table>
        </div>
    <?php elseif ($_POST): ?>
        <p>Nenhum patrimônio encontrado.</p>
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

    function clearResults() {
    document.getElementById('resultado-pesquisa2').innerHTML = ""; // Limpa os resultados da pesquisa
}

// Chamar essa função conforme necessário
document.getElementById('clearButton').addEventListener('click', clearResults);
</script>
<script src="<?= CONF_URL_BASE ?>/views/assets/js/patrimonio.js" defer></script>
