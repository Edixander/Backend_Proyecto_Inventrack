<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-Type, Accept');
    header('content-Type: application/json');


    require_once("../conexion.php");
    require_once("../Modelo/productos.php");
    $control = $_GET ['control'];

    $produc = new productos($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $produc->consulta();
        break;

        case 'insertar':
        $json = file_get_contents('php://input');
        //$json = '{"nombre": "Prueba"}';
        $params = json_decode($json);
        $vec = $produc->insertar($params);
        break;

        case 'eliminar':
            $id = $_GET['id'];
            $vec = $produc->eliminar($id);
        break;

        case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json, false);
        $id = $_GET['id'];
        $vec = $produc->editar($id, $params);
        break;

        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $produc->filtro($dato);
        break;
    }
    
    //$datosJ = json_decode($ven);
    //echo $datosJ;
   
    echo json_encode($vec);
?>