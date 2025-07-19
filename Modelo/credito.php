<?php
    class credito{
        public $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        public function consulta() {
            $con = "SELECT cr.*, cl.nombre AS cliente, pd.fecha_pedido  
            FROM credito cr
            LEFT JOIN cliente cl ON cr.fo_cliente = cl.id_cliente
            LEFT JOIN pedidos pd ON cr.fo_pedidos = pd.id_pedidos 
            ORDER BY cr.id_credito DESC";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];
            while($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
            }
            return $vec;
        }

        public function eliminar($id) {
            $del = "DELETE FROM credito WHERE id_credito = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El credito ha sido eliminado";
            return $vec;
        }

        public function insertar($params) {
            $ins = "INSERT INTO credito(id_credito, fo_cliente, fo_pedidos, total_credito, fecha_credito, estado) 
            VALUES($params->id_credito, $params->fo_cliente, $params->fo_pedidos, $params->total_credito, '$params->fecha_credito', '$params->estado')";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El credito ha sido guardado";
            return $vec;
        }

        public function editar($id, $params) {
            $editar = "UPDATE credito SET id_credito = $params->id_credito, fo_cliente = $params->fo_cliente, fo_pedidos = $params->fo_pedidos, total_credito = $params->total_credito, fecha_credito = '$params->fecha_credito', estado = '$params->estado'
            WHERE id_credito = $id";     
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El credito ha sido editado";
            return $vec;
        }

        public function filtro($valor) {
            $filtro = "SELECT cr.*, cl.nombre AS cliente, pd.fecha_pedido  
            FROM credito cr
            LEFT JOIN cliente cl ON cr.fo_cliente = cl.id_cliente
            LEFT JOIN pedidos pd ON cr.fo_pedidos = pd.id_pedidos  
            WHERE id_credito LIKE '%$valor%' OR cl.nombre LIKE '%$valor%' OR pd.fecha_pedido LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec [] = $row;
            }
            return $vec;
        }
    }
?>