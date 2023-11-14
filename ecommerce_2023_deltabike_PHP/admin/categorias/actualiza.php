<?php

require_once '../config/database.php';
require_once '../config/config.php';



if(!isset($_SESSION['user_type'])) {
    header('Location: ../index.php');
    exit;
}

if($_SESSION['user_type'] != 'admin') {
    header('Location: ../../index.php');
    exit;
}

$db = new Database();
$con = $db->conectar();

$id = $_POST['id'];
$nombre = $_POST['nombre'];

$sql = $con->prepare("UPDATE categorias SET nombre = ? WHERE id = ?");

$sql->execute([$nombre, $id]);


header('Location: index.php');

?>
