<?php
include_once '../header_admin.php';
include_once '../../config.php';

$pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);

$requete = $pdo->prepare("SELECT * FROM oeuvre WHERE id_oeuvres = :id_oeuvres");
$requete->bindParam(":id_oeuvres", $_GET["id_oeuvres"]);
$requete->execute();
$oeuvre = $requete->fetch(PDO::FETCH_ASSOC);

$pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);
$requete = $pdo->query("SHOW COLUMNS FROM oeuvre WHERE Field = 'type_oeuvre'");
$row = $requete->fetch(PDO::FETCH_ASSOC);
$enum_values = explode(",", str_replace("'", "", substr($row['Type'], 5, (strlen($row['Type'])-6))));
?>

<body>

<form action="../assets_admin/actions/oeuvre/Modification_oeuvre.php" method="post" >
    <h5>Modifier L'Oeuvre</h5>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Titre de L'Oeuvre :</label>
        <input class="form-control"  type="text" id="titre_oeuvre" name="titre_oeuvre" value="<?php echo $oeuvre['titre_oeuvre']?>">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Description de L'Oeuvre :</label>
        <input class="form-control"  type="text" id="description_oeuvre" name="description_oeuvre" value="<?php echo $oeuvre['description_oeuvre']?>">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Hauteur de L'Oeuvre :</label>
        <input class="form-control"  type="number" id="hauteur_oeuvre" name="hauteur_oeuvre" value="<?php echo $oeuvre['hauteur_oeuvre']?>">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Longueur de L'Oeuvre :</label>
        <input class="form-control"  type="number" id="longueur_oeuvres" name="longueur_oeuvres" value="<?php echo $oeuvre['longueur_oeuvres']?>">
    </div>
    <div class="mb-3">
        <label for="vendu_oeuvre" class="form-label">Vendu Oeuvre :</label>
        <select id="vendu_oeuvre" name="vendu_oeuvre" class="form-select">
            <option value="oui" <?php if($oeuvre['vendu_oeuvre'] == 1) echo 'selected'; ?>>Oui</option>
            <option value="non" <?php if($oeuvre['vendu_oeuvre'] == 0) echo 'selected'; ?>>Non</option>
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
    <input type="hidden" name="id_oeuvres" value="<?php echo $oeuvre['id_oeuvres']?>">

    <button type="submit" class="butnajout">Modifier</button>
    <button class="exit"><a href="oeuvres_admin.php">Annuler</a></button>
</form>

</body>