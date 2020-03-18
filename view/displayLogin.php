<?php
/**
 * Created by PhpStorm.
 * User: Mauricio COSTA CABRAL
 * Date: 06.03.2020
 * Version: 0.1
 */

ob_start();
$titre="Art-Music - Inscription/connexion";
?>

<div class="login-dark" style="background-position: center;background-image: url(&quot;view/content/images/useful/arriere-plan.jpg&quot;);background-repeat: no-repeat;background-size: cover;height: 600px;">
    <form method="post" style="background-color: #f0f9ff;">
        <h2 class="sr-only">Login Form</h2>
        <div class="illustration">
            <h1>Connexion</h1><i class="icon-login"></i></div>
        <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
        <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Mot de passe"></div>
        <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Connexion</button></div><a class="forgot" href="index.php?action=displaySubscription">Créer un compte</a></form>
</div>

<?php
$content = ob_get_clean();
require "gabarit.php";

?>
