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


    <div id="blockRows" class="pt-4 pb-4 pr-2 pl-2 pr-sm-3 pl-sm-3 pr-md-4 pl-md-4" style="background-image: url(&quot;view/content/images/useful/arriere-plan.jpg&quot;);background-position: center;background-size: cover;background-repeat: no-repeat; display: flex; align-items: center; min-height: 800px">
        <div class="container border rounded pt-3 pb-3 p-1 p-sm-4" id="containerBlock" style="background-color: #f2f5f8;">
            <div class="row">
                <div class="col-md-12 pl-4 pr-4 pl-md-2 pr-md-2" style="margin-bottom: 15px">
                    <h2>Compte client</br><span style="color: #214a80; font-weight: bold"><?=$_SESSION['userFirstname']; ?> <?=$_SESSION['userName']; ?></span></span></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 p-4 p-md-0 pl-md-2 pr-md-2">
                    <h4>Données personnelles</h4>
                    <?php if (@$_GET['errorUpdate'] == true) :?>
                        <h5 style="text-align: center"><span style="color: red; font-weight: bold;">Un problème est survenu lors de la modification des données.</span></h5>
                    <?php endif ?>
                    <?php if (@$_GET['errorCityZip'] == true) :?>
                        <h5 style="text-align: center"><span style="color: red; font-weight: bold;">Veuillez renseigner un code postale et une localité SUISSE</span></h5>
                    <?php endif ?>
                    <?php if (@$_GET['emptyInput'] == true) :?>
                        <h5 style="text-align: center"><span style="color: red; font-weight: bold;">Veuillez remplir tous les champs correctement</span></h5>
                    <?php endif ?>
                    <form method="post" action="index.php?action=updateDataUser">
                        <input class="d-block d-block inputStyle" type="text" style="width: 100%; margin-top: 25px" placeholder="Nom" value="<?=$_SESSION['userName']; ?>" name="name">
                        <input class="d-block d-block inputStyle" type="text" style="width: 100%;" placeholder="Prénom" value="<?=$_SESSION['userFirstname']; ?>" name="firstname">
                        <input class="d-block d-block inputStyle" type="text" style="width: 100%;" placeholder="Adresse" value="<?=$_SESSION['userAddress']; ?>" name="address">
                        <div class="d-flex flex-row justify-content-between" style="width: 100%;">
                            <div><input class="d-block inputStyle" type="number" style="width: 90%;" placeholder="NPA" value="<?=$_SESSION['userZip']; ?>" name="zip"></div>
                            <div style="width: 90%;"><input class="d-block inputStyle" type="text" style="width: 100%;" placeholder="Localité" value="<?=$_SESSION['userCity']; ?>" name="city">
                        </div>

                        </div>
                        <button class="btn btn-primary" type="submit" style="width: 100%;margin-top: 5px;">Modifier mes données personnelles</button>
                    </form>
                </div>
                <div class="col-lg-6 mt-4 mt-lg-0">
                    <h4>Vos précédentes commandes</h4>
                    <div class="border rounded-0" style="height: 315px; overflow: scroll;">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="d-none d-md-table-cell">N°</th>
                                <th style="min-width: 106px">Date</th>
                                <th style="min-width: 110px">Montant</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($previousOrders as $result) : ?>
                                <tr>
                                    <td class="d-none d-md-table-cell"><?= $result['id']; ?></td>
                                    <td><?= $result['orderDate']; ?></td>
                                    <td>CHF <?= $result['totalCost']; ?>.-</td>
                                    <td><a href="index.php?action=displayDetailsOrder&orderId=<?= $result['id']; ?>">Détails</a></td>
                                </tr>
                            <?php endforeach ?>
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