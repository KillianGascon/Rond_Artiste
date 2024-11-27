<?php
include_once '../header_admin.php';
include_once '../../config.php';
?>

<body>
<form method="post" action="../assets_admin/actions/galerie/Suppr_galerie.php" enctype="multipart/form-data">
    <h5>Supprimer le produit</h5>
    <input type="hidden" name="id_galerie" value="<?php echo $_GET['id_galerie']?>">
    <button class="butnajout" type="submit">Confirmer</button>
    <button class="exit"><a href="galeries_admin.php">Annuler</a></button>
</form>
</body>