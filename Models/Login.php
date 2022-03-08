<?php 
namespace Models;
use Lib\DataBase;

class Login extends Database{
    public function __construct(
        ){
          parent::__construct();
        }
    function checkMail($mail,$table){
        $prep = $this->conexion->prepare('select * from '.$table.' where correo = :mail');
        $prep->execute(array(':mail'=>$mail));
        if($prep->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }

    function fetchUser($mail,$table){
        $prep = $this->conexion->prepare('select * from '.$table.' where correo = :mail');
        $prep->execute(array(':mail'=>$mail));
        return $prep;
    }
    
}
?>