<?php

class Victima extends main
{
    private $nombre;
    private $apaterno;
    private $amaterno;
    private $edad;
    private $estadoCivil;
    private $nacionalidad;
    private $gradoEstudio;
    private $ocupacion;
    private $lugarNacimiento;
    private $municipio;
    private $colonia;
    private $victimaId;
    private $tipo;
    private $cordenada;
    private $fechaIncidente;
    private $comentarioAdicional;
    private $timeRelacion;
    private $numHijo;

    public function setVictimaId($value){
        $this->Util()->ValidateInteger($value);
        $this->victimaId= $value;
    }
    public function setNombre($value){
        $this->Util()->ValidateRequireField($value, 'Nombre');
        $this->nombre = $value;

    }
    public function setFechaIncidente($value){
        $this->Util()->ValidateRequireField($value, 'Fecha incidente');
        $this->fechaIncidente = $value;

    }
    public function setCordenada($value){
       // $this->Util()->ValidateRequireField($value, 'Favor de ubicar en el mapa, el lugar aproximado de los hechos');
        $this->cordenada = $value;

    }
    public function setAparterno($value){
        $this->Util()->ValidateRequireField($value, 'Apellido Paterno');
        $this->apaterno = $value;

    }
    public function setAmaterno($value){
        $this->Util()->ValidateRequireField($value, 'Apellido Materno');
        $this->amaterno = $value;

    }
    public function setEdad($value){
        $this->Util()->ValidateRequireField($value, 'Edad');
        $this->edad = $value;

    }
    public function setEstadoCivil($value){
        $this->Util()->ValidateRequireField($value, 'Estado Civil');
        $this->estadoCivil = $value;
    }
    public function setNacionalidad($value){
        $this->Util()->ValidateRequireField($value, 'Nacionalidad');
        $this->nacionalidad = $value;

    }
    public function setGradoEstudio($value){
        $this->Util()->ValidateRequireField($value, 'Grado de Estudios');
        $this->gradoEstudio = $value;
    }
    public function setOcupacion($value){
        $this->Util()->ValidateRequireField($value, 'Ocupacion');
        $this->ocupacion = $value;

    }
    public function setLugarNacimiento($value){
        $this->Util()->ValidateRequireField($value, 'Lugar de Nacimiento');
        $this->lugarNacimiento = $value;
    }
    public function setMunicipio($value){
        $this->Util()->ValidateRequireField($value, 'Municipio');
        $this->municipio = $value;
    }
    public function setColonia($value){
        $this->Util()->ValidateRequireField($value, 'Colonia');
        $this->colonia = $value;

    }
    public function setTipo($value){
        $this->Util()->ValidateRequireField($value, 'Tipo contexto');
        $this->tipo = $value;

    }
    public function setComentario($value){
        $this->comentarioAdicional = $value;

    }
    public function setTimeRelacionPareja($value){
        $this->Util()->ValidateRequireField($value, 'Tiempo de relacion con su pareja');
        $this->timeRelacion = $value;

    }
    public function setNumHijo($value){
        $this->Util()->ValidateRequireField($value, 'Numero de hijos');
        $this->numHijo = $value;

    }
    public function save(){
        if($this->Util()->PrintErrors()){
            return false;
        }
        $nombre =  $this->nombre;
        $apaterno = $this->apaterno;
        $amaterno = $this->amaterno;
        $edad = $this->edad;
        $estadoCivil = $this->estadoCivil;
        $nacionalidad = $this->nacionalidad;
        $gradoEstudio = $this->gradoEstudio;
        $ocupacion = $this->ocupacion;
        $lugarNacimiento = $this->lugarNacimiento;
        $municipio = $this->municipio;
        $colonia = $this->colonia;
        $tipo = $this->tipo;
        $cordenada = $this->cordenada;
        $fechaIncidente = $this->fechaIncidente;
        $timeRelacion = $this->timeRelacion;
        $numHijo = $this->numHijo;
        $usuario_id = $_SESSION['Usr']['usuarioId'];

        $sql ="insert into victima(
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
                    cordenada,
                    fechaIncidente,
                    timeRelacion,
                    numHijo,
                    usuario_id
                    )values(
                     '$nombre',
                     '$apaterno',
                     '$amaterno',
                     '$edad',
                     '$estadoCivil',
                     '$nacionalidad',
                     '$gradoEstudio',
                     '$ocupacion',
                     '$lugarNacimiento',
                     '$municipio',
                     '$colonia',
                     '$tipo',
                     '$cordenada',
                     '$fechaIncidente',
                     '$timeRelacion',
                     '$numHijo',
                     '$usuario_id'
                    )";
        $this->Util()->DB()->setQuery($sql);
        $id = $this->Util()->DB()->InsertData();

