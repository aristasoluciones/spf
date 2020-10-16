<?php
// echo "<pre>"; print_r($_POST);
// exit;
	include_once('../init.php');
	include_once('../config.php');
	include_once(DOC_ROOT.'/libraries.php');

	session_start();
	
	$page = 'sucursal';
	
	
	$smarty->assign('page',$page);
	
	// $_POST["type"]= $_GET["type"];
	switch($_POST['type']){
	
		case 'add':
				
				$lstM = $sucursal->enumerateMunicipio();
			
				echo 'ok[#]';	
				$smarty->assign('lstM',$lstM);				
				$smarty->assign('titleFrm','Agregar sucursal');				
				$smarty->display(DOC_ROOT.'/templates/boxes/add_catalogo.tpl');
																
			break;
		
		case 'edit':
		
				$lstM = $sucursal->enumerateMunicipio();
	
			
				$sucursal->setId($_POST['id']);
				$info = $sucursal->Info();
				// $info = $util->EncodeRow($info);	
				echo 'ok[#]';
				$smarty->assign('lstM',$lstM);
				$smarty->assign('titleFrm','Editar Sucursal');
				$smarty->assign('info',$info);				
				$smarty->display(DOC_ROOT.'/templates/boxes/add_catalogo.tpl');
																
			break;
		case 'save':

		  		if($_POST["cordenaday"]=="")
		        	$_POST["cordenaday"] = 0;

		        if($_POST["cordenadax"]=="")
		        	$_POST["cordenadax"] = 0;

				$sucursal->setNombre($_POST['nombre']);
				$sucursal->setEncargado($_POST['encargado']);
				$sucursal->setDireccion($_POST['direccion']);
				$sucursal->setDescripcion($_POST['descripcion']);
				$sucursal->setCordenadaY($_POST['cordenaday']);
				$sucursal->setCordenadaX($_POST['cordenadax']);
				$sucursal->setHorario($_POST['horario']);
				$sucursal->setMunicipioId($_POST['municipio']);
				//$sucursal->setClave($_POST['clave_tramite']);
				$success = $sucursal->Save();
				
				if($success){									
					echo 'ok[#]';     					
				}else{
					echo "fail[#]";					
					$util->ShowErrors();					
				}
				
			break;
		case 'update':
		        if($_POST["cordenaday"]=="")
		        	$_POST["cordenaday"] = 0;

		        if($_POST["cordenadax"]=="")
		        	$_POST["cordenadax"] = 0;

		        $sucursal->setId($_POST['id']);
				$sucursal->setNombre($_POST['nombre']);
				$sucursal->setEncargado($_POST['encargado']);
				$sucursal->setDireccion($_POST['direccion']);
				$sucursal->setDescripcion($_POST['descripcion']);
				$sucursal->setCordenadaY($_POST['cordenaday']);
				$sucursal->setCordenadaX($_POST['cordenadax']);
				$sucursal->setHorario($_POST['horario']);
				$sucursal->setMunicipioId($_POST['municipio']);
				$success = $sucursal->Update();
				if($success){									
					echo 'ok[#]';									
				}else{
					echo "fail[#]";					
					$util->ShowErrors();					
				}
				
			break;
								
		case 'remove':
				
				$sucursal->setId($_POST['id']);
				if($sucursal->Delete()){					
					echo 'ok[#]';				
				}else
				{
					echo 'fail[#]';
				}
				
	    break;
	    case 'activar':
				$sucursal->setId($_POST['id']);
				if($sucursal->ActiveSucursal()){					
					echo 'ok[#]';				
				}else
				{
					echo 'fail[#]';
				}
				
	    break;
		
		case 'loadPage':
		
				$sucursal->setPage($_POST['p']);								
				$registros = $sucursal->Enumerate();
				$util->PrintErrors2();
				echo 'ok[#]';			
				$smarty->assign('registros',$registros);
				$smarty->display(DOC_ROOT.'/templates/lists/'.$page.'.tpl');
				
			break;
			
	break;
}//switch

?>