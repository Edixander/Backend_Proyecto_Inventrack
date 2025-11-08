<?php
    class cliente{
        public $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        public function consulta() {
            $con = "SELECT cl.id_cliente, cl.nombre, cl.cedula, cl.direccion, 
                   cl.telefono, cl.celular, cl.email, ci.nombre_ciudad AS ciudad
                    FROM cliente cl
                    LEFT JOIN ciudad ci ON cl.fo_ciudad = ci.id_ciudad
                    ORDER BY cl.id_cliente DESC";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];
            
            while ($row = mysqli_fetch_assoc($res)) {
             $vec[] = $row;
         }
             return $vec;
        }
            //http://localhost/Inventrack/backend/Controlador/cliente.php?control=consulta
        public function eliminar($id) {
            $del = "DELETE FROM cliente WHERE id_cliente = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "EL cliente ha sido eliminado";
            return $vec;
        }

        public function insertar($params) {
            $ins = "INSERT INTO cliente(nombre, cedula, direccion, telefono, celular, email, fo_ciudad) 
            VALUES('$params->nombre', '$params->cedula', '$params->direccion', $params->telefono, $params->celular, '$params->email', $params->fo_ciudad)";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "EL cliente ha sido guardado";
            return $vec;
        }

        public function editar($id, $params) {
            $editar = "UPDATE cliente SET nombre = '$params->nombre', cedula = '$params->cedula', direccion = '$params->direccion', 
            telefono = $params->telefono, celular = $params->celular, email = '$params->email', fo_ciudad = $params->fo_ciudad
            WHERE id_cliente = $id";       
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "EL cliente ha sido editado";
            return $vec;
        }

        public function filtro($valor) {
            $filtro = "SELECT 
            FROM cliente cl
            
            WHERE nombre LIKE '%$valor%' 
            ORDER BY nombre";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_assoc($res)) {
                $vec [] = $row;
            }
            return $vec;
        }
    }
?>