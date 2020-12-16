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
		case 'localidad':
			$mgem = $_GET['mgem'];
			$agem = $_GET['agem'];
			$locs =  $localidad->EnumerateApi($mgem, $agem);
			echo json_encode($locs);
		break;
		case 'info_agem':
			$agem = $_GET['agem'];
			$agem =  $municipio->infoAgem($agem);
			echo json_encode($agem);
		break;
		case 'info_loc':
			$cveloc = $_GET['loc'];
			$agem = $_GET['agem'];
			$loc =  $localidad->infoLoc($cveloc, $agem);
			echo json_encode($loc);
			break;
	}//switch

?>
