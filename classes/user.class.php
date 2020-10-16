<?php

class User extends Main
{
	private $usuarioId = 0;
	private $username;
	private $email;
	private $password;	
	
	public function setUsuarioId($value){
		$this->Util()->ValidateInteger($value);
		$this->usuarioId = $value;
	}
		
	public function setEmail($value, $validate = false){	
		if($this->Util()->ValidateRequireField($value, 'Correo Electr&oacute;nico')){
			if($validate)
				$this->Util()->ValidateMail($value);			
			$this->Util()->ValidateString($value, 100, 1, '');
			$this->email = $value;			
		}		
	}
	
	public function setUsername($value){	
		if($this->Util()->ValidateRequireField($value, 'Usuario')){
			$this->Util()->ValidateString($value, 100, 1, '');
			$this->username = $value;
		}		
	}
		
	public function setPasswd($value){	
		if($this->Util()->ValidateRequireField($value, 'Contrase&ntilde;a')){
			$this->Util()->ValidateString($value, 100, 1, 'Password');
			$this->password = $value;
		}		
	}	
		
	public function Info(){
		
		$this->Util()->DB()->setQuery('SELECT * FROM personal WHERE personalId = "'.$this->usuarioId.'"');
		$user = $this->Util()->DB()->GetRow();
		
		$user['version'] = 'v3';
		
		return $user;
	}
		
		
	public function AllowAccess($page = ''){
        $User = $_SESSION['Usr'];

        if(!$User['isLogged']){
            header('Location: '.WEB_ROOT.'/login');
            exit;
        }
        if($page != '' && !$User['rolId'] && $User['rolId']!=1){
            if(!$this->allow_access_module($page)){
                header('Location: '.WEB_ROOT);
                exit;
            }
        }
				
	}//AllowAccess
	public function allow_access_module($page){
		global $objRole;
        $objRole->setRoleId($_SESSION['Usr']["rolId"]);
        $allowPages = $objRole->GetPermisosByRol();
        if(in_array($page,$allowPages))
            return true;
        else
            return false;
	}//AllowAccessModule
	
	public function DoLoginCheck(){
						
		if($this->Util()->PrintErrors()){ 
			return false; 
		}
		
		return true;
	}
	
	public function DoLogin(){
						
		if($this->Util()->PrintErrors()){ 
			return false; 
		}
		 
		$sql = 'SELECT 
				* 
			 FROM 
				usuario 
			WHERE 
				usuario = "'.$this->username.'"
			AND 
				passwd = "'.md5($this->password).'"';
	
		$this->Util()->DB()->setQuery($sql);
		$row = $this->Util()->DB()->GetRow();
			
		if($row){
			$card['usuarioId'] = $row['usuarioId'];	
			$card['rolId'] = $row['role_id'];
            $card['sucursalId'] = $row['sucursalId'];
	        $card['usuario'] = $row['usuario'];
            $card['email'] = $row['email'];
			$card['isLogged'] = true;;
			$_SESSION['Usr'] = $card;
			return true;
		}else{					
			
			$this->Util()->setError(10006, 'error', '');
			$this->Util()->PrintErrors();
		}//else
		return false;
	}//DoLogin
	
	public function DoLogout(){		
				
		$_SESSION['User'] = '';
		unset($_SESSION['User']);
		session_destroy();		
		
	}//DoLogout
					
}//User

?>