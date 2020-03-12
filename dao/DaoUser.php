<?php

namespace dao\DaoUser;

include_once './conexiones/ConexionMysql.php';
include_once './modelo/ModeloUser.php';
include_once './utilidades/EnviarCorreo.php';
include_once './utilidades/TmpsMails.php';
include_once './utilidades/UtilsMysql.php';

use PDO;

/**
 * Description of DaoUser
 *
 * @author Josglow
 */
class DaoUser {

    private $conn = null;
    private $conMysql = null;
    private $mail = null;
    private $utilsMysql = null;

    function __construct() {
        $this->conMysql = new \conexiones\ConexionMysql\ConexionMysql();
        $this->conn = $this->conMysql->conMysql();
        $this->mail = new \utilidades\EnviarCorreo\EnviarCorreo();
        $this->utilsMysql = new \utilidades\UtilsMysql\UtilsMysql();
    }

    public function saveUser(\ModeloUser\ModeloUser $user) {
//        echo "<pre>";print_r($user);
        $id = 0;
        $sql = "INSERT INTO empleado ("
//                . "idcliente, "
                . "nombreempleado, "
                . "apellidopaterno, "
                . "apellidomaterno, "
                . "estatus, "
                . "id_rol, "
                . "email, "
                . "nss, "
                . "rfc, "
                . "curp, "
                . "pathPicPerfil, "
                . "tipo_persona, "
                . "telefonoCelular,"
                . "telefonoFijo,"
                . "fechaNacimiento,"
                . "estadoCivil, "
                . "dependientesEconomico, "
                . "lugarTrabajo, "
                . "tieneNSS,"
                . "fechaSolicitud, "
                . "docsSeleccionados, "
                . "password "
                . ") VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) "
                . "";
        try {
            $stmt = $this->conn->prepare($sql);
//                $stmt->bindvalue(1, $user->getIdcliente(), \PDO::PARAM_INT);
            $stmt->bindvalue(1, $user->getNombreempleado(), \PDO::PARAM_STR);
            $stmt->bindvalue(2, $user->getApellidopaterno(), \PDO::PARAM_STR);
            $stmt->bindvalue(3, $user->getApellidomaterno(), \PDO::PARAM_STR);
            $stmt->bindvalue(4, $user->getEstatus(), \PDO::PARAM_INT);
            $stmt->bindvalue(5, $user->getId_rol(), \PDO::PARAM_INT);
            $stmt->bindvalue(6, $user->getMail(), \PDO::PARAM_STR);
//                $stmt->bindvalue(8, $user->getPassword(), \PDO::PARAM_STR);
            $stmt->bindvalue((7), $user->getNss(), \PDO::PARAM_STR);
            $stmt->bindvalue((8), $user->getRfc(), \PDO::PARAM_STR);
            $stmt->bindvalue((9), $user->getCurp(), \PDO::PARAM_STR);
            $stmt->bindvalue((10), $user->getPathPicPerfil(), \PDO::PARAM_STR);
            $stmt->bindvalue((11), $user->getTipo_persona(), \PDO::PARAM_STR);
            $stmt->bindvalue((12), $user->getCelular(), \PDO::PARAM_STR);
            $stmt->bindvalue((13), $user->getTelefonoFijo(), \PDO::PARAM_STR);
            $stmt->bindvalue((14), $user->getFechaNacimiento(), \PDO::PARAM_STR);
            $stmt->bindvalue((15), $user->getEstadoCivil(), \PDO::PARAM_STR);
            $stmt->bindvalue((16), $user->getDependientesEconomico(), \PDO::PARAM_STR);
            $stmt->bindvalue((17), $user->getLugarTrabajo(), \PDO::PARAM_STR);
            $stmt->bindvalue((18), $user->getTieneNSS(), \PDO::PARAM_STR);
            $stmt->bindvalue((19), $user->getFechaSolicitud(), \PDO::PARAM_STR);
            $stmt->bindvalue((20), $user->getDocsSeleccionados(), \PDO::PARAM_STR);
            $stmt->bindvalue((21), $user->getPassword(), \PDO::PARAM_STR);
            $stmt->execute();
            $id = $this->conn->lastInsertId();
        } catch (\PDOException $ex) {
            echo "Error al guardar empleado: " . $sql . "<br/>" . $ex->getMessage();
        } finally {
            $this->conMysql->closeMysql();
            $stmt = NULL;
        }
        return $id;
    }

