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

        default:
            home();
    }
}
else{
    home();
}
