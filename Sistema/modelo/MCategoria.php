<?php
require_once 'MConexion.php';
class MCategoria {
    private $codCategoria;
    private $nombre_c;
    private $descripcion_c;
    private $estado;
    private $con;
    
    function __construct() {
        $this->con=new MConexion();
    }
    function getCodCategoria() {
        return $this->codCategoria;
    }

    function getNombre_c() {
        return $this->nombre_c;
    }

    function getDescripcion_c() {
        return $this->descripcion_c;
    }

    function getEstado() {
        return $this->estado;
    }

    function setCodCategoria($codCategoria) {
        $this->codCategoria = $codCategoria;
    }

    function setNombre_c($nombre_c) {
        $this->nombre_c = $nombre_c;
    }

    function setDescripcion_c($descripcion_c) {
        $this->descripcion_c = $descripcion_c;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }
    public function insertCategoria(){
        $this->con->conectar();
        $sql= "call insertCategoria("
                . "$this->codCategoria,"
                . "'$this->nombre_c',"
                . "'$this->descripcion_c',"
                . "'$this->estado');"; 
        $result=$this->con->consulta($sql);
        $this->con->desconectar();
        return $result;
    }
    public function modificarCategoria(){
        $this->con->conectar();
        $sql= "UPDATE tbl_categoria "
                . "SET nombre_c='$this->nombre_c',descripcion_c='$this->descripcion_c',estado='$this->estado' "
                . "WHERE codCategoria='$this->codCategoria';"; 
        $result=$this->con->consulta($sql);
        $this->con->desconectar();
        return $result;
    }
    public function mostrarCategoria(){
        $this->con->conectar();
        $sql= "SELECT * FROM class_categoria;"; 
        $result=$this->con->consulta($sql);
        $this->con->desconectar(); 
        return $result;
    }
    public function deleteCategoria(){
        $this->con->conectar();
        $sql= "DELETE FROM tbl_categoria WHERE codCategoria='$this->codCategoria';"; 
        $result=$this->con->consulta($sql);
        $this->con->desconectar();
        return $result;
    }
}
