<?php
    $user->AllowAccess(15);
	$user->AllowAccess(17);
	
	$util->PrintErrors2();
	$clientes = $encuesta->Enumerate();
	
	
	echo '<pre>'; print_r($clientes );
	exit;

	if(!empty($clientes))
		$smarty->assign('datatable_flag',true);

	$smarty->assign('registros',$clientes);
	
?>