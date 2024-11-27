<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Stop le pirate !");
}

$id_oeuvres = filter_input(INPUT_POST, 'id_oeuvres', FILTER_SANITIZE_NUMBER_INT);


$titre_oeuvre = filter_input(INPUT_POST, "titre_oeuvre", FILTER_SANITIZE_SPECIAL_CHARS);
$description_oeuvre = filter_input(INPUT_POST, "description_oeuvre", FILTER_SANITIZE_SPECIAL_CHARS);
$hauteur_oeuvre = filter_input(INPUT_POST, "hauteur_oeuvre", FILTER_SANITIZE_NUMBER_INT);
$longueur_oeuvres = filter_input(INPUT_POST, "longueur_oeuvres", FILTER_SANITIZE_NUMBER_INT);
$vendu_oeuvre = filter_input(INPUT_POST, "vendu_oeuvre", FILTER_SANITIZE_SPECIAL_CHARS);
$type_oeuvre = filter_input(INPUT_POST, "type_oeuvre", FILTER_SANITIZE_SPECIAL_CHARS);

$vendu_oeuvre_num = ($vendu_oeuvre == "oui") ? 1 : 0;

include_once '../../../../config.php';

$pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);

$requete = $pdo->prepare("UPDATE oeuvre SET titre_oeuvre = :titre_oeuvre, description_oeuvre = :description_oeuvre, hauteur_oeuvre = :hauteur_oeuvre, longueur_oeuvres = :longueur_oeuvres, vendu_oeuvre = :vendu_oeuvre, type_oeuvre = :type_oeuvre WHERE id_oeuvres = :id_oeuvres");
$requete->bindParam(':id_oeuvres', $id_oeuvres);
$requete->bindParam(":titre_oeuvre", $titre_oeuvre);
$requete->bindParam(":description_oeuvre", $description_oeuvre);
$requete->bindParam(":hauteur_oeuvre", $hauteur_oeuvre);
$requete->bindParam(":longueur_oeuvres", $longueur_oeuvres);
$requete->bindParam(":vendu_oeuvre", $vendu_oeuvre_num);
$requete->bindParam(":type_oeuvre", $type_oeuvre);
$requete->execute();


//var_dump($id_galerie);
//var_dump($nom_galerie);
//var_dump($telephone_galerie);
//var_dump($mail_galerie);
//var_dump($nom_dirigeant);
//var_dump($ville_galerie);
//var_dump($cp_galerie);
//var_dump($rue_galerie);
echo "oeuvre modifié avec Panache !";
header("Location: ../../../oeuvres/oeuvres_admin.php");
?>
