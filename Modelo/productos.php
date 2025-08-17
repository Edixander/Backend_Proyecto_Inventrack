<?php
    class productos{
        public $conexion;

        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        public function consulta() {
            $con = "SELECT p.*, c.nombre As categoria, pr.Razon_social AS proveedores 
            FROM productos p
            LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
            LEFT JOIN proveedores pr ON p.fo_proveedores = pr.id_proveedor
            ORDER BY p.nombre";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];
            while($row = mysqli_fetch_assoc($res)) {
                $vec[] = $row;
            }
            return $vec;
        }

        public function eliminar($Id) {
            $del = "DELETE FROM productos WHERE Id_productos = $Id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El producto ha sido eliminado";
            return $vec;
        }

        public function insertar($params) {
            $ins = "INSERT INTO productos(fo_proveedores, Codigo, Nombre, Precio, Precio_compra, id_categoria, stock_minimo) 
            VALUES($params->fo_proveedores, '$params->Codigo', '$params->Nombre', $params->Precio, $params->Precio_compra, 
           $params->id_categoria, $params->stock_minimo)";
           if (!mysqli_query($this->conexion, $ins)) {
            http_response_code(500);
            die(json_encode([
             "resultado" => "error",
                "mensaje" => "Error SQL: " . mysqli_error($this->conexion),
                "query" => $ins
    ]));
}
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El producto ha sido guardado";
            return $vec;
        }

        public function editar($id, $params) {
            $editar = "UPDATE productos SET fo_proveedores = $params->fo_proveedores, Codigo = '$params->Codigo', 
            Nombre = '$params->Nombre', Precio = $params->Precio, Precio_compra = $params->Precio_compra, 
            id_categoria = $params->id_categoria, stock_minimo = $params->stock_minimo
            WHERE Id_productos = $id";
            if (!mysqli_query($this->conexion, $editar)) {
            http_response_code(500);
            die(json_encode([
            "resultado" => "error",
            "mensaje" => "Error SQL: " . mysqli_error($this->conexion),
            "query" => $editar
    ]));
}
            $vec = [];
            $vec ["resultado"] = "ok";
            $vec ["mensaje"] = "El producto ha sido editado";
            return $vec;
        }

        public function filtro($valor) {
            $filtro = "SELECT p.*, c.nombre As categoria, pr.Razon_social AS proveedores 
            FROM productos p
            INNER JOIN categoria c ON p.id_categoria = c.id_categoria
            INNER JOIN proveedores pr ON p.fo_proveedores = pr.id_proveedor
            WHERE p.codigo LIKE '%$valor%' OR p.nombre LIKE '%$valor%' OR c.nombre LIKE '%$valor%' OR pr.Razon_social LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while($row = mysqli_fetch_array($res)) {
                $vec [] = $row;
            }
            return $vec;
        }
    }
?>