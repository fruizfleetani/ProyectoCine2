<?php
namespace View;

class SesionView{
    function __construct()
    {
        
    }
    function displayError($msg){
        print('<p>Error: '.$msg.'</p>');
    }

    function mostrarMsg($msg){
        print('<h4>'.$msg.'</h4>');
    }

    function mostrarSesion($sesiones){
        echo '<table><tr><td>Pelicula</td><td>Fecha</td><td>Butacas disponibles</td></tr>';
        foreach($sesiones as $s){
            if ($s['butacas_disponibles']){
                echo "<tr><td>".$s['pelicula'].'</td><td>'.$s['fecha'].'</td><td>'.$s['butacas_disponibles']."</td></tr>";
            }
        }
        echo '</table>';
    }

    function mostrAdmSesiones($sesiones){
        echo '<table><tr><td>Película</td><td>Fecha</td><td>Butacas disponibles</td><td>Acciones</td></tr>';
        foreach($sesiones as $s){
            echo "<tr><td>".$s['pelicula'].'</td><td>'.$s['fecha']."</td><td>".$s['butacas_disponibles']."</td><td>"."</td><td><a href='index.php?controllador=Controller\SesionController&accion=deleteAdm&id=".$s['id']."'>Quitar butacas disponibles  </a> <a href='index.php?controllador=Controller\SesionController&accion=modAdmSesion&id=".$s['id']."'>Modificar</a><a href='index.php?controllador=Controller\SesionController&accion=darAltaAdm&id=".$s['id']."'> Añadir butacas disponibles</a></td></tr>";
        }
        echo '</table>';
    }

    function prepForm(){
        print(
            "<fieldset>
                <legend>Registro sesiones</legend>
                <form method='POST' action='index.php?controllador=Controller\SesionController&accion=registro' >
                <label>ID</label>
                <input type='number' name='id'><br>
                <label>Película</label>
                <input name='pelicula'><br>
                <label>Fecha</label>
                <input type='date'name='fecha'><br>
                <label>Butacas disponibles</label>
                <input type='number' min='0' max='400' name='butacas_disponibles'><br>
                <input type='submit'>
                </form>
            </fieldset>"
        );
    }

    function modForm($data){
        print(
            "<fieldset>
                <legend>Modificación sesión</legend>
                <form method='POST' action='index.php?controllador=Controller\SesionController&accion=update' >
                <label>Película</label>
                <input name='pelicula' value=".$data['pelicula']."><br>
                <label>Fecha</label>
                <input type='date' name='fecha' value=".$data['fecha']."><br>
                <label>Butacas disponibles</label>
                <input type='number' min='0' max='400' name='butacas_disponibles' value=".$data['butacas_disponibles']."><br>
                <input type='hidden' name='id' value=".$_GET['id'].">
                <input type='submit'><input type='reset'>
                </form>
            </fieldset>"
        );
    }
};
?>