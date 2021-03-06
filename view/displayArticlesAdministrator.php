<?php
/**
 * Created by PhpStorm.
 * User: Mauricio COSTA CABRAL
 * Date: 06.03.2020
 * Version: 0.1
 */

ob_start();
$titre="Art-Music - ".$typeArticle;
?>

<div class="d-flex align-items-center" id="mainBlock" style="background-image: url(&quot;view/content/images/useful/arriere-plan.jpg&quot;);background-position: center;background-size: cover;background-repeat: no-repeat;padding: 20px;">
    <div class="container rounded containerArticlesAdmin" style="background-color: #eeeeee;padding: 15px; height: fit-content;">
        <div class="row">
            <div class="col-md-9">
                <h3>Compte administrateur</h3>
                <h4>Liste des <?php if ($typeArticle == "Vinyle"):?>Vinyles<?php else :?>Albums CD<?php endif ?></h4>
            </div>
            <div class="col-lg-3">
                <button class="btn btn-primary" type="button" style="width: 100%; min-height: 50px; margin-top: 15px" onclick="window.location.href = 'index.php?action=displayAddArticle&typeArticle=<?= $typeArticle?>';">Ajouter un article</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="margin-top: 25px;">
                <div class="table-responsive text-center" id="mobileTableArticleAdmin">
                    <table class="table">

                        <tbody>
                        <?php

                        foreach ($allArticles as $result):
                        ?>
                        <tr style="padding-bottom: 15px; padding-top: 15px">
                            <td style="padding: 15px 0px 15px 0px">
                            <div style="display: flex; align-items: center;">
                                <img class="rounded" src="view/content/images/covers/<?=$result['id'];?>.jpg" style="width: 45%; max-width: 200px; margin-right: 10px">
                                <div style="text-align: left;">
                                    <div><strong><?= $result['NameArticle']; ?></strong></div>
                                    <div><?= $result['NameArtist']?></div>
                                    <div><?= $result['quantity']?> unité(s)</div>
                                    <span><strong>CHF <?= $result['price']?></strong></span>
                                        <div style="display: flex; align-items: center; margin-top: 5px;">
                                            <a href="index.php?action=displayUpdateArticle&id=<?= $result['id']; ?>&typeArticle=<?= $typeArticle; ?>"><i class="fas fa-pen-square" style="font-size: xx-large;margin-right: 10px;"></i></a>
                                            <a href="index.php?action=deleteArticle&id=<?= $result['id']; ?>&typeArticle=<?= $typeArticle; ?>"><i class="fas fa-trash-alt" style="font-size: 28px; color: brown"></i></a>
                                        </div>
                                </div>
                            </div>
                            </td>
                        </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>





                <div class="table-responsive d-none" id="desktopTableArticleAdmin">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nom</th>
                            <th>Artiste</th>
                            <th class="desktopView">Année</th>
                            <th class="desktopView">Genre</th>
                            <?php if ($typeArticle == "Vinyle"):?>
                            <th class="desktopView">Format</th>
                            <?php endif ?>
                            <th class="desktopView">Label</th>
                            <th class="desktopView">Quantité</th>
                            <th class="text-right">Prix</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $i = 1;

                        foreach ($allArticles as $result):
                        ?>
                        <tr>
                            <td class="desktopView" ><?= $i?></td>
                            <td class="desktopView"><?= $result['NameArticle'];?></td>
                            <td class="desktopView"><?= $result['NameArtist'];?></td>
                            <td class="desktopView"><?= $result['releaseYear'];?></td>
                            <td class="desktopView"><?= $result['NameGenre'];?></td>
                            <?php if ($typeArticle == "Vinyle"):?>
                                <td class="desktopView"><?= $result['NameFormatVinyle'];?></td>
                            <?php endif ?>
                            <td class="desktopView"><?= $result['NameLabel'];?></td>
                            <td class="desktopView"><?= $result['quantity'];?></td>
                            <td class="desktopView"><?= $result['price'];?></td>
                            <td class="desktopView"><div style="display: flex; align-items: center; justify-content: space-evenly;">
                                    <a href="index.php?action=displayUpdateArticle&id=<?= $result['id']; ?>&typeArticle=<?= $typeArticle; ?>"><i class="fas fa-pen-square" style="font-size: x-large;margin-right: 10px;"></i></a>
                                    <a href="index.php?action=deleteArticle&id=<?= $result['id']; ?>&typeArticle=<?= $typeArticle; ?>"><i class="fas fa-trash-alt" style="font-size: x-large; color: brown"></i></a>
                                </div></td>
                        </tr>
                        <?php $i++; endforeach; ?>
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
