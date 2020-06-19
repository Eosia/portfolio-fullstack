<?php
ob_start();
?>

<form method="POST" action="<?= URL ?>services/mv" enctype="multipart/form-data">
    <div class="form-group">
        <label for="titre">Titre du service : </label>
        <input type="text" class="form-control" id="titre" name="titre" value="<?= $service->getTitre() ?>">
    </div>
    <div class="form-group">
        <label for="lien">Message : </label>
        <input type="text" class="form-control" id="lien" name="lien" value="<?= $service->getLien() ?>">
    </div>
    <h3>Images : </h3>
    <img class="col-10" src="<?= URL ?>public/images/<?= $service->getImage() ?>">
    <div class="form-group">
        <label for="image">Changer l'image : </label>
        <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <input type="hidden" name="identifiant" value="<?= $service->getId(); ?>">
    <button type="submit" class="btn btn-primary">Valider</button>
</form>

<?php
$content = ob_get_clean();
$titre = "Modification d'une service : ".$service->getId();
require "template.php";
?>