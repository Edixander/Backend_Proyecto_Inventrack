<?php
    class login{
        public $conexion;
        
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        public function consulta($Email, $Contrasena) {
            $con = "SELECT * FROM usuario WHERE Email = '$Email'";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];
            while($row =  mysqli_fetch_assoc($res)) {

                if(password_verify($Contrasena, $row['Contrasena'])) {
                    unset($row['Contrasena']);
                    $row['validar'] = "valida";
                    $vec[] = $row;
                }
            }

            if ($vec == []){
                $vec[0] = array("validar"=>"no validar");
            } 
            return $vec;
        }
    }
?>