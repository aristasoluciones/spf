<?php

class Sucursal extends Main
{
	private $id;
	private $nombre;
	private $descripcion;
	private $encargado;
	private $direccion;
	private $cordenaday;
	private $cordenadax;
	private $horario;
	private $municipioId;

	public function setId($value){
		$this->Util()->ValidateInteger($value);
		$this->id = $value;
	}
	
	
	public function setMunicipioId($value){
		if($this->Util()->ValidateRequireField($value, 'Municipio')){
			$this->Util()->ValidateInteger($value);
			$this->municipioId = $value;
		}
	}
	
	
	public function setNombre($value){
		if($this->Util()->ValidateRequireField($value, 'Nombre')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->nombre = $value;
		}
	}
	public function setDescripcion($value){
		if($this->Util()->ValidateRequireField($value, 'Descripción')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->descripcion = $value;
		}
	}
	public function setEncargado($value){
		if($this->Util()->ValidateRequireField($value, 'Encargado')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->encargado = $value;
		}
	}
	public function setDireccion($value){
		if($this->Util()->ValidateRequireField($value, 'Dirección')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->direccion = $value;
		}
	}
	public function setCordenadaX($value){
			$this->Util()->ValidateNumeric($value, 'Cordenada X',"Negativo");
			$this->cordenadax = $value;
		
	}
    public function setCordenadaY($value){
			$this->Util()->ValidateNumeric($value, 'Cordenada Y','Negativo');
			$this->cordenaday = $value;
		
	}
    public function setHorario($value){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->horario = $value;
	}

    
	
	public function Info(){
		$sql = 'SELECT * FROM sucursal WHERE sucursalid = "'.$this->id.'"';
		$this->Util()->DB()->setQuery($sql);
		$info = $this->Util()->DB()->GetRow();		
		return $info;
	}
	
	public function EnumerateAll(){
		$sql = 'SELECT * FROM sucursal';
		$this->Util()->DB()->setQuery($sql);
		$results = $this->Util()->DB()->GetResult();
		return $results;
	}
	
	public function Enumerate(){
		
		$sql = 'SELECT COUNT(*)	FROM requisitos';
		$this->Util()->DB()->setQuery($sql);
		$total = $this->Util()->DB()->GetSingle();
		
		$resPage = $this->Util->HandlePagesAjax($this->page, $total , '');		
		$sqlLim = "LIMIT ".$resPage['pages']['start'].", ".$resPage['pages']['items_per_page'];
		 
		$sql = 'SELECT 
				*
				FROM requisitos 
				ORDER BY nombre DESC
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
		$sql = "
		INSERT INTO  sucursal (
				`nombre`, 
				`descripcion`,
				`encargado`,
				`direccion`,
				`coordenadaX`,
				`coordenadaY`,
				`horario`,
				`status`,
				`municipioId`
				)
				VALUES (
				'".$this->nombre."',
				'".$this->descripcion."',
				'".$this->encargado."',
				'".$this->direccion."',
				'".$this->cordenadax."',
				'".$this->cordenaday."',
				'".$this->horario."',
				'Activo',
				'".$this->municipioId."'
				);
		";
		$this->Util()->DB()->setQuery($sql);
		$this->id = $this->Util()->DB()->InsertData();
		
		foreach($_FILES as $key=>$var)
		{

			$aux = explode(".",$_FILES["img"]["name"]);
			$extencion=end($aux);
			$temporal = $_FILES["img"]["tmp_name"];

			$url = DOC_ROOT;				
			$foto_name= $this->id.".".$extencion;
			
			if(move_uploaded_file($temporal,$url."/images/sucursales/".$foto_name)){		
												
					$sql = 'UPDATE 		
					sucursal SET 		
					rutaFoto = "'.$foto_name.'"			      		
					WHERE sucursalid = '.$this->id.'';		
						
				$this->Util()->DB()->setQuery($sql);		
				$this->Util()->DB()->UpdateData();

			   }
		}	
		$this->Util()->setError(10129, 'complete', '');
		$this->Util()->PrintErrors();
		return true;	
	}//Save
	
	public function Update(){		
		if($this->Util()->PrintErrors()){ 
			return false; 
		}
		$sql = 'UPDATE 
				sucursal SET 
				nombre = "'.$this->nombre.'",
				descripcion = "'.$this->descripcion.'",
				encargado = "'.$this->encargado.'",
				direccion = "'.$this->direccion.'",
				coordenadaX = "'.$this->cordenadax.'",
				coordenadaY = "'.$this->cordenaday.'",
				horario = "'.$this->horario.'",					
				municipioId = "'.$this->municipioId.'"					
				WHERE sucursalid = "'.$this->id.'"';
				
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
		
		foreach($_FILES as $key=>$var)
		{

			$aux = explode(".",$_FILES["img"]["name"]);
			$extencion=end($aux);
			$temporal = $_FILES["img"]["tmp_name"];

			$url = DOC_ROOT;				
			$foto_name= $this->id.".".$extencion;
			
			if(move_uploaded_file($temporal,$url."/images/sucursales/".$foto_name)){		
												
					$sql = 'UPDATE 		
					sucursal SET 		
					rutaFoto = "'.$foto_name.'"			      		
					WHERE sucursalid = '.$this->id.'';		
						
				$this->Util()->DB()->setQuery($sql);		
				$this->Util()->DB()->UpdateData();

			   }
		}	
			
		$this->Util()->setError(10130, 'complete', '');
		$this->Util()->PrintErrors();
		
		return true;
	}//Update
	
	public function Delete(){
		
		$sql = 'UPDATE 
				sucursal SET 
				status = "Baja"
				WHERE sucursalid = "'.$this->id.'"';
				
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
			
		$this->Util()->setError(4, 'complete', '');
		$this->Util()->PrintErrors();
		
		return true;
		
	}//Delete
	public function ActiveSucursal(){
		
		$sql = 'UPDATE 
				sucursal SET 
				status = "Activo"
				WHERE sucursalid = "'.$this->id.'"';
				
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
			
		$this->Util()->setError(5, 'complete', '');
		$this->Util()->PrintErrors();
		
		return true;
		
	}//Delete
	
	public function enumerateMunicipio(){
		
		$sql = 'SELECT * FROM municipio';
		$this->Util()->DB()->setQuery($sql);
		$results = $this->Util()->DB()->GetResult();
		return $results;
		

		
	}//Delete
	
	
	
						
}

?>