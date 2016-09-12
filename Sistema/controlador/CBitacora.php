<?php
require_once '../modelo/MBitacora.php';
class CBitacora {
    private $bit;
    function __construct() {
        $this->bit=new MBitacora();
    }
    public function mostrarBitacora(){
        return $this->bit->mostrarBitacora();
    }
}
