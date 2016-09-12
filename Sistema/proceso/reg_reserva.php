<?php
require_once '../controlador/CReserva.php';

echo $fechaReserva=$_GET['fechaReserva'];
echo $fechaLimite=$_GET['fechaLimite'];
echo $estado='A';
echo $codLibro=$_GET['codLibro'];
echo $registro=$_GET['registro'];

$reserva=new CReserva();
$reserva->insertReserva($fechaReserva, $fechaLimite, $estado, $codLibro, $registro);


header('Location: ../vista/listaReservas.php');
