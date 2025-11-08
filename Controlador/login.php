<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");

require_once("../conexion.php");
require_once("../Modelo/login.php");

$Email = '';
$Contrasena = '';

$params = json_decode(file_get_contents("php://input"));

if ($params && isset($params->Email) && isset($params->Contrasena)) {
    $Email = $params->Email;
    $Contrasena = $params->Contrasena;
} else {
    $Email = $_GET['email'] ?? '';
    $Contrasena = $_GET['contrasena'] ?? '';
}

$login = new login($conexion);
$vec = $login->consulta($Email, $Contrasena);

echo json_encode($vec, JSON_UNESCAPED_UNICODE);
?>