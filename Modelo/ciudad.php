<?php
    class ciudad{
        public $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        public function consulta() {
            $con = "SELECT * FROM ciudad ORDER BY nombre";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];
            while($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
            }
            return $vec;
        }

        public function eliminar($id) {
            $del = "DELETE FROM ciudad WHERE id_ciudad = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La ciudad ha sido eliminada";
            return $vec;
        }

        public function insertar($params) {
            $ins = "INSERT INTO ciudad(Id_ciudad, nombre, fo_dpto) VALUES($params->Id_ciudad,'$params->nombre', $params->fo_dpto)";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La ciudad ha sido guardada";
            return $vec;
        }

        public function editar($id, $params) {
            $editar = "UPDATE ciudad SET Id_ciudad = $params->Id_ciudad, nombre = '$params->nombre', fo_dpto = $params->fo_dpto WHERE id_ciudad = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La ciudad ha sido editada";
            return $vec;
        }

        public function filtro($valor) {
            $filtro = "SELECT * FROM ciudad WHERE nombre LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec [] = $row;
            }
            return $vec;
        }
    }
?>