<?php
    class proveedor{
        public $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        public function consulta() {
            $con = "SELECT * FROM proveedor ORDER BY Razon_social";
           $res = mysqli_query($this->conexion, $con);
            $vec = [];
            while($row = mysqli_fetch_assoc($res)) {
                $vec[] = $row;
            }
            return $vec;
        }

        public function eliminar($id) {
            $del = "DELETE FROM proveedor WHERE id_proveedor = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El proveedor ha sido eliminado";
            return $vec;
        }

        public function insertar($params) {
            $ins = "INSERT INTO proveedor(Id_proveedor, Nit, Razon_social, Direccion, Celular, Telefono, Email, fo_ciudad) 
            VALUES($params->Id_proveedor, '$params->Nit', '$params->Razon_social', '$params->Direccion', '$params->Celular', '$params->Telefono', '$params->Email', $params->fo_ciudad)";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El proveedor ha sido guardado";
            return $vec;
        }

        public function editar($id, $params) {
            $editar = "UPDATE proveedor SET Id_proveedor = $params->Id_proveedor, Nit = '$params->Nit', Razon_social = '$params->Razon_social', Direccion = '$params->Direccion', Celular = '$params->Celular', Telefono = '$params->Telefono', Email = '$params->Email', fo_ciudad = $params->fo_ciudad 
            WHERE id_proveedor = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El proveedor ha sido editado";
            return $vec;
        }

        public function filtro($valor) {
            $filtro = "SELECT * FROM proveedor WHERE Razon_social LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec [] = $row;
            }
            return $vec;
        }
    }
?>