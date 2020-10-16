<?php

    include_once('../initPdf.php');
    include_once('../config.php');
    include_once(DOC_ROOT.'/libraries.php');


    switch($_POST['type']) {
        case 'suggestionProducto':
            $data = array();
            $result = $producto->Suggestion();
            foreach($result as $key =>$value){
                $data[] =array('name'=>$value["nombre"],'id'=> $value["id"]);
            }
           echo json_encode($data);
        break;
    }


?>