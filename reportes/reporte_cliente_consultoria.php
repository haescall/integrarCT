<?php
include_once '../config/dbconfig.php';
require_once '../librerias/ExcelPHP/PHPExcel.php';
require_once '../librerias/UtilExcelPHP.php';

if (isset($_POST['btn-reporte'])) {
    $consultoria_id = $_POST['consultoria'];
    $fecha_inicial = $_POST['fecha_inicial'];
    $fecha_final = $_POST['fecha_final'];

    //echo "$consultoria_id";

    $lista = $crud_consultorias_ejecutadas->datosDetalladoConsultoria(
            $fecha_inicial, $fecha_final, $consultoria_id);

    //Crea un nuevo objeto PHPExcel
    $objPHPExcel = new PHPExcel();

    //Establecer propiedades
    $objPHPExcel->getProperties()->setCreator("Aymer Ivan Obando")
            ->setLastModifiedBy("Hanseld A. Escallon Ortiz")
            ->setTitle("Reporte por Cliente y Consultoría")
            ->setSubject("Reporte por Cliente y Consultoría")
            ->setDescription("Reporte por Cliente y Consultoría")
            ->setKeywords("Excel Office 2007 openxml php")
            ->setCategory("Reporte");

    //Variables del reporte HORAS CONSULTOR 
    $columnas = array(
        0 => "A",
        1 => "B",
        2 => "C",
        3 => "D",
        4 => "E"
    );
    $fila1 = 1;
    $fila10 = 10;

    // Agregar Informacion
    $objPHPExcel->setActiveSheetIndex(0);
    $objActSheet = $objPHPExcel->getActiveSheet();
    $objActSheet->setTitle($fecha_inicial . ' hasta ' . $fecha_final);

    //Estilo y titulo del reporte
    UtilExcelPHP::mergeCeldas($objActSheet, $columnas[0] . $fila1, $columnas[3] . '4');
    $objActSheet->setCellValue($columnas[0] . $fila1, "REPORTE POR CLIENTE - CONSULTORIA \rDESDE " .
            $fecha_inicial . ' HASTA ' . $fecha_final);
    UtilExcelPHP::estiloCelda($objActSheet, $columnas[0], $fila1, true, 'Arial', 15, '003366');

    //Logo de la empresa
    UtilExcelPHP::mergeCeldas($objActSheet, 'E1', 'G4');
    UtilExcelPHP::ponerLogo($objActSheet, 'E1');


    //Titulos o Encabezados de Columna
    $objActSheet->setCellValue($columnas[0] . $fila10, 'Codigo Consultor');
    $objActSheet->setCellValue($columnas[1] . $fila10, 'Consultor');
    $objActSheet->setCellValue($columnas[2] . $fila10, 'Fase');
    $objActSheet->setCellValue($columnas[3] . $fila10, 'No. Horas');
    $objActSheet->setCellValue($columnas[4] . $fila10, 'Vr. Actividad');


    //Fondo a los encabezados y color de letra
    foreach ($columnas as $value) {
        UtilExcelPHP::fondoCelda($objActSheet, $value, $fila10, '003366');
        UtilExcelPHP::estiloCelda($objActSheet, $value, $fila10, true, 'Verdana', 10, 'FFFFFF');
    }

    $i = 0;
    $filaData = 11;
    $numRegistros = count($lista);

    foreach ($lista as $value) {

        if ($filaData == 11) {
            $objActSheet->setCellValue($columnas[0] . 6, "Cliente");
            $objActSheet->setCellValue($columnas[1] . 6, $value['id_cliente'] .
                    " - " . $value['nombre_cliente']);
            $objActSheet->setCellValue($columnas[0] . 7, "Consultoria");
            $objActSheet->setCellValue($columnas[1] . 7, $value['id_consultoria'] .
                    " - " . $value['nombre_consultoria']);

            $objActSheet->setCellValue($columnas[0] . 9, "Horas Consultores");
        }

        $objActSheet->setCellValue($columnas[0] . $filaData, $value['id_consultor']);
        $objActSheet->setCellValue($columnas[1] . $filaData, utf8_encode($value['nombre_consultor']));
        $objActSheet->setCellValue($columnas[2] . $filaData, utf8_encode($value['nombre_fase']));
        $objActSheet->setCellValue($columnas[3] . $filaData, $value['numero_horas']);
        $objActSheet->setCellValue($columnas[4] . $filaData, utf8_encode($value['valor_actividad']));

        $filaData++;
        $i++;

        if ($numRegistros == $i) {
            $objActSheet->setCellValue($columnas[1] . $filaData, "Total");
            $objActSheet->setCellValue($columnas[3] . $filaData, '=SUM(D11:D' . ($filaData - 1) . ')');
            $objActSheet->setCellValue($columnas[4] . $filaData, '=SUM(E11:E' . ($filaData - 1) . ')');

            UtilExcelPHP::estiloCelda($objActSheet, $columnas[1], $filaData, true, 'Arial', 15, '000000');
            UtilExcelPHP::estiloCelda($objActSheet, $columnas[3], $filaData, true, 'Arial', 15, '000000');
            UtilExcelPHP::estiloCelda($objActSheet, $columnas[4], $filaData, true, 'Arial', 15, '000000');

            UtilExcelPHP::formatoCeldaNumero($objActSheet, $columnas[4] . $filaData);

            foreach ($columnas as $columna) {
                UtilExcelPHP::fondoCelda($objActSheet, $columna, $filaData, 'cccccc');
            }
            $filaData++;
            break;
        }
    }

    $lista = $crud_facturacion_consultoria->datosFacturacionConsultoria(
            $fecha_inicial, $fecha_final, $consultoria_id);

    $i = 0;
    $numRegistros = count($lista);
    $posIniFilaSum = "";

    foreach ($lista as $value) {

        if ($i == 0) {
            $objActSheet->setCellValue($columnas[0] . ++$filaData, "Facturación");

            //Titulos encabezados
            $objActSheet->setCellValue($columnas[0] . ++$filaData, 'Factura No.');
            $objActSheet->setCellValue($columnas[1] . $filaData, 'Fecha');
            $objActSheet->setCellValue($columnas[2] . $filaData, 'Valor');
            $objActSheet->setCellValue($columnas[3] . $filaData, 'Concepto');

            //Fondo a los encabezados y color de letra
            foreach ($columnas as $columna) {
                UtilExcelPHP::fondoCelda($objActSheet, $columna, $filaData, '003366');
                UtilExcelPHP::estiloCelda($objActSheet, $columna, $filaData, true, 'Verdana', 10, 'FFFFFF');
            }

            $posIniFilaSum = ++$filaData;
        }

        $objActSheet->setCellValue($columnas[0] . $filaData, $value['nro_factura']);
        $objActSheet->setCellValue($columnas[1] . $filaData, $value['fecha_factura']);
        $objActSheet->setCellValue($columnas[2] . $filaData, $value['valor_factura']);
        $objActSheet->setCellValue($columnas[3] . $filaData, utf8_encode($value['concepto_factura']));

        $filaData++;
        $i++;

        if ($numRegistros == $i) {
            $objActSheet->setCellValue($columnas[1] . $filaData, "Total");
            $objActSheet->setCellValue($columnas[2] . $filaData, '=SUM(C' . $posIniFilaSum .
                    ':C' . ($filaData - 1) . ')');

            UtilExcelPHP::estiloCelda($objActSheet, $columnas[1], $filaData, true, 'Arial', 15, '000000');
            UtilExcelPHP::estiloCelda($objActSheet, $columnas[2], $filaData, true, 'Arial', 15, '000000');

            UtilExcelPHP::formatoCeldaNumero($objActSheet, $columnas[2] . $filaData);

            foreach ($columnas as $columna) {
                UtilExcelPHP::fondoCelda($objActSheet, $columna, $filaData, 'cccccc');
            }
            $filaData++;
            break;
        }
    }

    $lista = $crud_gastos_consultoria->datosGastosConsultoria(
            $fecha_inicial, $fecha_final, $consultoria_id);

    $i = 0;
    $numRegistros = count($lista);
    $posIniFilaSum = "";

    foreach ($lista as $value) {

        if ($i == 0) {
            $objActSheet->setCellValue($columnas[0] . ++$filaData, "Gastos");

            //Titulos encabezados
            $objActSheet->setCellValue($columnas[0] . ++$filaData, 'Factura No.');
            $objActSheet->setCellValue($columnas[1] . $filaData, 'Fecha');
            $objActSheet->setCellValue($columnas[2] . $filaData, 'Proveedor');
            $objActSheet->setCellValue($columnas[3] . $filaData, 'Valor');
            $objActSheet->setCellValue($columnas[4] . $filaData, 'Concepto');

            //Fondo a los encabezados y color de letra
            foreach ($columnas as $columna) {
                UtilExcelPHP::fondoCelda($objActSheet, $columna, $filaData, '003366');
                UtilExcelPHP::estiloCelda($objActSheet, $columna, $filaData, true, 'Verdana', 10, 'FFFFFF');
            }

            $posIniFilaSum = ++$filaData;
        }

        $objActSheet->setCellValue($columnas[0] . $filaData, $value['nro_factura']);
        $objActSheet->setCellValue($columnas[1] . $filaData, $value['fecha_gasto']);
        $objActSheet->setCellValue($columnas[2] . $filaData, utf8_encode($value['proveedor']));
        $objActSheet->setCellValue($columnas[3] . $filaData, $value['valor_gasto']);
        $objActSheet->setCellValue($columnas[4] . $filaData, utf8_encode($value['concepto_gasto']));

        $filaData++;
        $i++;

        if ($numRegistros == $i) {
            $objActSheet->setCellValue($columnas[1] . $filaData, "Total");
            $objActSheet->setCellValue($columnas[3] . $filaData, '=SUM(D' . $posIniFilaSum .
                    ':D' . ($filaData - 1) . ')');

            UtilExcelPHP::estiloCelda($objActSheet, $columnas[1], $filaData, true, 'Arial', 15, '000000');
            UtilExcelPHP::estiloCelda($objActSheet, $columnas[3], $filaData, true, 'Arial', 15, '000000');

            UtilExcelPHP::formatoCeldaNumero($objActSheet, $columnas[3] . $filaData);

            foreach ($columnas as $columna) {
                UtilExcelPHP::fondoCelda($objActSheet, $columna, $filaData, 'cccccc');
            }
            break;
        }
    }

    //Establecer la anchura
    foreach (range('A', 'E') as $columnID) {
        $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        //$col->setAutoSize(true);
        //$objActSheet->getColumnDimension('B')->setAutoSize(true);
    }

    //Renombrar Hoja
    //Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
    $objPHPExcel->setActiveSheetIndex(0);

    //Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8');
    header('Content-Disposition: attachment;filename="reporteClienteConsultoria.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    exit;
}
?>

<?php include_once 'header.php'; ?>

<div class="clearfix"></div><br />
<div class="container">
    <div class="alert alert-info">
        <strong>Reporte Detallado Clientes - Consultoria</strong>
    </div>
    <form method='post'>
        <table class='table table-bordered'>

            <tr class="success">
                <td>Consultorías</td>
                <td>
                    <div class="hero-unit">
                        <select id="consultoria" name="consultoria" class="form-control">
                            <option value="" selected>Seleccione una consultoría...</option>
                            <?php foreach ($crud_consultoria->getConsultorias() as $value) { ?>
                                <option value = "<?php print($value['id']); ?>"><?php print($value['nombre']); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </td>
            </tr>
            <tr class="success">
                <td>Fecha Inicial</td>
                <td>
                    <div class="hero-unit">
                        <input name="fecha_inicial" type="text" 
                               placeholder="Click para ingresar la fecha"  
                               id="fechaIni" class='form-control' required>
                    </div>
                </td>
            </tr>
            <tr class="success">
                <td>Fecha Final</td>
                <td>
                    <div class="hero-unit">
                        <input name="fecha_final" type="text" 
                               placeholder="Click para ingresar la fecha"  
                               id="fechaFin" class='form-control' required>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" class="btn btn-primary" name="btn-reporte">
                        <span class="glyphicon glyphicon-flash"></span> Generar Reporte
                    </button>  
                </td>
            </tr>
        </table>
    </form>
</div>
<?php include_once 'footer.php'; ?>






