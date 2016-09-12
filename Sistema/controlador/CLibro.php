<?php

require_once '../modelo/MLibro.php';

class CLibro {

    private $libro;

    function __construct() {
        $this->libro = new MLibro();
    }

    //Operacioes CRUD Libro
    public function isertarLibro($codLibro,$titulo,$numero_pag,$añoEdicion,$cantidad,$estado,$codAutor,$codEditorial,$codCategoria){
        $this->libro->setCodLibro($codLibro);
        $this->libro->setTitulo($titulo);
        $this->libro->setNumero_pag($numero_pag);
        $this->libro->setAñoEdicion($añoEdicion);
        $this->libro->setCantidad($cantidad);
        $this->libro->setEstado($estado);
        $this->libro->setCodAutor($codAutor);
        $this->libro->setCodEditorial($codEditorial);
        $this->libro->setCodCategoria($codCategoria);
        $this->libro->createLibro();
    }

    public function modificarLibro($codLibro, $cantidad) {
        $this->libro->setCodLibro($codLibro);
        $this->libro->setCantidad($cantidad);
        $this->libro->updateLibro();
    }

    public function leerLibro() {
        return $this->libro->readLibro();
    }

    public function eliminarLibro($codLibro) {
        $this->libro->setCodLibro($codLibro);
        $this->libro->deleteLibro();
    }
    public function  leerRegistro($codLibro,$titulo) {
        $this->libro->setTitulo($titulo);
        $this->libro->setCodLibro($codLibro);
        return $this->libro->readRegistro();
    }
    public function consultatRegistro($codLibro) {
        $this->libro->setCodLibro($codLibro);
        return $this->libro->consultatRegistro();
    }
    public function consultaPalabra($palabra) {
        return $this->libro->consultaPlabra($palabra);
    }
    public function maxRegistro() {
        return $this->libro->maxRegistro();
    }

}
