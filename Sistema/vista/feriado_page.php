<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location:../login.php");
}

require_once '../controlador/CCalendario.php';

$calendario=new CCalendario();
$result=  mysql_fetch_array($calendario->buscarFechaCalendario($_GET['fecha']));
$resultado=  $calendario->readCalendario();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Unibeth | Infobeth  </title>

        <!-- Bootstrap core CSS -->

        <link href="../bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap-3.3.5-dist/font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- Page-Level Plugin CSS - Tables -->
        <link href="../bootstrap-3.3.5-dist/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- SB Admin CSS - Include with every page -->
        <link href="../bootstrap-3.3.5-dist/css/sb-admin.css" rel="stylesheet">


        <script src="../js/jquery.js"></script>


    </head>



    <div class="container">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Green Panel
                </div>
                <div class="panel-body">
                    <table>
                        <tr>
                            <td><strong>Fecha:</strong></td><td>&nbsp;</td><td><?php echo  $result[1]; ?></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td><td>&nbsp;</td><td></td>
                        </tr>
                        <tr>
                            <td><strong>Descripcion:</strong></td><td>&nbsp;</td><td><?php echo $result[3]; ?></td>
                        </tr>
                        
                        <tr>
                            <td>&nbsp;</td><td>&nbsp;</td><td></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <form>
                                    
                                    <div class="alert alert-warning alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                En estas fecha no se puede hacer devolucion . <button type="button" value="" onclick="history.go(-1)" class="btn btn-warning">Atras</button>.
                                </form>
                                
                            </div>
                            </td>
                        </tr>
                        
                    </table>
                </div>
                <div class="panel-footer">
                    Panel Footer
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    CALENDARIO UNIVERSIDAD BETHESDA
                </div>
                <div class="panel-body">

                    
                     <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr class="bg-success">
                                                <th>FECHA</th>
                                                <th>ESTADO</th>
                                                <th>DESCRIPCION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysql_fetch_array($resultado)) { ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $row['fecha']; ?></td>
                                                    <td><?php 
                                                    if($row['estado']=='A'){
                                                        echo 'Activo';
                                                    }
                                                    if($row['estado']=='I'){
                                                        echo 'Inactivo';
                                                    }
                                                     ?></td>
                                                    <td><?php echo $row['descripcion']; ?></td>                          
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                    
                    
                    
                    
                </div>
                <div class="panel-footer">
                    Panel Footer
                </div>
            </div>
        </div>
    </div>

    <script src="../bootstrap-3.3.5-dist/js/jquery-1.10.2.js"></script>
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