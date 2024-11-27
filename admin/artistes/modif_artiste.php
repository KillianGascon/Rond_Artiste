<?php
include_once '../header_admin.php';
include_once '../../config.php';

$pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);

$requete = $pdo->prepare("SELECT * FROM artistes WHERE id_artiste = :id_artiste");
$requete->bindParam(":id_artiste", $_GET["id_artiste"]);
$requete->execute();
$artiste = $requete->fetch(PDO::FETCH_ASSOC);

$pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);
$requete = $pdo->query("SHOW COLUMNS FROM artistes WHERE Field = 'style_oeuvres'");
$row = $requete->fetch(PDO::FETCH_ASSOC);
$enum_values = explode(",", str_replace("'", "", substr($row['Type'], 5, (strlen($row['Type'])-6))));
?>

<body>

<form action="../assets_admin/actions/artistes/Modif_artiste.php" method="post" enctype="multipart/form-data">


    <h5>Modifier L'Artiste</h5>

    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Nom :</label>
        <input class="form-control"  type="text" id="nom_artiste" name="nom_artiste" value="<?php echo $artiste['nom_artiste']?>">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Prénom :</label>
        <input class="form-control"  type="text" id="prenom_artiste" name="prenom_artiste" value="<?php echo $artiste['prenom_artiste']?>">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Pseudo :</label>
        <input class="form-control"  type="text" id="pseudo_artiste" name="pseudo_artiste" value="<?php echo $artiste['pseudo_artiste']?>">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Nationalité :</label>
        <input class="form-control"  type="text" id="nationalite_artiste" name="nationalite_artiste" value="<?php echo $artiste['nationalite_artiste']?>">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Ville :</label>
        <input class="form-control"  type="text" id="ville_artiste" name="ville_artiste" value="<?php echo $artiste['ville_artiste']?>">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Description :</label>
        <input class="form-control"  type="text" id="description_artiste" name="description_artiste" value="<?php echo $artiste['description_artiste']?>">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Style des Oeuvres :</label>
        <select id="style_oeuvres" name="style_oeuvres" class="form-select">
            <?php
            foreach ($enum_values as $value) {
                echo "<option value='$value'";
                if($artiste['style_oeuvres'] == $value) {
                    echo " selected";
                }
                echo ">$value</option>";
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Téléphone :</label>
        <input class="form-control"  type="text" id="telephone_artiste" name="telephone_artiste" value="<?php echo $artiste['telephone_artiste']?>">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Mail :</label>
        <input class="form-control"  type="email" id="mail_artiste" name="mail_artiste" value="<?php echo $artiste['mail_artiste']?>">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Lien Instagram :</label>
        <input class="form-control"  type="text" id="lien_rs_artiste" name="lien_rs_artiste" value="<?php echo $artiste['lien_rs_artiste']?>">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Photo de Profil</label>
        <img src="../assets_admin/photos_profils/<?php echo $artiste['chemin_pp']?>" style="width: 100px; height: 100px;" alt="Photo de profil">
        <input type="file" id="colFormLabel" name="chemin_pp" class="form-control" placeholder="Photo de Profil">
    </div>


    <input type="hidden" name="id_artiste" value="<?php echo $artiste['id_artiste']?>">

    <button type="submit" class="butnajout">Modifier</button>
    <button class="exit"><a href="artistes_admin.php">Annuler</a></button>
</form>

</body>

