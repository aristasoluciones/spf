<?php

class Encuesta extends Main
{
	private $id;
	private $nombre;
	private $pregunta;
	private $tipoencuesta;
	private $rango;
	private $opcional;
	private $encuestaId;
	private $respuesta;
	private $riesgo;
	private $orden;
	private $contexto;

	//filtros;
    private $anio;
    private $mes;
    private $languageId;
    private $textTranslate;

	public function setLanguageTranslate($value){
		$this->Util()->ValidateRequireField($value, 'Seleccione una lengua');
		$this->languageId = $value;
	}
	public function setTextTranslate($value){
		$this->Util()->ValidateRequireField($value, 'Pregunta traducida');
		$this->textTranslate = $value;
	}
	public function setEncuestaId($value){
		$this->Util()->ValidateInteger($value);
		$this->encuestaId = $value;
	}
    public function setId($value){
        $this->Util()->ValidateInteger($value);
        $this->id = $value;
    }

	public function getEncuestaId(){
	    return $this->encuestaId;
    }

	public function setNombre($value){
		if($this->Util()->ValidateRequireField($value, 'Nombre')){
			$this->nombre = $value;
		}
	}
	public function setRespuesta($value){
			$this->respuesta = $value;
	}
	public function setContexto($value){
        $this->Util()->ValidateRequireField($value, 'Tipo de contexto');
        $this->contexto = $value;
    }
    public function setRiesgo($value){
        $this->Util()->ValidateRequireField($value, 'Tipo riesgo');
        $this->riesgo = $value;
    }
    public function setOrden($value){
        $this->Util()->ValidateRequireField($value, 'Orden');
        $this->orden = $value;
    }
    public function getContexto(){
	    return $this->contexto;
    }
	public function setPregunta($value){
		if($this->Util()->ValidateRequireField($value, 'Pregunta')){
			$this->pregunta = $value;
		}
	}

	public function setTipoEncuesta($value){
		if($this->Util()->ValidateRequireField($value, 'Tipo Encuesta')){
			$this->tipoencuesta = $value;
		}
	}

	public function setRango($value){
		if($this->Util()->ValidateRequireField($value, 'Rango')){
			$this->rango = $value;
		}
	}

	public function setOpcional($value){
		if($this->Util()->ValidateRequireField($value, 'Rango')){
			$this->opcional = $value;
		}
	}

	public function setNumCaracter($value){
		if($this->Util()->ValidateRequireField($value, 'Num. Caracter')){
			$this->numcaracter = $value;
		}
	}


	public function setInicio($value){
		if($this->Util()->ValidateRequireField($value, 'Inicio')){
			$this->inicio = $value;
		}
	}


	public function setFin($value){
		if($this->Util()->ValidateRequireField($value, 'Fin')){
			$this->fin = $value;
		}
	}


	public function setTipo($value){
		$this->tipo = $value;
	}

	public function setActivo($value){
		$this->activo = $value;
	}
    public function setAnio($value){
        $this->anio = $value;
    }
    public function setMes($value){
        $this->mes = $value;
    }

	public function Info(){

		$sql = 'SELECT *, encuestaId AS idReg FROM encuesta WHERE encuestaId = "'.$this->encuestaId.'"';
		$this->Util()->DB()->setQuery($sql);
		$info = $this->Util()->DB()->GetRow();
		if ($info) {
			$sql = "select * from poll_translate where poll_id = '" . $info['idReg'] . "'";
			$this->Util()->DB()->setQuery($sql);
			$results = $this->Util()->DB()->GetResult();
			$info['poll_translate'] = count($results) ? $results : [];
		}

		if ($_SESSION['local_language'] > 0) {
			$sql = "select text from poll_translate where poll_id = '" . $info['idReg'] . "' and language_id=".$_SESSION['local_language'];
			$this->Util()->DB()->setQuery($sql);
			$row = $this->Util()->DB()->GetRow();
			if($row) {
				$info['translate_name'] = $row['text'];
			}
		}
		return $info;
	}//Info

	public function getListEncuesta(){

		$sql = 'SELECT * FROM encuesta order by position asc';
		$this->Util()->DB()->setQuery($sql);
		$result =  $this->Util()->DB()->GetResult();
		if ($_SESSION['local_language'] > 0 ) {
			foreach($result as $key => $value) {
					$sql = "SELECT text from poll_translate where poll_id = '".$value['encuestaId']."'
                        	and language_id= '".$_SESSION['local_language']."' ";
					$this->Util()->DB()->setQuery($sql);
					$translate = $this->Util()->DB()->GetRow();
					if ($translate) {
						$result[$key]['translated'] = true;
						$result[$key]['nombre'] = $translate['text'];
					}
				}
		}
		return $result;
	}

