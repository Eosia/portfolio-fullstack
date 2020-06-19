<?php 
ob_start(); 
?>

<div class="row">
    <div class="col-4">
        <img src="<?= URL ?>public/images/<?= $service->getImage(); ?>">
    </div>
    <div class="col-4">
        <p>Titre du service : <?= $service->getTitre(); ?></p>
    </div>
    <div class="col-4">
        <p>Message : <?= $service->getLien(); ?></p>
    </div>
</div>

<?php
$content = ob_get_clean();
$titre = $service->getTitre();
$lien = $service->getLien();
require "template.php";
?>