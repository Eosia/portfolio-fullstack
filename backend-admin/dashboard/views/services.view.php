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
        <th>Titre  du service</th>
        <th>Message</th>
        <th colspan="2">Actions</th>
    </tr>
    <?php
    for($i=0; $i < count($services);$i++) :
    ?>
    <tr>
        <td class="align-middle"><img src="public/images/<?= $services[$i]->getImage(); ?>" width="60px;"></td>
        <td class="align-middle"><?= $services[$i]->getTitre(); ?></td>
        <td class="align-middle"><?= $services[$i]->getLien(); ?></td>
        <td class="align-middle"><a href="<?= URL ?>services/m/<?= $services[$i]->getId(); ?>" class="btn btn-warning">Modifier</a></td>
        <td class="align-middle">
            <form method="POST" action="<?= URL ?>services/s/<?= $services[$i]->getId(); ?>" onSubmit="return confirm('Voulez-vous vraiment supprimer le service ?');">
                <button class="btn btn-danger" type="submit">Supprimer</button>
            </form>
        </td>
    </tr>
    <?php endfor; ?>
</table>
<a href="<?= URL ?>services/a" class="btn btn-success d-block">Ajouter</a>

<?php
$content = ob_get_clean();
$titre = "Dashboard des services";
require "template.php";
?>