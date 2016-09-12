<?php

require_once '../modelo/MEditorial.php';

class CEditorial {

    private $edi;

    function __construct() {
        $this->edi = new MEditorial();
    }
    public function insertarEditorial($editorial, $descripcion) {
        $this->edi->setEditorial($editorial);
        $this->edi->setDescripcion($descripcion);
        $this->edi->insertarEdiorial();
    }
    public function mostrarEditorial(){
        return $this->edi->mostrarEdiorial();
    }
}
