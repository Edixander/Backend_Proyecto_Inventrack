<?php
     ob_start();

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-Type, Accept');


    require_once("../conexion.php");
    require_once("../Modelo/ventas.php");
    $control = $_GET ['control'];

    $ven = new ventas($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $ven->consulta();
        break;

        case 'insertar':
        $json = file_get_contents('php://input');
        //$json = '{"nombre": "Prueba"}';
        $params = json_decode($json);
        $vec = $ven->insertar($params);
        break;

        case 'eliminar':
            $id = $_GET['id'];
            $vec = $ven->eliminar($id);
        break;

        case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id = $_GET['id'];
        $vec = $ven->editar($id, $params);
        break;

        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $ven->filtro($dato);
        break;
    }
    
    //$datosJ = json_decode($ven);
    //echo $datosJ;
    header('Content-Type: application/json');
    echo json_encode($vec, JSON_UNESCAPED_UNICODE);
?>