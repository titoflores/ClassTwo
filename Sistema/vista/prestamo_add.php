<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location:../login.php");
}
require_once '../controlador/CEstudiante.php';
require_once '../controlador/CLibro.php';
if (isset($_GET['registro'])) {
    $estudiante = new CEstudiante();
    $resultado = mysql_fetch_array($estudiante->buscarEstudiante($_GET['registro']));
    if (isset($_GET['palabra'])) {
        $libro = new CLibro();
        $result = $libro->consultaPalabra($_GET['palabra']);
    }
}
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
                        <h3 class="page-header">REGISTRO DE PRESTAMO </h3>
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
                                        <div class="row">

                                            <div class="col-xs-6">
                                                <form name="#" action="prestamo_add.php" method="GET">
                                                    <div class="form-group input-group">
                                                        <label>Buscar Estudiante</label>
                                                        <div class="input-group custom-search-form">

                                                            <input type="number" name="registro" value="<?php
                                                            if (isset($resultado[0])) {
                                                                echo $resultado[0];
                                                            }
                                                            ?>" required="true" id="registro"class="form-control" placeholder="Search Registro" <?php
                                                                   if (isset($resultado[0])) {
                                                                       echo 'disabled';
                                                                   }
                                                                   ?>>
                                                            <span class="input-group-btn">

                                                                <button class="btn btn-primary" type="submit" id="boton">
                                                                    <i class="fa fa-search"></i>
                                                                </button>
                                                            </span>

                                                        </div>
                                                        <!-- /input-group -->
                                                    </div>
                                                </form>
                                            </div>
                                            <?php if (isset($resultado[0])) { ?>
                                                <div class="col-xs-6">
                                                    <form name="form" method="GET" action="">
                                                        <label>Buscar Libro</label>
                                                        <div class="form-group input-group">

                                                            <div class="input-group custom-search-form">
                                                                <input  type="hidden" name="registro" value="<?php echo $resultado[0]; ?>">
                                                                <input type="text" name="palabra" value="<?php
                                                            if (isset($_GET['palabra'])) {
                                                                echo $_GET['palabra'];
                                                            }
                                                            ?>"class="form-control" placeholder="Search palabra" required="">
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-primary" type="submit">
                                                                        <i class="fa fa-search"></i>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            <?php } ?>
                                            <div class="col-xs-12">

                                                <div class="panel panel-primary">
                                                    <div class="panel-heading">
                                                        Datos del Estudiante
                                                    </div>
                                                    <div class="panel-body">

                                                        <strong>Registro:</strong>&nbsp;&nbsp;&nbsp; 
                                                        <?php
                                                        if (isset($resultado[0])) {
                                                            echo $resultado[0];
                                                        }
                                                        ?><br> 
                                                        <strong>Nombre y apellido:</strong>&nbsp;&nbsp;&nbsp; 
                                                        <?php
                                                        if (isset($resultado[1])) {
                                                            echo $resultado[1] . '&nbsp;' . $resultado[2];
                                                        }
                                                        ?><br>
                                                        <strong>Estado:</strong>&nbsp;&nbsp;&nbsp;
                                                        <?php
                                                        if (isset($resultado[3])) {
                                                            if ($resultado[3] == 'A') {
                                                                echo 'Activo';
                                                            }
                                                            if ($resultado[3] == 'I') {
                                                                echo 'Inactivo';
                                                            }
                                                        }
                                                        ?>


                                                    </div>
                                                    <div class="panel-footer">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form name="" method="GET" action="realizar_add.php">
                                            <div class="panel-body">
                                                <div class="dataTable_wrapper">
                                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                        <thead>
                                                            <tr class="bg-primary">
                                                                <th>Opcion</th>
                                                                <th>Codigo</th>
                                                                <th>Libro</th>
                                                                <th>Categoria</th>
                                                                <th>Autor</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if (isset($_GET['palabra'])) {
                                                                while ($row = mysql_fetch_array($result)) {
                                                                    ?>
                                                                    <tr class="odd gradeX">
                                                                        <td>
                                                                            <div class="checkbox">
                                                                                <label>
                                                                                    <input type="radio" name="codLibro" value="<?php echo $row['codLibro']; ?>"  <?php if (isset($_GET['checked'])) { echo $_GET['checked'];} ?>>Prestar
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td><?php echo $row['codLibro']; ?></td>
                                                                        <td><?php echo $row['nombreLibro']; ?></td>
                                                                        <td><?php echo $row['nombre_c']; ?></td>
                                                                        <td><?php echo $row['nombreAutor']; ?></td>
    <?php }
} ?>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.table-responsive -->
                                            </div>
                                            <input  type="hidden" name="registro" value="<?php echo $resultado[0]; ?>">
                                         <button type="submit" class="btn btn-primary">Registrar</button>
                                        </form>
                                        tabla fin
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
