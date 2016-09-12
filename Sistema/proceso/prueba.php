<?php

require_once '../controlador/CCalendario.php';
$result = new CCalendario();
$resultado = mysql_fetch_array($result->fechaActual());

echo $resultado[0];
