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
            while($row = mysqli_fetch_assoc($res)) {
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
            $passwordHash = password_hash($params->Contrasena, PASSWORD_DEFAULT);
            $ins = "INSERT INTO usuario(Identificacion, Nombre, Direccion, Celular, Email, Rol, Contrasena) 
            VALUES('$params->Identificacion', '$params->Nombre', '$params->Direccion', '$params->Celular', '$params->Email', '$params->Rol', '$passwordHash')";
            
            $resultado = mysqli_query($this->conexion, $ins);
    
    $vec = [];
    
    if ($resultado) {
        $vec ["resultado"] = "ok";
        $vec ["mensaje"] = "El usuario ha sido guardado";
    } else {
        $vec ["resultado"] = "error";
        $vec ["mensaje"] = "Error: " . mysqli_error($this->conexion);
    }

    return $vec; 
}

        public function editar($id, $params) {
            $passwordHash = password_hash($params->Contrasena, PASSWORD_DEFAULT);
            $editar = "UPDATE usuario SET Identificacion = '$params->Identificacion', Nombre = '$params->Nombre', Direccion = '$params->Direccion', Celular = $params->Celular, Email = '$params->Email', Rol = '$params->Rol', Contrasena = '$passwordHash'
            WHERE Id_usuario = $id";
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