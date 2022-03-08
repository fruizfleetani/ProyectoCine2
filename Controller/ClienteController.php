<?php
namespace Controller;
use Models\Cliente;
use View\ClienteView;
use Controller\BaseController;

class ClienteController extends BaseController{
    function __construct(){
        $this->model = new Cliente;
        $this->view = new ClienteView;
    }

    function mostrarAdmCliente(){
        $this->chckRol('administrador');
        $cliente = $this->model->consulcliente();
        $this->view->mostrAdmclientes($cliente);
    }

    function deleteAdm(){
        $this->chckRol('administrador');
        $this->model->deleteCliente($_GET['id']);
        $this->mostrarAdmcliente();
    }

    function darAltaAdm(){
        $this->chckRol('administrador');
        $this->model->darAltaclientes($_GET['id']);
        $this->mostrarAdmcliente();
    }
}
?>