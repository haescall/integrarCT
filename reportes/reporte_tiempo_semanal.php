<?php
include_once '../config/dbconfig.php';
require_once '../librerias/ExcelPHP/PHPExcel.php';

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

//    /Variables reutilizables 
    $columnas = array(0 => "A",
        1 => "B",
        2 => "C",
        3 => "D",
        4 => "E",
        5 => "F",
        6 => "G");
    $fila1 = 1;

// Agregar Informacion
    $objPHPExcel->setActiveSheetIndex(0);
    $objActSheet = $objPHPExcel->getActiveSheet();
    $objActSheet->setTitle($fecha_inicial . ' hasta ' . $fecha_final);

//Titulos o Emcabezados de Columna
    $objActSheet->setCellValue($columnas[0] . $fila1, 'Consultor');
    $objActSheet->setCellValue($columnas[1] . $fila1, 'Fecha');
    $objActSheet->setCellValue($columnas[2] . $fila1, 'Día');
    $objActSheet->setCellValue($columnas[3] . $fila1, 'Cliente');
    $objActSheet->setCellValue($columnas[4] . $fila1, 'Horas');
    $objActSheet->setCellValue($columnas[5] . $fila1, 'Labor Realizada');
    $objActSheet->setCellValue($columnas[6] . $fila1, 'Totales');

    foreach ($columnas as $value) {
        $objActSheet
                ->getStyle($value . $fila1)
                ->getFill()
                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('0000CC');

        $objActSheet->getStyle($value . $fila1)
                ->getFont()
                ->setBold(true)
                ->setName('Verdana')
                ->setSize(10)
                ->getColor()->setRGB('FFFFFF');
    }

    $i = 2;
    $celdaIniMerge = "";
    $celdaFinMerge = "";
    $idAnterior = "";
    $numRegistros = count($lista);
    foreach ($lista as $value) {
        //echo $numRegistros;
        //echo $value['consultor'];

        $objActSheet->setCellValue($columnas[0] . $i, utf8_encode($value['consultor']));
        $objActSheet->setCellValue($columnas[1] . $i, $value['fecha']);
        $objActSheet->setCellValue($columnas[2] . $i, utf8_encode($value['dia']));
        $objActSheet->setCellValue($columnas[3] . $i, utf8_encode($value['cliente']));
        $objActSheet->setCellValue($columnas[4] . $i, $value['horas_laboradas']);
        $objActSheet->setCellValue($columnas[5] . $i, utf8_encode($value['actividades']));
        $objActSheet->setCellValue($columnas[6] . $i, $value['total_horas']);


        if ($i == 2) {
            $idAnterior = $value['id'];
            $celdaIniMerge = $columnas[0] . $i;
        } else if ($value['id'] != $idAnterior) {
            $celdaFinMerge = $columnas[0] . $i - 1;
            $objActSheet->mergeCells($celdaIniMerge . ':' . $celdaFinMerge);
            $$objActSheet->getStyle($celdaIniMerge)->getAlignment()->applyFromArray(
                    array('vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,));

            $idAnterior = $value['id'];
            $celdaIniMerge = $columnas[0] . $i;
        } else if ($numRegistros == $i - 1) {
            $celdaFinMerge = $columnas[0] . $i;
            $objActSheet->mergeCells($celdaIniMerge . ':' . $celdaFinMerge);
            $objActSheet->getStyle($celdaIniMerge)->getAlignment()->applyFromArray(
                    array('vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,));
        }

        //echo $celdaIniMerge;
        $i++;
    }
    /* $objActSheet->mergeCells('A2:A5');
      $objActSheet->getStyle('A2')->getAlignment()->applyFromArray(
      array('vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,)
      ); */
    /* $objActSheet->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objActSheet->getStyle('A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); */

//Establecer la anchura
    foreach (range('A', 'G') as $columnID) {
        $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
//$col->setAutoSize(true);
//$objActSheet->getColumnDimension('B')->setAutoSize(true);
    }

// Renombrar Hoja
// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
    $objPHPExcel->setActiveSheetIndex(0);

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
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






