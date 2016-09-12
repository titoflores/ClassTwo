<?php

require_once '../modelo/MBibliotecario.php';

class CBibliotecario {

    private $biblitecario;

    function __construct() {
        $this->biblitecario = new MBibliotecario();
    }

    public function authLogin($email, $password) {
        $this->biblitecario->setUsuario($email);
        $this->biblitecario->setClave($password);
        return $this->biblitecario->validarLogin();
    }

    public function insertBibliotecario($usuario, $clave, $turno, $estado, $nombres, $apellidos, $sexo, $telefono, $email, $fechaNacim) {

        $this->biblitecario->setUsuario($usuario);
        $this->biblitecario->setClave($clave);
        $this->biblitecario->setTurno($turno);
        $this->biblitecario->setEstado($estado);
        $this->biblitecario->setNombres($nombres);
        $this->biblitecario->setApellidos($apellidos);
        $this->biblitecario->setSexo($sexo);
        $this->biblitecario->setTelefono($telefono);
        $this->biblitecario->setEmail($email);
        $this->biblitecario->setFechaNacim($fechaNacim);
        $this->biblitecario->createPersona();
        $this->biblitecario->insertBibliotecario();
    }

}
