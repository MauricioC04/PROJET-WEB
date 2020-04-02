<?php
/**
 * Created by PhpStorm.
 * User: Mauricio COSTA CABRAL
 * Date: 06.03.2020
 * Version: 0.1
 */

ob_start();
$titre="Art-Music - Ajout d'un article";
?>

<div id="mainBlock" class="pt-4 pb-4 pr-2 pl-2 pr-sm-3 pl-sm-3 pr-md-4 pl-md-4" style="background-image: url(&quot;view/content/images/useful/arriere-plan.jpg&quot;);padding-top: 30px;padding-bottom: 30px;background-position: center;background-size: cover;background-repeat: no-repeat; display: flex; align-items: center">
    <div class="container border rounded" id="blockInscription" style="background-color: #f2f5f8;padding-right: 15px;padding-top: 15px;padding-bottom: 15px; max-width: 720px;">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center"><i class="fa fa-plus-square" style="font-size: 45px;"></i><br>Ajout d'un <?= $typeArticle ?></h2>
            </div>
        </div>
        <form action="index.php?action=<?php if ($_GET['action'] == 'displayUpdateArticle') :?>updateArticle<?php else :?>addNewArticle<?php endif ?>" method="POST" enctype="multipart/form-data">
        <div class="row mt-4 flex-wrap flex-sm-nowrap">


            <input hidden value="<?= $typeArticle ?>" name="typeArticle">
            <input hidden value="<?= @$infosArticle[0]['id'] ?>" name="idArticle">
            <div class="col-md-6 d-flex flex-column" id="colDroite" style="margin-bottom: 10px;">
                <input class="d-block inputStyle" placeholder="Nom de l'article" type="text" style="width: 100%;" value="<?= @$infosArticle[0]['NameArticle'] ?>" name="nameArticle" <?php if ($_GET['action'] == 'displayAddArticle') :?>required<?php endif ?>>
                <input class="d-block inputStyle" placeholder="Nom de l'artiste" type="text" style="width: 100%;" value="<?= @$infosArticle[0]['NameArtist'] ?>" name="nameArtist" <?php if ($_GET['action'] == 'displayAddArticle') :?>required<?php endif ?>>
                <select class="d-block inputStyle" style="width: 100%;height: 31px; color: #8f8f8f" name="origineArtist" <?php if ($_GET['action'] == 'displayAddArticle') :?>required<?php endif ?>>
                        <option disabled selected>Origine de l'artiste</option>
                    <?php

                    foreach ($allCountries as $result):
                    ?>
                        <?php if (@$infosArticle[0]['NameCountry'] == $result['name']) :?>
                        <option value="<?= $result['name'] ?>" selected><?= $result['name'] ?></option>
                    <?php else :?>
                        <option value="<?= $result['name'] ?>"><?= $result['name'] ?></option>
                    <?php endif ?>
                    <?php endforeach ?>
                </select>
                <select class="d-block inputStyle" style="width: 100%;height: 31px; color: #8f8f8f" name="genreMusic" <?php if ($_GET['action'] == 'displayAddArticle') :?>required<?php endif ?>>
                    <option disabled selected>Genre musicale</option>
                    <?php

                    foreach ($allGenresMusic as $result):
                        ?>

                        <?php if (@$infosArticle[0]['NameGenre'] == $result['name']) :?>
                        <option value="<?= $result['name'] ?>" selected><?= $result['name'] ?></option>
                        <?php else :?>
                        <option value="<?= $result['name'] ?>"><?= $result['name'] ?></option>
                        <?php endif ?>
                    <?php endforeach ?>
                </select>
                <button class="btn btn-primary d-none d-sm-block mt-2" type="submit" name="submit" style="width: 100%;margin-top: 20px; background-color: #0036dd; height: 65px">Valider les modifications</button>
            </div>

            <div class="col-md-6" id="colGauche">
                <input class="d-block inputStyle" placeholder="Label" type="text" style="width: 100%;" value="<?= @$infosArticle[0]['NameLabel'] ?>" name="nameLabel" <?php if ($_GET['action'] == 'displayAddArticle') :?>required<?php endif ?>>
                <div class="d-flex flex-row justify-content-center justify-content-sm-start" style="width: 100%;">
                    <div style="width: 50%;"><input class="d-block inputStyle" placeholder="Quantité" type="number" style="width: 90%;" value="<?= @$infosArticle[0]['quantity'] ?>" name="quantity" <?php if ($_GET['action'] == 'displayAddArticle') :?>required<?php endif ?>></div>
                    <div style="width: 50%;"><input class="d-block inputStyle" placeholder="Prix unitaire" type="number" step="0.05" style="width: 100%;" value="<?= @$infosArticle[0]['price'] ?>" name="price" <?php if ($_GET['action'] == 'displayAddArticle') :?>required<?php endif ?>></div>
                </div>
                <div class="d-flex flex-row justify-content-center justify-content-sm-start divTwoInput" style="width: 100%;">
                    <div style="width: 50%;"><input class="d-block inputStyle" placeholder="Année de sortie" type="text" style="width: 90%;" value="<?= @$infosArticle[0]['releaseYear'] ?>" name="releaseYear" <?php if ($_GET['action'] == 'displayAddArticle') :?>required<?php endif ?>></div>
                    <?php if ($typeArticle == 'Vinyle') :?>
                    <div style="width: 50%;">
                        <select class="d-block inputStyle" style="width: 100%;height: 31px; color: #8f8f8f" name="vinyleFormat" <?php if ($_GET['action'] == 'displayAddArticle') :?>required<?php endif ?>>
                            <option disabled selected>Format Vinyle</option>
                            <?php

                            foreach ($allVinyleFormats as $result):
                                ?>

                            <?php if (@$infosArticle[0]['NameFormatVinyle'] == $result['name']) :?>
                                <option value="<?= $result['name'] ?>" selected><?= $result['name'] ?></option>
                            <?php else :?>
                                <option value="<?= $result['name'] ?>"><?= $result['name'] ?></option>
                            <?php endif ?>

                            <?php endforeach ?>
                        </select>
                    </div>
                    <?php endif ?>
                </div>
                <div style="margin-bottom: 2.5rem; width: fit-content; height: 31px">
                    <label class="customFileInput"><input type="file" id="coverInput" style="display: none" oninput="checkInput(this);" value="<?php if ($_GET['action'] == 'displayUpdateArticle') :?>alreadySet<?php endif ?>" name="coverInput" <?php if ($_GET['action'] == 'displayAddArticle') :?>required<?php endif ?>>Choisir une couverture:&nbsp;&nbsp;</label><img class="rounded ml-2" src="<?php if (@$infosArticle[0]['NameArticle'] != "") :?>view/content/images/covers/<?= @$infosArticle[0]['id']?>.jpg<?php endif ?>" id="coverImage" style="max-width: 50px;">
                </div>

                <button class="btn btn-primary d-sm-none" type="submit" name="submit" style="width: 100%; background-color: #0036dd; height: 65px">Valider les modifications</button>
                <?php if ($_GET['action'] == 'displayUpdateArticle') :?>
                <button class="btn btn-primary d-sm-block mt-2 mt-md-0" type="button" onclick="window.location.href = 'index.php?action=displayArticleDetails&id=<?= @$infosArticle[0]['id']?>';" style="width: 100%; height: 65px">Ajouter/Modifier des morceaux</button>
                <?php endif ?>
            </div>



        </div>
        </form>
    </div>
</div>

<script>
    function checkInput(input) {

        var inputFile = document.getElementById("coverInput").value;


        if (inputFile != "") {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    document.getElementById("coverImage").setAttribute('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }

        }
        else{
            document.getElementById("coverInput").src = "";
        }
    }
</script>


<?php
$content = ob_get_clean();
require "gabarit.php";

?>
