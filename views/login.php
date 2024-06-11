<?php $this->layout("base", $data);  ?>

<link rel="stylesheet" href="<?= CONF_URL_BASE ?>/views/assets/css/styles.css" />
<div class="conteudo_login">

    <div class="formulario_login">
        <img src="/tcc2/views/assets/images/lock.svg" class="lock" alt="">
        <p class="formulario-text"><b>Login</b></p>
        <div class="form-group-login">
            <form class="auth_form" action="<?= CONF_URL_BASE ?>/entrar" method="post" enctype="multipart/form-data">

                <input type="email" name="email" class="form-control login" placeholder="Usuário:" required>
                <input type="password" name="password" class="form-control login" placeholder="Senha:" required>
                <div class="botao_meio">
                    <button class="auth_form_btn btn btn-danger">ENTRAR</button>
                </div>
            </form>
        </div>
    </div>
</div>