	public function Enumerate(){

		$filtro ="";

		$sql = 'SELECT COUNT(*)	FROM encuesta WHERE 1 '.$filtro.'';
		$this->Util()->DB()->setQuery($sql);
		$total = $this->Util()->DB()->GetSingle();
		// exit;
		$resPage = $this->Util->HandlePagesAjax($this->page, $total , '');
		$sqlLim = "LIMIT ".$resPage['pages']['start'].", ".$resPage['pages']['items_per_page'];

		$sql = 'SELECT *, encuestaId AS idReg FROM encuesta 
				WHERE 1 '.$filtro.'
				ORDER BY encuestaId ASC
				'.$sqlLim;

		$this->Util()->DB()->setQuery($sql);
		$data['result'] = $this->Util()->DB()->GetResult();
		$data['pages'] = $resPage['pages'];
		$data['info'] = $resPage['info'];
		return $data;
	}//Enumerate

	public function Save(){
		if($this->Util()->PrintErrors()){
			return false;
		}
		if($this->id){
			$sql = 'UPDATE encuesta SET 
					nombre = "'.utf8_decode($this->nombre).'"
					WHERE encuestaId = "'.$this->id.'"';
			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->UpdateData();

			$this->setEncuestaId($this->id);
			$info = $this->Info();
			$translates  = !is_array($_SESSION['poll_translate']) ? [] : $_SESSION['poll_translate'];
			$arrayDif = array_diff(array_column($info['poll_translate'], 'id'), array_column($translates, 'id'));
			$sql = "replace into poll_translate(id, poll_id, text, language_id) values";
			$valuesStr = "";
			$poll_id = $this->id;
			foreach ($translates as $var) {
				$id = $var['id'] ? $var['id'] : 'null';
				$text = $id ? htmlspecialchars(htmlspecialchars_decode($var['text'], ENT_QUOTES), ENT_QUOTES): htmlspecialchars($var['text'], ENT_QUOTES);
				$language_id = $var['language_id'];
				if(!in_array($var['id'], $arrayDif))
					$valuesStr .= "($id, '$poll_id', '$text', $language_id),";
			}
			if($valuesStr !== "") {
				$valuesStr =  substr($valuesStr, 0, strlen($valuesStr)-1);
				$sql = $sql.$valuesStr;
				$this->Util()->DB()->setQuery($sql);
				$this->Util()->DB()->InsertData();
			}

			if(count($arrayDif)) {
				$ids = implode(",", $arrayDif);
				$sql = "delete from poll_translate where id in (0, $ids)";
				$this->Util()->DB()->setQuery($sql);
				$this->Util()->DB()->DeleteData();
			}
		} else {
			$sql = 'INSERT INTO encuesta (
			nombre, 
			fechaRegistro, 
			tipo,
			usuarioregistraId
			)
			VALUES(
				"' . $this->nombre . '",
				"' . date("Y-m-d") . '",
				"' . $this->contexto. '",
				"' . $_SESSION['Usr']["usuarioId"] . '"
			)';

			$this->Util()->DB()->setQuery($sql);
			$this->id = $this->Util()->DB()->InsertData();

			$translates  = !is_array($_SESSION['poll_translate']) ? [] : $_SESSION['poll_translate'];
			$valuesStr = "";
			$poll_id = $this->id;
			$sql = "replace into poll_translate(id, poll_id, text, language_id) values";
			foreach ($translates as $var) {
				$id = $var['id'] ? $var['id'] : 'null';
				$text = htmlspecialchars($var['text'], ENT_QUOTES);
				$language_id = $var['language_id'];
				$valuesStr .= "($id, '$poll_id', '$text', $language_id),";
			}
			if($valuesStr !== "") {
				$valuesStr =  substr($valuesStr, 0, strlen($valuesStr)-1);
				$sql = $sql.$valuesStr;
				$this->Util()->DB()->setQuery($sql);
				$this->Util()->DB()->InsertData();
			}
		}

