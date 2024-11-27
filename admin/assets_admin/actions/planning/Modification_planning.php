<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Stop le pirate !");
}

$date_debut = filter_input(INPUT_POST, "date_debut", FILTER_SANITIZE_SPECIAL_CHARS);
$date_fin = filter_input(INPUT_POST, "date_fin", FILTER_SANITIZE_SPECIAL_CHARS);
$id_planning = filter_input(INPUT_POST, "id_planning", FILTER_SANITIZE_SPECIAL_CHARS);

include_once "../../../../config.php";

$sql = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);

// Récupérer l'ID de l'oeuvre associée au planning
$requete = $sql->prepare("SELECT id_oeuvre FROM planning WHERE id_planning = :id_planning");
$requete->bindParam(":id_planning", $id_planning);
$requete->execute();
$resultat = $requete->fetch(PDO::FETCH_ASSOC);

if (!$resultat) {
    die("Le planning n'a pas été trouvé dans la base de données.");
}

$id_oeuvre = $resultat['id_oeuvre'];

// Mettre à jour le planning avec l'ID de l'oeuvre associée
$requete = $sql->prepare("UPDATE planning SET date_debut = :date_debut, date_fin = :date_fin WHERE id_planning = :id_planning");
$requete->bindParam(":date_debut", $date_debut);
$requete->bindParam(":date_fin", $date_fin);
$requete->bindParam(":id_planning", $id_planning);
$requete->execute();

echo "planning modifié avec succès !";
header("Location: ../../../oeuvres/oeuvres_admin.php");
?>
