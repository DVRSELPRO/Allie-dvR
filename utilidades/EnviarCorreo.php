<?php
namespace utilidades\EnviarCorreo;
require_once __DIR__ . '/../PHPMailer-6.0.5/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer-6.0.5/src/SMTP.php';
require_once __DIR__ . '/../PHPMailer-6.0.5/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
/**
 * Description of ModeloEnviarCorreo
 *
 * @author Josglow
 */
//$x = new EnviarCorreo();
//$c = $x->sendMail("joseluis@bsdservicios.mx", "jl", "joseluis@bsdservicios.mx", "xxx", "xxx", "xxx");
//echo '<pre>';print_r($c);
class EnviarCorreo {

    //public function sendMailx($email, $from, $mensaje, $asunto)
    public function sendMail($to, $to_name, $from, $from_name, $body, $asunto, $arrAddAddress = array(), $arrAdjuntos = array()) {
        $json = array();
        $mail = new PHPMailer(true);// Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = CONFIG_MAIL_SMTPDEBUG;// Enable verbose debug output
            $mail->isSMTP();// Set mailer to use SMTP
            $mail->Host = CONFIG_MAIL_HOST;// Specify main and backup SMTP servers
            $mail->SMTPAuth = true;// Enable SMTP authentication
            $mail->Username = CONFIG_MAIL_USERNAME;// SMTP username
            $mail->Password = CONFIG_MAIL_PASSWORD;// SMTP password
            $mail->SMTPSecure = CONFIG_MAIL_SMTPSECURE;// Enable TLS encryption, `ssl` also accepted
            $mail->Port = CONFIG_MAIL_PORT;// TCP port to connect to
            $mail->CharSet = 'UTF-8';
            $mail->isHTML(true);
            //Recipients
            $mail->setFrom($from, $from_name);
            $mail->addAddress($to, $to_name);// Add a recipient
            if(is_array($arrAddAddress) && count($arrAddAddress) > 0){
                foreach ($arrAddAddress as $keyMail => $nombre) {                    
                    $mail->addAddress($keyMail, $nombre);// Add a recipient                    
                }
            }
//            $mail->addReplyTo('info@example.com', 'Information');
//            $mail->addCC('cc@example.com');
//            $mail->addBCC('bcc@example.com');

            //Attachments
            if(is_array($arrAdjuntos) && count($arrAdjuntos) > 0){
                foreach ($arrAdjuntos as $pathFile) {
                    $mail->addAttachment($pathFile);// Add attachments
                    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');//Optional name
                }
            }
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $asunto;
            $mail->Body = $body;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            if($mail->send()){
                $json['estatus'] = 1;
                $json['mensaje'] = $mail->ErrorInfo . ' ' . $mail->Encoding;
            }else{
                $json['estatus'] = 0;
                $json['mensaje'] = $mail->ErrorInfo . ' ' . $mail->Encoding;
            }
        } catch (Exception $e) {
            $json['estatus'] = 0;
            $json['mensaje'] = 'No se pudo enviar el correo electrónico. Mensaje del error: '. $mail->ErrorInfo;
        }
        return $json;
    }    
}
