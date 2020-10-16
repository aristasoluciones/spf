<?php
header('Content-disposition: attachment; filename='.$_GET["filename"]);
header('Content-type: '.$_GET["contentType"]);
readfile(urldecode($_GET["path"].$_GET["secPath"]."/".$_GET["filename"]));
?>