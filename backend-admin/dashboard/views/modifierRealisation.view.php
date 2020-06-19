<?php
ob_start();
?>

<form method="POST" action="<?= URL ?>realisations/mv" enctype="multipart/form-data">
    <div class="form-group">
        <label for="titre">Titre : </label>
        <input type="text" class="form-control" id="titre" name="titre" value="<?= $realisation->getTitre() ?>">
    </div>
    <div class="form-group">
        <label for="lien">Titre : </label>
        <input type="text" class="form-control" id="lien" name="lien" value="<?= $realisation->getLien() ?>">
    </div>
    <h3>Images : </h3>
    <img class="col-10" src="<?= URL ?>public/images/<?= $realisation->getImage() ?>">
    <div class="form-group">
        <label for="image">Changer l'image : </label>
        <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <input type="hidden" name="identifiant" value="<?= $realisation->getId(); ?>">
    <button type="submit" class="btn btn-primary">Valider</button>
</form>

<?php
$content = ob_get_clean();
$titre = "Modification d'une realisation : ".$realisation->getId();
require "template.php";
?>