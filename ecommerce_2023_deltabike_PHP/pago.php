<?php

require_once 'config/config.php';
require_once 'config/database.php';

// SDK de Mercado Pago
require_once __DIR__ .  '/vendor/autoload.php';
MercadoPago\SDK::setAccessToken(TOKEN_MP);
$preference = new MercadoPago\Preference();
$productos_mp = array();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$db = new Database();
$con = $db->conectar();

$lista_carrito = array();

if ($productos != null) {
    foreach ($productos as $clave => $producto) {
        $sql = $con->prepare("SELECT id, nombre, precio, descuento, $producto AS cantidad FROM productos WHERE id=? AND activo=1");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    }
} else {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda en linea</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/estilos.css" rel="stylesheet">
    <link href="css/all.min.css" rel="stylesheet">

    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID; ?>&currency=<?php echo CURRENCY; ?>"></script>
    <script src="https://sdk.mercadopago.com/js/v2"></script>

</head>

<body class="d-flex flex-column h-100">

    <?php include 'menu.php'; ?>

    <!-- Contenido -->
    <main class="flex-shrink-0">
        <div class="container mt-5 pt-5">
       
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <h4>Detalles de pago</h4>
                    <div lcass="row">
                        <div class="col-10">
                            <div id="paypal-button-container"></div>
                        </div>
                    </div>

                    <div lcass="row">
                        <div class="col-10 text-center">
                            
                        </div>
                        
                    </div>
                   
                </div>
               
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($lista_carrito == null) {
                                    echo '<tr><td colspan="5" class="text-center"><b>Lista vacia</b></td></tr>';
                                } else {
                                    $total = 0;
                                    foreach ($lista_carrito as $producto) {
                                        $descuento = $producto['descuento'];
                                        $precio = $producto['precio'];
                                        $cantidad = $producto['cantidad'];
                                        $precio_desc = $precio - (($precio * $descuento) / 100);
                                        $subtotal = $cantidad * $precio_desc;
                                        $total += $subtotal;

                                        $item = new MercadoPago\Item();
                                        $item->id = $producto['id'];
                                        $item->title = $producto['nombre'];
                                        $item->quantity = $cantidad;
                                        $item->unit_price = $precio_desc;
                                        $item->currency_id = CURRENCY;

                                        array_push($productos_mp, $item);
                                        unset($item);
                                ?>
                                        <tr>
                                            <td><?php echo $producto['nombre']; ?></td>
                                            <td><?php echo $cantidad . ' x ' . MONEDA . '<b>' . number_format($subtotal, 2, '.', ',') . '</b>'; ?></td>
                                        </tr>
                                    <?php } ?>

                                    <tr>
                                        <td colspan="2">
                                            <p class="h3 text-end" id="total"><?php echo MONEDA . number_format($total, 2, '.', ','); ?></p>
                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                        </table>
                        
                    </div>
                    <div class="checkout-btn"></div>
                </div>
                
            </div>
           
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <?php

    $_SESSION['carrito']['total'] = $total;

    $preference->items = $productos_mp;

    $preference->back_urls = array(
        "success" => SITE_URL . "/clases/captura_mp.php",
        "failure" => SITE_URL . "/clases/fallo.php"
    );
    $preference->auto_return = "approved";
    $preference->binary_mode = true;
    $preference->statement_descriptor = "STORE CDP";
    $preference->external_reference = "Reference_1234";
    $preference->save();

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
        const mp = new MercadoPago('<?php echo PUBLIC_KEY_MP; ?>', {
            locale: '<?php echo LOCALE_MP; ?>'
        });

        // Inicializa el checkout Mercado Pago
        mp.checkout({
            preference: {
                id: '<?php echo $preference->id; ?>'
            },
            render: {
                container: '.checkout-btn', // Indica el nombre de la clase donde se mostrará el botón de pago
                type: 'wallet', // Muestra un botón de pago con la marca Mercado Pago
                label: 'Pagar con Mercado Pago', // Cambia el texto del botón de pago (opcional)
            }
        });
    </script>

</body>

</html>