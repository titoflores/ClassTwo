<?php

require_once '../modelo/MPrestamo.php';
require_once '../modelo/MLibro.php';

class CPrestamo {

    private $prestamo;
    private $libro;

    function __construct() {
        $this->prestamo = new MPrestamo();
        $this->libro=new MLibro();
    }
    public function insertPrestamo($fechaSalida,$fechaDevolucion,$notaGlosa, $estado, $registroEstudiante,$usuario_bibli,$codLibro ){
        $this->prestamo->setFechaSalida($fechaSalida);
        $this->prestamo->setFechaDevolucion($fechaDevolucion);
        $this->prestamo->setNotaGlosa($notaGlosa);
        $this->prestamo->setEstado($estado);
        $this->prestamo->setRegistroEstudiante($registroEstudiante);
        $this->prestamo->setUsuario_bibli($usuario_bibli);
        $this->prestamo->setCodLibro($codLibro);
        $this->libro->descontarEjemplar($codLibro);
        $this->prestamo->insertPrestamo();
    }
    public function mostrarPrestamo(){
        return $this->prestamo->mostrarPrestamo();
    }
    
     public function showPrestamoEstudiante($registro){
         $this->prestamo->setRegistroEstudiante($registro);
        return $this->prestamo->ShowPrestamoEstudiante();
    }
}
