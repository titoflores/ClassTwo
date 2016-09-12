<?php

require_once '../controlador/CMulta.php';
require_once '../controlador/CDevolucion.php';
$multa = new CMulta();
$dev = new CDevolucion();

echo'codPrestamo' . $codPrestamo = $_GET['codPrestamo'];
echo'fechadevolucion' . $fechaDevollucion = $_GET['fechaDevollucion'];
echo 'glosa' . $glosaDevolucion = $_GET['glosaDevolucion'];
echo 'codLibro' . $codLibro = $_GET['codLibro'];

echo $dev->insertDevolucion($codPrestamo, $fechaDevollucion, $glosaDevolucion, $codLibro);
echo $codLibroBaja = $_GET['codLibroBaja'];
echo $descripcionMulta = $_GET['descripcionMulta'];
echo $precioMulta = $_GET['precioMulta'];
echo $estadoMulta = $_GET['estadoMulta'];

echo $multa->insertMulta($descripcionMulta, $precioMulta, $estadoMulta, $codPrestamo, $codLibroBaja);

if ($codLibroBaja == 'NO') {
    header('Location: ../vista/listaLibros.php?positivo= Se registro devolucion y la multa');
} else {
    header('Location: ../vista/listaLibros.php?positivo= Se registro devolucion , la multa y se dio de baja el ejemplar');
}

 