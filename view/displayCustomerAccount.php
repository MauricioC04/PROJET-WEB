<?php
/**
 * Created by PhpStorm.
 * User: Mauricio COSTA CABRAL
 * Date: 06.03.2020
 * Version: 0.1
 */

ob_start();
$titre="Art-Music - Compte client";
?>


    <div id="blockRows" style="padding: 20px;background-image: url(&quot;view/content/images/useful/arriere-plan.jpg&quot;);background-position: center;background-size: cover;background-repeat: no-repeat;position: relative;">
        <div class="container border rounded" id="containerBlock" style="background-color: #f2f5f8;padding: 15px;">
            <div class="row">
                <div class="col-md-12">
                    <h2>Compte client - Mme/M xxxxxxx</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h4>Données personnelles</h4>
                    <form><label style="margin-top: 5px;margin-bottom: 3px;">Nom</label><input class="form-control d-block" type="text" style="width: 100%;"><label style="margin-top: 5px;margin-bottom: 3px;">Prénom</label><input class="form-control d-block"
                                                                                                                                                                                                                                     type="text" style="width: 100%;"><label style="margin-top: 5px;margin-bottom: 3px;">Adresse</label><input class="form-control d-block" type="text" style="width: 100%;">
                        <div class="d-flex flex-row justify-content-between" style="width: 100%;">
                            <div><label style="margin-top: 5px;margin-bottom: 3px;">NPA</label><input class="form-control" type="number" style="width: 90%;"></div>
                            <div style="width: 90%;"><label style="margin-top: 5px;margin-bottom: 3px;">Localité</label><input class="form-control" type="text" style="width: 100%;"></div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6" style="margin-top: 25px;">
                    <h4>Vos précédentes commandes</h4>
                    <div class="border rounded-0 border-info" style="height: 200px;overflow: scroll;"></div>
                </div>
            </div>
        </div>
    </div>


<?php
$content = ob_get_clean();
require "gabarit.php";

?>