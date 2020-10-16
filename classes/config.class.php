<?php

class Config extends Main
{
	private $id;
	private $titulo;
	private $descripcion;
    private $url;

	private $nombre;
	private $rfc;
	private $direccion;
	private $cp;
	private $telefono;
	private $email;
	private $pais;
	private $ciudad;
	private $estado;

	public function setId($value){
		$this->Util()->ValidateInteger($value);
		$this->id = $value;
	}
	public function setDescripcion($value){
		if($this->Util()->ValidateRequireField($value, 'Descripcion')){
			$this->descripcion = $value;
		}
	}
	public function setNombre($value){
		if($this->Util()->ValidateRequireField($value, 'Nombre')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->nombre = $value;
		}
	}
	public function setRfc($value){
			$this->rfc = $value;
		
	}
	public function setDireccion($value){
			$this->direccion = $value;
		
	}	
	public function setCp($value){
			$this->cp = $value;
		
	}	
	public function setTelefono($value){
			$this->telefono = $value;
		
	}	
	public function setEmail($value){
			$this->email = $value;
		
	}	
	public function setPais($value){
			$this->pais = $value;
		
	}
	public function setCiudad($value){
			$this->ciudad = $value;
		
	}
	public function setEstado($value){
			$this->estado = $value;
		
	}			
	public function setTituloNota($value){
		if($this->Util()->ValidateRequireField($value, 'Titulo de la nota')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->titulo = $value;
		}
	}
	public function setUrl($value){
			$this->url = $value;
		
	}	
	 public function setFile($value=array(),$tipo=false,$type){
       
		//verificar si no excene el tamaño maximo de archivo
		if($value["size"] > $this->Util()->return_bytes(ini_get('upload_max_filesize')))
		{
			 $this->Util()->setError(0, 'error', 'Tamaño de archivo sobrepasa los '.ini_get('upload_max_filesize').' permitidos');
		}

		 //comprobar que el tamaño de archivo sea el permitido por POST en la configuracion del php.ini
		if($value["size"] > $this->Util()->return_bytes(ini_get('post_max_size'))){
			 $this->Util()->setError(0, 'error', 'Tamaño de archivo excede lo permitido en la configuracion POST_MAX_SIZE, tamaño maximo <= '.ini_get('post_max_size'));
			

		}
        if($value["error"]===1)
		{
		  $this->Util()->setError(0, 'error', 'Verificar, no es posible subir por falta de atributos del archivo');
		 
		}

		if($value["error"]===4)
		{
		  $this->Util()->setError(10136, 'error', '');
		
		}
		

		if($tipo){
			
			if($value["type"]!=$type)
			{ 
				 $this->Util()->setError(10139, 'error',"Solo se aceptan archivos ".$type);
			}
		}
		else
		{
			if($value["type"]!="image/jpeg"&&$value["type"]!="image/png")
			  $this->Util()->setError(10138, 'error', '');

		}
		
	}
	//Ontener datos y listados
	public function Info(){
		$sql = 'SELECT * FROM permissions WHERE ID = "'.$this->id.'"';
		$this->Util()->DB()->setQuery($sql);
		$info = $this->Util()->DB()->GetRow();		
		return $info;
	}
	public function DatosEmpresa(){
		$sql = 'SELECT * FROM datosempresa WHERE datoEmpresaId = 1';
		$this->Util()->DB()->setQuery($sql);
		$info = $this->Util()->DB()->GetRow();		
		return $info;
	}
	public function GetNotaActual(){
		$sql = 'SELECT * FROM blog WHERE apareceIndex = "si"';
		$this->Util()->DB()->setQuery($sql);
		$info = $this->Util()->DB()->GetRow();		
		return $info;
	}
    public function EnumerateAll(){
		$sql = 'SELECT * FROM catalogo_tramites WHERE 1';
		$this->Util()->DB()->setQuery($sql);
		$info = $this->Util()->DB()->GetResult();
		return $info;
	}
	public function getLastIdBlog(){
		$sql = 'SELECT MAX(blogId) FROM blog';
		$this->Util()->DB()->setQuery($sql);
		$single = $this->Util()->DB()->GetSingle();		
		return $single;
	}
	public function EnumerateColonia(){
		$sql = 'SELECT * FROM colonias WHERE 1';
		$this->Util()->DB()->setQuery($sql);
		$info = $this->Util()->DB()->GetResult();
		return $info;
	}
	public function ComprobarCat(){
						
		if($this->Util()->PrintErrors()){ 
			return false; 
		}

		return true;
	}
	public function SaveBlog(){
						
		if($this->Util()->PrintErrors()){ 
			return false; 
		}
		 $sql = "
		INSERT INTO  blog (
			    `fechaPublicacion`,
			    `autor`,  
				`titulo`, 
				`texto`,
				`apareceIndex`
				)
				VALUES (
				'".date('Y-m-d')."',
				'Farmacias SalinasG',
				'".$this->titulo."',
				'".$this->descripcion."',
				'si'
				);
		";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->InsertData();
			
		$this->Util()->setError(10129, 'complete', '');
		$this->Util()->PrintErrors();
		return true;	
	}//Save
	public function UpdateData(){		
		$sql = 'UPDATE 
				blog SET 
				rutaImagen = "'.$this->url.'"			
				WHERE blogId = "'.$this->id.'"';
				
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
	   return true;
	}//Update
	public function RollBackData(){		
		$sql = 'DELETE * FROM blog where blogId = "'.$this->id.'"';
				
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->DeleteData();
	   return true;
	}//Update
	public function getListPermisos(){
				 
		$sql = 'SELECT 
				*
				FROM permissions
				ORDER BY Description DESC
				';
		$this->Util()->DB()->setQuery($sql);
		$data= $this->Util()->DB()->GetResult();			
		return $data;
	}//Enumerate
   public function DesactivarAnterior(){		
		$sql = 'UPDATE 
				blog SET 
				apareceIndex = "no"			
				WHERE blogId = "'.$this->id.'"';
				
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
	   return true;
	}//DesactivarAnterior

