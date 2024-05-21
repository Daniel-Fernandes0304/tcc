<?php
$this->layout("base", $data);
use Source\Models\Login;
$dadosUsuario = $this->user = Login::user();
?>

<article class="auth">
    <div class="auth_content container content">
        <header class="auth_header">
            <?php if(!$dadosUsuario){ ?>
                <h1>Cadastre-se</h1>
            <p>Já tem uma conta? <a title="Entrar" href="<?= CONF_URL_BASE ?>">Fazer login!</a></p>
            <?php } else { ?>
                <h1>Meu Perfil</h1>
            <?php } ?>
            <p style="color: blue"><?=$data['msg'];?></p>
        </header>
        <form class="auth_form" action="" method="post" enctype="multipart/form-data">
            <label>
                <div><span class="icon icon-fsphp-4">* Nome:</span></div>
                <input type="text" name="nome" placeholder="Nome:" value="<?php if(isset($dadosUsuario->nome)) echo $dadosUsuario->nome; ?>" required/>
            </label>

            <label>
                <div><span class="icon icon-fsphp-3">* Email:</span></div>
                <input type="email" name="email" placeholder="Informe seu e-mail:" value="<?php if(isset($dadosUsuario->email)) echo $dadosUsuario->email; ?>" required/>
            </label>

            <label>
                <div class="unlock-alt"><span class="icon-unlock-alt">* Senha:</span></div>
                <input type="password" name="senha" placeholder="Informe sua senha:" value="<?php if(isset($dadosUsuario->senha)) echo $dadosUsuario->senha; ?>" required/>
            </label>
            <?php if(!$dadosUsuario){ ?>
                <button class="auth_form_btn transition gradient gradient-green gradient-hover">Criar conta</button>
            <?php }
            else{ ?>
                <button class="auth_form_btn transition gradient gradient-green gradient-hover">Atualizar conta</button>
            <?php } ?>
        </form>
    </div>
</article>