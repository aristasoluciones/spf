<?php

class Producto extends Main
{
	private $id;
	private $nombre;
	private $descripcion;
	private $caracteristica;
	private $panterior;
	private $pactual;
	private $promocion;
	private $aquien;
	private $ventaja;
	private $url;
	private $nombre_archivo;
	private $extension;
	private $pcat_id;
	//variables para salvar imagen directo a la base de datos
	private $anchura;
	private $altura;
	private $tipo;
	private $dataBloob;
	private $sustancia;

	

	public function setId($value){
		$this->Util()->ValidateInteger($value);
		$this->id = $value;
	}
	public function setPcatId($value){
		$this->Util()->ValidateInteger($value);
		$this->pcat_id = $value;
	}
	
	
	public function setSustancia($value){
		if($this->Util()->ValidateRequireField($value, 'Sustancia Activa')){
			$this->Util()->ValidateString($value, 100000, 0, '');
			$this->sustancia = $value;
		}
	}
	
	public function setNombre($value){
		if($this->Util()->ValidateRequireField($value, 'Nombre')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->nombre = $value;
		}
	}
	public function setDescripcion($value){
		if($this->Util()->ValidateRequireField($value, 'Descripcion')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->descripcion = $value;
		}
	}
	public function setPrecioActual($value){
		if($this->Util()->ValidateRequireField($value, 'Precio actual')){
			$this->Util()->ValidateNumeric($value, 'Precio actual');
			$this->pactual = $value;
		}
	}
	public function setPrecioAnterior($value){
			$this->Util()->ValidateNumeric($value, 'Precio anterior');
			$this->panterior = $value;
		
	}
	public function setCaracteristica($value){
		if($this->Util()->ValidateRequireField($value, 'Caracteristicas')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->caracteristica = $value;
		}
	}
	public function setPromocion($value){
	
			$this->promocion = $value;
		
	}
	public function setAquien($value){
		if($this->Util()->ValidateRequireField($value, ' A quien va dirigido')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->aquien = $value;
		}
	}
    public function setVentaja($value){
		if($this->Util()->ValidateRequireField($value, 'Ventajas ')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->ventaja= $value;
		}
	}
	//setters para agregar productos a categoria
	public function setFile($value){
		if($value["error"]===4)
		{
		  $this->Util()->setError(10136, 'error', '');
		}

		if($value["type"]!="image/jpeg"&&$value["type"]!="image/png")
		{
		  $this->Util()->setError(10138, 'error', '');
		}
		
	}
	public function setUrl($value){
		/*if($this->Util()->ValidateRequireField($value, 'Nombre')){*/
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->url = $value;
		/*}*/
	}
	public function setNarchivo($value){
		/*if($this->Util()->ValidateRequireField($value, 'Nombre')){*/
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->nombre_archivo = $value;
		/*}*/
	}
	public function setExtension($value){
		/*if($this->Util()->ValidateRequireField($value, 'Nombre')){*/
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->extension = $value;
		/*}*/
	}
    public function setAnchura($value){
		$this->anchura = $value;
	}
	 public function setAltura($value){
		$this->altura = $value;
	}
	 public function setTipo($value){
		$this->tipo = $value;
	}
	 public function setDataBloob($value){
		$this->dataBloob = $value;
	}
    public function getLastIdPcat(){
		$sql = 'SELECT MAX(producto_categoria_id) FROM productos_categorias';
		$this->Util()->DB()->setQuery($sql);
		$single = $this->Util()->DB()->GetSingle();		
		return $single;
	}
	 public function getLastIdCat(){
		$sql = 'SELECT MAX(categoriaId) FROM categoria';
		$this->Util()->DB()->setQuery($sql);
		$single = $this->Util()->DB()->GetSingle();		
		return $single;
	}
	//Ontener datos y listados
	public function Info(){
		$sql = 'SELECT * FROM categoria WHERE categoriaId = "'.$this->id.'"';
		$this->Util()->DB()->setQuery($sql);
		$info = $this->Util()->DB()->GetRow();		
		return $info;
	}
	public function Info2(){
		$sql = 'SELECT * FROM productos_categorias WHERE producto_categoria_id = "'.$this->id.'"';
		$this->Util()->DB()->setQuery($sql);
		$info = $this->Util()->DB()->GetRow();		
		return $info;
	}
	
