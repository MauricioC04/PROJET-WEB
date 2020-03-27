<?php
/**
 * Created by PhpStorm.
 * User: Mauricio COSTA CABRAL
 * Date: 06.03.2020
 * Version: 0.1
 */

ob_start();
$titre="Art-Music - Détails article";
?>




<div style="background-image: url(&quot;view/content/images/useful/arriere-plan.jpg&quot;);background-position: center;background-size: cover;background-repeat: no-repeat;padding: 25px;display: flex;align-items: center;min-height: 750px;">
    <div class="container" style="background-color: #eeeeee;padding: 20px;padding-right: 35px;padding-left: 35px;">

        <div class="row d-flex">
            <div class="col-md-9 text-center" id="containerInfoProduct" style="width: 100%;">
                <div class="d-sm-flex justify-content-sm-center" style="display: flex;margin-bottom: 10px;">

                    <?php

                    foreach ($infosArticle as $result):
                        ?>
                        <img id="imgProduct" src="<?=$result['pathFileCover'];?>" width="100%" style="max-width: 190px;max-height: 190px;margin-bottom: 15px;">
                        <div style="text-align: left">
                            <h5><?=$result['name'];?></h5>
                            <h5><?=$result['NameArticle'];?></h5>
                            <h5><?=$result['NameArtist'];?></h5>
                            <h5><?=$result['NameGenre'];?></h5>
                            <h5><?=$result['releaseYear'];?> - <?=$result['NameLabel'];?></h5>
                            <h5><?=$numberOfMusics[0][0];?> titres</h5>
                        </div>
                    <?php
                    endforeach;
                    ?>

                </div><button class="btn btn-primary d-block" id="btnMobile" type="button" style="margin-left: auto;margin-right: auto;margin-bottom: 15px;width: 100%;" onclick="window.location.href = 'index.php?action=updateCart&id=<?= $result["id"];?>&quantityWished=1';">Ajouter au panier - CHF <?= $result["price"];?></button></div>
            <div class="col-md-3 d-flex justify-content-end align-self-md-stretch"><button class="btn btn-primary" id="btnDesktop" type="button" style="height: 80px;" onclick="window.location.href = 'index.php?action=updateCart&id=<?= $result["id"];?>&quantityWished=1';">Ajouter au panier - CHF <?= $result["price"];?></button></div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="align-middle" style="width: 25px">N°</th>
                            <th class="align-middle">Titre</th>
                            <th class="align-middle" style="width: 75px">Durée</th>
                            <th class="align-middle" style="width: 75px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $i = 1;

                        foreach ($detailsArticle as $result) : ?>

                            <tr>
                                <td class="align-middle"><?= $i; ?></td>
                                <td class="align-middle"><?= $result['title']; ?></td>
                                <td class="align-middle"><?= $result['duration']; ?></td>
                                <td class="align-middle"><a href="#"><i class="fas fa-play-circle" style="font-size: x-large"></i></a></td>
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
