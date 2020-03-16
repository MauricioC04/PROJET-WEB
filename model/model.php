<?php
/**
 * Author   : nicolas.glassey@cpnv.ch
 * Project  : 151_2019_ForStudents
 * Created  : 05.02.2019 - 18:40
 *
 * Last update :    [01.12.2018 author]
 *                  [add $logName in function setFullPath]
 * Git source  :    [link]
 */






function SessionOpen(){

}


function IsLoginCorrect($userEmail, $userPsw){

    $result = false;

    $strSeparator = '\'';
    //$loginQuery = 'SELECT * FROM users WHERE userEmailAddress ='.$strSeparator . $userEmail . $strSeparator . ' and userPsw = ' . $strSeparator . $userPsw . $strSeparator . ';';
    $loginQuery = 'SELECT * FROM users WHERE userEmailAddress ='.$strSeparator . $userEmail . $strSeparator;
    require_once 'BD_base.php';
    echo $loginQuery;
    $queryResult = executeQuerySelect($loginQuery);


    if(count($queryResult) == 1){
        $userHashPsw = $queryResult[0]['userHashPsw'];
        $hashPassowrdDebug = password_hash($userPsw, PASSWORD_DEFAULT);
        $result = password_verify($userPsw, $userHashPsw);
        return $result;

    }


    return $result;
}



function registerNewAccount($userEmailAddress, $userPsw){
    $result = false;

    $strSeparator = '\'';

    $userHashPsw = password_hash($userPsw, PASSWORD_DEFAULT);

    $registerQuery = 'INSERT INTO users (userEmailAddress, userHashPsw) VALUES (' .$strSeparator.$userEmailAddress.$strSeparator. ',' .$strSeparator.$userHashPsw.$strSeparator.');';
    echo $registerQuery;
    require_once 'BD_base.php';
    $queryResult = executeQueryIDU($registerQuery);
    if($queryResult){
        $result = $queryResult;
    }
    return $result;
}




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
}

function getIdUser($userEmail){
    $strSeparator = '\'';
    require_once 'BD_base.php';
    $userIdQuery='SELECT id FROM users WHERE userEmailAddress='.$strSeparator.$userEmail.$strSeparator.';';
    echo $userIdQuery;
    $queryResult = executeQuerySelect($userIdQuery);


    if(count($queryResult) == 1){
        foreach ($queryResult as $result){
            return $result[0];
        }

    }
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

?>