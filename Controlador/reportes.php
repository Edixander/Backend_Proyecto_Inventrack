<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-Type, Accept');
    header('Content-Type: application/json; charset=utf-8');

    require_once("../conexion.php");
    require_once("../Modelo/reportes.php");

    $control = $_GET['control'] ?? '';
    $rep = new reportes($conexion);

    $vec = [];

    try {
        switch ($control) {
            case 'ventas_por_fecha':
                $inicio = $_GET['inicio'] ?? '';
                $fin = $_GET['fin'] ?? '';
                $vec = $rep->ventas_por_fecha($inicio, $fin);
                break;

            case 'ventas_por_producto':
                $vec = $rep->ventasPorProducto();
                break;

            case 'stock_bajo':
                $vec = $rep->stock_bajo();
                break;

            case 'creditos_pendientes':
                $vec = $rep->creditos_pendientes();
                break;

            default:
                $vec = ["resultado" => "error", "mensaje" => "Control no válido en reportes.php"];
                break;
        }
    } catch (Exception $e) {
        $vec = ["resultado" => "error", "mensaje" => $e->getMessage()];
    }

    echo json_encode($vec, JSON_UNESCAPED_UNICODE);
    exit;
?>