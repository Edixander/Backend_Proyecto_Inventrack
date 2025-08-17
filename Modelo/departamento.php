<?php
    class departamento{
        public $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        public function consulta() {
            $con = "SELECT * FROM departamento ORDER BY nombre_departamento";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];
            while($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
            }
            return $vec;
        }

        public function eliminar($id) {
            $del = "DELETE FROM departamento WHERE id_departamento = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El departamento ha sido eliminado";
            return $vec;
        }

        public function insertar($params) {
            $ins = "INSERT INTO departamento(nombre_departamento) VALUES('$params->nombre_departamento')";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El departamento ha sido guardado";
            return $vec;
        }

        public function editar($id, $params) {
            $editar = "UPDATE departamento SET nombre_departamento = '$params->nombre_departamento' =  WHERE id_departamento = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El departamento ha sido editado";
            return $vec;
        }

        public function filtro($valor) {
            $filtro = "SELECT * FROM departamento WHERE nombre_departamento LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec [] = $row;
            }
            return $vec;
        }
    }
?>