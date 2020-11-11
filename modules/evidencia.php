<?php
    //comprobar privilegios de acceso a modulo


function scanDirs($target, &$files) {


    if (is_dir($target)) {
        $finds = array_filter(glob($target. "*", GLOB_MARK), function($v) {
            return false === strpos($v, 'index.php');
        });
        foreach ($finds as $file) {
            scanDirs($file, $files);
        }
    } elseif (is_file($target)) {
        $cad['file'] = true;
        $file = str_replace("\\", "/", $target);
        $cad['filePath'] = str_replace(DOC_ROOT, WEB_ROOT, $file);
        $cad['name'] = basename($target);
        array_push($files, $cad);
    }
}


$files = [];
scanDirs(DIR_EVIDENCIAS, $files);
$smarty->assign('files', $files);
