<?php

require_once 'MConexion.php';

class MBitacora {

    private $fechaHora;
    private $usuarioPc;
    private $usuarioBd;
    private $claseBd;
    private $accionInClass;
    private $con;

    function __construct() {
        $this->con = new MConexion();
    }

    function getFechaHora() {
        return $this->fechaHora;
    }

    function getUsuarioPc() {
        return $this->usuarioPc;
    }

    function getUsuarioBd() {
        return $this->usuarioBd;
    }

    function getClaseBd() {
        return $this->claseBd;
    }

    function getAccionInClass() {
        return $this->accionInClass;
    }

    function setFechaHora($fechaHora) {
        $this->fechaHora = $fechaHora;
    }

    function setUsuarioPc($usuarioPc) {
        $this->usuarioPc = $usuarioPc;
    }

    function setUsuarioBd($usuarioBd) {
        $this->usuarioBd = $usuarioBd;
    }

    function setClaseBd($claseBd) {
        $this->claseBd = $claseBd;
    }

    function setAccionInClass($accionInClass) {
        $this->accionInClass = $accionInClass;
    }

    public function mostrarBitacora() {
        $this->con->conectar();
        $sql = "SELECT * FROM bitacora;";
        $result = $this->con->consulta($sql);
        $this->con->desconectar();
        return $result;
    }

}
