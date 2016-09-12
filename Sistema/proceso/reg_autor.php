<?php
require_once '../controlador/CAutor.php';
$nombre= $_GET['nombre'];
$nacionalidad= $_GET['nacionalidad'];
$fechaNacim=$_GET['fecha_nacim'];

$autor=new CAutor();
$resultado=  mysql_fetch_array($autor->mostrarRegistro($nombre));

if($resultado[0]== 0 && $resultado[1]==''){
    $autor->insertAutor($nombre, $nacionalidad, $fechaNacim);
    header('Location: ../vista/libro_add.php');
}
else
{
    header('Location: ../vista/libro_add.php?mensaje&autor='.$resultado[1]);
}
