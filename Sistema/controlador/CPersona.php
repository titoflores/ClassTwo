<?php
require_once '../modelo/MPersona.php';

class CPersona {
    private $persona;
    function __construct() {
        $this->persona=new MPersona();
    }
    //Operaciones CRUD Clase Persona
    public function crearPersona($nombres,$apellidos,$sexo,$telefono,$email,$fechaNacim){
        $this->persona->setNombres($nombres);
        $this->persona->setApellidos($apellidos);
        $this->persona->setSexo($sexo);
        $this->persona->setTelefono($telefono);
        $this->persona->setEmail($email);
        $this->persona->setFechaNacim($fechaNacim);
        $this->persona->createPersona();
    }
    public function updatePersona($nombres,$apellidos,$sexo,$telefono,$email,$fechaNacim){
        $this->persona->setNombres($nombres);
        $this->persona->setApellidos($apellidos);
        $this->persona->setSexo($sexo);
        $this->persona->setTelefono($telefono);
        $this->persona->setEmail($email);
        $this->persona->setFechaNacim($fechaNacim);
        $this->persona->updatePersona();
    }
    public function leerPersona() {
        return $this->persona->readPersona();
    }
    public function eliminarPersona($codPersona) {
        $this->persona->setCodPersona($codPersona);
        $this->persona->deletePersona();
    } 
}
