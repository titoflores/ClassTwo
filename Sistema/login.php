<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login InfoBeth</title>
        <link rel="stylesheet" href="bootstrap-3.3.5-dist/css/bootstrap.css"/>
    </head>
    <body style="background:#005f8d;">
        <div class="container">
            <p><br/></p>
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="page-header">
                                <h3>LOGIN INFOBETH </h3>
                            </div>
                            <form class="panel-primary" role="form" method="GET" action="proceso/AuthBiblitecario.php">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email or Username</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                        <input type="email" name="email" autofocus="" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-star"></span></span>
                                        <input type="password" name="password" required="" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                </div>
                                <hr/>
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock"></span> Login</button>
                                <p><br/></p>

                                <?php if (isset($_GET['mensage'])) { ?> 
                                    <div class="alert alert-info">
                                        Usuario y password incorrectos no recuerdas. <a href="#" class="alert-link">Recuperar</a>.
                                    </div>
                                    <?php
                                }
                                ?>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </body>
</html>