		$this->Util()->setError(10141, 'complete', '');
		$this->Util()->PrintErrors();
		return true;
	}//Save
	public function SaveQuestions(){
		if($this->Util()->PrintErrors()){
			return false;
		}

		if($this->id){
			$sql = 'UPDATE pregunta SET 
				pregunta = "'.($this->pregunta).'",
				tiporespuesta = "'.($this->tipoencuesta).'",
				rango = "'.($this->rango).'",
				opcional = "'.($this->opcional).'",
				riesgo = "'.($this->riesgo).'",
				orden = "'.($this->orden).'", 
				numCaracter = "'.($this->numcaracter).'"
				WHERE preguntaId = "'.$this->id.'"';

			$this->Util()->DB()->setQuery($sql);
			$this->Util()->DB()->UpdateData();

			$info = $this->InfoPregunta();
            $translates  = !is_array($_SESSION['question_translate']) ? [] : $_SESSION['question_translate'];
            $arrayDif = array_diff(array_column($info['question_translate'], 'id'), array_column($translates, 'id'));
            $sql = "replace into question_translate(id, pregunta_id, text, file_path, language_id) values";
			$folder = DOC_ROOT . '/audios';
			if (!is_dir($folder))
				mkdir($folder);

            $valuesStr = "";
            $pregunta_id = $this->id;
            foreach ($translates as $var) {
                $id = $var['id'] ? $var['id'] : 'null';
                $text = $id ? htmlspecialchars(htmlspecialchars_decode($var['text'], ENT_QUOTES), ENT_QUOTES): htmlspecialchars($var['text'], ENT_QUOTES);
                $language_id = $var['language_id'];
				$path = $var['doc_tmp'];
				$name_file= $var['name_file'];
				if(file_exists($path)) {
					$name_file = '';
					if(rename($path, $folder.'/'.$var['name_file']))
						$name_file = $var['name_file'];
				}
                if(!in_array($var['id'], $arrayDif))
                    $valuesStr .= "($id, '$pregunta_id', '$text', '$name_file', $language_id),";
            }
            if($valuesStr !== "") {
                $valuesStr =  substr($valuesStr, 0, strlen($valuesStr)-1);
                $sql = $sql.$valuesStr;
                $this->Util()->DB()->setQuery($sql);
                $this->Util()->DB()->InsertData();
            }

            if(count($arrayDif)) {
                $ids = implode(",", $arrayDif);
                $sql = "delete from question_translate where id in (0, $ids)";
                $this->Util()->DB()->setQuery($sql);
                $this->Util()->DB()->DeleteData();
            }
		}else{
			 $sql = 'INSERT INTO pregunta (
				pregunta, 
				tiporespuesta, 
				encuestaId, 
				rango, 
				riesgo,
				orden,
				opcional, 
				numCaracter
			)
			VALUES(
				"'.$this->pregunta.'",
				"'.$this->tipoencuesta.'",
				"'.$this->encuestaId.'",
				"'.$this->rango.'",
				"'.$this->riesgo.'",
				"'.$this->orden.'",
				"'.$this->opcional.'",
				"'.$this->numcaracter.'"
			)';
			$this->Util()->DB()->setQuery($sql);
			$this->id = $this->Util()->DB()->InsertData();

			$translates  = !is_array($_SESSION['question_translate']) ? [] : $_SESSION['question_translate'];
			$valuesStr = "";
			$pregunta_id = $this->id;
			$sql = "replace into question_translate(id, pregunta_id, text, file_path, language_id) values";

			$folder = DOC_ROOT . '/audios';
			if (!is_dir($folder))
				mkdir($folder);

			foreach ($translates as $var) {
				$id = $var['id'] ? $var['id'] : 'null';
				$text = htmlspecialchars($var['text'], ENT_QUOTES);
				$language_id = $var['language_id'];
				$path = $var['doc_tmp'];
				if(file_exists($path)) {
					$name_file = '';
					if(rename($var['doc_tmp'], $folder.'/'.$var['name_file']))
						$name_file = $var['name_file'];
				}
				$valuesStr .= "($id, '$pregunta_id', '$text', '$name_file', $language_id),";
			}
			if($valuesStr !== "") {
				$valuesStr =  substr($valuesStr, 0, strlen($valuesStr)-1);
				$sql = $sql.$valuesStr;
				$this->Util()->DB()->setQuery($sql);
				$this->Util()->DB()->InsertData();
			}
		}


		$this->Util()->setError(10112, 'complete', 'Registro actualizado');
		$this->Util()->PrintErrors();
		return true;
	}//Save
	public function Update(){

		if($this->Util()->PrintErrors()){
			return false;
		}

		$sql = 'UPDATE usuario SET 
				apaterno = "'.utf8_decode($this->apaterno).'",
				amaterno = "'.utf8_decode($this->amaterno).'",
				calle = "'.utf8_decode($this->calle).'",
				noExterior = "'.utf8_decode($this->noexterior).'",
				colonia = "'.utf8_decode($this->colonia).'",
				ciudad = "'.utf8_decode($this->ciudad).'",
				estado = "'.($this->estado).'",
				pais = "'.utf8_decode($this->pais).'",
				nombre = "'.utf8_decode($this->nombre).'", 
				telefono = "'.$this->telefono.'",
				email = "'.utf8_decode($this->email).'", 
				usuario = "'.utf8_decode($this->usuario).'",
				passwd = "'.md5($this->passwd).'", 
				tipo = "'.$this->tipo.'", 
				activo = "'.$this->activo.'"
				WHERE usuarioId = "'.$this->id.'"';
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();

		$this->Util()->setError(10113, 'error', '');
		$this->Util()->PrintErrors();

		return true;

	}//Update

	public function Delete(){

		$sql = 'DELETE FROM encuesta WHERE encuestaId = "'.$this->id.'"';
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->DeleteData();

		$this->Util()->setError(10114, 'error', '');
		$this->Util()->PrintErrors();

		return true;

	}//Delet
    public function DeleteQuestion(){

		$sql = 'DELETE FROM pregunta WHERE preguntaId = "'.$this->id.'"';
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->DeleteData();

		$this->Util()->setError(10114, 'error', '');
		$this->Util()->PrintErrors();

		return true;
	}//Delete
	public function EnumeratePreguntas(){
		$filtro ="";
		if($this->id){
			$filtro .=" and encuestaId = ".$this->id."";
		}

		$sql = 'SELECT COUNT(*)	FROM pregunta WHERE 1 '.$filtro.'';
		$this->Util()->DB()->setQuery($sql);
		$total = $this->Util()->DB()->GetSingle();

		$resPage = $this->Util->HandlePagesAjax($this->page, $total , '');
		$sqlLim = "LIMIT ".$resPage['pages']['start'].", ".$resPage['pages']['items_per_page'];

		$sql = 'SELECT *, preguntaId AS idReg FROM pregunta 
				WHERE 1 '.$filtro.'
				ORDER BY preguntaId ASC
				'.$sqlLim;
		// exit;

		$this->Util()->DB()->setQuery($sql);
		$data['result'] = $this->Util()->DB()->GetResult();
		$data['pages'] = $resPage['pages'];
		$data['info'] = $resPage['info'];

		return $data;
	}//EnumeratePreguntas

	public function InfoPregunta(){
		$sql = 'SELECT *, preguntaId AS idReg FROM pregunta WHERE preguntaId = "'.$this->id.'"';
		$this->Util()->DB()->setQuery($sql);
		$info = $this->Util()->DB()->GetRow();
		if ($info) {
			$sql = "select * from question_translate where pregunta_id = '" . $info['preguntaId'] . "' ";
			$this->Util()->DB()->setQuery($sql);
			$results = $this->Util()->DB()->GetResult();
			foreach ($results as $key => $value) {
				$results[$key]['audio'] =  false;
				if($value['file_path'] !== '') {
					$file =  DOC_ROOT . '/audios/'.$value['file_path'];
					if (is_file($file)) {
						$results[$key]['audio'] =  true;
						$results[$key]['name_file'] =  $value['file_path'];
						$results[$key]['web_url'] =  WEB_ROOT.'/audios/'.$value['file_path'];
						$results[$key]['doc_tmp'] = $file;
					}
				}
			}
			$info['question_translate'] = count($results) ? $results : [];
		}
		return $info;
	}
	public function resultadosPreguntas(){
		$sql = 'SELECT *, preguntaId AS idReg FROM pregunta WHERE encuestaId = "'.$this->id.'" and tiporespuesta <> "abierta"';
		$this->Util()->DB()->setQuery($sql);
		$info = $this->Util()->DB()->GetResult();
		foreach($info as $key=>$aux){
			$sql = 'SELECT respuesta,count(*) as total FROM resultado WHERE preguntaId = '.$aux['preguntaId'].' group by respuesta';
			$this->Util()->DB()->setQuery($sql);
			$info1 = $this->Util()->DB()->GetResult();
			$info[$key]['resultados'] = $info1;
		}
		return $info;
	}
	public function resultadosAbiertas(){
		$sql = 'SELECT * FROM resultado as r
		left join pregunta as p on p.preguntaId = r.preguntaId
		WHERE encuestaId = "'.$this->id.'" and tiporespuesta = "abierta"';
		$this->Util()->DB()->setQuery($sql);
		$info = $this->Util()->DB()->GetResult();

		return $info;
	}
	public function totalQuestionsPoll(){
	    $sql = "select count(*) from pregunta where encuestaId = '".$this->getEncuestaId()."'";
	    $this->Util()->DB()->setQuery($sql);
	    return $this->Util()->DB()->GetSingle();
    }
    public function getDataForChartGeneral(){
	    global $globalNameMonths;
        $filtro = "";
        switch($_POST["detail"]){
            case "month":
                for($i=1;$i<=12;$i++){
                    $v["clave"] = $globalNameMonths[$i];
                    $v["value"] = 0;
                    $monthBase[(int)$i] = $v;
                }
                if((int)$this->anio)
                    $filtro .=" and year(fechaIncidente)= '".(int)$this->anio."' ";

                if((int)$this->mes)
                    $filtro .=" and month(fechaIncidente) = '".(int)$this->mes."' ";

                if($_POST["contexto"]!="")
                    $filtro .=" and tipo = '".$_POST["contexto"]."' ";

				if($_POST['municipio_id'])
					$filtro .=" and municipio_id = '".$_POST["municipio_id"]."' ";

                $sql  =" select  victimaId,tipo,month(fechaIncidente) as mes from victima a  where 1 $filtro ";
                $this->Util()->DB()->setQuery($sql);
                $result =  $this->Util()->DB()->GetResult();
                $months = [];
                $monthTemporal = [];
                foreach($result as $var){
                    $sql = "select count(*) from pollVictima where victimaId = '".$var["victimaId"]."' and status ='Pendiente' ";
                    $this->Util()->DB()->setQuery($sql);
                    $pendiente=  $this->Util()->DB()->GetSingle();
                    if($pendiente)
                        continue;

                    if(!in_array($var["mes"],$months)) {
                        array_push($months,$var["mes"]);
                        $card["clave"] = $globalNameMonths[$var["mes"]];
                        $card["value"] = 1;
                        $monthTemporal[(int)$var["mes"]] = $card;
                    }else{
                        $monthTemporal[(int)$var["mes"]]["value"]++;
                    }
                }
                $arrayMerge = array_replace($monthBase,$monthTemporal);
                foreach ($arrayMerge as $item) {
                    $arrayNew[] = $item;
                }
                return json_encode($arrayNew);

			case 'violencia':

				$filtro = "";
				$filtro2 ="";
				if((int)$this->anio)
					$filtro .=" and year(fechaIncidente)= '".(int)$this->anio."' ";

				if((int)$this->mes)
					$filtro .=" and month(fechaIncidente) = '".(int)$this->mes."' ";

				if($_POST["contexto"]!="") {
					$filtro .= " and tipo = '" . $_POST["contexto"] . "' ";
					$filtro2 .= " and tipo = '" . $_POST["contexto"] . "' ";
				}

				if($_POST['municipio_id'])
					$filtro .=" and municipio_id = '".$_POST["municipio_id"]."' ";


				$sql  =" select  victimaId,tipo,municipio_id from victima  where 1 $filtro ";
				$this->Util()->DB()->setQuery($sql);
				$result =  $this->Util()->DB()->GetResult();

				$sql  =" select  encuestaId, nombre, tipo,encuestaId from encuesta  where allow_analize = '1' $filtro2 ";
				$this->Util()->DB()->setQuery($sql);
				$polls =  $this->Util()->DB()->GetResult();
				$dataBase = [];
				foreach($polls as $itemPoll) {
					$cad2['clave'] = $itemPoll['nombre'] .' '. $itemPoll['tipo'];
					$cad2['namepoll'] = str_replace(" ", "", $itemPoll['nombre'] .''. $itemPoll['tipo']);
					$cad2['encuestaId'] =  $itemPoll['encuestaId'];
					$cad2['value'] =  0;
					$dataBase[$itemPoll['encuestaId']] = $cad2;
				}
				$total = 0;

				$exist_municipios = [];
				$group_municipios = [];
				foreach($result as $var) {
					$sql = "select count(*) from pollVictima where victimaId = '".$var["victimaId"]."' and status ='Pendiente' ";
					$this->Util()->DB()->setQuery($sql);
					$pendiente=  $this->Util()->DB()->GetSingle();
					if($pendiente)
						continue;

					$sql = "select  a.*, concat_ws('', b.nombre, b.tipo) as namepoll from pollVictima a 
							inner join encuesta b on a.encuestaId = b.encuestaId  
							where a.victimaId = '".$var["victimaId"]."' and a.status ='Finalizado'
							and b.allow_analize = '1' and b.tipo = '".$var['tipo']."' ";
					$this->Util()->DB()->setQuery($sql);
					$finalizados=  $this->Util()->DB()->GetResult();
					foreach ($finalizados as $finalizado) {
						$dataBase[$finalizado['encuestaId']]['value'] += $finalizado['puntos'];


						if(!$_POST['municipio_id']) {
							if (!in_array($var['municipio_id'], $exist_municipios)) {
								array_push($exist_municipios, $var['municipio_id']);
								$group_municipios[$var['municipio_id']]['clave'] =$var['municipio_id'];
								$group_municipios[$var['municipio_id']]['total'] = 0;
							}
							$group_municipios[$var['municipio_id']][$finalizado['namepoll']] += $finalizado['puntos'];
							$group_municipios[$var['municipio_id']]['total']++;
						}
					}

					$total++;
				}
				$new_array = [];
				if ($_POST['municipio_id']) {
					$linealBase = 0;
					foreach($dataBase as $key2 => $data2) {
						$linealBase +=$data2['value'] / $total;
					}
					foreach($dataBase as $key => $data) {
						$valor =  number_format($data['value'] / $total, 2) * 100 / number_format($linealBase, 2);
						$data['value'] = number_format($valor, 2);
						$new_array[] = $data;
					}
				} else {
					foreach($group_municipios as $key => $data) {
						foreach($data as $kd => $vdata)
						{
							if($kd != 'clave' && $kd!= 'total')
								$data[$kd] = $vdata / $data['total']
;						}
						$new_array[] = $data;
					}
				}

				return json_encode($new_array);
			break;
            default:
                if((int)$this->anio)
                    $filtro .=" and year(fechaIncidente)= '".(int)$this->anio."' ";

                if((int)$this->mes)
                    $filtro .=" and month(fechaIncidente) = '".(int)$this->mes."' ";

                if($_POST["contexto"]!="")
                    $filtro .=" and tipo = '".$_POST["contexto"]."' ";

				if($_POST['municipio_id'])
					$filtro .=" and municipio_id = '".$_POST["municipio_id"]."' ";

                $sql  =" select  victimaId,tipo from victima a  where 1 $filtro ";
                $this->Util()->DB()->setQuery($sql);
                $result =  $this->Util()->DB()->GetResult();
                $tipos = [];
                $arrayTipos = [];
                foreach($result as $var) {
                    $sql = "select count(*) from pollVictima where victimaId = '".$var["victimaId"]."' and status ='Pendiente' ";
                    $this->Util()->DB()->setQuery($sql);
                    $pendiente=  $this->Util()->DB()->GetSingle();
                    if($pendiente)
                        continue;
                    if(!in_array($var["tipo"],$tipos)) {
                       array_push($tipos,$var["tipo"]);
                       $card["clave"] = $var["tipo"];
                       $card["value"] = 1;
                       $arrayTipos[$var["tipo"]] = $card;
                    }else{
                        $arrayTipos[$var["tipo"]]["value"]++;
                    }
                }


                $arrayNew = [];
                foreach ($arrayTipos as $item) {
                    $arrayNew[] = $item;
                }
                return  json_encode($arrayNew);
        }

    }
	public function  saveTranslatePollInSession () {
		if($this->Util()->PrintErrors())
			return false;

		if(!isset($_SESSION['poll_translate']))
			$_SESSION['poll_translate'] = [];

		end($_SESSION['poll_translate']);
		$key = key($_SESSION['poll_translate']);
		$cad['language_id'] = $this->languageId;
		$cad['text'] = $this->textTranslate;
		$_SESSION['poll_translate'][$key + 1] = $cad;
		return $_SESSION['poll_translate'];
	}

}
?>
