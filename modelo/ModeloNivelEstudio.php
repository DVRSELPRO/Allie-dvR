<?php
namespace ModeloNivelEstudio;

class ModeloNivelEstudio {
    private $idNivelEstudio;
    private $idEmpleado;
    private $nivelEstudio;
    private $carrera;
    private $yearTitulacion;
    private $areaEstudio;
    private $lugar;
    private $periodoTiempoInicio;//mes año
    private $periodoTiempoFin;//mes año
    
    function getIdNivelEstudio() {
        return $this->idNivelEstudio;
    }

    function getIdEmpleado() {
        return $this->idEmpleado;
    }

    function getNivelEstudio() {
        return $this->nivelEstudio;
    }

    function getCarrera() {
        return $this->carrera;
    }

    function getYearTitulacion() {
        return $this->yearTitulacion;
    }

    function getAreaEstudio() {
        return $this->areaEstudio;
    }

    function getLugar() {
        return $this->lugar;
    }

    function getPeriodoTiempoInicio() {
        return $this->periodoTiempoInicio;
    }

    function getPeriodoTiempoFin() {
        return $this->periodoTiempoFin;
    }

    function setIdNivelEstudio($idNivelEstudio) {
        $this->idNivelEstudio = $idNivelEstudio;
    }

    function setIdEmpleado($idEmpleado) {
        $this->idEmpleado = $idEmpleado;
    }

    function setNivelEstudio($nivelEstudio) {
        $this->nivelEstudio = $nivelEstudio;
    }

    function setCarrera($carrera) {
        $this->carrera = $carrera;
    }

    function setYearTitulacion($yearTitulacion) {
        $this->yearTitulacion = $yearTitulacion;
    }

    function setAreaEstudio($areaEstudio) {
        $this->areaEstudio = $areaEstudio;
    }

    function setLugar($lugar) {
        $this->lugar = $lugar;
    }

    function setPeriodoTiempoInicio($periodoTiempoInicio) {
        $this->periodoTiempoInicio = $periodoTiempoInicio;
    }

    function setPeriodoTiempoFin($periodoTiempoFin) {
        $this->periodoTiempoFin = $periodoTiempoFin;
    }


}
