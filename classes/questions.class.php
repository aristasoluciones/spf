<?php
class Question extends Encuesta
{
    private $currentAnswers = [];
    private $answersExist = [];
    private $victimaId;
    private $pollVictimaId;
    private $dataChart = [];
    public function setVictimaId($value){
        $this->Util()->ValidateRequireField($value, 'Favor de ingresar los datos personales');
        $this->victimaId = $value;
    }
    public function getVictimaId(){
        return $this->victimaId;
    }
    public function resetCurrentAnswers(){
        $this->currentAnswers = [];
    }
    public function resetAnswerExist(){
        $this->answersExist = [];
    }
    public function getArrayCurrentAnswers(){
        return $this->currentAnswers;
    }
    public function setPollVictimaId($value){
        $this->pollVictimaId = $value;
    }
    public function getPollVictimaId(){
        return $this->pollVictimaId;
    }
    public function resetDataChart(){
        unset($this->dataChart);
    }
    public function createArrayCurrentAnswers(){
        $this->resetCurrentAnswers();
        foreach($_POST as $key => $var){
            $key_explode  = explode("_",$key);
            if($key_explode[0] == "question"){
                $cad["id"] = $key_explode[1];
                $cad["resp"] = $_POST[$key];
                $this->currentAnswers[]= $cad;
            }
        }
    }
    public function validateTotalAnswers()
    {
        if($this->totalQuestionsPoll() != count($this->getArrayCurrentAnswers()))
            $this->Util()->setError(0,"error","Faltan preguntas por responder");
    }

