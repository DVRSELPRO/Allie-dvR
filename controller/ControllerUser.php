<?php

include_once './modelo/ModeloUser.php';
include_once './dao/DaoUser.php';
include_once './dao/DaoDireccion.php';
include_once './utilidades/EnviarCorreo.php';
include_once './utilidades/TmpsMails.php';
include_once './utilidades/Utils.php';
include_once './utilidades/UtilsMysql.php';
include_once './utilidades/GenerateDocsToPDF.php';
include_once './utilidades/varsGlobal.php';
include_once './dao/DaoFiles.php';
include_once './modelo/ModeloDireccion.php';
include_once './modelo/ModeloNivelEstudio.php';
include_once './dao/DaoNivelEstudio.php';
include_once './modelo/ModeloExperienciaLaboral.php';
include_once './dao/DaoExperienciaLaboral.php';

/**
 * Description of controllerUser
 *
 * @author Josglow
 */
class ControllerUser {

    private $daoUser = null;
    private $daoDir = null;
    private $email = null;
    private $utilsMysql = null;
    private $daoFiles = null;

    function __construct() {
        $this->daoUser = new dao\DaoUser\DaoUser();
        $this->daoDir = new \dao\DaoDireccion\DaoDireccion();
        $this->mail = new \utilidades\EnviarCorreo\EnviarCorreo();
        $this->utilsMysql = new \utilidades\UtilsMysql\UtilsMysql();
        $this->daoFiles = new dao\DaoFiles\DaoFiles();
    }

    public function getDireccionByIdUser($id) {
        return $this->daoDir->getDireccionByIdUser($id);
    }

