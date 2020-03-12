<?php
namespace DaoIP;
include_once './conexiones/ConexionMysql.php';
use PDO;
class DaoIP {
    private $conn = null;
    private  $conMysql = null;    
    function __construct() {
        $this->conMysql = new \conexiones\ConexionMysql\ConexionMysql();
        $this->conn = $this->conMysql->conMysql();        
    }
    public function saveIP($ip){
        $id = 0;
        $sql = "INSERT INTO ippublica "
                . "("
                . "ip, "
                . "estatus "                
                . ") "
                . "values(?,?)";
        try {            
            if($ip != ""){
                $stmt = $this->conn->prepare($sql);                    
                $stmt->bindvalue(1, $ip, \PDO::PARAM_STR);
                $stmt->bindvalue(2, 1, \PDO::PARAM_INT);
                $stmt->execute();
                $id = $this->conn->lastInsertId();   
            }            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } catch (\PDOException $ex) {
            echo "Error al guardar saveIP: ".$sql."<br/>".$ex->getMessage();
        } finally {
            $this->conMysql->closeMysql();
        }
        return $id;
    }
    public function getTotalIP($ip){        
        $count = 0;
        $sql = "SELECT count(id) AS t FROM ippublica WHERE ip = ? and estatus = 1 ";
        try {
            
            $stmt = $this->conn->prepare($sql);                    
            $stmt->bindvalue(1, $ip, \PDO::PARAM_STR);            
            $stmt->execute();
            $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if(is_array($row) && count($row) > 0){
                foreach ($row as $key => $value) {
                    $count = $value["t"];
                    break;
                }
            }
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } catch (\PDOException $ex) {
            echo "Error al obtener si existe el IP: ".$sql."<br/>".$ex->getMessage();
        } finally {
            $this->conMysql->closeMysql();
        }
        return $count;
    }
    public function updateEstatuIP(){
        $flag = false;
        $id = $this->getIDIp();
        if($id > 0){
            $sql = "UPDATE ippublica set estatus = 0 where id = ? ";
            try {
                $stmt = $this->conn->prepare($sql);
                $stmt->bindvalue(1, $id, \PDO::PARAM_INT);
                $flag = $stmt->execute() ? TRUE : FALSE;
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            } catch (\PDOException $ex) {
                echo "Error updateEstatuIP: ".$sql."<br/>".$ex->getMessage();
            } finally {
                $this->conMysql->closeMysql();
            }   
        }        
        return $flag;
    }
    public function getIDIp(){        
        $id = 0;
        $sql = "SELECT id FROM ippublica WHERE estatus = 1 ";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if(is_array($row) && count($row) > 0){
                foreach ($row as $key => $value) {
                    $id = $value["id"];
                }
            }
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } catch (\PDOException $ex) {
            echo "Error getIDIp : ".$sql."<br/>".$ex->getMessage();
        } finally {
            $this->conMysql->closeMysql();
        }
        return $id;
    }
    
}
