<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
extract($_REQUEST);
include_once '../utilidades/EnviarCorreo.php';
include_once '../utilidades/TmpsMails.php';
//include_once '../utilidades/UtilsMysql.php';
include_once '../utilidades/varsGlobal.php';

$action = (isset($action) ? $action : "");
switch ($action) {
    case 'sendMail':
        enviarMail($_REQUEST);
        break;
    case 'notificarRH':
        notificarRH($_REQUEST);
        break;
    default:
        break;
}

function enviarMail($param) {
    extract($param);
    $nombre = mb_strtoupper($nombre, "UTF-8");
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && isset($email)) {
        $domain = explode("@", $email);
        if (isset($domain[1])) {
            if (checkdnsrr($domain[1], "MX")) {
                $mail = new \utilidades\EnviarCorreo\EnviarCorreo();
                $body = "<p>Muchas gracias por registrarte, en breve nos pondremos en contacto contigo. </p>
                    <p>Para mayor información, ponemos a tu disposición el siguiente medio de contacto:</p>
                    <p>&mdash; <b>Correo:</b> reclutamiento@directoresygerentesonline.com<br/></p>";
                $tmp = new utilidades\TmpsMails\TmpsMails();
                $str = $tmp->tmp_directoresygerentesonline(array('nombre_destino' => $nombre, 'body' => $body, 'atentamente_01' => ''));
                $s = $mail->sendMail($email, $nombre, "reclutamiento@directoresygerentesonline.com", "Directores y Gerentes Online ", $str, "Muchas gracias por registrarte");
                if (isset($s["estatus"]) && $s["estatus"] == 1) {
                    $json["mensaje"] = "Muchas gracias por registrarte: {$email}";
                    $json["estatus"] = 1;
                    notificarRH($param);
                    notificarEm($param);
                } else if (isset($s["estatus"])) {
                    $json["mensaje"] = "Ha ocurrido un error al enviar sus datos. " . $s["mensaje"];
                    $json["estatus"] = 0;
                } else {
                    $json["mensaje"] = "Error al enviar correo";
                    $json["estatus"] = 0;
                }
            } else {
                $json["mensaje"] = "El dominio de tu correo es inválido: <b>" . $email . "</b>";
                $json["estatus"] = 0;
            }
        } else {
            $json["mensaje"] = "No se pudo obtener el dominio del mail: <b>" . $email . "</b>";
            $json["estatus"] = 0;
        }
    } else {
        $json["mensaje"] = "El Correo Electrónico es inválido: <b>" . $email . "</b>";
        $json["estatus"] = 0;
    }
    header('Content-type: application/json; charset=utf-8');
//        echo '<pre>';print_r($json);die();
    die(json_encode($json));
}
function notificarRH($param) {
    extract($param);    
    $rh_nombre = "MARÍA DEL CARMEN LÓPEZ";
    $rh_email = "mariac.l@bsdservicios.mx";
//    $rh_email = "reclutamiento@directoresygerentesonline.com";
//    $rh_email = "roberto.g@bsdservicios.mx";
    $rh_email = "joseluisg@bsdservicios.mx";
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && isset($email)) {
        $domain = explode("@", $email);
        if (isset($domain[1])) {
            if (checkdnsrr($domain[1], "MX")) {
                $mail = new \utilidades\EnviarCorreo\EnviarCorreo();
                $body = "
                    <p><b>".mb_strtoupper($nombre, "UTF-8")."</b> se ha registrado en el sitio directoresygerentesonline.com, a continuación sus datos: </p>
                    <p>
                    &mdash; <b>Nombre:</b> ".mb_strtoupper($nombre, "UTF-8")."<br/>"
                    . "&mdash; <b>Correo:</b> {$email}<br/>"
                    . "&mdash; <b>Es un (a):</b> ". strtoupper($tipo)."<br/>"
                    . "</p>";
                $tmp = new utilidades\TmpsMails\TmpsMails();
                $str = $tmp->tmp_directoresygerentesonline(array('nombre_destino' => $rh_nombre, 'body' => $body, 'atentamente_01' => 'Directores y Gerentes Online'));
                $s = $mail->sendMail($rh_email, $rh_nombre, "reclutamiento@directoresygerentesonline.com", "Directores y Gerentes Online ", $str, "Registro nuevo");
                if (isset($s["estatus"]) && $s["estatus"] == 1) {
                    $json["mensaje"] = "Muchas gracias por registrarte";
                    $json["estatus"] = 1;
                } else if (isset($s["estatus"])) {
                    $json["mensaje"] = "Ha ocurrido un error al enviar sus datos. " . $s["mensaje"];
                    $json["estatus"] = 0;
                } else {
                    $json["mensaje"] = "Error al enviar correo";
                    $json["estatus"] = 0;
                }
            } else {
                $json["mensaje"] = "El dominio de tu correo es inválido: <b>" . $email . "</b>";
                $json["estatus"] = 0;
            }
        } else {
            $json["mensaje"] = "No se pudo obtener el dominio del mail: <b>" . $email . "</b>";
            $json["estatus"] = 0;
        }
    } else {
        $json["mensaje"] = "El Correo Electrónico es inválido: <b>" . $email . "</b>";
        $json["estatus"] = 0;
    }
