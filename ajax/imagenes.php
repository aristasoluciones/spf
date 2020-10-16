<?php
// echo "<pre>"; print_r($_POST);
// exit;
	include_once('../init.php');
	include_once('../config.php');
	include_once(DOC_ROOT.'/libraries.php');

	session_start();
	
	$page = 'imagen';
	
	
	$smarty->assign('page',$page);
	
	// $_POST["type"]= $_GET["type"];
	switch($_POST['type']){
	
		case 'add':
								
				echo 'ok[#]';
				$listp = $producto->EnumerateAll();	
				$smarty->assign('listp',$listp);				
				$smarty->display(DOC_ROOT.'/templates/boxes/imagenes.tpl');
																
			break;
		
		case 'edit':
				
				$imagen->setId($_POST['id']);
				$info = $imagen->InfoSlider();
				// echo "<pre>"; print_r($info);
				echo 'ok[#]';
				$smarty->assign('info',$info);				
				$smarty->display(DOC_ROOT.'/templates/boxes/imagenes.tpl');
																
			break;   
        case 'save':
                // echo "<pre>"; print_r($_POST);
				// exit;
				$imagen->setId($_POST["id"]);
				$imagen->setNombreSlider($_POST["nombre"]);
				$imagen->setDescripcion($_POST["descripcion"]);
				$imagen->setActivo($_POST["activo"]);
				
				if($imagen->SaveSlider()){
					echo "ok[#]";
				}else{
					echo "fail[#]";
					$util->ShowErrors();	
				}
				
				
		break;
			
		case 'update':
		        $imagen->setId($_POST['id']);
				$imagen->setNombre($_POST['nombre']);
				$imagen->setDescripcion($_POST['descripcion']);
				$imagen->setAquien($_POST['aquien']);
				$imagen->setVentaja($_POST['ventaja']);
				$success = $imagen->Update();
				
				if($success){									
					echo 'ok[#]';
                   					
				}else{
					echo "fail[#]";					
					$util->ShowErrors();					
				}
				
			break;
	
	
		case 'delete':
				
				$dependencia->setId($_POST['id']);
				
				if($dependencia->Delete()){					
					echo 'ok[#]';				
				}
				
	    break;
		
		case 'loadPage':
		
				$imagen->setPage($_POST['p']);								
				$registros = $imagen->Enumerate();
				$util->PrintErrors2();
				echo 'ok[#]';			
				$smarty->assign('registros',$registros);
				$smarty->display(DOC_ROOT.'/templates/lists/'.$page.'.tpl');
				
		break;
		
}//switch

?>