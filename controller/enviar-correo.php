<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// require '../integracion/PHPMailer/Exception.php';
// require '../integracion/PHPMailer/PHPMailer.php';
// require '../integracion/PHPMailer/SMTP.php';

require_once '../vendor/autoload.php';
require_once "../model/Proyecto.php";

function generate_string($input, $strength = 16)
{
    $input_length = strlen($input);
    $random_string = '';
    for ($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }

    return $random_string;
}
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

$mail = new PHPMailer(true);
$proyectoModel = new pry_proyecto();

$cliente = isset($_POST["cliente"]) ? $_POST["cliente"] : "";
$rutaLocal = "http://localhost/php-projects/proyecto/trello/view/login?invitacion=";
$id_traslado = isset($_POST["id_traslado"]) ? $_POST["id_traslado"] : "";
$texto_manual = isset($_POST["texto_manual"]) ? $_POST["texto_manual"] : "";

// AGREGAR INVITACION
$usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : "";
$idProyectoInvitacion = isset($_POST["idProyecto-invitacion"]) ? $_POST["idProyecto-invitacion"] : "";
$usuarioDestinatario = isset($_POST["email-destino-invitacion"]) ? $_POST["email-destino-invitacion"] : "";

try {
    switch ($_GET["op"]) {
        case 'enviarMail':
            $codigoInvitacion = generate_string($permitted_chars, 10);
            $url = $rutaLocal . "" . $codigoInvitacion;

            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'mail.supremecluster.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'noreply@posperu.com';                     //SMTP username
            $mail->Password   = 'dvOT4oX38$';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom("noreply@posperu.com", 'INVITACIONES');
            $mail->addAddress($usuarioDestinatario, 'INVITADO');     //Add a recipient
            $mail->addBCC('scimic.developer@gmail.com');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'POSTPERU: Invitacion a proyecto # ' . $idProyectoInvitacion;
            $mail->Body    = '<h1><a href="' . $url  . '">Aceptar invitación</a></h1><small><a href="posperu.com">posperu.com</a></small>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            $responseInvitacion = $proyectoModel->agregarInvitacion(
                $url,
                "inactivo",
                $idProyectoInvitacion,
                $usuario,
                $usuarioDestinatario,
                $codigoInvitacion
            );
            echo $responseInvitacion;
            //     echo "$idProyectoInvitacion,
            // $usuario,
            // $usuarioDestinatario";
            break;
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}