    public function savePollVictima(){
        $sql = "insert into pollVictima(encuestaId,victimaId,fechaAplicacion)
                values('".$this->getEncuestaId()."','".$this->getVictimaId()."','".date("Y-m-d")."')";
        $this->Util()->DB()->setQuery($sql);
        $last = $this->Util()->DB()->InsertData();
        $this->setPollVictimaId($last);
    }
    public function saveCurrentAnswersVictima(){
        $this->createArrayCurrentAnswers();
        $this->validateTotalAnswers();
        if(!$this->pollVictimaId){
            $this->setVictimaId($_POST["victimaId"]);
        }

        if($this->Util()->PrintErrors())
            return false;

        if(!$this->pollVictimaId)
            $this->savePollVictima();

        $pVId  = $this->pollVictimaId;
        $sql  ="replace into answerPollVictima(pollVictimaId,preguntaId,respuesta) VALUES";
        foreach ($this->currentAnswers as $key => $var){
            $pId = $var["id"];
            $res = $var["resp"];
            $sql .= "('$pVId','$pId','$res'),";
        }
        $sql = substr($sql,0,-1);
        $this->Util()->DB()->setQuery($sql);
        $this->Util()->DB()->InsertData();
        $sql  ="update pollVictima set status ='Finalizado' where pollVictimaId = '".$this->pollVictimaId."' ";
        $this->Util()->DB()->setQuery($sql);
        $this->Util()->DB()->UpdateData();

        $this->generateResultPoll($this->pollVictimaId);

        $this->Util()->setError(0,"complete","Se ha guardado correctamente");
        $this->Util()->PrintErrors();

        return true;

    }
    public function getAnswersIfExist(){
        $this->resetAnswerExist();
        $sql  ="select * from pollVictima where victimaId = '".$this->victimaId."' and encuestaId='".$this->getEncuestaId()."' ";
        $this->Util()->DB()->setQuery($sql);
        $row = $this->Util()->DB()->GetRow();
        if(!$row)
            return false;

        $this->setPollVictimaId($row["pollVictimaId"]);
        $sql = "select * from answerPollVictima where pollVictimaId = '".$row["pollVictimaId"]."' ";
        $this->Util()->DB()->setQuery($sql);
        $answers = $this->Util()->DB()->GetResult();
        foreach($answers as $key => $var){
            $this->answersExist[$var["preguntaId"]] = $var["respuesta"];
        }
    }
    public function questionsByPoll(){
        $this->getAnswersIfExist();

        $sql = "SELECT * 
				from
				encuesta 
				where encuestaId ='".$this->getEncuestaId()."' ";

        $this->Util()->DB()->setQuery($sql);
        $infoEncuesta = $this->Util()->DB()->GetRow();
        $sql = 'SELECT * 
				from
				pregunta 
				where
				encuestaId = '.$infoEncuesta['encuestaId'].'';
        $this->Util()->DB()->setQuery($sql);
        $answers = $this->Util()->DB()->GetResult();

        foreach($answers as $key=>$aux){
            if($aux["tiporespuesta"]=="opcional"){
                unset($opciones);
                $selfOptions = explode("_",$aux["opcional"]);

                for($i=0;$i<=count($selfOptions);$i++){
                    if($selfOptions[$i]<>""){
                        $opciones[] = $selfOptions[$i];
                    }
                }
                $answers[$key]["opciones"] = $opciones;
                if(array_key_exists($aux["preguntaId"],$this->answersExist))
                    $answers[$key]["currentAnswer"] = $this->answersExist[$aux["preguntaId"]];

            }else if($aux["tiporespuesta"]=="punto"){
                $r = explode("_",$aux["rango"]);
                $answers[$key]["rango1"] = $r[0];
                $answers[$key]["rango2"] = $r[1];
            }

        }
        return $answers;
    }
    public function validateFullResolvePoll(){
        $pendiente = 0;
        $this->Util()->DB()->setQuery("select * from encuesta where tipo in('".$this->getContexto()."','Todos')  ");
        $result = $this->Util()->DB()->GetResult();
        foreach ($result as $key => $value){
            $sql  ="select status from pollVictima where encuestaId='".$value["encuestaId"]."' and victimaId = '".$this->victimaId."' ";
            $this->Util()->DB()->setQuery($sql);
            $row = $this->Util()->DB()->GetRow();
            if(!$row || $row["status"] =='Pendiente')
                $pendiente++;
        }
        if($pendiente>0)
            return false;

        return true;
    }
    public function getResultPollVictima(){
        global $victima;
        $victima->setVictimaId($this->victimaId);
        $infoVictima = $victima->Info();

        $this->Util()->DB()->setQuery("select * from encuesta where tipo in('".$infoVictima['tipo']."','Todos')  order by position asc ");
        $encuestas = $this->Util()->DB()->GetResult();
        foreach($encuestas as $key =>$value){
            $this->setEncuestaId($value["encuestaId"]);
            $this->setVictimaId($this->victimaId);
            $encuestas[$key]["resultado"] = $this->getResultPoll();
            $encuestas[$key]["preguntas"] = $this->questionsByPoll();
        }
        return $encuestas;
    }
    public function getResultPoll(){
        $sql  ="select resultadoEncuesta from pollVictima where encuestaId='".$this->getEncuestaId()."' and victimaId = '".$this->victimaId."' ";
        $this->Util()->DB()->setQuery($sql);
        return  !$this->Util()->DB()->GetSingle()? "Pendiente" : $this->Util()->DB()->GetSingle();
    }
    public function getPorcentInChart(){
        $sql  ="select porcentInChart from pollVictima where encuestaId='".$this->getEncuestaId()."' and victimaId = '".$this->victimaId."' ";
        $this->Util()->DB()->setQuery($sql);
        return  $this->Util()->DB()->GetSingle();
    }
    public function generateResultPoll($pollVictimaId){
        $frecuencias = ["Siempre"=>1,"Frecuentemente"=>.75,"Por lo menos una vez"=>.50,"Nunca"=>.25];
        $sumMat = 0;
        $totalPreguntas =0;

        $sql = "select a.*,b.riesgo,b.orden from answerPollVictima a inner join pregunta b on a.preguntaId=b.preguntaId where a.pollVictimaId = '$pollVictimaId' ";
        $this->Util()->DB()->setQuery($sql);
        $answers = $this->Util()->DB()->GetResult();
        foreach($answers as $key => $var){
            $sumMat =$sumMat + (float)$var["orden"] + (float) $frecuencias[ucfirst(strtolower($var["respuesta"]))];
            $totalPreguntas++;
        }
        $resultadoEncuesta = $this->getValueResultByPoint($totalPreguntas,$sumMat);
        $porcentInChart = $this->getValueInChart($totalPreguntas,$sumMat);

        $sql  ="update pollVictima set resultadoEncuesta ='$resultadoEncuesta', puntos = '$sumMat', porcentInchart = '$porcentInChart' where pollVictimaId = '".$this->pollVictimaId."' ";
        $this->Util()->DB()->setQuery($sql);
        $this->Util()->DB()->UpdateData();
    }
    function getValueResultByPoint($totalQuestion =0,$point= 0){
        switch ($totalQuestion){
            case 12:
                if($point>=84)
                    return "Severa";
                elseif($point>82&&$point<=83.9)
                    return "Moderada";
                else return "Baja";
            case 9:
                if($point>=49.5)
                    return "Severa";
                elseif($point>48.16&&$point<=49.4)
                    return "Moderada";
                else return "Baja";
            case 7:
                if($point>=31.5)
                    return "Severa";
                elseif($point>30.66&&$point<=31.4)
                    return "Moderada";
                else return "Baja";
            case 6:
                if($point>=24)
                    return "Severa";
                elseif($point>23.5&&$point<=23.9)
                    return "Moderada";
                else return "Baja";
            case 13:
                if($point>=97.5)
                    return "Severa";
                elseif($point>95.5&&$point<=97.4)
                    return "Moderada";
                else return "Baja";
            case 8:
                if($point>=41.1)
                    return "Severa";
                elseif($point>39&&$point<=41)
                    return "Moderada";
                else return "Baja";
            default:
                return "Baja";
        }
    }
    function getValueInChart($totalQuestion =0,$point= 0){
        $porcent = number_format(100/3,4);
        $maxs = [12=>90,9=>54,7=>35,6=>27,13=>104,8=>44];
        $mins = [12=>81,9=>47.25,7=>29.75,6=>22.5,13=>94.25,8=>38];
        $factor = $maxs[$totalQuestion]-$mins[$totalQuestion];
        $currentFactor = $point-$mins[$totalQuestion];
        $porcentOverPorcent = ($currentFactor * $porcent)/$factor;
        return $porcentOverPorcent;
    }
    public function generateDataForChart(){
        global $victima;
        $victima->setVictimaId($this->victimaId);
        $infoVictima = $victima->Info();

        $this->Util()->DB()->setQuery("select * from encuesta where tipo in('".$infoVictima['tipo']."')  order by position asc ");
        $encuestas = $this->Util()->DB()->GetResult();
        foreach($encuestas as $key =>$value){
            $this->setEncuestaId($value["encuestaId"]);
            $this->setVictimaId($this->victimaId);
            $value["resultado"] = $this->getResultPoll();
            $value["porcentInChart"] = $this->getPorcentInChart();
            $this->dataChart [] = $value;
        }
    }
    public function generatePointsForViolentometro(){
        $points = 0;
        foreach($this->dataChart as $var){
            $porcentOver100 =  number_format($var["porcentInChart"],2);
            $points += $porcentOver100;
        }
        return $points;
    }
    public function generateChartToImg(){
        $data = [];
        $labels = [];
        foreach($this->dataChart as $var){
            $porcentOver100 =  number_format((($var["porcentInChart"]*100)/33.3333),4);
            $data[] = number_format($porcentOver100,2);
            $labels[] = substr($var["nombre"],9,10);
        }
        /* Create and populate the pData object */
        $MyData = new pData();
        $MyData->addPoints($data,"puntos");
        $MyData->setAxisName(0,"Porcentaje de violencia (%)");
        $MyData->addPoints($labels,"tipos");
        $MyData->setSerieDescription("tipos","Browsers");
        $MyData->setAbscissa("tipos");
        $MyData->setAbscissaName("Tipos de violencia");
        $MyData->setAxisDisplay(0,AXIS_FORMAT_CUSTOM,"XAxisFormat");

        /* Create the pChart object */
        $myPicture = new pImage(800,400,$MyData);

        /* Write the chart title */
        $myPicture->setFontProperties(array("FontName"=>DOC_ROOT."/libs/pChart/fonts/Forgotte.ttf","FontSize"=>15));
        $myPicture->drawText(150,25,"Grafica de resultado por tipo de encuesta aplicado.",array("FontSize"=>22));

        /* Define the default font */
        $myPicture->setFontProperties(array("FontName"=>DOC_ROOT."/libs/pChart/fonts/pf_arma_five.ttf","FontSize"=>10));

        /* Set the graph area */
        $myPicture->setGraphArea(100,60,750,250);
        $myPicture->drawGradientArea(100,60,800,250,DIRECTION_HORIZONTAL,array("StartR"=>200,"StartG"=>200,"StartB"=>200,"EndR"=>255,"EndG"=>255,"EndB"=>255,"Alpha"=>30));

        /* Draw the chart scale */
        $AxisBoundaries = array(0=>array("Min"=>0,"Max"=>100));
        $scaleSettings = array("AxisAlpha"=>10,"TickAlpha"=>10,"DrawXLines"=>FALSE,"Mode"=>SCALE_MODE_MANUAL,"ManualScale"=>$AxisBoundaries,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10,"Pos"=>SCALE_POS_TOPBOTTOM);
        $myPicture->drawScale($scaleSettings);

        /* Turn on shadow computing */
        $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

        /* Draw the chart */
        $Palette = array("0"=>array("R"=>224,"G"=>100,"B"=>46,"Alpha"=>100),
                 "1"=>array("R"=>224,"G"=>100,"B"=>46,"Alpha"=>100),
                 "2"=>array("R"=>224,"G"=>100,"B"=>46,"Alpha"=>100));
        $myPicture->drawBarChart(array("DisplayValues"=>TRUE,"DisplayShadow"=>TRUE,"DisplayPos"=>LABEL_POS_INSIDE,"Rounded"=>TRUE,"Surrounding"=>30,"OverrideColors"=>$Palette));
        /* Render the picture (choose the best way) */
       // $myPicture->autoOutput("pictures/example.drawBarChart.poll.png");
        $v = $this->getVictimaId();
        $myPicture->render(DOC_ROOT."/charts/chart_$v.png");
    }
}