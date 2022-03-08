<?php
namespace Controller;
use Models\Login;
use View\LoginView;

class LoginController{
    function __construct(){
        $this->model = new Login;
        $this->view = new LoginView;
    }
    function login(){
        $mail ='';
        if(isset($_POST['mail']) && !empty($_POST['mail']) && filter_var($_POST['mail'],FILTER_VALIDATE_EMAIL)){
            $mail = filter_var($_POST['mail'],FILTER_SANITIZE_EMAIL);
            if($this->model->checkMail($mail,'clientes')){
                $consul = $this->model->fetchUser($mail,'clientes');
                foreach($consul as $c){
                    $user = $c;
                    $type = 'cliente';
                }
            }else if($this->model->checkMail($mail,'admin')){
                $consul = $this->model->fetchUser($mail,'admin');
                foreach($consul as $c){
                    $user = $c;
                    $type = 'administrador';
                }
            }else{
                $this->view->displayError('Usuario no encontrado');
            }
            if(isset($user)){
                if (password_verify($_POST['cont'],$user['password'])){
                    $_SESSION['userdata']=$user;
                    $_SESSION['usertype']=$type;
                    header('Location:index.php');
                }else{
                    $this->view->displayError('Contraseña incorrecta');
                }
            }
        }else{
            $this->view->displayError('Login no reconocido');
        }
    }

    function logout(){
        if (isset($_SESSION['userdata']) || isset($_SESSION['usertype'])){
            unset($_SESSION['userdata']);
            unset($_SESSION['usertype']);
            header('Location:index.php');
        }else{
            $this->view->displayError('Error al salir de sesion');
        }
    }

}
?>