<?php

class Pedido extends Main
{
	private $id;
	private $sucursalId;
    private $folio;



	public function setId($value){
		$this->Util()->ValidateInteger($value);
		$this->id = $value;
	}
	
	public function setSucursalId($value){
		$this->Util()->ValidateInteger($value);
		$this->sucursalId = $value;
	}
    public function setFolio($value){
        $this->folio = $value;
    }
	
	//Ontener datos y listados
	public function Info(){
		$sql = 'SELECT * FROM ventas WHERE ventaId = "'.$this->id.'"';
		$this->Util()->DB()->setQuery($sql);
		$info = $this->Util()->DB()->GetRow();		
		return $info;
	}	

	public function DetallePedido(){

		$sqld = 'SELECT * FROM datosempresa WHERE datoEmpresaId = 1';
		$this->Util()->DB()->setQuery($sqld);
		$datos= $this->Util()->DB()->GetRow();		
		

		$sql = 'SELECT * FROM detalleventas a INNER JOIN productos_categorias b ON a.productoId=b.producto_categoria_id WHERE a.ventaId = "'.$this->id.'"';
		$this->Util()->DB()->setQuery($sql);
		$result = $this->Util()->DB()->GetResult();
		

		 $sql2 = 'SELECT CONCAT_WS(" ",b.nombre,b.apaterno,b.amaterno) as cliente, a.fecha as fecha, a.direccionId,a.folio as folio,a.estatus FROM ventas a INNER JOIN clientes b ON a.clienteId=b.clienteId  WHERE a.ventaId='.$this->id.' ';
	    $this->Util()->DB()->setQuery($sql2);
		$row= $this->Util()->DB()->GetRow();

		$sql3 = 'SELECT * FROM direcciones  WHERE direccionId'.$row["direccionId"];
	    $this->Util()->DB()->setQuery($sql2);
		$row_dir= $this->Util()->DB()->GetRow();

		$data["productos"] = $result;
		$data["cliente"] =  $row;
		$data["direccion"] = $row_dir;
		$data["datosempresa"] = $datos;
      
        return $data;

	}
	public function Enumerate(){
		
		$filtro = "";
		if($this->sucursalId){
			$filtro .= " and sucursalId = ".$this->sucursalId."";
		}
		
		$sql = 'SELECT COUNT(*)	FROM ventas a INNER JOIN clientes b ON a.clienteId=b.clienteId where 1 '.$filtro.'';
		$this->Util()->DB()->setQuery($sql);
		$total = $this->Util()->DB()->GetSingle();
		
		$resPage = $this->Util->HandlePagesAjax($this->page, $total , '');		
		$sqlLim = "LIMIT ".$resPage['pages']['start'].", ".$resPage['pages']['items_per_page'];
		 
		 $sql = 'SELECT 
				a.*,
				CONCAT_WS(" ",b.nombre,b.apaterno,b.amaterno) AS cliente
				FROM  
				ventas a INNER JOIN clientes b ON a.clienteId=b.clienteId where 1 '.$filtro.'
				ORDER BY a.fecha DESC
				'.$sqlLim;
			
		$this->Util()->DB()->setQuery($sql);
		$data['result'] = $this->Util()->DB()->GetResult();
		
		$data['pages'] = $resPage['pages'];
		$data['info'] = $resPage['info'];
					
		return $data;
		
	}//Enumerate
    //FUNCION PARA BUSQUEDA DE PEDIDOS
    public function searchPedidos(){
        $filtro = "";

        if($this->sucursalId != "")
            $filtro .= " AND sucursalId=".$this->sucursalId;

        if($this->folio != "")
            $filtro .= " AND folio='".$this->folio."'";

        $sql = 'SELECT COUNT(*)	FROM ventas a INNER JOIN clientes b ON a.clienteId=b.clienteId where 1 '.$filtro.'';
        $this->Util()->DB()->setQuery($sql);
        $total = $this->Util()->DB()->GetSingle();

        $resPage = $this->Util->HandlePagesAjax($this->page, $total , '');
        $sqlLim = "LIMIT ".$resPage['pages']['start'].", ".$resPage['pages']['items_per_page'];

        $sql = 'SELECT 
				a.*,
				CONCAT_WS(" ",b.nombre,b.apaterno,b.amaterno) AS cliente
				FROM  
				ventas a INNER JOIN clientes b ON a.clienteId=b.clienteId where 1 '.$filtro.'
				ORDER BY a.fecha DESC
				'.$sqlLim;

        $this->Util()->DB()->setQuery($sql);
        $data['result'] = $this->Util()->DB()->GetResult();

        $data['pages'] = $resPage['pages'];
        $data['info'] = $resPage['info'];

        return $data;
    }

