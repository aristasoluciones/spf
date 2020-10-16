<?php
// echo "<pre>"; print_r($_POST);
// exit;
	include_once('../init.php');
	include_once('../config.php');
	include_once(DOC_ROOT.'/libraries.php');

	session_start();
	
	$page = 'cliente';
	
	
	$smarty->assign('page',$page);
	
	// $_POST["type"]= $_GET["type"];
	switch($_POST['type']){
	
		case 'add':
								
				echo 'ok[#]';	
				$smarty->assign('titleFrm','Agregar cliente');				
				$smarty->display(DOC_ROOT.'/templates/boxes/add_catalogo.tpl');
																
			break;
		
		case 'edit':
				
				$cliente->setId($_POST['id']);
				$info = $cliente->Info();
				// $info = $util->EncodeRow($info);	
				echo 'ok[#]';
				$smarty->assign('titleFrm','Editar cliente');
				$smarty->assign('info',$info);				
				$smarty->display(DOC_ROOT.'/templates/boxes/add_catalogo.tpl');
																
			break;
		case 'save':

				$cliente->setNombre($_POST['nombre']);
				$cliente->setEncargado($_POST['encargado']);
				$cliente->setDireccion($_POST['direccion']);
				$cliente->setDescripcion($_POST['descripcion']);
				$cliente->setCordenadaY($_POST['cordenaday']);
				$cliente->setCordenadaX($_POST['cordenadax']);
				$cliente->setHorario($_POST['horario']);
				//$cliente->setClave($_POST['clave_tramite']);
				$success = $cliente->Save();
				
				if($success){									
					echo 'ok[#]';     					
				}else{
					echo "fail[#]";					
					$util->ShowErrors();					
				}
				
			break;
		case 'update':

		        $cliente->setId($_POST['id']);
				$cliente->setNombre($_POST['nombre']);
				$cliente->setPaterno($_POST['apaterno']);
				$cliente->setMaterno($_POST['amaterno']);
				$cliente->setEmail($_POST['email']);
				$success = $cliente->Update();
				if($success){									
					echo 'ok[#]';									
				}else{
					echo "fail[#]";					
					$util->ShowErrors();					
				}
				
			break;
								
		case 'remove':
				
				$cliente->setId($_POST['id']);
				if($cliente->Delete()){					
					echo 'ok[#]';				
				}else
				{
					echo 'fail[#]';
				}
				
	    break;
	    case 'activar':
				$cliente->setId($_POST['id']);
				if($cliente->Activar()){					
					echo 'ok[#]';				
				}else
				{
					echo 'fail[#]';
				}
				
	    break;
		
			
	break;
}//switch

?>