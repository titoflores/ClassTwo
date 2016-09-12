<?php

require_once 'MConexion.php';

class MReserva {

    private $codReserva;
    private $fechaReserva;
    private $fechaLimite;
    private $estado;
    protected $con;

    function __construct() {
        $this->con = new MConexion();
    }
    
    function getCodReserva() {
        return $this->codReserva;
    }

    function getFechaReserva() {
        return $this->fechaReserva;
    }

    function getFechaLimite() {
        return $this->fechaLimite;
    }

    function getEstado() {
        return $this->estado;
    }

    function setCodReserva($codReserva) {
        $this->codReserva = $codReserva;
    }

    function setFechaReserva($fechaReserva) {
        $this->fechaReserva = $fechaReserva;
    }

    function setFechaLimite($fechaLimite) {
        $this->fechaLimite = $fechaLimite;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    public function listReserva(){
        $this->con->conectar();
        $sql="CALL listReserva;";
        $result=  $this->con->consulta($sql);
        $this->con->desconectar();
        return $result;
    }
    public function insertReserva($codLibro,$registro){
        $this->con->conectar();
        $sql="CALL insertReserva((select max(codReserva)+1 from class_reserva),"
                . "'$this->fechaReserva',"
                . "'$this->fechaLimite','$this->estado','$codLibro','$registro');";
        $result=  $this->con->consulta($sql);
        $this->con->desconectar();
        return $result;
    }
}
