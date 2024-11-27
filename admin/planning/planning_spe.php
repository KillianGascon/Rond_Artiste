<?php
// Inclure le fichier de configuration et les fonctions nécessaires
include_once '../header_admin.php';
include_once '../../config.php';

$pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);

// Vérifier si l'identifiant de l'œuvre est passé en paramètre
if (!isset($_GET['id_oeuvres'])) {
    // Rediriger vers une autre page si l'identifiant n'est pas fourni
    header("Location: ../index.php");
    exit; // Arrêter l'exécution du script
}

// Récupérer l'identifiant de l'œuvre depuis l'URL
$id_oeuvre = $_GET['id_oeuvres'];

// Requête SQL pour récupérer les informations du planning de l'œuvre spécifiée
$sql = "SELECT * FROM planning WHERE id_oeuvre = :id_oeuvre";

try {
    // Préparer la requête SQL
    $stmt = $pdo->prepare($sql);

    // Liaison des paramètres
    $stmt->bindParam(':id_oeuvre', $id_oeuvre, PDO::PARAM_INT);

    // Exécution de la requête
    $stmt->execute();

    // Récupération des résultats
    $plannings = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Vérifier si le planning existe
    if (!$plannings) {
        echo "Aucun planning trouvé pour cette œuvre.";
        echo "<button><a href='ajout_planning.php?id_oeuvres=$id_oeuvre'>Ajouter un planning</a></button>";
        echo "<button class='btnoe'><a href='../oeuvres/oeuvres_admin.php'>Retour</a></button>";
    } else {
        // Afficher les informations du planning et le titre de l'œuvre
        echo "<h1>Planning de l'œuvre</h1>";
        echo "<div class='Main'>";
        echo "<table>";
        echo "<tr><th>Nom de la Galerie</th><th>Date de Début du planning</th><th>Date de Fin du planning</th><th>Modifier</th><th>Supprimer</th></tr>";
        foreach ($plannings as $planning) {
            echo "<tr>";
            // Récupérer le nom de la galerie à partir de l'ID
            $stmt_galerie = $pdo->prepare("SELECT nom_galerie FROM galerie WHERE id_galerie = :id_galerie");
            $stmt_galerie->bindParam(':id_galerie', $planning['id_galerie'], PDO::PARAM_INT);
            $stmt_galerie->execute();
            $nom_galerie = $stmt_galerie->fetch(PDO::FETCH_ASSOC);
            if ($nom_galerie && isset($nom_galerie['nom_galerie'])) {
                echo "<td>" . $nom_galerie['nom_galerie'] . "</td>";
            } else {
                echo "<td>Information manquante</td>";
            }
            echo "<td>" . $planning['date_debut'] . "</td>";
            echo "<td>" . $planning['date_fin'] . "</td>";
            echo "<td><button class='btnmodif'><a href='modif_planning.php?id_planning=" . $planning['id_planning'] . "'>Modifier</a></button></td>";
            echo "<td><button class='btnsuppr'><a href='suppr_planning.php?id_planning=" . $planning['id_planning'] . "'>Supprimer</a></button></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<button class='btnajout'><a href='ajout_planning.php?id_oeuvres=$id_oeuvre'>Ajouter un planning</a></button>";
        echo "</div>";
        echo "<button class='btnoe'><a href='../oeuvres/oeuvres_admin.php'>Retour</a></button>";
    }
} catch (PDOException $e) {
    // Gérer les erreurs de requête
    echo "Erreur de requête : " . $e->getMessage();
}
?>
