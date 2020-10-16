<?php
include_once('../init.php');
include_once('../config.php');
include_once(DOC_ROOT.'/libraries.php');

session_start();
switch($_POST["type"]){
    case "saveEncuestaVictima":
        $question->setEncuestaId($_POST["pollId"]);
        if($_POST["pollVictimaId"])
            $question->setPollVictimaId($_POST["pollVictimaId"]);

        if($question->saveCurrentAnswersVictima()){
            echo "ok[#]";
            echo $error->ShowErrors();
            echo "[#]";
            echo $_POST["pollId"];
            echo "[#]";
            echo $question->getPollVictimaId();
        }else{
            echo "fail[#]";
            echo $error->ShowErrors();
            echo "[#]";
            echo $_POST["pollId"];
        }

    break;
    case "showResultado":
        $question->setVictimaId($_POST["victimaId"]);
        $question->setContexto($_POST["tipoContexto"]);
        if($question->validateFullResolvePoll()){
            echo "ok[#]";
            $smarty->assign("complete",1);
            $smarty->assign("victimaId",$_POST["victimaId"]);
            $smarty->display(DOC_ROOT."/templates/boxes/show-options-result.tpl");
        }else{
            echo "fail[#]";
            $smarty->assign("complete",0);
            $smarty->display(DOC_ROOT."/templates/boxes/show-options-result.tpl");
        }
    break;
    case "showChart":
        echo "ok[#]";
        $question->setVictimaId($_POST["id"]);
        $question->generateDataForChart();
        $puntos = $question->generatePointsForViolentometro();
        $victima->setVictimaId($_POST["id"]);
        $smarty->assign("info",$victima->info());
        $smarty->display(DOC_ROOT."/templates/boxes/modal-chart.tpl");
        echo "[#]";

        echo $puntos;
    break;
    case 'saveComentario':
        $victima->setVictimaId($_POST["vId"]);
        $victima->setComentario($_POST["comentarioAdicional"]);
        $victima->saveComentario();
        echo "ok[#]";
        $smarty->display(DOC_ROOT.'/templates/boxes/messages.tpl');
    break;
}