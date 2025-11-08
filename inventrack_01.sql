-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 08-11-2025 a las 04:55:48
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventrack_01`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alertas_stock`
--

CREATE TABLE `alertas_stock` (
  `id_alerta` int(11) NOT NULL,
  `fo_productos` int(11) NOT NULL,
  `mensaje` varchar(255) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `leido` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`) VALUES
(2, 'Frutas'),
(3, 'Lácteos'),
(4, 'Panadería'),
(5, 'Despensa'),
(6, 'Granos'),
(9, 'Dulces');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id_ciudad` int(11) NOT NULL,
  `nombre_ciudad` varchar(100) NOT NULL,
  `fo_departamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id_ciudad`, `nombre_ciudad`, `fo_departamento`) VALUES
(1, 'Medellín', 1),
(2, 'Bogotá', 2),
(3, 'Cali', 3),
(4, 'Leticia', 4),
(5, 'Arauca', 5),
(6, 'Barranquilla', 6),
(7, 'Cartagena', 7),
(8, 'Tunja', 8),
(9, 'Manizales', 9),
(10, 'Florencia', 10),
(11, 'Yopal', 11),
(12, 'Popayán', 12),
(13, 'Valledupar', 13),
(14, 'Quibdó', 14),
(15, 'Montería', 15),
(16, 'Inírida', 16),
(17, 'San José del Guaviare', 17),
(18, 'Neiva', 18),
(19, 'Riohacha', 19),
(20, 'Santa Marta', 20),
(21, 'Villavicencio', 21),
(22, 'Pasto', 22),
(23, 'Cúcuta', 23),
(24, 'Mocoa', 24),
(25, 'Armenia', 25),
(26, 'Pereira', 26),
(27, 'San Andrés', 27),
(28, 'Bucaramanga', 28),
(29, 'Sincelejo', 29),
(30, 'Ibagué', 30),
(31, 'Mitú', 31),
(32, 'Puerto Carreño', 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fo_ciudad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `cedula`, `direccion`, `telefono`, `celular`, `email`, `fo_ciudad`) VALUES
(1, 'Carlos Pérez', '1234567890', 'Cra 10 #12-34', '6044440000', '3001234567', 'carlos@example.com', 1),
(3, 'Luis Torres', '3456789012', 'Av. Oriental #45-67', '6044442222', '3023456789', 'luis@example.com', 3),
(4, 'Edixander Arboleda ', '15274380', 'CALLE 10ASUR # 55A -16', '5038217', '3228481372', 'edi021078@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compras` int(11) NOT NULL,
  `producto_comprado` varchar(100) DEFAULT NULL,
  `fo_metodo_pago` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `iva` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `fo_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compras`, `producto_comprado`, `fo_metodo_pago`, `subtotal`, `iva`, `total`, `fo_usuario`) VALUES
(1, 'Manzana caja', 1, 20000.00, 0.00, 20000.00, 1),
(2, 'Leche x12', 2, 36000.00, 0.00, 36000.00, 1),
(3, 'Pan x50 unidades', 3, 15000.00, 0.00, 15000.00, 1),
(4, 'Huevos x30', 4, 12000.00, 0.00, 12000.00, 1),
(5, 'Avena x5 kilos', 5, 22000.00, 0.00, 22000.00, 1),
(10, 'Aceite de cocina', 1, 8000.00, 1520.00, 9520.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditos`
--

CREATE TABLE `creditos` (
  `id_credito` int(11) NOT NULL,
  `fo_cliente` int(11) NOT NULL,
  `fo_pedidos` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `total_credito` decimal(10,2) NOT NULL,
  `fecha_credito` date NOT NULL,
  `estado_credito` enum('Activo','Pendiente','Cancelado','Vencido') DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `creditos`
--

INSERT INTO `creditos` (`id_credito`, `fo_cliente`, `fo_pedidos`, `descripcion`, `total_credito`, `fecha_credito`, `estado_credito`) VALUES
(2, 1, NULL, 'Fiado: 2 pantalones', 120000.00, '2025-09-20', 'Pendiente'),
(4, 3, NULL, 'Chaqueta Azul', 95000.00, '2025-10-22', 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id_departamento` int(11) NOT NULL,
  `nombre_departamento` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id_departamento`, `nombre_departamento`) VALUES
(1, 'Antioquia'),
(2, 'Cundinamarca'),
(3, 'Valle del Cauca'),
(4, 'Amazonas'),
(5, 'Arauca'),
(6, 'Atlántico'),
(7, 'Bolívar'),
(8, 'Boyacá'),
(9, 'Caldas'),
(10, 'Caquetá'),
(11, 'Casanare'),
(12, 'Cauca'),
(13, 'Cesar'),
(14, 'Chocó'),
(15, 'Córdoba'),
(16, 'Guainía'),
(17, 'Guaviare'),
(18, 'Huila'),
(19, 'La Guajira'),
(20, 'Magdalena'),
(21, 'Meta'),
(22, 'Nariño'),
(23, 'Norte de Santander'),
(24, 'Putumayo'),
(25, 'Quindío'),
(26, 'Risaralda'),
(27, 'San Andrés y Providencia'),
(28, 'Santander'),
(29, 'Sucre'),
(30, 'Tolima'),
(31, 'Vaupés'),
(32, 'Vichada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id_detalle_compra` int(11) NOT NULL,
  `fo_compra` int(11) NOT NULL,
  `fo_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `fecha_vencimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`id_detalle_compra`, `fo_compra`, `fo_producto`, `cantidad`, `precio_unitario`, `subtotal`, `fecha_vencimiento`) VALUES
