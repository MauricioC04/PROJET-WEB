<?php


/* ################## PART: LOGIN/SUBSCRIPTION ################## */

function isLoginCorrect($userEmail, $userPsw){

    $result = false;
    $userType = 'customer';
    $test = array();

    $strSeparator = '\'';
    $loginQuery = 'SELECT * FROM customers WHERE email ='.$strSeparator . $userEmail . $strSeparator;
    require_once 'BD_base.php';
    $queryResult = executeQuerySelect($loginQuery);

    if(count($queryResult) == 0){
        $loginQuery = 'SELECT * FROM administrators WHERE email ='.$strSeparator . $userEmail . $strSeparator;
        require_once 'BD_base.php';
        $queryResult = executeQuerySelect($loginQuery);
        $userType = 'administrator';
    }

    if(count($queryResult) == 1){
        $userHashPsw = $queryResult[0]['password'];
        $hashPasswordDebug = password_hash($userPsw, PASSWORD_DEFAULT);
        $result = password_verify($userPsw, $userHashPsw);
    }

    $test = array('checkLogin' => $result, 'userType' => $userType);

    return $test;
}

function checkCityZip($city, $zip)
{
    $result = false;

    $strSeparator = '\'';
    $checkQuery = 'SELECT * FROM cities WHERE name ='.$strSeparator . $city . $strSeparator . 'AND zip ='. $zip;
    require_once 'BD_base.php';
    $queryResult = executeQuerySelect($checkQuery);

    if(count($queryResult) == 1)
    {
        $result = true;
    }

    return $result;
}

function getIdCity($zip)
{

    $getIdZipQuery = 'SELECT id FROM cities WHERE zip ='. $zip;
    require_once 'BD_base.php';
    $queryResult = executeQuerySelect($getIdZipQuery);

    return $queryResult[0]['id'];


}

function registerDataUserInDB($userName, $userFirstname, $userAddress, $userEmail, $userPassword, $userZip){
    $result = false;

    $strSeparator = '\'';

    $userHashPsw = password_hash($userPassword, PASSWORD_DEFAULT);

    $userIdZip = getIdCity($userZip);

    $registerQuery = 'INSERT INTO customers (name, firstname, address, email, password, city_id) VALUES ('.$strSeparator.$userName.$strSeparator. ',' .$strSeparator.$userFirstname.$strSeparator. ',' .$strSeparator.$userAddress.$strSeparator. ',' .$strSeparator.$userEmail.$strSeparator. ',' .$strSeparator.$userHashPsw.$strSeparator. ',' .$userIdZip.');';
    require_once 'BD_base.php';
    $queryResult = executeQueryIDU($registerQuery);
    if($queryResult){
        $result = $queryResult;
    }
    return $result;
}

function checkEmailAlreadyExists($userEmail){
    $result = false;

    $strSeparator = '\'';
    $checkQuery = 'SELECT * FROM customers WHERE email ='.$strSeparator . $userEmail . $strSeparator;
    require_once 'BD_base.php';
    $queryResult = executeQuerySelect($checkQuery);

    if(count($queryResult) == 1){
        $result = true;
    }

    return $result;
}

function getLocalityFromBD(){
    $getLocalityQuery = 'SELECT name FROM cities ORDER BY name ASC';
    require_once 'BD_base.php';
    $queryResult = executeQuerySelect($getLocalityQuery);

    return $queryResult;
}




/* ################## PART: CUSTOMER ACCOUNT ################## */

function getInfosCustomer($userEmail)
{
    $strSeparator = '\'';
    $getInfosQuery = 'SELECT customers.name, customers.firstname, customers.address, cities.zip, cities.name AS nameCity, customers.email FROM customers INNER JOIN cities ON customers.city_id = cities.id WHERE customers.email ='.$strSeparator . $userEmail . $strSeparator ;
    require_once 'BD_base.php';
    $queryResult = executeQuerySelect($getInfosQuery);

    return $queryResult;
}

function updateDataUserInDB($userName, $userFirstname, $userAddress, $userZip, $userEmail){
    $result = false;

    $strSeparator = '\'';

    $userIdZip = getIdCity($userZip);

    $updateDataUserQuery = 'UPDATE customers SET name='.$strSeparator.$userName.$strSeparator.', firstname='.$strSeparator.$userFirstname.$strSeparator.', address='.$strSeparator.$userAddress.$strSeparator.', city_id='.$strSeparator.$userIdZip.$strSeparator.' WHERE email='.$strSeparator.$userEmail.$strSeparator;
    require_once 'BD_base.php';
    $queryResult = executeQueryIDU($updateDataUserQuery);
    if($queryResult){
        $result = $queryResult;
    }
    return $result;
}

function getIdUser($userEmail){

    $strSeparator = '\'';

    $getIdUserQuery = 'SELECT id FROM customers WHERE email ='. $strSeparator.$userEmail.$strSeparator;
    require_once 'BD_base.php';
    $queryResult = executeQuerySelect($getIdUserQuery);

    return $queryResult[0]['id'];
}

