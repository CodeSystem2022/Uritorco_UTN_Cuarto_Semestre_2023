<?php

echo "Error al realizar el pago";

$json = file_get_contents("php://input");
$data = json_decode($json);
print_r($data);