    public function getDirByCP($cp) {
        $json = array();
        try {
            $json = $this->daoDir->getDirByCP($cp);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        header('Content-type: application/json; charset=utf-8');
        die(json_encode($json));
    }

    public function getCatEstados() {
        $json = array();
        try {
            $json = $this->daoDir->getCatEstados();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        header('Content-type: application/json; charset=utf-8');
        die(json_encode($json));
    }

    public function getCiudadByEstado($estado) {
        $json = array();
        try {
            $json = $this->daoDir->getCiudadByEstado($estado);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        header('Content-type: application/json; charset=utf-8');
        die(json_encode($json));
    }

    public function registroUser($post) {
        extract($post);
//        echo '<pre>';print_r($post);die();
        $json = array();
        $flag = TRUE;
        $cad = "";
        $estadoCivil = (isset($estadoCivil) && $estadoCivil != "" ? $estadoCivil : NULL);
        $calle = (isset($calle) && $calle != "" ? $calle : NULL);
        $numeroInterior = (isset($numeroInterior) && $numeroInterior != "" ? $numeroInterior : NULL);
        $numeroExterior = (isset($numeroExterior) && $numeroExterior != "" ? $numeroExterior : NULL);
        $telefonoFijo = (isset($telefonoFijo) && $telefonoFijo != "" ? $telefonoFijo : NULL);
        $nivelEstudio = (isset($nivelEstudio) && $nivelEstudio != "" ? $nivelEstudio : NULL);
        $dependienteCsEconomico = (isset($dependienteCsEconomico) && $dependienteCsEconomico != "" ? $dependienteCsEconomico : NULL);
        $experienciaLaboral_estatus = (isset($experienciaLaboral_estatus) && $experienciaLaboral_estatus != "" ? $experienciaLaboral_estatus : NULL);
        $experienciaLaboral_puesto = (isset($experienciaLaboral_puesto) && $experienciaLaboral_puesto != "" ? $experienciaLaboral_puesto : NULL);
        $lugarTrabajo = (isset($lugarTrabajo) && $lugarTrabajo != "" ? $lugarTrabajo : NULL);
        $empleado_lugarTrabajo_estado = (isset($empleado_lugarTrabajo_estado) && $empleado_lugarTrabajo_estado != "" ? $empleado_lugarTrabajo_estado : NULL);
        $empleado_lugarTrabajo_ciudad = (isset($empleado_lugarTrabajo_ciudad) && $empleado_lugarTrabajo_ciudad != "" ? $empleado_lugarTrabajo_ciudad : NULL);
        $nombreArchivo = (isset($nombreArchivo) && $nombreArchivo != "" ? $nombreArchivo : array());
        $dependientesEconomico = (isset($dependientesEconomico) && $dependientesEconomico != "" ? $dependientesEconomico : NULL);
        $cp = (isset($cp) && $cp != "" ? $cp : NULL);
        $colonia = (isset($colonia) && $colonia != "" ? $colonia : NULL);
        $ciudad = (isset($ciudad) && $ciudad != "" ? $ciudad : NULL);
        $nombreempleado = (isset($nombreempleado) && $nombreempleado != "" ? $nombreempleado : NULL);
        $apellidopaterno = (isset($apellidopaterno) && $apellidopaterno != "" ? $apellidopaterno : NULL);
        $apellidomaterno = (isset($apellidomaterno) && $apellidomaterno != "" ? $apellidomaterno : NULL);
        $rfc = (isset($rfc) && $rfc != "" ? $rfc : NULL);
        $curp = (isset($curp) && $curp != "" ? $curp : NULL);
        $nss = (isset($nss) && $nss != "" ? $nss : NULL);
        $tieneNSS = (isset($tieneNSS) && $tieneNSS != "" ? $tieneNSS : NULL);
        $telefonoCelular = (isset($telefonoCelular) && $telefonoCelular != "" ? $telefonoCelular : NULL);
        $fechaNacimiento_dia = (isset($fechaNacimiento_dia) && $fechaNacimiento_dia != "" ? $fechaNacimiento_dia : NULL);
        $fechaNacimiento_mes = (isset($fechaNacimiento_mes) && $fechaNacimiento_mes != "" ? (int) $fechaNacimiento_mes + 1 : NULL);
        $fechaNacimiento_year = (isset($fechaNacimiento_year) && $fechaNacimiento_year != "" ? $fechaNacimiento_year : NULL);
        $delegacion = (isset($delegacion) && $delegacion != "" ? $delegacion : NULL);
        //idHistorialArchivos guardados
        $idsHistorialArchivos = "";
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION["idHistorialArchivos"]) && count($_SESSION["idHistorialArchivos"]) > 0) {
            $idsHistorialArchivos = implode(", ", $_SESSION["idHistorialArchivos"]);
        }
        if (count($nombreArchivo) > 0 && $idsHistorialArchivos == "") {
            $cad .= "Debe subir los archivos (" . implode(", ", $nombreArchivo) . ") que ha seleccionado. <br/>";
            $flag = false;
        }
        if ($idsHistorialArchivos != "" && count($nombreArchivo) == 0) {
            $cad .= "¿Qué archivos ha subido?. <br/>";
            $flag = false;
        }
        if (strlen($delegacion) == "") {
            $cad .= "La delegación es inválida <br/>";
            $flag = false;
        }
        if (strlen($estado) == "") {
            $cad .= "El estado es inválido <br/>";
            $flag = false;
        }
        if (strlen($nombreempleado) <= 2) {
            $cad .= "El nombre es inválido <br/>";
            $flag = false;
        }
        if (strlen($apellidopaterno) <= 2) {
            $cad .= "El apellido paterno es inválido <br/>";
            $flag = false;
        }
        if (strlen($apellidomaterno) <= 2) {
            $cad .= "El apellido materno es inválido <br/>";
            $flag = false;
        }
        if ((int) $fechaNacimiento_dia <= 0) {
            $cad .= "Fecha de nacimiento inválido [dia] <br/>";
            $flag = false;
        }
        if ((int) $fechaNacimiento_mes <= 0) {
            $cad .= "Fecha de nacimiento inválido [mes] <br/>";
            $flag = false;
        }
        if ((int) $fechaNacimiento_year <= 0) {
            $cad .= "Fecha de nacimiento inválido [año] <br/>";
            $flag = false;
        }
        if ($tieneNSS == "Si") {
            if (strlen($nss) != 11) {
                $cad .= "El NSS es inválido <br/>";
                $flag = false;
            }
        } else {
            $nss = NULL;
        }
        if (strlen($curp) != 18) {
            $cad .= "El CURP es inválido <br/>";
            $flag = false;
        }
        if ($rfc == "" || strlen($rfc) < 12 || strlen($rfc) > 13) {
            $cad .= "El RFC es inválido [12 o 13 dígitos] <br/>";
            $flag = false;
        }
        if ($email == "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $cad .= "El correo electrónico es inválido <br/>";
            $flag = false;
        }
        $domain = explode("@", $email);
        if (isset($domain[1])) {
            if (!checkdnsrr($domain[1], "MX")) {
                $cad .= "El dominio del correo {$email} es inválido.<br/>";
                $flag = false;
            }
        } else {
            $cad .= "No se pudo obtener el dominio <br/>";
            $flag = false;
        }
        if ($telefonoCelular == "" || strlen($telefonoCelular) < 10) {
            $cad .= "El número de celular deben ser 10 dígitos <br/>";
            $flag = false;
        }
        $utils = new \utilidades\Utils\Utils();
        $password = $utils->randomPassword();
        if ($password == "" || strlen($password) <= 5) {
            $cad .= "La contraseña es inválida <br/>";
            $flag = false;
        }
//        if ($password != $password2) {$cad .= "La contraseña no coincide <br/>";$flag = false;}
        /*
         * RFC= GOVG851120EF5
         * CURP=GOVG851120MGRMLD06
         * NSS= 11048505074
         * fec: 20/11/1985: 10 digitos-> 19851120-> 851120
         * Obtener la fecha de nacimiento: YYmmdd-> debe ser igual al del rfc y curp
         */
        $fnyear = substr($fechaNacimiento_year, 2, 2);
        if ($rfc != "" && $curp != "" && $nss != "") {
            //10 primeros digitos
            $rfc10 = substr($rfc, 0, 10);
            $curp10 = substr($curp, 0, 10);
            if ($rfc10 !== $curp10) {
                $cad .= "El RFC {$rfc} no coincide con los 10 primeros digitos del CURP {$curp}.<br/>";
                $flag = false;
            }
            //fecha de nacimiento
            $rfcyear = substr($rfc, 4, 2);
            $curpyear = substr($curp, 4, 2);
            $nssyear = substr($nss, 4, 2);
            if ($rfcyear !== $curpyear || $rfcyear !== $nssyear || $rfcyear !== $fnyear) {
                $cad .= "No coincide el año de nacimiento en el RFC, CURP, NSS y fecha de nacimiento.<br/>";
                $flag = false;
            }
        }
        if ($rfc != "" && $curp) {
            //10 primeros digitos
            $rfc10 = substr($rfc, 0, 10);
            $curp10 = substr($curp, 0, 10);
            if ($rfc10 !== $curp10) {
                $cad .= "El RFC {$rfc} no coincide con los 10 primeros digitos del CURP {$curp}.<br/>";
                $flag = false;
            }
            //fecha de nacimiento
            $rfcyear = substr($rfc, 4, 2);
            $curpyear = substr($curp, 4, 2);
            if ($rfcyear !== $curpyear || $rfcyear !== $fnyear) {
                $cad .= "No coincide el año de nacimiento en el RFC, CURP y fecha de nacimiento.<br/>";
                $flag = false;
            }
            $mes = (int) $fechaNacimiento_mes;
            $dia = (int) $fechaNacimiento_dia;
            if (strlen($mes) == 1) {
                $mes = "0" . $mes;
            }
            if (strlen($dia) == 1) {
                $dia = "0" . $dia;
            }
            if (substr($rfc, 4, 6) !== substr($curp, 4, 6) || substr($fechaNacimiento_year, 2, 4) . $mes . $dia !== substr($curp, 4, 6)) {
                $cad .= "No coincide la fecha de nacimiento en el RFC y CURP.<br/>";
                $flag = false;
            }
        }

        $id_rol = 3; //registrado
        //existe rfc, nss y curp?
        if ($this->daoUser->existeUserByRFCCURPyNSS($rfc, $curp, $nss)) {
            $cad .= $nombreempleado . " ya se encuentra dado de alta en el sistema.";
            $flag = false;
        }
        if ($flag) {
            if (!$this->daoUser->existeUser($email)) {
                $user = new ModeloUser\ModeloUser();
                //            $user->setIduser($iduser);        
//                $user->setIdcliente($idcliente)
                $user->setNombreempleado($nombreempleado);
                $user->setApellidopaterno($apellidopaterno);
                $user->setApellidomaterno($apellidomaterno);
                $user->setEstatus(1);
                $user->setId_rol($id_rol);
                $user->setMail($email);
                $user->setPassword(md5($password));
                $user->setNss($nss);
                $user->setRfc($rfc);
                $user->setCurp($curp);
                $user->setPathPicPerfil(NULL);
                $user->setTipo_persona((strlen($rfc) == 12 ? "Moral" : (strlen($rfc) == 13 ? "Fisica" : "")));
//                $user->setRazon_social($razonsocial);
                $user->setCelular($telefonoCelular);
                $user->setFechaNacimiento($fechaNacimiento_year . "-" . $fechaNacimiento_mes . "-" . $fechaNacimiento_dia);
                $user->setEstadoCivil($estadoCivil);
                $user->setTelefonoFijo($telefonoFijo);
                $user->setDependientesEconomico($dependientesEconomico);
                $user->setLugarTrabajo($empleado_lugarTrabajo_ciudad . ", " . $empleado_lugarTrabajo_estado);
                $user->setTieneNSS($tieneNSS);
                $user->setFechaSolicitud(date("Y-m-d"));
                $w = (count($nombreArchivo) > 0 ? implode("|", $nombreArchivo) : "");
                $user->setDocsSeleccionados($w);
                $idEmpleado = $this->daoUser->saveUser($user);
                if ((int) $idEmpleado > 0) {
                    unset($_SESSION["idHistorialArchivos"]);
                    //Update idEmpleado en tabla de archivos
                    if ($idsHistorialArchivos != "") {
                        $this->daoFiles->setIdEmpleado($idEmpleado, $idsHistorialArchivos);
                    }
                    //Guardar direccion con el id de empleado                    
                    $mDir = new \modelo\ModeloUser\ModeloDireccion();
                    $mDir->setCalle($calle);
                    $mDir->setNumeroexterior($numeroExterior);
                    $mDir->setNumerointerior($numeroInterior);
                    $mDir->setCp($cp);
                    $mDir->setColonia($colonia);
                    $mDir->setDelegacion($delegacion);
                    $mDir->setCiudad($ciudad);
                    $mDir->setEstado($estado);
                    $mDir->setEstatus(1);
                    $mDir->setIdUser($idEmpleado);
                    $mDir->setTipodireccion("Fisica");
                    $mDir->setPais("México");
                    if ((int) $this->daoDir->existeDir($mDir) == 0) {
                        $this->daoDir->saveDir($mDir);
                    }
                    //Guardar nivel estudio por idempleado
                    $mNE = new ModeloNivelEstudio\ModeloNivelEstudio();
                    $mNE->setIdEmpleado($idEmpleado);
                    $mNE->setNivelEstudio($nivelEstudio);
                    $daoNE = new \DaoNivelEstudio\DaoNivelEstudio();
                    if ((int) $daoNE->getNivelEstudioByIDEmpleado($mNE) == 0) {
                        $daoNE->saveNivelEstudio($mNE);
                    }
                    //Guardar experiencia laboral por idempleado
                    $mEL = new \ModeloExperienciaLaboral\ModeloExperienciaLaboral();
                    $mEL->setIdEmpleado($idEmpleado);
                    $mEL->setPuesto($experienciaLaboral_puesto);
                    $mEL->setEstatus(($experienciaLaboral_estatus == "Si" ? 1 : 0));
                    $daoExLab = new DaoExperienciaLaboral\DaoExperienciaLaboral();
                    if ((int) $daoExLab->getExperienciaLaboralByIDEmpleado($idEmpleado) == 0) {
                        $daoExLab->saveExperienciaLaboral($mEL);
                    }
                    $tmp = new utilidades\TmpsMails\TmpsMails();
                    //start generar pdf
//                    $arrEmpleado = array();
//                    $arrEmpleado['nombreTrabajador'] = $nombreempleado." ".$apellidopaterno." ".$apellidomaterno;
//                    $arrEmpleado['estadoCivil'] = $estadoCivil;
//                    //Dir_Calle & " No. " & Dir_NumExt & " Int. " & Dir_NumInt &",  Col. " &Dir_Colonia& ", C.P. " & Dir_CP & ", " & ABRAHAM_Delegacion_Municipio & "  " & Dir_Municipio &", "& Dir_Ciudad &", "& Dir_Estado
//                    $arrEmpleado['direccionTrabajador'] = $calle." No. ".$numeroExterior." Int. ".$numeroInterior.", Col. ".$colonia.", C.P. ".$cp.", ".$delegacion.", ".$ciudad.", ".$estado;
//                    $arrEmpleado['rfcTrabajador'] = $rfc;
//                    $arrEmpleado['nss'] = (strlen($nss) > 0 ? $nss : "[*]");
//                    $arrEmpleado['curp'] = $curp;
//                    $arrEmpleado['emailTrabajador'] = $email;
//                    $arrEmpleado['ciudadTrabajador'] = $ciudad;
//                    $arrEmpleado['ContratoFecha_dia'] = date("d");
//                    $arrEmpleado['ContratoFecha_mes'] = $utils->convertMesIntTOString(date("m"));
//                    $arrEmpleado['ContratoFecha_year'] = date("Y");
//                    $html = $tmp->tmp_contratoIndividualTrabajoInd($arrEmpleado);
//                    $path_contrato = __DIR__."/../upload/contratos/contrato_".date("His_dmY").".pdf";                            
//                    generarPDF($html, $path_contrato);
//                    $path_aviso = __DIR__."/../upload/contratos/aviso-de-privacidad_".date("His_dmY").".pdf";
//                    $html = $tmp->tmp_avisoPrivacidad($arrEmpleado);
//                    generarPDF($html, $path_aviso);
                    //end generar pdf
                    //1.- NOTIFICAR POR CORREO AL USUARIO REGISTRADO
                    $body = "<p>Muchas gracias por registrarte, en breve nos pondremos en contacto contigo. </p>
                    <p>Para mayor información, ponemos a tu disposición el siguiente medio de contacto:</p>
                    <p>&mdash; <b>Correo:</b> reclutamiento@directoresygerentesonline.com<br/></p>";
                    $str = $tmp->tmp_directoresygerentesonline(array('nombre_destino' => mb_strtoupper($user->getNombreempleado(), "UTF-8") . " " . mb_strtoupper($user->getApellidopaterno(), "UTF-8"), 'body' => $body, 'atentamente_01' => ''));
                    $s = $this->mail->sendMail($user->getMail(), mb_strtoupper($user->getNombreempleado(), "UTF-8") . " " . mb_strtoupper($user->getApellidopaterno(), "UTF-8"), "reclutamiento@directoresygerentesonline.com", "Directores y Gerentes Online", $str, "Muchas gracias por registrarte");
                    if (isset($s["estatus"]) && $s["estatus"] == 1) {
                        $json["mensaje"] = "Se ha registrado correctamente, le llegará a su bandeja de correo una notificación de su registro. ";
                        $json["estatus"] = 1;
                        //guardar token
//                        $this->utilsMysql->saveToken(array("token"=>$token, "mail"=> $user->getMail()));
                        //gurdar log
                    } else {
                        $json["mensaje"] = "Ha ocurrido error al registrarse, favor de comunicarse con sistemas. " . $s["mensaje"];
                        $json["estatus"] = 0;
                    }

                    $nombre = mb_strtoupper($user->getNombreempleado(), "UTF-8") . " " . mb_strtoupper($user->getApellidopaterno(), "UTF-8");
                    //2.- NOTIFICAR POR CORREO A Anayeli anam@bsdservicios.mx
                    $body = "
                    <p><b>{$nombre}</b> se ha registrado en el sitio directoresygerentesonline.com, a continuación sus datos: </p>
                    <p>
                    &mdash; <b>Nombre:</b> {$nombre}<br/>"
                            . "&mdash; <b>Correo:</b> {$email}<br/>"
                            . "&mdash; <b>Celular:</b> {$telefonoCelular}<br/>"
                            . "&mdash; <b>CURP:</b> {$curp}<br/>"
                            . "&mdash; <b>RFC:</b> {$rfc}<br/>"
                            . "</p>"
//                            . "<p>Podrás consultar los datos en la siguiente URL: <a href='http://directoresygerentesonline.com/admin-dirge'>Dashboard</a></p>"
                            . "";
                    $str = $tmp->tmp_directoresygerentesonline(array('nombre_destino' => 'Estimados', 'body' => $body, 'atentamente_01' => ''));
                    if($email == "joseluis@bsdservicios.mx"){
                        $s = $this->mail->sendMail("joseluis@bsdservicios.mx", "Estimados (as)", "reclutamiento@directoresygerentesonline.com", "Directores y Gerentes Online", $str, "Registro nuevo", array());
                    }else{
                        $s = $this->mail->sendMail("anam@bsdservicios.mx", "Estimados (as)", "reclutamiento@directoresygerentesonline.com", "Directores y Gerentes Online", $str, "Registro nuevo", array("joseluis@bsdservicios.mx"=> "Jose Luis", "claudia@bsdservicios.mx"=> "Claudia"));   
                    }
//                    unlink($path_contrato);
//                    unlink($path_aviso);
                } else {
                    $json["mensaje"] = "Error al registrarse";
                    $json["estatus"] = 0;
                }
            } else {
                $json["estatus"] = 0;
                $json["mensaje"] = "Ya existe un registro con el correo: " . $email;
            }
        } else {
            $json["mensaje"] = $cad;
            $json["estatus"] = 0;
        }
//        echo "<pre>";print_r($json);
        header('Content-type: application/json; charset=utf-8');
//        echo '<pre>';print_r($json);
        die(json_encode($json, JSON_UNESCAPED_UNICODE));
//        return $json;
    }

    public function sendMailResetPwd($email) {
        $s = array();
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $s = $this->daoUser->sendMailResetPwd($email);
        } else {
            $s = array("estatus" => 0, "mensaje" => "Correo invalido");
        }
        return $s;
    }

