<!doctype html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Consultorías Ejecutadas</title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap-datepicker.css">

        <script type="text/javascript" src="../bootstrap/js/ejecuciones_x_consultoria.js"></script>

        <!-- Load jQuery and bootstrap datepicker scripts -->
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {

                $("#codigo_consultoria").change(getEjecucionesXConsultoria);

                $('#fecha').datepicker({
                    format: "yyyy/mm/dd"
                });

            });
        </script>

    </head>

    <body>

        <div class="container">
            <div class="alert alert-info">
                <strong>Consultorías Ejecutadas</strong>
            </div>
        </div>
