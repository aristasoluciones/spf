<?php
// echo "<pre>"; print_r($_POST);
// exit;
	include_once('../init.php');
	include_once('../config.php');
	include_once(DOC_ROOT.'/libraries.php');

	session_start();
	
	$page = 'nota';
	$prefix =  "img_blog";
	
	
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
                $urldestino=DOC_ROOT_IMG."/blog/"; 
                $urldestino2=WEB_ROOT_IMG."/blog/";           
                
                $config->setTituloNota($_POST["tituloNota"]);
                $config->setDescripcion($_POST["descripcion"]);
                $config->setFile($_FILES["doc_file"]);
               
                //guardar en  bae de datos y archivo
                $last_id = $config->getLastIdBlog();
                $concatname = $last_id+1;
                //$imagen->setNombre( $_FILES["doc_file"]["tmp_name"]);
                
                //se guarda imagen de la categoria
				$success = $config->SaveBlog();
				if($success && is_uploaded_file($_FILES["doc_file"]["tmp_name"])){	
	                 $archivo_temp =  $_FILES["doc_file"]["tmp_name"];
	                 $extension =  explode(".",$_FILES["doc_file"]["name"]);
	                 $ext = end($extension);
	                 $targetPath =  $urldestino.$prefix.$concatname.".".$ext;
	                 $urlReal =  $urldestino2.$prefix.$concatname.".".$ext;
		                 if(move_uploaded_file($archivo_temp,$targetPath))
		                 {
		                   //actualizar extension del archivo y nombre
		                   $config->setId($concatname);
		                   $config->setUrl($urlReal);
		                   $config->UpdateData();

		                   //la nota anterior se debe desactivar
		                   $config->setId($concatname-1);
		                   $config->DesactivarAnterior();

		                   echo 'ok[#]';	
		                 }
		                 else
		                 {
		                 	//si hubo error al mover archivo eliminar en la base de datos
		                 	$config->setId($concatname);
		                 	$config->RollBackData();
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
		case 'saveCatalogo': 
                $urldestino=DOC_ROOT_IMG1."docs/";
                $nombreCat = "catalogo";
                $config->setFile($_FILES["doc_file"],true,'application/pdf');
                $success = $config->ComprobarCat();
                //si se subio una imagen se mueve a la carpeta docs que esta en la raiz de la pagina
                if(!$success){
					echo "fail[#]";					
				    $util->ShowErrors();
				}
				else{
				   
				    if(is_uploaded_file($_FILES["doc_file"]["tmp_name"])){	
		                 $archivo_temp =  $_FILES["doc_file"]["tmp_name"];
		                 $extension =  explode(".",$_FILES["doc_file"]["name"]);
		                 $ext = end($extension);
		                 $targetPath =  $urldestino.$nombreCat.".".$ext;
		                 	if(move_uploaded_file($archivo_temp,$targetPath))
			                 {
			                    echo 'ok[#]';
			                    $util->setError(10140, 'complete','');
			                 	$util->PrintErrors();	
			                 }
			                 else
			                 {
			                    echo "fail[#]";	
			                 	$util->setError(10136, 'error', 'Error al mover archivo');
			                 	$util->PrintErrors();			
								$util->ShowErrors();
			                 }
	                   					
					}else{
						echo "fail[#]";					
						$util->ShowErrors();					
					 }	
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