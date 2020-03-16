<?php
/**
 * Created by PhpStorm.
 * User: Mauricio COSTA CABRAL
 * Date: 06.03.2020
 * Version: 0.1
 */

ob_start();
$titre="Art-Music - Vinyles";
?>

    <div style="background-image: url(&quot;view/content/images/useful/arriere-plan.jpg&quot;);background-position: center;background-size: cover;background-repeat: no-repeat;padding-top: 25px;padding-bottom: 25px;min-height: 750px;">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="text-center shadow" style="background-color: #eeeeee;padding-top: 10px;padding-bottom: 10px;margin-bottom: 25px;padding-right: 10px;padding-left: 10px;"><img style="margin-bottom: 15px;max-width: 180px;" src="view/content/images/useful/arriere-plan.jpg" width="100%">
                        <ul class="list-unstyled text-left" style="font-style: normal;font-weight: bold;">
                            <li>Item 1</li>
                            <li>Item 2</li>
                            <li>Item 3</li>
                            <li>Item 4</li>
                            <li>Item 4</li>
                        </ul><button class="btn btn-primary" type="button" style="width: 100%;">Ajouter au panier</button></div>
                </div>
                <div class="col-md-3">
                    <div class="text-center shadow" style="background-color: #eeeeee;padding-top: 10px;padding-bottom: 10px;margin-bottom: 25px;padding-right: 10px;padding-left: 10px;"><img style="margin-bottom: 15px;max-width: 180px;" src="view/content/images/useful/arriere-plan.jpg" width="100%">
                        <ul class="list-unstyled text-left" style="font-style: normal;font-weight: bold;">
                            <li>Item 1</li>
                            <li>Item 2</li>
                            <li>Item 3</li>
                            <li>Item 4</li>
                            <li>Item 4</li>
                        </ul><button class="btn btn-primary" type="button" style="width: 100%;">Ajouter au panier</button></div>
                </div>
                <div class="col-md-3">
                    <div class="text-center shadow" style="background-color: #eeeeee;padding-top: 10px;padding-bottom: 10px;margin-bottom: 25px;padding-right: 10px;padding-left: 10px;"><img style="margin-bottom: 15px;max-width: 180px;" src="view/content/images/useful/arriere-plan.jpg" width="100%">
                        <ul class="list-unstyled text-left" style="font-style: normal;font-weight: bold;">
                            <li>Item 1</li>
                            <li>Item 2</li>
                            <li>Item 3</li>
                            <li>Item 4</li>
                            <li>Item 4</li>
                        </ul><button class="btn btn-primary" type="button" style="width: 100%;">Ajouter au panier<br></button></div>
                </div>
                <div class="col-md-3">
                    <div class="text-center shadow" style="background-color: #eeeeee;padding-top: 10px;padding-bottom: 10px;margin-bottom: 25px;padding-right: 10px;padding-left: 10px;"><img style="margin-bottom: 15px;max-width: 180px;" src="view/content/images/useful/arriere-plan.jpg" width="100%">
                        <ul class="list-unstyled text-left" style="font-style: normal;font-weight: bold;">
                            <li>Item 1</li>
                            <li>Item 2</li>
                            <li>Item 3</li>
                            <li>Item 4</li>
                            <li>Item 4</li>
                        </ul><button class="btn btn-primary" type="button" style="width: 100%;">Ajouter au panier</button></div>
                </div>
            </div>
        </div>
    </div>

<?php
$content = ob_get_clean();
require "gabarit.php";

?>