<?php	

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
	if(!empty($clientes))
		$smarty->assign('datatable_flag',true);

	$smarty->assign('registros',$clientes);
	
?>