
<?php
include_once '../header_admin.php';
include_once '../../config.php';
?>

<body>
<form method="post" action="../assets_admin/actions/planning/Suppr_planning.php" enctype="multipart/form-data">
    <h5>Supprimer le Planning</h5>
    <input type="hidden" name="id_planning" value="<?php echo $_GET['id_planning']?>">
    <button class="butnajout" type="submit">Confirmer</button>
    <button class="exit"><a href="planning_admin.php">Annuler</a></button>
</form>
</body>