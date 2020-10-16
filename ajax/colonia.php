<?php
	include_once('../init.php');
	include_once('../config.php');
	include_once(DOC_ROOT.'/libraries.php');

	session_start();
	
	$page = 'colonia';
	
	$smarty->assign('titleFrm','Colonia');
	$smarty->assign('page',$page);
	
	switch($_POST['type']){
	
		case 'add':	
			    $lstMus = $municipio->EnumerateAll();
				echo 'ok[#]';

                $smarty->assign('titleFrm',"Agregar colonia");
				$smarty->assign('municipios',$lstMus);
				$smarty->display(DOC_ROOT.'/templates/boxes/'.$page.'.tpl');											
			break;
		
		case 'edit':
		        $colonia->setId($_POST["id"]);
				$info = $colonia->Info();
				$lstMus = $municipio->EnumerateAll();
				echo 'ok[#]';
				$smarty->assign('municipios',$lstMus);
				$smarty->assign('info',$info);				
				$smarty->display(DOC_ROOT.'/templates/boxes/'.$page.'.tpl');
																
			break;		
		case 'save':
			$colonia->setNombre($_POST["colonia"]);
			$colonia->setMunicipioId($_POST['municipioId']);
			$colonia->setCoordenadaX($_POST['cordenadax']);
            $colonia->setCoordenadaY($_POST['cordenaday']);
			$success = $colonia->Save();
			if($success){
                $usr = $_SESSION['Usr'];
                $objRole->setRoleId($_SESSION['Usr']["role_id"]);
                $lisPermisos = $objRole->permisoSegunRol();
			    $colonia->setPage($_POST['page']);
			    $registros = $colonia->EnumerateAll();
                echo 'ok[#]';
                $smarty->assign('privilegios',$lisPermisos);
                $smarty->assign('usr',$usr);
                $smarty->assign('registros',$registros);
                $smarty->display(DOC_ROOT.'/templates/lists/'.$page.'.tpl');

			}else{
				echo "fail[#]";					
				$util->ShowErrors();					
			}
				
		break;
        case 'update':
            $colonia->setId($_POST['id']);
            $colonia->setNombre($_POST["colonia"]);
            $colonia->setMunicipioId($_POST['municipioId']);
            $colonia->setCoordenadaX($_POST['cordenadax']);
            $colonia->setCoordenadaY($_POST['cordenaday']);
            $success = $colonia->Update();
            if($success){
                $usr = $_SESSION['Usr'];
                $objRole->setRoleId($_SESSION['Usr']["role_id"]);
                $lisPermisos = $objRole->permisoSegunRol();
                $colonia->setPage($_POST['page']);
                $registros = $colonia->EnumerateAll();
                echo 'ok[#]';
                $smarty->assign('privilegios',$lisPermisos);
                $smarty->assign('usr',$usr);
                $smarty->assign('registros',$registros);
                $smarty->display(DOC_ROOT.'/templates/lists/'.$page.'.tpl');

            }else{
                echo "fail[#]";
                $util->ShowErrors();
            }

            break;
							
		case 'delete':
            $colonia->setId($_POST['id']);
            if($colonia->Delete()){
                $usr = $_SESSION['Usr'];
                $objRole->setRoleId($_SESSION['Usr']["role_id"]);
                $lisPermisos = $objRole->permisoSegunRol();
                $colonia->setPage($_POST['page']);
                $registros = $colonia->EnumerateAll();
                echo 'ok[#]';
                $smarty->assign('privilegios',$lisPermisos);
                $smarty->assign('usr',$usr);
                $smarty->assign('registros',$registros);
                $smarty->display(DOC_ROOT.'/templates/lists/'.$page.'.tpl');
            }else{
                echo "fail[#]";
            }
				
			break;
		
		case 'loadPage':
            $objRole->setRoleId($_SESSION['Usr']["role_id"]);
            $lisPermisos = $objRole->permisoSegunRol();
            $smarty->assign('privilegios',$lisPermisos);
            $smarty->assign('usr',$usr);

            $colonia->setPage($_POST['p']);
            $registros = $colonia->EnumerateAll();
            echo 'ok[#]';
            $smarty->assign('registros',$registros);
            $smarty->display(DOC_ROOT.'/templates/lists/'.$page.'.tpl');
		break;
			
			case 'buscarSol':
			
				$municipio->setNombre($_POST['colonia']);
				$registros = $municipio->EnumerateColonia();
					// echo '<pre>'; print_r($registros);
	// exit;
				echo 'ok[#]';
				$smarty->assign('registros',$registros);
				$smarty->display(DOC_ROOT.'/templates/lists/colonia.tpl');
			
			break;
		
	}//switch

?>