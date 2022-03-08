<?php 
namespace Models;
use Lib\DataBase;

class Sesion extends Database{
    public function __construct(
        ){
          parent::__construct();
        }
    
    function consulSesiones($id=''){
        if ($id != ''){
            $prep = $this->conexion->prepare('select * from sesiones where id = :id');
            $prep->execute(array(':id'=>$id));
            return $prep;
        }else{
            $sql = 'select * from sesiones';
            return $this->conexion->query($sql);
        }
    }

    function deleteSesiones($id){
        $prep = $this->conexion->prepare('update sesiones set butacas_disponibles = 0 where id=:id');
        $prep->execute(array(':id'=>$id));
    }

    function darAltaSesion($id){
        $prep = $this->conexion->prepare('update sesiones set butacas_disponibles = 100 where id=:id');
        $prep->execute(array(':id'=>$id));
    }

    function insertSesion($data){
        $prep = $this->conexion->prepare('Insert into sesiones values(:id,:pelicula,:fecha,:butacas_disponibles)');
        foreach($data as $clave=>$dato){
            $prep->bindValue($clave,$dato);
        }
        $prep->execute();
    }

    function updateSesion($data,$id){
        $prep = $this->conexion->prepare('
        update sesiones set pelicula=:pelicula,fecha=:fecha,butacas_disponibles=:butacas_disponibles where id='.$id);
        foreach($data as $clave=>$dato){
            $prep->bindValue($clave,$dato);
        }
        $prep->execute();
    }
}
?>