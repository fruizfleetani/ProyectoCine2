<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Clinica
        </title>
        <meta charset="UTF-8" http-equiv="content-type" content="text/html">
        <link rel="stylesheet" media="screen" type="text/css" href="estilos.css" >
        <!-- <link rel="stylesheet" media="screen" type="text/css" href="estilos4.css" > -->
        <!-- <link rel="stylesheet" media="screen" type="text/css" href="estilos5.css" > -->
        <script src=""></script>
    </head>
    <body>
<?php

session_start();
require_once "autoloader.php";
require_once "View/header.php"; 

if (isset($_SESSION['usertype'])){
    if ($_SESSION['usertype'] == 'cliente'){
        require_once 'View/paginaCliente.php';
    }else if($_SESSION['usertype'] == 'administrador'){
        require_once 'View/paginaAdmin.php';
    }
}else{
    require_once "View/paginaSinregistrar.php";
}

if(isset($_GET['controllador']) && !empty($_GET['controllador']) && isset($_GET['accion']) && !empty($_GET['accion'])){
    $cont = $_GET['controllador'];
    $act = $_GET['accion'];
    if (class_exists($cont)){
        $cont = new $cont;
        if (method_exists($cont,$act)){
            $cont->$act();
        }
    }else{
        require_once "View/default.php";
    }
}else{
    require_once "View/default.php";
}
?>
    </body>
</html>