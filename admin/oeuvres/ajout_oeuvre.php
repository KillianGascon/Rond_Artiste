<?php

include_once '../header_admin.php';
include_once '../../config.php';
$pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);
$requete = $pdo->query("SHOW COLUMNS FROM oeuvre WHERE Field = 'type_oeuvre'");
$row = $requete->fetch(PDO::FETCH_ASSOC);
$enum_values = explode(",", str_replace("'", "", substr($row['Type'], 5, (strlen($row['Type'])-6))));

$requete = $pdo->prepare("SELECT pseudo_artiste FROM artistes");
$requete->execute();
$artiste = $requete->fetchAll(PDO::FETCH_COLUMN);
?>


Ajout d'une Oeuvre


<form method="post" action="../assets_admin/actions/oeuvre/Ajout_oeuvre.php" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Titre de l'Oeuvre</label>
        <input type="text" id="colFormLabel" name="titre_oeuvre" class="form-control" placeholder="Titre de l'Oeuvre">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Description de l'Oeuvre</label>
        <input type="text" id="colFormLabel" name="description_oeuvre" class="form-control" placeholder="Description de l'Oeuvre">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">hauteur de l'Oeuvre</label>
        <input type="int" id="colFormLabel" name="hauteur_oeuvre" class="form-control" placeholder="hauteur de l'oeuvre">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Longueur de l'Oeuvre</label>
        <input type="int" id="colFormLabel" name="longueur_oeuvres" class="form-control" placeholder="Longueur de l'Oeuvre">
    </div>
    <div class="mb-3">
        <label for="vendu_oeuvre" class="form-label">Vendu Oeuvre :</label>
        <select id="vendu_oeuvre" name="vendu_oeuvre" class="form-select">
            <option value="oui">Oui</option>
            <option value="non">Non</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Type de l'Oeuvre</label>
        <select id="type_oeuvre" name="type_oeuvre" class="form-select">
            <?php
            foreach ($enum_values as $value) {
                echo "<option value='$value'>$value</option>";
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="titre_oeuvre" class="form-label">Pseudo de l'artiste :</label>
        <select id="pseudo_artiste" name="pseudo_artiste" class="form-select">
            <?php foreach ($artiste as $artiste): ?>
                <option value="<?= $artiste ?>"><?= $artiste ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Photo de l'Oeuvre</label>
        <input type="file" id="chemin_image_media" name="chemin_image_media" class="form-control" placeholder="Photo de l'Oeuvre">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<button type="button" class="btn btn-secondary" style="margin-top: 10px;" > <a style="text-decoration: none; margin-top:10%; color: white; " href="oeuvres_admin.php">< Retour</a> </button>