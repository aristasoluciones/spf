<?php	
	
	//comprobar privilegios de acceso a modulo
	$user->AllowAccess(15);
	$user->AllowAccess(17);

	$util->PrintErrors2();
	$data = $encuesta->Enumerate();

	if(!empty($clientes))
		$smarty->assign('datatable_flag',true);

	$smarty->assign('registros',$data);
?>