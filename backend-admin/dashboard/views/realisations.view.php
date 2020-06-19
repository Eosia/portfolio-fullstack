<?php
ob_start();

if(!empty($_SESSION['alert'])) :
?>
<div class="alert alert-<?= $_SESSION['alert']['type'] ?>" role="alert">
    <?= $_SESSION['alert']['msg'] ?>
</div>
<?php
unset($_SESSION['alert']);
endif;
?>

<table class="table text-center">
    <tr class="table-dark">
        <th>Image</th>
        <th>Titre</th>
        <th>Lien</th>
        <th colspan="2">Actions</th>
    </tr>
    <?php
    for($i=0; $i < count($realisations);$i++) :
    ?>
    <tr>
        <td class="align-middle"><img src="public/images/<?= $realisations[$i]->getImage(); ?>" width="60px;"></td>
        <td class="align-middle"><?= $realisations[$i]->getTitre(); ?></td>
        <td class="align-middle"><?= $realisations[$i]->getLien(); ?></td>
        <td class="align-middle"><a href="<?= URL ?>realisations/m/<?= $realisations[$i]->getId(); ?>" class="btn btn-warning">Modifier</a></td>
        <td class="align-middle">
            <form method="POST" action="<?= URL ?>realisations/s/<?= $realisations[$i]->getId(); ?>" onSubmit="return confirm('Voulez-vous vraiment supprimer la realisation ?');">
                <button class="btn btn-danger" type="submit">Supprimer</button>
            </form>
        </td>
    </tr>
    <?php endfor; ?>
</table>
<a href="<?= URL ?>realisations/a" class="btn btn-success d-block">Ajouter</a>

<?php
$content = ob_get_clean();
$titre = "Portfolio Dashboard";
require "template.php";
?>