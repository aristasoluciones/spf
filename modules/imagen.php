<?php	
	//comprobar privilegios de acceso a modulo
	if($_SESSION['Usr']["role_id"]!=1)
	 $rbac->enforce('producto',$_SESSION['Usr']["usuarioId"]);
	
	//$cat_tramite->setAll('no');
	$util->PrintErrors2();
	$imagenes = $imagen->EnumerateAll();
	if(!empty($imagenes))
		$smarty->assign('datatable_flag',true);
	$smarty->assign('registros',$imagenes);
	
?>