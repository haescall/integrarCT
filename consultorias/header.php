<!doctype html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Consultorías</title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap-datepicker.css">

        <script src="../bootstrap/js/consultores_x_consultoria.js"></script>
        <script src="../bootstrap/js/borrar_consultor_x_consultoria.js"></script>
        <script src="../bootstrap/js/inactivar_consultor_x_consultoria.js"></script>
        <script src="../bootstrap/js/adicionar_consultor_a_consultoria.js"></script>


        <!-- Load jQuery and bootstrap datepicker scripts -->
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {

                $(".dlg_consultores_consultorias").click(buscarConsultoresConsultoria);
                //$(".dlg_borrar_consultor").click(borrarConsultorXConsultoria);
                //$(".dlg_inactivar_consultor").click(inactivarConsultorXConsultoria);
                $("#close").click(limpiarCssMsg);
                //$("#add_consultor").click(adicionarConsultorAConsultoria);


                $('#fechaInicio').datepicker({
                    format: "yyyy/mm/dd"
                });

            });

            $(document).ready(function (e) {
                $('#consul').on('show.bs.modal', function (e) {
                    var id = $(e.relatedTarget).data().id;
                    $(e.currentTarget).find('#idConsultoria').val(id);
                });
            });
        </script>
    </head>
    <body>

        <div class="container">
            <div class="alert alert-info">
                <strong>Administración de Consultorías</strong>
            </div>
        </div>
