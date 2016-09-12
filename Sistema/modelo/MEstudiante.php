<?php

require_once 'MConexion.php';
require_once 'MPersona.php';

class MEstudiante extends MPersona {

    private $codPersona;
    private $registro;
    private $fechaInicio;
    private $fechaCulminacion;
    private $estado;

    function __construct() {
        parent::__construct();
        $this->codPersona = 0;
        $this->registro = 0;
        $this->fechaInicio = '0000-00-00';
        $this->fechaCulminacion = '0000-00-00';
        $this->estado = ' ';
        $this->con = new MConexion();
    }

    //Procedimientos selectores SET
    function setCodPersona($codPersona) {
        $this->codPersona = $codPersona;
    }

        function setRegistro($registro) {
        $this->registro = $registro;
    }

    function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

    function setFechaCulminacion($fechaCulminacion) {
        $this->fechaCulminacion = $fechaCulminacion;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    //Metodos Funciones GET
    function getCodPersona() {
        return $this->codPersona;
    }

        function getRegistro() {
        return $this->registro;
    }

    function getFechaInicio() {
        return $this->fechaInicio;
    }

    function getFechaCulminacion() {
        return $this->fechaCulminacion;
    }

    function getEstado() {
        return $this->estado;
    }

    function mostrar() {
        echo $this->persona->Mensaje();
    }
    public function insertEstudiante() {
        $this->con->conectar();
        $sql = "INSERT INTO estudiante VALUES ($this->codPersona,$this->registro,'$this->fechaInicio','$this->fechaCulminacion','$this->estado');";
        $result = $this->con->consulta($sql);
        $this->con->desconectar();
        return $result;
    }
    public function buscarEstudiante(){
        $this->con->conectar();
        $sql = "CALL buscarEstudiante($this->registro);";
        $result = $this->con->consulta($sql);
        $this->con->desconectar();
        return $result;
    }
    public function tieneMulta(){
        $this->con->conectar();
        echo $sql = "call tieneMulta($this->registro);";
        $result = $this->con->consulta($sql);
        $this->con->desconectar();
        return $result;
    }
    public function tienePrestamo(){
        $this->con->conectar();
        echo $sql = "call tienePrestamo($this->registro);";
        $result = $this->con->consulta($sql);
        $this->con->desconectar();
        return $result;
    }
    
}
