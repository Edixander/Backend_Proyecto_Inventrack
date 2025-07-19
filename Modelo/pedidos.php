<?php
    class pedidos{
        public $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        public function consulta() {
            $con = "SELECT pd.*, cl.nombre AS cliente, mp.metodo AS metodo_pago, us.nombre AS usuario 
            FROM pedidos pd
            INNER JOIN cliente cl ON pd.fo_cliente = cl.Id_cliente
            INNER JOIN metodo_pago mp ON pd.fo_metodo_pago = mp.Id_metodo_pago 
            INNER JOIN usuario us ON pd.fo_usuario = us.Id_usuario 
            ORDER BY pd.Id_pedidos DESC";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];
            while($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
            }
            return $vec;
        }

        public function eliminar($id) {
            $del = "DELETE FROM pedidos WHERE id_pedidos = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El pedido ha sido eliminado";
            return $vec;
        }

        public function insertar($params) {
            $ins = "INSERT INTO pedidos(Id_pedidos, Lista_productos, Fecha_pedido, fo_cliente, fo_metodo_pago, Subtotal, fo_usuario) 
            VALUES($params->Id_pedidos, '$params->Lista_productos', '$params->Fecha_pedido', $params->fo_cliente, $params->fo_metodo_pago, $params->Subtotal, $params->fo_usuario";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El pedido ha sido guardado";
            return $vec;
        }

        public function editar($id, $params) {
            $editar = "UPDATE pedidos SET Id_pedidos = $params->Id_pedidos, Lista_productos = '$params->Lista_productos', Fecha_pedido = '$params->Fecha_pedido', fo_cliente = $params->fo_cliente, fo_metodo_pago = $params->fo_metodo_pago, Subtotal = $params->Subtotal, fo_usuario = $params->fo_usuario  
            WHERE id_pedidos = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El pedido ha sido editado";
            return $vec;
        }

        public function filtro($valor) {
            $filtro = "SELECT pd.*, cl.nombre AS cliente, mp.metodo AS metodo_pago, us.nombre AS usuario 
            FROM pedidos pd
            INNER JOIN cliente cl ON pd.fo_cliente = cl.Id_cliente
            INNER JOIN metodo_pago mp ON pd.fo_metodo_pago = mp.Id_metodo_pago 
            INNER JOIN usuario us ON pd.fo_usuario = us.Id_usuario  
            WHERE cl.nombre LIKE '%$valor%' OR mp.metodo LIKE '%$valor%' OR dp.Id_pedidos LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec [] = $row;
            }
            return $vec;
        }
    }
?>