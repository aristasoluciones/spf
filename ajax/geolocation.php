<?php
	include_once('../init.php');
	include_once('../config.php');
	include_once(DOC_ROOT.'/libraries.php');

	session_start();
	
	$page = 'cliente';
	
	$smarty->assign('page',$page);
	
	switch($_POST['type']){
	
		case 'datas':
								
			$victimas = $victima->EnumerateVictimasForMaps();
			foreach($victimas as $key=>$aux){
				$datasem1[] = array ($aux['fechaIncidente'], $aux['lat'],$aux['lng']);
			}
			header("Content-type: text/x-json");
			print json_encode($datasem1);
		break;
		
		
			
	break;
}//switch

?>