<?php

require '../controlador/CLibro.php';
$titulo = $_GET['nombre_libro'];
$numero_pag = $_GET['numero_pag'];
$añoEdicion = $_GET['año_eddicion'];
$cantidad = $_GET['cantidad_ejem'];
$estado = $_GET['estado_libro'];
$codAutor = $_GET['autor'];
$codEditorial = $_GET['editorial'];
$codCategoria = $_GET['categoria'];

$libro = new CLibro();
$res=  mysql_fetch_array($libro->maxRegistro());
$codLibro=$res[0];
$result=  mysql_fetch_array($libro->leerRegistro($codLibro, $titulo));

if($result[0]== 0 && $result[1] == '' ) {
    $libro->isertarLibro($codLibro,$titulo, $numero_pag, $añoEdicion, $cantidad, $estado, $codAutor, $codEditorial, $codCategoria);
header('Location: ../vista/libro_add.php?mensage');
}  else {
    header('Location: ../vista/libro_add.php?mensaje&libro='.$result[1]);
}


