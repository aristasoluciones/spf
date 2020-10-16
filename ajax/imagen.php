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
				$smarty->display(DOC_ROOT.'/templates/forms/add_image.tpl');
																
			break;
		
		case 'edit':
				
				$imagen->setId($_POST['id']);
				$info = $imagen->Info();
				// $info = $util->EncodeRow($info);	
				echo 'ok[#]';
				$smarty->assign('titleFrm','Editar imagen / Articulo');
				$smarty->assign('info',$info);				
				$smarty->display(DOC_ROOT.'/templates/boxes/add_catalogo.tpl');
																
			break;   
        case 'save':
                if($_POST["tipo_imagen"]=="empty")
                	 $_POST["tipo_imagen"] = "";

              
                $imagen->setTipo($_POST['tipo_imagen']);
                $imagen->setFile($_FILES["image_file"]);
                if($_POST["tipo_imagen"]=="producto")
                {
                	$imagen->setProductoId($_POST['producto_id']);
                	$imagen->setDescripcion($_POST['descripcion']);
                	$prefix =  "producto";
                	$urldestino=DOC_ROOT_IMG."/catalogo/";	
                }
                elseif($_POST["tipo_imagen"]=="slider"){
                	$imagen->setProductoId(0);
                	$imagen->setDescripcion("no aplica");
                	$prefix =  "slider";
                	$urldestino=DOC_ROOT_IMG."/slider/";
                }
                //guardar en  bae de datos y archivo
                $last_id = $imagen->getLastId();
                $concatname = $last_id+1;
                $imagen->setNombre( $_FILES["image_file"]["tmp_name"]);
                
                //se guarda imagen de la categoria
				$success = $imagen->SavePcat();
				if($success){	
                 $archivo_temp =  $_FILES["image_file"]["tmp_name"];
                 $extension =  explode(".",$_FILES["image_file"]["name"]);
                 $ext = end($extension);
                 $targetPath =  $urldestino.$prefix.$concatname.".".$ext;
	                 if(move_uploaded_file($archivo_temp,$targetPath))
	                 {
	                   //actualizar extension del archivo y nombre
	                   $imagen->setId($concatname);
	                   $imagen->setNombre($prefix.$concatname);
	                   $imagen->setExtension($ext);
	                   $imagen->UpdateData();
	                   
	                   echo 'ok[#]';	
	                 }
	                 else
	                 {
	                 	//si hubo error al mover archivo eliminar en la base de datos
	                 	$imagen->setId($concatname);
	                 	$imagen->RollBackData();
	                 	echo "fail[#]";	
	                 	$util->setError(10136, 'error', '');
	                 	$util->PrintErrors();			
						$util->ShowErrors();
	                 }
				 
                   					
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