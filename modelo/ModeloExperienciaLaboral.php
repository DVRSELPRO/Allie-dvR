<?php
namespace ModeloExperienciaLaboral;

class ModeloExperienciaLaboral {
    private $idEmpleado;
    private $empresa;
    private $puesto;
    private $directorGeneral;
    private $facturacionAnual;
    private $telefono;
    private $extension;
    private $paginaWeb;
    private $periodoTiempoInicio;
    private $periodoTiempoFin;
    private $descripcion;
    private $lugar;
    private $estatus;
    private $reportasA;
    private $reportanMismoNivel;
    private $teReportan;
    
    function getIdEmpleado() {
        return $this->idEmpleado;
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function getPuesto() {
        return $this->puesto;
    }

    function getDirectorGeneral() {
        return $this->directorGeneral;
    }

    function getFacturacionAnual() {
        return $this->facturacionAnual;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getExtension() {
        return $this->extension;
    }

    function getPaginaWeb() {
        return $this->paginaWeb;
    }

    function getPeriodoTiempoInicio() {
        return $this->periodoTiempoInicio;
    }

    function getPeriodoTiempoFin() {
        return $this->periodoTiempoFin;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getLugar() {
        return $this->lugar;
    }

    function getEstatus() {
        return $this->estatus;
    }

    function getReportasA() {
        return $this->reportasA;
    }

    function getReportanMismoNivel() {
        return $this->reportanMismoNivel;
    }

    function getTeReportan() {
        return $this->teReportan;
    }

    function setIdEmpleado($idEmpleado) {
        $this->idEmpleado = $idEmpleado;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    function setPuesto($puesto) {
        $this->puesto = $puesto;
    }

    function setDirectorGeneral($directorGeneral) {
        $this->directorGeneral = $directorGeneral;
    }

    function setFacturacionAnual($facturacionAnual) {
        $this->facturacionAnual = $facturacionAnual;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setExtension($extension) {
        $this->extension = $extension;
    }

    function setPaginaWeb($paginaWeb) {
        $this->paginaWeb = $paginaWeb;
    }

    function setPeriodoTiempoInicio($periodoTiempoInicio) {
        $this->periodoTiempoInicio = $periodoTiempoInicio;
    }

    function setPeriodoTiempoFin($periodoTiempoFin) {
        $this->periodoTiempoFin = $periodoTiempoFin;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setLugar($lugar) {
        $this->lugar = $lugar;
    }

    function setEstatus($estatus) {
        $this->estatus = $estatus;
    }

    function setReportasA($reportasA) {
        $this->reportasA = $reportasA;
    }

    function setReportanMismoNivel($reportanMismoNivel) {
        $this->reportanMismoNivel = $reportanMismoNivel;
    }

    function setTeReportan($teReportan) {
        $this->teReportan = $teReportan;
    }


}
