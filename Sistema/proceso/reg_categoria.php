<?php
require_once '../controlador/CCategoria.php';
$codCategoria=$_GET['codCategoria'];
$nombre_c=$_GET['nombre'];
$descripcion_c=$_GET['descripcion'];
$estado=$_GET['estado'];

$cat=new CCategoria();
$cat->insertCategoria($codCategoria, $nombre_c, $descripcion_c, $estado);
header('Location: ../vista/libro_add.php');