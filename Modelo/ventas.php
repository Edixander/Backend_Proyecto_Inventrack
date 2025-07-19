<?php
    class ventas{
        public $conexion;
        
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        public function consulta() {
            $con = "SELECT v.*, pd.Id_pedidos, us.nombre AS usuario
            FROM ventas v
            INNER JOIN pedidos pd ON v.fo_pedidos = pd.Id_pedidos
            INNER JOIN usuario us ON v.fo_usuario = us.id_usuario
            ORDER BY v.Id_ventas DESC";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];
            while($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
            }
            return $vec;
        }

        public function eliminar($id) {
            $del = "DELETE FROM ventas WHERE id_ventas = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La venta ha sido eliminada";
            return $vec;
        }

        public function insertar($params) {
            $ins = "INSERT INTO ventas(Id_ventas, fo_pedidos, Iva, Total, fo_usuario) 
            VALUES($params->Id_ventas, $params->fo_pedidos, '$params->Iva', $params->Total, $params->fo_usuario)";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La venta ha sido guardada";
            return $vec;
        }

        public function editar($id, $params) {
            $editar = "UPDATE ventas SET Id_ventas = $params->Id_ventas, fo_pedidos = $params->fo_pedidos, Iva = '$params->Iva', Total = $params->Total, fo_usuario = $params->fo_usuario 
            WHERE id_ventas = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La venta ha sido editada";
            return $vec;
        }

        public function filtro($valor) {
            $filtro = "SELECT v.*, pd.Id_pedidos, us.nombre AS usuario
            FROM ventas v
            INNER JOIN pedidos pd ON v.fo_pedidos = pd.Id_pedidos
            INNER JOIN usuario us ON v.fo_usuario = us.id_usuario 
            WHERE us.nombre LIKE '%$valor%' OR pd.Id_pedidosLIKE '%$valor%' OR v.Id_ventas LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec [] = $row;
            }
            return $vec;
        }
    }
?>