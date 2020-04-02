<?php
/**
 * Created by PhpStorm.
 * User: Mauricio COSTA CABRAL
 * Date: 06.03.2020
 * Version: 0.1
 */


function home()
{

    require 'view/home.php';
}





/* ################## PART: LOGIN/SUBSCRIPTION ################## */

function displayLogin()
{
    require 'view/displayLogin.php';
}

function login($loginRequest)
{
    $_GET['loginError'] = false;

    if (isset($loginRequest['inputUserEmailAddress']) && isset($loginRequest['inputUserPsw']))
    {
        $userEmailAddress = $loginRequest['inputUserEmailAddress'];
        $userPsw = $loginRequest['inputUserPsw'];

        require_once "model/model.php";


            $resultIsLoginCorrect = isLoginCorrect($userEmailAddress, $userPsw)['checkLogin'];
            $resultUserType = isLoginCorrect($userEmailAddress, $userPsw)['userType'];


        if ($resultIsLoginCorrect)
        {
            if($resultUserType == 'customer') {
                $infoUser = getInfosCustomer($userEmailAddress);
                createSessionCostumer($infoUser[0]['name'], $infoUser[0]['firstname'], $infoUser[0]['address'], $infoUser[0]['zip'], $infoUser[0]['nameCity'], $infoUser[0]['email'], $resultUserType);
            }
            else{
                createSessionAdministrator($userEmailAddress);
            }
            $_GET['action'] = "home";
            require "view/home.php";
        }
        else
        {
            $_GET['loginError'] = true;
            $_GET['action'] = "login";
            require "view/displayLogin.php";
        }
    }
    else
    {

        $_GET['action'] = "displayLogin";
        require "view/displayLogin.php";

    }
}

function createSessionCostumer($userName, $userFirstname, $userAddress, $userZip, $userCity, $userEmail, $userType='customer')
{
    $_SESSION['userName'] = stripslashes($userName);
    $_SESSION['userFirstname'] = stripslashes($userFirstname);
    $_SESSION['userAddress'] = stripslashes($userAddress);
    $_SESSION['userZip'] = $userZip;
    $_SESSION['userCity'] = stripslashes($userCity);
    $_SESSION['userEmail'] = $userEmail;
    $_SESSION['userType'] = $userType;
}

function createSessionAdministrator($adminEmail, $userType ='administrator'){

    $_SESSION['adminEmail'] = $adminEmail;
    $_SESSION['userType'] = $userType;
}

function logout(){
    $_SESSION = array();
    session_destroy();
    $_GET['action'] = "home";
    require "view/home.php";
}

function displaySubscription()
{
    require_once "model/model.php";
    $cities = getLocalityFromBD();
    require 'view/displaySubscription.php';
}

function registerNewAccount($registerRequest)
{
    if (isset($registerRequest['name']) && isset($registerRequest['firstname']) && isset($registerRequest['address']) && isset($registerRequest['city']) && isset($registerRequest['zip']) && isset($registerRequest['email']) && isset($registerRequest['password']) && isset($registerRequest['passwordRepeat'])) {
        $userName = addslashes($registerRequest['name']);
        $userFirstname = addslashes($registerRequest['firstname']);
        $userAddress = addslashes($registerRequest['address']);
        $userCity = addslashes($registerRequest['city']);
        $userZip = $registerRequest['zip'];
        $userEmail = $registerRequest['email'];
        $userPassword = $registerRequest['password'];
        $userPasswordRepeat = $registerRequest['passwordRepeat'];

        $_GET['emailAlreadyExists'] = false;
        $_GET['errorRegister'] = false;
        $_GET['errorCityZip'] = false;
        $_GET['passwordNotIdentical'] = false;
        $_GET['emptyInput'] = false;

        require_once "model/model.php";

        if (checkEmailAlreadyExists($userEmail)) {
            $_GET['emailAlreadyExists'] = true;
            $_GET['action'] = "displaySubscription";
            require "view/displaySubscription.php";
        }
        else {


            if ($userPassword == $userPasswordRepeat) {
                if (checkCityZip($userCity, $userZip)) {
                    if (registerDataUserInDB($userName, $userFirstname, $userAddress, $userEmail, $userPassword, $userZip)) {
                        createSessionCostumer($userName, $userFirstname, $userAddress, $userZip, $userCity, $userEmail);
                        $_GET['action'] = "home";
                        require "view/home.php";
                    } else {
                        $_GET['errorRegister'] = true;
                        $_GET['action'] = "displaySubscription";
                        require "view/displaySubscription.php";
                    }
                } else {
                    $_GET['errorCityZip'] = true;
                    $_GET['action'] = "displaySubscription";
                    require "view/displaySubscription.php";
                }
            } else {
                $_GET['passwordNotIdentical'] = true;
                $_GET['action'] = "displaySubscription";
                require "view/displaySubscription.php";
            }
        }
    }


    else
    {
        $_GET['emptyInput'] = true;
        $_GET['action'] = "displaySubscription";
        require "view/displaySubscription.php";
    }
}





