<?php

require_once '../controlador/CDevolucion.php';

$devolucion = new CDevolucion();
$codPrestamo = $_GET['codPrestamo'];
$fechaDevollucion = $_GET['fechaDevolucion'];
$glosaDevolucion = $_GET['glosaDevolucion'];
$codLibro = $_GET['codLibro'];
$nombreLibro=$_GET['nombreLibro'];

$conDeuda = $_GET['agregaDeuda'];
    if ($conDeuda == 'SI') {
        echo 'Direccionar abrir forulario de deuda';
        header('Location: ../vista/devolucion_add.php?codPrestamo='.$codPrestamo.'&codLibro='.$codLibro.'&glosaDevolucion='.$glosaDevolucion.'&multa'.'&nombreLibro='.$nombreLibro.'&checked=checked');
    } elseif ($conDeuda == 'NO') {
        $devolucion->insertDevolucion($codPrestamo, $fechaDevollucion, $glosaDevolucion, $codLibro);
        header('Location: ../vista/listaLibros.php?positivo= deDevolucion con exito'.$nombreLibro);
    }


//?codPrestamo='.$codPrestamo.'&codLibro='.$codLibro.'&glosaDevolucion='.$glosaDevolucion.'&multa'.'&nombreLibro='.$nombreLibro.'&checked=checked'