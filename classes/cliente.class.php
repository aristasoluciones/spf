<?php

class Cliente extends Main
{
	private $id;
	private $nombre;
	private $telefono;
	private $email;
	private $usuario;
	private $passwd;
	private $tipo;
	private $activo;
	private $establoId;
	private $dependenciaId;
	private $tiporeporte;
	private $apaterno;
	private $amaterno;
	private $calle;
	private $noexterior;
	private $colonia;
	private $ciudad;
	private $estado;
	private $pais;
	private $sexo;
	private $inicio;
	private $fin;
	
	public function setSexo($value){	
	
			$this->Util()->ValidateString($value);
			$this->sexo = $value;
	
	}
	
	public function setInicio($value){
		// $this->Util()->ValidateInteger($value);
		$this->inicio = $value;
	}
	
	public function setFin($value){
		// $this->Util()->ValidateInteger($value);
		$this->fin = $value;
	}
	
	
	public function tipoReporte($value){
		// $this->Util()->ValidateInteger($value);
		$this->tiporeporte = $value;
	}
	
	
	public function setId($value){
		$this->Util()->ValidateInteger($value);
		$this->id = $value;
	}
	
	
	public function setDependenciaId($value){
		$this->Util()->ValidateInteger($value);
		$this->dependenciaId = $value;
	}
	
	
	public function setDireccion($value){	
		if($this->Util()->ValidateRequireField($value, 'Direccion')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->direccion = $value;
		}		
	}
	
	public function setCalle($value){	
		if($this->Util()->ValidateRequireField($value, 'Calle')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->calle = $value;
		}		
	}
	public function setPaterno($value){	
		if($this->Util()->ValidateRequireField($value, 'Apellido paterno')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->apaterno = $value;
		}		
	}
	public function setMaterno($value){	
		if($this->Util()->ValidateRequireField($value, 'Apellido materno')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->amaterno = $value;
		}		
	}
	
	public function setNoExterior($value){	
		if($this->Util()->ValidateRequireField($value, 'No. Exterior')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->noexterior = $value;
		}		
	}
	
	public function setColonia($value){	
		if($this->Util()->ValidateRequireField($value, 'Colonia')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->colonia = $value;
		}		
	}
	
	public function setCiudad($value){	
		if($this->Util()->ValidateRequireField($value, 'Ciudad')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->ciudad = $value;
		}		
	}
	
	public function setEstado($value){	
		if($this->Util()->ValidateRequireField($value, 'Estado')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->estado = $value;
		}		
	}
	
	public function setPais($value){	
		if($this->Util()->ValidateRequireField($value, 'Pais')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->pais = $value;
		}		
	}
	
	
	public function setNombre($value){	
		if($this->Util()->ValidateRequireField($value, 'Nombre')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->nombre = $value;
		}		
	}
	
	public function setTelefono($value){
		$this->Util()->ValidateString($value, 100, 0, '');
		$this->telefono = $value;
	}
	
	public function setEmail($value, $validate = false){	
		if($this->Util()->ValidateRequireField($value, 'Email')){
			if($validate)
				$this->Util()->ValidateMail($value);
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->email = $value;			
		}		
	}
	
	public function setUsuario($value){	
		if($this->Util()->ValidateRequireField($value, 'Usuario')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->usuario = $value;
		}		
	}
	
	public function setPasswd($value){	
		if($this->Util()->ValidateRequireField($value, 'Contrase&ntilde;a')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->passwd = $value;
		}		
	}
	
	public function setTipo($value){	
		$this->Util()->ValidateString($value, 100, 0, '');
		$this->tipo = $value;
	}
	
	public function setActivo($value){	
		$this->Util()->ValidateString($value, 100, 0, '');
		$this->activo = $value;
	}
		
	public function Info(){
		
		$sql = 'SELECT * FROM clientes WHERE clienteId = "'.$this->id.'"';
		$this->Util()->DB()->setQuery($sql);
		$info = $this->Util()->DB()->GetRow();
		return $info;
	}//Info
	
	public function Enumerate(){

		if($this->nombre){
			$filtro .= ' and nombre like "%'.$this->nombre.'%"';
		}
		
		if($this->sexo){
			$filtro .= ' and sexo = "'.$this->sexo.'"';
		}
		
		if($this->inicio and $this->fin){
			$filtro .= ' and fechaNacimiento >= "'.$this->inicio.'" and fechaNacimiento <= "'.$this->fin.'"';
		}
		
		 $sql = 'SELECT 
					count(*)
				FROM 
					clientes
				where 1 '.$filtro.'
				ORDER BY nombre DESC';
		$this->Util()->DB()->setQuery($sql);
		$total = $this->Util()->DB()->GetSingle();
		
		// echo $total;
		// exit;
		$resPage = $this->Util->HandlePagesAjax($this->page, $total , '');		
		$sqlLim = "LIMIT ".$resPage['pages']['start'].", ".$resPage['pages']['items_per_page'];
		 
		 $sql = 'SELECT 
				*
				FROM clientes 
				where 1 '.$filtro.'
				ORDER BY nombre DESC
				'.$sqlLim;
				// exit;
		$this->Util()->DB()->setQuery($sql);
		$data['result'] = $this->Util()->DB()->GetResult();
		
		$data['pages'] = $resPage['pages'];
		$data['info'] = $resPage['info'];
					
		return $data;
		
	}//Enumerate		
	
