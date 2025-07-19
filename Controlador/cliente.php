<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-Type, Accept');


    require_once("../conexion.php");
    require_once("../Modelo/cliente.php");
    $control = $_GET ['control'];

    $cli = new cliente($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $cli->consulta();
        break;

        case 'insertar':
        $json = file_get_contents('php://input');
        //$json = '{"nombre": "Prueba"}';
        $params = json_decode($json);
        $vec = $cli->insertar($params);
        break;

        case 'eliminar':
            $id = $_GET['id'];
            $vec = $cli->eliminar($id);
        break;

        case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id = $_GET['id'];
        $vec = $cli->editar($id, $params);
        break;

        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $cli->filtro($dato);
        break;
    }
    
    //$datosJ = json_decode($ven);
    //echo $datosJ;
    header('content-Type: application/json');
    echo json_encode($vec);
?>