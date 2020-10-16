<?php

	include_once('../init.php');
	include_once('../config.php');
	include_once(DOC_ROOT.'/libraries.php');

	session_start();
	
	$page = 'homepage';
		
	$smarty->assign('titleFrm','Recordatorio');
	$smarty->assign('page',$page);
	
	$Usr = $_SESSION['Usr'];
	
	switch($_POST['type']){
	
		case 'add':
				
				// $result = $cliente->EnumerateAll();
				// $clientes = $util->EncodeResult($result);
				
				echo 'ok[#]';
				
				$smarty->assign('clientes',$clientes);
				$smarty->display(DOC_ROOT.'/templates/boxes/'.$page.'.tpl');
																
			break;
		
		case 'edit':
				
				$recordatorio->setId($_POST['id']);
				$info = $recordatorio->Info();
				$info = $util->EncodeRow($info);
				
				$result = $cliente->EnumerateAll();
				$clientes = $util->EncodeResult($result);
								
				echo 'ok[#]';
				
				$smarty->assign('info',$info);	
				$smarty->assign('clientes',$clientes);			
				$smarty->display(DOC_ROOT.'/templates/boxes/'.$page.'.tpl');
																
			break;
			
		case 'save':
				
				$idReg = $_POST['id'];
				
				$recordatorio->setId($idReg);
				$recordatorio->setClienteId($_POST['clienteId']);
				$recordatorio->setUsuarioId($Usr['usuarioId']);
				$recordatorio->setFecha($_POST['fecha']);
				$recordatorio->setMensaje($_POST['mensaje']);
								
				if($idReg)
					$success = $recordatorio->Update();
				else
					$success = $recordatorio->Save();
				
				if($success){					
					echo 'ok[#]';										
				}else{
					echo "fail[#]";					
					$util->ShowErrors();					
				}
				
			break;
								
		case 'delete':
				
				$recordatorio->setId($_POST['id']);
				
				if($recordatorio->Delete()){					
					echo 'ok[#]';					
				}
				
			break;
		
		case 'view':
				
				$recordatorio->setId($_POST['id']);
				$info = $recordatorio->Info();
				$info = $util->EncodeRow($info);
				$info['view'] = 1;
				
				echo 'ok[#]';
				
				$smarty->assign('info',$info);
				$smarty->display(DOC_ROOT.'/templates/boxes/'.$page.'.tpl');
																
			break;
		
		case 'loadPage':
								
				$recordatorio->setPage($_POST['p']);								
				$registros = $recordatorio->Enumerate();
				$registros['result'] = $util->EncodeResult($registros['result']);	
				
				$util->PrintErrors2();
				
				echo 'ok[#]';			
				
				$smarty->assign('registros',$registros);
				$smarty->display(DOC_ROOT.'/templates/lists/'.$page.'.tpl');
				
			break;
		
		case 'search':
				
				if($_POST['fechaIni'])
					$fecha = date('Y-m-d',strtotime($_POST['fechaIni']));
				if($_POST['fechaFin'])
					$fechaFin = date('Y-m-d',strtotime($_POST['fechaFin']));
				
				$recordatorio->setClienteId($_POST['clienteId2']);
				$recordatorio->setUsuarioId($_POST['usuarioId2']);
				$recordatorio->setFecha($fecha);
				$recordatorio->setFechaFin($fechaFin);
				
				$recordatorio->setPage($_POST['p']);
				$registros = $recordatorio->Search();
				$registros['result'] = $util->EncodeResult($registros['result']);	
				
				$util->PrintErrors2();
				
				echo 'ok[#]';
				
				$smarty->assign('search', 1);
				$smarty->assign('registros',$registros);
				$smarty->display(DOC_ROOT.'/templates/lists/'.$page.'.tpl');
				
			break;
		
	}//switch

?>