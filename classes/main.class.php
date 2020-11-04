<?php

class Main
{
	protected $page;


	public function setPage($value)
	{
		$this->Util()->ValidateInteger($value, 9999999999, 0);
		$this->page = $value;
	}

	public function getPage()
	{
		return $this->page;
	}

	public function Util()
	{
		if($this->Util == null )
		{
			$this->Util = new Util();
		}
		return $this->Util;
	}
    function LocalLanguage(){
        $this->Util()->DB()->setQuery('select * from local_language order by name ASC');
        return $this->Util()->DB()->GetResult();
    }
}


?>
