<?php
    class metodo_pago{
        public $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        public function consulta() {
        $con = "SELECT * FROM metodo_pago ORDER BY metodo";
        $res = mysqli_query($this->conexion, $con);
        $vec = [];
        while ($row = mysqli_fetch_assoc($res)) {
            $vec[] = $row;
        }
        return $vec;
    }
}