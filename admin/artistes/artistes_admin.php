<?php

include_once '../header_admin.php';
include_once '../../config.php';

$pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);

?>

<body style="">

<div class="Main">
    <table>
        <tr>
            <th>Photo</th>
            <th>Nom et Prénom</th>
            <th>Pseudo</th>
            <th>Nationalité</th>
            <th>Ville</th>
            <th>Description</th>
            <th>Style Principal des oeuvres crées</th>
            <th>Téléphone</th>
            <th>Mail</th>
            <th>Lien Insta</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>

        <?php

        $sql = "SELECT * FROM artistes";
        try {

            $result = $pdo->query($sql);


            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $identite = $row['nom_artiste'] . " " . $row['prenom_artiste'];
                echo "<tr>";

                echo "<td><img src='../assets_admin/photos_profils/" . $row['chemin_pp'] . "' style='width: 100px; height: 100px;' alt='Photo de profil'></td>";

                echo "<td>" . $identite . "</td>";
                echo "<td>" . $row['pseudo_artiste'] . "</td>";
                echo "<td>" . $row['nationalite_artiste'] . "</td>";
                echo "<td>" . $row['ville_artiste'] . "</td>";
                $description = strlen($row['description_artiste']) > 30 ? substr($row['description_artiste'], 0, 30) . "..." : $row['description_artiste'];
                echo "<td>" . $description . "<span id='fullDescription_" . $row['id_artiste'] . "' style='display:none;'>" . $row['description_artiste'] . "</span>";
                if (strlen($row['description_artiste']) > 30) {
                    echo "<button onclick='toggleDescription(" . $row['id_artiste'] . ")'>...</button>";
                }
                echo "</td>";
                echo "<td>" . $row['style_oeuvres'] . "</td>";
                echo "<td>" . $row['telephone_artiste'] . "</td>";
                echo "<td>" . $row['mail_artiste'] . "</td>";
                echo "<td>" . $row['lien_rs_artiste'] . "</td>";
                echo "<td><button class='btnmodif'><a href='modif_artiste.php?id_artiste=" . $row['id_artiste'] . "'>Modifier</a></button></td>";
                echo "<td><button class='btnsuppr'><a href='suppr_artiste.php?id_artiste=" . $row['id_artiste'] . "'>Supprimer</a></button></td>";
                echo "</tr>";
            }
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
        ?>

    </table>

    <button class="btnajout"><a href="ajout_artiste.php">Ajouter un artiste</a></button>
</div>

</body>

<script>
    function toggleDescription(artistId) {
        var descriptionElement = document.getElementById("fullDescription_" + artistId);
        if (descriptionElement.style.display === "none") {
            descriptionElement.style.display = "inline";
        } else {
            descriptionElement.style.display = "none";
        }
        var buttonElement = document.getElementById("toggleButton_" + artistId);
        buttonElement.parentNode.appendChild(buttonElement);
    }
</script>