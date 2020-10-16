<?php
    include_once('../initPdf.php');
    include_once('../config.php');
    include_once(DOC_ROOT.'/libraries.php');

    $objPHPExcel =  new PHPExcel();
    $objPHPExcel->getProperties()->setCreator(PROJECT_NAME);
    $objPHPExcel->getProperties()->setLastModifiedBy(PROJECT_NAME);
    $objPHPExcel->getProperties()->setTitle("Formato de importacion");
    $objPHPExcel->getProperties()->setSubject("Formato de importacion");
    $objPHPExcel->getProperties()->setDescription('Formato de importacion para archivos excel');
    $arrayCells =array("A","B","C","D","E","F","G","H","I","J","K");
    $objPHPExcel->setActiveSheetIndex(0);
    switch ($_POST['identity']){
          case 1:
              $nameCells =  array("NOMBRE",'DESCRIPCION','DIRIGIDOA','VENTAS');
              foreach($nameCells as $key => $value){
                  $objPHPExcel->setActiveSheetIndex(0)->setCellValue($arrayCells[$key].'1',$value);
              }
          break;
        case 2:
            $nameCells =  array("NOMBRE PRODUCTO",'CATEGORIA','DESCRIPCION','CARACTERISTICAS','PRECIO ACTUAL','PRECIO ANTERIOR','PROMOCION');
            $ky=1;
            foreach($nameCells as  $value){
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($arrayCells[$ky-1].'1',$value);
                $ky++;
            }
            break;
      }
    $objPHPExcel->getActiveSheet()->setTitle('formato');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="formato_importacionxls.xls"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit;
?>