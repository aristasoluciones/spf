<?php
	include_once('../init.php');
	include_once('../config.php');
	include_once(DOC_ROOT.'/libraries.php');
	session_start();
	switch($_GET['wscatgeo']){
        case 'mgem':
            $mgem = $_GET['mgem'];
            $agems =  $municipio->EnumerateApi($mgem);
            echo json_encode($agems);
        break;
	}//switch

?>
