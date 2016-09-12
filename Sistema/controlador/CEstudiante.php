<?php

require_once '../modelo/MEstudiante.php';

class CEstudiante {

    private $estudiante;

    function __construct() {
        $this->estudiante = new MEstudiante();
    }

    public function insertEstudiante($codPersona, $registro, $fechaInicio, $fechaCulminacion, $estado, $nombres, $apellidos, $sexo, $telefono, $email, $fechaNacim) {

        $this->estudiante->setCodPersona($codPersona);
        $this->estudiante->setRegistro($registro);
        $this->estudiante->setFechaInicio($fechaInicio);
        $this->estudiante->setFechaCulminacion($fechaCulminacion);
        $this->estudiante->setEstado($estado);
        $this->estudiante->setNombres($nombres);
        $this->estudiante->setApellidos($apellidos);
        $this->estudiante->setSexo($sexo);
        $this->estudiante->setTelefono($telefono);
        $this->estudiante->setEmail($email);
        $this->estudiante->setFechaNacim($fechaNacim);
        $this->estudiante->createPersona();
        $this->estudiante->insertEstudiante();
    }

    public function buscarEstudiante($registro) {
        $this->estudiante->setRegistro($registro);
        return $this->estudiante->buscarEstudiante();
    }
    public function tieneMulta($registro){
        $this->estudiante->setRegistro($registro);
        return $this->estudiante->tieneMulta();
    }
    public function tienePrestamo($registro){
        $this->estudiante->setRegistro($registro);
        return $this->estudiante->tienePrestamo();
    }

}
