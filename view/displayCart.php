<?php
/**
 * Created by PhpStorm.
 * User: Mauricio COSTA CABRAL
 * Date: 06.03.2020
 * Version: 0.1
 */

ob_start();
$titre="Art-Music - Panier";
?>

<div id="mainBlock" style="background-image: url(&quot;view/content/images/useful/arriere-plan.jpg&quot;);padding-top: 30px;padding-bottom: 30px;background-position: center;background-size: cover;background-repeat: no-repeat;height: 500px;position: relative;">
    <div class="container border rounded" id="blockInscription" style="background-color: #f2f5f8;padding-right: 15px;padding-top: 15px;padding-bottom: 15px;padding-left: 15px;top: 50%;left: 50%;transform: translate(-50%, -50%);position: absolute;">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center"><i class="fas fa-shopping-cart" style="font-size: 45px;"></i><br>Votre panier - Montant total CHF xxx.xx</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="margin-bottom: 10px;"></div>
        </div>
        <div class="row">
            <div class="col-md-12 text-md-right" style="margin-bottom: 10px;margin-top: 15px;"><button class="btn btn-primary" id="btnContinuePurchase" type="button" style="width: 100%;margin-bottom: 15px;">Continuer mes achats</button><button class="btn btn-primary" id="btnConfirmCart" type="button" style="width: 100%;">Confirmer mon panier</button></div>
        </div>
    </div>
</div>



<?php
$content = ob_get_clean();
require "gabarit.php";

?>
