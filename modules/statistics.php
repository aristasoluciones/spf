<?php	
	
	//comprobar privilegios de acceso a modulo
	$user->AllowAccess(19);
	$user->AllowAccess(26);

	$util->PrintErrors2();
	$data = $encuesta->Enumerate();
	$smarty->assign("year",date("Y"));
?>