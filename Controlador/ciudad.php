<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-Type, Accept');


    require_once("../conexion.php");
    require_once("../Modelo/ciudad.php");
    $control = $_GET ['control'];

    $ciu = new ciudad($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $cate->consulta();
        break;

        case 'insertar':
        $json = file_get_contents('php://input');
        //$json = '{"nombre": "Envigado", "fo_dpto": 1}';
        $params = json_decode($json);
        $vec = $ciu->insertar($params);
        break;

        case 'eliminar':
            $id = $_GET['id'];
            $vec = $ciu->eliminar($id);
        break;

        case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id = $_GET['id'];
        $vec = $ciu->editar($id, $params);
        break;

        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $ciu->filtro($dato);
        break;
    }
    
    //$datosJ = json_decode($ven);
    //echo $datosJ;
    header('content-Type: application/json');
    echo json_encode($vec);
?>