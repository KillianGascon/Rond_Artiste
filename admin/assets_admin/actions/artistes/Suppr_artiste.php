<?php

$title = "Suppression Artiste";
include_once "../../../../header_admin.php";
include_once "../../../../config.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Stop le pirate !");
}

$pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);
$requete = $pdo->prepare("DELETE FROM artistes WHERE id_artiste = :id_artiste");
$requete->bindParam(":id_artiste", $_POST["id_artiste"]);
$requete->execute();
header("Location: ../../../artistes/artistes_admin.php");
