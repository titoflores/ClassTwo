<?php

require_once '../controlador/CLibro.php';
echo $codLibro = $_GET['codLibro'];
echo $cantidad = $_GET['num_ejemplar'];

$libro = new CLibro();
    $libro->modificarLibro($codLibro, $cantidad);
 header('Location: ../vista/listaLibros.php?positivo= de actualizar cantidad correctamente');
