<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Origin, X-Requested-with, Content-Type, Accept');


    require_once("../conexion.php");
    require_once("../Modelo/login.php");
   
    $Email = $_GET ['Email'];
    $Contrasena = $_GET ['Contrasena'];

    $login = new Login($conexion);

    $vec = $login->consulta($Email, $Contrasena);
    
    //$datosJ = json_decode($ven);
    //echo $datosJ;
    header('content-Type: application/json');
    echo json_encode($vec);
?>