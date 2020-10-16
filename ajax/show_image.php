<?php

   include_once('../init.php');
	include_once('../config.php');
	include_once(DOC_ROOT.'/libraries.php');

/*	session_start();
    phpinfo();
    exit;*/

	$producto->setId($_GET["id"]);
	$info = $producto->Info();

  /*  header("Content-Type:".$info["tipo"]);
    echo base64_encode($info['imagen']);*/
     echo '<img src="data:'.$info['tipo'].';base64,'.base64_encode($info["imagen"]).'"/>';

    ?>