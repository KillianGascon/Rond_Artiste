
<!--Confirmation de suppression de l'oeuvre-->

<?php
include_once '../header_admin.php';
include_once '../../config.php';
?>

<body>
<form method="post" action="../assets_admin/actions/oeuvre/Suppr_oeuvre.php" enctype="multipart/form-data">
    <h5>Supprimer l'Oeuvre</h5>
    <input type="hidden" name="id_oeuvres" value="<?php echo $_GET['id_oeuvres']?>">
    <button class="butnajout" type="submit">Confirmer</button>
    <button class="exit"><a href="oeuvres_admin.php">Annuler</a></button>
</form>
</body>