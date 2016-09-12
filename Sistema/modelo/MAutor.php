<?php
require_once 'MConexion.php';
class MAutor {

    public $codAutor;
    private $autor;
    private $nacionalidad;
    private $fechaNacimiento;
    private $con;

    function __construct() {
        $this->con =new MConexion();
    }

//Procedimientos selectores SET
    function setCodAutor($codAutor) {
        $this->codAutor = $codAutor;
    }

    function setAutor($autor) {
        $this->autor = $autor;
    }

    function setNacionalidad($nacionalidad) {
        $this->nacionalidad = $nacionalidad;
    }

    function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

//Metodos Funciones GET
    function getCodAutor() {
        return $this->codAutor;
    }

    function getAutor() {
        return $this->autor;
    }

    function getNacionalidad() {
        return $this->nacionalidad;
    }

    function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }
    public function insertarAutor() {
        $this->con->conectar();
        $sql="call insertAutor("
                . "(select MAX(codAutor)+1 from class_autor),"
                . "'$this->autor',"
                . "'$this->nacionalidad',"
                . "'$this->fechaNacimiento');";
        $result=  $this->con->consulta($sql);
        $this->con->desconectar();
        return $result;
    }
    public function modificarAutor() {
        $this->con->conectar();
        $sql="UPDATE class_autor SET "
                . "nombreAutor ='$this->autor', "
                . "nacionalidadAutor='$this->nacionalidad', "
                    . "fechaNacimAutor='$this->fechaNacimiento'"
                . "WHERE codAutor='$this->codAutor';";
        $result=  $this->con->consulta($sql);
        $this->con->desconectar();
        return $result;
    }
    public function mostrarAutor() {
        $this->con->conectar();
        $sql="SELECT * FROM class_autor;";
        $result=  $this->con->consulta($sql);
        $this->con->desconectar();
        return $result;
    }
    public function deleteAutor() {
        $this->con->conectar();
        $sql="DELETE FROM class_autor"
                . "WHERE codAutor='$this->codAutor';";
        $result=  $this->con->consulta($sql);
        $this->con->desconectar();
        return $result;
    }
    public function mostrarRegistro() {
        $this->con->conectar();
        $sql="SELECT codAutor, nombreAutor FROM class_autor "
                . "WHERE codAutor=(SELECT MAX(codAutor)+1 AS codAutor FROM class_autor)OR nombreAutor='$this->autor';";
        $result=  $this->con->consulta($sql);
        $this->con->desconectar();
        return $result;
    }


}
