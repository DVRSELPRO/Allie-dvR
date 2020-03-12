<?php
namespace DaoExperienciaLaboral;
include_once './modelo/ModeloExperienciaLaboral.php';
class DaoExperienciaLaboral {
    private $conn = null;
    private $connMysql = null;
    
    function __construct() {
        $this->connMysql = new \conexiones\ConexionMysql\ConexionMysql();
        $this->conn = $this->connMysql->conMysql();
    }
    
    function saveExperienciaLaboral(\ModeloExperienciaLaboral\ModeloExperienciaLaboral $mEL){
        $flag = FALSE;
        if((int)$mEL->getIdEmpleado() > 0){
            try {
                $sql = "INSERT INTO experienciaLaboral "
                        . "(idEmpleado, empresa, puesto, directorGeneral, facturacionAnual, telefono, extension, paginaWeb, periodoTiempoInicio, periodoTiempoFin, descripcion, lugar, estatus, reportasA, reportanMismoNivel, teReportan) "
                        . "values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(1, $mEL->getIdEmpleado(), \PDO::PARAM_INT);
                $stmt->bindValue(2, $mEL->getEmpresa(), \PDO::PARAM_STR);
                $stmt->bindValue(3, $mEL->getPuesto(), \PDO::PARAM_STR);
                $stmt->bindValue(4, $mEL->getDirectorGeneral(), \PDO::PARAM_STR);
                $stmt->bindValue(5, $mEL->getFacturacionAnual(), \PDO::PARAM_INT);
                $stmt->bindValue(6, $mEL->getTelefono(), \PDO::PARAM_STR);
                $stmt->bindValue(7, $mEL->getExtension(), \PDO::PARAM_STR);
                $stmt->bindValue(8, $mEL->getPaginaWeb(), \PDO::PARAM_STR);
                $stmt->bindValue(9, $mEL->getPeriodoTiempoInicio(), \PDO::PARAM_STR);
                $stmt->bindValue(10, $mEL->getPeriodoTiempoFin(), \PDO::PARAM_STR);
                $stmt->bindValue(11, $mEL->getDescripcion(), \PDO::PARAM_STR);
                $stmt->bindValue(12, $mEL->getLugar(), \PDO::PARAM_STR);
                $stmt->bindValue(13, $mEL->getEstatus(), \PDO::PARAM_INT);
                $stmt->bindValue(14, $mEL->getReportasA(), \PDO::PARAM_STR);
                $stmt->bindValue(15, $mEL->getReportanMismoNivel(), \PDO::PARAM_STR);
                $stmt->bindValue(16, $mEL->getTeReportan(), \PDO::PARAM_STR);
                $flag = $stmt->execute() ? TRUE : FALSE;
            } catch (\PDOException $ex) {
                echo "Error saveExperienciaLaboral ".$ex->getMessage();
            } finally {
                $this->connMysql->closeMysql();
                $stmt = NULL;
            }
        }
        return $flag;
    }
    function getExperienciaLaboralByIDEmpleado($idEmpleado) {
        $id = 0;
        if ((int) $idEmpleado > 0) {
            try {
                $sql = "SELECT idExperiencia as id FROM experienciaLaboral WHERE idEmpleado = ? AND estatus = 1";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(1, $idEmpleado, \PDO::PARAM_INT);
                $stmt->execute();
                $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                foreach ($rows as $key => $value) {
                    if ((int) $value["id"] > 0) {
                        $id = $value["id"];
                    }   
                }                
            } catch (\PDOException $exc) {
                echo "error getExperienciaLaboralByID " . $exc->getTraceAsString();
            } finally {
                $this->connMysql->closeMysql();
                $stmt = null;
                $rows = NULL;
            }
        }
        return $id;
    }

}
