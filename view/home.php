<?php
/**
 * Created by PhpStorm.
 * User: Mauricio COSTA CABRAL
 * Date: 06.03.2020
 * Version: 0.1
 */

ob_start();
$titre="Art-Music - Accueil";

?>

<img src="view/content/images/home/titre.jpg" width="100%" alt="image de présentation">

<div style="padding: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Présentation</h2>
                <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vehicula viverra elementum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam egestas pellentesque ligula, vitae consectetur
                    li hendrerit non. Mauris elementum dictum risus, at mollis mauris. Curabitur quis tristique mauris. Vestibulum faucibus leo quam, vel ornare quam interdum ac. Nam vitae lacus euismod, accumsan justo in, malesuada metus.<br><br>Curabitur quis tristique mauris. Vestibulum faucibus leo quam, vel ornare quam interdum ac. Nam vitae lacus euismod, accumsan justo in, malesuada metus. Curabitur quis tristique mauris. Vestibulum faucibus leo quam, vel ornare quam interdum ac. Nam vitae lacus euismod, accumsan justo in, malesuada metus.</p>
                <!-- <h2>Nos prestations</h2>
                <ul>
                    <li>Vente d'album CD & Vinyles</li>
                    <li>Pré-écoute en magasin ou sur notre site</li>
                    <li>Téléchargement direct possible</li>
                    <li>Conseils et orientations</li>
                </ul>-->
            </div>
            <div class="col-md-6 align-self-center"><img class="img-fluid shadow-lg rounded" src="view/content/images/home/presentation.jpg"></div>
        </div>
    </div>
</div>


<?php
$content = ob_get_clean();
require "gabarit.php";

?>
