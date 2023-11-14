<?php

require_once '../config/database.php';
require_once '../config/config.php';
require_once '../header.php';
require_once '../clases/cifrado.php';

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

$sql = "SELECT nombre, valor FROM configuracion";
$resultado = $con->query($sql);
$datos = $resultado->fetchAll(PDO::FETCH_ASSOC);

$config = [];

foreach ($datos as $dato) {
    $config[$dato['nombre']] = $dato['valor'];
}

//print_r($config); para ver arriba los datos de la base para poner.

?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Configuración</h1>
    </div>
    <form action="guarda.php" method="post">
        <div class="row m-4">
            <div class="col-6">
                <label for="smtp">SMTP</label>
                <input class="form-control" type="text" name="smtp" id="smtp" value="<?php echo $config['correo_smtp'];?>">
            </div>
            <div class="col-6">
                <label for="smtp">Puerto</label>
                <input class="form-control" type="text" name="puerto" id="puerto" value="<?php echo $config['correo_puerto'];?>">
            </div>
        </div>
        <div class="row m-4">
            <div class="col-6">
                <label for="smtp">Email</label>
                <input class="form-control" type="text" name="email" id="email" value="<?php echo $config['correo_email'];?>">
            </div>
            <div class="col-6">
                <label for="smtp">Contraseña</label>
                <input class="form-control" type="password" name="password" id="password" value="<?php echo $config['correo_password'];?>">
            </div>
        </div>
        <div class="row m-4">
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Guardar</button>
            </div>
        </div>
    </form>
</main>

<?php require_once '../footer.php'; ?>