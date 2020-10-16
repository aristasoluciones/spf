<?php

class CustomError
{
	private $type = array();
	private $errorField = array();
	private $error = array();
	private $complete = false;

	public function Util() 
	{
		if($this->Util == null ) 
		{
			$this->Util = new Util();
		}
		return $this->Util;
	}
	
	public function setError($value = NULL, $type="error", $custom = "", $errorField = "")
	{
		$this->type[] = $type;
		$this->setErrorField($errorField);
		$this->setErrorValue($value, $custom);
		
		if($type == "complete")
		{
			$this->complete = true;
		}
				
	}

	function setErrorValue($value, $custom)
	{
		if($custom != ""){
			$this->error[] = $custom;
		}else{
			$this->error[] = $value;
		}
		
	}
		
	function setErrorField($value)
	{
		if($value != "")
		{
			$this->errorField[] = $value;
		}
		else
		{
			$this->errorField[] = NULL;
		}
	}
	
	public function getErrors()
	{
		global $property;
						
		foreach($this->error as $key => $val)
		{
			if(is_numeric($val))
			{
					$this->error[$key] = $property["error"][$val];
			}
		}						
		
		$errors = array("value" => $this->error, "field" => $this->errorField, "type" => $this->type);
		
		$errors["total"] = count($errors["value"]);
		$errors["complete"] = $this->complete;
		
		return $errors;
	}

	public function cleanErrors()
	{
		$this->error = array();
		$this->errorField = array();
		$this->type = array();
		$this->complete = false;
	}
	
	public function PrintErrors()
	{
		$errors = $this->getErrors();

		if($errors["total"])
		{
			$GLOBALS["smarty"]->assign('errors', $errors);
			$_SESSION["errors"] = $errors;
			$this->cleanErrors();
			return true;
		}
		return false;

	}
	
	public function PrintErrors2()
	{
		if($_SESSION['errors']["complete"]>=1)
		{
		$errors = $_SESSION["errors"];	
		$GLOBALS["smarty"]->assign('errors', $errors);
		$_SESSION['errors'] = array();
		}
		return true;
	}
	
	public function ShowErrors(){
		
		foreach($_SESSION['errors']['value'] as $k => $error){
			$field = $_SESSION['errors']['field'][$k];						
			$error = ($field == '') ? $error : $error.' :: '.$field;							
			echo $error;
			break;
		}		
		
	}
	
	public function GetError(){
		
		foreach($_SESSION['errors']['value'] as $k => $error){
			$field = $_SESSION['errors']['field'][$k];
			
			$card['texto'] = ($field == '') ? $error : $error.' :: '.$field;
			$card['tipo'] = $_SESSION['errors']['type'][$k];			
			
			return $card;
		}
		
	}
	
}
?>