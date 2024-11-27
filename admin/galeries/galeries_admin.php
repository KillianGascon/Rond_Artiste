<?php

include_once '../header_admin.php';
include_once '../../config.php';

$pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);


$sql = "SELECT * FROM galerie";
$result = $pdo->query($sql);

?>

<body style="">


<div class="Main">
    <table>
        <tr>
            <th>Nom</th>
            <th>Téléphone</th>
            <th>Mail</th>
            <th>Dirigeant</th>
            <th>adresse</th>
            <th>Modifier</th>
            <th>Supprimer</th>

        </tr>

        <?php
        // Requête SQL pour récupérer toutes les lignes de votre table
        $sql = "SELECT * FROM galerie";
        try {
            // Exécuter la requête
            $result = $pdo->query($sql);

            // Boucle à travers les résultats et affiche chaque ligne dans le tableau
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                $adresse = $row['rue_galerie'] . ", " . $row['cp_galerie'] . " " . $row['ville_galerie'];

                echo "<tr>";
                echo "<td>" . $row['nom_galerie'] . "</td>";
                echo "<td>" . $row['telephone_galerie'] . "</td>";
                echo "<td>" . $row['mail_galerie'] . "</td>";
                echo "<td>" . $row['nom_dirigeant'] . "</td>";
                echo "<td>" . $adresse . "</td>";
                echo "<td><button class='btnmodif'><a href='modification_galerie.php?id_galerie=" . $row['id_galerie'] . "'>Modifier</a></button></td>";
                echo "<td><button class='btnsuppr'><a href='suppr_galerie.php?id_galerie=" . $row['id_galerie'] . "'>Supprimer</a></button></td>";
                echo "</tr>";
            }
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
        ?>

    </table>

    <button class="btnajout"><a href="ajout_galerie.php">Ajouter une galerie</a></button>
</div>

</body>
