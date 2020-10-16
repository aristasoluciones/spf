<?php

class Puesto extends Main
{
	private $id;
	private $nombre;
	private $cargo;
	private $profesion;
	private $oficina;
	private $activo;

    
	public function setId($value){
		$this->Util()->ValidateInteger($value);
		$this->id = $value;
	}
	public function setNombre($value){
		if($this->Util()->ValidateRequireField($value, 'Nombre')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->nombre = $value;
		}
	}
	public function setCargo($value){
		if($this->Util()->ValidateRequireField($value, 'Cargo')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->cargo= $value;
		}
	}
	public function setProfesion($value){
		if($this->Util()->ValidateRequireField($value, 'Profesion ')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->profesion = $value;
		}
	}
	public function setOficina($value){
		if($this->Util()->ValidateRequireField($value, 'Direccion oficina')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->oficina = $value;
		}
	}
	public function setActivo($value){
		if($this->Util()->ValidateRequireField($value, 'Status')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->activo = $value;
		}
	}
    
    
    
	
	public function Info(){
		$sql = 'SELECT * FROM puestos WHERE puestosid = "'.$this->id.'"';
		$this->Util()->DB()->setQuery($sql);
		$info = $this->Util()->DB()->GetRow();		
		return $info;
	}
	
	public function EnumerateAll(){
		$sql = 'SELECT * FROM puestos';
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
		INSERT INTO  puestos (
				`nombre`, 
				`cargo`,
				`profesion`,
				`oficina`,
				`activo`
				)
				VALUES (
				'".$this->nombre."',
				'".$this->cargo."',
				'".$this->profesion."',
				'".$this->oficina."',
				'Si'
				);
		";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->InsertData();
			
		$this->Util()->setError(10129, 'complete', '');
		$this->Util()->PrintErrors();
		return true;	
	}//Save
	
	public function Update(){		
		if($this->Util()->PrintErrors()){ 
			return false; 
		}
		$sql = 'UPDATE 
				puestos SET 
				nombre = "'.$this->nombre.'",
				cargo = "'.$this->cargo.'",
				profesion = "'.$this->profesion.'",
				oficina = "'.$this->oficina.'",
				activo = "'.$this->activo.'"					
				WHERE puestosid = "'.$this->id.'" ';
				
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
			
		$this->Util()->setError(10130, 'complete', '');
		$this->Util()->PrintErrors();
		
		return true;
	}//Update
	
	public function Delete(){
		
		$sql = 'UPDATE 
				puestos SET 
				status = "No"
				WHERE puestosid = "'.$this->id.'"';
				
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
			
		$this->Util()->setError(3, 'error', '');
		$this->Util()->PrintErrors();
		
		return true;
		
	}//Delete
	
	
						
}

?>