<?php

require_once '../modelo/MCalendario.php';

class CCalendario {

    private $calendario;

    function __construct() {
        $this->calendario = new MCalendario();
    }
    public function fechaActual(){
        return $this->calendario->fechaActual();
    }
    public function readCalendario(){
        return $this->calendario->readCalendario();
    }
    
    public function buscarFechaCalendario($fecha){
        $this->calendario->setFecha($fecha);
        return $this->calendario->buscarFechaCalendario();
    }

}
