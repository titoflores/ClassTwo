<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location:../login.php");
}
require_once '../controlador/CEstudiante.php';
require_once '../controlador/CLibro.php';
require_once '../controlador/CCalendario.php';
$resultcal = new CCalendario();
$resultadocal = mysql_fetch_array($resultcal->fechaActual());
$estudiante = new CEstudiante();
$libro = new CLibro();
$result = mysql_fetch_array($estudiante->buscarEstudiante($_GET['registro']));
$resultado = mysql_fetch_array($libro->consultatRegistro($_GET['codLibro']));
?>
<!DOCTYPE html>
<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>INFOBETH - ADMINISTRACION</title>

        <link href="../bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap-3.3.5-dist/font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- Page-Level Plugin CSS - Tables -->
        <link href="../bootstrap-3.3.5-dist/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- SB Admin CSS - Include with every page -->
        <link href="../bootstrap-3.3.5-dist/css/sb-admin.css" rel="stylesheet">
    </head>

    <body>

        <div id="wrapper">

            <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand">ADMINISTRACION INFOBETH</a>
                </div>
                <!-- /.navbar-header -->
                <ul class="nav navbar-top-links navbar-right">
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><small><?php echo $_SESSION['usuario']; ?></small>
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configuración</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="../closeLogin.php"><i class="fa fa-sign-out fa-fw"></i> Cerrar Sesión</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default navbar-static-side" role="navigation">
                    <div class="sidebar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> PRINCIPAL</a>
                            </li>
                            <li>
                                <a href="forms.html"><i class="fa fa-bar-chart-o fa-fw"></i> BIBLIOTECA<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="#">Material Fisico <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="libro_add.php"> ▪ Añadir Libro</a>
                                            </li>
                                            <li>
                                                <a href="listaLibros.php"> ▪ Listar Libro</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Material Digital <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="#">▪ Añadir Material</a>
                                            </li>
                                            <li>
                                                <a href="#">▪ Listar Material</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>                        
                            <li>
                                <a href="tables.html"><i class="fa fa-edit fa-fw"></i> PRESTAMO<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="prestamo_add.php">Registrar Prestamo</a>
                                    </li>
                                    <li>
                                        <a href="listaPrestamos.php">Lista de Prestamo</a>
                                    </li>
                                </ul>                            
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-sitemap fa-fw"></i> DEVOLUCION<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="Devolucion_ad.php">Registrar Devolucion</a>
                                    </li>
                                    <li>
                                        <a href="../vista/listaDevolucion.php">Listar devolucion</a>
                                    </li>
                                    <li>
                                        <a href="../vista/listaMultas.php">Listar Multas</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-archive fa-fw"></i> RESERVA<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="../vista/reserva_add.php">Registrar Reserva</a>
                                    </li>
                                    <li>
                                        <a href="listaReservas.php">Listar de Reservas</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-key fa-fw"></i> SEGURIDAD<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="listaBitacora.php">Listar Bitacora</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">REGISTRO DE PRESTAMO</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">



                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        REGISTRO DE PRESTAMO
                                    </div>
                                    <div class="panel-body">
                                        <form name="" method="GET" action="../proceso/reg_prestamo.php">
                                            <table class="table">
                                                <tr>
                                                    <?php 
                                                   
                                                    ?>
                                                    <td>FECHA DE SALIDA:</td>
                                                    <td>&nbsp;<?php $fecha= $resultadocal[0];
                                                    echo $resultadocal[0]; 
                                                    ?>
                                                        <input  type="hidden" name="fechaSalida" value="<?php echo $resultadocal[0]; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td>FECHA DE DEVOLUCION: </td>
                                                    <td>
                                                        <?php
                                                        $nuevafecha = strtotime('+03 day', strtotime($fecha));
                                                        $nuevafecha = date('Y-m-d', $nuevafecha);
                                                        ?>
                                                        <input  type="date" name="fechaDevolucion" class="form-control" value="<?php echo $nuevafecha ?>" autofocus=""  >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>REGISTRO:</td>
                                                    <td>&nbsp;<?php echo $result[0]; ?>&nbsp;
                                                        <input  type="hidden" name="registroEstudiante" value="<?php echo $result[0]; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>NOMBRE Y APELLIDO</td>
                                                    <td>&nbsp;<?php echo $result[1]; ?>&nbsp;<?php echo $result[2]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>CODIGO DE LIBRO:</td>
                                                    <td>&nbsp;<?php echo $resultado[0]; ?>&nbsp;
                                                        <input  type="hidden" name="codLibro" value="<?php echo $resultado[0]; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>NOMBRE DE LIBRO:</td>
                                                    <td>&nbsp;<?php echo $resultado[1]; ?>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>AUTOR:</td>
                                                    <td>&nbsp;<?php echo $resultado[2]; ?>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>CATEGORIA:</td>
                                                    <td>&nbsp;<?php echo $resultado[3]; ?>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>USUARIO</td>
                                                    <td>&nbsp;<?php echo $_SESSION['usuario']; ?>&nbsp;
                                                        <input  type="hidden" name="usuario_bibli" value="<?php echo $_SESSION['usuario']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">

                                                        <span class="input-group-addon">Nota</span>
                                                        <textarea name="notaGlosa" type="text" rows="3" class="form-control" placeholder="Describa una nota dePrestamo" autofocus=""></textarea>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <button type="submit" class="btn btn-primary">Registrar</button>
                                                        <button type="button" value="" onclick="history.go(-1)" class="btn btn-default">Atras</button>
                                                    </td>
                                                    <td>
                                                        &nbsp;&nbsp;
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
                                    <div class="panel-footer">
                                        <p><strong>Nota: </strong>Recuerde verificar bien los datos antes de validar el formulario</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#wrapper -->

        <script src="../bootstrap-3.3.5-dist/js/jquery-1.10.2.js"></script>
        <script src="../bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
        <script src="../bootstrap-3.3.5-dist/js/plugins/metisMenu/jquery.metisMenu.js"></script>

        <!-- Page-Level Plugin Scripts - Tables -->
        <script src="../bootstrap-3.3.5-dist/js/plugins/dataTables/jquery.dataTables.js"></script>
        <script src="../bootstrap-3.3.5-dist/js/plugins/dataTables/dataTables.bootstrap.js"></script>

        <!-- SB Admin Scripts - Include with every page -->
        <script src="../bootstrap-3.3.5-dist/js/sb-admin.js"></script>

        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
                                                            $(document).ready(function () {
                                                                $('#dataTables-example').dataTable();
                                                            });
        </script>

    </body>

</html>
