<?php
    class usuario{
        public $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        public function consulta() {
            $con = "SELECT * FROM usuario ORDER BY Nombre";
           $res = mysqli_query($this->conexion, $con);
            $vec = [];
            while($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
            }
            return $vec;
        }

        public function eliminar($id) {
            $del = "DELETE FROM usuario WHERE Id_usuario = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El usuario ha sido eliminado";
            return $vec;
        }

        public function insertar($params) {
            $ins = "INSERT INTO usuario(Nombre, Email, Contrasena) 
            VALUES('$params->nombre', '$params->Email', '$params->Contrasena')";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El usuario ha sido guardado";
            return $vec;
        }

        public function editar($id, $params) {
            $editar = "UPDATE usuario SET Nombre = '$params->Nombre', Email = '$params->Email', Contrasena = '$params->Contrasena' WHERE id_usuario = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El usuario ha sido editado";
            return $vec;
        }

        public function filtro($valor) {
            $filtro = "SELECT * FROM usuario WHERE Nombre LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec [] = $row;
            }
            return $vec;
        }
    }
?>