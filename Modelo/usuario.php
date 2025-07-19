<?php
    class usuario{
        public $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        public function consulta() {
            $con = "SELECT * FROM usuario ORDER BY nombre";
           $res = mysqli_query($this->conexion, $con);
            $vec = [];
            while($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
            }
            return $vec;
        }

        public function eliminar($id) {
            $del = "DELETE FROM usuario WHERE id_usuario = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El usuario ha sido eliminado";
            return $vec;
        }

        public function insertar($params) {
            $ins = "INSERT INTO usuario(Id_usuario,nombre, Email, Contrasena) 
            VALUES($params->Id_usuario, '$params->nombre', '$params->Email', '$params->Contrasena',)";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El usuario ha sido guardado";
            return $vec;
        }

        public function editar($id, $params) {
            $editar = "UPDATE usuario SET Id_usuario =$params->Id_usuario, nombre = '$params->nombre', Email = '$params->Email', Contrasena = '$params->Contrasena' WHERE id_usuario = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El usuario ha sido editado";
            return $vec;
        }

        public function filtro($valor) {
            $filtro = "SELECT * FROM usuario WHERE nombre LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec [] = $row;
            }
            return $vec;
        }
    }
?>