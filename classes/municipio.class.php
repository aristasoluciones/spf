<?php

class Municipio extends Main
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

    public function Info()
    {
        $sql = 'SELECT * FROM municipio WHERE delegacion_id = "' . $this->id . '"';
        $this->Util()->DB()->setQuery($sql);
        $info = $this->Util()->DB()->GetRow();
        return $info;
    }
    public function infoAgem($agem) {
        $sql = 'SELECT * FROM municipio WHERE cve_agem = "' . $agem . '"';
        $this->Util()->DB()->setQuery($sql);
        $info = $this->Util()->DB()->GetRow();
        $data['datos'][0] = $info;
        return $data;

    }

    public function EnumerateApi($mgem) {
        $ftr = "";
        if($_GET['term']) {
            $ftr .= " and nom_agem like '%".$_GET['term']."%'";
        }
        $sql = "SELECT * FROM municipio where cve_agee = '" . $mgem . "'  $ftr";
        $this->Util()->DB()->setQuery($sql);
        $results = $this->Util()->DB()->GetResult();
        $data['datos'] = $results;
        return $data;
    }
}
?>
