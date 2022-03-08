<?php 
namespace Models;
use Lib\DataBase;

class Reservas extends Database{
    public function __construct(
        ){
          parent::__construct();
        }
    
    function consulReservas($id = ''){
        if ($id != ''){
            $prep = $this->conexion->prepare('select reservas.id, sesiones.pelicula, sesiones.fecha from reservas,clientes,sesiones where reservas.cliente_id = clientes.id and reservas.sesion_id=sesiones.id and reservas.cliente_id = :id');
            $prep->execute(array(':id'=>$id));
            return $prep;
        }else{
            $sql = 'select clientes.nombre as Cnombre, clientes.apellidos as Capellidos, reservas.id, sesiones.pelicula, sesiones.fecha from reservas,clientes,sesiones where reservas.cliente_id = clientes.id and reservas.sesion_id=sesiones.id';
            return $this->conexion->query($sql);
        }
    }

    function deleteReserva($id){
        $prep = $this->conexion->prepare('delete from reservas where id=:id');
        $prep->execute(array(':id'=>$id));
    }

    function Consuldet(){
        $sqlP = 'select id, nombre, apellidos, alta from clientes';
        $sqlD = 'select  id, pelicula, fecha, butacas_disponibles from sesiones';
        $resul = [];
        $resul['clientes'] = $this->conexion->query($sqlP);
        $resul['sesiones'] = $this->conexion->query($sqlD);
        return $resul;
    }

    function insertReservas($data){
        $prep = $this->conexion->prepare('Insert into reservas(cliente_id, sesion_id) values(:cliente,:sesion)');
        foreach($data as $clave=>$dato){
            $prep->bindValue($clave,$dato);
        }
        $prep->execute();
    }
}
?>