/* ################## PART: COSTUMER ACCOUNT ################## */

function displayCustomerAccount()
{
    $previousOrders = getPreviousOrders($_SESSION['userEmail']);

    require 'view/displayCustomerAccount.php';
}

function updateDataUser($updateDataRequest){
    if (isset($updateDataRequest['name']) && isset($updateDataRequest['firstname']) && isset($updateDataRequest['address']) && isset($updateDataRequest['city']) && isset($updateDataRequest['zip'])) {
        $userName = $updateDataRequest['name'];
        $userFirstname = $updateDataRequest['firstname'];
        $userAddress = addslashes($updateDataRequest['address']);
        $userCity = $updateDataRequest['city'];
        $userZip = $updateDataRequest['zip'];

        $_GET['errorUpdate'] = false;
        $_GET['errorCityZip'] = false;
        $_GET['emptyInput'] = false;

        require_once "model/model.php";

            if (checkCityZip($userCity, $userZip)) {
                if (updateDataUserInDB($userName, $userFirstname, $userAddress, $userZip, $_SESSION['userEmailAddress'])) {
                    createSessionCostumer($userName, $userFirstname, $userAddress, $userZip, $userCity, $_SESSION['userEmailAddress']);
                    $_GET['action'] = "displayCustomerAccount";
                    require "view/displayCustomerAccount.php";
                } else {
                    $_GET['errorUpdate'] = true;
                    $_GET['action'] = "displayCustomerAccount";
                    require "view/displayCustomerAccount.php";
                }
            } else {
                $_GET['errorCityZip'] = true;
                $_GET['action'] = "displayCustomerAccount";
                require "view/displayCustomerAccount.php";
            }

    }
    else
    {
        $_GET['emptyInput'] = true;
        $_GET['action'] = "displayCustomerAccount";
        require "view/displayCustomerAccount.php";;
    }
}

function getPreviousOrders($userEmail){

    require_once "model/model.php";

    $userId = getIdUser($userEmail);

    return getPreviousOrdersFromDB($userId);
}

function displayDetailsOrder($orderId){

    require_once "model/model.php";

    $detailsOrder = getAPreviousOrder($orderId);

    require "view/displayDetailsOrder.php";

}





/* ################## PART: ALBUM CD/VINYLES ################## */

function displayAlbumCD()
{

    require_once "model/model.php";
    $allArticles = getAlbumCD();
    $typeArticle = "Album CD";

    if(@$_SESSION['userType'] == 'administrator'){
        require 'view/displayArticlesAdministrator.php';
    }
    else{
        require 'view/displayArticles.php';
    }


}

function displayVinyles()
{
    require_once "model/model.php";
    $allArticles = getVinyle();
    $typeArticle = "Vinyle";

    if(@$_SESSION['userType'] == 'administrator'){
        require 'view/displayArticlesAdministrator.php';
    }
    else{
        require 'view/displayArticles.php';
    }
}





/* ################## PART: DETAILS ALBUM CD/VINYLE ################## */

function displayArticleDetails($idArticle)
{
    require_once "model/model.php";
    $infosArticle = getAnArticle($idArticle);
    $detailsArticle = getDetailsArticle($idArticle);
    $numberOfMusics = getNumbersOfMusics($idArticle);

    require 'view/displayDetailsArticle.php';
}





/* ################## PART: CART ################## */

function displayCart(){

    require 'view/displayCart.php';

}