        return $id;
    }
    public function update(){
        if($this->Util()->PrintErrors()){
            return false;
        }

        $nombre =  $this->nombre;
        $apaterno = $this->apaterno;
        $amaterno = $this->amaterno;
        $edad = $this->edad;
        $estadoCivil = $this->estadoCivil;
        $nacionalidad = $this->nacionalidad;
        $gradoEstudio = $this->gradoEstudio;
        $ocupacion = $this->ocupacion;
        $lugarNacimiento = $this->lugarNacimiento;
        $municipio = $this->municipio;
        $colonia = $this->colonia;
        $tipo = $this->tipo;
        $cordenada = $this->cordenada;
        $fechaIncidente = $this->fechaIncidente;
        $timeRelacion = $this->timeRelacion;
        $numHijo = $this->numHijo;

        $sql ="update victima set 
                    nombre = '$nombre',
                    apaterno = '$apaterno',
                    amaterno = '$amaterno',
                    edad = '$edad',
                    estadoCivil = '$estadoCivil',
                    nacionalidad = '$nacionalidad',
                    gradoEstudio = '$gradoEstudio',
                    ocupacion = '$ocupacion',
                    lugarNacimiento = '$lugarNacimiento',
                    municipio_id = '$municipio',
                    colonia = '$colonia',
                    tipo = '$tipo',
                    fechaIncidente  = '$fechaIncidente',
                    cordenada = '$cordenada',
                    timeRelacion = '$timeRelacion',
                    numHijo = '$numHijo'
                    where victimaId ='".$this->victimaId."' ";
        $this->Util()->DB()->setQuery($sql);
        $this->Util()->DB()->UpdateData();

        return true;
    }
    public function saveComentario(){
        $comentarioAdicional = $this->comentarioAdicional;
        $sql ="update victima set 
                    comentarioAdicional = '$comentarioAdicional'
                    where victimaId ='".$this->victimaId."' ";
        $this->Util()->DB()->setQuery($sql);
        $this->Util()->DB()->UpdateData();

        $this->Util()->setError(0,"complete","Datos guardado correctamente");
        $this->Util()->PrintErrors();
        return true;
    }
    public function info(){
        $sql  = "select * from victima where victimaId= '".$this->victimaId."' ";
        $this->Util()->DB()->setQuery($sql);
        $row = $this->Util()->DB()->GetRow();
        if($row) {
            $municipiosLineal = $this->Util()->MunicipioByCve();
            $row['municipio'] =  $municipiosLineal[$row['municipio_id']];
            $row['municipioNacimiento'] =  $municipiosLineal[$row['lugarNacimiento']];
        }
        return $row;
    }
    public function Enumerate() {
        global $question;
        if($_SESSION['Usr']['rolId'] != '1')
            $add =  ' and municipio_id = "'.$_SESSION['Usr']['municipio_id'].'" ';

        if(!empty($_POST['nombre']))
            $add .=' and nombre like "%'.$_POST['nombre'].'%"';

        if(!empty($_POST['apaterno']))
            $add .=' and apaterno like "%'.$_POST['apaterno'].'%"';
        if(!empty($_POST['amaterno']))
            $add .=' and amaterno like "%'.$_POST['amaterno'].'%" ';

        $sql  = 'select count(*) from victima  where 1  ' . $add;
        $this->Util()->DB()->setQuery($sql);
        $total = $this->Util()->DB()->GetSingle();

        $iDisplayLength =  intval($_REQUEST['length']);
        $iDisplayLength =  $iDisplayLength < 0 ? $total : $iDisplayLength;
        $iDisplayStart = intval($_REQUEST['start']);
        $draw = intval($_REQUEST['draw']);
        $data['recordsTotal'] =  $total;

        $sqlLim = "LIMIT ".$iDisplayStart.", ".$iDisplayLength;

        $sql  = 'select * from victima  where 1  ' . $add . $sqlLim;
        $this->Util()->DB()->setQuery($sql);
        $victimas = $this->Util()->DB()->GetResult();

        $municipiosLineal =  $this->Util()->MunicipioByCve();
        foreach($victimas as $key=> $value){
              $question->setVictimaId($value["victimaId"]);
              $question->setContexto($value["tipo"]);
              $victimas[$key]["completePoll"] = $question->validateFullResolvePoll();
              $victimas[$key]["municipio"] = $municipiosLineal[$value['municipio_id']];
        }
        $data['draw'] =  $draw;
        $data['recordsTotal'] = $total;
        $data['recordsFiltered'] = $total;
        $data['data'] = $victimas;
        return $data;
    }
    public function EnumerateVictimasForMaps(){
        $filtro ="";
        $sql = 'SELECT * FROM victima ';
        $this->Util()->DB()->setQuery($sql);
        $result = $this->Util()->DB()->GetResult();
        foreach($result as $key => $value){
           $latLng =  explode(",",$value["cordenada"]);
           $this->setVictimaId($value['victimaId']);
           $resultPoll = $this->getResultPollByVictima();

           switch ($resultPoll) {
               case 'Baja': $colorInMap = '#ffff00'; break;
               case 'Moderada': $colorInMap = '#ffa500'; break;
               case 'Severa': $colorInMap = '#ff0000'; break;
               default: $colorInMap = '#808080'; break;

           }
           $result[$key]["lat"] = $latLng[0];
           $result[$key]["lng"] = $latLng[1];
           $result[$key]["resultPoll"] = $resultPoll;
           $result[$key]["colorInMap"] = $colorInMap;
        }
        return $result;

    }//orderUbicationReport

    function getResultPollByVictima($onlyPuntos =  false){
        $sql = "SELECT  a.puntos, a.porcentInChart FROM pollVictima a
                inner join encuesta b on a.encuestaId = b.encuestaId
                WHERE a.victimaId='".$this->victimaId."' and b.allow_analize ='1' group by a.encuestaId";
        $this->Util()->DB()->setQuery($sql);
        $result = $this->Util()->DB()->GetResult();

        if (count($result) <= 0)
             return 'Pendiente';
        $porcentajes = array_column($result, 'puntos');
        $porcentaje = array_sum($porcentajes) / count($result);

        if($porcentaje>40)
            return "Severa";
        elseif($porcentaje>20&&$porcentaje<=40)
            return "Moderada";
        else
            return "Baja";

    }
}
