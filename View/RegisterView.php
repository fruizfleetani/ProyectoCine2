<?php 
namespace View;

class RegisterView{
    function __construct()
    {
        
    }

    function formRegistro(){
        print(
            "<fieldset>
                <legend>Registro cliente</legend>
            <form method='post' action='index.php?controllador=Controller\RegisterController&accion=registro'>
                <label>Nombre</label>
                <input name='nombre'><br>
                <label>Apellidos</label>
                <input name='apellidos'><br>
                <label>email</label>
                <input type='email' name='mail'><br>
                <label>contraseña</label>
                <input type='password' name='cont'><br>
                <input type='submit'>
            </form>
            </fieldset>"
        );   
     }
     
    function displayError($msg){
        print($msg.'</p>');
    }
    function displayMsg($msg){
        print($msg.'</h4>');
    }
}
?>
