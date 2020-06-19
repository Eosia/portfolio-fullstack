<?php
ob_start();
?>
<form method="POST" action="<?= URL ?>services/av" enctype="multipart/form-data">
    <div class="form-group">
        <label for="titre">Titre du service : </label>
        <input type="text" class="form-control" id="titre" name="titre">
    </div>
    <div class="form-group">
        <label for="lien">Message : </label>
        <input type="text" class="form-control" id="lien" name="lien">
    </div>
    <div class="form-group">
        <label for="image">Image : </label>
        <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
</form>
<?php
$content = ob_get_clean();
$titre = "Ajout d'un service";
require "template.php";
?>