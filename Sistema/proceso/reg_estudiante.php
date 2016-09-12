<?php
require_once '../controlador/CEstudiante.php';
$codPersona=$_GET[''];
$registro=$_GET[''];
$fechaInicio=$_GET[''];
$fechaCulminacion=$_GET[''];
$estado=$_GET[''];
$nombres=$_GET[''];
$apellidos=$_GET[''];
$sexo=$_GET[''];
$telefono=$_GET[''];
$email=$_GET[''];
$fechaNacim=$_GET[''];
$estudiante=new CEstudiante();
$estudiante->insertEstudiante($codPersona, $registro, $fechaInicio, $fechaCulminacion, $estado, $nombres, $apellidos, $sexo, $telefono, $email, $fechaNacim);


