<?php
namespace ModeloUser;

/**
 * Description of ModeloUser
 *
 * @author Josglow
 */
class ModeloUser {

    private $iduser;
    private $idcliente;
    private $nombreempleado;
    private $apellidopaterno;
    private $apellidomaterno;
    private $estatus;
    private $id_rol;
    private $mail;
    private $password;
    private $nss;
    private $rfc;
    private $curp;    
    private $pathPicPerfil;
    private $tipo_persona;    
    private $celular;        
    private $fechacreacion;
    private $fechamodificacion;
    private $fechaNacimiento;
    private $estadoCivil;
    private $telefonoFijo;
    private $fechaSolicitud;
    private $sueldoMensual;
    private $dependientesEconomico;
    private $lugarTrabajo;
    private $tieneNSS;
    private $idempleadoModificacion;
    private $docsSeleccionados;
    
    public function ModeloUser() {
        
    }

    function getIduser() {
        return $this->iduser;
    }
    function getIdcliente() {
        return $this->idcliente;
    }

    function getNombreempleado() {
        return $this->nombreempleado;
    }

    function getApellidopaterno() {
        return $this->apellidopaterno;
    }

    function getApellidomaterno() {
        return $this->apellidomaterno;
    }

    function getEstatus() {
        return $this->estatus;
    }

    function getId_rol() {
        return $this->id_rol;
    }

    function getMail() {
        return $this->mail;
    }

    function getPassword() {
        return $this->password;
    }

    function getNss() {
        return $this->nss;
    }

    function getRfc() {
        return $this->rfc;
    }

    function getCurp() {
        return $this->curp;
    }

    function getPathPicPerfil() {
        return $this->pathPicPerfil;
    }

    function getTipo_persona() {
        return $this->tipo_persona;
    }

    function getCelular() {
        return $this->celular;
    }

    function getFechacreacion() {
        return $this->fechacreacion;
    }

    function getFechamodificacion() {
        return $this->fechamodificacion;
    }

    function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    function getEstadoCivil() {
        return $this->estadoCivil;
    }

    function getTelefonoFijo() {
        return $this->telefonoFijo;
    }

    function getFechaSolicitud() {
        return $this->fechaSolicitud;
    }

    function getSueldoMensual() {
        return $this->sueldoMensual;
    }

    function getDependientesEconomico() {
        return $this->dependientesEconomico;
    }

    function getLugarTrabajo() {
        return $this->lugarTrabajo;
    }

    function getTieneNSS() {
        return $this->tieneNSS;
    }

    function getIdempleadoModificacion() {
        return $this->idempleadoModificacion;
    }

    function setIdcliente($idcliente) {
        $this->idcliente = $idcliente;
    }

    function setNombreempleado($nombreempleado) {
        $this->nombreempleado = $nombreempleado;
    }

    function setApellidopaterno($apellidopaterno) {
        $this->apellidopaterno = $apellidopaterno;
    }

    function setApellidomaterno($apellidomaterno) {
        $this->apellidomaterno = $apellidomaterno;
    }

    function setEstatus($estatus) {
        $this->estatus = $estatus;
    }

    function setId_rol($id_rol) {
        $this->id_rol = $id_rol;
    }

    function setMail($mail) {
        $this->mail = $mail;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setNss($nss) {
        $this->nss = $nss;
    }

    function setRfc($rfc) {
        $this->rfc = $rfc;
    }

    function setCurp($curp) {
        $this->curp = $curp;
    }

    function setPathPicPerfil($pathPicPerfil) {
        $this->pathPicPerfil = $pathPicPerfil;
    }

    function setTipo_persona($tipo_persona) {
        $this->tipo_persona = $tipo_persona;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

    function setFechacreacion($fechacreacion) {
        $this->fechacreacion = $fechacreacion;
    }

    function setFechamodificacion($fechamodificacion) {
        $this->fechamodificacion = $fechamodificacion;
    }

    function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    function setEstadoCivil($estadoCivil) {
        $this->estadoCivil = $estadoCivil;
    }

    function setTelefonoFijo($telefonoFijo) {
        $this->telefonoFijo = $telefonoFijo;
    }

    function setFechaSolicitud($fechaSolicitud) {
        $this->fechaSolicitud = $fechaSolicitud;
    }

    function setSueldoMensual($sueldoMensual) {
        $this->sueldoMensual = $sueldoMensual;
    }

    function setDependientesEconomico($dependientesEconomico) {
        $this->dependientesEconomico = $dependientesEconomico;
    }

    function setLugarTrabajo($lugarTrabajo) {
        $this->lugarTrabajo = $lugarTrabajo;
    }

    function setTieneNSS($tieneNSS) {
        $this->tieneNSS = $tieneNSS;
    }

    function setIdempleadoModificacion($idempleadoModificacion) {
        $this->idempleadoModificacion = $idempleadoModificacion;
    }
    function getDocsSeleccionados() {
        return $this->docsSeleccionados;
    }

    function setDocsSeleccionados($docsSeleccionados) {
        $this->docsSeleccionados = $docsSeleccionados;
    }



    
    
}
