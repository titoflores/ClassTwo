<?php

require_once '../controlador/CPrestamo.php';
require_once '../controlador/CCalendario.php';
require_once '../controlador/CEstudiante.php';
$fechaSalida = $_GET['fechaSalida'];
$fechaDevolucion = $_GET['fechaDevolucion'];
$notaGlosa = $_GET['notaGlosa'];
$estado = 'A';
$registroEstudiante = $_GET['registroEstudiante'];
$usuario_bibli = $_GET['usuario_bibli'];
$codLibro = $_GET['codLibro'];
$prestamo = new CPrestamo();
//buscando fecha feriado
$calendario = new CCalendario();
$resultado = $calendario->buscarFechaCalendario($fechaDevolucion);
$result = mysql_fetch_array($resultado);
//buscando si tiene prestamo
$estudiante = new CEstudiante();
$resMulta = mysql_fetch_array($estudiante->tieneMulta($registroEstudiante));
$resPres = mysql_fetch_array($estudiante->tienePrestamo($registroEstudiante));

if (count($resMulta) == 1) {

    if (count($resPres) == 1) {
        if ($fechaDevolucion == $result[1]) {
            header('Location: ../vista/feriado_page.php?fecha=' . $result[1]);
        } else {
            $prestamo->insertPrestamo($fechaSalida, $fechaDevolucion, $notaGlosa, $estado, $registroEstudiante, $usuario_bibli, $codLibro);
            header('Location: ../vista/listaPrestamos.php?mensage');
        }
    } else {
        header('Location: ../vista/listaPrestamos.php?prestamo='.$registroEstudiante);
    }
} else {
    header('Location: ../vista/listaMultas.php?multa='.$registroEstudiante);
}

//if ($fechaDevolucion == $result[1]) {
//    header('Location: ../vista/feriado_page.php?fecha=' . $result[1]);
//} else {
//    $prestamo->insertPrestamo($fechaSalida, $fechaDevolucion, $notaGlosa, $estado, $registroEstudiante, $usuario_bibli, $codLibro);
//    header('Location: ../vista/listaPrestamos.php?mensage');
//}