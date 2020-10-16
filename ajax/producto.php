<?php
// echo "<pre>"; print_r($_POST);
// exit;
	include_once('../init.php');
	include_once('../config.php');
	include_once(DOC_ROOT.'/libraries.php');

	session_start();
	
	$page = 'producto';
	$smarty->assign('page',$page);
	
	// $_POST["type"]= $_GET["type"];
	switch($_POST['type']){
	
		case 'add':
								
				echo 'ok[#]';	
				$smarty->assign('titleFrm','Agregar Categoria');				
				$smarty->display(DOC_ROOT.'/templates/boxes/add_catalogo.tpl');
																
		break;
		case 'add_pcat':
		        $producto->setId($_POST['id']);
				$info2 =  $producto->Info();
				echo 'ok[#]';
				$page = 'producto_cat';	
				$smarty->assign('page',$page);
				$smarty->assign('info2',$info2);
				$smarty->assign('titleFrm','Agregar producto a categoria');				
				$smarty->display(DOC_ROOT.'/templates/boxes/add_catalogo.tpl');
																
		break;
		
		case 'edit_pcat':
				
				$producto->setId($_POST['id']);
				$info = $producto->Info2();
				$page = 'producto_cat';	
				// $info = $util->EncodeRow($info);	
				echo 'ok[#]';
				$smarty->assign('page',$page);
				$smarty->assign('titleFrm','Editar Producto');
				$smarty->assign('info',$info);				
				$smarty->display(DOC_ROOT.'/templates/boxes/add_catalogo.tpl');
																
			break;
		case 'edit':
				
				$producto->setId($_POST['id']);
				$info = $producto->Info();
				// $info = $util->EncodeRow($info);	
				echo 'ok[#]';
				$smarty->assign('titleFrm','Editar Producto / Articulo');
				$smarty->assign('info',$info);				
				$smarty->display(DOC_ROOT.'/templates/boxes/add_catalogo.tpl');
																
		break;
		case 'save':
		
	
		        $up_image  = false;
                $prefix_cat = "categoria";
                $urldestino=DOC_ROOT_IMG."/categorias/";
	            $urlwebroot=WEB_ROOT_IMG."/categorias/";

				$producto->setNombre($_POST['nombre']);
				$producto->setDescripcion($_POST['descripcion']);
				$producto->setAquien($_POST['aquien']);
				$producto->setVentaja($_POST['ventaja']);
				$last_id = $producto->getLastIdCat();
				$next_id = $last_id +1;
				//se comprueba si se subio alguna imagen
				if(is_uploaded_file($_FILES["imgCategoria"]["tmp_name"]))
				{
                   /* comprobar si el archivo esta permitido y no exceda el limite maximo en kb*/
				  if (in_array($_FILES['imgCategoria']['type'], $archivos_permitidos) && $_FILES['img']['size'] <= $limite_kb * 1024){
     	  	          # obtenermos extension del archivo
     	  	          $extension =  explode(".",$_FILES["imgCategoria"]["name"]);
                      $ext = end($extension);
        		
				  	  $imagen_temporal = $_FILES['imgCategoria']['tmp_name'];
				  	  $targetPath =  $urldestino.$prefix_cat.$next_id.".".$ext;

                      $producto->setTipo($ext);
                      $producto->setUrl($urlwebroot);
                      $producto->setNarchivo($prefix_cat.$next_id);
				  	  /*$data=file_get_contents($imagen_temporal);

				  	  //escapamos los caracteres especiales
				  	  $util->DB()->setDataString($data);
				  	  $data_escape = $util->DB()->EscapeString();
				  	  //guardamos en la base de datos toda la informacion
                      $producto->setAnchura($infoImg[0]);
                      $producto->setAltura($infoImg[1]);
                      $producto->setTipo($tipo);
                      $producto->setDataBloob($data_escape);*/
                      $up_image=true;
    				}
				}
				$success = $producto->Save();
				if($success){
					//comprobar si se va subir imagen con la variable $up_image 
					//solo se suve la imagen si cumple con lo requerido osea extension y peso
					//de lo contrario no se sube por lo tanto solo se sube los datos de la categoria
					if($up_image)
				    {
				    	if(move_uploaded_file($imagen_temporal,$targetPath))
		                 {                
		                   echo 'ok[#]';	
		                 }
		                 else
		                 {
		                 	//si hubo error al mover archivo eliminar en la base de datos
		                 	$producto->setId($next_id);
		                 	$producto->RollBackDataCat();
		                 	echo "fail[#]";	
		                 	$util->setError(10136, 'error', '');
		                 	$util->PrintErrors();			
							$util->ShowErrors();
		                 }
				    }else
				    {
					 echo 'ok[#]';
				    }
                   					
				}else{
					echo "fail[#]";					
					$util->ShowErrors();					
				}
				
			break;
		case 'update':
		        $imagen_temporal = $ext = $targetPath ="";
		        
				$up_image  = false;
                $prefix_cat = "categoria";
                $urldestino=DOC_ROOT_IMG."/categorias/";
	            $urlwebroot=WEB_ROOT_IMG."/categorias/";

		        $producto->setId($_POST['id']);
				$producto->setNombre($_POST['nombre']);
				$producto->setDescripcion($_POST['descripcion']);
				$producto->setAquien($_POST['aquien']);
				$producto->setVentaja($_POST['ventaja']);
				
				//se comprueba si se subio alguna imagen
				if(is_uploaded_file($_FILES["imgCategoria"]["tmp_name"]))
				{ 
                   /* comprobar si el archivo esta permitido y no exceda el limite maximo en kb*/
				  if (in_array($_FILES['imgCategoria']['type'], $archivos_permitidos) && $_FILES['imgCategoria']['size'] <= $limite_kb * 1024){

     	  	          # obtenermos extension del archivo
     	  	          $extension =  explode(".",$_FILES["imgCategoria"]["name"]);
                      $ext = end($extension);
        		
				  	  $imagen_temporal = $_FILES['imgCategoria']['tmp_name'];
				  	  $targetPath =  $urldestino.$prefix_cat.$_POST['id'].".".$ext;

				  	 /* $tipo = $_FILES['imgCategoria']['type'];
				  	  $data=file_get_contents($imagen_temporal);

				  	  //escapamos los caracteres especiales
				  	  $util->DB()->setDataString($data);
				  	  $data_escape = $util->DB()->EscapeString();
				  	  //guardamos en la base de datos toda la informacion
                      $producto->setAnchura($infoImg[0]);
                      $producto->setAltura($infoImg[1]);
                      $producto->setTipo($tipo);
                      $producto->setDataBloob($data_escape);*/
                      $up_image  = true;
    				}
				}
				$success = $producto->Update();
				if($success){
				    //se comprueba si se actualizara la imagen si se actualiza  solo se modifica los 
				    //campos url tipo e imagen si llega ser satisfactoria la subida del archivo	
				    //si no pues no se actualiza la informacion de l aimagen se conserva la actual
				   if($up_image)
				   {
				     
                     if(move_uploaded_file($imagen_temporal,$targetPath))
		                {   
		                   $producto->setId($_POST['id']);
		                   $producto->setTipo($ext);
                           $producto->setUrl($urlwebroot);
                           $producto->setNarchivo($prefix_cat.$_POST['id']);
                           $producto->UpdateDataImage();
						 	echo 'ok[#]';
		                }
		                else
	                 	{
		                 	//si hubo error al mover archivo a servidor entonces arrojar mesj de que 
		                 	//hubo actualizacion en algunos campos menos en la imagen
		                 	echo "fail[#]";	
		                 	$util->setError(10136, 'error', 'Los cambios en texto se guardaron correctamente excepto la imagen. cerrar y recargar pagina');
		                 	$util->PrintErrors();			
							$util->ShowErrors();
	                 	}
		           
				   }else{
				   		echo 'ok[#]';
				   }								
					
                   						
				}else{
					echo "fail[#]";					
					$util->ShowErrors();					
				}
				
			break;
	
	
		case 'remove':
				
				$producto->setId($_POST['id']);
				if($producto->Delete()){					
					echo 'ok[#]';				
				}else
				{
					echo 'fail[#]';
				}
				
	    break;
	    case 'activar':
				$producto->setId($_POST['id']);
				if($producto->Activar()){					
					echo 'ok[#]';				
				}else
				{
					echo 'fail[#]';
				}
				
	    break;
		case 'removeCat':
				
				$producto->setId($_POST['id']);
				if($producto->DeleteCategoria()){					
					echo 'ok[#]';				
				}else
				{
					echo 'fail[#]';
				}
				
	    break;
		case 'save_pcat':

                $prefix ="img_pro_cat_".$_POST["categoria_id"];
	            $urldestino=DOC_ROOT_IMG."/productos_categorias/";
	            $urlwebroot=WEB_ROOT_IMG."/productos_categorias/";

	            if(isset($_POST["promocion"]))
					 $promocion = 'si';
				   else
				   	 $promocion = 'no';

	            $producto->setId($_POST['categoria_id']);
				$producto->setNombre($_POST['nombre']);
				$producto->setDescripcion($_POST['descripcion']);
				$producto->setCaracteristica($_POST['caracteristica']);
				$producto->setPrecioActual($_POST['pactual']);
				$producto->setPrecioAnterior($_POST['panterior']);
				$producto->setPromocion($promocion);
				$producto->setSustancia($_POST["sustancia"]);
				/*se comprueba si se subio alguna imagen*/
				if(is_uploaded_file($_FILES["img_pcat"]["tmp_name"]))
				{
					$producto->setFile($_FILES["img_pcat"]);
					$producto->setUrl($urlwebroot);
					$producto->setNarchivo( $_FILES["img_pcat"]["tmp_name"]);
				}
				//obtener la ultima fila insertada en la tabla productos_categorias
				$last_id = $producto->getLastIdPcat();
                $concatname = $last_id+1;
                

                //se guarda producto para la categoria
				$success = $producto->SavePcat();
				if($success){	
				 $archivo_temp =  $_FILES["img_pcat"]["tmp_name"];
                 $extension =  explode(".",$_FILES["img_pcat"]["name"]);
                 $ext = end($extension);
                 $targetPath =  $urldestino.$prefix.$concatname.".".$ext;
                  if(is_uploaded_file($_FILES["img_pcat"]["tmp_name"]))
				  {
                     if(move_uploaded_file($archivo_temp,$targetPath))
	                 {
	                   //actualizar extension del archivo y nombre
	                   $producto->setId($concatname);
	                   $producto->setNarchivo($prefix.$concatname);
	                   $producto->setExtension($ext);
	                   $producto->UpdateData();
	                   
	                   echo 'ok[#]';	
	                 }
	                 else
	                 {
	                 	//si hubo error al mover archivo eliminar en la base de datos
	                 	$producto->setId($concatname);
	                 	$producto->RollBackData();
	                 	echo "fail[#]";	
	                 	$util->setError(10136, 'error', '');
	                 	$util->PrintErrors();			
						$util->ShowErrors();
	                 }
	               }else
	               {
	               		echo 'ok[#]';	
	               }
				 
                   					
				}else{
					echo "fail[#]";					
					$util->ShowErrors();					
				}
			break;
		case 'update_pcat':
                $prefix ="img_pro_cat_".$_POST["categoria_id"];
	            $urldestino=DOC_ROOT_IMG."/productos_categorias/";
	            $urlwebroot=WEB_ROOT_IMG."/productos_categorias/";

	             if(isset($_POST["promocion"]))
					 $promocion = 'si';
				   else
				   	 $promocion = 'no';

				  if($_POST["panterior"]=="")
				  	 $_POST["panterior"]= 0;


	            $producto->setId($_POST['categoria_id']);
				$producto->setNombre($_POST['nombre']);
				$producto->setDescripcion($_POST['descripcion']);
				$producto->setCaracteristica($_POST['caracteristica']);
				$producto->setPrecioActual($_POST['pactual']);
				$producto->setPrecioAnterior($_POST['panterior']);
				$producto->setPromocion($promocion);
				$producto->setSustancia($_POST["sustancia"]);
				//se comprueba si se subio alguna imagen
				if(is_uploaded_file($_FILES["img_pcat"]["tmp_name"]))
				{
					$producto->setFile($_FILES["img_pcat"]);
					$producto->setUrl($urlwebroot);
					$producto->setNarchivo( $_FILES["img_pcat"]["tmp_name"]);
				}

				
			    $concatname = $_POST['pcat_id'];
                $producto->setPcatId($concatname);
                //se Atualiza datos del producto para la categoria
				$success = $producto->UpdatePcat();
				if($success){	
				 $archivo_temp =  $_FILES["img_pcat"]["tmp_name"];
                 $extension =  explode(".",$_FILES["img_pcat"]["name"]);
                 $ext = end($extension);
                 $targetPath =  $urldestino.$prefix.$concatname.".".$ext;
                 if(is_uploaded_file($_FILES["img_pcat"]["tmp_name"]))
                 {
	                 if(move_uploaded_file($archivo_temp,$targetPath))
	                 {
	                   //actualizar extension del archivo y nombre del registro
	                   $producto->setId($concatname);
	                   $producto->setNarchivo($prefix.$concatname);
	                   $producto->setExtension($ext);
	                   $producto->UpdateData();
	                   
	                   echo 'ok[#]';	
	                 }
	                 else
	                 {
	                 	//si hubo error al mover archivo eliminar en la base de datos
	                 	$producto->setId($concatname);
	                 	$producto->RollBackData();
	                 	echo "fail[#]";	
	                 	$util->setError(10136, 'error', '');
	                 	$util->PrintErrors();			
						$util->ShowErrors();
	                 }
				  }else
				  {
				  	 echo 'ok[#]';	
				  }
                   					
				}else{
					echo "fail[#]";					
					$util->ShowErrors();					
				}
			break;
            case 'openImportarCsv':
                echo 'ok[#]';
				$smarty->assign('titleFrm','Importar desde csv');
                $smarty->assign('post',$_POST);
				$smarty->display(DOC_ROOT.'/templates/boxes/importar-csv.tpl');
            break;
			case 'importar-csv':
                 switch ($_POST["table"]) {
				  	case 'producto':
                        if(is_uploaded_file($_FILES["fileCsv"]["tmp_name"]))
                        {
                           $ext_array = explode(".",$_FILES["fileCsv"]["name"]);
                           $ext = end($ext_array);
                             if (strtolower($ext)!="csv")
                          	 {
                          	 	echo "fail[#]";
                          	 	echo "Extension de archivo no valido";
                          	 	exit;
                          	 }

                          $filename = $_FILES["fileCsv"]["tmp_name"];
                          $fp = fopen($filename,"r");

                          while(($data = fgetcsv($fp,1000,","))!==false)
                          {
                          	 $producto->setId($data[0]);
                          	 $producto->setNombre($data[1]);
							 $producto->setDescripcion($data[2]);
							 $producto->setCaracteristica($data[3]);
							 $producto->setPrecioActual($data[4]);
							 $producto->setPrecioAnterior($data[5]);
							 $producto->setPromocion($data[6]);
							 $producto->setSustancia($data[7]);
							 $producto->SavePcat();

                          }

                          fclose($fp); 							
                        }
                        else
                        {
                        	echo "fail[#]";
                        	echo "No se ha cargado ningun archivo..";
                        }
				  	break;
                        
				  	case 'categoria':
                        if(is_uploaded_file($_FILES["fileCsv"]["tmp_name"]))
                        {
                            $extension =  end(explode(".",$_FILES['fileCsv']['name']));
                            $valid =  false;
                            $filesValid = array('Excel2007', 'Excel5');
                            if($extension=="csv" || $extension=="CSV"){
                                array_push($filesValid,'CSV');
                            }
                            $archivo = $_FILES["fileCsv"]["tmp_name"];
                            $typeFile =  PHPExcel_IOFactory::identify($archivo);
                            foreach ($filesValid as $type) {
                                $objReader = PHPExcel_IOFactory::createReader($type);
                                if ($objReader->canRead($archivo)) {
                                    $valid = true;
                                }
                            }
                            if(!$valid)
                            {
                                echo "fail[#]";
                                echo "No se puede leer archivo: extension no valida";
                                exit;
                            }
                            $objPHPExcel = $objReader->load($archivo);
                            $sheet = $objPHPExcel->getSheet(0);
                            $totalFilas = $sheet->getHighestRow();
                            $totalColumns = $sheet->getHighestColumn();
                            $maxCell = $sheet->getHighestRowAndColumn();
                            for ($row = 2; $row <= $totalFilas; $row++) {
                                $rowData = $sheet->rangeToArray('A' . $row . ':' . $totalColumns . $row);
                                if (in_array('', $rowData[0])) {
                                    echo "fail[#]";
                                    echo "Verificar archivo, formato incorrecto, fila:" . $row;
                                    exit;
                                }
                            }
                            $ignorados =0;
                            $insertados =0;
                            for ($row = 2; $row <= $totalFilas; $row++) {

                                $sql ="SELECT * FROM categoria WHERE nombre='".trim($sheet->getCell("A".$row)->getValue())."' ";
                                $util->DB()->setQuery($sql);
                                $find = $util->DB()->GetRow();
                                if(!empty($find))
                                {
                                    $ignorados ++;
                                    continue;
                                }

                                $sql = "INSERT INTO  categoria (
                                            `nombre`, 
                                            `descripcion`,
                                            `aquien`,
                                            `ventajas`                                              
                                            )
                                            VALUES (
                                            '".trim($sheet->getCell("A".$row)->getValue())."',
                                            '".trim($sheet->getCell("B".$row)->getValue())."',
                                            '".trim($sheet->getCell("C".$row)->getValue())."',
                                            '".trim($sheet->getCell("D".$row)->getValue())."'                                
                                            );
                                    ";
                                $util->DB()->setQuery($sql);
                                $util->DB()->InsertData();
                                $insertados++;


                            }
                          unset($objReader);
                          unset($objPHPExcel);
                          echo "ok[#]";
                          echo $insertados." registros nuevos insertados, ".$ignorados." registros ignorados por encontrarse registrado en el sistema";

                        }else{
                            echo "fail[#]";
                            echo "No se ha cargado ningun archivo..";
                        }

				  	break;
				  	
				  	default:
				  	     echo "fail[#]";
				  		 echo "Seleccione tipo de importacion";
				  		break;
				  }

			break;
		
}//switch

?>