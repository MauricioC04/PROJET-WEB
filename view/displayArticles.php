<?php
/**
 * Created by PhpStorm.
 * User: Mauricio COSTA CABRAL
 * Date: 06.03.2020
 * Version: 0.1
 */

ob_start();
$titre="Art-Music - ". $typeArticle;

?>

    <div style="background-image: url(&quot;view/content/images/useful/arriere-plan.jpg&quot;);background-position: center;background-size: cover;background-repeat: no-repeat;padding-top: 25px;padding-bottom: 25px;min-height: 750px;">
        <div class="container rounded">
            <div class="row">
                <?php

                foreach ($allArticles as $result):
                ?>
                <div class="col-md-4" style="display: flex">
                    <div class="text-center shadow" style="background-color: #eeeeee;padding-top: 10px;padding-bottom: 10px;margin-bottom: 25px;padding-right: 10px;padding-left: 10px; display: grid; width: 100%"><img class="rounded" style="margin-bottom: 15px;max-width: 180px; margin-left: auto; margin-right: auto;" src="view/content/images/covers/<?=$result['id'];?><?=$result['NameArticle'];?>.jpg" width="100%">
                        <ul class="list-unstyled text-left" style="font-style: normal;">
                            <li>Album: <a href="index.php?action=displayArticleDetails&id=<?= $result['id']; ?>"><strong><?=$result['NameArticle'];?></strong></a></li>
                            <li>Artiste: <strong><?=$result['NameArtist'];?></strong></li>
                            <li>Genre: <strong><?=$result['NameGenre'];?></strong></li>
                    <?php if ($typeArticle == "Vinyle"):?>
                            <li>Format: <strong><?=$result['NameFormatVinyle'];?></strong></li>
                    <?php endif ?>
                            <li>Quantité: <strong><?=$result['quantity'];?></strong></li>
                            <li>Prix: <strong>CHF <?=$result['price'];?></strong></li>
                        </ul>
                    <?php if ($result['quantity'] == 0):?>
                        <div class="alert alert-danger" role="alert" style="margin: 0;">Produit indisponible !</div>
                    <?php else :?>
                        <button class="btn btn-primary" type="button" style="width: 100%;" onclick="window.location.href = 'index.php?action=updateCart&id=<?= $result["id"];?>&quantityWished=1';">Ajouter au panier</button>
                    <?php endif ?>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>

<?php
$content = ob_get_clean();
require "gabarit.php";

?>