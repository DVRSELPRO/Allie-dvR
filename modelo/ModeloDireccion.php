<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace modelo\ModeloUser;

/**
 * Description of ModeloDireccion
 *
 * @author Josglow
 */
class ModeloDireccion {
    private $iddireccion;
    private $calle;
    private $numerointerior;
    private $numeroexterior;
    private $colonia;
    private $cp;
    private $ciudad;
    private $delegacion;
    private $estado;
    private $tipodireccion;
    private $estatus;
    private $pais;
    private $idUser;
    
    function getIddireccion() {
        return $this->iddireccion;
    }

    function getCalle() {
        return $this->calle;
    }

    function getNumerointerior() {
        return $this->numerointerior;
    }

    function getNumeroexterior() {
        return $this->numeroexterior;
    }

    function getColonia() {
        return $this->colonia;
    }

    function getCp() {
        return $this->cp;
    }

    function getCiudad() {
        return $this->ciudad;
    }

    function getDelegacion() {
        return $this->delegacion;
    }

    function getEstado() {
        return $this->estado;
    }

    function getTipodireccion() {
        return $this->tipodireccion;
    }

    function getEstatus() {
        return $this->estatus;
    }

    function getPais() {
        return $this->pais;
    }

    function setIddireccion($iddireccion) {
        $this->iddireccion = $iddireccion;
    }

    function setCalle($calle) {
        $this->calle = $calle;
    }

    function setNumerointerior($numerointerior) {
        $this->numerointerior = $numerointerior;
    }

    function setNumeroexterior($numeroexterior) {
        $this->numeroexterior = $numeroexterior;
    }

    function setColonia($colonia) {
        $this->colonia = $colonia;
    }

    function setCp($cp) {
        $this->cp = $cp;
    }

    function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    function setDelegacion($delegacion) {
        $this->delegacion = $delegacion;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setTipodireccion($tipodireccion) {
        $this->tipodireccion = $tipodireccion;
    }

    function setEstatus($estatus) {
        $this->estatus = $estatus;
    }

    function setPais($pais) {
        $this->pais = $pais;
    }
    function getIdUser() {
        return $this->idUser;
    }

    function setIdUser($idUser) {
        $this->idUser = $idUser;
    }



    
    
}
