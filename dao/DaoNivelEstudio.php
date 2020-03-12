<?php
namespace DaoNivelEstudio;
include_once './conexiones/ConexionMysql.php';
include_once './modelo/ModeloNivelEstudio.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DaoNivelEstudio
 *
 * @author bsd
 */
class DaoNivelEstudio {
    private $conn = null;
    private $conMysql = null;
    
    function __construct() {        
        $this->conMysql = new \conexiones\ConexionMysql\ConexionMysql();        
        $this->conn = $this->conMysql->conMysql();
    }
    public function saveNivelEstudio(\ModeloNivelEstudio\ModeloNivelEstudio $mNivelEstudio){        
        $flag = FALSE;
        if((int)$mNivelEstudio->getIdEmpleado() > 0){
            try {
                $sql = "INSERT INTO nivelEstudio (idEmpleado, nivelEstudio, carrera, yearTitulacion, areaEstudio, lugar, periodoTiempoInicio, periodoTiempoFin) values(?, ?, ?, ?, ?, ?, ?, ? )";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(1, $mNivelEstudio->getIdEmpleado(), \PDO::PARAM_INT);
                $stmt->bindValue(2, $mNivelEstudio->getNivelEstudio(), \PDO::PARAM_STR);
                $stmt->bindValue(3, $mNivelEstudio->getCarrera(), \PDO::PARAM_STR);
                $stmt->bindValue(4, $mNivelEstudio->getYearTitulacion(), \PDO::PARAM_INT);
                $stmt->bindValue(5, $mNivelEstudio->getAreaEstudio(), \PDO::PARAM_STR);
                $stmt->bindValue(6, $mNivelEstudio->getLugar(), \PDO::PARAM_STR);
                $stmt->bindValue(7, $mNivelEstudio->getPeriodoTiempoInicio(), \PDO::PARAM_STR);
                $stmt->bindValue(8, $mNivelEstudio->getPeriodoTiempoFin(), \PDO::PARAM_STR);
                $flag = $stmt->execute() ? TRUE : FALSE;

            } catch (\PDOException $ex) {
                echo "Error saveNivelEstudio ".$ex->getMessage();
            } finally {
                $this->conMysql->closeMysql();
                $stmt = null;
            }   
        }
    return $flag;
    }
    public function getNivelEstudioByIDEmpleado(\ModeloNivelEstudio\ModeloNivelEstudio $mNivelEstudio) {
        $iddireccion = 0;        
        $sql = "SELECT idNivelEstudio as id FROM nivelEstudio WHERE idEmpleado = ? ";
        try {                        
            $stmt = $this->conn->prepare( $sql );            
            $stmt->bindValue(1, $mNivelEstudio->getIdEmpleado(), \PDO::PARAM_INT);
            $stmt->execute();            
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if(count($rows) > 0){
                foreach ($rows as $key => $value) {
                    $iddireccion = ((int)$value["id"] > 0 ? $value["id"] : 0);
                }
            }
        } catch (\PDOException $ex) {
            echo "Error getNivelEstudioByIDEmpleado: ".$sql."<br/>".$ex->getMessage();
        } finally {
            $this->conMysql->closeMysql();
            $stmt = NULL;
            $rows = NULL;
        }
        return $iddireccion;
    }
    
}
