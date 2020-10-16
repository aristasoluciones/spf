<?php
    $id = $_GET["id"];

    include_once(DOC_ROOT."/services/PdfService.php");
    $pdfService = new PdfService;

    $pdfService->setVictimaId($id);
    $pdfService->generate();