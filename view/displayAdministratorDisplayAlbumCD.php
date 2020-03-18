<?php
/**
 * Created by PhpStorm.
 * User: Mauricio COSTA CABRAL
 * Date: 06.03.2020
 * Version: 0.1
 */

ob_start();
$titre="Art-Music - Liste des articles";
?>

<div id="mainBlock" style="background-image: url(&quot;view/content/images/useful/arriere-plan.jpg&quot;);background-position: center;background-size: cover;background-repeat: no-repeat;padding: 20px;position: relative;height: 600px;">
    <div class="container" style="background-color: #eeeeee;padding: 15px;position: absolute;transform: translate(-50%, -50%);left: 50%;top: 50%;">
        <div class="row">
            <div class="col-md-12">
                <h3>Compte administrateur - Mme/M. xxxxxxxxxx</h3>
                <h4>Liste des xxxxxxxx</h4><button class="btn btn-primary" type="button" style="width: 100%;">Ajouter un article</button></div>
        </div>
        <div class="row">
            <div class="col-md-12" style="margin-top: 25px;">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nom</th>
                            <th>Artiste</th>
                            <th class="desktopView">Année</th>
                            <th class="desktopView">Genre</th>
                            <th class="desktopView">Label</th>
                            <th class="desktopView">Quantité</th>
                            <th>Prix</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Cell 3</td>
                            <td>Cell 4</td>
                            <td>Cell 4</td>
                            <td>Cell 4</td>
                            <td>Cell 4</td>
                            <td>Cell 4</td>
                            <td>Cell 4</td>
                            <td>Cell 4</td>
                            <td class="text-center"><i class="fas fa-pen-square" style="font-size: 22px;margin-right: 5px;"></i><i class="fa fa-trash" style="font-size: 25px;"></i></td>
                        </tr>
                        <tr>
                            <td>Cell 3</td>
                            <td>Cell 4</td>
                            <td>Cell 4</td>
                            <td>Cell 4</td>
                            <td>Cell 4</td>
                            <td>Cell 4</td>
                            <td>Cell 4</td>
                            <td>Cell 4</td>
                            <td class="text-center"><i class="fas fa-pen-square" style="font-size: 22px;margin-right: 5px;"></i><i class="fa fa-trash" style="font-size: 25px;"></i></td>
                        </tr>
                        <tr>
                            <td>Cell 3</td>
                            <td>Cell 4</td>
                            <td>Cell 4</td>
                            <td>Cell 4</td>
                            <td>Cell 4</td>
                            <td>Cell 4</td>
                            <td>Cell 4</td>
                            <td>Cell 4</td>
                            <td class="text-center"><i class="fas fa-pen-square" style="font-size: 22px;margin-right: 5px;"></i><i class="fa fa-trash" style="font-size: 25px;"></i></td>
                        </tr>
                        <tr>
                            <td>Cell 3</td>
                            <td>Cell 4</td>
                            <td>Cell 4</td>
                            <td>Cell 4</td>
                            <td>Cell 4</td>
                            <td>Cell 4</td>
                            <td>Cell 4</td>
                            <td>Cell 4</td>
                            <td class="text-center"><i class="fas fa-pen-square" style="font-size: 22px;margin-right: 5px;"></i><i class="fa fa-trash" style="font-size: 25px;"></i></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




<?php
$content = ob_get_clean();
require "gabarit.php";

?>
