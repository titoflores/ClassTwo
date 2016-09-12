<?php

require_once '../controlador/CBibliotecario.php';

$usuario=$_GET['usuario'];
$clave=$_GET['clave'];
$turno=$_GET['turno'];
$estado=$_GET['estado'];
$nombres=$_GET['nombres'];
$apellidos=$_GET['apellidos'];
$sexo=$_GET['sexo'];
$telefono=$_GET['telefono'];
$email=$_GET['email'];
$fechaNacim=$_GET['fechaNacim'];

$biblio=new CBibliotecario();
$biblio->insertBibliotecario($usuario, $clave, $turno, $estado, $nombres, $apellidos, $sexo, $telefono, $email, $fechaNacim);
