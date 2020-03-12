<?php

namespace dao\DaoDireccion;
include_once './conexiones/ConexionMysql.php';
include_once './modelo/ModeloDireccion.php';
use PDO;
/**
 * Description of DaoDireccion
 *
 * @author Josglow
 */
class DaoDireccion {
    private $conn = null;
    private  $conMysql = null;
    function __construct() {
        $this->conMysql = new \conexiones\ConexionMysql\ConexionMysql();
        $this->conn = $this->conMysql->conMysql();
    }
    public function getDirByCP($cp) {
        $arrjson = array();
        $str = "";
        $arrjson['estatus'] = 0;
        try {
            $sql = "SELECT "
                    . "idcp, "
                    . "d_codigo, "
                    . "d_asenta, "
                    . "D_mnpio, "
                    . "d_estado, "
                    . "d_ciudad "                
                    . "FROM codigospostales "
                    . "where d_codigo = ? "
                    . "";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1, $cp, PDO::PARAM_STR);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $num = 0;
            if (count($rows) > 0) {
                $arrjson['estatus'] = 1;
                $str .= "<option value=''>Seleccionar</option>";
                foreach ($rows as $key => $value) {
                    $str .= "<option value='".$value["d_asenta"]."'>{$value["d_asenta"]}</option>";
                    $arrjson["municipio"] = $value["D_mnpio"];
                    $arrjson["estado"] = $value["d_estado"];
                    $arrjson["ciudad"] = $value["d_ciudad"];
                }
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } finally {
            $this->conMysql->closeMysql();
            $stmt = NULL;
            $rows = NULL;
        }
        $arrjson["colonias"] = $str;
        return $arrjson;
    }
    public function getCatEstados() {
        $arrjson = array();
        $str = "";
        $arrjson['estatus'] = 0;
        try {
            $sql = "SELECT DISTINCT codigospostales.d_estado FROM codigospostales";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $num = 0;
            if (count($rows) > 0) {
                $arrjson['estatus'] = 1;
                $str .= "<option value=''>Seleccionar</option>";
                foreach ($rows as $key => $value) {
                    $str .= "<option value='".$value["d_estado"]."'>{$value["d_estado"]}</option>";                    
                }
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } finally {
            $this->conMysql->closeMysql();
            $stmt = null;
            $rows = NULL;
        }
        $arrjson["catEstados"] = $str;
        return $arrjson;
    }
    public function getCiudadByEstado($param) {
        extract($param);
        $arrjson = array();        
        $str = "";
        $arrjson['estatus'] = 0;
        $arrjson["ciudades"] = "";
        try {
            $sql = "SELECT DISTINCT codigospostales.d_ciudad FROM codigospostales WHERE codigospostales.d_estado = ? AND codigospostales.d_ciudad is NOT NULL;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1, $estado, PDO::PARAM_STR);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);            
            $num = 0;
            if (count($rows) > 0) {
                $arrjson['estatus'] = 1;
                $str .= "<option value=''>Seleccionar</option>";
                foreach ($rows as $key => $value) {
                    $str .= "<option value='".$value["d_ciudad"]."'>{$value["d_ciudad"]}</option>";
                }
                $str .= "<option value='-1'>No está mi ciudad</option>";            
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } finally {
            $this->conMysql->closeMysql();
            $stmt = NULL;
            $rows = NULL;
        }
        $arrjson["ciudades"] = $str;
        return $arrjson;
    }
    public function existeDir(\modelo\ModeloUser\ModeloDireccion $dir) {
        $iddireccion = 0;
        $sql = "SELECT idDireccion FROM direccion WHERE idEmpleado = ? AND estatus = 1";
        try {            
            $stmt = $this->conn->prepare( $sql );
            $stmt->bindValue(1, $dir->getIdUser(), \PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($rows) > 0){
                foreach ($rows as $key => $value) {
                    $iddireccion = ((int)$value["iddireccion"] > 0 ? $value["iddireccion"] : 0);
                }
            }
        } catch (\PDOException $ex) {
            echo "Error al revisar si existe la direccion: ".$sql."<br/>".$ex->getMessage();
        } finally {
            $this->conMysql->closeMysql();
            $stmt = NULL;
            $rows = NULL;
        }
        return $iddireccion;
    }
    public function saveDir(\modelo\ModeloUser\ModeloDireccion $dir) {
        $flag = false;
        $sql = "INSERT INTO direccion ("
                    . "idEmpleado,"
                    . "calle,"
                    . "numerointerior,"
                    . "numeroexterior,"
                    . "colonia,"
                    . "cp,"
                    . "ciudad,"
                    . "delegacion,"
                    . "estado,"
                    . "tipodireccion,"
                    . "estatus,"
                    . "pais) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
                    . "";
        try {            
            $stmt = $this->conn->prepare( $sql );                    
            $stmt->bindvalue(1, $dir->getIdUser(), \PDO::PARAM_INT);
            $stmt->bindvalue(2, $dir->getCalle(), \PDO::PARAM_STR);
            $stmt->bindvalue(3, $dir->getNumerointerior(), \PDO::PARAM_STR);
            $stmt->bindvalue(4, $dir->getNumeroexterior(), \PDO::PARAM_STR);
            $stmt->bindvalue(5, $dir->getColonia(), \PDO::PARAM_STR);
            $stmt->bindvalue(6, $dir->getCp(), \PDO::PARAM_STR);
            $stmt->bindvalue(7, $dir->getCiudad(), \PDO::PARAM_STR);
            $stmt->bindvalue(8, $dir->getDelegacion(), \PDO::PARAM_STR);
            $stmt->bindvalue(9, $dir->getEstado(), \PDO::PARAM_STR);
            $stmt->bindvalue(10, $dir->getTipodireccion(), \PDO::PARAM_STR);
            $stmt->bindvalue(11, $dir->getEstatus(), \PDO::PARAM_STR);
            $stmt->bindvalue(12, $dir->getPais(), \PDO::PARAM_STR);
            $flag = $stmt->execute() ? true: false;
        } catch (\PDOException $ex) {
            echo "Error al guardar direccion: ".$sql."<br/>".$ex->getMessage();
        } finally {
            $this->conMysql->closeMysql();
            $stmt = NULL;            
        }
        return $flag;
    }
    public function updateDir(\modelo\ModeloUser\ModeloDireccion $dir) {
        $flag = false;
        $sql = "UPDATE direccion set "
                . "idUser = ?, "
                . "calle = ?, "
                . "numerointerior = ?, "
                . "numeroexterior = ?, "
                . "colonia = ?, "
                . "cp = ?, "
                . "ciudad = ?, "
                . "delegacion = ?, "
                . "estado = ?, "
                . "tipodireccion = ?, "
                . "estatus = ?, "
                . "pais = ? "
                . "WHERE iddireccion = ? ";
        try {            
            $stmt = $this->conn->prepare( $sql );                    
                    $stmt->bindvalue(1, $dir->getIdUser(), \PDO::PARAM_INT);
                    $stmt->bindvalue(2, $dir->getCalle(), \PDO::PARAM_STR);
                    $stmt->bindvalue(3, $dir->getNumerointerior(), \PDO::PARAM_STR);
                    $stmt->bindvalue(4, $dir->getNumeroexterior(), \PDO::PARAM_STR);
                    $stmt->bindvalue(5, $dir->getColonia(), \PDO::PARAM_STR);
                    $stmt->bindvalue(6, $dir->getCp(), \PDO::PARAM_STR);
                    $stmt->bindvalue(7, $dir->getCiudad(), \PDO::PARAM_STR);
                    $stmt->bindvalue(8, $dir->getDelegacion(), \PDO::PARAM_STR);
                    $stmt->bindvalue(9, $dir->getEstado(), \PDO::PARAM_STR);
                    $stmt->bindvalue(10, $dir->getTipodireccion(), \PDO::PARAM_STR);
                    $stmt->bindvalue(11, $dir->getEstatus(), \PDO::PARAM_STR);
                    $stmt->bindvalue(12, $dir->getPais(), \PDO::PARAM_STR);
                    $stmt->bindvalue(13, $dir->getIddireccion(), \PDO::PARAM_INT);
                    $flag = $stmt->execute() ? true: false;
        } catch (\PDOException $ex) {
            echo "Error al update direccion: ".$sql."<br/>".$ex->getMessage();
        } finally {
            $this->conMysql->closeMysql();
            $stmt = NULL;
        }
        return $flag;
    }
}
