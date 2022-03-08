<?php
namespace Controller;

class BaseController{
    function __construct()
    {
        
    }

    protected function chckRol($rol){
        if (!isset($_SESSION['usertype']) || $_SESSION['usertype'] != $rol){
            header('Location:index.php');
        }
    }
}
?>