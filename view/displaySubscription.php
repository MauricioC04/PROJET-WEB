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
    <div class="container border rounded" id="blockInscription" style="background-color: #f2f5f8; padding-right: 15px; padding-top: 15px; padding-bottom: 15px; margin-top: auto; margin-bottom: auto; width: 90%; margin-right: auto; margin-left: auto;">
        <div class="row">
            <div class="col-md-12">
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
        <div class="row">
            <div class="col-md-6" id="colDroite" style="margin-bottom: 25px;">
                <label style="margin-top: 5px;margin-bottom: 3px;">Nom</label><input class="d-block" type="text" style="width: 100%;" name="name" required>
                <label style="margin-bottom: 3px;margin-top: 5px;">Prénom</label><input class="d-block" type="text" style="width: 100%;" name="firstname" required>
                <label style="margin-top: 5px;margin-bottom: 3px;">Adresse</label><input class="d-block" type="text" style="width: 100%;" name="address" required>

                <div class="d-flex flex-row justify-content-between" style="width: 100%;">
                    <div><label style="margin-top: 5px;margin-bottom: 3px;">NPA</label><input id="zip" type="number" style="width: 90%;" name="zip" required></div>
                    <div><label style="margin-top: 5px;margin-bottom: 3px;">Localité</label><select name="city" style="width: 100%">
                            <?php foreach ($cities as $result): ?>
                            <option value="<?=$result['name'];?>" style="width: 100%" name="city"><?=$result['name'];?></option>
                            <?php endforeach;?>
                        </select>

                        </div>
                </div>

            </div>
            <div class="col-md-6" id="colGauche">
                <label style="margin-top: 5px;margin-bottom: 3px;">E-mail</label><input class="d-block" type="email" style="width: 100%;" name="email" required>
                <label style="margin-top: 5px;margin-bottom: 3px;">Mot de passe</label><input class="d-block" type="password" style="width: 100%;" name="password" required>
                <label style="margin-bottom: 3px;margin-top: 5px;">Répéter le mot de passe</label><input type="password" style="width: 100%;" name="passwordRepeat" required>
                <button class="btn btn-primary" type="submit" style="width: 100%;margin-top: 20px;">Inscription</button></div></form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require "gabarit.php";

?>
