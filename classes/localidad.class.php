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
    public function infoLoc($cveloc, $agem) {
        $sql = 'SELECT * FROM localidad WHERE cve_loc = "' . $cveloc . '" and cve_agem = "' . $agem . '"';
        $this->Util()->DB()->setQuery($sql);
        $info = $this->Util()->DB()->GetRow();
        $data['datos'][] = $info;
        return $data;

    }
    public function EnumerateApi($mgem, $agem)
    {
        $sql = "SELECT * FROM localidad where cve_agee = '" . $mgem . "' and cve_agem = '" . $agem . "' ";
        $this->Util()->DB()->setQuery($sql);
        $results = $this->Util()->DB()->GetResult();
        $data['datos'] = $results;
        return $data;
    }
}
?>
