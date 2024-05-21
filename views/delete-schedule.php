<?php $this->layout("base", $data); ?>

<article class="auth">
    <div class="auth_content container content">
        <header class="auth_header">
            <h1>Confirmação de Exclusão de Agendamento</h1>
            <p>Tem certeza que deseja excluir o agendamento abaixo?</p>
        </header>
        <section class="app_launch_box">
            <div class="app_launch_item header">
                <p class="hora">Data</p>
                <p class="category">Horário</p>
                <p class="enrollment">Paciente</p>
            </div>
            <article class="app_launch_item">
                <p class="data"><?= date('d/m/Y', strtotime($data['consulta']->dia)) ?> </p>
                <p class="hora"><?= $data['consulta']->hora ?></p>
                <p class="enrollment"><?= $data['paciente']->nome ?></p>
            </article>
        </section>
        <form class="auth_form" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="dia" id="dia" value="<?= $data['consulta']->dia ?>">
            <input type="hidden" name="id" id="id" value="<?= $data['consulta']->id ?>">
            <button class="auth_form_btn transition gradient gradient-green gradient-hover" name="sim">Sim</button>
            <button class="auth_form_btn transition gradient gradient-red gradient-hover" name="nao">Não</button>
        </form>
    </div>
</article>