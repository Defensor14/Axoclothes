<?php
//Configuracion del sistema
define('SITE_URL', 'http://localhost/Axoclothes/Axoclothes/home');
define("KEY_TOKEN", "APR.wqc-354*");
define("MONEDA", "$");

//Datos de paypal
define("CLIENT_ID", "AZ3-zi_Bcx0UaiN_jqxY4SdbbTv0FWrsTSo31Hw5M6FkooqoDOPxS-PJgd0RXWj0jMPSmUrOKfEfeMK-");
define("CURRENCY", "MXN");

//Datos para envio de correo
define("MAIL_HOST", "smtp-mail.outlook.com");
define("MAIL_USER", "leyend.dx@outlook.com");
define("MAIL_PASS", "Leyenda0807");
define("MAIL_PORT", "587");

session_start();

$num_cart = 0;
if(isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}

?>