<?php

define("CLIENT_ID", "AZ3-zi_Bcx0UaiN_jqxY4SdbbTv0FWrsTSo31Hw5M6FkooqoDOPxS-PJgd0RXWj0jMPSmUrOKfEfeMK-");
define("CURRENCY", "MXN");
define("KEY_TOKEN", "APR.wqc-354*");
define("MONEDA", "$");

session_start();

$num_cart = 0;
if(isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}

?>