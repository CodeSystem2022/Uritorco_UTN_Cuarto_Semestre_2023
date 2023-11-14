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

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$categoria = $_POST['categoria'];

$sql = "INSERT INTO productos (nombre, descripcion, precio, stock, id_categoria, activo) VALUES(?,?,?,?,?,1)";
$stm = $con->prepare($sql); //stm -> statement
if ($stm->execute([$nombre, $descripcion, $precio, $stock, $categoria])) {
    $id = $con->lastInsertId();

    if($_FILES['imagen_principal']['error'] == UPLOAD_ERR_OK) {  //si no hay ningún error...
        $dir = '../../images/productos/'. $id . '/';
        $permitidos = ['jpeg', 'jpg'];  //definimos el tipo de imagen permitido
        $arregloImagen = explode('.', $_FILES['imagen_principal']['name']); 
        $extension = strtolower(end($arregloImagen)); //indica la extension y lo pasa a minúscula si hace falta

        if(in_array($extension, $permitidos)) { //si es verdadero, está dentro de lo permitido
            if(!file_exists($dir)) {  //si no existe la ubicación dir, que se cree
                mkdir($dir, 0777, true); //el 0777 es un permiso
            }
            $ruta_img = $dir . 'principal.' . $extension;
            if(move_uploaded_file($_FILES['imagen_principal']['tmp_name'], $ruta_img)) { //archivo temporal que mandamos a la carpeta
                echo "Se cargó el archivo.";
            } else {
                echo "Ha ocurrido un error al cargar el archivo.";
            }
        }
     } 
}


header('Location: index.php');