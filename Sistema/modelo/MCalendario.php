<?php

require_once 'MConexion.php';

class MCalendario {

    private $codCalendario;
    private $fecha;
    private $estado;
    private $descripcion;
    private $con;

    function __construct() {
        $this->con = new MConexion();
    }
    function getCodCalendario() {
        return $this->codCalendario;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getEstado() {
        return $this->estado;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setCodCalendario($codCalendario) {
        $this->codCalendario = $codCalendario;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

        
   
    public function insertCalendario(){
        $this->con->conectar();
        $sql= ""; 
        $result=$this->con->consulta($sql);
        $this->con->desconectar(); 
        return $result;
    }
    public function updateCalendario(){
        $this->con->conectar();
        $sql= ""; 
        $result=$this->con->consulta($sql);
        $this->con->desconectar(); 
        return $result;
    }
    public function deleteCalendario(){
        $this->con->conectar();
        $sql= ""; 
        $result=$this->con->consulta($sql);
        $this->con->desconectar(); 
        return $result;
    }
    public function readCalendario(){
        $this->con->conectar();
        $sql= "select * from calendario;"; 
        $result=$this->con->consulta($sql);
        $this->con->desconectar(); 
        return $result;
    }
    public function buscarFechaCalendario(){
        $this->con->conectar();
        $sql= "call buscarFeriado('$this->fecha');"; 
        $result=$this->con->consulta($sql);
        $this->con->desconectar(); 
        return $result;
    }
    
    public function fechaActual(){
        $this->con->conectar();
        $sql= "select CURDATE() as fechaActual;"; 
        $result=$this->con->consulta($sql);
        $this->con->desconectar(); 
        return $result;
    }
    public function sumaFechaActual(){
        $this->con->conectar();
        $sql= "select DATE_ADD('2015-11-12',INTERVAL 2 DAY) as sumarFecha;"; 
        $result=$this->con->consulta($sql);
        $this->con->desconectar(); 
        return $result;
    }
     public function restaFechaActual(){
        $this->con->conectar();
        $sql= "select DATE_SUB('2015-11-12',INTERVAL 2 DAY) as restaFecha;"; 
        $result=$this->con->consulta($sql);
        $this->con->desconectar(); 
        return $result;
    }
}
