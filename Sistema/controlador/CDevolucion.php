<?php
require_once '../modelo/MDevolucion.php';
require_once '../modelo/MLibro.php';
require_once '../modelo/MPrestamo.php';
class CDevolucion {
    private $devolucion;
    private $libro;
    private $prestamo;
    function __construct() {
        $this->devolucion=new MDevolucion();
        $this->libro=new MLibro();
        $this->prestamo=new MPrestamo();
        
    }
    public function insertDevolucion($codPrestamo,$fechaDevollucion, $glosaDevolucion,$codLibro){
        $this->devolucion->setCodPrestamo($codPrestamo);
        $this->devolucion->setFechaDevollucion($fechaDevollucion);
        $this->devolucion->setGlosaDevolucion($glosaDevolucion);
        $this->devolucion->insertDevolucion();
        $this->prestamo->setCodPrestamo($codPrestamo);
        $this->prestamo->estadoInactivo();
        $this->libro->agregarEjemplar($codLibro);
        
    }
    public function mostrarDevolucion(){
        return $this->devolucion->mostrarDevolucion();
    }
}
