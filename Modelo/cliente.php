<?php
    class cliente{
        public $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        public function consulta() {
            $con = "SELECT cl.*, pd.id_pedidos, pd.fecha_pedido, pd.subtotal, cr.id_credito, cr.total_credito, cr.fecha_credito, cr.estado
            FROM cliente cl
            LEFT JOIN pedidos pd ON cl.id_cliente = pd.fo_cliente
            LEFT JOIN credito cr ON cl.id_cliente = cr.fo_cliente
            ORDER BY cl.nombre";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];
            while($row = mysqli_fetch_array($res)) {
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
            $ins = "INSERT INTO cliente(Id_cliente, Nombre, Cedula, Direccion, Telefono, Celular, Email, fo_ciudad) 
            VALUES($params->Id_cliente, '$params->nombre', '$params->Cedula', '$params->Direccion', $params->Telefono, $params->Celular, '$params->Email', $params->fo_ciudad)";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "EL cliente ha sido guardado";
            return $vec;
        }

        public function editar($id, $params) {
            $editar = "UPDATE cliente SET Id_cliente = $params->Id_cliente, Nombre = '$params->nombre', Cedula = '$params->Cedula', Direccion = '$params->Direccion', 
            Telefono = $params->Telefono, Celular = $params->Celular, Email = '$params->Email', fo_ciudad = $params->fo_ciudad
            WHERE Id_cliente = $id";       
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "EL cliente ha sido editado";
            return $vec;
        }

        public function filtro($valor) {
            $filtro = "SELECT cl.*, pd.id_pedidos, pd.fecha_pedido, pd.subtotal, cr.id_credito, cr.total_credito, cr.fecha_credito, cr.estado
            FROM cliente cl
            LEFT JOIN pedidos pd ON cl.id_cliente = pd.fo_cliente
            LEFT JOIN credito cr ON cl.id_cliente = cr.fo_cliente 
            WHERE cl.nombre LIKE '%$valor%', OR cl.Cedula LIKE '%$valor%', OR pd.fecha_pedido LIKE '%$valor%', OR cr.estado LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec [] = $row;
            }
            return $vec;
        }
    }
?>