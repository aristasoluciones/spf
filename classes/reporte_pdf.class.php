<?php 
class ReportePdf extends Main{

	private $pdf;

	private function CabeceraDocumento(){
	
		#fin de cabecera	
		$this->pdf->Image(DOC_ROOT.'/images/logo_pdf.jpg',5,8,30);
		$this->pdf->SetFont('Arial','B',15);
//		$pdf->SetTextColor(3,3,3); //Letra color blanco
		$this->pdf->Cell(30);
		$x = $this->pdf->Getx();
		$this->pdf->Cell(70,15,'CEVA SALUD ANIMAL',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(100,15,'Fecha: '. $this->Util()->ChangeDateFormat(date('Y-m-d')),0,0,'R');
		$this->pdf->Ln();
		//ancho 205
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(35);
		$this->pdf->CellFitSpace(20,5, ("Rancho:"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(150,5, (" ".$info['infoEstablo']['nombre']),0, 0 , 'L',false);
		$this->pdf->Ln();
	}
	public function ReporteCosto( $info ){
	
		$this->pdf = new FPDF('P', 'mm','Letter');
		$this->pdf->AddPage();
		$this->pdf->SetMargins(5, 8 , 5); #Establecemos los márgenes izquierda, arriba y derecha: 
		$this->pdf->SetAutoPageBreak(false,5); #Establecemos el margen inferior: 
	
		
		$this->CabeceraDocumento();

		$this->pdf->SetFont('Arial','B',15);
		$this->pdf->CellFitSpace(205,5, ("COSTO POR PROTOCOLO"),0, 0 , 'C',false);
		$this->pdf->Ln();
	
		
		$x = 5; $y = 40; $texX=100; $texY=4;
		
/*"LTRB"*/
		
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetLineWidth(.1); // ancho de linea 
		$this->pdf->SetFillColor(75,141,248);

		$bandera = false;
		
		#costo por protocolo
		 
		$this->pdf->GenerarColumna(array('Protocolo','Vaca','Administrado'),27,5,$x,$y);
		$x = $this->pdf->Getx();
		$this->pdf->GenerarColumna(array('Productos'),70,5,$x,$y);
		$x = $this->pdf->Getx();
		$this->pdf->GenerarColumna(array('C. x Protocolo', 'C. Total'),27,5,$x,$y);


		$y = $this->pdf->GetY() + 5;
	
		#cuarpo de la tabla
		$this->pdf->Ln();
		$this->pdf->SetFont('Arial','',7);
        $this->pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
		$this->pdf->SetWidths(array(27,27,27,70,27,27));
		
		$result = $info['listaTratamiento'];
		
		if(!is_array($result)){ $result = array(); }
		foreach($result as $key => $row){
			$cad_producto = null;
			
			if(!is_array($row['productos'])){ $row['productos'] = array(); }
			foreach($row['productos'] as $key2 => $producto){
				$cad_producto .= " ".($key2 + 1).') '.$producto['nombre'].' - '.$producto['cantidad'].' ml - '.$producto['vAdministracion']."
				";
			
			}
			
			$x = $this->pdf->GetX();
			$y = $this->pdf->GetY();
			$this->pdf->SetXY($x,$y);
			$this->pdf->Row(
				array(
					' '.$row['numTratamiento'],
					' '.$row['totalIncidencia'],
					' '.$row['totalAdministradoProtocolo'],
					$cad_producto,
					' $'.number_format($row['costo'],2),
					' $'.number_format($row['costoTotalProtocolo'],2)
				),
				"C",$bandera
			);
			
			            $bandera = !$bandera;//Alterna
		//}
		
		}
		

$this->pdf->AddPage();

	$this->CabeceraDocumento();

		$this->pdf->SetFont('Arial','B',15);
		$this->pdf->CellFitSpace(205,5, ("COSTO DE DESCARTE"),0, 0 , 'C',false);
		$this->pdf->Ln();
	
		
		$x = 5; $y = 40; $texX=100; $texY=4;
		
/*"LTRB"*/
		
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetLineWidth(.1); // ancho de linea 
		$this->pdf->SetFillColor(75,141,248);

		$bandera = false;
		
		#costo por protocolo
		 
		$this->pdf->GenerarColumna(array('Protocolo','Vaca','Dias Descarte','Litros de descarte','Costo de descarte'),41,5,$x,$y);

		$y = $this->pdf->GetY() + 5;
	
		#cuarpo de la tabla
		$this->pdf->Ln();
		$this->pdf->SetFont('Arial','',7);
        $this->pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
		$this->pdf->SetWidths(array(41,41,41,41,41));
		
		$result = $info['listaTratamiento'];
		
		if(!is_array($result)){ $result = array(); }
		foreach($result as $key => $row){

			$x = $this->pdf->GetX();
			$y = $this->pdf->GetY();
			$this->pdf->SetXY($x,$y);
			$this->pdf->Row(
				array(
					' '.$row['numTratamiento'],
					' '.$row['totalIncidencia'],
					' '.$row['totalAdministradoDescarte'],
					' '.$row['litroDescarte'],
					' $'.number_format($row['costoDescarte'],2)
				),
				"C",$bandera
			);
			
			            $bandera = !$bandera;//Alterna
		
		}
		

		
		
$this->pdf->AddPage();

	$this->CabeceraDocumento();

		$this->pdf->SetFont('Arial','B',15);
		$this->pdf->CellFitSpace(205,5, ("COSTO TOTAL POR MASTITIS"),0, 0 , 'C',false);
		$this->pdf->Ln();
	
		
		$x = 5; $y = 40; $texX=100; $texY=4;
		
/*"LTRB"*/
		
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetLineWidth(.1); // ancho de linea 
		$this->pdf->SetFillColor(75,141,248);

		$bandera = false;
		
		#costo por protocolo
		 
		$this->pdf->GenerarColumna(array('Protocolo','Costo Tratamiento','Costo Descarte','Costo Total'),51.25,5,$x,$y);

		$y = $this->pdf->GetY() + 5;
	
		#cuarpo de la tabla
		$this->pdf->Ln();
		$this->pdf->SetFont('Arial','',7);
        $this->pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
		$this->pdf->SetWidths(array(51.25,51.25,51.25,51.25));
		
		$result = $info['listaTratamiento'];
		
		if(!is_array($result)){ $result = array(); }
		foreach($result as $key => $row){

			$x = $this->pdf->GetX();
			$y = $this->pdf->GetY();
			$this->pdf->SetXY($x,$y);
			$this->pdf->Row(
				array(
					' '.$row['numTratamiento'],
					' $'.number_format($row['costoTotalProtocolo'],2),
					' $'.number_format($row['costoDescarte'],2),
					' $'.number_format($row['costoTotalMastis'],2)
				),
				"C",$bandera
			);
			
			            $bandera = !$bandera;//Alterna
		
		}



		
				
		$this->pdf->Output();
		

 		if($correo){ //para enviar por correo
			$root = DOC_ROOT."/cron";
			if(!is_dir($root))
			{
				mkdir($root, 0777);
			}
			$pdf->Output($root."/reporte_general_saldo_".date('Y-m-d').".pdf", "F");
		}else{ //descarga el pdf de generar pdf
			// exit;
			$pdf->Output();
	 	}

	
	}
	
	public function ReporteReincidencia( $info ){
	
		$this->pdf = new FPDF('P', 'mm','Letter');
		$this->pdf->AddPage();
		$this->pdf->SetMargins(5, 8 , 5); #Establecemos los márgenes izquierda, arriba y derecha: 
		$this->pdf->SetAutoPageBreak(false,5); #Establecemos el margen inferior: 
	
		
		$this->CabeceraDocumento();

		$this->pdf->SetFont('Arial','B',15);
		$this->pdf->CellFitSpace(205,5, ("REPORTE DE REINCIDENCIA"),0, 0 , 'C',false);
		$this->pdf->Ln();
	
		
		$x = 5; $y = 40; $texX=100; $texY=4;
		
/*"LTRB"*/
	//	print_r($info);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetLineWidth(.1); // ancho de linea 
		$this->pdf->SetFillColor(75,141,248);

		$bandera = false;
		
		#costo por protocolo
		 
		$this->pdf->GenerarColumna(array('Vaca','Reincidencia','Registro','Alta','Protocolo','Evento Ant','Costo','C. Total'),25.625,5,$x,$y);
		// $x = $this->pdf->Getx();
		// $this->pdf->GenerarColumna(array('Productos'),70,5,$x,$y);
		// $x = $this->pdf->Getx();
		// $this->pdf->GenerarColumna(array('C. x Protocolo', 'C. Total'),27,5,$x,$y);


		$y = $this->pdf->GetY() + 5;
	
		#cuarpo de la tabla
		$this->pdf->Ln();
		$this->pdf->SetFont('Arial','',7);
        $this->pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
		$this->pdf->SetWidths(array(25.625,25.625,25.625,25.625,25.625,25.625,25.625,25.625));
		
		// echo '<PRE>';
		// print_r($info);
		$result = $info['new_array'];
		
		if(!is_array($result)){ $result = array(); }
		foreach($result as $key => $row){
			 $cad_reincidencia = null;
			 $cad_alta = null;
			 $cad_nombreTratamiento = null;
			 $cad_costo = null;
			
			if(!is_array($row['infoIncidencia'])){ $row['infoIncidencia'] = array(); }
			foreach($row['infoIncidencia'] as $key2 => $row2){
				$cad_reincidencia .= $row2['fechaIngreso']."
				";
				$array_explode = explode(' ',$row2['fechaAlta']); 
				$cad_alta .= $array_explode[0]."
				";
				
				$cad_nombreTratamiento .= $row2['nombreTratamiento']."
				"; 
				
				$cad_costo .= '$ '.number_format($row2['costo'],2)."
				"; 
			
			}
			
			$x = $this->pdf->GetX();
			$y = $this->pdf->GetY();
			$this->pdf->SetXY($x,$y);
			$this->pdf->Row(
				array(
					' '.$row['numVaca'],
					' '.$row['totalReincidencia'],
					$cad_reincidencia,
					$cad_alta,
					$cad_nombreTratamiento,
					' ',
					' '.$cad_costo,
					' $'.number_format($row['totalCosto'],2)
				),
				"C",$bandera
			);
			
			            $bandera = !$bandera;//Alterna
		
		}
		
		$this->pdf->Output();
	}
	
	public function ReporteTratamiento( $info ){
	
		$this->pdf = new FPDF('P', 'mm','Letter');
		$this->pdf->AddPage();
		$this->pdf->SetMargins(5, 8 , 5); #Establecemos los márgenes izquierda, arriba y derecha: 
		$this->pdf->SetAutoPageBreak(false,5); #Establecemos el margen inferior: 
	
		
		$this->CabeceraDocumento();

		$this->pdf->SetFont('Arial','B',15);
		$this->pdf->CellFitSpace(205,5, ("REPORTE DE TRATAMIENTO"),0, 0 , 'C',false);
		$this->pdf->Ln();
	
		
		$x = 5; $y = 40; $texX=100; $texY=4;
		
/*"LTRB"*/
	//	print_r($info);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetLineWidth(.1); // ancho de linea 
		$this->pdf->SetFillColor(75,141,248);

		$bandera = false;
		
		#costo por protocolo
		 
		$this->pdf->GenerarColumna(array('Protocolo','Vaca','Porcentaje','T. Enfermeria','D. Enfermeria','D. Descarte','D. evaluacion'),29.285,5,$x,$y);
		// $x = $this->pdf->Getx();
		// $this->pdf->GenerarColumna(array('Productos'),70,5,$x,$y);
		// $x = $this->pdf->Getx();
		// $this->pdf->GenerarColumna(array('C. x Protocolo', 'C. Total'),27,5,$x,$y);


		$y = $this->pdf->GetY() + 5;
	
		#cuarpo de la tabla
		$this->pdf->Ln();
		$this->pdf->SetFont('Arial','',7);
        $this->pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
		$this->pdf->SetWidths(array(29.285,29.285,29.285,29.285,29.285,29.285,29.285));
		
		// echo '<PRE>';
		// print_r($info);
		$result = $info['listaTratamiento'];
		
		if(!is_array($result)){ $result = array(); }
		foreach($result as $key => $row){
			
			
			$x = $this->pdf->GetX();
			$y = $this->pdf->GetY();
			$this->pdf->SetXY($x,$y);
			$this->pdf->Row(
				array(
					$row['nombre'].' #'.$row['numTratamiento'],
					$row['totalIncidencia'],
					$row['porcentaje'].'%',
					$row['totalDiasEnfermeria'],
					$row['diaEnfermeria'],
					$row['diaDescarte'],
					$row['diaEvaluacion']
				),
				"C",$bandera
			);
			
			            $bandera = !$bandera;//Alterna
		
		}
		
		$x = $this->pdf->GetX();
		$y = $this->pdf->GetY();
		$this->pdf->SetXY($x,$y);
		$this->pdf->GenerarColumna(array('Totales',' '.$info['array_totales']['totalIncidencia'],' '.$info['array_totales']['porcentaje'].'%',' '.$info['array_totales']['totalDiaEnfermeria'],' '.$info['array_totales']['diaEnfermeria'],' '.$info['array_totales']['diaDescarte'],' '.$info['array_totales']['diaEvaluacion']),29.285,5,$x,$y);
	
	$this->pdf->AddPage();
	
		
		$this->CabeceraDocumento();

		$this->pdf->SetFont('Arial','B',15);
		$this->pdf->CellFitSpace(205,5, ("REPORTE DE EFICIENCIA"),0, 0 , 'C',false);
		$this->pdf->Ln();
	
		
		$x = 5; $y = 40; $texX=100; $texY=4;
		
/*"LTRB"*/
	//	print_r($info);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetLineWidth(.1); // ancho de linea 
		$this->pdf->SetFillColor(75,141,248);

		$bandera = false;
		
		#costo por protocolo
		 
		$this->pdf->GenerarColumna(array(' '),35,5,$x,$y);  
		$x = $this->pdf->Getx();
		$this->pdf->GenerarColumna(array('Tipo',' ',' ','Dia de','Dias prom. por','V. curadas con','Porcentaje'),24.28,5,$x,$y);
		
		$y = $this->pdf->GetY() + 5;
		$x = 5;
		$this->pdf->GenerarColumna(array('Protocolo'),35,5,$x,$y);
		$x = $this->pdf->Getx();
		$this->pdf->GenerarColumna(array('Mastitis','Vaca','Porcentaje','Tratamiento','prot. x vaca','el protocolo','Curadas'),24.28,5,$x,$y);
	
		$y = $this->pdf->GetY() + 5;
	
		#cuarpo de la tabla
		$this->pdf->Ln();
		$this->pdf->SetFont('Arial','',7);
        $this->pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
		$this->pdf->SetWidths(array(35,24.28,24.28,24.28,24.28,24.28,24.28,24.28));
		
		// echo '<PRE>';
		// print_r($info);
		$result = $info['listaTratamiento'];
		
		if(!is_array($result)){ $result = array(); }
		foreach($result as $key => $row){
			$cad_nombre = null;
			$cad_totalVaca = null;
			$cad_totalporcentaje = null;
			$cad_diaTratamiento = null;
			$cad_porc = null;
			
			
			if(!is_array($row['mastitis'])){ $row['mastitis'] = array(); }
			foreach($row['mastitis'] as $key2 => $row2){
				$cad_nombre .= $row2['nombre']."
				";
				
				$cad_totalVaca .= $row2['totalVaca']."
				";
				
				@$totalporcentaje = (($row2['totalVaca'] * 100) / $row['totalporcentaje']);
				$cad_totalporcentaje .= $totalporcentaje."%
				";
				
				$cad_diaTratamiento .= $row2['diaTratamiento']."
				";
				
				
				@$porcen = $row2['diaTratamiento'] / $row2['totalVaca'];
				$cad_porc .= $porcen."%
				";
			}
			
			
			$x = $this->pdf->GetX();
			$y = $this->pdf->GetY();
			$this->pdf->SetXY($x,$y);
			$this->pdf->Row(
				array(
					$row['nombre'].' #'.$row['numTratamiento'],
					$cad_nombre,
					$cad_totalVaca,
					$cad_totalporcentaje,
					$cad_diaTratamiento,
					$cad_porc,
					$row['curadasProtocolo'],
					$row['porcentaje_curadasProtocolo']
				),
				"C",$bandera
			);
			
			            $bandera = !$bandera;//Alterna
		
		}
		
		$x = $this->pdf->GetX();
		$y = $this->pdf->GetY();
		$this->pdf->SetXY($x,$y);
		$this->pdf->GenerarColumna(array('Totales'),35,5,$x,$y);
		$x = $this->pdf->GetX();
		$this->pdf->GenerarColumna(array(' ',' '.$info['array_totales']['totalVaca'],' ',' '.$info['array_totales']['diaTratamiento'],' ',' ',' '),24.28,5,$x,$y);
		
		
		$this->pdf->Output();
	}
	
	private function CabeceraDocumentoOrizontal($info){
	
		#fin de cabecera	
		$this->pdf->Image(DOC_ROOT.'/images/logo_pdf.jpg',5,8,30);
		$this->pdf->SetFont('Arial','B',15);
//		$pdf->SetTextColor(3,3,3); //Letra color blanco
		$this->pdf->Cell(30);
		$x = $this->pdf->Getx();
		$this->pdf->Cell(130,15,'CEVA SALUD ANIMAL',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(100,15,'Fecha: '. $this->Util()->ChangeDateFormat(date('Y-m-d')),0,0,'R');
		$this->pdf->Ln();
		//ancho 205
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(35);
		$this->pdf->CellFitSpace(20,5, ("Rancho:"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(150,5, (" ".$info['infoEstablo']['nombre']),0, 0 , 'L',false);
		$this->pdf->Ln();
		
			//$this->pdf->CellFitSpace(270,5, utf8_decode("CANTIDAD "),'1', 1 , 'C', $bandera );
			
		//270
	}
	
	public function Incidencia($info){
	
		$this->pdf = new FPDF('L', 'mm','legal');
		$this->pdf->AddPage();
		$this->pdf->SetMargins(5, 8 , 5); #Establecemos los márgenes izquierda, arriba y derecha: 
		$this->pdf->SetAutoPageBreak(false,5); #Establecemos el margen inferior: 

		$this->CabeceraDocumentoOrizontal($info);
	


		$this->pdf->Ln();
		$this->pdf->Ln();
	
	
		$x = 5; $y = 40; $texX=100; $texY=4;
		
/*"LTRB"*/
		
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetLineWidth(.1); // ancho de linea 
		$this->pdf->SetFillColor(75,141,248);

		$bandera = false;
	

		$widths = array(35,20,20,20,20,5,5,5,5,25,25);
		@$dinamicoX = 160 / $info['numeroDias'];
		if(!is_array($info['listDias'])){ $info['listDias'] = array(); }
		$diasC = array();
		foreach($info['listDias'] as $key2 => $value){
			 array_push($widths, $dinamicoX);
			 array_push($diasC, $value['dia']);
		}
		
		 
		$this->pdf->GenerarColumna(array(' '),35,5,$x,$y);
		$x = $this->pdf->Getx();
		$this->pdf->GenerarColumna(array(' ',' ',' ',' '),20,5,$x,$y);
		$x = $this->pdf->Getx();
		$this->pdf->GenerarColumna(array('Cuarto'),20,5,$x,$y);
		$x = $this->pdf->Getx();
		$this->pdf->GenerarColumna(array(' ', ' '),25,5,$x,$y);
		$x = $this->pdf->Getx();

		$this->pdf->GenerarColumna(array(' Dias del mes '),160,5,$x,$y);
		$x = $this->pdf->Getx();
		
		$y = $this->pdf->GetY() + 5;

		$this->pdf->GenerarColumna(array('Ingreso'),35,5,5,$y);
		$x = $this->pdf->Getx();
		$this->pdf->GenerarColumna(array('Vaca','Lactancia','Corral','DEL'),20,5,$x,$y);
		$x = $this->pdf->Getx();
		$this->pdf->GenerarColumna(array('1','2','3','4'),5,5,$x,$y);
		$x = $this->pdf->Getx();
		$this->pdf->GenerarColumna(array('Mastitis','Diagnostico'),25,5,$x,$y);
		

		
		
		$x = $this->pdf->Getx();
		$this->pdf->GenerarColumna($diasC,$dinamicoX,5,$x,$y);


		#cuarpo de la tabla
		$this->pdf->Ln();
		$this->pdf->SetFont('Arial','',7);
        $this->pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
		
		
		
		
		// if(!is_array($info['listDias'])){ $info['listDias'] = array(); }
		// foreach($info['listDias'] as $key2 => $value){
			
		// } 
		
		$this->pdf->SetWidths($widths);
		
		
		$result = $info['result'];
		if(!is_array($result)){ $result = array(); }
		foreach($result as $key => $row){
	
			$x = $this->pdf->GetX();
			$y=$this->pdf->GetY();
			$this->pdf->SetXY($x,$y);
			$array_datos = array
				(
					$row['DIA_SEMANA'].' '.$row['fechaIngreso'],
					' '.$row['numVaca'],
					' '.$row['lactancia'],
					' '.$row['corral'],
					' '.$row['del'], 
					' '.$row['c1'],' '.$row['c2'],' '.$row['c3'],' '.$row['c4'],
					' '.$row['nombreMastitis'],
					' '.$row['nombreDiagnostico']
				);
			

			if(!is_array($row['listDias'])){ $row['listDias'] = array(); }
			foreach($row['listDias'] as $key2 => $value){
				 array_push($array_datos, $value['accion']);
			} 
			// echo '<PRE>';
			// print_r($array_datos);
			// exit;
			$this->pdf->Row($array_datos,"C",$bandera);
			
			
			$bandera = !$bandera;//Alterna
		
		}
		
		
		
		$this->pdf->Output();
			
	}
	
	public function Tratamiento($info){
	
		$this->pdf = new FPDF('L', 'mm','Letter');
		$this->pdf->AddPage();
		$this->pdf->SetMargins(5, 8 , 5); #Establecemos los márgenes izquierda, arriba y derecha: 
		$this->pdf->SetAutoPageBreak(false,5); #Establecemos el margen inferior: 

		$this->CabeceraDocumentoOrizontal($info);
	


		$this->pdf->Ln();
		$this->pdf->Ln();
	
	
		$x = 5; $y = 40; $texX=100; $texY=4;
		
/*"LTRB"*/
		
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetLineWidth(.1); // ancho de linea 
		$this->pdf->SetFillColor(75,141,248);

		$bandera = false;
		
		
		 
		$this->pdf->GenerarColumna(array(' ',' ',' ',' '),12,5,$x,$y);
		$x = $this->pdf->Getx();
		
		$this->pdf->GenerarColumna(array(' '),20,5,$x,$y);
		$x = $this->pdf->Getx();
		
		$this->pdf->GenerarColumna(array('Cuarto'),20,5,$x,$y);
		$x = $this->pdf->Getx();
		$this->pdf->GenerarColumna(array(' ', ' ', ' '),20,5,$x,$y);
		$x = $this->pdf->Getx();
		
		$this->pdf->GenerarColumna(array(' '),30,5,$x,$y);
		$x = $this->pdf->Getx();
		$this->pdf->GenerarColumna(array(' '),50,5,$x,$y);
		$x = $this->pdf->Getx();
		$this->pdf->GenerarColumna(array(' '),41,5,$x,$y);

		$y = $this->pdf->GetY() + 5;

		
		$this->pdf->GenerarColumna(array('Vaca','Corral','Lac.','DEL'),12,5,5,$y);
		$x = $this->pdf->Getx();
		$this->pdf->GenerarColumna(array('Registro'),20,5,$x,$y);
		$x = $this->pdf->Getx();
		$this->pdf->GenerarColumna(array('1','2','3','4'),5,5,$x,$y);
		$x = $this->pdf->Getx();
		$this->pdf->GenerarColumna(array('Mastitis','Evolucion', 'Diagnostico'),20,5,$x,$y);
		$x = $this->pdf->Getx();
		
		$this->pdf->GenerarColumna(array('Protocolo/Estado'),30,5,$x,$y);
		$x = $this->pdf->Getx();
		$this->pdf->GenerarColumna(array('Productos'),50,5,$x,$y);
		$x = $this->pdf->Getx();
		//$pdf->GenerarColumna(array('Observaciones'),55,5,$x,$y);
		$this->pdf->GenerarColumna(array('Observaciones'),41,5,$x,$y);
		

		#cuarpo de la tabla
		$this->pdf->Ln();
		$this->pdf->SetFont('Arial','',7);
        $this->pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
		$this->pdf->SetWidths(array(12,12,12,12,20, 5,5,5,5,20,20,20,30,50,41));
		
		$result = $info['result'];
		if(!is_array($result)){ $result = array(); }
		foreach($result as $key => $row){
			$cad_producto = null;
			$cad_evolucion = null;
			if(!is_array($row['productos'])){ $row['productos'] = array(); }
			foreach($row['productos'] as $key2 => $producto){
				$cad_producto .= " ".($key2 + 1).') '.$producto['nombre'].' - '.$producto['cantidad'].' ml - '.$producto['vAdministracion']."
			";
			
			}
			$cad_evolucion = $row['nombrePrueba']." ".$row['nombreResultado'];
			
			$x = $this->pdf->GetX();
			$y=$this->pdf->GetY();
			$this->pdf->SetXY($x,$y);
			$this->pdf->Row(
				array(
					' '.$row['numVaca'],' '.$row['corral'],
					' '.$row['lactancia'],' '.$row['del'], 
					' '.$row['fechaIngreso'],
					' '.$row['c1'],' '.$row['c2'],' '.$row['c3'],' '.$row['c4'],
					' '.$row['nombreMastitis'],
					' '.$cad_evolucion,
					' '.$row['nombreDiagnostico'],
					' '.$row['status'],
					$cad_producto,
					' '.$row['infoCal']['observacion']
				),
				"C",$bandera
			);
			
			            $bandera = !$bandera;//Alterna
		
		}
		
		
		for($fila = 0; $fila < 5; $fila ++){

			$x = $this->pdf->GetX();
			$y=$this->pdf->GetY();
			$this->pdf->SetXY($x,$y);
			$this->pdf->Row(
				array(
					'
					',' ',' ',' ', ' ',
					' ',' ',' ',' ',' ',
					' ',' ',' ',' ',' '
				),
				"C",$bandera
			);
			
			            $bandera = !$bandera;//Alterna
		
		}
				
		$this->pdf->Output();
			
	}
	
	public function EstadisticaCaso( $info ){
	
		$this->pdf = new FPDF('P', 'mm','Letter');
		$this->pdf->AddPage();
		$this->pdf->SetMargins(5, 8 , 5); #Establecemos los márgenes izquierda, arriba y derecha: 
		$this->pdf->SetAutoPageBreak(false,5); #Establecemos el margen inferior: 
	
	#fin de cabecera	
		// $this->pdf->Image(DOC_ROOT.'/images/logo_pdf.jpg',5,8,30);
		// $this->pdf->SetFont('Arial','B',15);
		// $this->pdf->Cell(80);
		// $this->pdf->Cell(30,10,' ',0,0,'C');
		// $this->pdf->Ln(30);
		
		

## INICIO DE CUARTO		
			#fin de cabecera	
		$this->pdf->Image(DOC_ROOT.'/images/logo_pdf.jpg',5,8,30);
		$this->pdf->SetFont('Arial','B',15);
//		$pdf->SetTextColor(3,3,3); //Letra color blanco
		$this->pdf->Cell(30);
		$x = $this->pdf->Getx();
		$this->pdf->Cell(70,15,'CEVA SALUD ANIMAL',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(100,15,'Fecha: '. $this->Util()->ChangeDateFormat(date('Y-m-d')),0,0,'R');
		//$pdf->Ln(30);
		$this->pdf->Ln(30);
	
		
		$x = 5; $y = 40; $texX=100; $texY=4;
		
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetLineWidth(.1); // ancho de linea 
		$this->pdf->SetFillColor(137,44,162);//Fondo verde de celda
      //  $pdf->SetTextColor(240, 255, 240); //Letra color blanco
		
		//ancho 205
		$this->pdf->CellFitSpace(50,5, ("Rancho"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(155,5, (" ".$info['infoEstablo']['nombre']),0, 0 , 'L',false);
		
		$this->pdf->Ln();
		$this->pdf->CellFitSpace(50,5, ("Responsable"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(155,5, (" ".$info['infoEstablo']['responsable']),0, 0 , 'L',false);
		$this->pdf->Ln();
		$this->pdf->CellFitSpace(50,5, ("Casos Totales"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(155,5, (" ".$info['info']['incidenciaTotal']),0, 0 , 'L',false);
		$this->pdf->Ln();
		$this->pdf->Ln();
	
		## TABLA DE CUARTO
		$x = $this->pdf->GetX();
		$y = $this->pdf->GetY();
		$this->pdf->SetXY($x,$y);
		$this->pdf->GenerarColumna(array('Cuartos','vaca','Prorcentaje (%)'),30,5,57.5,$y);
		

        $this->pdf->SetFont('Arial','',7);
        $this->pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
		$listCuarto = $info['listCuarto'];

		if(!is_array($listCuarto)){ $listCuarto = array(); }
		
		foreach($listCuarto as $fila){
			$this->pdf->Ln();
			$y = $this->pdf->GetY();
			$this->pdf->SetXY(57.5,$y);
		
            $this->pdf->CellFitSpace(30,5, utf8_decode(' '.$fila['nombre'].' - '.$fila['complemento']),'LR', 0 , 'C', $bandera );
            $this->pdf->CellFitSpace(30,5, utf8_decode(' '.$fila['totalCuarto']),'LR', 0 , 'C', $bandera );
			$this->pdf->CellFitSpace(30,5, utf8_decode(' '.number_format($fila['porcentaje'].' %',2)),'LR', 0 , 'C', $bandera );
        	
			
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
		
		$this->pdf->Ln();
		$y = $this->pdf->GetY();
		$this->pdf->SetXY(57.5,$y);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetLineWidth(.1); // ancho de linea 
		$this->pdf->SetFillColor(137,44,162);//Fondo verde de celda
      //  $pdf->SetTextColor(240, 255, 240); //Letra color blanco
		$this->pdf->GenerarColumna(array('Totales', $info['info']['cuartoVaca'], $info['info']['cuartoPorcentaje'].' %'),30,5,57.5,$y);
	
		$this->pdf->Image(DOC_ROOT.'/grafica/cuarto.png',10,100,195);
	
## FIN TABLA DE CUARTO
		
	

	
##INICIO DE POR DIA
		
		$this->pdf->AddPage();
		
		#fin de cabecera	
		$this->pdf->Image(DOC_ROOT.'/images/logo_pdf.jpg',5,8,30);
		$this->pdf->SetFont('Arial','B',15);
		$this->pdf->Cell(30);
		$x = $this->pdf->Getx();
		$this->pdf->Cell(70,15,'CEVA SALUD ANIMAL',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(100,15,'Fecha: '. $this->Util()->ChangeDateFormat(date('Y-m-d')),0,0,'R');
		//$pdf->Ln(30);
		$this->pdf->Ln(30);
	
		
		$x = 5; $y = 40; $texX=100; $texY=4;
		

		
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetLineWidth(.1); // ancho de linea 
		$this->pdf->SetFillColor(137,44,162);//Fondo verde de celda

		$this->pdf->CellFitSpace(50,5, ("Rancho"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(155,5, (" ".$info['infoEstablo']['nombre']),0, 0 , 'L',false);
		
		$this->pdf->Ln();
		$this->pdf->CellFitSpace(50,5, ("Responsable"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(155,5, (" ".$info['infoEstablo']['responsable']),0, 0 , 'L',false);
		$this->pdf->Ln();
		$this->pdf->CellFitSpace(50,5, ("Casos Totales"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(155,5, (" ".$info['info']['incidenciaTotal']),0, 0 , 'L',false);
		$this->pdf->Ln();
		$this->pdf->Ln();
		
		## TABLA DE MASTITIS
		$x = $this->pdf->GetX();
		$y = $this->pdf->GetY();
		$this->pdf->SetXY($x,$y);
		
		$this->pdf->GenerarColumna(array(' ','Do','Lu','Ma','Mi','Ju','Vi','Sa','Total'),22.77,5,5,$y);
		

        $this->pdf->SetFont('Arial','',7);
        $this->pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
		$array_info_dia = $info['array_info_dia'];

		if(!is_array($array_info_dia)){ $array_info_dia = array(); }
		
		// echo '<PRE>';
		// print_r($array_info_dia);
		// exit;
		$this->pdf->Ln();
		$this->pdf->CellFitSpace(22.77,5, utf8_decode('Vaca'),'LR', 0 , 'C', $bandera );
		foreach($array_info_dia as $fila){
            $this->pdf->CellFitSpace(22.77,5, utf8_decode(' '.$fila['cantidadVaca']),'LR', 0 , 'C', $bandera );
        }
		$this->pdf->CellFitSpace(22.77,5, utf8_decode(' 0'),'LR', 0 , 'C', $bandera );

		
		$this->pdf->Ln();
		$this->pdf->CellFitSpace(22.77,5, utf8_decode('%'),'LRB', 0 , 'C', $bandera );
		foreach($array_info_dia as $fila){
            $this->pdf->CellFitSpace(22.77,5, utf8_decode(' '.$fila['porcentaje']),'LRB', 0 , 'C', $bandera );
        }
		$this->pdf->CellFitSpace(22.77,5, utf8_decode(' 0'),'LRB', 0 , 'C', $bandera );

		
		$this->pdf->Image(DOC_ROOT.'/grafica/por_dia.png',10,100,195);
		
/*"LTRB"*/
## FIN POR DIA

##INICIO DE DEL
		
		$this->pdf->AddPage();
		
		#fin de cabecera	
		$this->pdf->Image(DOC_ROOT.'/images/logo_pdf.jpg',5,8,30);
		$this->pdf->SetFont('Arial','B',15);
		$this->pdf->Cell(30);
		$x = $this->pdf->Getx();
		$this->pdf->Cell(70,15,'CEVA SALUD ANIMAL',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(100,15,'Fecha: '. $this->Util()->ChangeDateFormat(date('Y-m-d')),0,0,'R');
		//$pdf->Ln(30);
		$this->pdf->Ln(30);
	
		
		$x = 5; $y = 40; $texX=100; $texY=4;
		

		
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetLineWidth(.1); // ancho de linea 
		$this->pdf->SetFillColor(137,44,162);//Fondo verde de celda

		$this->pdf->CellFitSpace(50,5, ("Rancho"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(155,5, (" ".$info['infoEstablo']['nombre']),0, 0 , 'L',false);
		
		$this->pdf->Ln();
		$this->pdf->CellFitSpace(50,5, ("Responsable"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(155,5, (" ".$info['infoEstablo']['responsable']),0, 0 , 'L',false);
		$this->pdf->Ln();
		$this->pdf->CellFitSpace(50,5, ("Casos Totales"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(155,5, (" ".$info['info']['incidenciaTotal']),0, 0 , 'L',false);
		$this->pdf->Ln();
		$this->pdf->Ln();
		
		## TABLA DE MASTITIS
		$x = $this->pdf->GetX();
		$y = $this->pdf->GetY();
		$this->pdf->SetXY($x,$y);
		
		$this->pdf->GenerarColumna(array(' ','0 - 5','6 - 50','51 - 100','101 - 150','151 - 200','201 - 250','251 - 300','> 301'),22.77,5,5,$y);
		

        $this->pdf->SetFont('Arial','',7);
        $this->pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
		$array_del = $info['array_del'];

		if(!is_array($array_del)){ $array_del = array(); }
		
		// echo '<PRE>';
		// print_r($array_del);
		// exit;
		$this->pdf->Ln();
		$this->pdf->CellFitSpace(22.77,5, utf8_decode('Vaca'),'LR', 0 , 'C', $bandera );
		foreach($array_del as $fila){
            $this->pdf->CellFitSpace(22.77,5, utf8_decode(' '.$fila['cantidad']),'LR', 0 , 'C', $bandera );
        }

		$this->pdf->Ln();
		$this->pdf->CellFitSpace(22.77,5, utf8_decode('%'),'LRB', 0 , 'C', $bandera );
		foreach($array_del as $fila){
            $this->pdf->CellFitSpace(22.77,5, utf8_decode(' '.$fila['porcentaje']),'LRB', 0 , 'C', $bandera );
        }
		
		$this->pdf->Image(DOC_ROOT.'/grafica/del.png',10,100,195);
		

		
/*"LTRB"*/
## FIN DEL


##INICIO DE LACTANCIA
		
		$this->pdf->AddPage();
		
		#fin de cabecera	
		$this->pdf->Image(DOC_ROOT.'/images/logo_pdf.jpg',5,8,30);
		$this->pdf->SetFont('Arial','B',15);
		$this->pdf->Cell(30);
		$x = $this->pdf->Getx();
		$this->pdf->Cell(70,15,'CEVA SALUD ANIMAL',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(100,15,'Fecha: '. $this->Util()->ChangeDateFormat(date('Y-m-d')),0,0,'R');
		//$pdf->Ln(30);
		$this->pdf->Ln(30);
	
		
		$x = 5; $y = 40; $texX=100; $texY=4;
		

		
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetLineWidth(.1); // ancho de linea 
		$this->pdf->SetFillColor(137,44,162);//Fondo verde de celda

		$this->pdf->CellFitSpace(50,5, ("Rancho"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(155,5, (" ".$info['infoEstablo']['nombre']),0, 0 , 'L',false);
		
		$this->pdf->Ln();
		$this->pdf->CellFitSpace(50,5, ("Responsable"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(155,5, (" ".$info['infoEstablo']['responsable']),0, 0 , 'L',false);
		$this->pdf->Ln();
		$this->pdf->CellFitSpace(50,5, ("Casos Totales"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(155,5, (" ".$info['info']['incidenciaTotal']),0, 0 , 'L',false);
		$this->pdf->Ln();
		$this->pdf->Ln();
		
		## TABLA DE MASTITIS
		$x = $this->pdf->GetX();
		$y = $this->pdf->GetY();
		$this->pdf->SetXY($x,$y);
		
		$this->pdf->GenerarColumna(array(' ','1','2','3','4','5','6','7','8','< 9'),20.5,5,5,$y);
		

        $this->pdf->SetFont('Arial','',7);
        $this->pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
		$array_lactancia = $info['array_lactancia'];

		if(!is_array($array_lactancia)){ $array_lactancia = array(); }
		
		// echo '<PRE>';
		// print_r($array_del);
		// exit;
		$this->pdf->Ln();
		$this->pdf->CellFitSpace(20.5,5, utf8_decode('Vaca'),'LR', 0 , 'C', $bandera );
		foreach($array_lactancia as $fila){
            $this->pdf->CellFitSpace(20.5,5, utf8_decode(' '.$fila['cantidad']),'LR', 0 , 'C', $bandera );
        }

		$this->pdf->Ln();
		$this->pdf->CellFitSpace(20.5,5, utf8_decode('%'),'LRB', 0 , 'C', $bandera );
		foreach($array_lactancia as $fila){
            $this->pdf->CellFitSpace(20.5,5, utf8_decode(' '.$fila['porcentaje']),'LRB', 0 , 'C', $bandera );
        }
		
		$this->pdf->Image(DOC_ROOT.'/grafica/lactancia.png',10,100,195);

		
/*"LTRB"*/
## FIN DEL


	
##INICIO DE MASTITIS
		
		$this->pdf->AddPage();
		
		#fin de cabecera	
		$this->pdf->Image(DOC_ROOT.'/images/logo_pdf.jpg',5,8,30);
		$this->pdf->SetFont('Arial','B',15);
		$this->pdf->Cell(30);
		$x = $this->pdf->Getx();
		$this->pdf->Cell(70,15,'CEVA SALUD ANIMAL',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(100,15,'Fecha: '. $this->Util()->ChangeDateFormat(date('Y-m-d')),0,0,'R');
		//$pdf->Ln(30);
		$this->pdf->Ln(30);
	
		
		$x = 5; $y = 40; $texX=100; $texY=4;
		

		
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetLineWidth(.1); // ancho de linea 
		$this->pdf->SetFillColor(137,44,162);//Fondo verde de celda

		$this->pdf->CellFitSpace(50,5, ("Rancho"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(155,5, (" ".$info['infoEstablo']['nombre']),0, 0 , 'L',false);
		
		$this->pdf->Ln();
		$this->pdf->CellFitSpace(50,5, ("Responsable"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(155,5, (" ".$info['infoEstablo']['responsable']),0, 0 , 'L',false);
		$this->pdf->Ln();
		$this->pdf->CellFitSpace(50,5, ("Casos Totales"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(155,5, (" ".$info['info']['incidenciaTotal']),0, 0 , 'L',false);
		$this->pdf->Ln();
		$this->pdf->Ln();
		
		## TABLA DE MASTITIS
		$x = $this->pdf->GetX();
		$y = $this->pdf->GetY();
		$this->pdf->SetXY($x,$y);
		$this->pdf->GenerarColumna(array('Mastitis','vaca','Prorcentaje (%)'),30,5,57.5,$y);
		

        $this->pdf->SetFont('Arial','',7);
        $this->pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
		$listTipoMastitis = $info['listTipoMastitis'];

		if(!is_array($listTipoMastitis)){ $listTipoMastitis = array(); }
		
		// echo '<PRE>';
		// print_r($listTipoMastitis);
		// exit;
		
		foreach($listTipoMastitis as $fila){
			$this->pdf->Ln();
			$y = $this->pdf->GetY();
			$this->pdf->SetXY(57.5,$y);
		
            $this->pdf->CellFitSpace(30,5, utf8_decode(' '.$fila['nombre']),'LR', 0 , 'C', $bandera );
            $this->pdf->CellFitSpace(30,5, utf8_decode(' '.$fila['totalMastitis']),'LR', 0 , 'C', $bandera );
			$this->pdf->CellFitSpace(30,5, utf8_decode(' '.number_format($fila['porcentaje'].' %',2)),'LR', 0 , 'C', $bandera );
        	
			
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
		$this->pdf->Ln();
		$y = $this->pdf->GetY();
		$this->pdf->SetXY(57.5,$y);
			
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetLineWidth(.1); // ancho de linea 
		$this->pdf->SetFillColor(137,44,162);//Fondo verde de celda
      // $pdf->SetTextColor(240, 255, 240); //Letra color blanco
		$this->pdf->GenerarColumna(array('Totales', $info['info']['mastitisVaca'], $info['info']['mastitisPorcentaje'].' %'),30,5,57.5,$y);

			$this->pdf->Image(DOC_ROOT.'/grafica/mastitis.png',10,100,195);
## FIN TABLA DE MASTITIS


##INICIO  DE Bacteriologia

$this->pdf->AddPage();
		
	#fin de cabecera	
		$this->pdf->Image(DOC_ROOT.'/images/logo_pdf.jpg',5,8,30);
		$this->pdf->SetFont('Arial','B',15);
//		$pdf->SetTextColor(3,3,3); //Letra color blanco
		$this->pdf->Cell(30);
		$x = $this->pdf->Getx();
		$this->pdf->Cell(70,15,'CEVA SALUD ANIMAL',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(100,15,'Fecha: '. $this->Util()->ChangeDateFormat(date('Y-m-d')),0,0,'R');
		//$pdf->Ln(30);
		$this->pdf->Ln(30);
	
		
		$x = 5; $y = 40; $texX=100; $texY=4;
		

		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetLineWidth(.1); // ancho de linea 
		$this->pdf->SetFillColor(137,44,162);//Fondo verde de celda
      //  $pdf->SetTextColor(240, 255, 240); //Letra color blanco
		
		//ancho 205
		$this->pdf->CellFitSpace(50,5, ("Rancho"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(155,5, (" ".$info['infoEstablo']['nombre']),0, 0 , 'L',false);
		
		$this->pdf->Ln();
		$this->pdf->CellFitSpace(50,5, ("Responsable"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(155,5, (" ".$info['infoEstablo']['responsable']),0, 0 , 'L',false);
		$this->pdf->Ln();
		$this->pdf->CellFitSpace(50,5, ("Casos Totales"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(155,5, (" ".$info['info']['incidenciaTotal']),0, 0 , 'L',false);
		$this->pdf->Ln();
		$this->pdf->Ln();
		
		## TABLA DE Bacteriologia
		$x = $this->pdf->GetX();
		$y = $this->pdf->GetY();
		$this->pdf->SetXY($x,$y);
		$this->pdf->GenerarColumna(array('Bacterias','vaca','Prorcentaje (%)'),30,5,57.5,$y);
		

        $this->pdf->SetFont('Arial','',7);
        $this->pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
		$listaAislamientoBac = $info['listaAislamientoBac'];

		if(!is_array($listaAislamientoBac)){ $listaAislamientoBac = array(); }
		
		foreach($listaAislamientoBac as $fila){
			$this->pdf->Ln();
			$y = $this->pdf->GetY();
			$this->pdf->SetXY(57.5,$y);
		
            $this->pdf->CellFitSpace(30,5, utf8_decode(' '.$fila['nombre']),'LR', 0 , 'C', $bandera );
            $this->pdf->CellFitSpace(30,5, utf8_decode(' '.$fila['TotalBacteriologia']),'LR', 0 , 'C', $bandera );
			$this->pdf->CellFitSpace(30,5, utf8_decode(' '.number_format($fila['porcentaje'].' %',2)),'LR', 0 , 'C', $bandera );
        	
			
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
		
		$this->pdf->Ln();
		$y = $this->pdf->GetY();
		$this->pdf->SetXY(57.5,$y);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetLineWidth(.1); // ancho de linea 
		$this->pdf->SetFillColor(137,44,162);//Fondo verde de celda
      //  $pdf->SetTextColor(240, 255, 240); //Letra color blanco
		$this->pdf->GenerarColumna(array('Totales', $info['info']['bacteriologiaVaca'], $info['info']['bacteriologiaPorcentaje'].' %'),30,5,57.5,$y);

		$this->pdf->Image(DOC_ROOT.'/grafica/bacteria.png',10,100,195);
		## FIN TABLA DE listaAislamientoBac		


## CORRALES
		$this->pdf->AddPage();
		
	#fin de cabecera	
		$this->pdf->Image(DOC_ROOT.'/images/logo_pdf.jpg',5,8,30);
		$this->pdf->SetFont('Arial','B',15);
		$this->pdf->Cell(30);
		$x = $this->pdf->Getx();
		$this->pdf->Cell(70,15,'CEVA SALUD ANIMAL',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(100,15,'Fecha: '. $this->Util()->ChangeDateFormat(date('Y-m-d')),0,0,'R');
		//$pdf->Ln(30);
		$this->pdf->Ln(30);
	
		
		$x = 5; $y = 40; $texX=100; $texY=4;
		
/*"LTRB"*/
		
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetLineWidth(.1); // ancho de linea 
		$this->pdf->SetFillColor(137,44,162);//Fondo verde de celda
      //  $pdf->SetTextColor(240, 255, 240); //Letra color blanco
		
		//ancho 205
		$this->pdf->CellFitSpace(50,5, ("Rancho"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(155,5, (" ".$info['infoEstablo']['nombre']),0, 0 , 'L',false);
		
		$this->pdf->Ln();
		$this->pdf->CellFitSpace(50,5, ("Responsable"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(155,5, (" ".$info['infoEstablo']['responsable']),0, 0 , 'L',false);
		$this->pdf->Ln();
		$this->pdf->CellFitSpace(50,5, ("Casos Totales"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(155,5, (" ".$info['info']['incidenciaTotal']),0, 0 , 'L',false);
		$this->pdf->Ln();
		$this->pdf->Ln();
		
		## TABLA DE corral
		$x = $this->pdf->GetX();
		$y = $this->pdf->GetY();
		$this->pdf->SetXY($x,$y);
		$this->pdf->GenerarColumna(array('Corral','vaca','Prorcentaje (%)'),30,5,57.5,$y);
		

        $this->pdf->SetFont('Arial','',7);
        $this->pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
		$listCorral = $info['listCorral'];

		if(!is_array($listCorral)){ $listCorral = array(); }
		
		foreach($listCorral as $fila){
			$this->pdf->Ln();
			$y = $this->pdf->GetY();
			$this->pdf->SetXY(57.5,$y);
		
            $this->pdf->CellFitSpace(30,5, utf8_decode(' '.$fila['numeroCorral']),'LR', 0 , 'C', $bandera );
            $this->pdf->CellFitSpace(30,5, utf8_decode(' '.$fila['totalCorral']),'LR', 0 , 'C', $bandera );
			$this->pdf->CellFitSpace(30,5, utf8_decode(' '.number_format($fila['porcentaje'].' %',2)),'LR', 0 , 'C', $bandera );
        	
			
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
		
		$this->pdf->Ln();
		$y = $this->pdf->GetY();
		$this->pdf->SetXY(57.5,$y);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetLineWidth(.1); // ancho de linea 
		$this->pdf->SetFillColor(137,44,162);//Fondo verde de celda
      //  $pdf->SetTextColor(240, 255, 240); //Letra color blanco
		$this->pdf->GenerarColumna(array('Totales', $info['info']['corralVaca'], $info['info']['corralPorcentaje'].' %'),30,5,57.5,$y);

		$this->pdf->Image(DOC_ROOT.'/grafica/corrales.png',10,100,195);
		## FIN TABLA DE corral

/* 	
		$this->pdf->AddPage();
		
	#fin de cabecera	
		$this->pdf->Image(DOC_ROOT.'/images/logo_pdf.jpg',5,8,30);
		$this->pdf->SetFont('Arial','B',15);
//		$pdf->SetTextColor(3,3,3); //Letra color blanco
		$this->pdf->Cell(30);
		$x = $this->pdf->Getx();
		$this->pdf->Cell(70,15,'CEVA SALUD ANIMAL',0,0,'L');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(100,15,'Fecha: '. $this->Util()->ChangeDateFormat(date('Y-m-d')),0,0,'R');
		//$pdf->Ln(30);
		$this->pdf->Ln(30);
	
		
		$x = 5; $y = 40; $texX=100; $texY=4;

		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetLineWidth(.1); // ancho de linea 
		$this->pdf->SetFillColor(137,44,162);//Fondo verde de celda
      //  $pdf->SetTextColor(240, 255, 240); //Letra color blanco
		
		//ancho 205
		$this->pdf->CellFitSpace(50,5, ("Rancho"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(155,5, (" ".$info['infoEstablo']['nombre']),0, 0 , 'L',false);
		
		$this->pdf->Ln();
		$this->pdf->CellFitSpace(50,5, ("Responsable"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(155,5, (" ".$info['infoEstablo']['responsable']),0, 0 , 'L',false);
		$this->pdf->Ln();
		$this->pdf->CellFitSpace(50,5, ("Casos Totales"),0, 0 , 'L',false);
		$this->pdf->CellFitSpace(155,5, (" ".$info['info']['incidenciaTotal']),0, 0 , 'L',false);
		$this->pdf->Ln();
		$this->pdf->Ln();
		
		## TABLA DE tratamiento
		$x = $this->pdf->GetX();
		$y = $this->pdf->GetY();
		$this->pdf->SetXY($x,$y);
		$this->pdf->GenerarColumna(array('Cuartos','vaca','Prorcentaje (%)'),30,5,57.5,$y);
		

        $this->pdf->SetFont('Arial','',7);
        $this->pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
		$listTratamiento = $info['listTratamiento'];

		if(!is_array($listTratamiento)){ $listTratamiento = array(); }
		
		foreach($listTratamiento as $fila){
			$this->pdf->Ln();
			$y = $this->pdf->GetY();
			$this->pdf->SetXY(57.5,$y);
		
            $this->pdf->CellFitSpace(30,5, utf8_decode(' '.$fila['nombre']),'LR', 0 , 'C', $bandera );
            $this->pdf->CellFitSpace(30,5, utf8_decode(' '.$fila['totalTratamiento']),'LR', 0 , 'C', $bandera );
			$this->pdf->CellFitSpace(30,5, utf8_decode(' '.number_format($fila['porcentaje'].' %',2)),'LR', 0 , 'C', $bandera );
        	
			
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
		
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetLineWidth(.1); // ancho de linea 
		$this->pdf->SetFillColor(137,44,162);//Fondo verde de celda
      //  $pdf->SetTextColor(240, 255, 240); //Letra color blanco
		//$this->pdf->GenerarColumna(array('Totales', $info['info']['tratamientoVaca'], $info['info']['tratamientoPorcentaje'].' %'),30,5,57.5,$y);
		
 */
		$this->pdf->Output();
		
	
	


/* 		if($correo){ //para enviar por correo
			$root = DOC_ROOT."/cron";
			if(!is_dir($root))
			{
				mkdir($root, 0777);
			}
			$pdf->Output($root."/reporte_general_saldo_".date('Y-m-d').".pdf", "F");
		}else{ //descarga el pdf de generar pdf
			// exit;
			$pdf->Output();
	 	}
 */
	
	}
	
}