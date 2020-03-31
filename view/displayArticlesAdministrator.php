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
    <div class="container rounded" style="background-color: #eeeeee;padding: 15px; height: fit-content;">
        <div class="row">
            <div class="col-md-9">
                <h3>Compte administrateur</h3>
                <h4>Liste des <?php if ($typeArticle == "Vinyle"):?>Vinyles<?php else :?>Albums CD<?php endif ?></h4>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary" type="button" style="width: 100%; height: 50px">Ajouter un article</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="margin-top: 25px;">
                <div class="table-responsive text-center" id="mobileTable">
                    <table class="table">

                        <thead>
                        <?php if(@$deleteResult == 'succeed'):?>
                            <th style="color: darkgreen">L'article a correctement été supprimé</th>
                        <?php endif ?>
                        <?php if(@$deleteResult == 'failure'):?>
                            <th style="color: brown">Une erreur est survenue lors de la suppression. Veuillez ressayer.</th>
                        <?php endif ?>
                        </thead>
                        <tbody>
                        <?php

                        foreach ($allArticles as $result):
                        ?>
                        <tr style="padding-bottom: 15px; padding-top: 15px">
                            <td>
                            <div style="display: flex; align-items: center;">
                                <img src="<?= $result['pathFileCover']; ?>" style="max-width: 40%; margin-right: 10px">
                                <div style="text-align: left">
                                    <div><?= $result['NameArticle']; ?></div>
                                    <div><?= $result['NameArtist']?></div>
                                    <div><?= $result['quantity']?> unité(s)</div>
                                    <span><strong>CHF <?= $result['price']?></strong></span>
                                        <div style="display: flex; align-items: center; margin-top: 5px;">
                                            <a href="index.php?action=displayArticleDetails&id=<?= $result['id']; ?>"><i class="fas fa-pen-square" style="font-size: xx-large;margin-right: 10px;"></i></a>
                                            <a href="index.php?action=deleteArticleFromList&id=<?= $result['id']; ?>&typeArticle=<?= $typeArticle; ?>"><i class="fas fa-trash-alt" style="font-size: 28px; color: brown"></i></a>
                                        </div>
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
                            <th>Prix</th>
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
                            <td class="desktopView"><div style="display: flex; align-items: center; justify-content: space-evenly; margin-top: 15px;">
                                    <a href="index.php?action=displayArticleDetails&id=<?= $result['id']; ?>"><i class="fas fa-pen-square" style="font-size: x-large;margin-right: 10px;"></i></a>
                                    <a href="index.php?action=deleteArticleFromCart&id=<?= $i-1; ?>"><i class="fas fa-trash-alt" style="font-size: x-large; color: brown"></i></a>
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
