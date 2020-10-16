<?php

class Usuario extends Main
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
	private $rol_actual;
	private $sucursalId;
	private $fnacimento;
	
	
	public function setSucursalId($value){
		if($this->Util()->ValidateRequireField($value, 'Sucursal')){
			$this->Util()->ValidateInteger($value);
			$this->sucursalId = $value;
		}
	}
    public function setFechaNacimiento($value){
        if($this->Util()->ValidateRequireField($value, 'Fecha nacimiento')) {
            if($this->Util()->validateDateFormat($value,'Fecha nacimiento'))
             $this->fnacimento = $value;
        }
    }
	public function setId($value){
		$this->Util()->ValidateInteger($value);
		$this->id = $value;
	}
	public function setApaterno($value){	
		if($this->Util()->ValidateRequireField($value, 'Apellido Paterno')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->apaterno = $value;
		}		
	}
	
	public function setAmaterno($value){	
		if($this->Util()->ValidateRequireField($value, 'Apellido Materno')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->amaterno = $value;
		}		
	}
	
	public function setCalle($value){	
		if($this->Util()->ValidateRequireField($value, 'Calle')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->calle = $value;
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
	public function setRolActual($value){	
		if($this->Util()->ValidateRequireField($value, '_campoInterno _rolActual')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->rol_actual = $value;
		}		
	}
	
	public function setPasswd($value,$vali){
		
		if($vali=="si"){
			if($this->Util()->ValidateRequireField($value, 'Contrase&ntilde;a')){
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->passwd = $value;
		}		
		}else{
			$this->Util()->ValidateString($value, 100, 0, '');
			$this->passwd = $value;
		}
			
		
	}
	
	public function setTipo($value){
	if($this->Util()->ValidateRequireField($value, 'Tipo / Rol')){
			$this->tipo = $value;
		}	
	}
	
	public function setActivo($value){	
		$this->Util()->ValidateString($value, 100, 0, '');
		$this->activo = $value;
	}
		
	public function Info(){
		
		$sql = 'SELECT * FROM usuario WHERE usuarioId = "'.$this->id.'"';
		$this->Util()->DB()->setQuery($sql);
		$info = $this->Util()->DB()->GetRow();
		$info["passwd"] = "";			
		return $info;
	}//Info
	
	public function EnumerateAll(){
		
		$sql = 'SELECT * FROM usuario WHERE activo="1" ORDER BY nombre ASC';
		$this->Util()->DB()->setQuery($sql);
		$registros = $this->Util()->DB()->GetResult();
							
		return $registros;
		
	}//EnumerateAll
	
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
		
	public function Enumerate(){
		
		$filtro ="";
		
		if($this->tiporeporte=="admin"){
			$filtro .= " and (tipo = 'admin' or tipo = 'funcionario') ";
		}else{
			$filtro .= " and tipo = 'ciudadano'";
		}
		
		$sql = 'SELECT COUNT(*)	FROM usuario WHERE usuarioId > 1 '.$filtro.'';
		$this->Util()->DB()->setQuery($sql);
		$total = $this->Util()->DB()->GetSingle();
		
		$resPage = $this->Util->HandlePagesAjax($this->page, $total , '');		
		$sqlLim = "LIMIT ".$resPage['pages']['start'].", ".$resPage['pages']['items_per_page'];
		 
		$sql = 'SELECT *, usuarioId AS idReg FROM usuario 
				WHERE usuarioId > 1 '.$filtro.'
				ORDER BY nombre ASC
				'.$sqlLim;
		$this->Util()->DB()->setQuery($sql);
		$data['result'] = $this->Util()->DB()->GetResult();
		
		// echo "<pre>"; print_r($data);
		
		$data['pages'] = $resPage['pages'];
		$data['info'] = $resPage['info'];
					
		return $data;
		
	}//Enumerate
	
	public function Save(){
						
	 $sql = 'SELECT COUNT(*) FROM usuario WHERE usuario = "'.$this->usuario.'"';
	$this->Util()->DB()->setQuery($sql);
	$countUser =  $this->Util()->DB()->GetSingle();		

	$sql = 'SELECT COUNT(*) FROM usuario WHERE email = "'.$this->email.'"';
	$this->Util()->DB()->setQuery($sql);
	$countMail =  $this->Util()->DB()->GetSingle();		
	
	if($countUser >= 1){
		$this->Util()->setError(10134, '', '');
	}
	if($countMail >= 1){
		$this->Util()->setError(10135, '', '');
	}
					
	if($this->Util()->PrintErrors()){ 
			return false; 
	}
		
	$sql = 'INSERT INTO usuario (
			nombre, 
			apaterno, 
			amaterno, 
			calle, 
			noExterior, 
			colonia, 
			ciudad, 
			estado, 
			pais, 
			telefono, 
			email,
			fechaNacimiento, 
			usuario, 
			passwd, 
			role_id, 
			activo,
			sucursalId
		)
		VALUES(
			"'.$this->nombre.'",
			"'.$this->apaterno.'",
			"'.$this->amaterno.'",
			"'.$this->calle.'",
			"'.$this->noExterior.'",
			"'.$this->colonia.'",
			"'.$this->ciudad.'",
			"'.$this->estado.'",
			"'.$this->pais.'",
			"'.$this->telefono.'",
			"'.$this->email.'",
			"'.$this->fnacimento.'", 
			"'.$this->usuario.'",
			"'.md5($this->passwd).'",
			'.$this->tipo.',
			"'.$this->activo.'",
			"'.$this->sucursalId.'"
		)';
		// exit;
		$this->Util()->DB()->setQuery($sql);
		$id_insert = $this->Util()->DB()->InsertData();
		
		$this->Util()->setError(10112, 'complete', '');
		$this->Util()->PrintErrors();
		
		return true;
		
	}//Save
	
	
	public function Update(){
     /*echo $this->rol_actual;
     exit;*/
	  $sql = 'SELECT COUNT(*) FROM usuario WHERE usuario = "'.$this->usuario.'" and usuarioId != "'.$this->id.'"';
	$this->Util()->DB()->setQuery($sql);
	$countUser =  $this->Util()->DB()->GetSingle();		

	$sql = 'SELECT COUNT(*) FROM usuario WHERE email = "'.$this->email.'" and usuarioId != "'.$this->id.'"';
	$this->Util()->DB()->setQuery($sql);
	$countMail =  $this->Util()->DB()->GetSingle();		
	
	if($countUser >= 1){
		$this->Util()->setError(10134, '', '');
	}
	if($countMail >= 1){
		$this->Util()->setError(10135, '', '');
	}
	
	if($this->Util()->PrintErrors()){ 
	  return false; 
	}
		
		
	if($this->passwd){
		 $sql = 'UPDATE usuario SET 
				apaterno = "'.($this->apaterno).'",
				amaterno = "'.($this->amaterno).'",
				calle = "'.($this->calle).'",
				noExterior = "'.($this->noexterior).'",
				colonia = "'.($this->colonia).'",
				ciudad = "'.($this->ciudad).'",
				estado = "'.($this->estado).'",
				pais = "'.($this->pais).'",
				nombre = "'.($this->nombre).'", 
				telefono = "'.$this->telefono.'",
				email = "'.($this->email).'",
				fechaNacimiento = "'.($this->fnacimento).'", 
				usuario = "'.($this->usuario).'",
				passwd = "'.md5($this->passwd).'", 
				role_id= '.$this->tipo.', 
				activo = "'.$this->activo.'",
				sucursalId = "'.$this->sucursalId.'"
				
				WHERE usuarioId = "'.$this->id.'"';
	}else{
		 $sql = 'UPDATE usuario SET 
				apaterno = "'.($this->apaterno).'",
				amaterno = "'.($this->amaterno).'",
				calle = "'.($this->calle).'",
				noExterior = "'.($this->noexterior).'",
				colonia = "'.($this->colonia).'",
				ciudad = "'.($this->ciudad).'",
				estado = "'.($this->estado).'",
				pais = "'.($this->pais).'",
				nombre = "'.($this->nombre).'", 
				telefono = "'.$this->telefono.'",
				email = "'.($this->email).'", 
				fechaNacimiento = "'.($this->fnacimento).'",
				usuario = "'.($this->usuario).'",
				role_id= '.$this->tipo.', 
				activo = "'.$this->activo.'",
				sucursalId = "'.$this->sucursalId.'"
				WHERE usuarioId = "'.$this->id.'"';
	}	
	
		$this->Util()->DB()->setQuery($sql);
		$id_update = $this->Util()->DB()->UpdateData();
		$this->Util()->setError(10113, 'complete', 'El registro se actualizo correctamente ');
		$this->Util()->PrintErrors();
		return true;
		
	}//Update
	
	public function Delete(){
		
		$sql = 'UPDATE usuario SET activo="0" WHERE usuarioId = "'.$this->id.'"';
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();
		
		$this->Util()->setError(10114, 'complete', 'El usuario se elimino correctamente');
		$this->Util()->PrintErrors();
		
		return true;
		
	}//Delete
						
}

?>