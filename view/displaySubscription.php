<?php
/**
 * Created by PhpStorm.
 * User: Mauricio COSTA CABRAL
 * Date: 06.03.2020
 * Version: 0.1
 */

ob_start();
$titre="Art-Music - Inscription";


?>



<div id="mainBlock" style="background-image: url(&quot;view/content/images/useful/arriere-plan.jpg&quot;);padding-top: 30px;padding-bottom: 30px;background-position: center;background-size: cover;background-repeat: no-repeat; display: flex">
    <div class="container border rounded" id="blockInscription" style="background-color: #f2f5f8; padding: 35px; margin-top: auto; margin-bottom: auto; width: 90%; max-width: 350px; margin-right: auto; margin-left: auto;">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="text-center"><i class="fa fa-pencil-square" style="font-size: 45px;"></i><br>Inscription</h2>
                <?php if (@$_GET['emailAlreadyExists'] == true) :?>
                    <h5 style="text-align: center"><span style="color: red; font-weight: bold;">Cet email est déjà utilisé. Veuillez vous connecter avec vos identifiants respectifs</span></h5>
                <?php endif ?>
                <?php if (@$_GET['emptyInput'] == true) :?>
                    <h5 style="text-align: center"><span style="color: red; font-weight: bold;">Veuillez remplir tous les champs correctement</span></h5>
                <?php endif ?>
                <?php if (@$_GET['passwordNotIdentical'] == true) :?>
                    <h5 style="text-align: center"><span style="color: red; font-weight: bold;">Vos mots de passe ne sont pas identique</span></h5>
                <?php endif ?>
                <?php if (@$_GET['errorRegister'] == true) :?>
                    <h5 style="text-align: center"><span style="color: red; font-weight: bold;">Un problème est survenu lors de votre inscription.</span></h5>
                <?php endif ?>
                <?php if (@$_GET['errorCityZip'] == true) :?>
                    <h5 style="text-align: center"><span style="color: red; font-weight: bold;">Veuillez renseigner un code postale et une localité SUISSE</span></h5>
                <?php endif ?>
            </div>
        </div>
        <form method="post" action="index.php?action=registerNewAccount">
        <div class="row" style="padding-top: 20px">
            <div class="col-sm-12" id="colDroite" style="margin-bottom: 25px;">
                <input class="d-block inputStyle" type="text" style="width: 100%;" placeholder="Nom" name="name" required>
                <input class="d-block inputStyle" type="text" style="width: 100%;" placeholder="Prénom" name="firstname" required>
                <input class="d-block inputStyle" type="text" style="width: 100%;" placeholder="Adresse" name="address" required>

                <div class="d-flex flex-row justify-content-between" style="width: 100%;">
                    <div><input class="d-block inputStyle" id="zip" type="number" style="width: 90%;" placeholder="NPA" name="zip" required></div>
                    <div><input class="d-block inputStyle" type="text" style="width: 100%;" placeholder="Localité" name="city" required></div>
                </div>


                <input class="d-block inputStyle" type="email" style="width: 100%;" placeholder="Email" name="email" required>
                <input class="d-block inputStyle" type="password" style="width: 100%;" placeholder="Mot de passe" name="password" required>
                <input class="d-block inputStyle" type="password" style="width: 100%;" placeholder="Confirmation du mot de passe" name="passwordRepeat" required>
                <button class="btn btn-primary" type="submit" style="width: 100%;">Inscription</button>
            </div>
        </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require "gabarit.php";

?>
