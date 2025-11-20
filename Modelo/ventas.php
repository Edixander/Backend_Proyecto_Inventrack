<?php
    class ventas{
        public $conexion;
        
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        public function consulta() {
            $con = "SELECT v.*,us.nombre AS usuario, mp.metodo AS metodo_pago
            FROM ventas v
            LEFT JOIN usuario us ON v.fo_usuario = us.Id_usuario
            LEFT JOIN metodo_pago mp ON v.fo_metodo_pago = mp.id_metodo_pago
            ORDER BY v.id_ventas DESC";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];
            while($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
            }
            return $vec;
        }

        public function eliminar($id) {
            $del = "DELETE FROM ventas WHERE id_ventas = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La venta ha sido eliminada";
            return $vec;
        }

        public function insertar($params) {
        error_log("Datos recibidos en PHP: " . print_r($params, true));

        

        $iva = isset($params->iva) ? $params->iva : 0;
        $total = isset($params->total) ? $params->total : 0;
        $fo_usuario = isset($params->fo_usuario) ? $params->fo_usuario : 0;
        $fo_metodo_pago = isset($params->fo_metodo_pago) ? $params->fo_metodo_pago : 0;
        $fecha_venta = isset($params->fecha_venta) ? $params->fecha_venta : '';
        $estado_venta = isset($params->estado_venta) ? $params->estado_venta : '';
        $observaciones = isset($params->observaciones) ? $params->observaciones : '';

        $ins = "INSERT INTO ventas(iva, total, fo_metodo_pago, fecha_venta, estado_venta, observaciones) 
        VALUES($params->iva, $params->total, $params->fo_usuario, $params->fo_metodo_pago, '$params->fecha_venta', '$params->estado_venta', '$params->observaciones')";
       error_log("Consulta INSERT venta: $ins");
       $venta_resultado = mysqli_query($this->conexion, $ins);

       if (!$venta_resultado) {
        error_log("Error al guardar la venta: " . mysqli_error($this->conexion));
        return [
            "resultado" => "error",
            "mensaje" => "Error al guardar la venta: " . mysqli_error($this->conexion)
        ];
    }
    
        $id_ventas = mysqli_insert_id($this->conexion);
        error_log("ID venta insertada: $id_ventas");

        if (isset($params->productos) && is_array($params->productos)) {
        foreach($params->productos as $p) {
            error_log("Producto recibido: " . print_r($p, true));
            $fo_producto = $p->fo_producto;
            $cantidad = $p->cantidad;
            $precio_unitario = $p->precio_unitario;
            $subtotal = $p->subtotal;

            $ins_det = "INSERT INTO detalle_venta (fo_venta, fo_producto, cantidad, precio_unitario, subtotal)
            VALUES ($id_ventas, $fo_producto, $cantidad, $precio_unitario, $subtotal)";
            error_log("Consulta INSERT detalle_venta: $ins_det");
            $res_det = mysqli_query($this->conexion, $ins_det);
            
            if(!$res_det) {
                error_log("Error al guardar detalle_venta: " . mysqli_error($this->conexion));
                return [
                    "resultado" => "error",
                    "mensaje" => "error al guardar detalle de venta: " . mysqli_error($this->conexion)
                ];
            } else {
            error_log("Detalle de venta guardado correctamente para producto ID $fo_producto");
        }
        }
    }
 error_log("La venta y sus productos han sido guardados correctamente");
            return [
                "resultado" => "ok",
                "mensaje" => "La venta y sus productos han sido guardados"
            ];
        }

        public function detalleVenta($id_ventas) {
        $ins = "SELECT dv.*, p.Nombre AS nombre_producto
            FROM detalle_venta dv
            LEFT JOIN productos p ON p.Id_productos = dv.fo_producto
            WHERE dv.fo_venta = $id_ventas";

           $res = mysqli_query($this->conexion, $ins);

            $detalles = [];
            while($row = mysqli_fetch_assoc($res)) {
            $detalles[] = $row;
    }
        return $detalles;
    }

        public function editar($id, $params) {
            $editar = "UPDATE ventas SET iva = $params->iva, total = $params->total, fo_usuario = $params->fo_usuario,  fo_metodo_pago = $params->fo_metodo_pago, fecha_venta = '$params->fecha_venta', estado_venta = '$params->estado_venta', observaciones = '$params->observaciones'
            WHERE id_ventas = $id";
            mysqli_query($this->conexion, $editar);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "La venta ha sido editada";
            return $vec;
        }

        public function filtro($valor) {
            $filtro = "SELECT v.*,us.nombre AS usuario, mp.metodo AS metodo_pago
            FROM ventas v
            LEFT JOIN usuario us ON v.fo_usuario = us.Id_usuario
            LEFT JOIN metodo_pago mp ON v.fo_metodo_pago = mp.id_metodo_pago
            WHERE us.nombre LIKE '%$valor%' OR v.id_ventas LIKE '%$valor%'  OR mp.Metodo LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec [] = $row;
            }
            return $vec;
        }
    }
?>