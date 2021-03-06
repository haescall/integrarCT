<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">

        <meta charset="utf-8">

        <title>Integrar Consultoría - Ingresar a la aplicación</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- script references -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="./resources/js/funciones_comunes.js"></script>
        <script type="text/javascript" src="./resources/js/recordar_password.js"></script>
        <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {

                //$('#remember').click(recordarPassword);

                $("#email").focusout(function () {
                    $("#emailPass").attr("value", $("#email").val());
                    //alert("el valor del email pass es :" + $("#emailPass").val());
                });

            });
        </script>


        <!--[if lt IE 9]>
            <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
                    <![endif]
        <link href="bootstrap/css/styles.css" rel="stylesheet" type="text/css">
        <link href="bootstrap/css/login.css" rel="stylesheet" type="text/css">-->

    </head>
    <body onload="recargar();">
        <!--login modal-->
        <div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="text-center"><img src="resources/img/logo.jpg"></div>

                    <div class="modal-header">

                        <h1 class="text-center">Iniciar Sesión</h1>
                    </div>

                    <div class="modal-body">

                        <!--FORMULARIO -->
                        <form class="form col-md-12 center-block" method="POST" 
                              action="principal/acceso.php" name="frm_ingreso">
                            <div class="form-group">
                                <input type="text" class="form-control input-lg" required="true"
                                       placeholder="Email" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control input-lg" required="true"
                                       placeholder="Password" name ="password">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-lg btn-block">Conectar</button>              
                            </div>
                            <!--<div class="form-group">
                                <button type="button" id="remember" class="btn btn-primary btn-lg btn-block" 
                                        name="btn-recordar">
                                    Recordar Contraseña
                            </div>-->
                        </form>
                        <!-- FIN FORMULARIO -->

                        <form class="form col-md-12 center-block" method="post" 
                              action="usuarios/recordar_password.php">
                            <input type="hidden" class="form-control input-lg" 
                                   id="emailPass" name="emailPass"/>
                            <div class="form-group">
                                <input type="submit" id="remember" class="btn btn-primary btn-lg btn-block" 
                                       name="btn-recordar" value="Recordar Contraseña">
                                    
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div id="msg" class="col-md-12"> </div>	
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
