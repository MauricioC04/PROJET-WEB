<?php
/**
 * Created by PhpStorm.
 * User: Mauricio COSTA CABRAL
 * Date: 06.03.2020
 * Version: 0.1
 */


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?=$titre;?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="view/content/styles/Login-Form-Dark.css">
    <link rel="stylesheet" href="view/content/styles/Footer-Dark.css">
    <link rel="stylesheet" href="view/content/styles/Navigation-Clean.css">
    <link rel="stylesheet" href="view/content/styles/styles.css">

</head>

<body>
<nav class="navbar navbar-light navbar-expand-md navigation-clean" style="background-color: rgb(0,0,0);">
    <div class="container"><a class="navbar-brand" href="index.php?action=home" style="color: rgb(0,194,255);">ART-MUSIC</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div
                class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item" role="presentation"><a class="nav-link" href="index.php?action=displayAlbumCD" style="color: rgb(0,176,251);">ALBUM CD</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="index.php?action=displayVinyles" style="color: rgb(0,176,251);">VINYLES</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="index.php?action=displayLogin" style="color: rgb(0,176,251);">INSCRIPTION/CONNEXION</a></li>
            </ul>
        </div>
    </div>
</nav>

<?=$content;?>

<div class="footer-dark">
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-4 text-center item">
                    <h3><i class="icon ion-ios-location" style="font-size: 42px;line-height: 50px;"></i></h3>
                    <ul>
                        <li><a href="#">Rue de la Mélodie 9</a></li>
                        <li><a href="#">1018 LAUSANNE</a></li>
                        <li></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-4 text-center item">
                    <h3 class="text-center"><i class="fa fa-envelope" style="font-size: 41px;line-height: 50px;"></i></h3>
                    <ul>
                        <li><a href="#">info@art-music.ch</a></li>
                        <li></li>
                    </ul>
                </div>
                <div class="col-md-4 text-center item text">
                    <h3><i class="fa fa-phone-square" style="font-size: 41px;line-height: 50px;"></i></h3>
                    <p>+41 26 458 78 12</p>
                </div>
            </div>
            <p class="copyright">Art-Music © 2020</p>
        </div>
    </footer>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>