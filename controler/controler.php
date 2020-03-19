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
    if (isset($loginRequest['inputUserEmailAddress']) && isset($loginRequest['inputUserPsw']))
    {
        $userEmailAddress = $loginRequest['inputUserEmailAddress'];
        $userPsw = $loginRequest['inputUserPsw'];

        require_once "model/model.php";
        if (isLoginCorrect($userEmailAddress, $userPsw))
        {
            createSession($userEmailAddress);
            $_GET['loginError'] = false;
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


function createSession($userEmailAddress){
    $_SESSION['userEmailAddress'] = $userEmailAddress;
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

function registerNewAccount($registerRequest)
{
    if (isset($registerRequest['name']) && isset($registerRequest['firstname']) && isset($registerRequest['firstname']) && isset($registerRequest['firstname']) && isset($registerRequest['address']) && isset($registerRequest['city']) && isset($registerRequest['zip']) && isset($registerRequest['email']) && isset($registerRequest['password']) && isset($registerRequest['passwordRepeat']))
    {
        $userName = $registerRequest['name'];
        $userFirstname = $registerRequest['firstname'];
        $userAddress = $registerRequest['address'];
        $userCity = $registerRequest['city'];
        $userZip = $registerRequest['zip'];
        $userEmail = $registerRequest['email'];
        $userPassword = $registerRequest['password'];
        $userPasswordRepeat = $registerRequest['passwordRepeat'];

        $_GET['errorRegister'] = false;
        $_GET['errorCityZip'] = false;
        $_GET['passwordNotIdentical'] = false;
        $_GET['emptyInput'] = false;

        require_once "model/model.php";

        if ($userPassword == $userPasswordRepeat)
        {
            if(checkCityZip($userCity, $userZip)){
                if(registerDB($userName, $userFirstname, $userAddress, $userEmail, $userPassword, $userZip))
                {
                    createSession($userEmail);
                    $_GET['action'] = "home";
                    require "view/home.php";
                }
                else
                {
                    $_GET['errorRegister'] = true;
                    $_GET['action'] = "displaySubscription";
                    require "view/displaySubscription.php";
                }
            }
            else
            {
                $_GET['errorCityZip'] = true;
                $_GET['action'] = "displaySubscription";
                require "view/displaySubscription.php";
            }
        }
        else
        {
            $_GET['passwordNotIdentical'] = true;
            $_GET['action'] = "displaySubscription";
            require "view/displaySubscription.php";
        }


    }
    else
    {
        $_GET['emptyInput'] = true;
        $_GET['action'] = "displaySubscription";
        require "view/displaySubscription.php";
    }
}








function displaySubscription()
{
    require 'view/displaySubscription.php';
}

function displayAlbumCD()
{
    require 'view/displayAlbumsCD.php';
}

function displayVinyles()
{
    require 'view/displayVinyles.php';
}

function displayCustomerAccount()
{
    require 'view/displayCustomerAccount.php';
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