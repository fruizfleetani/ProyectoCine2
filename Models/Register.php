<?php
namespace Models;
use Lib\DataBase;

class Register extends Database{
public function __construct(
    ){
      parent::__construct();
    }
    public function registro($data){
        $prep = $this->conexion->prepare('insert into clientes(nombre,apellidos,correo,password) values(:nombre,:apellidos,:mail,:password)');
        foreach($data as $clave=>$dato){
            $prep->bindValue($clave,$dato);
        }
        $prep->execute();
    }
    public function freemail($mail){
        $prep = $this->conexion->prepare('Select * from clientes where correo = :mail');
        $prep->execute(array(':mail'=>$mail));
        if($prep->rowCount()>0){
            return false;
        }else{
            return true;
        }
    }
}
?>