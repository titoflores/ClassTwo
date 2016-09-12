<?php

require_once 'MConexion.php';
require_once 'MPersona.php';

class MBibliotecario extends MPersona {

    private $codPersona;
    private $con;
    private $usuario;
    private $clave;
    private $turno;
    private $estado;

    function __construct() {
        parent::__construct();
        $this->codPersona = 0;
        $this->usuario = "";
        $this->clave = "";
        $this->turno = "";
        $this->estado = ' ';
        $this->con = new MConexion();
    }

    //Procedimientos selectores SET

    function setCodPersona($codPersona) {
        $this->codPersona = $codPersona;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setTurno($turno) {
        $this->turno = $turno;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    //Metodos Funciones GET

    function getCodPersona() {
        return $this->codPersona;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getClave() {
        return $this->clave;
    }

    function getTurno() {
        return $this->turno;
    }

    function getEstado() {
        return $this->estado;
    }

    public function validarLogin() {
        $this->con->conectar();
        echo $sql = "SELECT * FROM class_bibliotecario WHERE usuario='$this->usuario' and clave='$this->clave'";
        $result = $this->con->consulta($sql);
        $this->con->desconectar();
        return $result;
    }

    public function insertBibliotecario() {
        $this->con->conectar();
        $sql = "INSERT INTO class_bibliotecario VALUES ($this->codPersona,'$this->usuario','$this->clave','$this->turno','$this->estado');";
        $result = $this->con->consulta($sql);
        $this->con->desconectar();
        return $result;
    }

}
