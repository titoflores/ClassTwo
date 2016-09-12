<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location:../login.php");
}
require_once '../controlador/CLibro.php';


$libro = new CLibro();

$result = $libro->leerLibro();
?>

<!DOCTYPE html>
<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>InfoBeth - Panel de Administración</title>

        <!-- Core CSS - Include with every page -->
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
                    <a class="navbar-brand">Panel de Administración</a>
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
                        <h3 class="page-header">Libro » Listar Libros</h3>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Lista de Libros
                            </div>
                            <?php if (isset($_GET['positivo'])) { ?>
                                <div class="alert alert-success">
                                    Se procedio la accion <strong class="mayuscula"><?php echo $_GET['positivo'];?></strong>.

                                </div>
                                <?php
                            }
                            ?>
                            <?php if (isset($_GET['error'])) { ?>
                                <div class="alert alert-warning">
                                    Error no se Pudo Actualizar Cantidad Verifique Si <strong> Selecciono </strong> el Libro..!
                                </div>
                                <?php
                            }
                            ?>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th>Libro</th>
                                                <th># de Paginas</th>
                                                <th>Año de Edicion</th>
                                                <th># Ejemplares</th>
                                                <th>Autor</th>
                                                <th>Editorial</th>
                                                <th>Categoria</th>
                                                <th>Opcion</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php while ($row = mysql_fetch_array($result)) { ?>
                                                <tr class="odd gradeX">
                                            <form method="GET" action="../proceso/update_libro.php">
                                                <td><?php echo $row['nombreLibro']; ?></td>
                                                <td>
                                                    <?php echo $row['numeroPag']; ?></td>
                                                <td><?php echo $row['ano_edicion']; ?></td>
                                                <td> <input name="num_ejemplar" type="number" class="col-md-7 text-primary" value="<?php echo $row['num_ejemplares']; ?>"></td>
                                                <td><?php echo $row['nombreAutor']; ?></td>
                                                <td><?php echo $row['nombreEditorial']; ?></td>
                                                <td><?php echo $row['nombre_c']; ?></td>
                                                <td><input name="codLibro" type="hidden" value="<?php echo $row['codLibro']; ?>"><input type="submit" class="btn btn-outline btn-primary" value="UPDATE"> </td>  
                                            </form>
                                            </tr>

                                        <?php } ?>
                                        </tbody>

                                    </table>

                                </div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>

            <div id="meditorial" class="modal fade bs-example-modal-sm panel-primary" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                <div class="modal-dialog modal-sm">
                    <div class="panel panel-primary">
                        <form action="../proceso/reg_editorial.php" method="GET">
                            <div class="modal-content panel panel-primary">
                                <div class="modal-header panel-primary">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h3 class="modal-title">Registrar Editorial</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="row">

                                        <div class="col-sm-12">

                                            <div class="form-group input-group">
                                                <span class="input-group-addon">»</span>
                                                <input name="nombre" type="text" class="form-control" placeholder="Nombre de la Editorial" required="" autofocus="">
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">»</span>
                                                <input name="descripcion" type="text" class="form-control" placeholder="Descripcion" required="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" value="Registrar">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>






        <!-- /#wrapper -->

        <!-- Core Scripts - Include with every page -->
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