	public function EnumerateAll(){
		$sql = 'SELECT * FROM categoria where status="Activo"';
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		return $result;
	}
	
	public function Enumerate(){
		
		$sql = 'SELECT COUNT(*)	FROM catalogo_tramites WHERE status = "alta"';
		$this->Util()->DB()->setQuery($sql);
		$total = $this->Util()->DB()->GetSingle();
		
		$resPage = $this->Util->HandlePagesAjax($this->page, $total , '');		
		$sqlLim = "LIMIT ".$resPage['pages']['start'].", ".$resPage['pages']['items_per_page'];
		 
		$sql = 'SELECT 
				*
				FROM catalogo_tramites 
				
				WHERE status = "alta"
				ORDER BY nombre_corto DESC
				'.$sqlLim;
		$this->Util()->DB()->setQuery($sql);
		$data['result'] = $this->Util()->DB()->GetResult();
		
		$data['pages'] = $resPage['pages'];
		$data['info'] = $resPage['info'];
					
		return $data;
		
	}//Enumerate
    //FUNCIONES DE VALIDACION
    
	public function Save(){
						
		if($this->Util()->PrintErrors()){ 
			return false; 
		}
		$sql = "
		INSERT INTO  categoria (
				`nombre`, 
				`descripcion`,
				`aquien`,
				`ventajas`,
				`anchura`,
				`altura`,
				`tipo`,
				`url`,
				`imagen`
				)
				VALUES (
				'".$this->nombre."',
				'".$this->descripcion."',
				'".$this->aquien."',
				'".$this->ventaja."',
				'".$this->anchura."',
				'".$this->altura."',
				'".$this->tipo."',
				'".$this->url."',
				'".$this->nombre_archivo."'
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
		if($this->anchura!="")
            $add .=', anchura = "'.$this->anchura.'"';

        if($this->altura!="")
            $add .=', altura = "'.$this->altura.'"';
        
        if($this->tipo!="")
            $add .=', tipo = "'.$this->tipo.'"';

         if($this->dataBloob!="")
            $add .=', imagen = "'.$this->dataBloob.'"';

		$sql = 'UPDATE 
				categoria SET 
				nombre = "'.$this->nombre.'",			
				descripcion = "'.$this->descripcion.'",
				aquien = "'.$this->aquien.'",
				ventajas = "'.$this->ventaja.'"
				'.$add.'	
				WHERE categoriaId = "'.$this->id.'"';
				
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
			
		$this->Util()->setError(10130, 'complete', '');
		$this->Util()->PrintErrors();
		
		return true;
	}//Update
	public function getListProductoCategoria(){
      $sql = "SELECT C.nombre as cat_name,PC.* FROM productos_categorias PC
      JOIN categoria C on PC.categoria_id = C.categoriaId where PC.categoria_id=".$this->id;

      $this->Util()->DB()->setQuery($sql);
      $result = $this->Util()->DB()->GetResult();

      return $result;

	}
	public function SavePcat(){
						
		if($this->Util()->PrintErrors()){ 
			return false; 
		}
		 $sql = "
		INSERT INTO  productos_categorias (
				`nombre`, 
				`descripcion`,
				`caracteristica`,
				`categoria_id`,
				`nombre_archivo`,
				`extension`,
				`url`,
				`status`,
				`promocion`,
				`precioAnterior`,
				`sustancia`,
				`precioActual`
				)
				VALUES (
				'".$this->nombre."',
				'".$this->descripcion."',
				'".$this->caracteristica."',
				".$this->id.",
				'".$this->nombre_archivo."',
				'".$this->extension."',
				'".$this->url."',
				'Activo',
				'".$this->promocion."',
				'".$this->panterior."',
				'".$this->sustancia."',
				'".$this->pactual."'
				);
		";
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->InsertData();
			
		$this->Util()->setError(10129, 'complete', '');
		$this->Util()->PrintErrors();
		return true;	
	}//Save
	public function UpdatePcat(){
	  $add ="";		
		if($this->Util()->PrintErrors()){ 
			return false; 
		}

		if($this->nombre_archivo!="")
            $add .=', nombre_archivo = "'.$this->nombre_archivo.'"';

        if($this->extension!="")
            $add .=', extension = "'.$this->extension.'"';
        
        if($this->url!="")
            $add .=', url = "'.$this->url.'"';
        



		$sql = 'UPDATE 
				productos_categorias SET 
				nombre = "'.$this->nombre.'",			
				descripcion = "'.$this->descripcion.'",
				caracteristica = "'.$this->caracteristica.'",
				promocion = "'.$this->promocion.'",
				precioAnterior = "'.$this->panterior.'",
				precioActual = "'.$this->pactual.'",
				sustancia = "'.$this->sustancia.'",
				status = "Activo"
				'.$add.'
				WHERE producto_categoria_id = "'.$this->pcat_id.'"';
				
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
			
		$this->Util()->setError(10130, 'complete', '');
		$this->Util()->PrintErrors();
		
		return true;
	}//Update
	
	public function UpdateData(){		
		$sql = 'UPDATE 
				productos_categorias SET 
				nombre_archivo = "'.$this->nombre_archivo.'",			
				extension = "'.$this->extension.'"
				WHERE producto_categoria_id = "'.$this->id.'"';
				
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
	   return true;
	}//Update
	public function UpdateDataImage(){		
		$sql = 'UPDATE 
				categoria SET 
				url = "'.$this->url.'",
				imagen = "'.$this->nombre_archivo.'",			
				tipo = "'.$this->tipo.'"
				WHERE categoriaId = "'.$this->id.'"';
				
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
	   return true;
	}//Update

	public function RollBackData(){		
		$sql = 'DELETE * FROM productos_categorias where producto_categoria_id = "'.$this->id.'"';
				
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->DeleteData();
	   return true;
	}//Update
	public function RollBackDataCat(){		
		$sql = 'DELETE * FROM categoria where categoriaId = "'.$this->id.'"';
				
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->DeleteData();
	   return true;
	}//Update

	public function Delete(){
		
		$sql = 'UPDATE 
				productos_categorias SET 
				status = "Baja"
				WHERE producto_categoria_id = "'.$this->id.'"';
				
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();

		$this->Util()->setError(4, 'complete', '');
		$this->Util()->PrintErrors();
		return true;
		
	}//
	public function DeleteCategoria(){
		
		$sql = 'UPDATE 
				categoria SET 
				status = "Baja"
				WHERE categoriaId = "'.$this->id.'"';
				
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();

		$this->Util()->setError(4, 'complete', '');
		$this->Util()->PrintErrors();
		return true;
		
	}//
	public function Activar(){
		
		$sql = 'UPDATE 
				productos_categorias SET 
				status = "Activo"
				WHERE producto_categoria_id = "'.$this->id.'"';
				
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();

		$this->Util()->setError(5, 'complete', '');
		$this->Util()->PrintErrors();
		return true;
		
	}//
    public function Suggestion(){
	    $filtro ="";
	    if($_POST['categoria']!="")
	         $filtro .=" AND categoria_id=".$_POST['categoria']."";
	    $sql =  "SELECT producto_categoria_id as id,nombre FROM productos_categorias WHERE nombre LIKE '%".$_POST['query']."%' ".$filtro ." ";
        $this->Util()->DB()->setQuery($sql);
        $result = $this->Util()->DB()->GetResult();

        return $result;
    }
	
	
						
}

?>