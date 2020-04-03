<?php
/**
 * Created by PhpStorm.
 * User: Mauricio COSTA CABRAL
 * Date: 06.03.2020
 * Version: 0.1
 */

ob_start();
$titre="Art-Music - Ajout d'un morceau";
?>

<div class="text-left pt-4 pb-4 pr-2 pl-2 pr-sm-3 pl-sm-3 pr-md-4 pl-md-4" id="mainBlock" style="background-image: url(&quot;view/content/images/useful/arriere-plan.jpg&quot;);background-position: center;background-size: cover;background-repeat: no-repeat; display: flex; justify-content: center; align-items: center; min-height: 650px">
    <div class="container border rounded" style="background-color: #eeeeee;padding: 20px; max-width:550px; ">
        <div class="row">
            <div class="col-md-12">
                <form action="index.php?action=<?php if ($_GET['action'] == 'displayUpdateMusic') :?>updateMusic<?php else :?>addNewMusic<?php endif ?>" method="POST" enctype="multipart/form-data">
                <h3><?= $infosArticle[0]['name'] ?> - <?= $infosArticle[0]['NameArticle'] ?> - <?= $infosArticle[0]['NameArtist'] ?></h3>
                <h4>Ajout/modification de morceaux</h4>

                    <?php if (@$_GET['insertNewMusicError'] == true) :?>
                        <h6 class="alert alert-danger text-center mb-4">Une erreur s'est produite lors de l'insertion du morceau.</h6>
                    <?php endif ?>
                    <?php if (@$_GET['uploadMusicError'] == true) :?>
                        <h6 class="alert alert-danger text-center mb-4">Une erreur s'est produite lors de l'upload du morceau.</h6>
                    <?php endif ?>

                <input hidden value="<?= @$infosMusic[0]['id'] ?>" name="idMusic">
                <input hidden value="<?= $infosArticle[0]['id'] ?>" name="idArticle">
                <input hidden value="<?= $infosArticle[0]['name'] ?>" name="typeArticle">


                <label style="margin-top: 5px;margin-bottom: 3px;">Titre</label>
                <input class="d-block" type="text" style="width: 100%;" name="title" value="<?= @$infosMusic[0]['title'] ?>" <?php if ($_GET['action'] == 'displayAddMusic') :?>required<?php endif ?>>

                <label style="margin-top: 5px;margin-bottom: 3px;">Durée <em>(exemple format: 03:35)</em></label>
                <input class="d-block" type="text" style="width: 100%;" name="duration" value="<?= @$infosMusic[0]['duration'] ?>" <?php if ($_GET['action'] == 'displayAddMusic') :?>required<?php endif ?>>

                <label class="customFileInput" style="margin-top: 1rem;"><input type="file" accept="audio/mpeg" id="musicInput" style="display: none" oninput="checkMusicInput();" value="<?php if ($_GET['action'] == 'displayUpdateMusic') :?>alreadySet<?php endif ?>" name="musicInput" <?php if ($_GET['action'] == 'displayAddMusic') :?>required<?php endif ?>>Choisir une morceau:&nbsp;&nbsp;</label><span id="nameMusic"><?php if ($_GET['action'] == 'displayUpdateMusic') :?><?= @$infosMusic[0]['id'] ?><?= @$infosMusic[0]['title'] ?>.mp3<?php endif ?></span>


                <button class="btn btn-primary" type="submit" style="width: 100%;margin-top: 15px;">Valider l'ajout/modification</button></div>
            </form>
        </div>
    </div>
</div>


<script>





    function checkMusicInput() {
        var inputFile = document.getElementById("musicInput").value;

            document.getElementById('nameMusic').innerHTML = inputFile.substring(inputFile.lastIndexOf('\\')+1, inputFile.length);

    }



</script>

<?php
$content = ob_get_clean();
require "gabarit.php";

?>
