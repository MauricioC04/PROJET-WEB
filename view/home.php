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


<img src="view/content/images/home/titre1.jpg" width="100%" alt="image de présentation">
<div style="padding: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Qui sommes-nous ?</h2>
                <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vehicula viverra elementum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam egestas pellentesque ligula, vitae consectetur
                    ex hendrerit non. Mauris elementum dictum risus, at mollis mauris. Curabitur quis tristique mauris. Vestibulum faucibus leo quam, vel ornare quam interdum ac. Nam vitae lacus euismod, accumsan justo in, malesuada metus.<br><br></p>
                <h1>Nos prestations ?</h1>
                <ul>
                    <li>Item 1</li>
                    <li>Item 2</li>
                    <li>Item 3</li>
                    <li>Item 4</li>
                </ul>
            </div>
            <div class="col-md-6 align-self-center"><img class="img-fluid shadow-lg" src="view/content/images/home/presentation.jpg" width="100%"></div>
        </div>
    </div>
</div>


<?php
$content = ob_get_clean();
require "gabarit.php";

?>
