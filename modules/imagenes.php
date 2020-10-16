<?php	

	$user->AllowAccess(2);
	$user->AllowAccess(14);

	$util->PrintErrors2();
	$imagenes = $imagen->EnumerateAll();
	if(!empty($imagenes))
		$smarty->assign('datatable_flag',true);
	$smarty->assign('rand',rand());
	$smarty->assign('registros',$imagenes);
	
?>