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
        if (isLoginCorrect($userEmailAddress, $userPsw))
        {
            $infoUser = getInfosUser($userEmailAddress);
            createSession($infoUser[0]['name'], $infoUser[0]['firstname'], $infoUser[0]['address'], $infoUser[0]['zip'], $infoUser[0]['nameCity'], $infoUser[0]['email']);
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

function createSession($userName, $userFirstname, $userAddress, $userZip, $userCity, $userEmail)
{

    $_SESSION['userName'] = stripslashes($userName);
    $_SESSION['userFirstname'] = stripslashes($userFirstname);
    $_SESSION['userAddress'] = stripslashes($userAddress);
    $_SESSION['userZip'] = $userZip;
    $_SESSION['userCity'] = stripslashes($userCity);
    $_SESSION['userEmail'] = $userEmail;

    //set user type in Session
    //$userType = getUserType($userEmailAddress);
    //$_SESSION['userType'] = $userType;
}

function logout(){
    $_SESSION = array();
    session_destroy();
    $_GET['action'] = "home";
    require "view/home.php";
}


function displaySubscription()
{
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
                        createSession($userName, $userFirstname, $userAddress, $userZip, $userCity, $userEmail);
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
                    createSession($userName, $userFirstname, $userAddress, $userZip, $userCity, $_SESSION['userEmailAddress']);
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





/* ################## PART: ALBUM CD/VINYLES ################## */

function displayAlbumCD()
{

    require_once "model/model.php";
    $allArticles = getAlbumCD();
    $typeArticle = "Album CD";

    require 'view/displayArticles.php';
}

function displayVinyles()
{
    require_once "model/model.php";
    $allArticles = getVinyle();
    $typeArticle = "Vinyle";

    require 'view/displayArticles.php';
}



function displayArticleDetails()
{
    require '';
}
function displayAddProduct()
{
    require 'view/displayAddProduct.php';
}









?>