function updateCart($idArticle, $qtyWished){

    $_SESSION['connexionRequiredError'] = false;
    $articleAlreadyInCart = false;

    if(isset($_SESSION['userEmail'])) {


        require "model/model.php";
        $articleResults = getAnArticle($idArticle);
        $_SESSION['qtyError'] = false;


        if ($articleResults[0]['quantity'] >= $qtyWished && $qtyWished != 0) {


            if (isset ($_GET['articleToUpdate'])) {
                $_SESSION['cart'][$_GET['articleToUpdate']]['quantity'] = $qtyWished;
            } else {

                $addingArticleToCart = array('id' => $idArticle, 'articleType' => $articleResults[0]['name'], 'nameArticle' => $articleResults[0]['NameArticle'], 'nameArtist' => $articleResults[0]['NameArtist'], 'releaseYear' => $articleResults[0]['releaseYear'], 'quantity' => $qtyWished, 'price' => $articleResults[0]['price'], 'pathFileCover' => $articleResults[0]['pathFileCover']);
                if (@isset($_SESSION['cart'])) {
                    $i = 0;
                    foreach ($_SESSION['cart'] as $result){
                        if($result['id'] == $idArticle){
                            $articleAlreadyInCart = true;
                            $_SESSION['cart'][$i]['quantity'] += 1;
                        }
                        $i++;
                    }
                    if (!$articleAlreadyInCart) {
                        array_push($_SESSION['cart'], $addingArticleToCart);
                    }
                } else {
                    $_SESSION['cart'][0] = $addingArticleToCart;
                }
            }
            $_GET['action'] = "displayCart";
            displayCart();
        } else {

            $_SESSION['qtyError'] = true;
            $_GET['action'] = "displayCart";
            require "view/displayCart.php";
        }
    }
    else{
        $_GET['connexionRequiredError'] = true;
        $_GET['action'] = "displayLogin";
        require "view/displayLogin.php";
    }

}

function deleteArticleFromCart($line){
    unset($_SESSION['cart'][$line]);
    //Delete empty lines
    sort($_SESSION['cart']);
    require "view/displayCart.php";
}

function deleteCart(){
    $_SESSION['cart']=array();
}

function confirmCart(){

    require "model/model.php";
    createNewOrder();
    require "view/displayConfirmationPurchase.php";
    deleteCart();

}





/* ################## PART: ADMINISTRATOR ################## */

function displayAddArticle($typeArticleGET)
{
    require"model/model.php";
    $typeArticle = $typeArticleGET;
    $allGenresMusic = getAllGenresMusic();
    $allCountries = getAllCoutries();
    $allVinyleFormats = getAllVinyleFormats();

    require 'view/displayAddUpdateArticle.php';
}

function displayUpdateArticle($typeArticleGET, $idArticle){
    require"model/model.php";
    $typeArticle = $typeArticleGET;
    $allGenresMusic = getAllGenresMusic();
    $allCountries = getAllCoutries();
    $allVinyleFormats = getAllVinyleFormats();
    @$infosArticle = getAnArticle($idArticle);

    require 'view/displayAddUpdateArticle.php';
}

function addNewArticle($newArticleRequest){

    require "model/model.php";

    $typeArticle = $newArticleRequest['typeArticle'];
    $nameArticle = $newArticleRequest['nameArticle'];
    $nameArtist = $newArticleRequest['nameArtist'];
    $origineArtist = $newArticleRequest['origineArtist'];
    $genreMusic = $newArticleRequest['genreMusic'];
    $nameLabel = $newArticleRequest['nameLabel'];
    $quantity = $newArticleRequest['quantity'];
    $price = $newArticleRequest['price'];
    $releaseYear = $newArticleRequest['releaseYear'];
    $vinyleFormat = @$newArticleRequest['vinyleFormat'];


    if(insertNewArticle($typeArticle, $nameArticle, $nameArtist, $origineArtist, $genreMusic, $nameLabel, $quantity, $price, $releaseYear, $vinyleFormat)){

        $_GET['uploadCoverError'] = false;
        $_GET['insertNewArticleError'] = false;

        $idArticle = getIdArticle($nameArticle, $releaseYear);

        $target_dir = "view/content/images/covers/";
        $target_file = $target_dir.$idArticle.'.jpg';
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "jpeg") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $_GET['uploadCoverError'] = true;
            displayAddArticle($typeArticle);

        } else {
            if (move_uploaded_file($_FILES['coverInput']["tmp_name"], $target_file)) {

            } else {
                $_GET['uploadCoverError'] = true;
                displayAddArticle($typeArticle);
            }
        }

        if($typeArticle == 'Album CD'){
            $_GET['action'] = 'displayAlbumCD';
            displayAlbumCD();
        }
        else{
            $_GET['action'] = 'displayVinyles';
            displayVinyles();
        }


    }
    else{
        $_GET['insertNewArticleError'] = true;
        displayAddArticle($typeArticle);
    }



}