(6, 1, 21, 10, 2500.00, 25000.00, '2025-12-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detalle` int(11) NOT NULL,
  `fo_venta` int(11) NOT NULL,
  `fo_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id_detalle`, `fo_venta`, `fo_producto`, `cantidad`, `precio_unitario`, `subtotal`) VALUES
(23, 3, 21, 3, 1000.00, 3000.00),
(24, 31, 22, 3, 600.00, 1800.00),
(25, 3, 21, 2, 1000.00, 2000.00),
(26, 4, 21, 5, 1000.00, 5000.00),
(27, 4, 22, 4, 1500.00, 6000.00),
(29, 33, 23, 5, 3200.00, 16000.00),
(30, 34, 23, 5, 3300.00, 16500.00);

--
-- Disparadores `detalle_venta`
--
DELIMITER $$
CREATE TRIGGER `after_insert_detalle_venta` AFTER INSERT ON `detalle_venta` FOR EACH ROW BEGIN
    UPDATE stock
    SET stock_actual = stock_actual - NEW.cantidad
    WHERE fo_productos = NEW.fo_producto;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodo_pago`
--

CREATE TABLE `metodo_pago` (
  `id_metodo_pago` int(11) NOT NULL,
  `metodo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `metodo_pago`
--

INSERT INTO `metodo_pago` (`id_metodo_pago`, `metodo`) VALUES
(1, 'Efectivo'),
(2, 'Tarjeta crédito'),
(3, 'Tarjeta débito'),
(4, 'Nequi'),
(5, 'Transferencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedidos` int(11) NOT NULL,
  `lista_productos` text NOT NULL,
  `fecha_pedido` date NOT NULL,
  `fo_cliente` int(11) DEFAULT NULL,
  `fo_metodo_pago` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `fo_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedidos`, `lista_productos`, `fecha_pedido`, `fo_cliente`, `fo_metodo_pago`, `subtotal`, `fo_usuario`) VALUES
(1, 'Manzanas, Queso', '2025-08-28', 3, 5, 15000.00, 1),
(2, 'Queso', '2025-08-28', 1, 1, 12000.00, 1),
(3, 'Arinas', '2025-08-28', 1, 1, 25000.00, 1),
(4, 'Panela', '2025-10-22', 1, 2, 4000.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `Id_productos` int(11) NOT NULL,
  `Codigo` varchar(100) DEFAULT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `Precio_compra` decimal(10,2) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `fo_proveedores` int(11) DEFAULT NULL,
  `stock_minimo` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`Id_productos`, `Codigo`, `Nombre`, `Precio`, `Precio_compra`, `id_categoria`, `fo_proveedores`, `stock_minimo`) VALUES
