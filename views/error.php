<?php
$this->layout("base", $data);
?>

<article class="not_found">
    <div class="container content">
        <header class="not_found_header">
            <p class="error">&bull;<?= $data['code']; ?>&bull;</p>
            <h1><?= $data['title']; ?></h1>
            <p><?= $data['description']; ?></p>
        </header>
    </div>
</article>