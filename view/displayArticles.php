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
                    <div class="text-center shadow" style="background-color: #eeeeee;padding-top: 10px;padding-bottom: 10px;margin-bottom: 25px;padding-right: 10px;padding-left: 10px; display: grid; width: 100%"><a href="index.php?action=displayArticleDetails&id=<?= $result['id']; ?>"><img class="rounded" style="margin-bottom: 15px;max-width: 180px; margin-left: auto; margin-right: auto;" src="view/content/images/covers/<?=$result['id'];?>.jpg" width="100%"></a>
                        <ul class="list-unstyled text-left" style="font-style: normal; margin-left: auto; margin-right: auto;">
                            <li style="margin-bottom: 0.5rem; display: flex; align-items: center"><img src="view/content/images/icons/nameAlbum.svg" alt="pictogramme" style="width: 30px; margin-right: 10px"><a href="index.php?action=displayArticleDetails&id=<?= $result['id']; ?>"><strong><?=$result['NameArticle'];?></strong></a></li>
                            <li style="margin-bottom: 0.5rem; display: flex; align-items: center"><img src="view/content/images/icons/microphone.svg" alt="pictogramme" style="width: 30px; margin-right: 10px"><strong><?=$result['NameArtist'];?></strong></li>
                            <li style="margin-bottom: 0.5rem; display: flex; align-items: center"><img src="view/content/images/icons/style.svg" alt="pictogramme" style="width: 30px; margin-right: 10px"><strong><?=$result['NameGenre'];?></strong></li>
                    <?php if ($typeArticle == "Vinyle"):?>
                            <li style="margin-bottom: 0.5rem; display: flex; align-items: center"><img src="view/content/images/icons/vinyleFormat.svg" alt="pictogramme" style="width: 30px; margin-right: 10px"><strong><?=$result['NameFormatVinyle'];?></strong></li>
                    <?php endif ?>
                            <li style="margin-bottom: 0.5rem; display: flex; align-items: center"><img src="view/content/images/icons/stock.svg" alt="pictogramme" style="width: 30px; margin-right: 10px"><strong><?=$result['quantity'];?></strong></li>
                            <li style="margin-bottom: 0.5rem; display: flex; align-items: center"><img src="view/content/images/icons/price.svg" alt="pictogramme" style="width: 30px; margin-right: 10px"><strong>CHF <?=$result['price'];?></strong></li>
                        </ul>
                    <?php if ($result['quantity'] == 0):?>
                        <div class="alert alert-danger" role="alert" style="margin: 0;">Produit indisponible</div>
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