	// public function Enumerate(){
		

		// $sql = 'SELECT * FROM clientes ORDER BY nombre ASC';
		// $this->Util()->DB()->setQuery($sql);
		// $registros = $this->Util()->DB()->GetResult();
							
		// return $registros;
		
	// }//EnumerateAll
	
	public function EnumerateAllChat(){
		
		$sql = 'SELECT * FROM  dependencia
				WHERE 1
				ORDER BY nombre ASC';
		$this->Util()->DB()->setQuery($sql);
		$dep = $this->Util()->DB()->GetResult();
		
		end($dep);
		$key1 = key($dep) + 1;
		$dep[$key1]["dependenciaId"] =  0;
		$dep[$key1]["nombre"] =  "sin Asignar";
		
		
		foreach($dep as $key=>$aux){
			$sql = 'SELECT *, usuarioId AS idReg FROM usuario 
				WHERE usuarioId > 1 and (tipo = "funcionario" or tipo = "admin") and dependenciaId = '.$aux["dependenciaId"].'
				ORDER BY nombre ASC';
			$this->Util()->DB()->setQuery($sql);
			$registros = $this->Util()->DB()->GetResult();
			$dep[$key]["usuarios"] = $registros;
		}
		
			// echo "<pre>"; print_r($dep);
		// exit;	
		return $dep;
		
	}//EnumerateAll
		
	public function EnumerateAll(){
		
		$filtro ="";
		
		
		
		 $sql = 'SELECT COUNT(*)	FROM cliente WHERE statuseliminado = "no" '.$filtro.'';
		
		$this->Util()->DB()->setQuery($sql);
		$total = $this->Util()->DB()->GetSingle();
		
		$resPage = $this->Util->HandlePagesAjax($this->page, $total , '');		
		$sqlLim = "LIMIT ".$resPage['pages']['start'].", ".$resPage['pages']['items_per_page'];
		 
		 $sql = 'SELECT *, clienteId AS idReg FROM cliente 
				WHERE statuseliminado = "no" '.$filtro.'
				ORDER BY nombre ASC
				'.$sqlLim;
				
				// exit;
		$this->Util()->DB()->setQuery($sql);
		$data['result'] = $this->Util()->DB()->GetResult();
		
		// echo "<pre>"; print_r($data);
		
		$data['pages'] = $resPage['pages'];
		$data['info'] = $resPage['info'];
					
		return $data;
		
	}//Enumerate
	
	public function Save(){
						
		if($this->Util()->PrintErrors()){ 
			return false; 
		}
		
		 $sql = 'INSERT INTO cliente (
			nombre, 
			direccion
		)
		VALUES(
			"'.$this->nombre.'",
			"'.$this->direccion.'"
		)';
		// exit;
		$this->Util()->DB()->setQuery($sql);
		$this->id = $this->Util()->DB()->InsertData();
			
		$this->Util()->setError(10112, 'complete', '');
		$this->Util()->PrintErrors();
		
