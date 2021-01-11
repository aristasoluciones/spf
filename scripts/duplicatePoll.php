<?php
echo  $_SERVER["DOCUMENT_ROOT"] ."\n";
ini_set('memory_limit','3G');
if(!$_SERVER["DOCUMENT_ROOT"])
{
    $_SERVER["DOCUMENT_ROOT"] = realpath(dirname(__FILE__).'/..');
}
if($_SERVER['DOCUMENT_ROOT'] == "/home/sites/13a/8/87dc279ca1/public_html/") {
    $docRoot = $_SERVER['DOCUMENT_ROOT']."/spf";
} else {
    $docRoot = $_SERVER['DOCUMENT_ROOT'];
}
define('DOC_ROOT', $docRoot);
include_once(DOC_ROOT.'/init.php');
include_once(DOC_ROOT.'/config.php');
include_once(DOC_ROOT.'/libraries.php');

$sql = "select * from victima where apaterno = 'Provisional'  and victimaId <=712";
$db->setQuery($sql);
$filas =  $db->GetResult();
$count = 0;
foreach ($filas as $key => $var) {
 $sql = "insert into victima(
            nombre, 
            apaterno,
            amaterno,
            edad,
            estadoCivil,
            nacionalidad,
            gradoEstudio,
            ocupacion,
            lugarNacimiento,
            municipio_id,
            colonia,
            tipo,
            usuario_id,
            fechaRegistro,
            fechaIncidente,
            cordenada,
            comentarioAdicional,
            timeRelacion,
            numHijo)
             values (
               '".$var['nombre']."',
               '".$var['apaterno']."',
               '".$var['amaterno']."',
               '".$var['edad']."',
               '".$var['estadoCivil']."',
               '".$var['nacionalidad']."',
               '".$var['gradoEstudio']."',
               '".$var['ocupacion']."',
               '".$var['lugarNacimiento']."',
               '".$var['municipio_id']."',
               '".$var['colonia']."',
               '".$var['tipo']."',
               '".$var['usuario_id']."',
               '".date('Y-m-d H:i:s')."',
               '".$var['fechaIncidente']."',
               '".$var['cordenada']."',
               '".$var['comentarioAdicional']."',
               '".$var['timeRelacion']."',
               '".$var['numHijo']."'
             )";
 $db->setQuery($sql);
 $lastId = $db->InsertData();

 $sqlPoll =  "select * from pollVictima where victimaId = '".$var['victimaId']."' ";
 $db->setQuery($sqlPoll);
 $polls = $db->GetResult();
     foreach ($polls as $pollKey => $varPoll) {
         $sqlPollInsert = "insert into pollVictima(
                encuestaId, 
                victimaId,
                fechaAplicacion,
                status,
                resultadoEncuesta,
                puntos,
                porcentInChart)
                 values (
                   '".$varPoll['encuestaId']."',
                   '".$lastId."',
                   '".date('Y-m-d')."',
                   '".$varPoll['status']."',
                   '".$varPoll['resultadoEncuesta']."',
                   '".$varPoll['puntos']."',
                   '".$varPoll['porcentInChart']."'
                 )";
         $db->setQuery($sqlPollInsert);
         $lastPollVictimaId = $db->InsertData();

        $slqAnswer =  "select * from answerPollVictima where pollVictimaId = '".$varPoll['pollVictimaId']."' ";
         $db->setQuery($slqAnswer);
         $answers = $db->GetResult();

         foreach ($answers as $ansKey=> $varAns) {
            $sqlAnsInsert = "insert into answerPollVictima(
                pollVictimaId, 
                preguntaId,
                respuesta)
                 values (
                   '" . $lastPollVictimaId. "',
                   '" . $varAns['preguntaId'] . "',
                   '" . $varAns['respuesta'] . "'
                 )";
             $db->setQuery($sqlAnsInsert);
             $db->InsertData();
         }
     }
     $count++;
     echo "registro con id ". $var['victimaId']. " duplicado \n";
}

echo $count. "registros agregados \n";
