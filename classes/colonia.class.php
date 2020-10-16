<?php

class Colonia extends Main
{
    private $id;
    private $nombre;
    private $municipioId;
    private $coorx;
    private $coory;

    public function setId($value){
        $this->Util()->ValidateInteger($value);
        $this->id = $value;
    }
    public function setNombre($value){
        if($this->Util()->ValidateRequireField($value, 'Colonia')){
            $this->nombre = $value;
        }
    }
    public function setMunicipioId($value){
        if($this->Util()->ValidateRequireField($value, 'Municipio')){
            $this->municipioId = $value;
        }
    }
    public function setCoordenadaX($value){
        if($this->Util()->ValidateRequireField($value, 'Coordenada X')){
            $this->coorx = $value;
        }
    }
    public function setCoordenadaY($value){
        if($this->Util()->ValidateRequireField($value, 'Coordenada Y')){
            $this->coory = $value;
        }
    }
    public function Info()
    {
        $sql = "SELECT * FROM colonias WHERE coloniaId=".$this->id." ";
        $this->Util()->DB()->setQuery($sql);
        $row = $this->Util()->DB()->GetRow();

        return $row;
    }
    public function EnumerateAll(){
        $filtro ="";
        echo $sql = 'SELECT count(*) FROM colonias a LEFT JOIN municipio b ON a.codigoMunicipio=b.municipioId
				WHERE a.status= "activo"';
        $this->Util()->DB()->setQuery($sql);
        $total = $this->Util()->DB()->GetSingle();

        $resPage = $this->Util->HandlePagesAjax($this->page, $total , '');
        $sqlLim = "LIMIT ".$resPage['pages']['start'].", ".$resPage['pages']['items_per_page'];

        echo $sql0 = 'SELECT a.*,b.nombre as municipio FROM colonias a LEFT JOIN municipio b ON a.municipioId=b.municipioId
				WHERE a.status= "activo"
				ORDER BY nombreColonia ASC '.$sqlLim;
        $this->Util()->DB()->setQuery($sql0);
        $data['result'] = $this->Util()->DB()->GetResult();

        $data['pages'] = $resPage['pages'];
        $data['info'] = $resPage['info'];
        return $data;
    }//Enumerate
    public function Save(){
        if($this->Util()->PrintErrors())
            return false;

        $sql =  "INSERT INTO colonias(
                            nombreColonia,
                            municipioId,
                            x,
                            y,
                            status 
                            )
                            VALUES(
                            '".$this->nombre."',
                            '".$this->municipioId."',
                            '".$this->coorx."',
                            '".$this->coory."',
                             'activo'
                            );";
        $this->Util()->DB()->setQuery($sql);
        $this->Util()->DB()->InsertData();
        $this->Util()->setError(10129, 'complete', 'La colonia se agrego correctamente');
        $this->Util()->PrintErrors();
        return true;
    }
    public function Update(){
        if($this->Util()->PrintErrors())
            return false;

        $sql =  "UPDATE colonias SET
                            nombreColonia='".$this->nombre."',
                            municipioId='".$this->municipioId."',
                            x='".$this->coorx."',
                            y='".$this->coory."'
                            WHERE coloniaId =".$this->id."
                            ;";

        $this->Util()->DB()->setQuery($sql);
        $this->Util()->DB()->UpdateData();
        $this->Util()->setError(10129, 'complete', 'La colonia se actualizo correctamente');
        $this->Util()->PrintErrors();
        return true;
    }
    public function Delete(){
        $sql =  "UPDATE colonias SET status='eliminado'  WHERE coloniaId=".$this->id;
        $this->Util()->DB()->setQuery($sql);
        $this->Util()->DB()->UpdateData();
        $this->Util()->setError(10129, 'complete', 'La colonia se elimino correctamente');
        $this->Util()->PrintErrors();
        return true;
    }
}
?>
