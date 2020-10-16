<?php
// echo "<pre>"; print_r($_POST);
// exit;
	include_once('../init.php');
	include_once('../config.php');
	include_once(DOC_ROOT.'/libraries.php');

	session_start();
	
	$page = 'cliente';
	
	
	$smarty->assign('page',$page);
	
	
	switch($_POST['type']){
	
		
	    case 'buscarCliente':
		
			$cliente->setNombre($_POST['nombre']);
			$cliente->setSexo($_POST['sexo']);
			$cliente->setInicio($_POST['inicio']);
			$cliente->setFin($_POST['fin']);
			$lst = $cliente->Enumerate();
			
			$smarty->assign('registros',$lst);			
			$smarty->display(DOC_ROOT.'/templates/lists/customer-basic.tpl');
				
	    break;
		
			
	break;
}//switch

?>