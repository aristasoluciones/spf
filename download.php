<?php
include_once('config.php');
$file = $_GET['file'];
if (preg_match('/^[^.][-a-z0-9_.]+[a-z]$/i', $file)) {
    $filepath = $docRoot . "/" . $file;
    // Process download
    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);
        die();
    } else {
        http_response_code(404);
        die();
    }
} else {
    die("Invalid file name!");
}
