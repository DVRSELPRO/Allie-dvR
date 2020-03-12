<?php
namespace dao\DaoFiles;
include_once './conexiones/ConexionMysql.php';
include_once './modelo/ModeloUser.php';
include_once './utilidades/EnviarCorreo.php';
include_once './utilidades/TmpsMails.php';
include_once './utilidades/UtilsMysql.php';
use PDO;
/**
 * Description of DaoFiles
 *
 * @author Josglow
 */
class DaoFiles {
    private $conn = null;
    private  $conMysql = null;
    private  $mail = null;
    private $utils = null;
    function __construct() {
        $this->conMysql = new \conexiones\ConexionMysql\ConexionMysql();
        $this->conn = $this->conMysql->conMysql();
        $this->mail = new \utilidades\EnviarCorreo\EnviarCorreo();
        $this->utils = new \utilidades\UtilsMysql\UtilsMysql();
    }    
    public function saveFiles($param) {
        extract($param);
//        echo "<pre>";print_r($param);
        $id = 0;
        $sql = "INSERT INTO historialArchivos ("
                . "idEmpleado, "
                . "nombreArchivo, "
                . "url, "
                . "extension, "
                . "tipoArchivo, "
                . "estatus, "
                . "token"
                . ") VALUES(?, ?, ?, ?, ?, ?, ?) "
                    . "";
        try {            
            $stmt = $this->conn->prepare($sql);                    
//                $stmt->bindvalue(1, $user->getIdcliente(), \PDO::PARAM_INT);
                $stmt->bindvalue(1, -1, \PDO::PARAM_INT);
                $stmt->bindvalue(2, $nombreArchivo, \PDO::PARAM_STR);
                $stmt->bindvalue(3, $url, \PDO::PARAM_STR);
                $stmt->bindvalue(4, $extension, \PDO::PARAM_STR);
                $stmt->bindvalue(5, $tipoArchivo, \PDO::PARAM_STR);
                $stmt->bindvalue(6, $estatus, \PDO::PARAM_INT);
                $stmt->bindvalue(7, $token, \PDO::PARAM_STR);
                $stmt->execute();
                $id = $this->conn->lastInsertId();
        } catch (\PDOException $ex) {
            echo "Error al guardar saveFiles: ".$sql."<br/>".$ex->getMessage();
        } finally {
            $this->conMysql->closeMysql();
            $stmt = NULL;
        }
        return $id;
    }    
    public function existeFile($token) {
//        extract($param);
        $flag = false;
        $sql = "SELECT count(idHistorialArchivos) as t FROM historialArchivos WHERE token = ? limit 1";
        try {            
            $stmt = $this->conn->prepare($sql);                    
                $stmt->bindvalue(1, $token, \PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                foreach ($row as $key => $value) {
                    if((int)$value["t"] > 0){
                        $flag = true;
                    }
                }
        } catch (\PDOException $ex) {
            echo "Error existeFile: ".$sql." token: ".$token."<br/>".$ex->getMessage();
        } finally {
            $this->conMysql->closeMysql();
        }
        return $flag;
    }
    public function deleteUploadFilesByID($idFile) {
//        extract($param);
        $flag = false;
        $sql = "DELETE FROM historialArchivos WHERE idHistorialArchivos = ? ";
        try {            
            $stmt = $this->conn->prepare($sql);                    
                $stmt->bindvalue(1, $idFile, \PDO::PARAM_INT);
                $flag = $stmt->execute() ? TRUE : FALSE;
        } catch (\PDOException $ex) {
            echo "Error deleteUploadFilesByID: ".$sql." idFile: ".$idFile."<br/>".$ex->getMessage();
        } finally {
            $this->conMysql->closeMysql();
        }
        return $flag;
    }
    public function getURLByID($id){
        $x = "";
        $sql = "SELECT url FROM historialArchivos WHERE idHistorialArchivos = ? limit 1";
        try {            
            $stmt = $this->conn->prepare($sql);                    
                $stmt->bindvalue(1, $id, \PDO::PARAM_INT);
                $stmt->execute();
                $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                foreach ($row as $key => $value) {
                    if($value["url"]  != ""){
                        $x = $value["url"];
                    }
                }
        } catch (\PDOException $ex) {
            echo "Error getURLByID: ".$sql." id: ".$id."<br/>".$ex->getMessage();
        } finally {
            $this->conMysql->closeMysql();
        }
        return $x;
    }
    public function deleteFileServer($path){
        $flag = FALSE;
        if (file_exists($path)) {
            if(unlink($path)){
               $flag = true; 
            }
        }
        
    }
    public function deleteFileSiNo($id) {
//        extract($param);
        $flag = false;
        $sql = "SELECT count(idHistorialArchivos) as t FROM historialArchivos WHERE idHistorialArchivos = ? and idEmpleado = ? and estatus = ?";
        try {            
            $stmt = $this->conn->prepare($sql);                    
                $stmt->bindvalue(1, $id, \PDO::PARAM_INT);
                $stmt->bindvalue(2, -1, \PDO::PARAM_INT);
                $stmt->bindvalue(3, 2, \PDO::PARAM_INT);
                $stmt->execute();
                $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                foreach ($row as $key => $value) {
                    if((int)$value["t"] > 0){
                        $flag = true;
                    }
                }
        } catch (\PDOException $ex) {
            echo "Error deleteFileSiNo: ".$sql." id: ".$id."<br/>".$ex->getMessage();
        } finally {
            $this->conMysql->closeMysql();
        }
        return $flag;
    }
    public function setIdEmpleado($idEmpleado, $ids) {
//        extract($param);
        $flag = false;
        $sql = "UPDATE historialArchivos SET idEmpleado = ? WHERE idHistorialArchivos in(".$ids.") AND idEmpleado = ? AND estatus = ? ";
        try {            
            $stmt = $this->conn->prepare($sql);                    
                $stmt->bindvalue(1, $idEmpleado, \PDO::PARAM_INT);
                $stmt->bindvalue(2, -1, \PDO::PARAM_INT);
                $stmt->bindvalue(3, 2, \PDO::PARAM_INT);
                $flag = $stmt->execute() ? TRUE : FALSE;
        } catch (\PDOException $ex) {
            echo "Error setIdEmpleado: ".$sql." ids: ".$ids."<br/>".$ex->getMessage();
        } finally {
            $this->conMysql->closeMysql();
        }
        return $flag;
    }
}