		return true;
		
	}//Save
	
	
	public function Update(){
						
		if($this->Util()->PrintErrors()){ 
			return false; 
		}
		
		$sql = 'UPDATE clientes SET 
				nombre = "'.$this->nombre.'",
				apaterno = "'.$this->apaterno.'",
				amaterno = "'.$this->amaterno.'",
				email = "'.$this->email.'"
				WHERE clienteId = "'.$this->id.'"';
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
			
		$this->Util()->setError(6, 'complete', '');
		$this->Util()->PrintErrors();
		
		return true;
		
	}//Update
	
	public function Delete(){		
		
		$sql = 'UPDATE clientes SET 
				activo = "no"
				WHERE clienteId = "'.$this->id.'"';
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
			
		$this->Util()->setError(4, 'complete', '');
		$this->Util()->PrintErrors();
		
		return true;
		
	}//Delete
	public function Activar(){		
		
		$sql = 'UPDATE clientes SET 
				activo = "si"
				WHERE clienteId = "'.$this->id.'"';
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
			
		$this->Util()->setError(5, 'complete', '');
		$this->Util()->PrintErrors();
		
		return true;
		
	}//Delete
	
	
	
	public function birthReport(){
		
		$util =  new Util;
		
		$mesActual = date('m');  
		$mesProximo = $mesActual+1;  


		$sql = 'SELECT * FROM clientes where MONTH(fechaNacimiento) = "'.$mesActual.'"  group  by fechaNacimiento ORDER BY  fechaNacimiento DESC ';
		$this->Util()->DB()->setQuery($sql);
		$registros = $this->Util()->DB()->GetResult();
		
		$sql = 'SELECT * FROM clientes where MONTH(fechaNacimiento) = "'.$mesProximo.'"  group  by fechaNacimiento ORDER BY  fechaNacimiento DESC';
		$this->Util()->DB()->setQuery($sql);
		$registrosp = $this->Util()->DB()->GetResult();

		foreach($registros as $key=>$aux){
			$r = explode('-',$aux['fechaNacimiento']);
			$mes = $util->GetMonthByKey($r[1]);
			$sql = 'SELECT * FROM clientes where fechaNacimiento = "'.$aux['fechaNacimiento'].'"';
			$this->Util()->DB()->setQuery($sql);
			$regi = $this->Util()->DB()->GetResult();
			$registros[$key]['clientes'] = $regi;
			$registros[$key]['day'] = $r[2].' '.$mes;
		}
		
		foreach($registrosp as $key=>$aux){
			$r = explode('-',$aux['fechaNacimiento']);
			$mes = $util->GetMonthByKey($r[1]);
			$sql = 'SELECT * FROM clientes where fechaNacimiento = "'.$aux['fechaNacimiento'].'"';
			$this->Util()->DB()->setQuery($sql);
			$regi = $this->Util()->DB()->GetResult();
			$registrosp[$key]['clientes'] = $regi;
			$registrosp[$key]['day'] = $r[2].' '.$mes;
		}


		$data['actual'] = $registros;
		$data['proximo'] = $registrosp;

		return $data;
		
	}//birthReport
	
	
	public function sexUbicationReport(){
		
		$filtro ="";
		

		 $sql = 'SELECT
					*,
					(select count(*) from clientes as c where co.coloniaId  = c.coloniaId and sexo = "masculino") as hombres,
					(select count(*) from clientes as c where co.coloniaId  = c.coloniaId and sexo = "femenino") as mujeres,
					(select count(*) from clientes as c where co.coloniaId  = c.coloniaId ) as total
				FROM 
					clientes as c
				left join colonias as co on co.coloniaId = c.coloniaId
				WHERE 1 and  c.coloniaId <> 0 group by c.coloniaId';

		$this->Util()->DB()->setQuery($sql);
		$data = $this->Util()->DB()->GetResult();
 

		return $data;
		
	}//sexUbicationReport
	
	public function ageUbicationReport(){
		
		$filtro ="";
		
		
		$anioActual = date('Y');
		$anio18 = $anioActual - 18;
		$anio24 = $anioActual - 24;
		
		$anio25 = $anioActual - 25;
		$anio59 = $anioActual - 59;
		
		$anio60 = $anioActual - 60;
		
		// echo $anio24;
		// exit;
		

		 $sql = 'SELECT
					*,
					(select count(*) from clientes as c where co.coloniaId  = c.coloniaId and fechaNacimiento = "0000-00-00") as fuera,
					(select count(*) from clientes as c where co.coloniaId  = c.coloniaId and fechaNacimiento <= "'.$anio18.'-12-31" and fechaNacimiento >= "'.$anio24.'-01-01") as rango1,
					(select count(*) from clientes as c where co.coloniaId  = c.coloniaId and fechaNacimiento <= "'.$anio25.'-12-31" and fechaNacimiento >= "'.$anio59.'-01-01") as rango2,
					(select count(*) from clientes as c where co.coloniaId  = c.coloniaId and fechaNacimiento <= "'.$anio60.'-12-31" and fechaNacimiento <> "0000-00-00") as rango3,
					(select count(*) from clientes as c where co.coloniaId  = c.coloniaId ) as total
				FROM 
					clientes as c
				left join colonias as co on co.coloniaId = c.coloniaId
				WHERE 1 and  c.coloniaId <> 0 group by c.coloniaId';
// exit;
		$this->Util()->DB()->setQuery($sql);
		$data = $this->Util()->DB()->GetResult();
 

		// echo '<pre>'; print_r($data );
		// exit;
		return $data;
		
	}//ageUbicationReport
	
	
	public function orderUbicationReport(){
		
		$filtro ="";
		

		 $sql = 'SELECT
					*,
					(select count(*) from ventas as v1 left join clientes as c1 on c1.clienteId = v1.clienteId where v1.coloniaId = v.coloniaId and c1.sexo = "masculino") as hombres,
					(select count(*) from ventas as v1 left join clientes as c1 on c1.clienteId = v1.clienteId where v1.coloniaId = v.coloniaId and c1.sexo = "femenino") as mujeres,
					(select count(*) from ventas as v1 left join clientes as c1 on c1.clienteId = v1.clienteId where v1.coloniaId = v.coloniaId) as total
				FROM 
					ventas as v
				left join colonias as co on co.coloniaId = v.coloniaId
				WHERE 1 and  v.coloniaId <> 0 group by v.coloniaId
				';

		$this->Util()->DB()->setQuery($sql);
		$data = $this->Util()->DB()->GetResult();
 


		return $data;
		
	}//orderUbicationReport
	
	
	public function ubicacionPedidos(){
		
		$filtro ="";
		

		 $sql = 'SELECT
					*
				FROM 
					ventas as v
				left join clientes as c on c.clienteId = v.clienteId
				WHERE 1 
				';

		$this->Util()->DB()->setQuery($sql);
		$data = $this->Util()->DB()->GetResult();
 


		return $data;
		
	}//orderUbicationReport

}

?>