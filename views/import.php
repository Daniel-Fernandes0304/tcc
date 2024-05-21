<?php
    $this->layout("base", $data);
    use Source\Models\TableData;
    use Source\Models\Login;

    $tipo = Login::user()->tipo;
    
    $msg = '';

    if(isset($_POST['ver'])) {
        $arquivo = $_FILES['arquivo'];

        if($arquivo['type'] == 'text/csv'){

            $dados_arquivo = fopen($arquivo['tmp_name'], "r");

            while($linha = fgetcsv($dados_arquivo, 1000, ";")) {
                
                echo "Nº invent: " . mb_convert_encoding($linha[0], "UTF-8", "ISO-8859-1") . "<br>";
                echo "Dt.incorp: " . mb_convert_encoding($linha[1], "UTF-8", "ISO-8859-1") . "<br>";
                echo "Denominação do imobilizado: " . mb_convert_encoding($linha[2], "UTF-8", "ISO-8859-1") . "<br>";
                echo "Localização: " . mb_convert_encoding($linha[3], "UTF-8", "ISO-8859-1") . "<br>";
                echo "Ambiente: " . mb_convert_encoding($linha[4], "UTF-8", "ISO-8859-1") . "<br>";
                echo "Código: " . mb_convert_encoding($linha[5], "UTF-8", "ISO-8859-1") . "<br>";
                echo "<hr>";
            }
        } else {
            $msg = 'Necessário enviar arquivo .csv';
        }
    
    }

    if(isset($_POST["import"])){
        $arquivo = $_FILES['arquivo'];

        if($arquivo['type'] == 'text/csv'){
            
            $dados_arquivo = fopen($arquivo['tmp_name'], "r");

            while($linha = fgetcsv($dados_arquivo, 1000, ";")) {

            $objTableData = new TableData();
          
            $objTableData->num_invent = $linha[0];
            $objTableData->dt_incorp = date('Y-m-d',strtotime($linha[1]));
            $objTableData->nome_equipamento = mb_convert_encoding($linha[2], 'UTF-8', "ISO-8859-1");
            $objTableData->localizacao = $linha[3];
            $objTableData->ambiente = mb_convert_encoding($linha[4], 'UTF-8', "ISO-8859-1");
            $objTableData->codigo = $linha[5];
            $objTableData->status = 'a';
            $objTableData->equip_emprestado = 'a';
            $objTableData->descricao = 'a';
            $objTableData->observacoes = 'a';
            $objTableData->tag = '2';
            $objTableData->valor = '2';
            $objTableData->serie = '2';
            $objTableData->marca = 'a';
            $objTableData->bloco = 'a';
            $objTableData->instituicao = 'a';
            
            $objTableData->save();
            $msg = 'Importado com sucesso';
            }
        redirect('/import/');
        } else {
           $msg = 'Necessário enviar arquivo .csv';
        }
    } 

    if($_SESSION['nivelAcesso'] !== '1') {
        redirect('/home/'); // Redireciona o usuário para uma página de erro ou login
        exit; // Impede a execução de mais scripts
    }