	public function getOnlyColumnArray($temp=array(),$field){
      $newarray =  array();
      foreach($temp as $key =>$value)
      	  $newarray[] = $value[$field];

      	return $newarray;
	}
	public function SaveDatosEmpresa(){
						
		if($this->Util()->PrintErrors()){ 
			return false; 
		}
		 $sql = "
		INSERT INTO  datosempresa(
			    `nombre`,
			    `ciudad`, 
			    `estado`,  
				`pais`, 
				`direccion`,
				`cp`,
				`email`,
				`rfc`,
				`telefono`
				)
				VALUES (
				'".$this->nombre."',
				'".$this->ciudad."',
				'".$this->estado."',
				'".$this->pais."',
				'".$this->direccion."',
				'".$this->cp."',
				'".$this->email."',
				'".$this->rfc."',
				'".$this->telefono."'
				);
		";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->InsertData();
			
		$this->Util()->setError(10129, 'complete', 'Datos de la empresa guardadas');
		$this->Util()->PrintErrors();
		return true;	
	}//Save
	public function UpdateDatosEmpresa(){
      if($this->Util()->PrintErrors()){ 
			return false; 
		}

		$sql = 'UPDATE 
				datosempresa SET 
				nombre = "'.$this->nombre.'",
				ciudad = "'.$this->ciudad.'",
				estado = "'.$this->estado.'",
				pais = "'.$this->pais.'",
				direccion = "'.$this->direccion.'",
				cp = "'.$this->cp.'",
				email = "'.$this->email.'",
				rfc = "'.$this->rfc.'",
				telefono = "'.$this->telefono.'"			
				WHERE datoEmpresaId = "'.$this->id.'"';
				
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
	    $this->Util()->setError(10129, 'complete', 'Datos de la empresa actualizadas');
		$this->Util()->PrintErrors();
		return true;
	}//Update
	
}

?>