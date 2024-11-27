<?php

$title = "Suppression Planning";
include_once "../../../../header_admin.php";
include_once "../../../../config.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Stop le pirate !");
}

$pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);
$requete = $pdo->prepare("DELETE FROM planning WHERE id_planning = :id_planning");
$requete->bindParam(":id_planning", $_POST["id_planning"]);
$requete->execute();
header("Location: ../../../oeuvres/oeuvres_admin.php");
