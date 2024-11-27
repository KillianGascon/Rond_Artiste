<?php
include_once 'header_user.php';

?>
<body>
<meta http-equiv="refresh" content="60; URL=http://localhost//rond_artiste/utilisateur/index.php" />
<header>
    <img src="assets/images/LOGO%20troublanc+signature_saison2_noir.svg" alt="Logo de la galerie">
</header>
<?php

include_once '../config.php';

function getOeuvresFromDatabase() {
    try {
        $pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);
        $requete = $pdo->prepare("SELECT o.*, m.chemin_image_media, a.pseudo_artiste AS pseudo_artiste FROM oeuvre o INNER JOIN media m ON o.id_oeuvres = m.id_oeuvre INNER JOIN artistes a ON o.id_artiste = a.id_artiste");
        $requete->execute();
        $oeuvres = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $oeuvres;
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des œuvres: " . $e->getMessage();
        return array();
    }
}

?>
<div class="filters">
    <label for="artist-filter">Filtrer par artiste :</label>
    <select id="selectArtiste">
        <option value="all">Tous les artistes</option>
        <?php
        $pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);
        $requete = $pdo->prepare("SELECT DISTINCT pseudo_artiste FROM artistes");
        $requete->execute();
        $artistes = $requete->fetchAll(PDO::FETCH_COLUMN);
        foreach ($artistes as $artiste) {
            echo '<option value="' . $artiste . '">' . $artiste . '</option>';
        }
        ?>
    </select>
    <label for="title-filter">Rechercher par titre :</label>
    <input type="text" id="title-filter" placeholder="Entrez un titre">
</div>
<script>
    function filtrerOeuvresParTitre() {
        var inputTitre = document.getElementById("title-filter");
        var titre = inputTitre.value.toLowerCase();
        var oeuvres = document.querySelectorAll(".gallery a");
        oeuvres.forEach(function(oeuvre) {
            var titreOeuvre = oeuvre.querySelector("h3").innerText.toLowerCase();
            if (titreOeuvre.includes(titre)) {
                oeuvre.style.display = "block";
            } else {
                oeuvre.style.display = "none";
            }
        });
    }
    document.getElementById("title-filter").addEventListener("input", filtrerOeuvresParTitre);
</script>
<div class="gallery">
    <?php
    function afficherOeuvres() {
        $oeuvres = getOeuvresFromDatabase();
        if ($oeuvres) {
            foreach ($oeuvres as $oeuvre) {
                $titre = $oeuvre['titre_oeuvre'];
                $artiste = $oeuvre['pseudo_artiste'];
                $image = $oeuvre['chemin_image_media'];
                $likes = $oeuvre['likes_oeuvre'];
                $dislikes = $oeuvre['dislikes_oeuvres'];
                $id_oeuvre = $oeuvre['id_oeuvres'];
                echo '<a href="oeuvre.php?id=' . $id_oeuvre . '" data-artiste="' . $artiste . '">';
                echo '<div>';
                echo '<img src="../admin/assets_admin/photos_oeuvres/' . $image . '" alt="' . $titre . '">';
                echo '<h3>' . $titre . '</h3>';
                echo '<p>' . $artiste . '</p>';
                echo '<span class="like"><i class="fa-sharp fa-solid fa-heart"></i> ' . $likes . ' - <i class="fa-solid fa-heart-crack"></i> ' . $dislikes . '</span>';
                echo '</div>';
                echo '</a>';
            }
        } else {
            echo 'Aucune œuvre trouvée.';
        }
    }
    afficherOeuvres();
    ?>
</div>
<script>
    function filtrerOeuvresParArtiste() {
        var selectArtiste = document.getElementById("selectArtiste");
        var artisteSelectionne = selectArtiste.value;
        var oeuvres = document.querySelectorAll(".gallery a");
        oeuvres.forEach(function(oeuvre) {
            var artisteOeuvre = oeuvre.getAttribute("data-artiste");
            if (artisteSelectionne === "all" || artisteOeuvre === artisteSelectionne) {
                oeuvre.style.display = "block";
            } else {
                oeuvre.style.display = "none";
            }
        });
    }
    document.getElementById("selectArtiste").addEventListener("change", filtrerOeuvresParArtiste);
    window.onload = function() {
        filtrerOeuvresParArtiste();
    };
</script>
