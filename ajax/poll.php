<?php
// echo "<pre>"; print_r($_POST);
// exit;
	include_once('../init.php');
	include_once('../config.php');
	include_once(DOC_ROOT.'/libraries.php');

	session_start();
    $localLanguage = $encuesta->LocalLanguage();
    $localeLanguageLineal = [];
    foreach($localLanguage as $local) {
        $localeLanguageLineal[$local['id']] =$local['name'];
    }
    $smarty->assign('localLanguage', $localLanguage);
    $smarty->assign('localLanguageLineal', $localeLanguageLineal);
	$page = 'poll';
	$smarty->assign('page',$page);
	switch($_POST['type']){
        case 'add_translate':
            $current_translate = json_decode($_POST['current_translate'], true);
            $encuesta->setLanguageTranslate($current_translate['language_id']);
            $encuesta->setTextTranslate($current_translate['translate_text']);
            if($encuesta->saveTranslatePollInSession()) {
                $data['status'] = 'ok';
                $smarty->assign('result', $_SESSION['poll_translate']);
                $data['content'] =  $smarty->fetch(DOC_ROOT.'/templates/lists/poll_translate.tpl');
            } else {
                $data['status'] = 'fail';
                $data['message'] =  $smarty->fetch(DOC_ROOT.'/templates/boxes/messages_no_format.tpl');
            }
            echo json_encode($data);
            break;

        case 'delete_translate':
            $key = $_POST['id'];
            unset($_SESSION['poll_translate'][$key]);
            $data['status'] = 'ok';
            $smarty->assign('result', $_SESSION['poll_translate']);
            $data['content'] =  $smarty->fetch(DOC_ROOT.'/templates/lists/poll_translate.tpl');
            echo json_encode($data);
            break;

		case 'add':
                if(isset($_SESSION['poll_translate']))
                    unset($_SESSION['poll_translate']);

				$encuesta->setEncuestaId($_POST['id']);
				$info = $encuesta->Info();

                if(isset($info['poll_translate']) && count($info['poll_translate']))
                    $_SESSION['poll_translate'] = $info['poll_translate'];

				echo 'ok[#]';
				$smarty->assign('info',$info);
                $smarty->assign('translates',$_SESSION['poll_translate']);
				$smarty->assign('titleFrm',$info ? 'Editar encuesta' : 'Agregar encuesta');
				$smarty->display(DOC_ROOT.'/templates/boxes/poll.tpl');
		break;

		case 'addQuestion':
                if(isset($_SESSION['translate_question']))
                    unset($_SESSION['translate_question']);

				$encuesta->setId($_POST['id']);
				$info = $encuesta->InfoPregunta();

				$r = explode("_",$info["rango"]);
				$de = $r[0];
				$a = $r[1];

				$r = explode("_",$info["opcional"]);
				$o1 = $r[0];
				$o2 = $r[1];
				$o3 = $r[2];
				$o4 = $r[3];
				$o5 = $r[4];

				$smarty->assign('o1',$o1);
				$smarty->assign('o2',$o2);
				$smarty->assign('o3',$o3);
				$smarty->assign('o4',$o4);
				$smarty->assign('o5',$o5);
				$smarty->assign('de',$de);
				$smarty->assign('a',$a);
				echo 'ok[#]';
				$smarty->assign('info',$info);
				$smarty->assign('preguntaId',$_POST['id']);
				$smarty->assign('encuestaId',$_POST['Id']);
				$smarty->assign('titleFrm','Agregar Pregunta');
				$smarty->display(DOC_ROOT.'/templates/boxes/question.tpl');
		break;
		case 'edit':
				$cliente->setId($_POST['id']);
				$info = $cliente->Info();
				// $info = $util->EncodeRow($info);
				echo 'ok[#]';
				$smarty->assign('titleFrm','Editar cliente');
				$smarty->assign('info',$info);
				$smarty->display(DOC_ROOT.'/templates/boxes/add_catalogo.tpl');
			break;

		case 'save':
                $encuesta->setId($_POST['encuestaId']);
				$encuesta->setNombre($_POST['nombre']);
				$encuesta->setContexto($_POST["contexto"]);
				$success = $encuesta->Save();
				if($success){
					echo 'ok[#]';
				}else{
					echo "fail[#]";
					$util->ShowErrors();
				}

		break;

		case 'SaveQuestions':
				if($_POST["tipo"]=="punto"){
					if($_POST["de"]=="" or $_POST["a"]==""){
						echo "fail[#]";
						echo "<font>Campo requerido: Rango</font>";
						exit;
					}
				}
				else if($_POST["tipo"]=="opcional"){
					for($i=1;$i<=6;$i++){
						if($_POST["res_".$i]==""){
							$va  = $va + 1;
						}
					}
					if($va > 3 ){
						echo "fail[#]";
						echo "<font>Se necesitan por lo menos dos parametros</font>";
						exit;
					}
				}

				$idReg = $_POST['encuestaId'];
				$rango = $_POST["de"]."_".$_POST["a"];
				$opcional = $_POST["res_1"]."_".$_POST["res_2"]."_".$_POST["res_3"]."_".$_POST["res_4"]."_".$_POST['res_5']."_".$_POST['res_6'];
				$encuesta->setEncuestaId($_POST["encuestaId"]);
				$encuesta->setPregunta($_POST['nombre']);
				$encuesta->setTipoEncuesta($_POST['tipo']);
				$encuesta->setRango($rango);
                $encuesta->setRiesgo($_POST["riesgo"]);
                $encuesta->setOrden($_POST["orden"]);
				$encuesta->setOpcional($opcional);
				if($_POST['caracter']){
					$encuesta->setNumCaracter($_POST['caracter']);
				}

				$encuesta->setId($_POST['preguntaId']);
				$success = $encuesta->SaveQuestions();
				if($success){
					echo 'ok[#]';
				}else{
					echo "fail[#]";
					$util->ShowErrors();
				}
		break;

		case 'DeleteReg':
				$encuesta->setId($_POST['id']);
				if($encuesta->Delete())
					echo 'ok[#]';
				else
					echo 'fail[#]';
	    break;

	    case 'activar':
            $cliente->setId($_POST['id']);
            if($cliente->Activar())
                echo 'ok[#]';
            else
                echo 'fail[#]';
	    break;
		case 'DeleteQuestion':
            $encuesta->setId($_POST['id']);
            if($encuesta->DeleteQuestion())
                echo 'ok[#]';
            else
                echo 'fail[#]';
	    break;
        case "getQuestions":
            $question->setEncuestaId($_POST["id"]);
            $question->setVictimaId($_POST["victimaId"]);
            $info = $question->Info();
            $preguntas =  $question->questionsByPoll();
            $smarty->assign('preguntas',$preguntas);
            $smarty->assign('info',$info);
            $smarty->assign('pollVictimaId',$question->getPollVictimaId());
            $smarty->assign('victimaId',$_POST["victimaId"]);
            $smarty->display(DOC_ROOT.'/templates/lists/questions-poll.tpl');
        break;
        case 'saveVictima':
            $victima->setNombre($_POST["nombre"]);
            $victima->setAparterno($_POST["firstLastName"]);
            $victima->setAmaterno($_POST["secondLastName"]);
            $victima->setEdad($_POST["edad"]);
            $victima->setEstadoCivil($_POST["estadoCivil"]);
            $victima->setNacionalidad($_POST["nacionalidad"]);
            $victima->setGradoEstudio($_POST["gradoEstudio"]);
            $victima->setOcupacion($_POST["ocupacion"]);
            $victima->setLugarNacimiento($_POST["lugarDeNacimiento"]);
            $victima->setMunicipio($_POST["municipio"]);
            $victima->setColonia($_POST["colonia"]);
            $victima->setTipo($_POST["tipoContexto"]);
            $victima->setCordenada($_POST["latLng"]);
            $victima->setFechaIncidente($_POST["fechaIncidente"]);
            $victima->setTimeRelacionPareja($_POST["timeRelacion"]);
            $victima->setNumHijo($_POST["numHijo"]);
            if($id = $victima->save()){
                echo "ok[#]";
                echo $id;
            }else{
                echo "fail[#]";
                $error->ShowErrors();
            }
        break;
        case 'updateVictima':
            $victima->setVictimaId($_POST["id"]);
            $victima->setNombre($_POST["nombre"]);
            $victima->setAparterno($_POST["firstLastName"]);
            $victima->setAmaterno($_POST["secondLastName"]);
            $victima->setEdad($_POST["edad"]);
            $victima->setEstadoCivil($_POST["estadoCivil"]);
            $victima->setNacionalidad($_POST["nacionalidad"]);
            $victima->setGradoEstudio($_POST["gradoEstudio"]);
            $victima->setOcupacion($_POST["ocupacion"]);
            $victima->setLugarNacimiento($_POST["lugarDeNacimiento"]);
            $victima->setMunicipio($_POST["municipio"]);
            $victima->setColonia($_POST["colonia"]);
            $victima->setTipo($_POST["tipoContexto"]);
            $victima->setCordenada($_POST["latLng"]);
            $victima->setFechaIncidente($_POST["fechaIncidente"]);
            $victima->setTimeRelacionPareja($_POST["timeRelacion"]);
            $victima->setNumHijo($_POST["numHijo"]);
            if($id = $victima->update()){
                echo "ok[#]";
                echo $_POST["id"];
            }else{
                echo "fail[#]";
                $error->ShowErrors();
            }
        break;
        case 'searchGrafica':
            $encuesta->setAnio($_POST["year"]);
            $encuesta->setMes($_POST["mes"]);
            $results =$encuesta->getDataForChartGeneral();
            echo $results;
        break;
        case 'enumerate':
            $data = $victima->Enumerate();
            echo json_encode($data);
        break;
}
