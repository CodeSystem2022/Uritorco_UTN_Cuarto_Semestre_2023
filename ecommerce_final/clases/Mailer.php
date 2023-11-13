<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    function enviarEmail($email, $asunto, $cuerpo)
    {
        require_once __DIR__ . '/../config/config.php';
        require_once  __DIR__ . '/../phpmailer/src/PHPMailer.php';
        require_once  __DIR__ . '/../phpmailer/src/SMTP.php';
        require_once  __DIR__ . '/../phpmailer/src/Exception.php';

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;              //Enable verbose debug output
            $mail->isSMTP();
            $mail->Host       = MAIL_HOST;                   //Configure el servidor SMTP para enviar
            $mail->SMTPAuth   = true;                        // Habilita la autenticación SMTP
            $mail->Username   = MAIL_USER;                   //Usuario SMTP
            $mail->Password   = MAIL_PASS;                   //Contraseña SMTP                             
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Habilitar el cifrado TLS
            $mail->Port       = MAIL_PORT;                   //Puerto TCP al que conectarse, si usa 587 agregar `SMTPSecure = PHPMailer :: ENCRYPTION_STARTTLS`

            //Correo emisor y nombre
            $mail->setFrom(MAIL_USER, 'Tienda CDP');
            //Correo receptor y nombre
            $mail->addAddress($email);

            //Contenido
            $mail->isHTML(true);   //Establecer el formato de correo electrónico en HTML
            $mail->Subject = $asunto; //Titulo del correo

            //Cuerpo del correo
            $mail->Body = mb_convert_encoding($cuerpo, 'ISO-8859-1', 'UTF-8');

            $mail->setLanguage('es', __DIR__ . '/../phpmailer/src/language/phpmailer.lang-es.php');

            //Enviar correo
            if ($mail->send()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "No se pudo enviar el mensaje. Error de envío: {$mail->ErrorInfo}";
            return false;
        }
    }
}
