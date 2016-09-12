<?php
require_once '../modelo/MReserva.php';
class CReserva {
    private $reserva;
    function __construct() {
        $this->reserva=new MReserva();
    }
    public function listReserva(){
        return $this->reserva->listReserva();
    }
    public function insertReserva($fechaReserva,$fechaLimite,$estado,$codLibro, $registro){
        $this->reserva->setFechaReserva($fechaReserva);
        $this->reserva->setFechaLimite($fechaLimite);
        $this->reserva->setEstado($estado);
        $this->reserva->insertReserva($codLibro, $registro);
    }
}
