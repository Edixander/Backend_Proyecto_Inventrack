<?php
class login {
    public $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function consulta($Email, $Contrasena) {
        $con = "SELECT * FROM usuario WHERE Email = '$Email'";
        $res = mysqli_query($this->conexion, $con);

        $vec = [];

        if ($row = mysqli_fetch_assoc($res)) {
            if (password_verify($Contrasena, $row['Contrasena'])) {
                $row['validar'] = 'valida';
            } else {
                $row['validar'] = 'no validar';
            }
            $vec[] = $row;
        } else {
            $vec[] = ['validar'=>'no validar'];
        }

        return $vec;
    }
}
?>
