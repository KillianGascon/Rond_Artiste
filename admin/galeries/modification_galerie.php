<?php
include_once '../header_admin.php';
include_once '../../config.php';

$pdo = new PDO("mysql:host=" . config::SERVER . ";dbname=" . config::BASEDEDONNEE, config::UTILISATEUR, config::MOTDEPASSE);

$requete = $pdo->prepare("SELECT * FROM galerie WHERE id_galerie = :id_galerie");
$requete->bindParam(":id_galerie", $_GET["id_galerie"]);
$requete->execute();
$galerie = $requete->fetch(PDO::FETCH_ASSOC);
?>

<body>

<form action="../assets_admin/actions/galerie/Modification_galerie.php" method="post" >
    <h5>Modifier La Galerie</h5>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Nom de la galerie :</label>
        <input class="form-control"  type="text" id="nom_galerie" name="nom_galerie" value="<?php echo $galerie['nom_galerie']?>">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">téléphone de la galerie :</label>
        <input class="form-control"  type="text" id="telephone_galerie" name="telephone_galerie" value="<?php echo $galerie['telephone_galerie']?>">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Mail de la galerie :</label>
        <input class="form-control"  type="text" id="mail_galerie" name="mail_galerie" value="<?php echo $galerie['mail_galerie']?>">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Nom du dirigeant de la galerie :</label>
        <input class="form-control"  type="text" id="nom_dirigeant" name="nom_dirigeant" value="<?php echo $galerie['nom_dirigeant']?>">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Ville de la galerie :</label>
        <input class="form-control"  type="text" id="ville_galerie" name="ville_galerie" value="<?php echo $galerie['ville_galerie']?>">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Code postal de la galerie :</label>
        <input class="form-control"  type="number" id="cp_galerie" name="cp_galerie" value="<?php echo $galerie['cp_galerie']?>">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Rue de la galerie :</label>
        <input class="form-control"  type="text" id="rue_galerie" name="rue_galerie" value="<?php echo $galerie['rue_galerie']?>">
    </div>
    <input type="hidden" name="id_galerie" value="<?php echo $galerie['id_galerie']?>">
    <button type="submit" class="butnajout">Modifier</button>
    <button class="exit"><a href="galeries_admin.php">Annuler</a></button>
</form>

</body>

<!--<script>-->
<!--    // Utilisez une classe pour identifier les champs d'immatriculation-->
<!--    var immatriculationInputs = document.querySelectorAll('.immatriculation');-->
<!---->
<!--    // Ajoutez un écouteur d'événements à chaque champ d'immatriculation-->
<!--    immatriculationInputs.forEach(function(input) {-->
<!--        input.addEventListener('input', function (e) {-->
<!--            // Récupérer la valeur actuelle de l'input-->
<!--            let inputValue = e.target.value;-->
<!---->
<!--            // Supprimer les caractères non alphabétiques et les chiffres excédant le format-->
<!--            inputValue = inputValue.replace(/[^a-zA-Z0-9]/g, '').substr(0, 9);-->
<!---->
<!--            // Formater l'immatriculation avec les tirets-->
<!--            if (inputValue.length >= 2) {-->
<!--                inputValue = inputValue.substr(0, 2) + '-' + inputValue.substr(2);-->
<!--            }-->
<!--            if (inputValue.length >= 6) {-->
<!--                inputValue = inputValue.substr(0, 6) + '-' + inputValue.substr(6);-->
<!--            }-->
<!---->
<!--            // Mettre à jour la valeur de l'input-->
<!--            e.target.value = inputValue;-->
<!--        });-->
<!--    });-->
<!--</script>-->

