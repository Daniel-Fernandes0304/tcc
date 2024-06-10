<?php
$this->layout("base", $data);
use Source\Models\TableData;
use Source\Models\Login;

$tipo = Login::user()->tipo;

if ($_SESSION['nivelAcesso'] !== '1') {
    redirect('/home/'); // Redireciona o usuário para uma página de erro ou login
    exit; // Impede a execução de mais scripts
}

?>
<link rel="stylesheet" href="<?= CONF_URL_BASE ?>/views/assets/css/novo.css" />

<div class="conteudo-novo">
    <div class="sidebar">
        <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none"
            onclick="toggleMenu()">
            <span class="fs-4">Menu </span>

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

        function deleteItem() {
            if (confirm('Tem certeza que deseja deletar este item?')) {
                // Lógica para deletar o item
                console.log('Item deletado');
                // Aqui você pode adicionar a lógica real para deletar o item, como uma requisição AJAX ou manipulação do DOM.
            }
        }

        // Função para impedir a passagem de caracteres escolhida
        function maxLengthCheck(object) {
            if (object.value.length > object.maxLength)
                object.value = object.value.slice(0, object.maxLength)
        }
    </script>


    <div class="conteudo-right">
        <div class="formulario-novo">
            <form class="auth_form" method="post" name="formulario" enctype='multipart/form-data'>

                <div class="linha1">
                    <div>
                        <label for="text">ID</label>
                        <input class="inputFormularioID" oninput="maxLengthCheck(this)" maxlength="7" type="number"
                            name="numeInvent" id='numeInvent' placeholder="Nº Patrimônio" required>
                    </div>
                    <div>
                        <label for="text">INSTITUIÇÃO</label>
                        <select name="instituicao" id='instituicao' class="inputFormulario" style="padding: 5px;" required>
                            <option id="senai" value="SENAI">SENAI</option>
                            <option id="Fundação Shunji Nishimura" value="Fundação Shunji Nishimura">Fundação Shunji
                                Nishimura</option>
                        </select>
                    </div>
                    <div>
                        <label for="text">NOME EQUIPAMENTO</label>
                        <input class="inputFormulario" type="text" name="nomeequip" id='nomeequip' placeholder="Nome do Patrimônio" required>
                    </div>
                    <div>
                        <label for="text">TAG</label>
                        <input class="inputFormulario" type="text" name="tag" id='tag' required>
                    </div>
                </div>
                <div class="linha2des">
                    <label for="text">DESCRIÇÃO</label>
                    <input class="inputFormulario1" type="text" name="descricao" id='descricao' required>
                </div>
                <div class="linha2">

                    <div class="linha2ab">
                        <label for="text">AMBIENTE</label>
                        <input class="inputFormulario" type="text" placeholder="Nome da Sala" name="ambiente" id='ambiente' required>
                    </div>
                    <div class="linha2data">
                        <label for="text">DATA</label>
                        <input class="inputFormulario" type="date" name="data" id='data' required>
                    </div>
                </div>

                <div class="linha3">
                    <div class="linha3marca">
                        <label for="text">MARCA</label>
                        <input class="inputFormulario" type="text" placeholder="Ex.(Cisco)" name="marca" id='marca' required>
                    </div>
                    <div class="linha3serie">
                        <label for="number">SÉRIE</label>
                        <input class="inputFormulario" type="number" name="serie" placeholder="Nº de série" id='serie' required>
                    </div>
                    <div class="linha3valor">
                        <label for="text">VALOR</label>
                        <input class="inputFormulario" type="number" placeholder="Preço" name="valor" id='valor' required>
                    </div>
                </div>

                <div class="linha4">
                    <div>
                        <label for="text">SALA</label>
                        <input class="inputFormulario" type="text" oninput="maxLengthCheck(this)" maxlength="3" placeholder="Ex.(A1, A2, B1...)" name="sala" id='sala' required>
                    </div>
                    <div class="linha4local">
                        <label for="text">LOCAL</label>
                        <input class="inputFormulario" type="number" name="local" oninput="maxLengthCheck(this)" maxlength="8" placeholder="Ex.(12029823)" id='local' required>
                    </div>
                    <div>
                        <label for="text">BLOCO</label>
                        <select name="bloco" id='bloco' class="inputFormulario" required style="padding: 6px 59px;">
                            <option id="a" value="A">Bloco A</option>
                            <option id="b" value="B">Bloco B</option>
                            <option id="c" value="C">Bloco C</option>
                            <option id="d" value="D">Bloco D</option>
                            <option id="e" value="E">Bloco E</option>
                        </select>
                    </div>
                </div>
        </div>


        <div class="Letter">
            <p>EQUIPAMENTO EMPRESTADO</p>
            <label class="ativo">
                <input type="radio" name="emprest_equip" id='sim' value='SIM'>Sim
            </label>
            <label class="ativo">
                <input type="radio" name="emprest_equip" id='nao' value='NÃO'>Não
            </label>

            <p class="Obeservação">Observação</p>


            <input class="ob" type="text" name="observacao">
            <div class="status">
                <div class="disk">
                    <p style="text-align: center;"> STATUS </p>

                    <label class="ativo1">
                        <input type="radio" name="status_equip" id='ativo' value='Ativo'>Ativo
                    </label>
                    <label class="ativo1">
                        <input type="radio" name="status_equip" id='desativo' value='Desativo'>Desativado
                    </label>

                </div>



            </div>

            <div class="imagem">
                <p class="imagem2">Insira uma imagem</p>
                <input class="imagem3" type="file" id="imagemUpload" name="imagemUpload" accept="image/*">
            </div>


            <div>
                <button type="submit" class="salvar" name="salvar" id='salvar'><svg xmlns="http://www.w3.org/2000/svg"
                        height="21" width="23"
                        viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path fill="#000000"
                            d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V173.3c0-17-6.7-33.3-18.7-45.3L352 50.7C340 38.7 323.7 32 306.7 32H64zm0 96c0-17.7 14.3-32 32-32H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V128zM224 288a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                    </svg> SALVAR</button>
                <button type="reset" class="salvar-1"><svg xmlns="http://www.w3.org/2000/svg" height="21" width="23"
                        viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path fill="#000000"
                            d="M290.7 57.4L57.4 290.7c-25 25-25 65.5 0 90.5l80 80c12 12 28.3 18.7 45.3 18.7H288h9.4H512c17.7 0 32-14.3 32-32s-14.3-32-32-32H387.9L518.6 285.3c25-25 25-65.5 0-90.5L381.3 57.4c-25-25-65.5-25-90.5 0zM297.4 416H288l-105.4 0-80-80L227.3 211.3 364.7 348.7 297.4 416z" />
                    </svg> APAGAR</button>
            </div>


            </form>
        </div>
    </div>
</div>