function updateArticle($updateArticleRequest){



    require "model/model.php";

    $typeArticle = $updateArticleRequest['typeArticle'];
    $nameArticle = $updateArticleRequest['nameArticle'];
    $idArticle = $updateArticleRequest['idArticle'];
    $nameArtist = $updateArticleRequest['nameArtist'];
    $origineArtist = $updateArticleRequest['origineArtist'];
    $genreMusic = $updateArticleRequest['genreMusic'];
    $nameLabel = $updateArticleRequest['nameLabel'];
    $quantity = $updateArticleRequest['quantity'];
    $price = $updateArticleRequest['price'];
    $releaseYear = $updateArticleRequest['releaseYear'];
    $vinyleFormat = @$updateArticleRequest['vinyleFormat'];

    if(updateArticleBD($typeArticle, $idArticle, $nameArticle, $nameArtist, $origineArtist, $genreMusic, $nameLabel, $quantity, $price, $releaseYear, $vinyleFormat)) {


        if($_FILES['coverInput']['name'] != ""){

            $_GET['uploadCoverError'] = false;
            $_GET['insertNewArticleError'] = false;


            $fileToDelete = 'view/content/images/covers/'.$idArticle.'.jpg';

            if (!unlink($fileToDelete)) {
                $_GET['uploadCoverError'] = true;
                displayAddArticle($typeArticle);
            }



            $target_dir = "view/content/images/covers/";
            $target_file = $target_dir.$idArticle.'.jpg';
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if($imageFileType != "jpg" && $imageFileType != "jpeg") {

                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                $_GET['removeCoverError'] = true;
                displayAddArticle($typeArticle);

            } else {
                if (move_uploaded_file($_FILES['coverInput']["tmp_name"], $target_file)) {

                } else {
                    $_GET['uploadCoverError'] = true;
                    displayAddArticle($typeArticle);
                }
            }
        }


        if ($typeArticle == 'Album CD') {
            $_GET['action'] = 'displayAlbumCD';
            displayAlbumCD();
        } else {
            $_GET['action'] = 'displayVinyles';
            displayVinyles();
        }


    }

    else{
        $_GET['updateArticleError'] = true;
        displayAddArticle($typeArticle);
    }
}

function deleteArticle($idArticle, $typeArticle){

    $_GET['deleteArticleError'] = false;
    $_GET['deleteCoverError'] = false;

    require "model/model.php";

    if(deleteArticleBD($idArticle)){

        $fileToDelete = 'view/content/images/covers/'.$idArticle.'.jpg';

        if (!unlink($fileToDelete)) {
            if ($typeArticle == 'Album CD') {
                $_GET['deleteCoverError'] = true;
                $_GET['action'] = 'displayAlbumCD';
                displayAlbumCD();
            } else {
                $_GET['deleteCoverError'] = true;
                $_GET['action'] = 'displayVinyles';
                displayVinyles();
            }
        }
        else {
            if ($typeArticle == 'Album CD') {
                $_GET['action'] = 'displayAlbumCD';
                displayAlbumCD();
            } else {
                $_GET['action'] = 'displayVinyles';
                displayVinyles();
            }
        }


    }
    else{
        if ($typeArticle == 'Album CD') {
            $_GET['deleteArticleError'] = true;
            $_GET['action'] = 'displayAlbumCD';
            displayAlbumCD();
        } else {
            $_GET['deleteArticleError'] = true;
            $_GET['action'] = 'displayVinyles';
            displayVinyles();
        }
    }

}



