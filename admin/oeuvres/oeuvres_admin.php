
<?php

include_once '../header_admin.php';
include_once '../../config.php';

$pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);

?>

<body style="">

<div class="Main">
    <table>
        <tr>
            <th>Titre</th>
            <th>Description</th>
            <th>Dimensions</th>
            <th>Type de l'oeuvre</th>
            <th>Vendu</th>
            <th>Artiste</th>
            <th>Modifier</th>
            <th>Supprimer</th>
            <th>Plannings</th>
        </tr>

        <?php
        // Requête SQL pour récupérer les données des œuvres et des artistes associés
        $sql = "SELECT oeuvre.id_oeuvres, oeuvre.titre_oeuvre, oeuvre.description_oeuvre, oeuvre.hauteur_oeuvre, oeuvre.longueur_oeuvres, oeuvre.vendu_oeuvre, oeuvre.type_oeuvre, artistes.pseudo_artiste 
                FROM oeuvre 
                INNER JOIN artistes ON oeuvre.id_artiste = artistes.id_artiste";

        try {
            // Exécuter la requête
            $result = $pdo->query($sql);

            // Boucle à travers les résultats et affiche chaque ligne dans le tableau
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $dimensions = $row['hauteur_oeuvre'] . "cm X " . $row['longueur_oeuvres'] . "cm";

                echo "<tr>";
                echo "<td>" . $row['titre_oeuvre'] . "</td>";
                echo "<td>" . $row['description_oeuvre'] . "</td>";
                echo "<td>" . $dimensions . "</td>";
                echo "<td>" . $row['type_oeuvre'] . "</td>";
                $vendu = $row['vendu_oeuvre'] == 1 ? 'Oui' : 'Non';
                echo "<td>" . $vendu . "</td>";
                echo "<td>" . $row['pseudo_artiste'] . "</td>";
                echo "<td><button class='btnmodif'><a href='modification_oeuvre.php?id_oeuvres=" . $row['id_oeuvres'] . "'>Modifier</a></button></td>";
                echo "<td><button class='btnsuppr'><a href='suppr_oeuvre.php?id_oeuvres=" . $row['id_oeuvres'] . "'>Supprimer</a></button></td>";
                echo "<td><button class='btnoe'><a href='../planning/planning_spe.php?id_oeuvres=" . $row['id_oeuvres'] . "'>➟</a></button></td>";

                // Ajoutez d'autres cellules en fonction de votre table
                echo "</tr>";
            }
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
        ?>

    </table>

    <button class="btnajout"><a href="ajout_oeuvre.php">Ajouter une oeuvre</a></button>
</div>

</body>

