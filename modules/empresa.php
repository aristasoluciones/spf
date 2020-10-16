<?php
    //comprobar privilegios de acceso a modulo
    $user->AllowAccess(1);
    $user->AllowAccess(4);

	$util->PrintErrors2();
	$datosempresa = $config->DatosEmpresa();
	$smarty->assign('datosempresa',$datosempresa);
?>