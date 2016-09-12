<?php

//create table tbl_devolucion
//(
//	fechaDevollucion date not null,
//	glosaDevolucion varchar(100) not null,
//	codPrestamo int not null,
//	foreign key(codPrestamo)references tbl_prestamo(codPrestamo),
//	primary key(codPrestamo)
//);
require_once 'MConexion.php';

class MDevolucion {

    private $codPrestamo;
    private $fechaDevollucion;
    private $glosaDevolucion;
    private $conn;

    function __construct() {
        $this->codPrestamo = 0;
        $this->fechaDevollucion = '0000-00-00';
        $this->glosaDevolucion = "";
        $this->conn = new MConexion();
    }

    function setCodPrestamo($codPrestamo) {
        $this->codPrestamo = $codPrestamo;
    }

    function setFechaDevollucion($fechaDevollucion) {
        $this->fechaDevollucion = $fechaDevollucion;
    }

    function setGlosaDevolucion($glosaDevolucion) {
        $this->glosaDevolucion = $glosaDevolucion;
    }

    public function insertDevolucion() {
        $this->conn->conectar();
        $sql = "INSERT INTO class_devolucion "
                . "VALUES("
                . "'$this->fechaDevollucion',"
                . "'$this->glosaDevolucion',"
                . "$this->codPrestamo);";
        $result = $this->conn->consulta($sql);
        $this->conn->desconectar();
        return $result;
    }

    public function mostrarDevolucion() {
        $this->conn->conectar();
        $sql = "call listDevolucion;";
        $result = $this->conn->consulta($sql);
        $this->conn->desconectar();
        return $result;
    }

}
