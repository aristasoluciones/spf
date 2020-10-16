<?php
	
	/* For Session Control - Don't remove this */
	$user->AllowAccess();	
	
	
	// if($_SESSION['Usr']["tipo"] == "captura"){			
			// if(!$this->AllowAccessModule($page)){
				//header('Location: '.WEB_ROOT.'/homepage');
				// exit;
			// }
	// }
	/* End Session Control */
	
	// $result = $cliente->EnumerateAll();
	// $clientes = $util->EncodeResult($result);
	
	// $result = $usuario->EnumerateAll();
	// $usuarios = $util->EncodeResult($result);
		// exit;
	// $tDoc = $documento->totalDocumentos();
	// $tDocP = $documento->totalpendientes();
	
	// $recordatorio->setFecha($info['primerDia']);
	// $recordatorio->setFechaFin($info['ultimoDia']);
	// $registros = $recordatorio->Search();
	// $registros['result'] = $util->EncodeResult($registros['result']);

	
	// exit;
	$smarty->assign('tDoc',$tDoc);
	$smarty->assign('tDocP',$tDocP);
	$smarty->assign('info',$info);
	// $smarty->assign('clientes',$clientes);
	$smarty->assign('usuarios',$usuarios);
	// $smarty->assign('registros',$registros);
	
?>