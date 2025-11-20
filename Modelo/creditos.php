<?php
    class creditos{
        public $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        public function consulta() {
            $con = "SELECT cr.*, cl.nombre AS nombre  
            FROM creditos cr
            LEFT JOIN cliente cl ON cr.fo_cliente = cl.id_cliente 
            ORDER BY cr.id_credito DESC";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];
            while($row = mysqli_fetch_assoc($res)) {
                $vec[] = $row;
            }
            return $vec;
        }

        public function eliminar($id) {
            $del = "DELETE FROM creditos WHERE id_credito = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El credito ha sido eliminado";
            return $vec;
        }

        public function insertar($params) {
            $ins = "INSERT INTO creditos(fo_cliente, descripcion, total_credito, fecha_credito, estado_credito) 
            VALUES($params->fo_cliente, '$params->descripcion', $params->total_credito, '$params->fecha_credito', '$params->estado_credito')";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El credito ha sido guardado";
            return $vec;
        }

        public function editar($id, $params) {
           
            $editar = "UPDATE creditos SET fo_cliente = $params->fo_cliente, descripcion = '$params->descripcion', total_credito = $params->total_credito, fecha_credito = '$params->fecha_credito', estado_credito = '$params->estado_credito'
            WHERE id_credito = $id";     
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El credito ha sido editado";
            return $vec;
        }

        public function filtro($valor) {
            $filtro = "SELECT cr.*, cl.nombre AS cliente
            LEFT JOIN cliente cl ON cr.fo_cliente = cl.id_cliente 
            WHERE id_credito LIKE '%$valor%' OR cl.nombre LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_assoc($res)) {
                $vec [] = $row;
            }
            return $vec;
        }
    }
?>