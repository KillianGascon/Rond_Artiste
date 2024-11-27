<?php
include_once ('header_user.php');

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id_oeuvre = $_GET['id'];
    ?>
    <?php

    function getOeuvreFromDatabase($id_oeuvre) {
        include_once('../config.php');
        $pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);
        $requete = $pdo->prepare("SELECT o.*, m.chemin_image_media, a.pseudo_artiste, o.likes_oeuvre, o.dislikes_oeuvres, p.date_debut, p.date_fin FROM oeuvre o INNER JOIN artistes a ON o.id_artiste = a.id_artiste INNER JOIN media m ON o.id_oeuvres = m.id_oeuvre LEFT JOIN planning p ON o.id_oeuvres = p.id_oeuvre WHERE id_oeuvres = :id_oeuvres");
        $requete->execute(array(':id_oeuvres' => $id_oeuvre));
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
    $oeuvre = getOeuvreFromDatabase($id_oeuvre);

    function getArtisteFromDatabase($id_artiste) {
        include_once('../config.php');
        $pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);
        $requete = $pdo->prepare("SELECT * FROM artistes WHERE id_artiste = :id_artiste");
        $requete->execute(array(':id_artiste' => $id_artiste));
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
    $artiste = getArtisteFromDatabase($oeuvre['id_artiste']);

    function getGalerieFromDatabase($id_oeuvre) {
        include_once('../config.php');
        $pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);
        $requete = $pdo->prepare("SELECT g.ville_galerie FROM galerie g INNER JOIN planning p ON g.id_galerie = p.id_galerie WHERE p.id_oeuvre = :id_oeuvre");
        $requete->execute(array(':id_oeuvre' => $id_oeuvre));
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        // Si aucun résultat n'est retourné, retourner un message indiquant l'absence de galerie
        if (!$result) {
            return "Non spécifié";
        }
        return $result['ville_galerie'];
    }
    $galerie = getGalerieFromDatabase($id_oeuvre);

    if($oeuvre) {
        ?>
        <body>
        <header>
            <img src="assets/images/LOGO%20troublanc+signature_saison2_noir.svg" alt="Logo de la galerie">
        </header>

        <div class="artwork">
            <img src="../admin/assets_admin/photos_oeuvres/<?php echo $oeuvre['chemin_image_media']; ?>" alt="<?php echo $oeuvre['titre_oeuvre']; ?>">
            <div class="artwork-details">
                <h2><?php echo $oeuvre['titre_oeuvre']; ?></h2>
                <p><b>Artiste :</b> <?php echo $oeuvre['pseudo_artiste']; ?> (<?php echo  $artiste['ville_artiste']?>)</p>
                <p><?php echo $oeuvre['description_oeuvre']; ?></p>
                <?php if($oeuvre['date_debut'] && $oeuvre['date_fin']) { ?>
                    <span class="lieu">Exposition actuelle : <?php echo $galerie; ?></span>
                    <h3>Planning d'exposition</h3>
                    <ul class="exhibition-schedule">
                        <li><b><?php echo $galerie?></b> - Du <?php echo $oeuvre['date_debut']; ?> au <?php echo $oeuvre['date_fin']; ?></li>
                    </ul>
                <?php } else { ?>
                    <p>Aucun planning d'exposition disponible pour cette œuvre.</p>
                <?php } ?>

                <?php
                if($artiste['ville_artiste'] == $galerie){
                    echo "<i style='color:BLUE;' class='fa-solid fa-circle-exclamation'></i> <p style='color: BLUE;'>Artiste local</p>";
                }
                ?>

                <h4>Donnez votre avis sur cette œuvre !</h4>
                <div class="votes">

                    <button id="likeButton"><i class="fa-sharp fa-solid fa-heart heart"></i></button>
                    (<span id="likesCount"><?php echo $oeuvre['likes_oeuvre']; ?></span>)


                    <button id="dislikeButton"><i class="fa-solid fa-heart-crack heart"></i></button>
                    (<span id="dislikesCount"><?php echo $oeuvre['dislikes_oeuvres']; ?></span>)

                </div>


                <script>

                    $("#likeButton").click(function(){
                        $(this).prop("disabled", true); // Désactiver le bouton
                        $(".heart").addClass("disintegrate"); // Ajouter la classe d'animation
                        setTimeout(function() {
                            $(".heart").removeClass("disintegrate");
                            $("#likeButton").prop("disabled", false); // Réactiver le bouton
                        }, 5000); // 5000 millisecondes = 5 secondes

                        // Appel AJAX pour ajouter un like
                        $.ajax({
                            url: "assets/actions/update_likes.php",
                            type: "POST",
                            data: { action: "like", id_oeuvres: <?php echo $id_oeuvre; ?> },
                            dataType: "json",
                            success: function(response) {
                                if(response.hasOwnProperty('likes')) {
                                    $("#likesCount").text(response.likes);
                                } else if(response.hasOwnProperty('error')) {
                                    alert("Erreur : " + response.error);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    });

                    $("#dislikeButton").click(function(){
                        $(this).prop("disabled", true); // Désactiver le bouton
                        $(".heart").addClass("disintegrate"); // Ajouter la classe d'animation
                        setTimeout(function() {
                            $(".heart").removeClass("disintegrate"); // Retirer la classe d'animation après 5 secondes
                            $("#dislikeButton").prop("disabled", false); // Réactiver le bouton
                        }, 5000); // 5000 millisecondes = 5 secondes

                        // Appel AJAX pour ajouter un dislike
                        $.ajax({
                            url: "assets/actions/update_likes.php",
                            type: "POST",
                            data: { action: "dislike", id_oeuvres: <?php echo $id_oeuvre; ?> },
                            dataType: "json",
                            success: function(response) {
                                if(response.hasOwnProperty('dislikes')) {
                                    $("#dislikesCount").text(response.dislikes);
                                } else if(response.hasOwnProperty('error')) {
                                    alert("Erreur : " + response.error);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    });


                </script>




                <style>
                    .disabled {
                        opacity: 0.5;
                    }
                </style>
            </div>
        </div>
        <div class="retour">
            <a href="index.php">&lt; Retour à la galerie</a>
        </div>
        </body>

        <?php
    } else {
        echo "Aucune œuvre trouvée avec cet ID.";
    }
} else {
    echo "ID de l'œuvre non spécifié.";
}
?>
