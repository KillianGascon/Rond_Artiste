<?php

include_once '../header_admin.php';
include_once '../../config.php';
$pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);
$requete = $pdo->query("SHOW COLUMNS FROM artistes WHERE Field = 'style_oeuvres'");
$row = $requete->fetch(PDO::FETCH_ASSOC);
$enum_values = explode(",", str_replace("'", "", substr($row['Type'], 5, (strlen($row['Type'])-6))));
?>


Ajout d'une Oeuvre


<form method="post" action="../assets_admin/actions/artistes/Ajout_artiste.php" enctype="multipart/form-data">

    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Nom de L'artiste</label>
        <input type="text" id="colFormLabel" name="nom_artiste" class="form-control" placeholder="Nom">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Prenom de l'artiste</label>
        <input type="text" id="colFormLabel" name="prenom_artiste" class="form-control" placeholder="Prenom">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Pseudo de l'artiste</label>
        <input type="text" id="colFormLabel" name="pseudo_artiste" class="form-control" placeholder="Pseudo">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Nationalité de l'artiste</label>
        <input type="text" id="colFormLabel" name="nationalite_artiste" class="form-control" placeholder="Nationalité">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Ville de l'artiste</label>
        <input type="text" id="colFormLabel" name="nationalite_artiste" class="form-control" placeholder="Nationalité">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Description de l'artiste</label>
        <input type="text" id="colFormLabel" name="description_artiste" class="form-control" placeholder="Description">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Style principal des oeuvres</label>
        <select id="style_oeuvres" name="style_oeuvres" class="form-select">
            <?php
            foreach ($enum_values as $value) {
                echo "<option value='$value'>$value</option>";
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Téléphone de l'artiste</label>
        <input type="text" id="colFormLabel" name="telephone_artiste" class="form-control" placeholder="Téléphone">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Mail de l'artiste</label>
        <input type="email" id="colFormLabel" name="mail_artiste" class="form-control" placeholder="Mail">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Lien RS de l'artiste</label>
        <input type="text" id="colFormLabel" name="lien_rs_artiste" class="form-control" placeholder="Lien RS">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Photo de Profil</label>
        <input type="file" id="colFormLabel" name="chemin_pp" class="form-control" placeholder="Photo de Profil">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<button type="button" class="btn btn-secondary" style="margin-top: 10px;" > <a style="text-decoration: none; margin-top:10%; color: white; " href="artistes_admin.php">< Retour</a> </button>