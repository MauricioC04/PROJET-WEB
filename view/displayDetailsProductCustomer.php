<?php
/**
 * Created by PhpStorm.
 * User: Mauricio COSTA CABRAL
 * Date: 06.03.2020
 * Version: 0.1
 */

ob_start();
$titre="Art-Music - Détails article";
?>


<div style="background-image: url(&quot;view/content/images/useful/arriere-plan.jpg&quot;);background-position: center;background-size: cover;background-repeat: no-repeat;padding: 25px;position: relative;height: 500px;">
    <div class="container" style="background-color: #eeeeee;position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);padding: 15px;">
        <div class="row">
            <div class="col-md-9 text-center" id="containerInfoProduct" style="width: 100%;"><button class="btn btn-primary d-block" id="btnMobile" type="button" style="margin-left: auto;margin-right: auto;margin-bottom: 15px;width: 100%;">Ajouter au panier</button><img id="imgProduct" src="view/content/images/useful/arriere-plan.jpg" width="100%" style="max-width: 170px;max-height: 170px;margin-bottom: 15px;">
                <div>
                    <h5>Heading</h5>
                    <h5>Heading</h5>
                    <h5>Heading</h5>
                    <h5>Heading</h5>
                    <h5>Heading</h5>
                </div>
            </div>
            <div class="col-md-3 align-self-md-center"><button class="btn btn-primary" id="btnDesktop" type="button" style="height: 80px;">Ajouter au panier</button></div>
        </div>
        <div class="row">
            <div class="col-md-12"></div>
        </div>
    </div>
</div>


<?php
$content = ob_get_clean();
require "gabarit.php";

?>
