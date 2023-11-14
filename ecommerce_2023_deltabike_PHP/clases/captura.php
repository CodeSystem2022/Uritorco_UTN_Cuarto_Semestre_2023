<?php

require_once '../config/config.php';
require_once '../config/database.php';

$db = new Database();
$con = $db->conectar();

$json = file_get_contents('php://input');
$datos = json_decode($json, true);

if (is_array($datos)) {

    $idCliente = $_SESSION['user_cliente'];
    $sqlProd = $con->prepare("SELECT email FROM clientes WHERE id=? AND estatus=1");
    $sqlProd->execute([$idCliente]);
    $row_cliente = $sqlProd->fetch(PDO::FETCH_ASSOC);

    $status = $datos['details']['status'];
    $fecha = $datos['details']['update_time'];
    $time = date("Y-m-d H:i:s", strtotime($fecha));
    //$email = $datos['details']['payer']['email_address'];
    $email = $row_cliente['email'];
    //$idCliente = $datos['details']['payer']['payer_id'];

    $monto = $datos['details']['purchase_units'][0]['amount']['value'];
    $idTransaccion = $datos['details']['purchase_units'][0]['payments']['captures'][0]['id'];

    $comando = $con->prepare("INSERT INTO compra (fecha, status, email, id_cliente, total, id_transaccion, medio_pago) VALUES(?,?,?,?,?,?,?)");
    $comando->execute([$time, $status, $email, $idCliente, $monto, $idTransaccion, 'paypal']);
    $id = $con->lastInsertId();

    if ($id > 0) {
        $productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

        if ($productos != null) {
            foreach ($productos as $clave => $cantidad) {

                $sqlProd = $con->prepare("SELECT id, nombre, precio, descuento FROM productos WHERE id=? AND activo=1");
                $sqlProd->execute([$clave]);
                $row_prod = $sqlProd->fetch(PDO::FETCH_ASSOC);

                $precio = $row_prod['precio'];
                $descuento = $row_prod['descuento'];
                $precio_desc = $precio - (($precio * $descuento) / 100);

                $sql = $con->prepare("INSERT INTO detalle_compra (id_compra, id_producto, nombre, cantidad, precio) VALUES(?,?,?,?,?)");
                $sql->execute([$id, $row_prod['id'], $row_prod['nombre'], $cantidad, $precio_desc]);
            }

            require_once 'Mailer.php';

            $asunto = "Detalles de su pedido";
            $cuerpo = "<h4>Gracias por su compra</h4>";
            $cuerpo .= '<p>El ID de su compra es: <b>' . $idTransaccion . '</b></p>';

            $mailer = new Mailer();
            $mailer->enviarEmail($email, $asunto, $cuerpo);
        }

        unset($_SESSION['carrito']);
    }
}
