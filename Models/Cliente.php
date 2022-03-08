<?php 
namespace Models;
use Lib\DataBase;

class Cliente extends Database{
    public function __construct(
        ){
          parent::__construct();
        }
    
    function consulCliente(){
        $sql = 'select * from clientes';
        return $this->conexion->query($sql);
    }

    function darAltaClientes($id){
        $prep = $this->conexion->prepare('update clientes set alta = 1 where id=:id');
        $prep->execute(array(':id'=>$id));
    }

    function deleteCliente($id){
        $prep = $this->conexion->prepare('update clientes set alta = 0 where id=:id');
        $prep->execute(array(':id'=>$id));
    }
}
?>