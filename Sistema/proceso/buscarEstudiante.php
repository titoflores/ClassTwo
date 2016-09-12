<?php
require_once '../controlador/CEstudiante.php';
$registro = $_GET['registro'];

$est=new CEstudiante();
$result=  mysql_fetch_array($est->buscarEstudiante($registro));
if($result[0]!=0){
     header('Location: ../vista/reserva_add.php?registro='.$result[0].'&nombres='.$result[1].'&apellidos='.$result[2].'&estado='.$result[3]);
}
else
{
    header('Location: ../vista/reserva_add.php?mesage');
}
   