    public function resetPassword($password, $password_confirm, $token) {
        $json = array();
        if (strlen($password) > 5 && $password == $password_confirm) {
            if ($token != "") {
                $email = $this->utilsMysql->getMailByToken($token);
                if ($email != "") {
                    if ($this->daoUser->resetPassword($email, md5($password))) {
                        $json["estatus"] = 1;
                        $json["mensaje"] = "Se ha cambiado su contraseña correctamente";
                        $json["mail"] = $email;
                    } else {
                        $json["estatus"] = 0;
                        $json["mensaje"] = "Error al cambiar su contraseña";
                    }
                } else {
                    $json["estatus"] = 0;
                    $json["mensaje"] = "Mail inválido";
                }
            } else {
                $json["estatus"] = 0;
                $json["mensaje"] = "El token es inválido";
            }
        } else {
            $json["estatus"] = 0;
            $json["mensaje"] = "La contraseña es inválida o no coinciden";
        }
        return $json;
    }

    public function validacion($action, $id) {
        $json = array();
        $flag = false;
        if ($action === "aprobar") {
            $flag = $this->daoUser->aprobar($id);
        } else if ($action === "rechazar") {
            $flag = $this->daoUser->rechazar($id);
        } else if ($action === "porValidar") {
            $flag = $this->daoUser->porValidar($id);
        } else if ($action === "eliminar") {
            $flag = $this->daoUser->eliminar($id);
        }
        if ($flag) {
            $json["estatus"] = 1;
            $json["mensaje"] = "Se ha guardado correctamente";
        } else {
            $json["estatus"] = 0;
            $json["mensaje"] = "Ha ocurrido un error mientras se actualizaba.";
        }
        header('Content-type: application/json; charset=utf-8');
//        echo '<pre>';print_r($json);
        die(json_encode($json));
    }

    public function getRoles() {
        return $this->utilsMysql->getRoles();
    }

}
