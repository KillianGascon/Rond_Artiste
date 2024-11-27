

<?php
include_once '../../../config.php';

try {
    $pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}

// Vérifie si l'action et l'ID de l'œuvre sont définis
if(isset($_POST['action']) && isset($_POST['id_oeuvres'])) {
    $action = $_POST['action'];
    $id_oeuvres = $_POST['id_oeuvres'];

    // Exécute l'action appropriée
    if($action === "like") {
        updateLikes($pdo, $id_oeuvres);
    } elseif($action === "dislike") {
        updateDislikes($pdo, $id_oeuvres);
    } else {
        echo json_encode(array('error' => 'Action inconnue'));
        exit;
    }
} else {
    echo json_encode(array('error' => 'Paramètre d\'action non fourni'));
    exit;
}

// Fonction pour mettre à jour les likes
function updateLikes($pdo, $id_oeuvres) {
    try {
        $query = "UPDATE oeuvre SET likes_oeuvre = likes_oeuvre + 1 WHERE id_oeuvres = :id_oeuvres";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':id_oeuvres', $id_oeuvres);
        $statement->execute();

        // Récupérer le nouveau nombre de likes après la mise à jour
        $newLikes = getLikes($pdo, $id_oeuvres);

        // Renvoyer le nouveau nombre de likes
        echo json_encode(array('likes' => $newLikes));
    } catch(PDOException $e) {
        echo json_encode(array('error' => 'Erreur lors de la mise à jour des likes: ' . $e->getMessage()));
    }
}

// Fonction pour récupérer le nombre de likes actuel
function getLikes($pdo, $id_oeuvres) {
    $query = "SELECT likes_oeuvre FROM oeuvre WHERE id_oeuvres = :id_oeuvres";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':id_oeuvres', $id_oeuvres);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    return $row['likes_oeuvre'];
}

// Fonction pour mettre à jour les dislikes
function updateDislikes($pdo, $id_oeuvres) {
    try {
        $query = "UPDATE oeuvre SET dislikes_oeuvres = dislikes_oeuvres + 1 WHERE id_oeuvres = :id_oeuvres";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':id_oeuvres', $id_oeuvres);
        $statement->execute();

        // Récupérer le nouveau nombre de dislikes après la mise à jour
        $newDislikes = getDislikes($pdo, $id_oeuvres);

        // Renvoyer le nouveau nombre de dislikes
        echo json_encode(array('dislikes' => $newDislikes));
    } catch(PDOException $e) {
        echo json_encode(array('error' => 'Erreur lors de la mise à jour des dislikes: ' . $e->getMessage()));
    }
}

// Fonction pour récupérer le nombre de dislikes actuel
function getDislikes($pdo, $id_oeuvres) {
    $query = "SELECT dislikes_oeuvres FROM oeuvre WHERE id_oeuvres = :id_oeuvres";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':id_oeuvres', $id_oeuvres);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    return $row['dislikes_oeuvres'];
}
?>
