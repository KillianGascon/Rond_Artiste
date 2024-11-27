<?php
include_once '../header_admin.php';
include_once '../../config.php';

$pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);

$requete = $pdo->prepare("SELECT * FROM planning WHERE id_planning = :id_planning");
$requete->bindParam(":id_planning", $_GET["id_planning"]);
$requete->execute();
$planning = $requete->fetch(PDO::FETCH_ASSOC);

$requete = $pdo->prepare("SELECT * FROM galerie");
$requete->execute();
$galeries = $requete->fetchAll(PDO::FETCH_ASSOC);

$requete = $pdo->prepare("SELECT * FROM oeuvre");
$requete->execute();
$oeuvres = $requete->fetchAll(PDO::FETCH_ASSOC);


?>

<body>

<form action="../assets_admin/actions/planning/Modification_planning.php" method="post" >

    <h5>Modifier Le Planning</h5>

    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Date De Début du planning :</label>
        <input class="form-control"  type="text" id="date_debut" name="date_debut" value="<?php echo $planning['date_debut']; ?>">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Date de Fin du Planning :</label>
        <input class="form-control"  type="text" id="date_fin" name="date_fin" value="<?php echo $planning['date_fin']; ?>">
    </div>



    <input type="hidden" name="id_planning" value="<?php echo $planning['id_planning']; ?>">

    <button type="submit" class="butnajout">Modifier</button>
    <button class="exit"><a href="../oeuvres/oeuvres_admin.php">Annuler</a></button>
</form>

</body>
