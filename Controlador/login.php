<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-Type, Accept');
    header('Content-Type: application/json');

    require_once("../conexion.php");
    require_once("../Modelo/login.php");
 
    $Email = $_GET['Email'] ?? $_GET['email'] ?? '';
    $Contrasena = $_GET['Contrasena'] ?? $_GET['contrasena'] ?? '';

    $login = new Login($conexion);

    $vec = $login->consulta($Email, $Contrasena);
    
    //$datosJ = json_decode($ven);
    //echo $datosJ;
    echo json_encode($vec);
?>