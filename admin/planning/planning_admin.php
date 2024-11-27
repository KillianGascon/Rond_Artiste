<?php
include_once '../header_admin.php';
include_once '../../config.php';

$pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);

$sql = "SELECT planning.id_planning, oeuvre.titre_oeuvre AS nom_oeuvre, galerie.nom_galerie AS nom_galerie, planning.date_debut, planning.date_fin FROM planning INNER JOIN oeuvre ON planning.id_oeuvre = oeuvre.id_oeuvres INNER JOIN galerie ON planning.id_galerie = galerie.id_galerie";
$result = $pdo->query($sql);

?>

<body>

<div class="Main">
    <table>
        <tr>
            <th>Nom de l'oeuvre</th>
            <th>Nom de la Galerie</th>
            <th>Date de Début du planning</th>
            <th>Date de Fin du planning</th>
            <th>Modifier</th>
            <th>Supprimer</th>
            <th>Oeuvres</th>
        </tr>

        <?php
        try {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['nom_oeuvre'] . "</td>";
                echo "<td>" . $row['nom_galerie'] . "</td>";
                echo "<td>" . $row['date_debut'] . "</td>";
                echo "<td>" . $row['date_fin'] . "</td>";
                echo "<td><button class='btnmodif'><a href='modif_planning.php?id_planning=" . $row['id_planning'] . "'>Modifier</a></button></td>";
                echo "<td><button class='btnsuppr'><a href='suppr_planning.php?id_planning=" . $row['id_planning'] . "'>Supprimer</a></button></td>";
                echo "<td><button class='btnoe'><a href='planning_admin.php?id_planning=" . $row['id_planning'] . "'>Plannings ➟ </a></button></td>";
                echo "</tr>";
            }
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
        ?>

    </table>

    <button class="btnajout"><a href="ajout_planning.php">Ajouter un planning</a></button>
</div>

</body>

