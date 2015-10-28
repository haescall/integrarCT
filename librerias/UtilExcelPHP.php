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

}
