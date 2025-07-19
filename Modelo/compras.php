<?php
    class compras{
        public $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        public function consulta() {
            $con = "SELECT co.*, mp.metodo AS metodo_pago, us.nombre AS usuario
            FROM compras co
            INNER JOIN metodo_pago mp ON co.fo_metodo_pago = mp.id_metodo_pago
            INNER JOIN usuario us ON co.fo_usuario = us.id_usuario
            ORDER BY co.Productos_comprados, co.id_compras";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];
            while($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
            }
            return $vec;
        }

        public function eliminar($id) {
            $del = "DELETE FROM compras WHERE id_compras = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La compra ha sido eliminada";
            return $vec;
        }

        public function insertar($params) {
            $ins = "INSERT INTO compras(Id_compras, Productos_comprados, fo_metodo_pago, Subtotal, Iva, Total, fo_usuario)
            VALUES($params->Id_compras, '$params->Productos_comprados', $params->fo_metodo_pago, $params->Subtotal, '$params->Iva', $params->Total, $params->fo_usuario)";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La compra ha sido guardada";
            return $vec;
        }

        public function editar($id, $params) {
            $editar = "UPDATE compras SET Id_compras = $params->Id_compras, Productos_comprados = '$params->Productos_comprados', fo_metodo_pago = $params->fo_metodo_pago, Subtotal = $params->Subtotal, Iva = '$params->Iva', Total = $params->Total, fo_usuario =  $params->fo_usuario
            WHERE id_compras = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La compra ha sido editada";
            return $vec;
        }

        public function filtro($valor) {
            $filtro = "SELECT co.*, mp.metodo AS metodo_pago, us.nombre AS usuario
            FROM compras co
            INNER JOIN metodo_pago mp ON co.fo_metodo_pago = mp.id_metodo_pago
            INNER JOIN usuario us ON co.fo_usuario = us.id_usuario
            WHERE co.Productos_comprados LIKE '%$valor%' OR mp.metodo LIKE '%$valor%' OR us.nombre LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec [] = $row;
            }
            return $vec;
        }
    }
?>