<?php

class DB
{
	public $query = NULL;
	private $sqlResult = NULL;

	private $conn_id = false;

	private $sqlHost;
	private $sqlDatabase;
	private $sqlUser;
	private $sqlPassword;
	private $dataString;

	public function setSqlHost($value)
	{
		$this->sqlHost = $value;
	}

	public function getSqlHost()
	{
		return $this->sqlHost;
	}

	public function setSqlDatabase($value)
	{
		$this->sqlDatabase = $value;
	}

	public function getSqlDatabase()
	{
		return $this->sqlDatabase;
	}

	public function setSqlUser($value)
	{
		$this->sqlUser = $value;
	}

	public function getSqlUser()
	{
		return $this->sqlUser;
	}

	public function setSqlPassword($value)
	{
		$this->sqlPassword = $value;
	}

	public function getSqlPassword()
	{
		return $this->sqlPassword;
	}

	public function setQuery($value)
	{
		$this->query = $value;
	}

	public function getQuery()
	{
		return $this->query;
	}

	public function setProjectStatus($value)
	{
		$this->projectStatus = $value;
	}
	public function setDataString($value)
	{
		$this->dataString = $value;
	}

	public function getProjectStatus()
	{
		return $this->projectStatus;
	}

	function __construct()
	{
		$this->sqlHost = SQL_HOST;
		$this->sqlDatabase = SQL_DATABASE;
		$this->sqlUser = SQL_USER;
		$this->sqlPassword = SQL_PASSWORD;
	}

 	public function DatabaseConnect(){

    	$this->conn_id = new mysqli($this->sqlHost, $this->sqlUser, $this->sqlPassword) or die(mysqli_error($this->conn_id));
        mysqli_set_charset($this->conn_id,'utf8');
		mysqli_query( $this->conn_id,"SET SESSION sql_mode = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' ");
    	mysqli_select_db($this->conn_id,$this->sqlDatabase) or die("<br/>".mysqli_error($this->conn_id)."<br/>");

  	}

	public function ExecuteQuery(){

		if(!$this->conn_id)
		$this->DatabaseConnect();

		$this->sqlResult = mysqli_query( $this->conn_id,$this->query)  or die (trigger_error(mysqli_error($this->conn_id)));
	}

  	function GetResult(){

  		$retArray = array();
		$this->ExecuteQuery();
	  	while($rs=mysqli_fetch_assoc($this->sqlResult)){
	    	$retArray[] = $rs;
		}
    	$this->CleanQuery();

    	return $retArray;
  	}

  	function GetResultField($field=""){

  		$retArray = array();
		$this->ExecuteQuery();
	  	while($rs=mysqli_fetch_assoc($this->sqlResult)){
	    	if($field!="")
	    	   $retArray[] = $rs[$field];
	    	else
	    		$retArray[] = $rs;
		}
    	$this->CleanQuery();

    	return $retArray;
  	}


  	function GetTotalRows(){

		$this->ExecuteQuery();

		return mysqli_num_rows($this->sqlResult);
  	}

  	function GetRow(){

		$this->ExecuteQuery();
		$rs=mysqli_fetch_assoc($this->sqlResult);
    	$this->CleanQuery();

    return $rs;
  }

 	 function GetSingle(){
		 $this->ExecuteQuery();

			$rs = @mysqli_fetch_array($this->sqlResult);

			if(!$rs) {
				return 0;
			}

			$rs = $rs[0];

			$this->CleanQuery();

			return $rs;
  	}

  	function InsertData(){

		$this->ExecuteQuery();
		$last_id=mysqli_insert_id($this->conn_id);
    	$this->CleanQuery();

    	return $last_id;
  	}

  	function UpdateData(){

		$this->ExecuteQuery();
		$return = mysqli_affected_rows($this->conn_id);
  		$this->CleanQuery();

    	return $return;
  	}

  	function DeleteData(){
		return $this->UpdateData();
	}

  	function CleanQuery(){
    	@mysqli_free_result($this->sqlResult);
  	}

	function EnumSelect( $table , $field ){
		$this->query = "SHOW COLUMNS FROM `$table` LIKE '$field' ";
		$this->ExecuteQuery();

		$row = mysqli_fetch_array( $this->sqlResult , MYSQL_NUM );
		$regex = "/'(.*?)'/";

		preg_match_all( $regex , $row[1], $enum_array );
		$enum_fields = $enum_array[1];

		return( $enum_fields );
	}
	function EscapeString()
	{
		$return = mysqli_real_escape_string($this->dataString);
		return $return;
	}

}

?>
