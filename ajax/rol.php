<?php
/*echo "<pre>"; print_r($_POST);
exit;*/
include_once('../init.php');
include_once('../config.php');
include_once(DOC_ROOT . '/libraries.php');

session_start();

$page = 'rol';


$smarty->assign('page', $page);

// $_POST["type"]= $_GET["type"];
switch ($_POST['type']) {
    case 'open_config':
        $id = $_POST['id'];
        $objRole->setRoleId($id);
        $role = $objRole->Info();
        $modulos = $objRole->getConfigRol();

        $roles = $objRole->Enumerate();
        $smarty->assign('roles', $roles);
        $smarty->assign('info', $role);
        $smarty->assign('modulos', $modulos);
        $smarty->display(DOC_ROOT . '/templates/boxes/config_rol.tpl');
        break;

    case 'add':
        echo 'ok[#]';
        $smarty->assign('titleFrm', 'Agregar Rol');
        $smarty->display(DOC_ROOT . '/templates/boxes/add_catalogo.tpl');
        break;

    case 'edit':
        $objRole->setRoleId($_POST['id']);
        $info = $objRole->Info();
        echo 'ok[#]';
        $smarty->assign('titleFrm', 'Editar Rol');
        $smarty->assign('info', $info);
        $smarty->display(DOC_ROOT . '/templates/boxes/add_catalogo.tpl');

        break;
    case 'save':
        $objRole->setName($_POST['nombre']);
        if($objRole->Save())
        {
            $roles = $objRole->Enumerate();
            $smarty->assign('roles',$roles);
            echo "ok[#]";
            $smarty->display(DOC_ROOT.'/templates/boxes/messages.tpl');
            echo "[#]";
            $smarty->display(DOC_ROOT.'/templates/lists/rol.tpl');
        }
        else{
            echo "fail[#]";
            $smarty->display(DOC_ROOT.'/templates/boxes/messages_no_format.tpl');
        }
        break;
    case 'update':
        $objRole->setRoleId($_POST['id']);
        $objRole->setName($_POST['nombre']);
        if($objRole->Update())
        {
            $roles = $objRole->Enumerate();
            $smarty->assign('roles',$roles);
            echo "ok[#]";
            $smarty->display(DOC_ROOT.'/templates/boxes/messages.tpl');
            echo "[#]";
            $smarty->display(DOC_ROOT.'/templates/lists/rol.tpl');
        }
        else{
            echo "fail[#]";
            $smarty->display(DOC_ROOT.'/templates/boxes/messages_no_format.tpl');
        }
        break;
    case 'save_config':
        $objRole->setRoleId($_POST["id"]);
        if ($objRole->saveConfigRol()) {
            echo "ok[#]";
        } else {
            echo "fail[#]";
        }
        break;

    case 'deleteRol':
        $objRole->setRoleId($_POST['id']);
        if ($objRole->Delete()) {
            $roles = $objRole->Enumerate();
            $smarty->assign('roles',$roles);
            echo "ok[#]";
            $smarty->display(DOC_ROOT.'/templates/boxes/messages.tpl');
            echo "[#]";
            $smarty->display(DOC_ROOT.'/templates/lists/rol.tpl');
        } else
            echo "fail[#]";

        break;

    case 'loadPage':

        $cat_tramite->setPage($_POST['p']);
        $registros = $cat_tramite->Enumerate();
        $util->PrintErrors2();
        echo 'ok[#]';
        $smarty->assign('registros', $registros);
        $smarty->display(DOC_ROOT . '/templates/lists/' . $page . '.tpl');

        break;

}//switch

?>