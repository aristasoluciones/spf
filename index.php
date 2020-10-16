<?php

	include_once('init.php');
	include_once('config.php');
	include_once(DOC_ROOT.'/libraries.php');
	
	if (!isset($_SESSION))
	  session_start();

	$pages = array(

	    #inicio de session y configuracion	
		'login',
		'logout', 
        'homepage',		
		'config',
		'rol',
		'perm_accion',
		'usuario',
		'cat_electronico',
		'empresa',
		'nota',
		'colonia',

		#catalogos
        'poll',
		    'question',
            'poll-analytics',
		'cliente',
		'estado',
		'municipio',
		'sucursal',
		'puesto',
		'producto',
		'producto_cat',
		'imagen',
        'download-formato',

		'imagenes',
		
		#encuestasrealizadas
		'customer-basic',
		'geolocation',
        'do-poll',
        'poll-result-pdf',
        'done-polls',
        'statistics',

		
	);
	
	$page = $_GET['page'];
	$section = $_GET['section'];
	if(!in_array($page, $pages))
		$page = 'homepage';
	
	//echo $page; exit;

	include_once(DOC_ROOT.'/modules/user.php');
	include_once(DOC_ROOT.'/modules/'.$page.'.php');
	
	$smarty->assign('page', $page);
	$smarty->assign('section', $section);
	$smarty->assign('time', time());
		
	$pageTpl = ($section == '') ? $page : $page.'_'.$section;
	
	$smarty->assign('pageTpl', $pageTpl);
	$smarty->assign('lang', $lang);

	$smarty->assign('miColor',$miColor);
	$smarty->assign('FOOTER', FOOTER);

	if($page == 'login'){
		$smarty->display(DOC_ROOT.'/templates/login.tpl');
	
	}
	else{
	
		$_SESSION['Usr']['page'] = $page;
		$smarty->display(DOC_ROOT.'/templates/index.tpl');
	}
?>