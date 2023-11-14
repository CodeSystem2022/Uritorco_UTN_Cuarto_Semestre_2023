<?php

require_once '../config/database.php';
require_once '../config/config.php';
require_once '../header.php';


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


?>

<main>
    <div class="container-fluid px-4">
        <h2 class="mt-4">Categoría nueva</h2>

       <form action="guarda.php" method="post" autocomplete="off">
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre</label>
          <input type="text"class="form-control" name="nombre" id="nombre" required autofocus>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
       </form>
    </div>
    
   
</main>

<?php require_once '../footer.php'; ?>