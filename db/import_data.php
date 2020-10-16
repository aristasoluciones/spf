<?php
include_once('../init.php');
include_once('../config.php');
include_once(DOC_ROOT.'/libraries.php');
    $archivo = "chiapas.xls";
    $typeFile =  PHPExcel_IOFactory::identify($archivo);
    $objReader = PHPExcel_IOFactory::createReader($typeFile);
    $objPHPExcel = $objReader->load($archivo);
    $sheet = $objPHPExcel->getSheet(1);
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();
    for ($row = 2; $row <= $highestRow; $row++){

        echo $sheet->getCell("A".$row)->getValue()." - ";
        echo $sheet->getCell("B".$row)->getValue()." - ";
        echo $sheet->getCell("C".$row)->getValue();
        echo "<br>";
    }
?>