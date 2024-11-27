<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Stop le pirate !");
}

$id_galerie = filter_input(INPUT_POST, 'id_galerie', FILTER_SANITIZE_NUMBER_INT);
$id_galerie = $id_galerie !== false ? $id_galerie : ''; // Vérification et assignation par défaut

$nom_galerie = filter_input(INPUT_POST, 'nom_galerie', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$telephone_galerie = filter_input(INPUT_POST, 'telephone_galerie', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$mail_galerie = filter_input(INPUT_POST, 'mail_galerie', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$nom_dirigeant = filter_input(INPUT_POST, 'nom_dirigeant', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$ville_galerie = filter_input(INPUT_POST, 'ville_galerie', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$cp_galerie = filter_input(INPUT_POST, 'cp_galerie', FILTER_SANITIZE_NUMBER_INT);
$rue_galerie = filter_input(INPUT_POST, 'rue_galerie', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


include_once '../../../../config.php';

$pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);

$requete = $pdo->prepare("UPDATE galerie SET nom_galerie = :nom_galerie, telephone_galerie = :telephone_galerie, mail_galerie = :mail_galerie, nom_dirigeant = :nom_dirigeant, ville_galerie = :ville_galerie, cp_galerie = :cp_galerie, rue_galerie = :rue_galerie WHERE id_galerie = :id_galerie");
$requete->bindParam(':id_galerie', $id_galerie);
$requete->bindParam(":nom_galerie", $nom_galerie);
$requete->bindParam(":telephone_galerie", $telephone_galerie);
$requete->bindParam(":mail_galerie", $mail_galerie);
$requete->bindParam(":nom_dirigeant", $nom_dirigeant);
$requete->bindParam(":ville_galerie", $ville_galerie);
$requete->bindParam(":cp_galerie", $cp_galerie);
$requete->bindParam(":rue_galerie", $rue_galerie);
$requete->execute();

//var_dump($id_galerie);
//var_dump($nom_galerie);
//var_dump($telephone_galerie);
//var_dump($mail_galerie);
//var_dump($nom_dirigeant);
//var_dump($ville_galerie);
//var_dump($cp_galerie);
//var_dump($rue_galerie);
echo "galerie modifié avec Panache !";
header("Location: ../../../galeries/galeries_admin.php");
?>
