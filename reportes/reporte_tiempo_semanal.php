<?php
include_once '../config/dbconfig.php';
require_once '../librerias/ExcelPHP/PHPExcel.php';
require_once '../librerias/UtilExcelPHP.php';

if (isset($_POST['btn-reporte'])) {
    $fecha_inicial = $_POST['fecha_inicial'];
    $fecha_final = $_POST['fecha_final'];

    /* echo $fecha_inicial;
      echo $fecha_final; */

    $lista = $crud_consultorias_ejecutadas->horasReportadasConsultor($fecha_inicial, $fecha_final, 0);

// Crea un nuevo objeto PHPExcel
    $objPHPExcel = new PHPExcel();

// Establecer propiedades
    $objPHPExcel->getProperties()->setCreator("Hanseld A. Escallon Ortiz")
            ->setLastModifiedBy("Hanseld A. Escallon Ortiz")
            ->setTitle("Reporte Horas Semanales")
            ->setSubject("Reporte Horas Semanales")
            ->setDescription("Reporte Horas Semanales.")
            ->setKeywords("Excel Office 2007 openxml php")
            ->setCategory("Reporte Horas Semanales");

//    /Variables del reporte 
    $columnas = array(0 => "A",
        1 => "B",
        2 => "C",
        3 => "D",
        4 => "E",
        5 => "F",
        6 => "G");
    $fila1 = 1;
    $fila5 = 5;
    //Agregar Informacion
    $objPHPExcel->setActiveSheetIndex(0);
    $objActSheet = $objPHPExcel->getActiveSheet();
    $objActSheet->setTitle($fecha_inicial . ' hasta ' . $fecha_final);

    //Estilo y titulo del reporte
    UtilExcelPHP::mergeCeldas($objActSheet, $columnas[0] . $fila1, $columnas[3] . '4');
    $objActSheet->setCellValue($columnas[0] . $fila1, "REPORTE DE TIEMPOS SEMANALES\rDESDE " .
            $fecha_inicial . ' HASTA ' . $fecha_final);

    UtilExcelPHP::estiloCelda($objActSheet, $columnas[0], $fila1, true, 'Arial', 15, '003366');

    //Logo de la empresa
    UtilExcelPHP::mergeCeldas($objActSheet, 'E1', 'G4');
    UtilExcelPHP::ponerLogo($objActSheet, 'E1');

    //Titulos o Emcabezados de Columna
    $objActSheet->setCellValue($columnas[0] . $fila5, 'Consultor');
    $objActSheet->setCellValue($columnas[1] . $fila5, 'Fecha');
    $objActSheet->setCellValue($columnas[2] . $fila5, 'Día');
    $objActSheet->setCellValue($columnas[3] . $fila5, 'Cliente');
    $objActSheet->setCellValue($columnas[4] . $fila5, 'Horas');
    $objActSheet->setCellValue($columnas[5] . $fila5, 'Labor Realizada');
    $objActSheet->setCellValue($columnas[6] . $fila5, 'Totales');


    //Fondo a los emcabezados
    foreach ($columnas as $value) {
        UtilExcelPHP::fondoCelda($objActSheet, $value, $fila5, '003366');
        UtilExcelPHP::estiloCelda($objActSheet, $value, $fila5, true, 'Verdana', 10, 'FFFFFF');
    }

    $i = 1;
    $celdaIniMerge = "";
    $celdaFinMerge = "";
    $idAnterior = "";
    $numRegistros = count($lista);

    //Recorrer y adicionar los datos al excel
    foreach ($lista as $value) {
        //echo $numRegistros;
        //echo $value['consultor'];

        $filaData = $i + $fila5;
        $objActSheet->setCellValue($columnas[0] . $filaData, utf8_encode($value['consultor']));
        $objActSheet->setCellValue($columnas[1] . $filaData, $value['fecha']);
        $objActSheet->setCellValue($columnas[2] . $filaData, utf8_encode($value['dia']));
        $objActSheet->setCellValue($columnas[3] . $filaData, utf8_encode($value['cliente']));
        $objActSheet->setCellValue($columnas[4] . $filaData, $value['horas_laboradas']);
        $objActSheet->setCellValue($columnas[5] . $filaData, utf8_encode($value['actividades']));
        $objActSheet->setCellValue($columnas[6] . $filaData, $value['total_horas']);
        UtilExcelPHP::estiloCelda($objActSheet, $columnas[6], $filaData, true, 'Arial', 15, '000000');

        /*
         * Permite determinar en que momento hace el merge de las celdas de nombre
         * del consultor y de los totales, esto para una mejor visualizacion del
         * reporte
         */
        if ($i == 1) {
            $idAnterior = $value['id'];
            $celdaIniMerge = $columnas[0] . $filaData;
            $celdaTotalIniMerge = $columnas[6] . $filaData;
            //echo $celdaIniMerge . ':' . $celdaFinMerge;
        } else if ($value['id'] != $idAnterior) {
            $celdaFinMerge = $columnas[0] . $filaData - 1;
            $celdaFinTotalMerge = $columnas[6] . $filaData - 1;
            //echo $celdaIniMerge . ':' . $celdaFinMerge;
            UtilExcelPHP::mergeCeldas($objActSheet, $celdaIniMerge, $celdaFinMerge);
            UtilExcelPHP::mergeCeldas($objActSheet, $celdaTotalIniMerge, $celdaFinTotalMerge);
            //UtilExcelPHP::fondoCelda2($objActSheet, $celdaTotalIniMerge, '003366');

            $idAnterior = $value['id'];
            $celdaIniMerge = $columnas[0] . $filaData;
            $celdaTotalIniMerge = $columnas[6] . $filaData;
        } else if ($numRegistros == $i) {
            $celdaFinMerge = $columnas[0] . $filaData;
            $celdaFinTotalMerge = $columnas[6] . $filaData;
            //echo $celdaIniMerge . ':' . $celdaFinMerge;
            UtilExcelPHP::mergeCeldas($objActSheet, $celdaIniMerge, $celdaFinMerge);
            UtilExcelPHP::mergeCeldas($objActSheet, $celdaTotalIniMerge, $celdaFinTotalMerge);
            //UtilExcelPHP::fondoCelda2($objActSheet, $celdaTotalIniMerge, '003366');
        }

        //echo $celdaIniMerge;
        $i++;
    }

    //Establecer la anchura
    foreach (range('A', 'G') as $columnID) {
        $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        //$col->setAutoSize(true);
        //$objActSheet->getColumnDimension('B')->setAutoSize(true);
    }

    //Renombrar Hoja
    //Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
    $objPHPExcel->setActiveSheetIndex(0);

    //Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8');
    header('Content-Disposition: attachment;filename="reporteHorasSem.xlsx"');
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
        <strong>Reporte de Horas Semanales</strong>
    </div>
    <form method='post'>
        <table class='table table-bordered'>
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






