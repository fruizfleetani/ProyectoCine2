<?php
namespace View;

class ReservasView{
    function __construct()
    {
        
    }
    function displayError($msg){
        print('<p>Error: '.$msg.'</p>');
    }

    function mostrarMsg($msg){
        print('<h4>'.$msg.'</h4>');
    }

    function mostrarReservas($reservas){
        echo '<table><tr><td>Película</td><td>Fecha</td><td>Acciones</td></tr>';
        foreach($reservas as $r){
            echo "<tr><td>".$r['pelicula']."</td><td>".$r['fecha']."</td><td><a href='index.php?controllador=Controller\ReservasController&accion=delete&id=".$r['id']."'>Borrar</a></td></tr>";
        }
        echo '</table>';
    }

    function mostrAdmReservas($reservas){
        echo '<table><tr><td>Cliente</td><td>Película</td><td>Fecha</td><td>Acciones</td></tr>';
        foreach($reservas as $r){
            echo "<tr><td>".$r['Cnombre'].' '.$r['Capellidos']."</td><td>".$r['pelicula']."</td><td>".$r['fecha']."</td><td><a href='index.php?controllador=Controller\ReservasController&accion=deleteAdm&id=".$r['id']."'>Borrar</a></td></tr>";
        }
        echo '</table>';
    }

    function showAdmForm($data){
        print(
            "<fieldset>
            <legend>Reserva</legend>
            <form method='post' action='index.php?controllador=Controller\ReservasController&accion=crearAdmReserva'>
            <label>Cliente</label>
            <select name='cliente'>");
        foreach($data['clientes'] as $c){
            if ($c['alta']){
                print(
                    '<option value="'.$c['id'].'">'.$c['nombre'].' '.$c['apellidos'].'</option>'
                );
            }
        }
        print(
            "</select>
            <br>
            <label>Sesion</label>
            <select name='sesion'>");
            foreach($data['sesiones'] as $s){
                if ($s['butacas_disponibles']){
                    print(
                        '<option value="'.$s['id'].'">'.$s['pelicula'].' '.$s['fecha'].', '.$s['butacas_disponibles'].'</option>'
                    );
                }
            }
        print(
        "</select><br>
        <input type='submit'>
        </form>
        </fieldset>"
        );
    }

    function showForm($data){
        print(
            "<fieldset>
            <legend>Reserva</legend>
            <form method='post' action='index.php?controllador=Controller\ReservasController&accion=crearReserva'>
            <label>Sesión</label>
            <select name='sesion'>");
            foreach($data['sesiones'] as $s){
                if ($s['butacas_disponibles']){
                    print(
                        '<option value="'.$s['id'].'">'.$s['pelicula'].' '.$s['fecha'].', '.$s['butacas_disponibles'].'</option>'
                    );
                }
            }
        print(
        "</select><br>
        <input type='submit'>
        </form>
        </fieldset>"
        );
    }
};
?>