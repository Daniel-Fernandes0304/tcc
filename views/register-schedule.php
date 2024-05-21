<?php $this->layout("base", $data);
?>

<article class="auth">
    <div class="auth_content container content">
        <header class="auth_header">
            <h1>Agendar Consulta</h1>
            <p>Informe os dados para agendamento.</p>
        </header>

        <form class="auth_form" action="<?= CONF_URL_BASE?>/register-agendamento" method="post" enctype="multipart/form-data">
            <label>
                <input type="text" name="data" value="<?= date('d/m/Y', strtotime($data['data'])) ?>" readonly />
            </label>
            <label>
                <input type="text" name="hora" value="<?= $data['hora'] ?>" readonly />
            </label>
            <label>
                <input type="text" name="paciente" id="paciente" placeholder="Pesquise pelo nome do paciente:" autocomplete="off" required/>
                <span name="resultado-pesquisa" id="resultado-pesquisa"></span>
            </label>
            <label>
                <select name="convenio" id="convenio" class="auth_form" required>
                    <option value="">Escolha o convênio</option>
                    <option value="1">Particular</option>
                    <option value="2">Unimed</option>
                </select>
            </label>
            <label>
                <input type="text" name="observacoes" placeholder="Informe observações sobre o agendamento:" required />
            </label>
                <input type="hidden" id="id" name="id" value="" />
            <button class="auth_form_btn transition gradient gradient-green gradient-hover" name="agendar" id="agendar">Agendar</button>
        </form>
    </div>
</article>
<script src="<?= CONF_URL_BASE ?>/views/assets/js/paciente.js" defer></script>
