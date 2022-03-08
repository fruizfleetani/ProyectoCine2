<?php
namespace Controller;
use Models\Reservas;
use View\ReservasView;
use Controller\BaseController;

use Lib\DataBase;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PDO;

require 'vendor/autoload.php';

class ReservasController extends BaseController{
    function __construct(){
        $this->model = new Reservas;
        $this->view = new ReservasView;
    }
    
    function mostrarReservas(){
        $this->chckRol('cliente');
        $reservas = $this->model->consulReservas($_SESSION['userdata']['id']);
        $this->view->mostrarReservas($reservas);
    }

    function mostrarAdmReservas(){
        $this->chckRol('administrador');
        $reservas = $this->model->consulReservas();
        $this->view->mostrAdmReservas($reservas);
    }

    function delete(){
        $this->chckRol('cliente');
        $this->model->deleteReserva($_GET['id']);
        $this->mostrarReservas();
    }

    function deleteAdm(){
        $this->chckRol('administrador');
        $this->model->deleteReserva($_GET['id']);
        $this->mostrarAdmReservas();
    }

    function prepAdmForm(){
        $this->chckRol('administrador');
        $data = $this->model->Consuldet();
        $this->view->showAdmForm($data);
    }

    function prepForm(){
        $this->chckRol('cliente');
        $data = $this->model->Consuldet();
        $this->view->showForm($data);
    }

    function crearAdmReserva(){
        $this->chckRol('administrador');
        $data=[];
        if(isset($_POST['cliente']) && !empty($_POST['cliente'] && filter_var($_POST['cliente'],FILTER_VALIDATE_INT))){
            $data[':cliente'] = filter_var($_POST['cliente'],FILTER_SANITIZE_NUMBER_INT);
        }if(isset($_POST['sesion']) && !empty($_POST['sesion'] && filter_var($_POST['sesion'],FILTER_VALIDATE_INT))){
            $data[':sesion'] = filter_var($_POST['sesion'],FILTER_SANITIZE_NUMBER_INT);
        }if(count($data) < 2){
            $this->view->displayError('Registrando reserva');
        }else{
            $this->model->insertReservas($data);
            $this->mostrarAdmReservas();
        }


    }

    function crearReserva(){
        $this->chckRol('cliente');
        $data=[];
        if(isset($_POST['sesion']) && !empty($_POST['sesion'] && filter_var($_POST['sesion'],FILTER_VALIDATE_INT))){
            $data[':sesion'] = filter_var($_POST['sesion'],FILTER_SANITIZE_NUMBER_INT);
        }if(count($data) < 1){
            $this->view->displayError('Registrando sesion');
        }else{
            $data[':cliente']=$_SESSION['userdata']['id'];
            $this->model->insertReservas($data);
            $this->enviarMail($_SESSION['userdata'], $data);
            $this->mostrarReservas();
        }
    }

    function enviarMail($usuario, $datos){
        $mail = new PHPMailer();
        $mail-> isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.office365.com';                 
        $mail->Port = 587;
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->SMTPSecure = 'STARTTLS';            //Enable implicit TLS encryption
        $mail->Username   = 'cineSteamulation@hotmail.com';                     //SMTP username
        $mail->Password   = 'micine1234';                               //SMTP password
        $mail->setFrom('cineSteamulation@hotmail.com');
        $mail->addAddress($usuario['correo']);     //Add a recipient
        $mail->Subject = 'Confirmación de su reserva en el cine Steamulation';
        $mensaje = 
        "Estimado/a,  ".$usuario['nombre']." ".$usuario['apellidos'].", usted ha realizado una reserva en el cine Steamulation. <br>
        Los datos de la reserva son: <br>
        <table style='border 1px solid black'>
        <tr>
            <th>Cliente</th>
            <th>Sesión</th>
        </tr>
        <tr>
            <td>".$usuario['nombre']." ".$usuario['apellidos']."</td>
            <td>".$datos[':sesion']."</td>
        </tr>
        </table><br>";
        $mail->Body = $mensaje;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        if (!$mail->send()){
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            die();
        } else {
            echo 'Se le ha enviado un correo con los datos de la cita.';
        }
        
    }
    
    
}
?>
