<?php
    class stock{
        public $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        public function consulta() {
            $con = "SELECT p.Id_productos, p.Nombre AS Nombre_producto,
              s.id_stock, s.cantidad, s.stock_actual, s.tipo_movimiento,
              s.fo_detalle_compra, s.fo_detalle_venta
              FROM productos p
              LEFT JOIN stock s ON s.fo_productos = p.Id_productos
              ORDER BY p.Nombre";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];
            while($row = mysqli_fetch_assoc($res)) {
                $vec[] = $row;
            }
            return $vec;
        }

        public function eliminar($Id) {
            $del = "DELETE FROM stock WHERE id_stock = $Id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El producto ha sido eliminado";
            return $vec;
        }

        public function insertar($params) {
            $fo_detalle_compra = isset($params->fo_detalle_compra) && $params->fo_detalle_compra !== '' ? $params->fo_detalle_compra : "NULL";
            $fo_detalle_venta  = isset($params->fo_detalle_venta) && $params->fo_detalle_venta !== '' ? $params->fo_detalle_venta : "NULL";
            
            $ins = "INSERT INTO stock(fo_productos, fo_detalle_compra, fo_detalle_venta, tipo_movimiento, cantidad, stock_actual, fecha_movimiento) 
            VALUES($params->fo_productos, $fo_detalle_compra, $fo_detalle_venta, '$params->tipo_movimiento', $params->cantidad, 
                   $params->stock_actual, '$params->fecha_movimiento')";
           if (!mysqli_query($this->conexion, $ins)) {
            http_response_code(500);
            die(json_encode([
             "resultado" => "error",
                "mensaje" => "Error SQL: " . mysqli_error($this->conexion),
                "query" => $ins
    ]));
}
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El producto ha sido guardado";
            return $vec;
        }

        public function editar($id, $params) {
            $editar = "UPDATE stock SET fo_productos = $params->fo_productos, fo_detalle_compra = $params->fo_detalle_compra, 
            fo_detalle_venta = $params->fo_detalle_venta, tipo_movimiento = '$params->tipo_movimiento', cantidad = $params->cantidad, 
            stock_actual = $params->stock_actual, fecha_movimiento = '$params->fecha_movimiento'
            WHERE id_stock = $id";
            if (!mysqli_query($this->conexion, $editar)) {
            http_response_code(500);
            die(json_encode([
            "resultado" => "error",
            "mensaje" => "Error SQL: " . mysqli_error($this->conexion),
            "query" => $editar
    ]));
}
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El producto ha sido editado";
            return $vec;
        }

        public function filtro($valor) {
            $filtro = "SELECT s.*, p.Nombre As productos, dc.id_detalle_compra AS id_detalle_compra, dv.id_detalle AS id_detalle_venta 
            FROM stock s
            LEFT JOIN productos p ON s.fo_productos = p.Id_productos
            LEFT JOIN detalle_compra dc ON s.fo_detalle_compra = dc.id_detalle_compra
            LEFT JOIN detalle_venta dv ON s.fo_detalle_venta = dv.id_detalle
            WHERE s.stock_actual LIKE '%$valor%' OR p.Nombre LIKE '%$valor%' OR dc.id_detalle_compra LIKE '%$valor%' OR dv.id_detalle LIKE '%$valor%'
            ORDER BY s.fecha_movimiento DESC";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_assoc($res)) {
                $vec [] = $row;
            }
            return $vec;
        }
    }
?>