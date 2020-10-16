<?php	
    //comprobar privilegios de acceso a modulo
    if($_SESSION['Usr']["role_id"]!=1)
    	$rbac->enforce('producto_cat',$_SESSION['Usr']["usuarioId"]);
  
	$util->PrintErrors2();

	$id =  $_GET["id"];
    $producto->setId($id);
	$productos_categorias = $producto->getListProductoCategoria();
	$info = $producto->Info();
    $permisos = $config->getListPermisos();
    if(!empty($productos_categorias))
		$smarty->assign('datatable_flag',true);
    
	$smarty->assign('privilegios',$permisos);
	$smarty->assign('row',$info);
	$smarty->assign('registros',$productos_categorias);
	
?>