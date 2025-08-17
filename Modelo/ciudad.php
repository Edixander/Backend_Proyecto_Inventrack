<?php
    class ciudad{
        public $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        public function consulta() {
            $con = "SELECT id_ciudad, nombre_ciudad, fo_departamento 
            FROM ciudad 
            ORDER BY nombre_ciudad";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];
            while ($row = mysqli_fetch_assoc($res)) {
            $vec[] = $row;
        }
            return $vec;
    }  
}
?>