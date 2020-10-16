<?php
	//comprobar privilegios de acceso a modulo
	$user->AllowAccess(15);
	$user->AllowAccess(16);
	$util->PrintErrors2();
	$registros = $colonia->EnumerateAll();
	if(!empty($registros))
		$smarty->assign('datatable_flag',true);

	$smarty->assign('registros',$registros);	
?>