    public function existeUser($mail) {
        $flag = false;
        $sql = "SELECT count(idEmpleado) as t FROM empleado WHERE email = ? limit 1";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindvalue(1, $mail, \PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($row as $key => $value) {
                if ((int) $value["t"] > 0) {
                    $flag = true;
                }
            }
        } catch (\PDOException $ex) {
            echo "Error al validar si existe el usuario: " . $sql . " mail: " . $mail . "<br/>" . $ex->getMessage();
        } finally {
            $this->conMysql->closeMysql();
            $stmt = NULL;
            $row = NULL;
        }
        return $flag;
    }

    public function existeUserByRFCCURPyNSS($rfc, $curp, $nss, $idEmpleado = 0) {
        $flag = false;
        $sql = "SELECT count(idEmpleado) as t FROM empleado WHERE rfc = ? and curp = ? and nss = ? ";
        $sql .= ($idEmpleado > 0 ? "and idEmpleado != ?" : "");
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindvalue(1, $rfc, \PDO::PARAM_STR);
            $stmt->bindvalue(2, $curp, \PDO::PARAM_STR);
            $stmt->bindvalue(3, $nss, \PDO::PARAM_STR);
            if ($idEmpleado > 0) {
                $stmt->bindvalue(4, $idEmpleado, \PDO::PARAM_INT);
            }
            $stmt->execute();
            $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($row as $key => $value) {
                if ((int) $value["t"] > 0) {
                    $flag = true;
                }
            }
        } catch (\PDOException $ex) {
            echo "Error existeUserByRFCyCURP: " . $sql . "<br/>" . $ex->getMessage();
        } finally {
            $this->conMysql->closeMysql();
            $stmt = NULL;
            $row = NULL;
        }
        return $flag;
    }

    public function sendMailResetPwd($mail) {
        $json = array();
        if ($this->existeUser($mail)) {
            //notificar por correo
            //obtner template mail
            $token = bin2hex(openssl_random_pseudo_bytes(16)) . '' . date('dmYHis');
            $body = "<p>Con el <a href='http://" . HOST_URL . "/" . PROJECT_NAME . "/new-password.php?token={$token}'>siguiente enlace</a> podrá restablecer su contraseña.</p>";
            $tmp = new \utilidades\TmpsMails\TmpsMails();
            $str = $tmp->tmp_bsd_02(array('nombre_destino' => "", 'body' => $body, 'atentamente_01' => '', 'atentamente_02' => '', 'title_tmp' => 'Bienvenido'));
            $s = $this->mail->sendMail($mail, "", "joseluis@bienesraices.mx", "Dibax Systems", $str, "Cambiar contraseña");
            if (isset($s["estatus"]) && $s["estatus"] == 1) {
                $json["mensaje"] = "Se ha enviado un enlace a su correo electrónico. Favor de revisarlo.";
                $json["estatus"] = 1;
                $json["mail"] = $mail;
                //guardar token
                $this->utilsMysql->saveToken(array("token" => $token, "mail" => $mail));
                //gurdar log
            } else if (isset($s["estatus"])) {
                $json["mensaje"] = "Ha ocurrido error al intentar enviar un correo para cambiar su contraseña. " . $s["mensaje"];
                $json["estatus"] = 0;
            } else {
                $json["mensaje"] = "Error al enviar correo";
                $json["estatus"] = 0;
            }
        } else {
            $json["mensaje"] = "El correo {$mail} no está vinculado a nínguna cuenta. Favor de teclear un correo válido.";
            $json["estatus"] = 0;
        }
        return $json;
    }

    public function resetPassword($mail, $password) {
        $flag = false;
        $sql = "UPDATE users SET "
                . "password = ? "
                . "WHERE mail = ? and estatus = ?"
                . "";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindvalue(1, $password, \PDO::PARAM_STR);
            $stmt->bindvalue(2, $mail, \PDO::PARAM_STR);
            $stmt->bindvalue(3, 1, \PDO::PARAM_INT);
            $flag = $stmt->execute() ? true : false;
        } catch (\PDOException $ex) {
            echo "Error al actualizar user: " . $sql . "<br/>" . $ex->getMessage();
        } finally {
            $this->conMysql->closeMysql();
            $stmt = NULL;
        }
        return $flag;
    }

}
