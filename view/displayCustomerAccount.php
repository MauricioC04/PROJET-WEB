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
                        <label style="margin-top: 5px;margin-bottom: 3px;">Nom</label><input class="form-control d-block" type="text" style="width: 100%;" value="<?=$_SESSION['userName']; ?>" name="name">
                        <label style="margin-top: 5px;margin-bottom: 3px;">Prénom</label><input class="form-control d-block" type="text" style="width: 100%;" value="<?=$_SESSION['userFirstname']; ?>" name="firstname">
                        <label style="margin-top: 5px;margin-bottom: 3px;">Adresse</label><input class="form-control d-block" type="text" style="width: 100%;" value="<?=$_SESSION['userAddress']; ?>" name="address">
                        <div class="d-flex flex-row justify-content-between" style="width: 100%;">
                            <div><label style="margin-top: 5px;margin-bottom: 3px;">NPA</label><input class="form-control" type="number" style="width: 90%;" value="<?=$_SESSION['userZip']; ?>" name="zip"></div>
                            <div style="width: 90%;"><label style="margin-top: 5px;margin-bottom: 3px;">Localité</label><input class="form-control" type="text" style="width: 100%;" value="<?=$_SESSION['userCity']; ?>" name="city">
                        </div>

                        </div>
                        <button class="btn btn-primary" type="submit" style="width: 100%;margin-top: 20px;">Modifier mes données personnelles</button>
                    </form>
                </div>
                <div class="col-md-6" style="margin-top: 25px;">
                    <h4>Vos précédentes commandes</h4>
                    <div class="border rounded-0 border-info" style="height: 200px;overflow: scroll;">
                        <table>
                            <tr>
                                <th>N°</th>
                                <th>Date</th>
                                <th>Montant</th>
                                <th></th>
                            </tr>
                            <?php
                            foreach ($previousOrders as $result) : ?>
                                <tr>
                                    <td><?= $result['id']; ?></td>
                                    <td><?= $result['orderDate']; ?></td>
                                    <td>CHF <?= $result['totalCost']; ?>.-</td>
                                    <td><?= $result['id']; ?><a href="index.php?action=displayDetailsOrder&id=<?= $result['id']; ?>">Détails</a></td>
                                </tr>
                            <?php endforeach ?>
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