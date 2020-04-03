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
            displayArticleDetails($_GET['id']);
            break;
        case'displayAddArticle':
            displayAddArticle($_GET['typeArticle']);
            break;
        case'displayUpdateArticle':
            displayUpdateArticle($_GET['typeArticle'], $_GET['id']);
            break;
        case'displayAddMusic':
            displayAddMusic($_GET['idArticle']);
            break;
        case'displayUpdateMusic':
            displayUpdateMusic($_GET['idMusic'], $_GET['idArticle']);
            break;
        case'displayCart':
            displayCart();
            break;
        case 'displayDetailsOrder':
            displayDetailsOrder($_GET['orderId']);
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
            /*CART*/
        case 'updateCart':
            updateCart($_GET['id'], $_GET['quantityWished']);
            break;
        case 'deleteArticleFromCart':
            deleteArticleFromCart($_GET['id']);
            break;
        case 'deleteCart':
            deleteCart();
            break;
        case 'confirmCart':
            confirmCart();
            break;
            /*ADMINISTRATOR*/
        case 'addNewArticle':
            addNewArticle($_POST);
            break;
        case 'updateArticle':
            updateArticle($_POST);
            break;
        case 'deleteArticle':
            deleteArticle($_GET['id'], $_GET['typeArticle']);
            break;
        case 'addNewMusic':
            addNewMusic($_POST);
            break;
        case 'updateMusic':
            updateMusic($_POST);
            break;
        case 'deleteMusic':
            deleteMusic($_GET['idMusic'], $_GET['titleMusic'] ,$_GET['idArticle']);
            break;

        default:
            home();
    }
}
else{
    home();
}
