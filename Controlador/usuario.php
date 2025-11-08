<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-Type, Accept');
    header('content-Type: application/json');


    require_once("../conexion.php");
    require_once("../Modelo/usuario.php");
    $control = $_GET ['control'];

    $usua = new usuario($conexion);
    $vec = null; 
    $control = isset($_GET['control']) ? $_GET['control'] : null;

    switch ($control) {
        case 'consulta':
            $vec = $usua->consulta();
        break;

        case 'insertar':
            $params = json_decode(file_get_contents('php://input'));
        if (!$params || !is_object($params)) {
            $vec = ["resultado" => "error", "mensaje" => "JSON no llegó"];
        } else {
            $vec = $usua->insertar($params);
        }
        break;

        case 'eliminar':
            $id = $_GET['id'];
            $vec = $usua->eliminar($id);
        break;

        case 'editar':
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        if (!$params) {
            $params = (object) $_POST;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            $vec = ["resultado"=>"error","mensaje"=>"No se recibió ID"];
        } else {
            $vec = $usua->editar($id, $params);
        }
        break;

        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $usua->filtro($dato);
        break;
    }
    
    //$datosJ = json_decode($ven);
    //echo $datosJ;
   
    echo json_encode($vec);
?>