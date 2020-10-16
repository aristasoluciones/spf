<?php

class Estado extends Main
{
	private $id;
	private $nombre;   //requerido
	private $ipdns;	   //requerido
	private $municipio;//requerido
	private $estado;   //reuerido
	private $clave;    //no requerido
	private $name_bd; //requerido

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
	public function setClave($value){
		//if($this->Util()->ValidateRequireField($value, 'Clave Tramite')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->clave = $value;
		//}
	}
    
    public function setIpDns($value){
		if($this->Util()->ValidateRequireField($value, 'IP o DNS')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->ipdns = $value;
		}
	}

	public function setMunicipio($value){
		if($this->Util()->ValidateRequireField($value, 'Municipio')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->municipio = $value;
		}
	}
	public function setEstado($value){
		if($this->Util()->ValidateRequireField($value, 'Estado')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->estado = $value;
		}
	}
	public function setNombreBd($value){
		if($this->Util()->ValidateRequireField($value, 'Nombre base de datos')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->name_bd = $value;
		}
	}
	public function Info(){
		$sql = 'SELECT * FROM delegaciones WHERE delegacion_id = "'.$this->id.'"';
		$this->Util()->DB()->setQuery($sql);
		$info = $this->Util()->DB()->GetRow();		
		return $info;
	}
	
	public function EnumerateAll(){
		$sql = 'SELECT * FROM estados';
		$this->Util()->DB()->setQuery($sql);
		$results = $this->Util()->DB()->GetResult();
		return $results;
	}
	
	public function Enumerate(){
		
		$sql = 'SELECT COUNT(*)	FROM delegaciones';
		$this->Util()->DB()->setQuery($sql);
		$total = $this->Util()->DB()->GetSingle();
		
		$resPage = $this->Util->HandlePagesAjax($this->page, $total , '');		
		$sqlLim = "LIMIT ".$resPage['pages']['start'].", ".$resPage['pages']['items_per_page'];
		 
		$sql = 'SELECT 
				*
				FROM delegaciones 
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
		INSERT INTO  delegaciones (
				`nombre`,
				`municipio`, 
				`estado`,
			    `base_datos`,
			    `dns_ip`,
			    `clave_delegacion`,
				`fecha_creacion`,
				`usuario_creacion`,
				)
				VALUES (
				'".$this->nombre."',
				".$this->municipio.",
				".$this->estado.",
				'".$this->name_bd."',
				'".$this->ipdns."',
				'".$this->clave."',
				'".date('Y-m-d')."',
				'".$_SESSION['Usr']['usuario']."'
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
				delegaciones SET 
				nombre = "'.$this->nombre.'",
				municipio = '.$this->municipio.',
				estado = '.$this->estado.',
				base_datos = "'.$this->name_bd.'",
				dns_ip = "'.$this->ipdns.'",
				clave_delegacion = "'.$this->clave.'",			
				fecha_modificacion = "'.date('Y-m-d').'",
				usuario_modificacion = "'.$_SESSION['Usr']['usuario'].'"
				WHERE delegacion_id = "'.$this->id.'"';
				
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
			
		$this->Util()->setError(10130, 'complete', '');
		$this->Util()->PrintErrors();
		
		return true;
	}//Update
	
	public function Delete(){
		
		$sql = 'UPDATE 
				delegaciones SET 
				status = "baja"
				WHERE delegacion_id = "'.$this->id.'"';
				
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
			
		$this->Util()->setError(3, 'error', '');
		$this->Util()->PrintErrors();
		
		return true;
		
	}//Delete
	
	
						
}

?>