<?php
namespace View;

class ClienteView{
    function __construct()
    {
        
    }
    function displayError($msg){
        print('<p>Error: '.$msg.'</p>');
    }

    function mostrarMsg($msg){
        print('<h4>'.$msg.'</h4>');
    }

    function mostrAdmClientes($clientes){
        echo '<table><tr><td>Nombre</td><td>Email</td><td>De alta</td><td>Acciones</td></tr>';
        foreach($clientes as $c){
            echo "<tr><td>".$c['nombre'].' '.$c['apellidos']."</td><td>".$c['correo']."</td><td>".$c['alta']."</td><td><a href='index.php?controllador=Controller\ClienteController&accion=deleteAdm&id=".$c['id']."'>Borrar</a><a href='index.php?controllador=Controller\ClienteController&accion=darAltaAdm&id=".$c['id']."'>    Dar de alta</a></td></tr>";
        }
        echo '</table>';
    }
};
?>