<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location:../login.php");
}

require_once '../controlador/CAutor.php';
require_once '../controlador/CEditorial.php';
require_once '../controlador/CCategoria.php';
?>
<!DOCTYPE html>
<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Unibeth - Panel de Administración</title>
        <link href="../bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap-3.3.5-dist/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="../bootstrap-3.3.5-dist/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
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
        </nav>

        <form role="form" method="GET" action="../proceso/regLibro.php">
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">Biblioteca » Añadir Libro</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Por favor, verifique los datos antes de presionar el boton <strong>Registrar</strong>.
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="form-group input-group">
                                    <span class="input-group-addon">»</span>
                                    <input name="nombre_libro" type="text" class="form-control" placeholder="Nombre del Libro" required="" autofocus="">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">»</span>
                                    <input name="numero_pag" type="number" class="form-control" placeholder="Numero de paginas" required="">
                                </div>
                                <label>Año de Edicion</label>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">»</span>
                                    <input name="año_eddicion" type="date" class="form-control" placeholder="Año de edicion" required="">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">»</span>
                                    <input name="cantidad_ejem" type="number" class="form-control" placeholder="numero de ejemplares" required="">
                                </div>


                                <div class="form-group input-group">
                                    <span class="input-group-addon">»</span>
                                    <select name="estado_libro" id="disabledSelect" class="form-control" required="">
                                        <option class="hide">Seleccione estado</option>
                                        <option value="A">Activo</option>
                                        <option value="I"> Inactivo</option>
                                    </select>
                                </div>
                                <?php
                                $autor = new CAutor();
                                $result = $autor->mostrarAutor();
                                ?>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">»</span>
                                    <table>
                                        <tr>
                                            <td>
                                                <select name="autor" id="disabledSelect" class="form-control" lang="30" required="">
                                                    <option class="hide">Seleccione Autor &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                                    <?php
                                                    while ($list = mysql_fetch_array($result)) {
                                                        $i = 0;
                                                        $j = 1;
                                                        echo '<option value=' . $list[$i] . '> ' . $list[$j] . ' </option>';
                                                        $i++;
                                                        $j++;
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-circle" data-toggle="modal" data-target="#mautor"></a><i class="fa">+</i> </button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <?php
                                $edi = new CEditorial();
                                $resultA = $edi->mostrarEditorial();
                                ?>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">»</span>
                                    <table>
                                        <tr>
                                            <td>
                                                <select name="editorial" id="disabledSelect" class="form-control" required="">
                                                    <option class="hide">Seleccione Editorial &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                                    <?php
                                                    while ($listA = mysql_fetch_array($resultA)) {
                                                        $i = 0;
                                                        $j = 1;
                                                        echo '<option value=' . $listA[$i] . '> ' . $listA[$j] . ' </option>';
                                                        $i++;
                                                        $j++;
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-circle" data-toggle="modal" data-target="#meditorial"></a><i class="fa">+</i> </button>
                                            </td>
                                        </tr>
                                    </table>

                                </div> 
                                <?php
                                $categoria = new CCategoria();
                                $resultC = $categoria->mostrarCategoria();
                                ?>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">»</span>
                                    <table>
                                        <tr>
                                            <td>
                                                <select name="categoria" id="disabledSelect" class="form-control">
                                                    <option class="hide">Seleccione Categoria &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                                    <?php
                                                    while ($listC = mysql_fetch_array($resultC)) {
                                                        $i = 0;
                                                        $j = 1;
                                                        echo '<option value=' . $listC[$i] . '> ' . $listC[$j] . ' </option>';
                                                        $i++;
                                                        $j++;
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-circle" data-toggle="modal" data-target="#mcategoria"></a><i class="fa">+</i> </button>
                                            </td>
                                        </tr>
                                    </table>

                                </div> 
                                <button type="submit" class="btn btn-primary">Registrar</button>
                                <button type="reset" class="btn btn-default">Restaurar</button>
                                <br>
                                <br>
                                <?php
                                if (isset($_GET['mensage'])) {
                                    ?>
                                    <div class="alert alert-success">
                                        Datos Registrado con Exito ver. <a href="listaLibros.php" class="alert-link">Ver en lista</a>.
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                                if (isset($_GET['mensaje'])) {
                                    ?>
                                    <div class="alert alert-danger">
                                        El libro Ya se encuentra Registrado. <strong><?php echo $_GET['libro'] ?></strong>.
                                    </div>
                                    <?php
                                }
                                ?>                               
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </form>

        <!--Primer Formulario registrar autor-->
        <div id="mautor" class="modal fade bs-example-modal-sm panel-primary" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm">
                <div class="panel panel-primary">
                    <form action="../proceso/reg_autor.php" method="GET">
                        <div class="modal-content panel panel-primary">
                            <div class="modal-header panel-primary">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="modal-title">Registrar Autor</h3>
                            </div>
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-sm-12">
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">»</span>
                                            <input name="nombre" type="text" class="form-control" placeholder="Nombre del Autor" required="" autofocus="">
                                        </div>

                                        <div class="form-group input-group">
                                            <span class="input-group-addon">»</span>
                                            <select name="nacionalidad" id="disabledSelect" class="form-control">
                                                <option class="hide">Seleccione Ncionalidad</option>
                                                <option value="A">España</option>
                                                <option value="I"> Estados Unidos</option>
                                                <option value="I"> Mexicano</option>
                                                <option value="I"> Japon</option>
                                                <option value="I"> Corea</option>
                                            </select>
                                        </div>
                                        <h4>Fecha de Nacimiento</h4>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">»</span>
                                            <input name="fecha_nacim" type="date" class="form-control" required="">
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

        <!--Segundo Formulario registrar Editorial -->


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
        <!--Tercer Formulario registrar categoria-->

        <div id="mcategoria" class="modal fade bs-example-modal-sm panel-primary" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm">
                <div class="panel panel-primary">
                    <form action="../proceso/reg_categoria.php" method="GET">
                        <div class="modal-content panel panel-primary">
                            <div class="modal-header panel-primary">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="modal-title">Registrar Categoria</h3>
                            </div>
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-sm-12">
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">»</span>
                                            <input name="codCategoria" type="number"  height="5"class="form-control" required="" placeholder="Codigo de la Categoria" autofocus="">
                                        </div>

                                        <div class="form-group input-group">
                                            <span class="input-group-addon">»</span>
                                            <input name="nombre" type="text"  height="5"class="form-control" required="" placeholder="Nombre Categoria" autofocus="">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">»</span>
                                            <input name="descripcion" type="text"  height="5"class="form-control"  required="" placeholder="Descripcion">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">»</span>
                                            &nbsp;&nbsp;<label>Activo</label>
                                            &nbsp;&nbsp;<input type="radio" name="estado" value="A" checked="True" class="form-group">
                                            <label> &nbsp;&nbsp;Inactivo &nbsp;&nbsp;</label>
                                            <input type="radio" name="estado" value="I" class="form-group">

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
    <script src="../bootstrap-3.3.5-dist/js/jquery-1.10.2.js"></script>
    <script src="../bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
    <script src="../bootstrap-3.3.5-dist/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../bootstrap-3.3.5-dist/js/sb-admin.js"></script>
</body>

</html>
