<?php	
	//comprobar privilegios de acceso a modulo
	// if($_SESSION['Usr']["role_id"]!=1)
	 // $rbac->enforce('producto',$_SESSION['Usr']["usuarioId"]);
 
	$objRole->setRoleId($_SESSION['Usr']["role_id"]);
	$lisPermisos = $objRole->permisoSegunRol();

	if($_SESSION['Usr']["role_id"] <> 1){
		 if(!in_array(11,$lisPermisos)){
			echo "<font color='red'>El usuario no tiene permisos para ingresar a esta seccion</font>";
			exit;
		 }
	}
	
	//$cat_tramite->setAll('no');
	$util->PrintErrors2();
	$productos = $producto->EnumerateAll();
	if(!empty($productos))
		$smarty->assign('datatable_flag',true);
	
	$smarty->assign('registros',$productos);
	
?>