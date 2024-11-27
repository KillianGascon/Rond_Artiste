<?php

$title = "Ajout de galerie";


if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Stop le pirate !");
}


$nom_galerie = filter_input(INPUT_POST, "nom_galerie", FILTER_SANITIZE_SPECIAL_CHARS);
$telephone_galerie = filter_input(INPUT_POST, "telephone_galerie", FILTER_SANITIZE_SPECIAL_CHARS);
$mail_galerie = filter_input(INPUT_POST, "mail_galerie", FILTER_SANITIZE_SPECIAL_CHARS);
$nom_dirigeant = filter_input(INPUT_POST, "nom_dirigeant", FILTER_SANITIZE_SPECIAL_CHARS);
$ville_galerie = filter_input(INPUT_POST, "ville_galerie", FILTER_SANITIZE_SPECIAL_CHARS);
$cp_galerie = filter_input(INPUT_POST, "cp_galerie", FILTER_SANITIZE_SPECIAL_CHARS);
$rue_galerie = filter_input(INPUT_POST, "rue_galerie", FILTER_SANITIZE_SPECIAL_CHARS);


//$actif = isset($_POST["actif"]) ? 1 : 0;
//if (empty($nom) || empty($numero) || empty($immatriculation)) {
//    die("Erreur : Merci de remplir tous les champs");
//}

include_once "../../../../config.php";


$pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);

//On vérifie que l'immatriculation n'est pas déja existante

$requete = $pdo->prepare("SELECT * FROM galerie WHERE mail_galerie = :mail_galerie");

//Si l'immatriculation est déja existante on affiche un message d'erreur

$requete->bindParam(":mail_galerie", $mail_galerie);

$requete->execute();

$galerie = $requete->fetch(PDO::FETCH_ASSOC);

if ($galerie) {

    die("Erreur : La galerie est déja existante");

}
else {

    $pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);

//On Vérifie que le numéro rentré n'est pas déja existant

    $requete = $pdo->prepare("SELECT * FROM galerie WHERE telephone_galerie = :telephone_galerie");

//Si le numéro est déja existant on affiche un message d'erreur

    $requete->bindParam(":telephone_galerie", $telephone_galerie);

    $requete->execute();

    $galeries = $requete->fetch(PDO::FETCH_ASSOC);

    if ($galeries) {

        die("Erreur : La galerie est déja existante");

    } else {

        $pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE
        );

        $requete = $pdo->prepare("INSERT INTO galerie(`nom_galerie`, `telephone_galerie`, `mail_galerie`, `nom_dirigeant`, `ville_galerie`, `cp_galerie`, `rue_galerie`) VALUES (:nom_galerie, :telephone_galerie, :mail_galerie, :nom_dirigeant, :ville_galerie, :cp_galerie, :rue_galerie)");
//on ajoute les paramètres
        $requete->bindParam(":nom_galerie", $nom_galerie);
        $requete->bindParam(":telephone_galerie", $telephone_galerie);
        $requete->bindParam(":mail_galerie", $mail_galerie);
        $requete->bindParam(":nom_dirigeant", $nom_dirigeant);
        $requete->bindParam(":ville_galerie", $ville_galerie);
        $requete->bindParam(":cp_galerie", $cp_galerie);
        $requete->bindParam(":rue_galerie", $rue_galerie);

        $requete->execute();

        header("Location: ../../../galeries/galeries_admin.php");
        echo ("La galerie a bien été ajoutée");
    }
}

