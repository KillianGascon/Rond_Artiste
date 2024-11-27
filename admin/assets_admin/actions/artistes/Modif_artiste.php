<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Stop le pirate !");
}

include_once '../../../../config.php';

$id_artiste = filter_input(INPUT_POST, 'id_artiste', FILTER_SANITIZE_NUMBER_INT);
$nom_artiste = filter_input(INPUT_POST, "nom_artiste", FILTER_SANITIZE_SPECIAL_CHARS);
$prenom_artiste = filter_input(INPUT_POST, "prenom_artiste", FILTER_SANITIZE_SPECIAL_CHARS);
$pseudo_artiste = filter_input(INPUT_POST, "pseudo_artiste", FILTER_SANITIZE_SPECIAL_CHARS);
$nationalite_artiste = filter_input(INPUT_POST, "nationalite_artiste", FILTER_SANITIZE_SPECIAL_CHARS);
$description_artiste = filter_input(INPUT_POST, "description_artiste", FILTER_SANITIZE_SPECIAL_CHARS);
$style_oeuvres = filter_input(INPUT_POST, "style_oeuvres", FILTER_SANITIZE_SPECIAL_CHARS);
$telephone_artiste = filter_input(INPUT_POST, "telephone_artiste", FILTER_SANITIZE_SPECIAL_CHARS);
$mail_artiste = filter_input(INPUT_POST, "mail_artiste", FILTER_SANITIZE_SPECIAL_CHARS);
$lien_rs_artiste = filter_input(INPUT_POST, "lien_rs_artiste", FILTER_SANITIZE_SPECIAL_CHARS);
$chemin_pp = filter_input(INPUT_POST, "chemin_pp", FILTER_SANITIZE_SPECIAL_CHARS);

$pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);
var_dump($_FILES["chemin_pp"]["name"]=="");
if ($_FILES["chemin_pp"]["name"] == "") {
    $requete = $pdo->prepare("SELECT * FROM artistes WHERE id_artiste = :id_artiste");
    $requete->bindParam(":id_artiste", $id_artiste);
    $requete->execute();
    $artiste = $requete->fetchAll(PDO::FETCH_ASSOC);
    $file = $artiste[0]['chemin_pp'];


} else {
    $target_dir = "../../photos_profils/";
    $file=basename($_FILES["chemin_pp"]["name"]);
    $target_file = $target_dir . $file;


    if (!move_uploaded_file($_FILES["chemin_pp"]["tmp_name"], $target_file)) {
        die("Erreur lors du téléchargement du fichier.");
    }
}

$requete = $pdo->prepare("UPDATE artistes SET nom_artiste = :nom_artiste, prenom_artiste = :prenom_artiste, pseudo_artiste = :pseudo_artiste, nationalite_artiste = :nationalite_artiste, description_artiste = :description_artiste, style_oeuvres = :style_oeuvres, telephone_artiste = :telephone_artiste, mail_artiste = :mail_artiste, lien_rs_artiste = :lien_rs_artiste, chemin_pp = :chemin_pp WHERE id_artiste = :id_artiste");
$requete->bindParam(':id_artiste', $id_artiste);
$requete->bindParam(":nom_artiste", $nom_artiste);
$requete->bindParam(":prenom_artiste", $prenom_artiste);
$requete->bindParam(":pseudo_artiste", $pseudo_artiste);
$requete->bindParam(":nationalite_artiste", $nationalite_artiste);
$requete->bindParam(":description_artiste", $description_artiste);
$requete->bindParam(":style_oeuvres", $style_oeuvres);
$requete->bindParam(":telephone_artiste", $telephone_artiste);
$requete->bindParam(":mail_artiste", $mail_artiste);
$requete->bindParam(":lien_rs_artiste", $lien_rs_artiste);
$requete->bindParam(":chemin_pp", $file);
$requete->execute();


echo "Artiste modifié avec Panache !";
header("Location: ../../../artistes/artistes_admin.php");
?>
