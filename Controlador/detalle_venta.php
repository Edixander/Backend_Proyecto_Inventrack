<?php
     ob_start();

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-Type, Accept');
     header('content-Type: application/json');


    require_once("../conexion.php");
    require_once("../Modelo/detalle_venta.php");
    $control = $_GET ['control'];

    $detaven = new detalle_venta($conexion);

    switch ($control) {
    case 'consultar_por_venta':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $vec = $detaven->consultar_por_venta($id);
        } else {
            $vec = [
                "resultado" => "error",
                "mensaje" => "No se recibió el id de la venta"
            ];
        }
    break;

        case 'insertar':
        $json = file_get_contents('php://input');
        //$json = '{"nombre": "Prueba"}';
        $params = json_decode($json);
        $detalles = $params->detalles;
        $id_ventas = $params->id_ventas;
        $vec = $detaven->insertar($params->detalles, $params->id_ventas);
        break;

        case 'eliminar':
            $id = $_GET['id'];
            $vec = $detaven->eliminar($id);
        break;

        case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id = $_GET['id'];
        $vec = $detaven->editar($id, $params);
        break;

        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $detaven->filtro($dato);
        break;

        case 'consultar_por_venta':
            $id = $_GET['id'];
            $vec = $detaven->consultar_por_venta($id);
        break;
    }
    
    //$datosJ = json_decode($ven);
    //echo $datosJ;
   
    echo json_encode($vec);
?>