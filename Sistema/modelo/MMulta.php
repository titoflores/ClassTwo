<?php

require_once 'MConexion.php';
/* create table tbl_multa
  ----(
  --------        codMulta int not null auto_increment,
  --------        nombreMulta varchar(50) not null,
  --------        descripcionMulta varchar(100) not null,
  --------        precioMulta double not null,
  --------        codPrestamo int not null,
  --------        foreign key(codPrestamo)references tbl_prestamo(codPrestamo),
  ----);
 */

class MMulta {

    private $descripcionMulta;
    private $precioMulta;
    private $estado;
    private $codPrestamo;
    private $multa;

    function __construct() {
        $this->descripcionMulta = "";
        $this->precioMulta = 0.00;
        $this->estado='';
        $this->codPrestamo = 0;
        $this->multa = new MConexion();
    }

    function getDescripcionMulta() {
        return $this->descripcionMulta;
    }

    function getPrecioMulta() {
        return $this->precioMulta;
    }

    function getEstado() {
        return $this->estado;
    }

    function getCodPrestamo() {
        return $this->codPrestamo;
    }

    function setDescripcionMulta($descripcionMulta) {
        $this->descripcionMulta = $descripcionMulta;
    }

    function setPrecioMulta($precioMulta) {
        $this->precioMulta = $precioMulta;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setCodPrestamo($codPrestamo) {
        $this->codPrestamo = $codPrestamo;
    }

    
    public function insertMulta() {
        $this->multa->conectar();
        echo $sql = "INSERT INTO class_multa VALUES('$this->descripcionMulta',$this->precioMulta,'$this->estado','$this->codPrestamo');";
        $result = $this->multa->consulta($sql);
        $this->multa->desconectar();
        return $result;
    }
    public function readMulta() {
        $this->multa->conectar();
        echo $sql = "call listaMulta;";
        $result = $this->multa->consulta($sql);
        $this->multa->desconectar();
        return $result;
    }
}
