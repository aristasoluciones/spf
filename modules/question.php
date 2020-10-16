<?php

    $user->AllowAccess(15);
    $user->AllowAccess(18);

	$encuesta->setId($_GET['x']);
	$data = $encuesta->EnumeratePreguntas();
	
	$encuesta->setEncuestaId($_GET['x']);
	$info = $encuesta->Info();

    $util->PrintErrors2();

	if(!empty($clientes))
		$smarty->assign('datatable_flag',true);

	$smarty->assign('encuestaId',$_GET['x']);
	$smarty->assign('info',$info);
	$smarty->assign('registros',$data);
	
?>