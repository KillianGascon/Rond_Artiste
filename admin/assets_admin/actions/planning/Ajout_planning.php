<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Stop le pirate !");
}

$date_debut = filter_input(INPUT_POST, "date_debut", FILTER_SANITIZE_SPECIAL_CHARS);
$date_fin = filter_input(INPUT_POST, "date_fin", FILTER_SANITIZE_SPECIAL_CHARS);
$id_galerie = filter_input(INPUT_POST, "id_galerie", FILTER_SANITIZE_SPECIAL_CHARS);
$id_oeuvres = filter_input(INPUT_POST, "id_oeuvres", FILTER_SANITIZE_SPECIAL_CHARS);
$id_planning = filter_input(INPUT_POST, "id_planning", FILTER_SANITIZE_SPECIAL_CHARS);

include_once "../../../../config.php";

$sql = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);

// Vérifier s'il existe déjà un planning pour une autre œuvre dans la même période, à l'exception de l'œuvre actuelle
$requete = $sql->prepare("SELECT * FROM planning WHERE id_oeuvre != :id_oeuvres AND ((date_debut BETWEEN :date_debut AND :date_fin) OR (date_fin BETWEEN :date_debut AND :date_fin)) AND id_planning != :id_planning");
$requete->bindParam(":id_oeuvres", $id_oeuvres);
$requete->bindParam(":date_debut", $date_debut);
$requete->bindParam(":date_fin", $date_fin);
$requete->bindParam(":id_planning", $id_planning);
$requete->execute();
$planning_exist = $requete->fetch(PDO::FETCH_ASSOC);

if ($planning_exist) {
    echo "<script>alert('Il existe déjà un planning pour une autre œuvre dans cette période.'); window.location.href = '../../../oeuvres/oeuvres_admin.php';</script>";
} else {
    // Insérer dans la table planning
    $requete = $sql->prepare("INSERT INTO planning(`date_debut`, `date_fin`, `id_galerie`, `id_oeuvre`) VALUES (:date_debut, :date_fin, :id_galerie, :id_oeuvres)");
    $requete->bindParam(":date_debut", $date_debut);
    $requete->bindParam(":date_fin", $date_fin);
    $requete->bindParam(":id_galerie", $id_galerie);
    $requete->bindParam(":id_oeuvres", $id_oeuvres);
    $requete->execute();

    echo "<script>alert('Planning ajouté avec succès.'); window.location.href = '../../../oeuvres/oeuvres_admin.php';</script>";
}
