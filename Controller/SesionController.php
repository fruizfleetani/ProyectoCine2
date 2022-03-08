<?php
namespace Controller;
use Models\Sesion;
use View\SesionView;
use Controller\BaseController;

class SesionController extends BaseController{
    function __construct(){
        $this->model = new Sesion;
        $this->view = new SesionView;
    }

    function mostrarSesion(){
        $this->chckRol('cliente');
        $Sesion = $this->model->consulSesiones();
        $this->view->mostrarSesion($Sesion);
    }

    function mostrarAdmSesion(){
        $this->chckRol('administrador');
        $Sesion = $this->model->consulSesiones();
        $this->view->mostrAdmSesiones($Sesion);
    }

    function deleteAdm(){
        $this->chckRol('administrador');
        $this->model->deleteSesiones($_GET['id']);
        $this->mostrarAdmSesion();
    }

    function darAltaAdm(){
        $this->chckRol('administrador');
        $this->model->darAltaSesion($_GET['id']);
        $this->mostrarAdmSesion();
    }

    function createAdmSesion(){
        $this->chckRol('administrador');
        $this->view->prepForm();
    }

    function registro(){
        $this->chckRol('administrador');
        $data=[];
        if(isset($_POST['id']) && !empty($_POST['id'])){
            $data[':id'] = filter_var($_POST['id'],FILTER_VALIDATE_INT);
        }
        if(isset($_POST['pelicula']) && !empty($_POST['pelicula'])){
            $data[':pelicula'] = filter_var($_POST['pelicula'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        if(isset($_POST['fecha']) && !empty($_POST['fecha'])){
            $data[':fecha'] = filter_var($_POST['fecha'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        if(isset($_POST['butacas_disponibles']) && !empty($_POST['butacas_disponibles']) && filter_var($_POST['butacas_disponibles'], FILTER_VALIDATE_INT)){
            $data[':butacas_disponibles'] = filter_var($_POST['butacas_disponibles'],FILTER_SANITIZE_NUMBER_INT);
        }
        if(count($data) < 4){
            $this->view->displayError('registrando Sesion');
        }else{
            $this->model->insertSesion($data);
            $this->mostrarAdmSesion();
        }
    }
    
    function modAdmSesion(){
        $this->chckRol('administrador');
        $consul = $this->model->consulSesiones($_GET['id']);
        foreach($consul as $c){
            $resul = $c;
        }
        $this->view->modForm($resul);
    }

    function update(){
        $this->chckRol('administrador');
        $data=[];
        if(isset($_POST['pelicula']) && !empty($_POST['pelicula'])){
            $data[':pelicula'] = filter_var($_POST['pelicula'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        if(isset($_POST['fecha']) && !empty($_POST['fecha'])){
            $data[':fecha'] = filter_var($_POST['fecha'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        if(isset($_POST['butacas_disponibles']) && !empty($_POST['butacas_disponibles']) && filter_var($_POST['butacas_disponibles'], FILTER_VALIDATE_INT)){
            $data[':butacas_disponibles'] = filter_var($_POST['butacas_disponibles'],FILTER_SANITIZE_NUMBER_INT);
        }
        $id = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
        if(count($data) < 3){
            $this->view->displayError('Actualizando sesión');
        }else{
            $this->model->updateSesion($data,$id);
            $this->mostrarAdmSesion();
        }

    }
}
?>