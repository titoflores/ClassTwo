<?php
require_once '../controlador/CEditorial.php';
$editorial=$_GET['nombre'];
$descripcion=$_GET['descripcion'];

$edi=new CEditorial();
$edi->insertarEditorial($editorial, $descripcion);
header('Location: ../vista/libro_add.php');