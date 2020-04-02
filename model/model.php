<?php

require_once 'BD_base.php';

/* ################## PART: LOGIN/SUBSCRIPTION ################## */

function isLoginCorrect($userEmail, $userPsw){

    $result = false;
    $userType = 'customer';
    $test = array();

    $strSeparator = '\'';
    $loginQuery = 'SELECT * FROM customers WHERE email ='.$strSeparator . $userEmail . $strSeparator;
    
    $queryResult = executeQuerySelect($loginQuery);

    if(count($queryResult) == 0){
        $loginQuery = 'SELECT * FROM administrators WHERE email ='.$strSeparator . $userEmail . $strSeparator;
        
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
    
    $queryResult = executeQuerySelect($getIdZipQuery);

    return $queryResult[0]['id'];


}

function registerDataUserInDB($userName, $userFirstname, $userAddress, $userEmail, $userPassword, $userZip){
    $result = false;

    $strSeparator = '\'';

    $userHashPsw = password_hash($userPassword, PASSWORD_DEFAULT);

    $userIdZip = getIdCity($userZip);

    $registerQuery = 'INSERT INTO customers (name, firstname, address, email, password, city_id) VALUES ('.$strSeparator.$userName.$strSeparator. ',' .$strSeparator.$userFirstname.$strSeparator. ',' .$strSeparator.$userAddress.$strSeparator. ',' .$strSeparator.$userEmail.$strSeparator. ',' .$strSeparator.$userHashPsw.$strSeparator. ',' .$userIdZip.');';
    
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
    
    $queryResult = executeQuerySelect($checkQuery);

    if(count($queryResult) == 1){
        $result = true;
    }

    return $result;
}

function getLocalityFromBD(){
    $getLocalityQuery = 'SELECT name FROM cities ORDER BY name ASC';
    
    $queryResult = executeQuerySelect($getLocalityQuery);

    return $queryResult;
}




/* ################## PART: CUSTOMER ACCOUNT ################## */

function getInfosCustomer($userEmail)
{
    $strSeparator = '\'';
    $getInfosQuery = 'SELECT customers.name, customers.firstname, customers.address, cities.zip, cities.name AS nameCity, customers.email FROM customers INNER JOIN cities ON customers.city_id = cities.id WHERE customers.email ='.$strSeparator . $userEmail . $strSeparator ;
    
    $queryResult = executeQuerySelect($getInfosQuery);

    return $queryResult;
}

function updateDataUserInDB($userName, $userFirstname, $userAddress, $userZip, $userEmail){
    $result = false;

    $strSeparator = '\'';

    $userIdZip = getIdCity($userZip);

    $updateDataUserQuery = 'UPDATE customers SET name='.$strSeparator.$userName.$strSeparator.', firstname='.$strSeparator.$userFirstname.$strSeparator.', address='.$strSeparator.$userAddress.$strSeparator.', city_id='.$strSeparator.$userIdZip.$strSeparator.' WHERE email='.$strSeparator.$userEmail.$strSeparator;
    
    $queryResult = executeQueryIDU($updateDataUserQuery);
    if($queryResult){
        $result = $queryResult;
    }
    return $result;
}

function getIdUser($userEmail){

    $strSeparator = '\'';

    $getIdUserQuery = 'SELECT id FROM customers WHERE email ='. $strSeparator.$userEmail.$strSeparator;
    
    $queryResult = executeQuerySelect($getIdUserQuery);

    return $queryResult[0]['id'];
}

function getPreviousOrdersFromDB($userId){

    $getPreviousOrdersQuery = 'SELECT orders.id, orders.orderDate, SUM(articles.price) AS totalCost FROM orders INNER JOIN customers ON orders.customer_id = customers.id INNER JOIN orders_has_articles ON orders_has_articles.Orders_id = orders.id INNER JOIN articles ON orders_has_articles.Articles_id = articles.id WHERE customers.id ='.$userId.' GROUP BY orders.id';

    
    $queryResult = executeQuerySelect($getPreviousOrdersQuery);

    return $queryResult;
}

function getAPreviousOrder($idOrder){

    $getAPreviousOrderQuery = 'SELECT orders.id AS orderId, articles.id AS articleId, articletypes.name AS articleType, orders.orderDate AS orderDate, articles.pathFileCover, articles.name AS nameArticle, artists.name AS nameArtist, articles.releaseYear, articles.price, orders_has_articles.Quantity AS quantity FROM articles INNER JOIN artists ON articles.artist_id = artists.id INNER JOIN articletypes ON articles.articleType_id = articletypes.id INNER JOIN orders_has_articles ON orders_has_articles.Articles_id = articles.id INNER JOIN orders ON orders_has_articles.Orders_id = orders.id WHERE orders_has_articles.Orders_id ='.$idOrder.' GROUP BY articles.id';
    

    return executeQuerySelect($getAPreviousOrderQuery);
}



/* ################## PART: ALBUM CD/VINYLES ################## */

function getAlbumCD(){
    $getAlbumCDQuery = 'SELECT articles.id, articletypes.name, articles.pathFileCover, articles.name AS NameArticle, artists.name AS NameArtist, articles.releaseYear, genres.name AS NameGenre, labels.name AS NameLabel, articles.quantity, articles.price FROM articles INNER JOIN articletypes ON articles.articleType_id = articletypes.id INNER JOIN artists ON articles.artist_id = artists.id INNER JOIN countries ON artists.country_id = countries.id INNER JOIN labels ON articles.label_id = labels.id INNER JOIN genres ON articles.genre_id = genres.id LEFT JOIN vinyleformats ON articles.vinyleFormat_id = vinyleformats.id WHERE articletypes.name = "Album CD";';

    

    return executeQuerySelect($getAlbumCDQuery);

}

function getVinyle(){

    $getVinyleQuery = 'SELECT articles.id, articletypes.name, articles.pathFileCover, articles.name AS NameArticle, artists.name AS NameArtist, articles.releaseYear, genres.name AS NameGenre, labels.name AS NameLabel, articles.quantity, articles.price, vinyleformats.name AS NameFormatVinyle FROM articles INNER JOIN articletypes ON articles.articleType_id = articletypes.id INNER JOIN artists ON articles.artist_id = artists.id INNER JOIN countries ON artists.country_id = countries.id INNER JOIN labels ON articles.label_id = labels.id INNER JOIN genres ON articles.genre_id = genres.id LEFT JOIN vinyleformats ON articles.vinyleFormat_id = vinyleformats.id WHERE articletypes.name = "Vinyle";';

    

    return executeQuerySelect($getVinyleQuery);
}

function getAnArticle($id){

    $getAnArticleQuery = 'SELECT articles.id, articletypes.name, articles.pathFileCover, articles.name AS NameArticle, artists.name AS NameArtist, articles.releaseYear, genres.name AS NameGenre, labels.name AS NameLabel, vinyleformats.name AS NameFormatVinyle, articles.quantity, countries.name AS NameCountry, articles.price FROM articles INNER JOIN articletypes ON articles.articleType_id = articletypes.id INNER JOIN artists ON articles.artist_id = artists.id INNER JOIN countries ON artists.country_id = countries.id INNER JOIN labels ON articles.label_id = labels.id INNER JOIN genres ON articles.genre_id = genres.id LEFT JOIN vinyleformats ON articles.vinyleFormat_id = vinyleformats.id WHERE articles.id ='.$id;

    return executeQuerySelect($getAnArticleQuery);
}

function getDetailsArticle($idArticle){

    $getDetailsArticleQuery = 'SELECT musics.id AS idMusic, musics.title, musics.pathFileMusic, musics.duration FROM musics INNER JOIN articles ON musics.article_id = articles.id WHERE articles.id ='.$idArticle;

    

    return executeQuerySelect($getDetailsArticleQuery);

}

function getNumbersOfMusics($idArticle){

    $getNumbersOfMusicsQuery = 'SELECT COUNT(musics.id) FROM musics INNER JOIN articles ON musics.article_id = articles.id WHERE articles.id ='.$idArticle;

    

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


/* ################## PART: ADMINISTRATOR ################## */


function getAllGenresMusic(){
    $allGenresMusicQuery = 'SELECT name FROM genres';
    
    $queryResult = executeQuerySelect($allGenresMusicQuery);
    return $queryResult;
}

function getAllCoutries(){
    $allCountriesQuery = 'SELECT name FROM countries';
    
    $queryResult = executeQuerySelect($allCountriesQuery);
    return $queryResult;
}

function getAllVinyleFormats(){
    $allVinyleFormatsQuery = 'SELECT name FROM vinyleformats';
    
    $queryResult = executeQuerySelect($allVinyleFormatsQuery);
    return $queryResult;
}



function getIdArticle($nameArticle, $releaseYear){
    $strSeparator = '\'';

    $idArticleQuery = 'SELECT id FROM articles WHERE name='.$strSeparator.$nameArticle.$strSeparator.' AND releaseYear='.$releaseYear;
    
    $queryResult = executeQuerySelect($idArticleQuery);

    return $queryResult[0]['id'];

}



function insertNewArticle($typeArticle, $nameArticle, $nameArtist, $origineArtist, $genreMusic, $nameLabel, $quantity, $price, $releaseYear, $vinyleFormat){

    $strSeparator = '\'';
    $idArticleType = getIdArticleType($typeArticle);
    $idArtist = getIdArtist($nameArtist, $origineArtist);
    $idLabel = getIdLabel($nameLabel);
    $idGenre = getIdGenre($genreMusic);
    $idVinyleFormat = getIdVinyleFormat($vinyleFormat);
    
    if($idArticleType == 1) {
        $insertNewArticle = 'INSERT INTO articles (name, releaseYear, pathFileCover, price, quantity, articleType_id, artist_id, label_id, genre_id) VALUES('.$strSeparator.$nameArticle.$strSeparator.', '.$releaseYear.', '.$strSeparator.'#'.$strSeparator.', '.$price.', '.$quantity.', '.$idArticleType.', '.$idArtist.', '.$idLabel.', '.$idGenre.')';
        if(!executeQueryIDU($insertNewArticle)){
            return false;
        }
        else{
            return true;
        }
    }
    else{
        $insertNewArticle = 'INSERT INTO articles (name, releaseYear, pathFileCover, price, quantity, articleType_id, artist_id, label_id, genre_id, vinyleFormat_id) VALUES('.$strSeparator.$nameArticle.$strSeparator.', '.$releaseYear.', '.$strSeparator.'#'.$strSeparator.', '.$price.', '.$quantity.', '.$idArticleType.', '.$idArtist.', '.$idLabel.', '.$idGenre.', '.$idVinyleFormat.')';
        if(!executeQueryIDU($insertNewArticle)){
            return false;
        }
        else{
            return true;
        }
    }
}

function getIdArticleType($articleType){

    $strSeparator = '\'';

    $idArticleTypeQuery = 'SELECT id FROM articletypes WHERE name='.$strSeparator.$articleType.$strSeparator;
    
    $queryResult = executeQuerySelect($idArticleTypeQuery);

    return $queryResult[0]['id'];

}


function getIdArtist($nameArtist, $origineArtist){
    $loop = true;
    $result = false;

    do {
        $strSeparator = '\'';

        $idArticleTypeQuery = 'SELECT id FROM artists WHERE name=' . $strSeparator . $nameArtist . $strSeparator;

        $queryResult = executeQuerySelect($idArticleTypeQuery);
        if (count($queryResult) == 1) {
            $result = $queryResult[0]['id'];
            $loop = false;
        } else {
            $insertResult = insertNewArtist($nameArtist, $origineArtist);
            if (!$insertResult) {
                $result = false;
                $loop = false;
            }

        }
    }while ($loop);

    return $result;
}


function insertNewArtist($nameArtist, $origineArtist){
    $strSeparator = '\'';
    $idOrigine = getIdCountry($origineArtist);
    $insertNewArtistQuery = 'INSERT INTO artists (name, country_id) VALUES ('.$strSeparator.$nameArtist.$strSeparator.', '.$idOrigine.')';
    
    $queryResult = executeQueryIDU($insertNewArtistQuery);
    return $queryResult;
}

function getIdCountry($origineArtist){
    $strSeparator = '\'';

    $idCountryQuery = 'SELECT id FROM countries WHERE name='.$strSeparator.$origineArtist.$strSeparator;
    
    $queryResult = executeQuerySelect($idCountryQuery);
    return $queryResult[0]['id'];
}



function getIdLabel($nameLabel){
    $loop = true;
    $result = false;

    do {
        $strSeparator = '\'';
        $idLabelQuery = 'SELECT id FROM labels WHERE name=' . $strSeparator . $nameLabel . $strSeparator;

        $queryResult = executeQuerySelect($idLabelQuery);
        if (count($queryResult) == 1) {
            $result = $queryResult[0]['id'];
            $loop = false;
        } else {
            $insertResult = insertNewLabel($nameLabel);
            if (!$insertResult) {
                $result = false;
                $loop = false;
            }
        }
    }while($loop);

    return $result;
}

function insertNewLabel($nameLabel){
    $strSeparator = '\'';
    $insertNewLabelQuery = 'INSERT INTO labels (name) VALUES ('.$strSeparator.$nameLabel.$strSeparator.')';
    
    $queryResult = executeQueryIDU($insertNewLabelQuery);
    return $queryResult;
}


function getIdGenre($genreMusic){
    $strSeparator = '\'';
    $idGenreMusicQuery = 'SELECT id FROM genres WHERE name='.$strSeparator.$genreMusic.$strSeparator;
    
    $queryResult = executeQuerySelect($idGenreMusicQuery);
    return $queryResult[0]['id'];
}

function getIdVinyleFormat($vinyleFormat){
    if($vinyleFormat == null){
        return null;
    }
    else{
        $strSeparator = '\'';
        $idVinyleFormatQuery = 'SELECT id FROM vinyleformats WHERE name='.$strSeparator.$vinyleFormat.$strSeparator;
        
        $queryResult = executeQuerySelect($idVinyleFormatQuery);
        return $queryResult[0]['id'];
    }
}



function updateArticleBD($typeArticle, $idArticle, $nameArticle, $nameArtist, $origineArtist, $genreMusic, $nameLabel, $quantity, $price, $releaseYear, $vinyleFormat){

    $strSeparator = '\'';
    $idArticleType = getIdArticleType($typeArticle);
    $idArtist = getIdArtist($nameArtist, $origineArtist);
    $idLabel = getIdLabel($nameLabel);
    $idGenre = getIdGenre($genreMusic);
    $idVinyleFormat = getIdVinyleFormat($vinyleFormat);

    if($idArticleType == 1) {
        $updateArticleQuery = 'UPDATE articles SET name='.$strSeparator.$nameArticle.$strSeparator.', releaseYear='.$releaseYear.', pathFileCover="#", price='.$price.', quantity='.$quantity.', artist_id='.$idArtist.', label_id='.$idLabel.', genre_id='.$idGenre.' WHERE id='.$idArticle;
        if(!executeQueryIDU($updateArticleQuery)){
            return false;
        }
        else{
            return true;
        }
    }
    else{
        $updateArticleQuery = 'UPDATE articles SET name='.$strSeparator.$nameArticle.$strSeparator.', releaseYear='.$releaseYear.', pathFileCover="#", price='.$price.', quantity='.$quantity.', artist_id='.$idArtist.', label_id='.$idLabel.', genre_id='.$idGenre.', vinyleFormat_id='.$idVinyleFormat.' WHERE id='.$idArticle;
        if(!executeQueryIDU($updateArticleQuery)){
            return false;
        }
        else{
            return true;
        }
    }

}


function deleteArticleBD($idArticle){



    $musicsArticle = getDetailsArticle($idArticle);

    if($musicsArticle != null) {
        foreach ($musicsArticle as $result) {

            $fileToDelete = 'view/content/musics/'.$result['idMusic'].$result['title'].'.mp3';

            unlink($fileToDelete);
        }
    }

    $deleteArticleQuery = 'DELETE FROM articles WHERE id='.$idArticle;

    return executeQueryIDU($deleteArticleQuery);
}


function insertNewMusic($title, $duration, $idArticle){
    $strSeparator = '\'';

    $insertNewMusicQuery = 'INSERT INTO musics (title, pathFileMusic, duration, article_id) VALUES('.$strSeparator.$title.$strSeparator.', "#",'.$strSeparator.$duration.$strSeparator.', '.$idArticle.')';

    if(!executeQueryIDU($insertNewMusicQuery)){
        return false;
    }
    else{
        return true;
    }
}

function getIdMusic($title, $idArticle){

    $strSeparator = '\'';

    $getIdMusicQuery = 'SELECT id FROM musics WHERE title='.$strSeparator.$title.$strSeparator.' AND article_id='.$idArticle;

    $queryResult = executeQuerySelect($getIdMusicQuery);

    return $queryResult[0]['id'];

}

function deleteMusicBD($idMusic){

    $deleteMusicQuery = 'DELETE FROM musics WHERE id='.$idMusic;

    return executeQueryIDU($deleteMusicQuery);
}

function getInfosMusic($idMusic){
    $getInfosMusicQuery = 'SELECT * FROM musics WHERE id='.$idMusic;

    return executeQuerySelect($getInfosMusicQuery);
}

function updateMusicBD($title, $duration, $idMusic){
    $strSeparator = '\'';
    $updateMusicQuery = 'UPDATE musics SET title='.$strSeparator.$title.$strSeparator.', duration='.$strSeparator.$duration.$strSeparator.' WHERE id='.$idMusic;

    return executeQueryIDU($updateMusicQuery);

}

function getTitleMusic($idMusic){
    $getTitleMusic = 'SELECT title FROM musics WHERE id='.$idMusic;

    $queryResult = executeQuerySelect($getTitleMusic);

    return $queryResult[0]['title'];
}

?>