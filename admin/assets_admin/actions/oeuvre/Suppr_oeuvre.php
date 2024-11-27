<?php

$title = "Suppression Oeuvre";
include_once "../../../../header_admin.php";
include_once "../../../../config.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Stop le pirate !");
}

$pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);
$requete = $pdo->prepare("DELETE FROM oeuvre WHERE id_oeuvres = :id_oeuvres");
$requete->bindParam(":id_oeuvres", $_POST["id_oeuvres"]);
$requete->execute();
header("Location: ../../../oeuvres/oeuvres_admin.php");
