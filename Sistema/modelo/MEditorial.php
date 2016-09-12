<?php
require_once 'MConexion.php';
class MEditorial {

    private $codEditorial;
    private $editorial;
    private $descripcion;
    private $con;

    function __construct() {
        $this->con=new MConexion();
    }

    //Procedimientos selectores SET
    function setCodEditorial($codEditorial) {
        $this->codEditorial = $codEditorial;
    }

    function setEditorial($editorial) {
        $this->editorial = $editorial;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    //Metodos Funciones GET
    function getCodEditorial() {
        return $this->codEditorial;
    }

    function getEditorial() {
        return $this->editorial;
    }

    function getDescripcion() {
        return $this->descripcion;
    }
    public function insertarEdiorial() {
        $this->con->conectar();
        $sql="call insertEditorial ("
                . "(select MAX(codEditorial)+1 from class_editorial),"
                . "'$this->editorial',"
                . "'$this->descripcion');";
        $result=  $this->con->consulta($sql);
        $this->con->desconectar();
        return $result;
    }
    public function modificarEdiorial() {
        $this->con->conectar();
        $sql="UPDATE class_editorial SET "
                . "nombreEditorial ='$this->editorial', "
                . "descripcion='$this->descripcion' "
                . "WHERE codEditorial='$this->codEditorial';";
        $result=  $this->con->consulta($sql);
        $this->con->desconectar();
        return $result;
    }
    public function mostrarEdiorial() {
        $this->con->conectar();
        $sql="SELECT * FROM class_editorial;";
        $result=  $this->con->consulta($sql);
        $this->con->desconectar();
        return $result;
    }
    public function deleteEdiorial() {
        $this->con->conectar();
        $sql="DELETE FROM tbl_editorial "
                . "WHERE codEditorial='$this->codEditorial';";
        $result=  $this->con->consulta($sql);
        $this->con->desconectar();
        return $result;
    }

}
