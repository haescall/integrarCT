<?php
include_once '../config/dbconfig.php';
require_once '../librerias/ExcelPHP/PHPExcel.php';
require_once '../librerias/UtilExcelPHP.php';

if (isset($_POST['btn-reporte'])) {
    $fecha_inicial = $_POST['fecha_inicial'];
    $fecha_final = $_POST['fecha_final'];

    $lista = $crud_consultor->infoDetalladaConsultor($fecha_inicial, $fecha_final, 0);

    //Crea un nuevo objeto PHPExcel
    $objPHPExcel = new PHPExcel();

    //Establecer propiedades
    $objPHPExcel->getProperties()->setCreator("Hanseld A. Escallon Ortiz")
            ->setLastModifiedBy("Hanseld A. Escallon Ortiz")
            ->setTitle("Reporte Resumido Consultores")
            ->setSubject("Reporte Resumido Consultores")
            ->setDescription("Reporte Resumido Consultores.")
            ->setKeywords("Excel Office 2007 openxml php")
            ->setCategory("Reporte");

    //Variables del reporte 
    $columnas = array(0 => "A",
        1 => "B",
        2 => "C",
        3 => "D",
        4 => "E",
        5 => "F");
    $fila1 = 1;
    $fila8 = 8;

    // Agregar Informacion
    $objPHPExcel->setActiveSheetIndex(0);
    $objActSheet = $objPHPExcel->getActiveSheet();
    $objActSheet->setTitle($fecha_inicial . ' hasta ' . $fecha_final);

    //Estilo y titulo del reporte
    UtilExcelPHP::mergeCeldas($objActSheet, $columnas[0] . $fila1, $columnas[3] . '4');
    $objActSheet->setCellValue($columnas[0] . $fila1, "REPORTE RESUMIDO DE CONSULTORES\rDESDE " .
            $fecha_inicial . ' HASTA ' . $fecha_final);
    UtilExcelPHP::estiloCelda($objActSheet, $columnas[0], $fila1, true, 'Arial', 15, '003366');

    //Logo de la empresa
    UtilExcelPHP::mergeCeldas($objActSheet, 'E1', 'F4');
    UtilExcelPHP::ponerLogo($objActSheet, 'E1');


    //Titulos o Encabezados de Columna
    $objActSheet->setCellValue($columnas[0] . $fila8, 'Codigo Cliente');
    $objActSheet->setCellValue($columnas[1] . $fila8, 'Cliente');
    $objActSheet->setCellValue($columnas[2] . $fila8, 'Descripcion');
    $objActSheet->setCellValue($columnas[3] . $fila8, 'Fase');
    $objActSheet->setCellValue($columnas[4] . $fila8, 'No. Horas');
    $objActSheet->setCellValue($columnas[5] . $fila8, 'Valor Asig. Cliente');


    //Fondo a los encabezados y color de letra
    foreach ($columnas as $value) {
        UtilExcelPHP::fondoCelda($objActSheet, $value, $fila8, '003366');
        UtilExcelPHP::estiloCelda($objActSheet, $value, $fila8, true, 'Verdana', 10, 'FFFFFF');
    }

    $i = 1;
    $celdaIniMerge = "";
    $celdaFinMerge = "";
    $idAnterior = "";
    $filaData = 0;
    $numRegistros = count($lista);

    //$objActSheet->setCellValue($columnas[0] . 6, $numRegistros);

    foreach ($lista as $value) {

        if ($i == 1) {
            $idAnterior = $value['id_consultor'];
            $objActSheet->setCellValue($columnas[0] . 6, "Consultor");
            $objActSheet->setCellValue($columnas[1] . 6, $value['consultor']);

            $filaData = $fila8;
            //break;
        }
        $filaData += 1;

        if ($value['id_consultor'] == $idAnterior) {
            $objActSheet->setCellValue($columnas[0] . $filaData, $value['cod_cliente']);
            $objActSheet->setCellValue($columnas[1] . $filaData, utf8_encode($value['cliente']));
            $objActSheet->setCellValue($columnas[2] . $filaData, utf8_encode($value['descripcion']));
            $objActSheet->setCellValue($columnas[3] . $filaData, utf8_encode($value['nombre_fase']));
            $objActSheet->setCellValue($columnas[4] . $filaData, $value['horas_laboradas']);
            $objActSheet->setCellValue($columnas[5] . $filaData, ($value['horas_laboradas'] * $value['valor_hora_consultoria']));

            if ($numRegistros == $i) {
                $filaData += 2;

                $objActSheet->setCellValue($columnas[1] . $filaData, "Total");
                $objActSheet->setCellValue($columnas[4] . $filaData, '=SUM(E9:E' . ($filaData - 2) . ')');
                $objActSheet->setCellValue($columnas[5] . $filaData, '=SUM(F9:F' . ($filaData - 2) . ')');
                /* $objActSheet->setCellValue($columnas[4] . $filaData, $value['total_horas']);
                  $objActSheet->setCellValue($columnas[5] . $filaData, $value['total_valor']); */

                UtilExcelPHP::estiloCelda($objActSheet, $columnas[1], $filaData, true, 'Arial', 15, '000000');
                UtilExcelPHP::estiloCelda($objActSheet, $columnas[4], $filaData, true, 'Arial', 15, '000000');
                UtilExcelPHP::estiloCelda($objActSheet, $columnas[5], $filaData, true, 'Arial', 15, '000000');

                UtilExcelPHP::formatoCeldaNumero($objActSheet, $columnas[5] . $filaData);

                foreach ($columnas as $columna) {
                    UtilExcelPHP::fondoCelda($objActSheet, $columna, $filaData, 'cccccc');
                }
                break;
            }
        } else {
            $filaData += 2;

            $idAnterior = $value['id_consultor'];
            $objActSheet->setCellValue($columnas[0] . $filaData, "Consultor");
            $objActSheet->setCellValue($columnas[1] . $filaData, $value['consultor']);
        }
        $i++;
    }

    //Establecer la anchura
    foreach (range('A', 'F') as $columnID) {
        $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        //$col->setAutoSize(true);
        //$objActSheet->getColumnDimension('B')->setAutoSize(true);
    }

    //Renombrar Hoja
    //Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
    $objPHPExcel->setActiveSheetIndex(0);

    //Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8');
    header('Content-Disposition: attachment;filename="reporteResConsultor.xlsx"');
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
        <strong>Reporte Resumido Consultores</strong>
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