(21, 'P001', 'Manzana', 2500.00, 1800.00, 2, 1, 5),
(22, 'P002', 'Banano', 1800.00, 1200.00, 2, 2, 5),
(23, 'P003', 'Leche', 3500.00, 2900.00, 3, 1, 5),
(29, 'P009', 'Avena', 2800.00, 2100.00, 5, 2, 5),
(36, 'P010', 'Blanqueador', 4500.00, 3500.00, 5, 1, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `Nit` varchar(20) NOT NULL,
  `Razon_social` varchar(150) NOT NULL,
  `Direccion` varchar(150) DEFAULT NULL,
  `Celular` varchar(20) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `fo_ciudad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `Nit`, `Razon_social`, `Direccion`, `Celular`, `Telefono`, `Email`, `fo_ciudad`) VALUES
(1, '900123456-4', 'Distribuidora Fruver S.A.S.', 'Calle 10 #15-20', '3111234567', '6041234567', 'contacto@fruver.com', 2),
(2, '900234567-2', 'Lácteos del Norte Ltda.', 'Carrera 45 #22-34', '3122345678', '6042345677', 'ventas@lacteosnorte.com', 2),
(3, '900345678-3', 'Verduras del Campo', 'Calle 23 #8-12', '3133456789', '6043456789', 'info@verdurascampo.com', 2),
(4, '900456789-4', 'Huevos y Granja S.A.', 'Carrera 17 #30-15', '3144567890', '60445678989', 'huevos@granja.com', 3),
(9, '10236542', 'sonsoneña', 'caale 3 sur # 25-07', '3022546913', '2556987', 'valery.c.m@hotmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `fo_productos` int(11) NOT NULL,
  `fo_detalle_compra` int(11) DEFAULT NULL,
  `fo_detalle_venta` int(11) DEFAULT NULL,
  `tipo_movimiento` enum('Entrada','Salida','Existencia','Vencimiento') NOT NULL,
  `cantidad` int(11) NOT NULL,
  `stock_actual` int(11) NOT NULL,
  `fecha_movimiento` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`id_stock`, `fo_productos`, `fo_detalle_compra`, `fo_detalle_venta`, `tipo_movimiento`, `cantidad`, `stock_actual`, `fecha_movimiento`) VALUES
(14, 21, NULL, NULL, 'Entrada', 5, 5, '2025-10-22 05:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id_usuario` int(11) NOT NULL,
  `Identificacion` varchar(20) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Celular` varchar(20) DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `Rol` varchar(50) NOT NULL,
  `Contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id_usuario`, `Identificacion`, `Nombre`, `Direccion`, `Celular`, `Email`, `Rol`, `Contrasena`) VALUES
(1, '15274380', 'Edixander Arboleda', 'Calle 10ASur #55A-16', '3228481372', 'edi021078@gmail.com', 'Admin', '$2y$10$iUEvoOMnCtmZ7VHqH.LJ8ePLsZggkUGvuI8ZBKn.27HANxQupUxP6'),
(2, '1034567890', 'Laura Gómez Pérez', 'Cra 50 #36-22, Barrio Santa María, Itagüí, Antioquia', '3124567890', 'aura.gomez@inventrack.com', 'Supervisor', '$2y$10$Umt0RV3yC7x6irApKkdmluWEP.44sZK8fllR9Z5K04TN/dmyLgIgC'),
(3, '987654321', 'Carlos Andrés Rodríguez', 'Cll 19 #10-08, Barrio Centro, Dosquebradas, Risaralda', '3109876558', 'carlos.rodriguez@inventrack.com', 'Vendedor', '$2y$10$/9sEzJTm0.zwJnuq98yDN.YK3POproLArfWB92fggYBbJQyY5B1ri');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_ventas` int(11) NOT NULL,
  `fo_pedidos` int(11) DEFAULT NULL,
  `iva` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `fo_usuario` int(11) NOT NULL,
  `fo_metodo_pago` int(11) NOT NULL,
  `fecha_venta` date DEFAULT NULL,
  `estado_venta` varchar(50) DEFAULT NULL,
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_ventas`, `fo_pedidos`, `iva`, `total`, `fo_usuario`, `fo_metodo_pago`, `fecha_venta`, `estado_venta`, `observaciones`) VALUES
(3, NULL, 0.00, 4800.00, 1, 3, '2025-08-03', 'completado', 'Venta de Leche'),
(4, NULL, 0.00, 7200.00, 1, 4, '2025-08-04', 'completado', 'Venta asociada a pedido de Queso'),
(6, NULL, 0.00, 2200.00, 1, 1, '2025-08-05', 'anulada', 'Intento de venta cancelado'),
(7, NULL, 0.00, 15000.00, 1, 2, '2025-08-06', 'completado', 'Venta desde pedido confirmado'),
(8, NULL, 0.00, 8600.00, 1, 4, '2025-08-07', 'completado', 'Venta con pago en Nequi'),
(9, NULL, 0.00, 6000.00, 1, 5, '2025-08-07', 'pendiente', 'Venta de productos variados'),
(11, NULL, 2622.00, 13800.00, 1, 1, '2025-08-08', 'Completado', 'Sin observaciones'),
(12, NULL, 3135.00, 16500.00, 1, 1, '2025-08-09', 'Completado', 'sin observaciones'),
(16, NULL, 1387.00, 7300.00, 1, 1, '2025-08-10', 'Completado', 'Ninguna'),
(17, NULL, 2071.00, 10900.00, 1, 1, '2025-08-10', 'Completado', 'Ninguna'),
(29, NULL, 9500.00, 50000.00, 1, 5, '2025-08-10', 'Completado', 's'),
(30, NULL, 380.00, 2000.00, 1, 3, '2025-08-10', 'Pendiente', 'n'),
(31, NULL, 342.00, 1800.00, 1, 1, '2025-09-26', 'Completado', 'No'),
(33, NULL, 3040.00, 16000.00, 1, 1, '2025-10-07', 'Completado', 'Venta para verificar el iva'),
(34, NULL, 3135.00, 16500.00, 1, 1, '2025-10-22', 'Completado', 'Venta prueba');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alertas_stock`
--
ALTER TABLE `alertas_stock`
  ADD PRIMARY KEY (`id_alerta`),
  ADD KEY `fo_productos` (`fo_productos`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id_ciudad`),
  ADD KEY `fk_ciudad_departamento` (`fo_departamento`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD KEY `fo_ciudad` (`fo_ciudad`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compras`),
  ADD KEY `fk_metodo_pago` (`fo_metodo_pago`),
  ADD KEY `fk_usuario` (`fo_usuario`);

--
-- Indices de la tabla `creditos`
--
ALTER TABLE `creditos`
  ADD PRIMARY KEY (`id_credito`),
  ADD KEY `fo_cliente` (`fo_cliente`),
  ADD KEY `fo_pedidos` (`fo_pedidos`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id_departamento`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id_detalle_compra`),
  ADD KEY `fk_compras` (`fo_compra`),
  ADD KEY `fk_producto` (`fo_producto`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `fo_venta` (`fo_venta`),
  ADD KEY `fo_producto` (`fo_producto`);

--
-- Indices de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  ADD PRIMARY KEY (`id_metodo_pago`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedidos`),
  ADD KEY `fo_cliente` (`fo_cliente`),
  ADD KEY `fo_metodo_pago` (`fo_metodo_pago`),
  ADD KEY `fo_usuario` (`fo_usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`Id_productos`),
  ADD KEY `fo_proveedores` (`fo_proveedores`),
  ADD KEY `fk_productos_categoria` (`id_categoria`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD KEY `fo_ciudad` (`fo_ciudad`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`),
  ADD KEY `fk_stock_producto` (`fo_productos`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id_usuario`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_ventas`),
  ADD KEY `fo_pedidos` (`fo_pedidos`),
  ADD KEY `fo_usuario` (`fo_usuario`),
  ADD KEY `fo_metodo_pago` (`fo_metodo_pago`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alertas_stock`
--
ALTER TABLE `alertas_stock`
  MODIFY `id_alerta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `creditos`
--
ALTER TABLE `creditos`
  MODIFY `id_credito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id_detalle_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  MODIFY `id_metodo_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedidos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `Id_productos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_ventas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alertas_stock`
--
ALTER TABLE `alertas_stock`
  ADD CONSTRAINT `alertas_stock_ibfk_1` FOREIGN KEY (`fo_productos`) REFERENCES `productos` (`Id_productos`);

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `fk_ciudad_departamento` FOREIGN KEY (`fo_departamento`) REFERENCES `departamento` (`id_departamento`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`fo_ciudad`) REFERENCES `ciudad` (`id_ciudad`);

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `fk_metodo_pago` FOREIGN KEY (`fo_metodo_pago`) REFERENCES `metodo_pago` (`id_metodo_pago`),
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`fo_usuario`) REFERENCES `usuario` (`Id_usuario`);

--
-- Filtros para la tabla `creditos`
--
ALTER TABLE `creditos`
  ADD CONSTRAINT `creditos_ibfk_1` FOREIGN KEY (`fo_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `creditos_ibfk_2` FOREIGN KEY (`fo_pedidos`) REFERENCES `pedidos` (`id_pedidos`);

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `fk_compras` FOREIGN KEY (`fo_compra`) REFERENCES `compras` (`id_compras`),
  ADD CONSTRAINT `fk_producto` FOREIGN KEY (`fo_producto`) REFERENCES `productos` (`Id_productos`),
  ADD CONSTRAINT `fk_productos` FOREIGN KEY (`fo_producto`) REFERENCES `productos` (`Id_productos`);

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`fo_venta`) REFERENCES `ventas` (`id_ventas`),
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`fo_producto`) REFERENCES `productos` (`Id_productos`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`fo_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`fo_metodo_pago`) REFERENCES `metodo_pago` (`id_metodo_pago`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`fo_usuario`) REFERENCES `usuario` (`Id_usuario`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`fo_proveedores`) REFERENCES `proveedores` (`id_proveedor`);

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `proveedores_ibfk_1` FOREIGN KEY (`fo_ciudad`) REFERENCES `ciudad` (`id_ciudad`);

--
-- Filtros para la tabla `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `fk_stock_producto` FOREIGN KEY (`fo_productos`) REFERENCES `productos` (`Id_productos`),
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`fo_productos`) REFERENCES `productos` (`Id_productos`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`fo_pedidos`) REFERENCES `pedidos` (`id_pedidos`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`fo_usuario`) REFERENCES `usuario` (`Id_usuario`),
  ADD CONSTRAINT `ventas_ibfk_3` FOREIGN KEY (`fo_metodo_pago`) REFERENCES `metodo_pago` (`id_metodo_pago`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
