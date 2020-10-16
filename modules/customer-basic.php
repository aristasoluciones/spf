<?php	
	
	//comprobar privilegios de acceso a modulo
	// if($_SESSION['Usr']["role_id"]!=1)
	// $rbac->enforce('cliente',$_SESSION['Usr']["usuarioId"]);	

	$objRole->setRoleId($_SESSION['Usr']["role_id"]);
	$lisPermisos = $objRole->permisoSegunRol();

	if($_SESSION['Usr']["role_id"] <> 1){
		 if(!in_array(9,$lisPermisos)){
			echo "<font color='red'>El usuario no tiene permisos para ingresar a esta seccion</font>";
			exit;
		 }
	}
	
	$util->PrintErrors2();
	$clientes = $cliente->Enumerate();
	
	// echo '<pre>'; print_r($clientes);
	// exit;
	

	if(!empty($clientes))
		$smarty->assign('datatable_flag',true);

	$smarty->assign('registros',$clientes);
	
?>