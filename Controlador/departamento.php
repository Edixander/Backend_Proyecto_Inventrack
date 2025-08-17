<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-Type, Accept');
    header('Content-Type: application/json');

    require_once("../conexion.php");
    require_once("../Modelo/departamento.php");
    $control = $_GET ['control']?? '';

    $dpto = new departamento($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $dpto->consulta();
        break;

        default:
            $vec = [
                "resultado" => "error",
                "mensaje" => "Control no válido"
            ];
            break;
    }
    
    //$datosJ = json_decode($ven);
    //echo $datosJ;
    header('content-Type: application/json');
    echo json_encode($vec);
?>