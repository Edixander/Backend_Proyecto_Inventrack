<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-Type, Accept');


    require_once("../conexion.php");
    require_once("../Modelo/metodo_pago.php");
    $control = $_GET ['control'];

    $meto = new metodo_pago($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $meto->consulta();
        break;
        default:
            $vec = ["error" => "Control no válido"];
        break;
    }
    
    //$datosJ = json_decode($ven);
    //echo $datosJ;
    header('content-Type: application/json');
    echo json_encode($vec);
?>