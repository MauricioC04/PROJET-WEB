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

<div id="mainBlock" style="background-image: url(&quot;view/content/images/useful/arriere-plan.jpg&quot;);padding-top: 30px;padding-bottom: 30px;background-position: center;background-size: cover;background-repeat: no-repeat;height: auto;">
    <div class="container border rounded" id="blockInscription" style="background-color: #f2f5f8;padding-right: 15px;padding-top: 15px;padding-bottom: 15px;margin: 0px;margin-top: auto;width: 90%;margin-right: auto;margin-left: auto;">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center"><i class="fa fa-pencil-square" style="font-size: 45px;"></i><br>Inscription</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" id="colDroite" style="margin-bottom: 25px;"><label style="margin-top: 5px;margin-bottom: 3px;">Nom</label><input class="d-block" type="text" style="width: 100%;"><label style="margin-bottom: 3px;margin-top: 5px;">Prénom</label><input class="d-block" type="text" style="width: 100%;">
                <label
                        style="margin-top: 5px;margin-bottom: 3px;">Adresse</label><input class="d-block" type="text" style="width: 100%;">
                <div class="d-flex flex-row justify-content-between" style="width: 100%;">
                    <div><label style="margin-top: 5px;margin-bottom: 3px;">NPA</label><input type="number" style="width: 90%;"></div>
                    <div><label style="margin-top: 5px;margin-bottom: 3px;">Localité</label><input type="text" style="width: 100%;"></div>
                </div>
            </div>
            <div class="col-md-6" id="colGauche"><label style="margin-top: 5px;margin-bottom: 3px;">E-mail</label><input class="d-block" type="email" style="width: 100%;"><label style="margin-top: 5px;margin-bottom: 3px;">Mot de passe</label><input class="d-block" type="password" style="width: 100%;">
                <label style="margin-bottom: 3px;margin-top: 5px;">Répéter le mot de passe</label><input type="password" style="width: 100%;"><button class="btn btn-primary" type="button" style="width: 100%;margin-top: 20px;">Inscription</button></div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require "gabarit.php";

?>
