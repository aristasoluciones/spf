<?php
    //comprobar privilegios de acceso a modulo
    $user->AllowAccess(19);
    $user->AllowAccess(20);

    $victima->setVictimaId($_GET["id"]);
    $dataVictima = $victima->Info();

    $registros = $encuesta->getListEncuesta();
    $smarty->assign('encuestas',$registros);
    $smarty->assign('post',$dataVictima);