//    header('Content-type: application/json; charset=utf-8');
//        echo '<pre>';print_r($json);die();
//    die(json_encode($json));
}
function notificarEm($param) {
    extract($param);    
    $rh_nombre = "EMILIO SALLEH";
//    $rh_email = "mariac.l@bsdservicios.mx";
//    $rh_email = "reclutamiento@directoresygerentesonline.com";
    $rh_email = "joseluis@bsdservicios.mx";
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && isset($email)) {
        $domain = explode("@", $email);
        if (isset($domain[1])) {
            if (checkdnsrr($domain[1], "MX")) {
                $mail = new \utilidades\EnviarCorreo\EnviarCorreo();
                $body = "
                    <p><b>".mb_strtoupper($nombre, "UTF-8")."</b> se ha registrado en el sitio directoresygerentesonline.com, a continuación sus datos: </p>
                    <p>
                    &mdash; <b>Nombre:</b> ".mb_strtoupper($nombre, "UTF-8")."<br/>"
                    . "&mdash; <b>Correo:</b> {$email}<br/>"
                    . "&mdash; <b>Es un (a):</b> ". strtoupper($tipo)."<br/>"
                    . "</p>";
                $tmp = new utilidades\TmpsMails\TmpsMails();
                $str = $tmp->tmp_directoresygerentesonline(array('nombre_destino' => $rh_nombre, 'body' => $body, 'atentamente_01' => 'Directores y Gerentes Online'));
                $s = $mail->sendMail($rh_email, $rh_nombre, "reclutamiento@directoresygerentesonline.com", "Directores y Gerentes Online ", $str, "Registro nuevo");
                if (isset($s["estatus"]) && $s["estatus"] == 1) {
                    $json["mensaje"] = "Se envio correo a RH";
                    $json["estatus"] = 1;
                } else if (isset($s["estatus"])) {
                    $json["mensaje"] = "Ha ocurrido un error al enviar sus datos. " . $s["mensaje"];
                    $json["estatus"] = 0;
                } else {
                    $json["mensaje"] = "Error al enviar correo";
                    $json["estatus"] = 0;
                }
            } else {
                $json["mensaje"] = "El dominio de tu correo es inválido: <b>" . $email . "</b>";
                $json["estatus"] = 0;
            }
        } else {
            $json["mensaje"] = "No se pudo obtener el dominio del mail: <b>" . $email . "</b>";
            $json["estatus"] = 0;
        }
    } else {
        $json["mensaje"] = "El Correo Electrónico es inválido: <b>" . $email . "</b>";
        $json["estatus"] = 0;
    }
//    header('Content-type: application/json; charset=utf-8');
//        echo '<pre>';print_r($json);die();
//    die(json_encode($json));
}

?>