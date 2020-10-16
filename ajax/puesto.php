<?php
// echo "<pre>"; print_r($_POST);
// exit;
	include_once('../init.php');
	include_once('../config.php');
	include_once(DOC_ROOT.'/libraries.php');

	session_start();
	
	$page = 'puesto';
	
	
	$smarty->assign('page',$page);
	
	// $_POST["type"]= $_GET["type"];
	switch($_POST['type']){
	
		case 'add':
								
				echo 'ok[#]';	
				$smarty->assign('titleFrm','Agregar Personal');				
				$smarty->display(DOC_ROOT.'/templates/boxes/add_catalogo.tpl');
																
			break;
		
		case 'edit':
				
				$puesto->setId($_POST['id']);
				$info = $puesto->Info();
				// $info = $util->EncodeRow($info);	
				echo 'ok[#]';
				$smarty->assign('titleFrm','Editar Personal');
				$smarty->assign('info',$info);				
				$smarty->display(DOC_ROOT.'/templates/boxes/add_catalogo.tpl');
																
			break;
		case 'save':
				$puesto->setNombre($_POST['nombre']);
				$puesto->setCargo($_POST['cargo']);
				$puesto->setProfesion($_POST['profesion']);
				$puesto->setOficina($_POST['oficina']);
				$puesto->setActivo($_POST['activo']);
				//$puesto->setClave($_POST['clave_tramite']);
				$success = $puesto->Save();
				
				if($success){									
					echo 'ok[#]';     					
				}else{
					echo "fail[#]";					
					$util->ShowErrors();					
				}
				
			break;
		case 'update':
		        $puesto->setId($_POST['id']);
				$puesto->setNombre($_POST['nombre']);
				$puesto->setCargo($_POST['cargo']);
				$puesto->setProfesion($_POST['profesion']);
				$puesto->setOficina($_POST['oficina']);
				$puesto->setActivo($_POST['activo']);
				$success = $puesto->Update();
				if($success){									
					echo 'ok[#]';									
				}else{
					echo "fail[#]";					
					$util->ShowErrors();					
				}
				
			break;
								
		case 'delete':
				
				$puesto->setId($_POST['id']);
				
				if($puesto->Delete()){					
					echo 'ok[#]';				
				}
				
			break;
		
		case 'loadPage':
		
				$puesto->setPage($_POST['p']);								
				$registros = $puesto->Enumerate();
				$util->PrintErrors2();
				echo 'ok[#]';			
				$smarty->assign('registros',$registros);
				$smarty->display(DOC_ROOT.'/templates/lists/'.$page.'.tpl');
				
			break;
			
	break;
}//switch

?>