<?php
    class reportes{
        public $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        public function ventas_por_fecha($inicio, $fin) {
          
            $con = "SELECT fecha_venta, SUM(total) AS total 
            FROM ventas
            WHERE fecha_venta BETWEEN '$inicio' AND '$fin'
            GROUP BY fecha_venta";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];
            while($row = mysqli_fetch_assoc($res)) {
                $vec[] = $row;
            }
            return $vec;
        }

         public function ventasPorProducto() {
            $con = "SELECT p.Nombre, SUM(dv.cantidad) AS total_vendido
            FROM detalle_venta dv
            INNER JOIN productos p ON dv.fo_producto = p.Id_productos
            GROUP BY p.Nombre";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];
            while($row = mysqli_fetch_assoc($res)) {
                $vec[] = $row;
            }
            return $vec;
        }
    
        public function stock_bajo() {
            $con = "SELECT p.Nombre, s.stock_actual, p.stock_minimo  
            FROM Productos p
            LEFT JOIN stock s ON p.Id_productos = s.fo_productos 
            WHERE s.stock_actual < p.stock_minimo";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_assoc($res)) {
                $vec [] = $row;
            }
            return $vec;
        }

        public function creditos_pendientes() {
            $con = "SELECT cr.*, cl.nombre AS cliente  
            FROM creditos cr
            LEFT JOIN cliente cl ON cr.fo_cliente = cl.id_cliente
            WHERE cr.estado_credito = 'Pendiente'";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_assoc($res)) {
                $vec [] = $row;
            }
            return $vec;
        }
    }
?>