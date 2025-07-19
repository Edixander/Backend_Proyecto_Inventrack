<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-Type, Accept');


    require_once("../conexion.php");
    require_once("../Modelo/categoria.php");
    $control = $_GET ['control'];

    $cate = new categoria($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $cate->consulta();
        break;

        case 'insertar':
        $json = file_get_contents('php://input');
        //$json = '{"nombre": "Prueba"}';
        $params = json_decode($json);
        $vec = $cate->insertar($params);
        break;

        case 'eliminar':
            $id = $_GET['id'];
            $vec = $cate->eliminar($id);
        break;

        case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id = $_GET['id'];
        $vec = $cate->editar($id, $params);
        break;

        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $cate->filtro($dato);
        break;
    }
    
    //$datosJ = json_decode($ven);
    //echo $datosJ;
    header('content-Type: application/json');
    echo json_encode($vec);
?>