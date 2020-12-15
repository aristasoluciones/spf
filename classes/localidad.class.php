<?php

class Localidad extends Main
{
    private $id;
    private $nombre;

    public function setId($value)
    {
        $this->Util()->ValidateInteger($value);
        $this->id = $value;
    }

    public function setNombre($value)
    {
        if ($this->Util()->ValidateRequireField($value, 'Nombre')) {
            $this->Util()->ValidateString($value, 100, 0, '');
            $this->nombre = $value;
        }
    }
    public function EnumerateApi($mgem)
    {
        $sql = "SELECT * FROM localidades where cve_agee = '" . $mgem . "' ";
        $this->Util()->DB()->setQuery($sql);
        $results = $this->Util()->DB()->GetResult();
        $data['datos'] = $results;
        return $data;
    }
}
?>
