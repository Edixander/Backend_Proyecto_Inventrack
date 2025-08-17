<?php
    class login {
        public $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        public function consulta($Email, $Contrasena) {
            $con = "SELECT * FROM usuario WHERE email = '$Email' && contrasena = sha1('$Contrasena')";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while ($row = mysqli_fetch_assoc($res)) {
                $vec[] = $row;
            }

            if ($vec) {
                $vec[] = ["validar" => "no validar"];
            } else {
                $vec[0]['validar']="valida";
            }
            return $vec;
        }
    }
?>