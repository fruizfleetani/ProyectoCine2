<?php
namespace Controller;
use Models\Register;
use View\RegisterView;
use Controller\BaseController;

class RegisterController extends BaseController{
    public function __construct(){
        $this->model = new Register();
        $this->view = new RegisterView();
    }
    public function registro(){
        $this->chckRol('administrador');
        $data=[];
        $this->view->formRegistro();
        if(isset($_POST['nombre']) && !empty($_POST['nombre'])){
            $data[':nombre'] = filter_var($_POST['nombre'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        if(isset($_POST['apellidos']) && !empty($_POST['apellidos'])){
            $data[':apellidos'] = filter_var($_POST['apellidos'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        if(isset($_POST['mail']) && !empty($_POST['mail']) && filter_var($_POST['mail'],FILTER_VALIDATE_EMAIL)){
            $data[':mail'] = filter_var($_POST['mail'],FILTER_SANITIZE_EMAIL);
        }
        if(isset($_POST['cont']) && !empty($_POST['cont'])){
            $data[':password'] = password_hash($_POST['cont'],PASSWORD_DEFAULT,['cost' => 4]);
        }
        if(count($data) < 4){
            $this->view->displayError('Registrando cliente');
        }else if($this->model->freemail($data[':mail'])){
            $this->model->registro($data);
            $this->view->displayMsg('Usuario registrado correctamente');
        }else{
            $this->view->displayError('Error: mail ya registrado');
        }
    }
}
?>