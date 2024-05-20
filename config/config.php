<?php

define("CLIENT_ID", "TEST-891325390086897-051420-26df5e629833eae541b6eb4bea4f0094-108122944");
define("CURRENCY", "MXN");
define("KEY_TOKEN", "APR.wqc-354*");
define("MONEDA", "$");

session_start();

$num_cart = 0;
if(isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}

?>