<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location:../login.php");
}
?>
<!DOCTYPE html>
<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> InfoBeth - Panel de Administración</title>
        <link href="../bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap-3.3.5-dist/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="../bootstrap-3.3.5-dist/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
        <link href="../bootstrap-3.3.5-dist/css/sb-admin.css" rel="stylesheet">
        <!-- mis Stilos css -->
        <link rel="stylesheet" href="../bootstrap-3.3.5-dist/css/style.css"/>

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
                                        <a href="#">Registrar Prestamo</a>
                                    </li>
                                    <li>
                                        <a href="#">Lista de Prestamo</a>
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
        </nav>

        <form role="form" method="GET" action="../proceso/reg_multa.php">
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">Biblioteca » Realizar Prestamo</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="mayuscula"> <strong> <?php echo $_GET['notaGlosa']; ?></strong>.</div>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><abbr title="Nombre de la Multa">NM</abbr></span>
                                    <input name="nombreMulta" type="text" class="form-control" placeholder="Nombre de la Multa">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><abbr title="Descripcion de la Multa">DM</abbr></span>
                                    <input name="descripcionMulta" type="text" class="form-control" placeholder="Descripcion de la Multa">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><abbr title="Precio de la Multa">PM</abbr></span>
                                    <input name="precio" type="number" class="form-control" placeholder="Precio de la Multa">
                                </div>
                                <div>
                                    <input type="hidden" name="codPrestamo" value="<?php echo $_GET['codPrestamo']; ?>">
                                </div>
                                <button type="submit" class="btn btn-primary">Registrar</button>
                                <button type="reset" class="btn btn-default">Restaurar</button>
                            </div>
                        </div>
                    </div>
                </div> 
                 <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="mayuscula"> <strong> AGREGAR MULTA</strong>.</div>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><abbr title="Nombre de la Multa">NM</abbr></span>
                                    <input name="nombreMulta" type="text" class="form-control" placeholder="Nombre de la Multa">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><abbr title="Descripcion de la Multa">DM</abbr></span>
                                    <input name="descripcionMulta" type="text" class="form-control" placeholder="Descripcion de la Multa">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><abbr title="Precio de la Multa">PM</abbr></span>
                                    <input name="precio" type="number" class="form-control" placeholder="Precio de la Multa">
                                </div>
                                <div>
                                    <input type="hidden" name="codPrestamo" value="<?php echo $_GET['codPrestamo']; ?>">
                                </div>
                                <button type="submit" class="btn btn-primary">Registrar</button>
                                <button type="reset" class="btn btn-default">Restaurar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="../bootstrap-3.3.5-dist/js/jquery-1.10.2.js"></script>
    <script src="../bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
    <script src="../bootstrap-3.3.5-dist/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../bootstrap-3.3.5-dist/js/sb-admin.js"></script>
</body>

</html>