	public function Delete(){
		
		$sql = 'UPDATE 
				ventas SET 
				estatus = "cancelado"
				WHERE ventaId = "'.$this->id.'"';
				
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();

		$this->Util()->setError(4, 'complete', 'Se ha cancelado conrrectamente');
		$this->Util()->PrintErrors();
		return true;
		
	}//
	public function Activar(){
		
		$sql = 'UPDATE 
				ventas SET 
				estatus = "captura"
				WHERE ventaId = "'.$this->id.'"';
				
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();

		$this->Util()->setError(4, 'complete', 'Se ha activado conrrectamente');
		$this->Util()->PrintErrors();
		return true;
		
	}//
	public function DeleteCategoria(){
		
		$sql = 'UPDATE 
				categoria SET 
				status = "Baja"
				WHERE categoriaId = "'.$this->id.'"';
				
		$this->Util()->DB()->setQuery($sql);
		$this->Util()->DB()->UpdateData();

		$this->Util()->setError(4, 'complete', '');
		$this->Util()->PrintErrors();
		return true;
		
	}//
    public function getRankinPedidos(){
        $filtro = "";
        if($_POST["finicial"]!="" && $this->Util()->isValidateDate($_POST["finicial"]))
          $filtro .= " AND a.fecha>='".$_POST['finicial']."'";
        if($_POST["ffinal"]!="" && $this->Util()->isValidateDate($_POST["ffinal"]))
            $filtro .= " AND a.fecha<='".$_POST['ffinal']."'";
        $result = array();
        switch($_POST["tipoDetalle"])
        {
            case 'cliente':
                $sql =  "SELECT COUNT(a.ventaId) as pedidosTotal,CONCAT_WS(' ',b.nombre,b.apaterno,b.amaterno) as nameField FROM ventas a LEFT JOIN clientes b ON a.clienteId=b.clienteId WHERE 1 ".$filtro." GROUP BY a.clienteId";
                $this->Util()->DB()->setQuery($sql);
                $result = $this->Util()->DB()->GetResult();
            break;
            case 'hora':
                $sql =  "SELECT COUNT(a.ventaId) as pedidosTotal,a.hora as nameField FROM ventas a LEFT JOIN clientes b ON a.clienteId=b.clienteId WHERE 1 ".$filtro." GROUP BY a.hora";
                $this->Util()->DB()->setQuery($sql);
                $result = $this->Util()->DB()->GetResult();
            break;
            default:
                $sql =  "SELECT COUNT(a.ventaId) as pedidosTotal,CONCAT_WS(' ',b.nombre,b.apaterno,b.amaterno) as nameField FROM ventas a LEFT JOIN clientes b ON a.clienteId=b.clienteId WHERE 1 ".$filtro." GROUP BY a.clienteId";
                $this->Util()->DB()->setQuery($sql);
                $result = $this->Util()->DB()->GetResult();
        }
        return $result;
    }
    public function  searchSalesByArticulo(){
        $filtro  = "";
        $group = "";
        if($_POST["finicial"]!="" && $this->Util()->isValidateDate($_POST["finicial"]))
            $filtro .= " AND d.fecha>='".$_POST['finicial']."'";
        if($_POST["ffinal"]!="" && $this->Util()->isValidateDate($_POST["ffinal"]))
            $filtro .= " AND d.fecha<='".$_POST['ffinal']."'";

        if($_POST['categoria']!="" && $_POST['productoId']==""){
            $filtro .=" AND b.categoria_id =".$_POST['categoria']."";

        }

        if($_POST['productoId']!=""){
            $filtro .=" AND b.producto_categoria_id=".$_POST['productoId']." ";
        }
         $sql =  "SELECT b.nombre as articulo,c.nombre as categoria,sum(a.cantidad) totalVenta FROM detalleventas a INNER JOIN productos_categorias b ON a.productoId = b.producto_categoria_id
                  INNER JOIN categoria c  ON b.categoria_id=c.categoriaId
                  LEFT JOIN ventas d ON a.ventaId=d.ventaId                  
                  WHERE 1 ".$filtro." GROUP BY b.producto_categoria_id ";
         $this->Util()->DB()->setQuery($sql);
         $result = $this->Util()->DB()->GetResult();

         return $result;
    }
	
	
	
	public function  getRankinProducto(){
        $filtro  = "";
        

       
          $sql =  "SELECT * FROM detalleventas as dv
		 left join productos_categorias as pc on producto_categoria_id = dv.productoId 
		 left join categoria as c on c.categoriaId = pc.categoria_id where 1 group by pc.categoria_id
		 ";
         $this->Util()->DB()->setQuery($sql);
         $result = $this->Util()->DB()->GetResult();
		 
		 foreach($result as $key=>$aux){
			 
			    $sql =  "SELECT count(*) FROM detalleventas as dv
			left join productos_categorias as pc on producto_categoria_id = dv.productoId 
			left join categoria as c on c.categoriaId = pc.categoria_id where pc.categoria_id = ".$aux['categoria_id']." ";
			$this->Util()->DB()->setQuery($sql);
			$result8 = $this->Util()->DB()->GetSingle();
			
			 $sql =  "SELECT sum(precio*cantidad) FROM detalleventas as dv
			left join productos_categorias as pc on producto_categoria_id = dv.productoId 
			left join categoria as c on c.categoriaId = pc.categoria_id where pc.categoria_id = ".$aux['categoria_id']." ";
			$this->Util()->DB()->setQuery($sql);
			$sm = $this->Util()->DB()->GetSingle();
			
			$result[$key]['countProductos'] =  $result8;
			$result[$key]['suma'] =  $sm;
		 }
		
		 // echo '<pre>'; print_r($result);
		 // exit;

         return $result;
    }
						
}

// ?>