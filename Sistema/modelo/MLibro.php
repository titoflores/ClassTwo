<?php

require_once 'MConexion.php';

class MLibro {

    private $codLibro;
    private $titulo;
    private $numero_pag;
    private $añoEdicion;
    private $cantidad;
    private $estado;
    private $connection;
    private $codAutor;
    private $codEditorial;
    private $codCategoria;

    function __construct() {
        $this->codLibro='1000';
        $this->connection = new MConexion();
    }

    //Procedimientos selectores SET
    function setCodAutor($codAutor) {
        $this->codAutor = $codAutor;
    }

    function setCodEditorial($codEditorial) {
        $this->codEditorial = $codEditorial;
    }

    function setCodCategoria($codCategoria) {
        $this->codCategoria = $codCategoria;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setCodLibro($codLibro) {
        $this->codLibro = $codLibro;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setNumero_pag($numero_pag) {
        $this->numero_pag = $numero_pag;
    }

    function setAñoEdicion($añoEdicion) {
        $this->añoEdicion = $añoEdicion;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    //Metodos Funciones GET

    function getEstado() {
        return $this->estado;
    }

    function getCodLibro() {
        return $this->codLibro;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getNumero_pag() {
        return $this->numero_pag;
    }

    function getAñoEdicion() {
        return $this->añoEdicion;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    public function createLibro() {
        $this->connection->conectar();
        $sql = "INSERT INTO class_libro "
                . "VALUES ("
                . "'$this->codLibro',"
                . "'$this->titulo',"
                . "'$this->numero_pag',"
                . "'$this->añoEdicion',"
                . "'$this->cantidad',"
                . "'$this->estado',"
                . "'$this->codAutor',"
                . "'$this->codEditorial',"
                . "'$this->codCategoria');";
        $result = $this->connection->consulta($sql);
        $this->connection->desconectar();
        return $result;
    }

    public function updateLibro() {
        $this->connection->conectar();
        $sql = "call updateEjemplares('$this->codLibro',$this->cantidad);";
        $result = $this->connection->consulta($sql);
        $this->connection->desconectar();
        return $result;
    }

    public function readLibro() {
        $this->connection->conectar();
        $sql = "call listLibro;";
        $result = $this->connection->consulta($sql);
        $this->connection->desconectar();
        return $result;
    }

    public function deleteLibro() {
        $this->connection->conectar();
        $sql = "DELETE FROM class_libro "
                . "WHERE "
                . "codLibro='$this->codLibro';";
        $result = $this->connection->consulta($sql);
        $this->connection->desconectar();
        return $result;
    }
    public function readRegistro() {
        $this->connection->conectar();
        $sql = "SELECT * FROM class_libro "
                . "WHERE codLibro='$this->codLibro'OR nombreLibro='$this->titulo';";
        $result = $this->connection->consulta($sql);
        $this->connection->desconectar();
        return $result;
    }
     public function maxRegistro() {
        $this->connection->conectar();
        $sql = "SELECT MAX(codLibro)+1 AS codLibro FROM class_Libro;";
        $result = $this->connection->consulta($sql);
        $this->connection->desconectar();
        return $result;
    }
    public function consultatRegistro() {
        $this->connection->conectar();
        $sql = "CALL buscarLibroCodigo('$this->codLibro');";
        $result = $this->connection->consulta($sql);
        $this->connection->desconectar();
        return $result;
    }
    public function consultaPlabra($palabra) {
        $this->connection->conectar();
        $sql = "CALL buscarLibroGeneral('$palabra');";
        $result = $this->connection->consulta($sql);
        $this->connection->desconectar();
        return $result;
    }
    public function descontarEjemplar($codLibro){
        $this->connection->conectar();
        $sql = "call restarEjemplares($codLibro);";
        $result = $this->connection->consulta($sql);
        $this->connection->desconectar();
        return $result;
    }
    public function agregarEjemplar($codLibro){
        $this->connection->conectar();
        $sql = "call sumarEjemplares($codLibro);";
        $result = $this->connection->consulta($sql);
        $this->connection->desconectar();
        return $result;
    }
}
