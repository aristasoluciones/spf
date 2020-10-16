<?php	
	
	//comprobar privilegios de acceso a modulo
	if($_SESSION['Usr']["role_id"]!=1)
	 $rbac->enforce('puesto',$_SESSION['Usr']["usuarioId"]);	
	
	$util->PrintErrors2();
	$puestos = $puesto->EnumerateAll();
	  if(!empty($puestos))
		$smarty->assign('datatable_flag',true);
	$smarty->assign('registros',$puestos);
	
?>