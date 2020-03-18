<?php
/**
 * Created by PhpStorm.
 * User: Mauricio COSTA CABRAL
 * Date: 06.03.2020
 * Version: 0.1
 */

ob_start();
$titre="Art-Music - Ajout d'un morceau";
?>

<div class="text-left" id="mainBlock" style="background-image: url(&quot;view/content/images/useful/arriere-plan.jpg&quot;);background-position: center;background-size: cover;background-repeat: no-repeat;position: relative;height: 500px;">
    <div class="container border rounded" style="background-color: #eeeeee;padding: 20px;position: absolute;transform: translate(-50%, -50%);left: 50%;top: 50%;max-width: 540px;">
        <div class="row">
            <div class="col-md-12">
                <h3>Album CD - xxxxxxxxxxx</h3>
                <h4>Ajout/modification de morceaux</h4><label style="margin-top: 5px;margin-bottom: 3px;">Titre</label><input class="d-block" type="text" style="width: 100%;"><label style="margin-top: 5px;margin-bottom: 3px;">Durée</label><input class="d-block"
                                                                                                                                                                                                                                                      type="text" style="width: 100%;"><label style="margin-top: 5px;margin-bottom: 3px;">Couverture du produit</label><input type="file" style="width: 100%;"><button class="btn btn-primary" type="button" style="width: 100%;margin-top: 15px;">Valider l'ajout/modification</button></div>
        </div>
    </div>
</div>


<?php
$content = ob_get_clean();
require "gabarit.php";

?>
