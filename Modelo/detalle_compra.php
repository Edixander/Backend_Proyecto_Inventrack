<?php
    class detalle_compra{
        public $conexion;
        
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        public function consulta() {
            $con = "SELECT dc.*, co.id_compras, p.nombre AS productos
            FROM detalle_compra dc
            LEFT JOIN compras co ON dc.fo_compra = co.id_compras
            LEFT JOIN productos p ON dc.fo_producto = p.Id_productos
            ORDER BY dc.id_detalle_compra DESC";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];
            while($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
            }
            return $vec;
        }

        public function eliminar($id) {
            $del = "DELETE FROM detalle_compra WHERE id_detalle_compra = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La compra ha sido eliminada";
            return $vec;
        }

        public function insertar($detalles) {
        $vec = [];
        foreach ($detalles as $item) {
            $fo_compra = $item->fo_compra;
            $fo_producto = $item->fo_producto;
            $cantidad = $item->cantidad;
            $precio_unitario = $item->precio_unitario;
            $subtotal = $item->subtotal;

            $ins_det = "INSERT INTO detalle_venta(fo_venta, fo_producto, cantidad, precio_unitario, subtotal) 
            VALUES($fo_compra,  $fo_producto, $cantidad, $precio_unitario, $subtotal)";
            mysqli_query($this->conexion, $ins_det);

        $det_resultado = mysqli_query($this->conexion, $ins_det);
        if (!$det_resultado) {
         return [
        "resultado" => "error",
        "mensaje" => "Error al guardar un producto del detalle: " . mysqli_error($this->conexion)
        ];
        }
          }

            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "Todos los detalles de la compra han sido guardados correctamente";
            return $vec;
        }

        public function editar($id, $params) {
            $editar = "UPDATE detalle_venta SET fo_compra = $params->fo_compra, fo_producto = $params->fo_producto, cantidad = $params->cantidad, precio_unitario = $params->precio_unitario,  subtotal = $params->subtotal
            WHERE id_detalle_compra = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La compra ha sido editada";
            return $vec;
        }

        public function filtro($valor) {
            $filtro = "SELECT dc.*, co.id_compras, p.nombre AS productos
            FROM detalle_venta dv
            LEFT JOIN compras co ON dc.fo_compra = co.id_compras
            LEFT JOIN productos p ON dc.fo_producto = p.Id_productos
            WHERE p.nombre LIKE '%$valor%' OR co.id_compras LIKE '%$valor%' OR dc.id_detalle_compra LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec [] = $row;
            }
            return $vec;
        }

        public function consultar_por_venta($id_compras) {
            $con = "SELECT dc.*, p.nombre AS productos
            FROM detalle_compra dc
            LEFT JOIN productos p ON dc.fo_producto = p.Id_productos
            WHERE dc.fo_compra = $id_compras
            ORDER BY dc.id_detalle_compra DESC";

            $res = mysqli_query($this->conexion, $con);
            $vec = [];
            while ($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
            }
            return $vec;
        }
    }
?>