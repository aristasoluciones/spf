<?php

	include_once('../init.php');
	include_once('../config.php');
	include_once(DOC_ROOT.'/libraries.php');

	session_start();
	
	$page = 'usuario';
	
	$smarty->assign('titleFrm','Usuario');
	$smarty->assign('page',$page);
	
	switch($_POST['type']){
	
		case 'add':	
		        $reg_roles =  $objRole->getListRoles();
		        $lsts =  $sucursal->EnumerateAll();
		        $smarty->assign('lsts',$lsts);			
		        $smarty->assign('registros_roles',$reg_roles);			
				echo 'ok[#]';
				$smarty->display(DOC_ROOT.'/templates/boxes/'.$page.'.tpl');											
			break;
		
		case 'edit':
				$usuario->setId($_POST['id']);
				$info = $usuario->Info();
				 $lsts =  $sucursal->EnumerateAll();
		        $smarty->assign('lsts',$lsts);		
			    $reg_roles =  $objRole->getListRoles();
		        $smarty->assign('registros_roles',$reg_roles);				
				echo 'ok[#]';				
				$smarty->assign('info',$info);				
				$smarty->display(DOC_ROOT.'/templates/boxes/'.$page.'.tpl');
																
			break;		
		case 'save':
				if(isset($_POST["activo"]))
					 $activo = 1;
				   else
				   	 $activo = 0;

				$idReg = $_POST['id'];
				$usuario->setId($idReg);
				$usuario->setNombre($_POST['nombre']);
				$usuario->setTelefono($_POST['telefono']);
				$usuario->setEmail($_POST['email'],true);
				$usuario->setUsuario($_POST['usuario']);
				$usuario->setPasswd($_POST['passwd'],"si");
				$usuario->setTipo($_POST['tipo']);
				$usuario->setActivo($activo);
				$usuario->setApaterno($_POST['apaterno']);
				$usuario->setAmaterno($_POST['amaterno']);
                $usuario->setFechaNacimiento($_POST['fechanacimiento']);
				$usuario->setCalle($_POST['calle']);
				$usuario->setNoExterior($_POST['nexterior']);
				$usuario->setColonia($_POST['colonia']);
				$usuario->setCiudad($_POST['ciudad']);
				$usuario->setEstado($_POST['estado']);
				$usuario->setPais($_POST['pais']);
				$usuario->setSucursalId($_POST['sucursalId']);
				$success = $usuario->Save();
				if($success){
			      echo 'ok[#]';
				}else{
					echo "fail[#]";					
					$util->ShowErrors();					
				}
				
			break;
			case 'update':
				if(isset($_POST["activo"]))
					 $activo = 1;
				   else
				   	 $activo = 0;
				//idReg es el id del usuario que se esta editando
				$idReg = $_POST['id'];
				$usuario->setId($idReg);
				$usuario->setNombre($_POST['nombre']);
				$usuario->setTelefono($_POST['telefono']);
				$usuario->setEmail($_POST['email'],true);
				$usuario->setUsuario($_POST['usuario']);
				$usuario->setPasswd($_POST['passwd'],"no");
				$usuario->setTipo($_POST['tipo']);
				$usuario->setActivo($activo);
				$usuario->setApaterno($_POST['apaterno']);
				$usuario->setAmaterno($_POST['amaterno']);
                $usuario->setFechaNacimiento($_POST['fechanacimiento']);
				$usuario->setCalle($_POST['calle']);
				$usuario->setNoExterior($_POST['nexterior']);
				$usuario->setColonia($_POST['colonia']);
				$usuario->setCiudad($_POST['ciudad']);
				$usuario->setEstado($_POST['estado']);
				$usuario->setPais($_POST['pais']);
				$usuario->setSucursalId($_POST['sucursalId']);
				$success = $usuario->Update();
				if($success){
				 echo 'ok[#]';

				}else{
					echo "fail[#]";					
					$util->ShowErrors();					
				}
			break;
								
		case 'delete':
				$usuario->setId($_POST['id']);
				if($usuario->Delete()){					
					echo 'ok[#]';				
				}
				
			break;
		
		case 'view':
				
				$usuario->setId($_POST['id']);
				$info = $usuario->Info();
				// $listEstablo = $usuario->ListarEstablo();
				
				$info['view'] = 1;
				
				echo 'ok[#]';
				
				// $smarty->assign('listEstablo',$listEstablo);
				$smarty->assign('info',$info);
				$smarty->display(DOC_ROOT.'/templates/boxes/'.$page.'.tpl');
																
			break;
		
		case 'loadMunicipios':
				
				$municipios = $util->EnumMunicipios($_POST['estadoId']);
				$municipios = $util->EncodeResult($municipios);
				
				echo 'ok[#]';
				
				$smarty->assign('municipios',$municipios);
				$smarty->display(DOC_ROOT.'/templates/lists/enum-municipios.tpl');
				
			break;
		
		case 'loadPage':
				
				if($_POST["page"]=="ciudadano"){
					$usuario->tipoReporte("ciudadano");
				}else{
					$usuario->tipoReporte("admin");
				}
				
				// echo "<pre>"; print_r($_POST);
				// echo $page;
				// exit;
				$usuario->setPage($_POST['p']);								
				$registros = $usuario->Enumerate();
				$registros['result'] = $util->EncodeResult($registros['result']);	
				
				$util->PrintErrors2();
				
				echo 'ok[#]';			
				if($_POST["page"]=="ciudadano"){
					$smarty->assign('registrosC',$registros);
					$smarty->display(DOC_ROOT.'/templates/lists/ciudadano.tpl');
				}else{
					$smarty->assign('registros',$registros);
					$smarty->display(DOC_ROOT.'/templates/lists/'.$page.'.tpl');
				}
				
				
				
				
			break;
		
	}//switch

?>