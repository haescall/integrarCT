
<!-- barra de navegacion -->
<div class="navbar-wrapper">
    <div class="container">
        <!-- barra que se encoje cuando se visualiza en en celular -->
        <div class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand"></a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="../principal/index.php">Inicio</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" 
                               data-toggle="dropdown">Proceso Principal<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="../consultorias_ejecutadas/consultorias_ejecutadas.php" target="content">
                                        Registrar Tiempos Consultorías</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administración<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="../consultores/consultor.php" target="content">Consultores</a></li>
                                <li><a href="../clientes/clientes.php"  target="content">Clientes</a></li>
                                <li><a href="../fases/fases.php" target="content">Fases</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header">Datos Consultoría...</li>
                                <li><a href="../consultorias/consultoria.php"  target="content">Consultorías</a></li>
                                <!--<li><a href="../presupuesto_consultorias/">Presupuesto Fases - Consultoría</a></li>-->
                                <li class="divider"></li>
                                <li class="dropdown-header">Otros...</li>
                                <li><a href="../facturacion_consultoria/facturacion_consultoria.php"  
                                       target="content">Facturación Consultorías</a></li>
                                <li><a href="../gastos_consultoria/gastos_consultoria.php"  
                                       target="content">Gastos Consultoría</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Configuración<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Cambio de Contraseña</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="../reportes/reporte_tiempo_semanal.php" 
                                       target="content">Reporte de Tiempos Semanales</a></li>
                                <li><a href="../reportes/reporte_det_consultor.php" 
                                       target="content">Reporte Detallado Consultores</a></li>
                                <li><a href="../reportes/reporte_res_consultor.php" 
                                       target="content">Reporte Resumido Consultores</a></li>
                                       <li><a href="../reportes/reporte_cliente_consultoria.php" 
                                       target="content">Reporte Por Cliente y Consultoría</a></li>
                            </ul>

                        </li>
                        <li><a href="../desconectar.php">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>