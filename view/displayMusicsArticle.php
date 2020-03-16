<?php
/**
 * Created by PhpStorm.
 * User: Mauricio COSTA CABRAL
 * Date: 06.03.2020
 * Version: 0.1
 */

ob_start();
$titre="Art-Music - Détails article";
?>





<?php
$content = ob_get_clean();
require "gabarit.php";

?>
