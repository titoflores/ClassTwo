<?php
require_once '../modelo/MCategoria.php';
class CCategoria {
    private $categoria;
    function __construct() {
        $this->categoria=new MCategoria();
    }
    public function mostrarCategoria(){
        return $this->categoria->mostrarCategoria();
    }
    public function insertCategoria($codCategoria, $nombre,$descripcion,$estado){
        $this->categoria->setCodCategoria($codCategoria);
        $this->categoria->setNombre_c($nombre);
        $this->categoria->setDescripcion_c($descripcion);
        $this->categoria->setEstado($estado);
        $this->categoria->insertCategoria();
    }
}
