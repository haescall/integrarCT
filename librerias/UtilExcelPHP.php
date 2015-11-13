<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UtilExcelPHP
 *
 * @author haescall
 */
class UtilExcelPHP {

    //put your code here
    public static function mergeCeldas($objActSheet, $celdaIniMerge, $celdaFinMerge) {
        try {
            $objActSheet->mergeCells($celdaIniMerge . ':' . $celdaFinMerge);
            $objActSheet->getStyle($celdaIniMerge)->getAlignment()->applyFromArray(
                    array('vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
        } catch (Exception $ex) {
            echo $ex;
        }
    }

    public static function ponerLogo($objActSheet, $coordinate) {
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('IntegrarCT');
        $objDrawing->setDescription('Logo IntegrarCT');
        $objDrawing->setPath($_SERVER['DOCUMENT_ROOT'] . '/integrarCT/resources/img/logo_reporte.png');
        $objDrawing->setHeight(70);
        $objDrawing->setCoordinates($coordinate);
        //$objDrawing->setOffsetX(10);
        //$objDrawing->setRotation(15);
        $objDrawing->getShadow()->setVisible(true);
        $objDrawing->getShadow()->setDirection(70);
        $objDrawing->setWorksheet($objActSheet);
    }

    public static function estiloCelda($objActSheet, $columna, $fila, $bold, $tipoLetra, $size, $rgb) {
        $objActSheet->getStyle($columna . $fila)
                ->getFont()
                ->setBold($bold)
                ->setName($tipoLetra)
                ->setSize($size)
                ->getColor()->setRGB($rgb);
        /* $objActSheet->getStyle($columna . $fila)
          ->getFont()->applyFromArray(
          array(
          'bold' => $bold,
          'name' => 'Arial',
          'size' => 15,
          'color' => array(
          'rgb' => $rgb
          )
          )
          ); */
    }
    
    
     public static function estiloCelda2($objActSheet, $celda, $bold, $tipoLetra, $size, $rgb) {
        $objActSheet->getStyle($celda)
                ->getFont()
                ->setBold($bold)
                ->setName($tipoLetra)
                ->setSize($size)
                ->getColor()->setRGB($rgb);
        /* $objActSheet->getStyle($columna . $fila)
          ->getFont()->applyFromArray(
          array(
          'bold' => $bold,
          'name' => 'Arial',
          'size' => 15,
          'color' => array(
          'rgb' => $rgb
          )
          )
          ); */
    }

    public static function fondoCelda($objActSheet, $columna, $fila, $rgb) {
        $objActSheet->
                getStyle($columna . $fila)
                ->getFill()
                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB($rgb);
    }

    public static function fondoCelda2($objActSheet, $celda, $rgb) {
        $objActSheet->
                getStyle($celda)
                ->getFill()
                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB($rgb);
    }

    public static function formatoCeldaNumero($objActSheet, $celda) {
        $objActSheet->getStyle($celda)->
                getNumberFormat()->
                setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);


        /* $objActSheet->getStyle($celda)->
          getNumberFormat()->
          setFormatCode('#,##0.00'); */
    }

}