?>
<!--FEATURED-->
<link rel="stylesheet" href="<?= CONF_URL_BASE ?>/views/assets/css/importar.css"/> <!-- Esse link é usado para vincular o arquivo CSS ao documento HTML -->
<div class="conteudo_home"> 
<div class="sidebar">
            <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none"
                onclick="toggleMenu()">
                <span class="fs-4">Menu</span>
            </a>
            
            <ul id="menuItems" class="nav nav-pills flex-column mb-auto" style="display: none;"> <!--representa uma lista não ordenada (ul) com o id "menuItems" e classes "nav", "nav-pills", "flex-column" e "mb-auto". Além disso, o estilo "display: none;" está aplicado, o que significa que inicialmente a lista estará oculta na página.-->
                <li class="nav-item">
                    <a href="<?=CONF_URL_BASE?>/import" class="nav-link" onclick="showMenuItem('Importar')">Importar</a> <!--representa um item de lista dentro de um menu de navegação. Quando o link é clicado, a função JavaScript showMenuItem('Importar')  é chamada para exibir o conteúdo relacionado à opção "Importar" no menu.-->
                </li>
                <li class="nav-item">
                    <a href="<?=CONF_URL_BASE?>/novo" class="nav-link" onclick="showMenuItem('Novo')">Novo</a> <!--representa um item de lista dentro de um menu de navegação. Quando o link é clicado, a função JavaScript showMenuItem('Novo')  é chamada para exibir o conteúdo relacionado à opção "Novo" no menu.-->
                </li>
                <li class="nav-item">
                    <a href="<?=CONF_URL_BASE?>/searchequip" class="nav-link" onclick="showMenuItem('Pesquisar')">Pesquisar</a><!--representa um item de lista dentro de um menu de navegação. Quando o link é clicado, a função JavaScript showMenuItem('Pesquisar')  é chamada para exibir o conteúdo relacionado à opção "Pesquisar" no menu.-->
                </li>
                <li class="nav-item">
                    <a href="<?=CONF_URL_BASE?>/usuario" class="nav-link" onclick="showMenuItem('Usuário')">Usuário</a><!--representa um item de lista dentro de um menu de navegação. Quando o link é clicado, a função JavaScript showMenuItem('Usuário')  é chamada para exibir o conteúdo relacionado à opção "Usuário" no menu.-->
                </li>
                <li class="nav-item">
                    <a href="<?=CONF_URL_BASE?>/altsenha" class="nav-link" onclick="showMenuItem('Senha')">Senha</a><!--representa um item de lista dentro de um menu de navegação. Quando o link é clicado, a função JavaScript showMenuItem('Senha')  é chamada para exibir o conteúdo relacionado à opção "Senha" no menu.-->
                </li>

                <li class="nav-item">
                    <a href="<?=CONF_URL_BASE?>/sair" class="nav-link" onclick="showMenuItem('Sair')">Sair</a><!--representa um item de lista dentro de um menu de navegação. Quando o link é clicado, a função JavaScript showMenuItem('Sair')  é chamada para exibir o conteúdo relacionado à opção "Sair" no menu.-->
                </li>

            </ul>

            
        
        <script>
            function toggleMenu() {
                var menu = document.getElementById("menuItems");
                if (menu.style.display === "none") {
                    menu.style.display = "block";
                } else {
                    menu.style.display = "none";
                }   
            }  
        </script> <!--Quando chamada, essa função verifica se o elemento com o id "menuItems" está visível na página. Se estiver visível, a função o oculta; caso contrário, a função o torna visível. -->
    
</div>
</div>
<div class="formulario_home">


   
<div class="panther">
<p>Insira a tabela que deseja Importar:</p>
    <form action=""class="auth_form" method="post" name="formulario" enctype="multipart/form-data"> <!-- Este é um formulário HTML que envia dados para a mesma página usando o método POST e permite o envio de arquivos.-->
        <input type="file" name="arquivo" id="arquivo"> <!-- Ele cria um campo de seleção de arquivo que permite aos usuários escolher um arquivo em seus dispositivos para enviar para o servidor quando o formulário for submetido.-->
        <button type="submit" name="ver" class="auth_form_btn import_button1">Analisar <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="24" height="24"> <!-- quando clicado, envia os dados do formulário para o servidor. -->
  <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/>
</svg> <!--Este caminho define um ícone que pode ser renderizado em um navegador da web-->
</button>
            <button type="submit" name="import" id="import" class="auth_form_btn import_button">Importar <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="24" height="24"> <!--esse é outro botão que envia o arquivo para o servidor. -->
  <path d="M128 64c0-35.3 28.7-64 64-64H352V128c0 17.7 14.3 32 32 32H512V448c0 35.3-28.7 64-64 64H192c-35.3 0-64-28.7-64-64V336H302.1l-39 39c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l80-80c9.4-9.4 9.4-24.6 0-33.9l-80-80c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l39 39H128V64zm0 224v48H24c-13.3 0-24-10.7-24-24s10.7-24 24-24H128zM512 128H384V0L512 128z"/>
</svg>
 </button>
    </form>
    </div>
    <?php echo ($msg); ?>
    </div>  
            