function getPreviousOrdersFromDB($userId){

    $getPreviousOrdersQuery = 'SELECT orders.id, orders.orderDate, SUM(articles.price) AS totalCost FROM orders INNER JOIN customers ON orders.customer_id = customers.id INNER JOIN orders_has_articles ON orders_has_articles.Orders_id = orders.id INNER JOIN articles ON orders_has_articles.Articles_id = articles.id WHERE customers.id ='.$userId.' GROUP BY orders.id';

    require_once 'BD_base.php';
    $queryResult = executeQuerySelect($getPreviousOrdersQuery);

    return $queryResult;
}

function getAPreviousOrder($idOrder){

    $getAPreviousOrderQuery = 'SELECT orders.id AS orderId, articles.id AS articleId, articletypes.name AS articleType, orders.orderDate AS orderDate, articles.pathFileCover, articles.name AS nameArticle, artists.name AS nameArtist, articles.releaseYear, articles.price, orders_has_articles.Quantity AS quantity FROM articles INNER JOIN artists ON articles.artist_id = artists.id INNER JOIN articletypes ON articles.articleType_id = articletypes.id INNER JOIN orders_has_articles ON orders_has_articles.Articles_id = articles.id INNER JOIN orders ON orders_has_articles.Orders_id = orders.id WHERE orders_has_articles.Orders_id ='.$idOrder.' GROUP BY articles.id';
    require_once 'BD_base.php';

    return executeQuerySelect($getAPreviousOrderQuery);
}



/* ################## PART: ALBUM CD/VINYLES ################## */

function getAlbumCD(){
    $getAlbumCDQuery = 'SELECT articles.id, articletypes.name, articles.pathFileCover, articles.name AS NameArticle, artists.name AS NameArtist, articles.releaseYear, genres.name AS NameGenre, labels.name AS NameLabel, articles.quantity, articles.price FROM articles INNER JOIN articletypes ON articles.articleType_id = articletypes.id INNER JOIN artists ON articles.artist_id = artists.id INNER JOIN countries ON artists.country_id = countries.id INNER JOIN labels ON articles.label_id = labels.id INNER JOIN genres ON articles.genre_id = genres.id LEFT JOIN vinyleformats ON articles.vinyleFormat_id = vinyleformats.id WHERE articletypes.name = "Album CD";';

    require_once 'BD_base.php';

    return executeQuerySelect($getAlbumCDQuery);

}

function getVinyle(){

    $getVinyleQuery = 'SELECT articles.id, articletypes.name, articles.pathFileCover, articles.name AS NameArticle, artists.name AS NameArtist, articles.releaseYear, genres.name AS NameGenre, labels.name AS NameLabel, articles.quantity, articles.price, vinyleformats.name AS NameFormatVinyle FROM articles INNER JOIN articletypes ON articles.articleType_id = articletypes.id INNER JOIN artists ON articles.artist_id = artists.id INNER JOIN countries ON artists.country_id = countries.id INNER JOIN labels ON articles.label_id = labels.id INNER JOIN genres ON articles.genre_id = genres.id LEFT JOIN vinyleformats ON articles.vinyleFormat_id = vinyleformats.id WHERE articletypes.name = "Vinyle";';

    require_once 'BD_base.php';

    return executeQuerySelect($getVinyleQuery);
}

function getAnArticle($id){

    $getAnArticleQuery = 'SELECT articles.id, articletypes.name, articles.pathFileCover, articles.name AS NameArticle, artists.name AS NameArtist, articles.releaseYear, genres.name AS NameGenre, labels.name AS NameLabel, articles.quantity, articles.price FROM articles INNER JOIN articletypes ON articles.articleType_id = articletypes.id INNER JOIN artists ON articles.artist_id = artists.id INNER JOIN countries ON artists.country_id = countries.id INNER JOIN labels ON articles.label_id = labels.id INNER JOIN genres ON articles.genre_id = genres.id LEFT JOIN vinyleformats ON articles.vinyleFormat_id = vinyleformats.id WHERE articles.id ='.$id;

    require_once 'BD_base.php';

    return executeQuerySelect($getAnArticleQuery);
}

function getDetailsArticle($idArticle){

    $getDetailsArticleQuery = 'SELECT musics.id AS idMusic, musics.title, musics.pathFileMusic, musics.duration FROM musics INNER JOIN articles ON musics.article_id = articles.id WHERE articles.id ='.$idArticle;

    require_once 'BD_base.php';

    return executeQuerySelect($getDetailsArticleQuery);

}

function getNumbersOfMusics($idArticle){

    $getNumbersOfMusicsQuery = 'SELECT COUNT(musics.id) FROM musics INNER JOIN articles ON musics.article_id = articles.id WHERE articles.id ='.$idArticle;

    require_once 'BD_base.php';

    return executeQuerySelect($getNumbersOfMusicsQuery);
}



/* ################## PART: CART ################## */

function createNewOrder(){

    $idUser = getIdUser($_SESSION['userEmail']);

    $createNewOrderQuery = 'INSERT INTO orders (customer_id, orderDate) VALUES ('.$idUser.', CURRENT_DATE());';
    if(executeQueryIDU($createNewOrderQuery)){
        return insertDataOrder($idUser);
    }
    else{
        return false;
    }

}

