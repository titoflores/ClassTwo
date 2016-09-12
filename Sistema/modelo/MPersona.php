<?php

require_once 'MConexion.php';

class MPersona {

    private $codPersona;
    private $nombres;
    private $apellidos;
    private $sexo;
    private $telefono;
    private $email;
    private $fechaNacim;
    private $connection;

    function __construct() {
        $this->codPersona = 0;
        $this->nombres = "";
        $this->apellidos = "";
        $this->sexo = 'M';
        $this->telefono = "";
        $this->email = "";
        $this->fechaNacim = '0000-00-00';
        $this->connection = new MConexion();
    }

    //Procedimientos selectores SET
    function setCodPersona($codPersona) {
        $this->codPersona = $codPersona;
    }

    function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setFechaNacim($fechaNacim) {
        $this->fechaNacim = $fechaNacim;
    }

    //Metodos Funciones GET

    function getCodPersona() {
        return $this->codPersona;
    }

    function getNombres() {
        return $this->nombres;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getEmail() {
        return $this->email;
    }

    function getFechaNacim() {
        return $this->fechaNacim;
    }

    public function createPersona() {
        $this->connection->conectar();
        $sql = "";
        $result = $this->connection->consulta($sql);
        $this->connection->desconectar();
        return $result;
    }

    public function updatePersona() {
        $this->connection->conectar();
        $sql = "";
        $result = $this->connection->consulta($sql);
        $this->connection->desconectar();
        return $result;
    }

    public function readPersona() {
        $this->connection->conectar();
        $sql = "";
        $result = $this->connection->consulta($sql);
        $this->connection->desconectar();
        return $result;
    }

    public function deletePersona() {
        $this->connection->conectar();
        $sql = "";
        $result = $this->connection->consulta($sql);
        $this->connection->desconectar();
        return $result;
    }

    public function Mensaje() {
        echo 'Hola Mundo';
    }

}
