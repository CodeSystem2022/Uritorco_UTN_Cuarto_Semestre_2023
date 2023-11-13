<?php

$path = dirname(__FILE__); //__FILE__ es que trae (la ruta) desde este mismo archivo 

require_once $path . '/database.php';
require_once $path . '/../admin/clases/cifrado.php'; 


$db = new Database();
$con = $db->conectar();

$sql = "SELECT nombre, valor FROM configuracion";
$resultado = $con->query($sql);
$datos = $resultado->fetchAll(PDO::FETCH_ASSOC);

$config = [];

foreach ($datos as $dato) {
    $config[$dato['nombre']] = $dato['valor'];
}
//print_r($config); para ver arriba los datos de la base para poner.


//Configuración del sistema
define("SITE_URL", "http://localhost/uritorco");
define("KEY_TOKEN", "e0169bcf6c191a4155011db5cb38aaec");
define("MONEDA", "$");

//Configuración para Paypal
define("CLIENT_ID", "TU_CLIENT_ID_PAYPAL");
define("CURRENCY", "ARS");

//Configuración para Mercado Pago
define("TOKEN_MP", "TEST-8256649318085417-110911-cfd7fd0836f69334724e9db8632342ef-125114950");
define("PUBLIC_KEY_MP", "TEST-c5933cab-f3ee-4435-9eb9-87de93b6a6ce");
define("LOCALE_MP", "es-AR");


//Datos para envío de correo electronico
define("MAIL_HOST",  $config['correo_smtp']);
define("MAIL_USER", $config['correo_email']);
define("MAIL_PASS", descrifrar($config['correo_password']));
define("MAIL_PORT", $config['correo_puerto']);

session_start();

$num_cart = 0;
if (isset($_SESSION['carrito']['productos'])) {
    $num_cart = count($_SESSION['carrito']['productos']);
}
