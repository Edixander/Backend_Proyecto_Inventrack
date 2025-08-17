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
            while($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
            }
            return $vec;
        }

        public function eliminar($id) {
            $del = "DELETE FROM metodo_pago WHERE id_metodo_pago = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El metodo_pago ha sido eliminado";
            return $vec;
        }

        public function insertar($params) {
            $ins = "INSERT INTO metodo_pago(metodo) 
            VALUES('$params->metodo')";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El metodo_pago ha sido guardado";
            return $vec;
        }

        public function editar($id, $params) {
            $editar = "UPDATE metodo_pago SET metodo = '$params->metodo' =  WHERE id_metodo_pago = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El metodo_pago ha sido editado";
            return $vec;
        }

        public function filtro($valor) {
            $filtro = "SELECT * FROM metodo_pago WHERE metodo LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec [] = $row;
            }
            return $vec;
        }
    }
?>