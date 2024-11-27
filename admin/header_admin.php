<?php?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets_admin/styles/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

    <title><?php echo basename($_SERVER['PHP_SELF']); ?></title>
</head>

<body>

<!--<nav>-->
<!--    <div class="navbar">-->
<!--        <button><i class="fas fa-palette"></i> Oeuvre</button>-->
<!--        <button><i class="fas fa-paint-brush"></i> Artiste</button>-->
<!--        <button><i class="fas fa-map-marked-alt"></i> Galerie</button>-->
<!--    </div>-->
<!--</nav>-->

<nav class="navbar navbar-expand-lg navbar-light bg-light" style="box-shadow: 0px 5px 24px 7px rgba(0, 0, 0, 0.25);
">
<!--    <a class="navbar-brand" href="#">-->
<!--        <img src="admin/assets_admin/logo.png" alt="">-->
<!--    </a>-->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">

                <a class="nav-link" href="../../admin/index.php"><i class="fas fa-home"></i> Acceuil</a>
            </li>
            <li class="nav-item active">

                <a class="nav-link" href="../../admin/oeuvres/oeuvres_admin.php"><i class="fas fa-palette"></i> Oeuvres</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../../admin/artistes/artistes_admin.php"><i class="fas fa-paint-brush"></i> Artistes</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../../admin/galeries/galeries_admin.php"><i class="fas fa-map-marked-alt"></i> Galeries</a>
            </li>
<!--            <li class="nav-item active">-->
<!--                <a class="nav-link" href="../../admin/planning/planning_admin.php"><i class="fas fa-solid fa-list"></i> Plannings</a>-->
<!--            </li>-->
        </ul>

        <a href="../../utilisateur/index.php" class="btn btn-danger">Aller à la page utilisateur -></a>

    </div>
</nav>

</body>


</html>