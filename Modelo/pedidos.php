<?php
    class pedidos{
        public $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        public function consulta() {
            $con = "SELECT pd.*, cl.nombre AS cliente, mp.metodo AS metodo_pago, us.nombre AS usuario 
            FROM pedidos pd
            INNER JOIN cliente cl ON pd.fo_cliente = cl.id_cliente
            INNER JOIN metodo_pago mp ON pd.fo_metodo_pago = mp.id_metodo_pago 
            INNER JOIN usuario us ON pd.fo_usuario = us.Id_usuario 
            ORDER BY pd.id_pedidos DESC";
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
            $ins = "INSERT INTO pedidos(lista_productos, fecha_pedido, fo_cliente, fo_metodo_pago, subtotal, fo_usuario) 
            VALUES('$params->lista_productos', '$params->fecha_pedido', $params->fo_cliente, $params->fo_metodo_pago, $params->subtotal, $params->fo_usuario";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El pedido ha sido guardado";
            return $vec;
        }

        public function editar($id, $params) {
            $editar = "UPDATE pedidos SET lista_productos = '$params->lista_productos', fecha_pedido = '$params->fecha_pedido', fo_cliente = $params->fo_cliente, fo_metodo_pago = $params->fo_metodo_pago, subtotal = $params->subtotal, fo_usuario = $params->fo_usuario  
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
            INNER JOIN cliente cl ON pd.fo_cliente = cl.id_cliente
            INNER JOIN metodo_pago mp ON pd.fo_metodo_pago = mp.id_metodo_pago 
            INNER JOIN usuario us ON pd.fo_usuario = us.Id_usuario  
            WHERE cl.nombre LIKE '%$valor%' OR mp.metodo LIKE '%$valor%' OR dp.id_pedidos LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec [] = $row;
            }
            return $vec;
        }
    }
?>