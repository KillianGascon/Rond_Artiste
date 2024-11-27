<?php

include_once '../header_admin.php';
include_once '../../config.php';

?>


Ajout D'une Galerie


<form method="post" action="../assets_admin/actions/galerie/Ajout_galerie.php" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Nom de la galerie :</label>
        <input type="text" id="colFormLabel" name="nom_galerie" class="form-control" placeholder="Nom">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Téléphone de la galerie :</label>
        <input type="text" id="colFormLabel" name="telephone_galerie" class="form-control" placeholder="Téléphone">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Mail de la galerie :</label>
        <input type="text" id="colFormLabel" name="mail_galerie" class="form-control" placeholder="Mail">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Dirigeant de la galerie :</label>
        <input type="text" id="colFormLabel" name="nom_dirigeant" class="form-control" placeholder="Dirigeant">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Ville de la Galerie :</label>
        <input type="text" id="colFormLabel" name="ville_galerie" class="form-control" placeholder="Ville">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Code postal de la galerie:</label>
        <input type="number" id="colFormLabel" name="cp_galerie" class="form-control" placeholder="Code Postal">
    </div>
    <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Rue de la galerie</label>
        <input type="text" id="colFormLabel" name="rue_galerie" class="form-control" placeholder="Rue">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<button type="button" class="btn btn-secondary" style="margin-top: 10px;" > <a style="text-decoration: none; margin-top:10%; color: white; " href="galeries_admin.php">< Retour</a> </button>
