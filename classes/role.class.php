<?php

class Role extends Main
{
    private $admin;
    protected $permissions;
    private $name;
    private $id;
    private $roleId;

    function setAdmin($value){
        $this->admin=$value;
    }
    public function isAdmin(){
        return $this->admin;
    }
    public function setRoleId($value)
    {
        $this->Util()->ValidateInteger($value);
        $this->roleId = $value;
    }

    public function setId($value)
    {
        $this->Util()->ValidateInteger($value);
        $this->id = $value;
    }

    public function setName($value)
    {
        if ($this->Util()->ValidateRequireField($value, 'Nombre')) {
            $this->Util()->ValidateString($value, 100, 0, '');
            $this->name = $value;
        }
    }

    public function Info()
    {
        $sql = 'SELECT * FROM roles WHERE rolId = "' . $this->roleId . '"';
        $this->Util()->DB()->setQuery($sql);
        $info = $this->Util()->DB()->GetRow();
        return $info;
    }

    // Crea un objeto role que esta asociado con permisos
    public function Save()
    {
        $sql = "SELECT * FROM  roles WHERE LOWER(name)='".strtolower($this->name)."'  and status = 'activo' ";
        $this->Util()->DB()->setQuery($sql);
        $res = $this->Util()->DB()->GetResult();
        if(!empty($res))
            $this->Util()->setError(0,'error',"Ya existe un registro con el nombre proporcionado");

        if ($this->Util()->PrintErrors()) {
            return false;
        }
        $sql = "INSERT INTO
                roles(
                        `name`
                     )VALUES (
                        '" . $this->name . "'
                     );
		        ";
        $this->Util()->DB()->setQuery($sql);
        $this->Util()->DB()->InsertData();

        $this->Util()->setError(10129, 'complete');
        $this->Util()->PrintErrors();
        return true;
    }//Save
    function Update(){
        $sql = "SELECT * FROM  roles WHERE LOWER(name)='".strtolower($this->name)."' AND rolId!='".$this->roleId."' and status ='activo' ";
        $this->Util()->DB()->setQuery($sql);
        $res = $this->Util()->DB()->GetResult();
        if(!empty($res))
            $this->Util()->setError(0,'error',"Ya existe un registro con el nombre proporcionado");


        if($this->Util()->PrintErrors())
            return false;

        $sql = "UPDATE roles SET name='".$this->name."' WHERE rolId='".$this->roleId."' ";
        $this->Util()->DB()->setQuery($sql);
        $this->Util()->DB()->UpdateData();

        $this->Util()->setError(0,"complete",'Se ha actualizado el registro correctamente');
        $this->Util()->PrintErrors();
        return true;
    }

