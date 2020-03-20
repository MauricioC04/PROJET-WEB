<?php
/**
 * Created by PhpStorm.
 * User: Mauricio COSTA CABRAL
 * Date: 06.03.2020
 * Version: 0.1
 */

session_start();
require 'controler/controler.php';

if(isset($_GET['action'])){
    $action = $_GET['action'];
    switch($action){
        case'home':
            home();
            break;
            /*DISPLAY PAGES*/
        case'displayLogin':
            displayLogin();
            break;
        case'displaySubscription':
            displaySubscription();
            break;
        case'displayAlbumCD':
            displayAlbumCD();
            break;
        case'displayVinyles':
            displayVinyles();
            break;
        case'displayCustomerAccount':
            displayCustomerAccount();
            break;
        case'displayArticleDetails':
            displayArticleDetails();
            break;
        case'displayAddProduct':
            displayAddProduct();
            break;
            /*LOGIN - LOGOUT - SUBSCRIPTION*/
        case'login':
            login($_POST);
            break;
        case'logout':
            logout();
            break;
        case'registerNewAccount':
            registerNewAccount($_POST);
            break;
            /*CUSTOMER ACCOUNT*/
        case 'updateDataUser':
            updateDataUser($_POST);
            break;

        default:
            home();
    }
}
else{
    home();
}
