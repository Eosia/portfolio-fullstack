<?php 
ob_start(); 
?>

<div class="row">
    <div class="col-4">
        <img src="<?= URL ?>public/images/<?= $realisation->getImage(); ?>">
    </div>
    <div class="col-4">
        <p>Titre : <?= $realisation->getTitre(); ?></p>
    </div>
    <div class="col-4">
        <p>Lien du site : <?= $realisation->getLien(); ?></p>
    </div>
</div>

<?php
$content = ob_get_clean();
$titre = $realisation->getTitre();
$lien = $realisation->getLien();
require "template.php";
?>