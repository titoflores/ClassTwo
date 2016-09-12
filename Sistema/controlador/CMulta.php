<?php

require_once '../modelo/MMulta.php';
require_once '../modelo/MLibro.php';

class CMulta {

    private $multa;
    private $libro;

    function __construct() {
        $this->multa = new MMulta();
        $this->libro=new MLibro();
    }
    public function insertMulta($descripcionMulta,$precioMulta, $estadoMulta, $codPrestamo, $codLibroBaja){
        $this->multa->setDescripcionMulta($descripcionMulta);
        $this->multa->setPrecioMulta($precioMulta);
        $this->multa->setEstado($estadoMulta);
        $this->multa->setCodPrestamo($codPrestamo);
        $this->multa->insertMulta();
        $this->libro->descontarEjemplar($codLibroBaja);
    }
    public function listaMulta() {
        return $this->multa->readMulta();
    }

}
