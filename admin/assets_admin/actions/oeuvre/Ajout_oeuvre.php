<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Stop le pirate !");
}

$titre_oeuvre = filter_input(INPUT_POST, "titre_oeuvre", FILTER_SANITIZE_SPECIAL_CHARS);
$description_oeuvre = filter_input(INPUT_POST, "description_oeuvre", FILTER_SANITIZE_SPECIAL_CHARS);
$hauteur_oeuvre = filter_input(INPUT_POST, "hauteur_oeuvre", FILTER_SANITIZE_SPECIAL_CHARS);
$longueur_oeuvres = filter_input(INPUT_POST, "longueur_oeuvres", FILTER_SANITIZE_SPECIAL_CHARS);
$vendu_oeuvre = filter_input(INPUT_POST, "vendu_oeuvre", FILTER_SANITIZE_SPECIAL_CHARS);
$type_oeuvre = filter_input(INPUT_POST, "type_oeuvre", FILTER_SANITIZE_SPECIAL_CHARS);
$pseudo_artiste = filter_input(INPUT_POST, "pseudo_artiste", FILTER_SANITIZE_SPECIAL_CHARS);

$vendu_oeuvre_num = ($vendu_oeuvre == "oui") ? 1 : 0;

$target_dir = "../../photos_oeuvres/";
$extension = strtolower(pathinfo($_FILES["chemin_image_media"]["name"], PATHINFO_EXTENSION));
$file = uniqid() . '.' . $extension; // Génère un nom de fichier unique
$target_file = $target_dir . $file;
var_dump($_FILES);
if (!move_uploaded_file($_FILES["chemin_image_media"]["tmp_name"], $target_file)) {
    die("Erreur lors du téléchargement du fichier.");
}

include_once "../../../../config.php";
$pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);

$requete = $pdo->prepare("SELECT id_artiste FROM artistes WHERE pseudo_artiste = :pseudo_artiste");
$requete->bindParam(":pseudo_artiste", $pseudo_artiste);
$requete->execute();
$artiste = $requete->fetch(PDO::FETCH_ASSOC);

if (!$artiste) {
    die("L'artiste n'a pas été trouvée dans la base de données.");
}

$requete = $pdo->prepare("SELECT * FROM oeuvre WHERE titre_oeuvre = :titre_oeuvre");
$requete->bindParam(":titre_oeuvre", $titre_oeuvre);
$requete->execute();
$oeuvre = $requete->fetch(PDO::FETCH_ASSOC);

if ($oeuvre) {
    die("Erreur : L'oeuvre existe déjà.");
} else {
    $requete = $pdo->prepare("INSERT INTO oeuvre(`titre_oeuvre`, `description_oeuvre`, `hauteur_oeuvre`, `longueur_oeuvres`, `vendu_oeuvre`, `type_oeuvre`, `likes_oeuvre`, `dislikes_oeuvres`, `id_artiste`) VALUES (:titre_oeuvre, :description_oeuvre, :hauteur_oeuvre, :longueur_oeuvres, :vendu_oeuvre, :type_oeuvre, 0, 0, :id_artiste)");
    $requete->bindParam(":titre_oeuvre", $titre_oeuvre);
    $requete->bindParam(":description_oeuvre", $description_oeuvre);
    $requete->bindParam(":hauteur_oeuvre", $hauteur_oeuvre);
    $requete->bindParam(":longueur_oeuvres", $longueur_oeuvres);
    $requete->bindParam(":vendu_oeuvre", $vendu_oeuvre_num);
    $requete->bindParam(":type_oeuvre", $type_oeuvre);
    $requete->bindParam(":id_artiste", $artiste["id_artiste"]);
    $requete->execute();

    $id_oeuvre = $pdo->lastInsertId();
    $requete = $pdo->prepare("INSERT INTO media(`chemin_image_media`, `id_oeuvre`) VALUES (:chemin_image_media, :id_oeuvre)");
    $requete->bindParam(":chemin_image_media", $file);
    $requete->bindParam(":id_oeuvre", $id_oeuvre);
    $requete->execute();

    header("Location: ../../../oeuvres/oeuvres_admin.php");
    echo ("L'oeuvre a bien été ajoutée");
}
?>
