<?php
     ob_start();

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-Type, Accept');
     header('content-Type: application/json');


    require_once("../conexion.php");
    require_once("../Modelo/detalle_compra.php");
    $control = $_GET ['control'];

    $datacom = new detalle_compra($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $datacom->consulta();
        break;

        case 'insertar':
        $json = file_get_contents('php://input');
        //$json = '{"nombre": "Prueba"}';
        $params = json_decode($json);
        $vec = $datacom->insertar($params);
        break;

        case 'eliminar':
            $id = $_GET['id'];
            $vec = $datacom->eliminar($id);
        break;

        case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id = $_GET['id'];
        $vec = $datacom->editar($id, $params);
        break;

        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $datacom->filtro($dato);
        break;
    }
    
    //$datosJ = json_decode($ven);
    //echo $datosJ;
   
    echo json_encode($vec);
?>