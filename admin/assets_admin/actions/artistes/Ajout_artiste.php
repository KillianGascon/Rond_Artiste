<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Stop le pirate !");
}

$nom_artiste = filter_input(INPUT_POST, "nom_artiste", FILTER_SANITIZE_SPECIAL_CHARS);
$prenom_artiste = filter_input(INPUT_POST, "prenom_artiste", FILTER_SANITIZE_SPECIAL_CHARS);
$pseudo_artiste = filter_input(INPUT_POST, "pseudo_artiste", FILTER_SANITIZE_SPECIAL_CHARS);
$nationalite_artiste = filter_input(INPUT_POST, "nationalite_artiste", FILTER_SANITIZE_SPECIAL_CHARS);
$description_artiste = filter_input(INPUT_POST, "description_artiste", FILTER_SANITIZE_SPECIAL_CHARS);
$style_oeuvres = filter_input(INPUT_POST, "style_oeuvres", FILTER_SANITIZE_SPECIAL_CHARS);
$telephone_artiste = filter_input(INPUT_POST, "telephone_artiste", FILTER_SANITIZE_SPECIAL_CHARS);
$mail_artiste = filter_input(INPUT_POST, "mail_artiste", FILTER_SANITIZE_SPECIAL_CHARS);
$lien_rs_artiste = filter_input(INPUT_POST, "lien_rs_artiste", FILTER_SANITIZE_SPECIAL_CHARS);


$target_dir = "../../photos_profils/";
$file=basename($_FILES["chemin_pp"]["name"]);
$target_file = $target_dir . $file;


if (!move_uploaded_file($_FILES["chemin_pp"]["tmp_name"], $target_file)) {
    die("Erreur lors du téléchargement du fichier.");
}

include_once "../../../../config.php";

$pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);


$requete = $pdo->prepare("SELECT * FROM artistes WHERE pseudo_artiste = :pseudo_artiste");
$requete->bindParam(":pseudo_artiste", $pseudo_artiste);
$requete->execute();
$artiste = $requete->fetch(PDO::FETCH_ASSOC);

if ($artiste) {
    die("Erreur : L'Artiste est déjà existant");
} else {
    $requete = $pdo->prepare("INSERT INTO artistes(`nom_artiste`, `prenom_artiste`, `pseudo_artiste`, `nationalite_artiste`, `description_artiste`, `style_oeuvres`, `telephone_artiste`, `mail_artiste`, `lien_rs_artiste`, `chemin_pp`) VALUES (:nom_artiste, :prenom_artiste, :pseudo_artiste, :nationalite_artiste, :description_artiste, :style_oeuvres, :telephone_artiste, :mail_artiste, :lien_rs_artiste, :chemin_pp)");
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


    echo "<script>alert('L\'artiste a bien été ajouté !'); window.location.href = '../../../artistes/artistes_admin.php';</script>";
}

?>
