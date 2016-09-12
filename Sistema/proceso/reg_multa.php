<?php

require_once '../controlador/CMulta.php';

$descripcionMulta = $_GET['descripcionMulta'];
$precioMulta = $_GET['precio'];
$estado=$_GET['estado'];
$cancelado=$_GET['cancelado'];
$codPrestamo = $_GET['codPrestamo'];
$multa = new CMulta();
$multa->insertMulta($descripcionMulta, $precioMulta, $estado, $cancelado, $codPrestamo);
