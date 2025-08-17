<?php
    class detalle_venta{
        public $conexion;
        
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        public function consulta() {
            $con = "SELECT dv.*, v.id_ventas, p.nombre AS productos
            FROM detalle_venta dv
            LEFT JOIN ventas v ON dv.fo_venta = v.id_ventas
            LEFT JOIN productos p ON dv.fo_producto = p.Id_productos
            ORDER BY dv.id_detalle DESC";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];
            while($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
            }
            return $vec;
        }

        public function eliminar($id) {
            $del = "DELETE FROM detalle_venta WHERE id_detalle = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La venta ha sido eliminada";
            return $vec;
        }

        public function insertar($detalles, $id_ventas) {
            error_log("Insertar detalles: " . print_r($detalles, true));
            error_log("ID venta: " . $id_ventas);
        foreach ($detalles as $item) {
            $fo_venta = (int)$id_ventas;
            $fo_producto = (int)$item->fo_producto;
            $cantidad = (int)$item->cantidad;
            $precio_unitario = (float)$item->precio_unitario;
            $subtotal = (float)$item->subtotal;

            $ins_det = "INSERT INTO detalle_venta(fo_venta, fo_producto, cantidad, precio_unitario, subtotal) 
            VALUES($fo_venta,  $fo_producto, $cantidad, $precio_unitario, $subtotal)";

        $det_resultado = mysqli_query($this->conexion, $ins_det);

        if (!$det_resultado) {
         return [
        "resultado" => "error",
        "mensaje" => "Error al guardar un producto del detalle: " . mysqli_error($this->conexion)
        ];
        }

        
        }

            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "Todos los detalles de la venta han sido guardados correctamente";
            return $vec;
        }

        public function editar($id, $params) {
            $editar = "UPDATE detalle_venta SET fo_venta = $params->fo_venta, fo_producto = $params->fo_producto, cantidad = $params->cantidad, precio_unitario = $params->precio_unitario,  subtotal = $params->subtotal
            WHERE id_detalle = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La venta ha sido editada";
            return $vec;
        }

        public function filtro($valor) {
            $filtro = "SELECT dv.*, v.id_ventas, p.nombre AS productos
            FROM detalle_venta dv
            LEFT JOIN ventas v ON dv.fo_venta = v.id_ventas
            LEFT JOIN productos p ON dv.fo_producto = p.Id_productos
            WHERE p.nombre LIKE '%$valor%' OR v.id_ventas LIKE '%$valor%' OR dv.id_detalle LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec [] = $row;
            }
            return $vec;
        }

        public function consultar_por_venta($id_ventas) {
            $id_ventas = intval($id_ventas);
            $con = "SELECT dv.*, p.nombre AS productos
            FROM detalle_venta dv
            LEFT JOIN productos p ON dv.fo_producto = p.Id_productos
            WHERE dv.fo_venta = $id_ventas
            ORDER BY dv.id_detalle DESC";

            $res = mysqli_query($this->conexion, $con);
            $vec = [];
            while ($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
            }
            return $vec;
        }
    }
?> 