function insertDataOrder($idUser){


    foreach ($_SESSION['cart'] as $result){
        $insertArticleOrder = 'INSERT INTO orders_has_articles (orders_id, articles_id, quantity) VALUES ((SELECT MAX(orders.id) FROM orders WHERE orders.customer_id ='.$idUser.'),'.$result['id'].','.$result['quantity'].')';
        if(!executeQueryIDU($insertArticleOrder)) {
            break;
            return false;
        }
        else{
            updateQuantityArticle($result['id'], $result['quantity']);
        }

    }

    return true;
}

function updateQuantityArticle($idArticle, $quantity){
    $updateQuantityQuery = 'UPDATE articles SET quantity = quantity-'.$quantity.' WHERE articles.id = '.$idArticle;
    executeQueryIDU($updateQuantityQuery);
}

/*OLD EXERCICE EXAMPLES




function getSnows(){
    require_once 'BD_base.php';
    $SnowsQuery='SELECT * FROM snows';
    $resultats = executeQuerySelect($SnowsQuery);
    return $resultats;
}

function getASnow($code){

    $strSeparator = '\'';
    require_once 'BD_base.php';
    $SnowQuery='SELECT * FROM snows WHERE code='.$strSeparator.$code.$strSeparator.';';
    echo $SnowQuery;
    $resultats = executeQuerySelect($SnowQuery);
    return $resultats;

}

function getUserType($userEmail){
    $strSeparator = '\'';
    require_once 'BD_base.php';
    $userTypeQuery='SELECT userType FROM users WHERE userEmailAddress='.$strSeparator.$userEmail.$strSeparator.';';
    echo $userTypeQuery;
    $queryResult = executeQuerySelect($userTypeQuery);

    if(count($queryResult) == 1){
        $userType = $queryResult[0]['userType'];
        return $userType;
    }


}


function CheckQuantitySnows($code, $quantitySelected){
    $result = false;
    $nbrSnows = 0;

    require_once  'BD_base.php';

if(isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $row) {
        if ($row['code'] == $code) {
            $nbrSnows += $row['qty'];
        }
    }
}

    $nbrSnows += $quantitySelected;

    $mySnow = getASnow($code);

    foreach ($mySnow as $data) {

        if (intval($data['qtyAvailable']) >= $nbrSnows) {
            $result = true;
        }

        return $result;
    }


function saveLocation($userId){
    $strSeparator = '\'';
    require_once 'BD_base.php';
    $locationMaxIdQuery='SELECT MAX(id) FROM locations';
    echo $locationMaxIdQuery;
    $queryResultMaxId = executeQuerySelect($locationMaxIdQuery);

    foreach ($queryResultMaxId as $result){
        $maxId = $result[0];
    }

    if(count($queryResultMaxId) == 1){
        $insertLocationQuery = 'INSERT INTO locations (id, dateLoc, users_id) VALUES('.$maxId.'+1,'.$strSeparator.date("Y-m-d").$strSeparator.','.$userId.');';
        echo $insertLocationQuery;
        require_once 'BD_base.php';
        $queryResultLocation = executeQueryIDU($insertLocationQuery);
            $result = $queryResultLocation;

            if($result) {
                foreach ($_SESSION['cart'] as $resultat) {
                    $querySelectIdSnow = 'SELECT id FROM snows WHERE code=' . $strSeparator . $resultat['code'] . $strSeparator . ';';
                    echo $querySelectIdSnow;
                    $queryIdSnow = executeQuerySelect($querySelectIdSnow);
                    foreach ($queryIdSnow as $result){
                        $idSnow = $result[0];
                    }
                    $insertLocationHasSnows = 'INSERT INTO locations_has_snows (locations_id, snows_id, quantity, nbDays) VALUES(' . $maxId . '+1,' . $idSnow . ',' . $resultat['qty'] . ',' . $resultat['nbD'] . ');';
                    echo $insertLocationHasSnows;
                    executeQueryIDU($insertLocationHasSnows);
                }

                foreach ($_SESSION['cart'] as $resultat) {

                    $updateQtySnows = 'UPDATE snows SET qtyAvailable= qtyAvailable-'.$resultat['qty'].' WHERE code='.$strSeparator.$resultat['code'].$strSeparator.';';
                    echo $updateQtySnows;
                    $queryUpdateSnowQuantity = executeQueryIDU($updateQtySnows);

                    $selectNewQtySnows = 'SELECT qtyAvailable FROM snows WHERE code='.$strSeparator.$resultat['code'].$strSeparator.';';
                    echo $selectNewQtySnows;
                    $querySelectNewQtySnows = executeQuerySelect($selectNewQtySnows);

                    foreach ($querySelectNewQtySnows as $result){
                        if($result[0] == 0){
                            executeQueryIDU('UPDATE snows SET active=0 WHERE qtyAvailable=0;');
                        }
                    }





                }

            }
        }
    }

    */

?>