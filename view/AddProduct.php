<?php
/**
 * Created by PhpStorm.
 * User: Mauricio COSTA CABRAL
 * Date: 06.03.2020
 * Version: 0.1
 */

ob_start();
$titre="Art-Music - Ajout d'un produit";
?>

<div id="mainBlock" style="background-image: url(&quot;view/content/images/useful/arriere-plan.jpg&quot;);padding-top: 30px;padding-bottom: 30px;background-position: center;background-size: cover;background-repeat: no-repeat;height: auto;position: relative;">
    <div class="container border rounded" id="blockInscription" style="background-color: #f2f5f8;padding-right: 15px;padding-top: 15px;padding-bottom: 15px;">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center"><i class="fa fa-plus-square" style="font-size: 45px;"></i><br>Ajout d'un produit</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" id="colDroite" style="margin-bottom: 10px;"><label style="margin-top: 5px;margin-bottom: 3px;">Nom du produit</label><input class="d-block" type="text" style="width: 100%;"><label style="margin-bottom: 3px;margin-top: 5px;">Artiste</label><input class="d-block" type="text" style="width: 100%;">
                <label
                    style="margin-top: 5px;margin-bottom: 3px;">Genre</label><select class="d-block" style="width: 100%;height: 30px;"><optgroup label="This is a group"><option value="12" selected="">This is item 1</option><option value="13">This is item 2</option><option value="14">This is item 3</option></optgroup></select>
                <label
                    style="margin-top: 5px;margin-bottom: 3px;">Origine</label><select class="d-block" style="width: 100%;height: 30px;"><optgroup label="This is a group"><option value="12" selected="">This is item 1</option><option value="13">This is item 2</option><option value="14">This is item 3</option></optgroup></select>
                <button
                    class="btn btn-primary" id="buttonValidationProduct" type="button" style="width: 100%;margin-top: 20px;">Valider les modifications du produit</button>
            </div>
            <div class="col-md-6" id="colGauche"><label style="margin-top: 5px;margin-bottom: 3px;">Label</label><input class="d-block" type="email" style="width: 100%;"><label style="margin-top: 5px;margin-bottom: 3px;">Couverture du produit</label><input type="file" style="width: 100%;">
                <div
                    class="d-flex flex-row justify-content-between" style="width: 100%;">
                    <div style="width: 50%;max-width: 150px;"><label style="margin-top: 5px;margin-bottom: 3px;">Quantité</label><input type="number" style="width: 90%;"></div>
                    <div style="width: 50%;"><label style="margin-top: 5px;margin-bottom: 3px;">Prix unitaire (CHF)</label><input type="text" style="width: 100%;"></div>
                </div>
                <div class="d-flex flex-row justify-content-between divTwoInput" style="width: 100%;">
                    <div style="width: 50%;max-width: 150px;"><label style="margin-top: 5px;margin-bottom: 3px;">Format Vinyle</label><select class="d-block" style="width: 90%;height: 30px;"><optgroup label="This is a group"><option value="12" selected="">This is item 1</option><option value="13">This is item 2</option><option value="14">This is item 3</option></optgroup></select></div>
                    <div
                        style="width: 50%;"><label style="margin-top: 5px;margin-bottom: 3px;">Année de sortie</label><input class="d-block" type="text" style="width: 100%;"></div>
                </div><button class="btn btn-primary" id="buttonValidationProductMobile" type="button" style="width: 100%;margin-top: 20px;">Valider les modifications du produit</button><button class="btn btn-primary" type="button" style="width: 100%;margin-top: 20px;">Ajouter/Modifier des morceaux</button></div>
        </div>
    </div>
</div>




<?php
$content = ob_get_clean();
require "gabarit.php";

?>
