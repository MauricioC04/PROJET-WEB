<?php
/**
 * Created by PhpStorm.
 * User: Mauricio COSTA CABRAL
 * Date: 06.03.2020
 * Version: 0.1
 */

ob_start();
$titre="Art-Music - Détails commande";
?>


        <div class="d-flex align-items-center pt-4 pb-4 pr-2 pl-2 pr-sm-3 pl-sm-3 pr-md-4 pl-md-4" id="mainBlock" style="background-image: url(&quot;view/content/images/useful/arriere-plan.jpg&quot;);padding-top: 40px;padding-bottom: 40px;background-position: center;background-size: cover;background-repeat: no-repeat;padding-right: 0;padding-left: 0;">
            <div class="container rounded" style="background-color: #f2f5f8;padding-right: 15px;padding-top: 15px;padding-bottom: 15px;padding-left: 15px;height: fit-content;">
                <div class="row">
                    <div class="col-md-12" style="text-align: center">
                        <?php
                        $totalAmount = 0;
                        foreach ($detailsOrder as $result) : ?>

                            <?php $totalAmount+= $result['price']*$result['quantity']; $orderDate = $result['orderDate']; $orderId = $result['orderId']; endforeach ?>
                        <h2 class="text-center"><i class="fas fa-shopping-cart" style="font-size: 45px;"></i><br>Votre commande N°<?= $orderId; ?> du <?= $orderDate; ?><br>Montant total CHF <?= $totalAmount; ?></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="margin-bottom: 10px;margin-top: 10px;">
                        <div class="table-responsive text-center" id="mobileTable">
                            <table class="table">
                                <tbody>
                                    <?php

                                    $i = 1;

                                    foreach ($detailsOrder as $result) : ?>
                                    <tr>
                                        <td>
                                            <div style="display: flex; align-items: center;">
                                                <img src="view/content/images/covers/<?=$result['articleId'];?>.jpg" style="max-width: 40%; margin-right: 10px">
                                                <div style="text-align: left">
                                                    <div><?= $result['articleType']; ?></div>
                                                    <a href="index.php?action=displayArticleDetails&id=<?= $result['articleId']; ?>"><div><?= $result['nameArticle']; ?></div></a>
                                                    <div><strong>CHF <?= $result['price']*$result['quantity']; ?></strong></div>
                                                        <div style="display: flex; align-items: center;"><?= $result['quantity']; ?> unité(s)</div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                        <?php endforeach ?>
                                    </tbody>
                            </table>
                        </div>


                        <div class="table-responsive d-none" id="desktopTable">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="align-middle">N°</th>
                                    <th class="align-middle">Type</th>
                                    <th class="align-middle">Nom</th>
                                    <th class="align-middle">Artiste</th>
                                    <th class="align-middle">Année</th>
                                    <th style="width: 115px" class="align-middle">Quantité</th>
                                    <th style="text-align: right" class="align-middle">Montant</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php

                                $i = 1;


                                foreach ($detailsOrder as $result) : ?>

                                    <tr>
                                        <td class="align-middle"><?= $i; ?></td>
                                        <td class="align-middle"><?= $result['articleType']; ?></td>
                                        <td class="align-middle"><a href="index.php?action=displayArticleDetails&id=<?= $result['articleId']; ?>"><?= $result['nameArticle']; ?></a></td>
                                        <td class="align-middle"><?= $result['nameArtist']; ?></td>
                                        <td class="align-middle"><?= $result['releaseYear']; ?></td>
                                        <td class="align-middle"><?= $result['quantity']; ?></td>
                                        <td style="text-align: right;" class="align-middle">CHF <?= $result['price']*$result['quantity']; ?></td>
                                    </tr>

                                <?php $i++; endforeach ?>

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