    public function getListRoles()
    {
        $sql = "SELECT * FROM roles where status ='activo' ORDER BY name DESC";
        $this->Util()->DB()->setQuery($sql);
        $data = $this->Util()->DB()->GetResult();
        return $data;
    }//Enumerate
    function getConfigRol(){
        //find permisos by rol
        $sql =  "SELECT permisoId from rolesPermisos where rolId='".$this->roleId."'";
        $this->Util()->DB()->setQuery($sql);
        $array_perm = $this->Util()->DB()->GetResult();
        $owns_lineal =$this->Util()->ConvertToLineal($array_perm,'permisoId');

        $sql =  "SELECT * from permisos ";
        $this->Util()->DB()->setQuery($sql);
        $lst2 = $this->Util()->DB()->GetResult();

        $res = $this->FindDeep($lst2);
        $new = array();
        $card=array();
        foreach($res as $ky=>$val){
            $deep = array();
            $card = $val;
            $countLevel = 0;
            if(in_array($val['permisoId'],$owns_lineal))
                $card['letMe']=true;
            else
                $card['letMe']=false;

            if(!empty($val['children']))
            {
                $deep = $this->CountChild($val['children'],$countLevel,$owns_lineal);
            }
            $card['children']=$deep;
            $new[]=$card;
        }
        return $new;
    }
    function CountChild(array $temps,$count,$owns){
        $tree =array();
        $cad=array();
        foreach($temps as $kt=>$temp){
            $deep = array();
            $cad = $temp;
            if(in_array($temp['permisoId'],$owns))
                $cad['letMe']=true;
            else
                $cad['letMe']=false;

            if(!empty($temp['children']))
            {
                $count++;
                $deep =  $this->CountChild($temp['children'],$count,$owns);
            }

            $cad['children'] =  $deep;
            $tree[]=$cad;
        }
        return $tree;
    }
    function FindDeep(array $elements,$parentId=0){
        $branch=array();
        foreach($elements as $element){
            if ($element['parentId'] == $parentId) {
                $children = $this->FindDeep($elements, $element['permisoId']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }
    function saveConfigRol(){
        $this->Util()->DB()->setQuery('SELECT permisoId from rolesPermisos WHERE rolId="'.$this->roleId.'" ');
        $arrayPerm = $this->Util()->DB()->GetResult();
        $permActual = $this->Util()->ConvertToLineal($arrayPerm,'permisoId');
        $sql2 = 'REPLACE INTO rolesPermisos(rolId,permisoId,date) VALUES';
        if(!empty($_POST['permisos']))
        {
            foreach($_POST['permisos'] as $perm)
            {
                if($perm===end($_POST['permisos']))
                    $sql2 .="(".$this->roleId.",".$perm.",'".date('Y-m-d')."');";
                else
                    $sql2 .="(".$this->roleId.",".$perm.",'".date('Y-m-d')."'),";
                $key = array_search($perm,$permActual);
                unset($permActual[$key]);
            }
            $this->Util()->DB()->setQuery($sql2);
            $this->Util()->DB()->UpdateData();
        }
        if(!empty($permActual)){
            $sqlu = "DELETE FROM rolesPermisos WHERE permisoId IN(".implode(",",$permActual).") AND rolId='".$this->roleId."' ";
            $this->Util()->DB()->setQuery($sqlu);
            $this->Util()->DB()->DeleteData();
        }

        $this->Util()->setError(10049, "complete",'Se han guardado los cambios correctamente');
        $this->Util()->PrintErrors();
        return true;
    }
    public function Enumerate()
    {
        $sql = 'SELECT 
				*
				FROM roles  where rolId>1 AND status="activo"
				ORDER BY name DESC
				';
        $this->Util()->DB()->setQuery($sql);
        $data = $this->Util()->DB()->GetResult();
        return $data;

    }//Enumerate
    function GetPermisosByRol(){
        if($this->isAdmin())
            $sql =  "SELECT permisoId from rolesPermisos where 1";
        else
            $sql =  "SELECT permisoId from rolesPermisos where rolId='".$this->roleId."' ";
        $this->Util()->DB()->setQuery($sql);
        $array_perm = $this->Util()->DB()->GetResult();
        $owns_lineal =$this->Util()->ConvertToLineal($array_perm,'permisoId');
        return $owns_lineal;
    }
    public function configurarRoles()
    {
        $sql = "SELECT * from permisos where parentId = 0";
        $this->Util()->DB()->setQuery($sql);
        $lst = $this->Util()->DB()->GetResult();


        $this->setRoleId($this->id);
        $lisPermisos = $this->permisoSegunRol();


        foreach ($lst as $key => $aux) {

            if (in_array($aux["ID"], $lisPermisos)) {
                $lst[$key]["check"] = "si";
            }

            $sql = "SELECT * from permissions where permisoId = " . $aux["ID"] . "";
            $this->Util()->DB()->setQuery($sql);
            $lstSecc = $this->Util()->DB()->GetResult();

            foreach ($lstSecc as $key2 => $aux2) {

                if (in_array($aux2["ID"], $lisPermisos)) {
                    $lstSecc[$key2]["check"] = "si";
                }


                $sql2 = "SELECT * from permissions where permisoId = " . $aux2["ID"] . "";
                $this->Util()->DB()->setQuery($sql2);
                $lstAccion = $this->Util()->DB()->GetResult();
                $lstSecc[$key2]["acciones"] = $lstAccion;
            }

            $lst[$key]["secciones"] = $lstSecc;


        }

        return $lst;
    }
    public function asignarRoles()
    {

        if ($this->Util()->PrintErrors()) {
            return false;
        }

        $sql = 'DELETE  FROM rolepermissions where RoleID = "' . $this->id . '"';


        $this->Util()->DB()->setQuery($sql);
        $this->Util()->DB()->DeleteData();

        foreach ($_POST["permisos_assign"] as $key => $aux) {
            $sql = "
			INSERT INTO  rolepermissions(
					RoleID,
					PermissionID 
					)
					VALUES (
					'" . $this->id . "',
					'" . $aux . "'
					);
			";
            $this->Util()->DB()->setQuery($sql);
            $this->Util()->DB()->InsertData();
        }


        $this->Util()->setError(10129, 'complete', '');
        $this->Util()->PrintErrors();
        return true;
    }//Save

    public function Delete()
    {

        if ($this->Util()->PrintErrors()) {
            return false;
        }
        $sql = 'UPDATE roles SET status="baja"  WHERE rolId = "' . $this->roleId . '"';
        $this->Util()->DB()->setQuery($sql);
        $this->Util()->DB()->UpdateData();
        $this->Util()->setError(10129, 'complete', 'El rol se elimino correctamente');
        $this->Util()->PrintErrors();
        return true;
    }//Save


}

?>
