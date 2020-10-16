<?php
include_once('../init.php');
include_once('../config.php');
include_once(DOC_ROOT . '/libraries.php');

session_start();

switch ($_POST['type']) {

    case 'add':
        $page = 'permisos';
        $smarty->assign('page', $page);
        echo 'ok[#]';
        $smarty->assign('titleFrm', 'Agregar permiso');
        $smarty->display(DOC_ROOT . '/templates/boxes/add_catalogo.tpl');

        break;

    case 'edit':

        $config->setId($_POST['id']);
        $info = $config->Info();

        $page = 'permisos';
        $smarty->assign('page', $page);
        echo 'ok[#]';
        $smarty->assign('titleFrm', 'Editar permiso');
        $smarty->assign('info', $info);
        $smarty->display(DOC_ROOT . '/templates/boxes/add_catalogo.tpl');

        break;

    case 'save':
        if ($util->ValidateRequireField($_POST["descripcion"], "Descripcion")) {
            $util->ValidateString($value, 100, 0, '');
        }
        if ($util->ValidateRequireField($_POST["nombre"], "Nombre corto")) {
            $util->ValidateString($value, 100, 0, '');
        }
        if ($util->PrintErrors()) {
            echo "fail[#]";
            $util->ShowErrors();
        } else {
            $perm_id = $rbac->Permissions->add($_POST['nombre'], $_POST['descripcion']);
            if ($perm_id) {
                $util->setError(10129, 'complete', '');
                $util->PrintErrors();
                echo 'ok[#]';
            } else {
                echo 'fail[#]';
            }

        }
        break;

    case 'update':
        if ($util->ValidateRequireField($_POST["descripcion"], "Descripcion")) {
            $util->ValidateString($value, 100, 0, '');
        }
        if ($util->ValidateRequireField($_POST["nombre"], "Nombre corto")) {
            $util->ValidateString($value, 100, 0, '');
        }
        if ($util->PrintErrors()) {
            echo "fail[#]";
            $util->ShowErrors();
        } else {
            if ($rbac->Permissions->edit($_POST["ID"], $_POST["nombre"], $_POST["descripcion"])) {
                $util->setError(10129, 'complete', '');
                $util->PrintErrors();
                echo 'ok[#]';
            } else {
                echo 'fail[#]';
            }

        }

        break;

    case 'delete':
        $dependencia->setId($_POST['id']);

        if ($dependencia->Delete()) {
            echo 'ok[#]';
        }
        break;

    case 'loadPage':

        $requisito->setPage($_POST['p']);
        $registros = $requisito->Enumerate();
        $util->PrintErrors2();
        echo 'ok[#]';
        $smarty->assign('registros', $registros);
        $smarty->display(DOC_ROOT . '/templates/lists/' . $page . '.tpl');

        break;
    case 'saveDatosEmpresa':
        $config->setNombre($_POST['nombre']);
        $config->setCiudad($_POST['ciudad']);
        $config->setEstado($_POST['estado']);
        $config->setPais($_POST['pais']);
        $config->setDireccion($_POST['direccion']);
        $config->setCp($_POST['cp']);
        $config->setEmail($_POST['email']);
        $config->setRfc($_POST['rfc']);
        $config->setTelefono($_POST['telefono']);
        //$puesto->setClave($_POST['clave_tramite']);
        $success = $config->SaveDatosEmpresa();

        if ($success) {
            echo 'ok[#]';
        } else {
            echo "fail[#]";
            $util->ShowErrors();
        }

        break;
    case 'updateDatosEmpresa':
        $config->setId($_POST['id']);
        $config->setNombre($_POST['nombre']);
        $config->setCiudad($_POST['ciudad']);
        $config->setEstado($_POST['estado']);
        $config->setPais($_POST['pais']);
        $config->setDireccion($_POST['direccion']);
        $config->setCp($_POST['cp']);
        $config->setEmail($_POST['email']);
        $config->setRfc($_POST['rfc']);
        $config->setTelefono($_POST['telefono']);
        //$puesto->setClave($_POST['clave_tramite']);
        $success = $config->UpdateDatosEmpresa();

        if ($success) {
            echo 'ok[#]';
        } else {
            echo "fail[#]";
            $util->ShowErrors();
        }

        break;
}//switch

?>