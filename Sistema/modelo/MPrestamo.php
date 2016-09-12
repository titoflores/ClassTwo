<?php

require_once 'MConexion.php';

class MPrestamo {

    private $codPrestamo;
    private $fechaSalida;
    private $fechaDevolucion;
    private $notaGlosa;
    private $estado;
    private $registroEstudiante;
    private $usuario_bibli;
    private $codLibro;
    private $conn;

    function __construct() {
        $this->codPrestamo = 0;
        $this->fechaSalida = '0000-00-00';
        $this->fechaDevolucion = '0000-00-00';
        $this->notaGlosa = "";
        $this->estado = ' ';
        $this->registroEstudiante = 0;
        $this->usuario_bibli = "";
        $this->codLibro = 0;
        $this->conn = new MConexion();
    }
    function setCodPrestamo($codPrestamo) {
        $this->codPrestamo = $codPrestamo;
    }

    function setFechaSalida($fechaSalida) {
        $this->fechaSalida = $fechaSalida;
    }

    function setFechaDevolucion($fechaDevolucion) {
        $this->fechaDevolucion = $fechaDevolucion;
    }

    function setNotaGlosa($notaGlosa) {
        $this->notaGlosa = $notaGlosa;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setRegistroEstudiante($registroEstudiante) {
        $this->registroEstudiante = $registroEstudiante;
    }

    function setUsuario_bibli($usuario_bibli) {
        $this->usuario_bibli = $usuario_bibli;
    }

    function setCodLibro($codLibro) {
        $this->codLibro = $codLibro;
    }
    public function insertPrestamo() {
        $this->conn->conectar();
        $sql = "call insertPrestamo("
                . "(select MAX(codPrestamo)+1 from class_prestamo),"
                . "'$this->fechaSalida',"
                . "'$this->fechaDevolucion',"
                . "'$this->notaGlosa',"
                . "'$this->estado',"
                . "$this->registroEstudiante,"
                . "'$this->usuario_bibli',"
                . "$this->codLibro);";
        $result = $this->conn->consulta($sql);
        $this->conn->desconectar();
        return $result;
    }

    public function updatePrestamo() {
        $this->conn->conectar();
        $sql = "UPDATE class_prestamo"
                . "SET"
                . "fechaDevolucion='$this->fechaDevolucion',"
                . "notaGlosa='$this->notaGlosa',"
                . "estado='$this->estado'"
                . "WHERE"
                . "codPrestamo='$this->codPrestamo';";
        $result = $this->conn->consulta($sql);
        $this->conn->desconectar();
        return $result;
    }
    public function mostrarPrestamo(){
        $this->conn->conectar();
        $sql="call listPrestamo;";
        $result = $this->conn->consulta($sql);
        $this->conn->desconectar();
        return $result;
    }
    public function tienePrestamos(){
         $this->conn->conectar();
        $sql="call tienePrestamo($this->registroEstudiante);";
        $result = $this->conn->consulta($sql);
        $this->conn->desconectar();
        return $result;  
    }
    public function ShowPrestamoEstudiante(){
         $this->conn->conectar();
        $sql="CALL listPrestamo_est($this->registroEstudiante);";
        $result = $this->conn->consulta($sql);
        $this->conn->desconectar();
        return $result;  
    }
    public function estadoInactivo(){
         $this->conn->conectar();
        $sql="call updateEstadoPrestamo_Inactivo($this->codPrestamo);";
        $result = $this->conn->consulta($sql);
        $this->conn->desconectar();
        return $result;  
    }
}
