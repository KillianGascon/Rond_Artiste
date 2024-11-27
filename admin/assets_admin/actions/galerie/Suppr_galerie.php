<?php
$title = "Suppression Produit";
include_once "../../../../header_admin.php";
include_once "../../../../config.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Stop le pirate !");
}

$pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);
$requete = $pdo->prepare("DELETE FROM galerie WHERE id_galerie = :id_galerie");
$requete->bindParam(":id_galerie", $_POST["id_galerie"]);
$requete->execute();
header("Location: ../../../galeries/galeries_admin.php");
