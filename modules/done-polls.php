<?php
    $user->AllowAccess(19);
    $user->AllowAccess(24);
    $victimas = $victima->Enumerate();
    $smarty->assign("results",$victimas);