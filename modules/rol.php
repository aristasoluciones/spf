<?php
    $user->AllowAccess(1);
    $user->AllowAccess(6);

	$roles = $objRole->Enumerate();
	$smarty->assign('roles',$roles);
	
?>