function displayAddMusic($idArticle){

    require_once "model/model.php";
    $infosArticle = getAnArticle($idArticle);
    require 'view/displayAddUpdateMusic.php';

}

function displayUpdateMusic($idMusic, $idArticle){
    require 'model/model.php';

    $infosArticle = getAnArticle($idArticle);
    $infosMusic = getInfosMusic($idMusic);

    require 'view/displayAddUpdateMusic.php';
}

function addNewMusic($newMusicRequest){


    require "model/model.php";

    $title = $newMusicRequest['title'];
    $duration = $newMusicRequest['duration'];
    $idArticle = $newMusicRequest['idArticle'];
    $typeArticle = $newMusicRequest['typeArticle'];



    if(insertNewMusic($title, $duration, $idArticle)){

        $idMusic = getIdMusic($title, $idArticle);

        $_GET['uploadMusicError'] = false;
        $_GET['insertNewMusicError'] = false;

        $target_dir = "view/content/musics/";
        $target_file = $target_dir.$idMusic.$title.'.mp3';
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if($imageFileType != "mp3") {
            echo "Sorry, only mp3 files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $_GET['uploadMusicError'] = true;
            displayAddMusic($typeArticle);

        }
        else {
            if (move_uploaded_file($_FILES['musicInput']["tmp_name"], $target_file)) {

            } else {

                $_GET['uploadMusicError'] = true;
                displayAddMusic($typeArticle);
            }
        }

        displayArticleDetails($idArticle);
    }
    else{

        $_GET['insertNewMusicError'] = true;
        displayAddMusic($idArticle);
    }
}

function updateMusic($updateMusicRequest){

    $_GET['updateMusicError'] = false;

    require "model/model.php";

    $idMusic = $updateMusicRequest['idMusic'];
    $actualTitle = getTitleMusic($idMusic);
    $newTitle = $updateMusicRequest['title'];
    $duration = $updateMusicRequest['duration'];
    $idArticle = $updateMusicRequest['idArticle'];
    $typeArticle = $updateMusicRequest['typeArticle'];

    if(updateMusicBD($newTitle, $duration, $idMusic)){
        if($_FILES['musicInput']['name'] != ""){

            $fileToDelete = 'view/content/musics/'.$idMusic.$actualTitle.'.mp3';

            if (!unlink($fileToDelete)) {
                $_GET['uploadCoverError'] = true;
                displayAddArticle($typeArticle);
            }

            $_GET['uploadMusicError'] = false;
            $_GET['insertNewMusicError'] = false;

            $target_dir = "view/content/musics/";
            $target_file = $target_dir.$idMusic.$newTitle.'.mp3';
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if($imageFileType != "mp3") {
                echo "Sorry, only mp3 files are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                $_GET['uploadMusicError'] = true;
                displayAddMusic($typeArticle);

            }
            else {
                if (move_uploaded_file($_FILES['musicInput']["tmp_name"], $target_file)) {

                } else {

                    $_GET['uploadMusicError'] = true;
                    displayAddMusic($typeArticle);
                }
            }
            displayArticleDetails($idArticle);
        }
        else{
            $oldNameFile = 'view/content/musics/'.$idMusic.$actualTitle.'.mp3';
            $newNameFile = 'view/content/musics/'.$idMusic.$newTitle.'.mp3';

            rename($oldNameFile, $newNameFile);
            displayArticleDetails($idArticle);
        }

    }
    else{
        $_GET['updateMusicError'] = true;
        displayArticleDetails($idArticle);
    }

}

function deleteMusic($idMusic, $titleMusic ,$idArticle){

    $_GET['deleteMusicError'] = false;

    require "model/model.php";

    if(deleteMusicBD($idMusic)){

        $fileToDelete = 'view/content/musics/'.$idMusic.$titleMusic.'.mp3';

        if (!unlink($fileToDelete)) {
            $_GET['removeCoverError'] = true;
            displayArticleDetails($idArticle);
        }
        else {
            $_GET['removeCoverError'] = false;
            displayArticleDetails($idArticle);
        }
    }
    else{
        $_GET['deleteMusicError'] = true;
        displayArticleDetails($idArticle);
    }


}



?>