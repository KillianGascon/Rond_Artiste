<?php
include_once '../header_admin.php';
include_once '../../config.php';

// Connexion à la base de données
$pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);

$requete = $pdo->prepare("SELECT * FROM galerie");
$requete->execute();
$galeries = $requete->fetchAll(PDO::FETCH_ASSOC);

$requete = $pdo->prepare("SELECT * FROM oeuvre");
$requete->execute();
$oeuvres = $requete->fetchAll(PDO::FETCH_ASSOC);

?>

Ajout d'un planning

<form method="post" action="../assets_admin/actions/planning/Ajout_planning.php" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="date_debut" class="form-label">Date de Début :</label>
        <input type="date" id="date_debut" name="date_debut" class="form-control" placeholder="Date de Début">
    </div>
    <div class="mb-3">
        <label for="date_fin" class="form-label">Date de Fin :</label>
        <input type="date" id="date_fin" name="date_fin" class="form-control" placeholder="Date de fin">
    </div>
    <div class="mb-3">
        <label for="titre_oeuvre" class="form-label">Nom de la galerie :</label>
        <select id="id_galerie" name="id_galerie" class="form-select">
        <?php foreach ($galeries as $galerie): ?>
                <option value="<?= $galerie["id_galerie"] ?>" ><?= $galerie["nom_galerie"] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <input type="hidden" name="id_oeuvres" value="<?php echo htmlentities($_GET['id_oeuvres'])?>">

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<button type="button" class="btn btn-secondary" style="margin-top: 10px;" > <a style="text-decoration: none; margin-top:10%; color: white; " href="../oeuvres/oeuvres_admin.php">< Retour</a> </button>
