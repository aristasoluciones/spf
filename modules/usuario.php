<?php

    //comprobar privilegios de acceso a modulo
    $user->AllowAccess(1);
    $user->AllowAccess(7);

	$util->PrintErrors2();
	$registros = $usuario->EnumerateAll();
	if(!empty($registros))
		$smarty->assign('datatable_flag',true);

	$smarty->assign('registros',$registros);
?>