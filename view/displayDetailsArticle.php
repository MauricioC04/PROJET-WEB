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
    <div class="container rounded" style="background-color: #eeeeee;padding: 10px;padding-right: 10px;padding-left: 10px;">

        <div class="row d-flex">
            <div class="col-md-9 text-center" id="containerInfoProduct" style="width: 100%;">
                <div class="d-sm-flex justify-content-sm-center" id="subContainerInfoProduct" style="display: flex;margin-bottom: 10px;">

                    <?php

                    foreach ($infosArticle as $result):
                        ?>
                        <img class="rounded" id="imgProduct" src="view/content/images/covers/<?=$result['id'];?>.jpg" width="100%" style="max-width: 235px;max-height: 235px;margin-bottom: 15px;">
                        <div id="descriptionProduct" style="text-align: left">
                            <h6><?php if ($result['name'] == 'Vinyle') :?>
                                    <i class="fas fa-compact-disc" style="font-size: 30px; vertical-align: sub"></i>
                                <?php else :?>
                                <img src="view/content/images/icons/album.svg" alt="pictogramme" style="width: 30px">
                                <?php endif ?>&nbsp;&nbsp;<?=$result['name'];?></h6>
                            <h6><img src="view/content/images/icons/nameAlbum.svg" alt="pictogramme" style="width: 30px">&nbsp;&nbsp;&nbsp;<?=$result['NameArticle'];?></h6>
                            <h6><img src="view/content/images/icons/microphone.svg" alt="pictogramme" style="width: 30px">&nbsp;&nbsp;&nbsp;<?=$result['NameArtist'];?></h6>
                            <h6><img src="view/content/images/icons/style.svg" alt="pictogramme" style="width: 30px">&nbsp;&nbsp;&nbsp;<?=$result['NameGenre'];?></h6>
                            <?php if ($result['name'] == 'Vinyle') :?>
                                    <h6><img src="view/content/images/icons/vinyleFormat.svg" alt="pictogramme" style="width: 30px">&nbsp;&nbsp;&nbsp;<?=$result['NameFormatVinyle'];?></h6>
                            <?php endif ?>
                            <h6><img src="view/content/images/icons/releaseYear.svg" alt="pictogramme" style="width: 30px">&nbsp;&nbsp;&nbsp;<?=$result['releaseYear'];?></h6>
                            <h6><img src="view/content/images/icons/houseMusic.svg" alt="pictogramme" style="width: 30px; vertical-align: middle">&nbsp;&nbsp;&nbsp;<?=$result['NameLabel'];?></h6>
                            <h6><i class="material-icons" style="font-size: 30px; vertical-align: middle">queue_music</i>&nbsp;&nbsp;&nbsp;<?=$numberOfMusics[0][0];?> titres</h6>
                        </div>
                    <?php endforeach ?>

                </div>

                <button class="btn btn-primary d-block" id="btnMobile" type="button" style="margin-left: auto;margin-right: auto;margin-bottom: 15px;width: 100%;" onclick="window.location.href =<?php if (@$_SESSION['userType'] == "administrator"):?>'index.php?action=displayAddMusic&idArticle=<?= $result["id"]; ?>';">Ajouter un morceau<?php else :?>'index.php?action=updateCart&id=<?= $result["id"];?>&quantityWished=1';">Ajouter au panier<br>CHF <?= $result["price"];?><?php endif ?></button>

            </div>

            <div class="col-md-3 d-flex justify-content-end align-self-md-stretch">
                <button class="btn btn-primary" id="btnDesktop" type="button" style="height: 80px;" onclick="window.location.href ='<?php if (@$_SESSION['userType'] == "administrator"):?>index.php?action=displayAddMusic&idArticle=<?= $result["id"]; ?>';">Ajouter un morceau<?php else :?>index.php?action=updateCart&id=<?= $result["id"];?>&quantityWished=1';">Ajouter au panier<br>CHF <?= $result["price"];?><?php endif ?></button>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="align-middle" style="width: 25px">N°</th>
                            <th class="align-middle">Titre</th>
                            <th class="align-middle d-none" id="desktopCellDuration" style="width: 75px">Durée</th>
                            <th class="align-middle" style="width: 75px">Action</th>
                            <?php if (@$_SESSION['userType'] == 'administrator') :?>
                            <th></th>
                            <?php endif ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($detailsArticle[0]['idMusic'])) :?>
                        <?php



                            $i = 1;
                            $idStart = $detailsArticle[0]['idMusic'];
                            $idEnd = $idStart;

                            foreach ($detailsArticle as $result) :
                             ?>

                            <tr>
                                <td class="align-middle"><?= $i; ?></td>
                                <td class="align-middle"><?= $result['title']; ?></td>
                                <td class="align-middle d-none" id="desktopCellDuration"><?= $result['duration']; ?></td>
                                <audio id="music<?= $result['idMusic']; ?>" preload="none">
                                    <source  src="view/content/musics/<?= $result['idMusic']; ?><?= str_replace("+"," ", urldecode($result['title'])); ?>.mp3" type="audio/mpeg">
                                </audio>
                                <td class="align-middle" style="text-align: center"><i id="pButton<?= $result['idMusic']; ?>" class="fas fa-play-circle" style="font-size: xx-large; cursor: pointer" onclick="changeButton(<?= $result['idMusic']; ?>)"></i></td>
                                <?php if (@$_SESSION['userType'] == 'administrator') :?>
                                <td style="padding-right: 5px; width: 65px;">
                                    <div style="display: flex; flex-direction: column;">
                                        <a href="index.php?action=displayUpdateMusic&idMusic=<?= $result['idMusic']; ?>&idArticle=<?= $infosArticle[0]['id']; ?>"><i class="fas fa-pen-square" style="font-size: xx-large; width: 30px; margin-bottom: 10px"></i></a>
                                        <a href="index.php?action=deleteMusic&idMusic=<?= $result['idMusic']; ?>&titleMusic=<?= $result['title']; ?>&idArticle=<?= $infosArticle[0]['id']; ?>"><i class="fas fa-trash-alt" style="font-size: xx-large; width: 30px; color: brown"></i></a>
                                    </div>
                                </td>
                                <?php endif ?>
                            </tr>

                            <?php $i++; $idEnd++; endforeach ?>
                        <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    var pageLoaded = false;

    function myFunction(){
        pageLoaded = true;
    }


    function changeButton(ab){
        if(pageLoaded) {

                if (document.getElementById("pButton" + ab).className == "fas fa-play-circle") {

                    var i;

                    for(i = <?= $idStart; ?>; i < <?= $idEnd; ?>; i++){
                        document.getElementById("pButton" + i).className = "";
                        document.getElementById("pButton" + i).className = "fas fa-play-circle";
                        document.getElementById("music" + i).pause();
                    }

                    document.getElementById("pButton" + ab).className = "";
                    document.getElementById("pButton" + ab).className = "fas fa-pause-circle text-primary";
                    document.getElementById("music" + ab).currentTime=30;
                    setTimeout(function(){
                        document.getElementById("music" + ab).play();

                    }, 500);

                    setTimeout(function(){
                            document.getElementById("music" + ab).pause();
                            document.getElementById("pButton" + ab).className = "";
                            document.getElementById("pButton" + ab).className = "fas fa-play-circle";
                        },
                        30000);
                } else {

                    document.getElementById("pButton" + ab).className = "";
                    document.getElementById("pButton" + ab).className = "fas fa-play-circle";
                    document.getElementById("music" + ab).pause();
                }
        }
    }

    /*window.onload = function test1(){
        console.log((document.getElementById("pButton1")));
        test();
    }


        function test() {

            for (i = 1; i < <?= $i; ?>; i++) {

                document.getElementById("pButton" + i).onclick = changeButton;




            }
        }

    function changeButton{
        for (i = 1; i < <?= $i; ?>; i++) {
            if (this.className == "fas fa-play-circle") {
                this.className = "";
                this.className = "fas fa-pause-circle";
                document.getElementById("music" + i).play();
            } else {
                this.className = "";
                this.className = "fas fa-play-circle";
                document.getElementById("music" + i).pause();
            }
        }
    }*/

        /*function player(ab, cd) {
            // start music
            if (ab.paused) {
                ab.play();
                // remove play, add pause
                cd.className = "";
                cd.className = "fas fa-pause-circle";

            }
            else { // pause music
                ab.pause();
                // remove pause, add play
                cd.className = "";
                cd.className = "fas fa-play-circle";
            }
        }*/




</script>


<?php
$content = ob_get_clean();
require "gabarit.php";

?>
