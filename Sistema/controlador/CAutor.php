<?php
require_once '../modelo/MAutor.php';
class CAutor {
    private $autor;
    function __construct() {
        $this->autor = new MAutor();
    } 
    public function mostrarAutor(){
        return $this->autor->mostrarAutor();
    }
    public function mostrarRegistro($nombre){
        $this->autor->setAutor($nombre);
        return $this->autor->mostrarRegistro();
    }
    public function insertAutor($nombre, $nacionalidad,$fechaNacim){
        $this->autor->setAutor($nombre);
        $this->autor->setNacionalidad($nacionalidad);
        $this->autor->setFechaNacimiento($fechaNacim);
        $this->autor->insertarAutor();
    }
}
