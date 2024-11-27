
<!--Confirmation de suppression de l'oeuvre-->

<?php
include_once '../header_admin.php';
include_once '../../config.php';
?>

<body>
<form method="post" action="../assets_admin/actions/artistes/Suppr_artiste.php" enctype="multipart/form-data">
    <h5>Supprimer l'Artiste</h5>
    <input type="hidden" name="id_artiste" value="<?php echo $_GET['id_artiste']?>">
    <button class="butnajout" type="submit">Confirmer</button>
    <button class="exit"><a href="artistes_admin.php">Annuler</a></button>
</form>
</body>