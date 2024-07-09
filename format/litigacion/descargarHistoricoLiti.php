<?php
	session_start();
	include ("../../Conexiones/Conexion.php");
	include("../../funciones.php");
	include("../../funcioneLit.php");


	require_once '../librerias/PHPExcel.php';
	include '../librerias/PHPExcel/IOFactory.php';


	if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
	if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
	if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
	if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
	if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }


	$idUsuario = $_SESSION['useridIE'];
	$nunidad = getNunidad($conn, $idUnidad);
	$nomuni = $nunidad[0][0];

	$datauser = getInfoEnlaceUsuario($conn, $idUsuario);
	$idfis = $datauser[0][1];

	if($idfis == 1){ $fisname = "Apatzingan"; }
	if($idfis == 2){ $fisname = "La Piedad"; }
	if($idfis == 3){ $fisname = "Lázaro Cárdenas"; }
	if($idfis == 4){ $fisname = "Morelia"; }
	if($idfis == 5){ $fisname = "Uruapan"; }
	if($idfis == 6){ $fisname = "Zamora"; }
	if($idfis == 7){ $fisname = "Zitácuaro"; }
	if($idfis == 8){ $fisname = "Coalcoman"; }
	if($idfis == 9){ $fisname = "Huetamo"; }
	if($idfis == 10){ $fisname = "Jiquilpan"; }



	$mesNom = Mes_Nombre($mes);


	$nomUnidadAnio = "ESTADÍSTICA DE CARPETAS DE INVESTIGACION ".$anio;
	
	if($idfis != 4){ $tituloFiscalia = "Fiscalía Regional de Justicia en ".$fisname; }else{


			$tituloFiscalia = $nomuni;

	}
	
	
	
	$infoTitular = getinfoTitular($conn, $idEnlace);
	
	$nombret = $infoTitular[0][0];
	$paternot = $infoTitular[0][1];
	$maternot = $infoTitular[0][2];

	$cargot = $infoTitular[0][3];	
	$nombreTT = $nombret." ".$paternot." ".$maternot; 


	$nombrereporte = "Litigacion-".$idUnidad."-".$mes."-".$anio;

	$objPHPExcel = new PHPExcel();
	$objReader = PHPExcel_IOFactory::createReader('Excel2007');

	$plantilla = "plantillas/litigacion3.xlsx";

	$objPHPExcel = $objReader->load("$plantilla");

		$BStyle = array(
	  'borders' => array(
	    'allborders' => array(
	      'style' => PHPExcel_Style_Border::BORDER_THIN,
	      'color' => array('argb' => 'A5A5A5'),
	    )
	  )
	);

		$BStyle2 = array(
	  'borders' => array(
	    'bottom' => array(
	      'style' => PHPExcel_Style_Border::BORDER_THIN,
	      'color' => array('argb' => '000000'),
	    )
	  )
	);

	if($idMp == 0){
		$nameMp = "Todos";
	}else{
		$dataMp = getDataDelMp($conn, $idMp);
		$nameMp = $dataMp[0][0];
	}
	

	$objPHPExcel->getActiveSheet()->SetCellValue("D7", $fisname);
	$objPHPExcel->getActiveSheet()->SetCellValue("D8", $nomuni);
	$objPHPExcel->getActiveSheet()->SetCellValue("D9", $mesNom);
	$objPHPExcel->getActiveSheet()->SetCellValue("D10", $nameMp);
	$objPHPExcel->getActiveSheet()->SetCellValue("F9", $anio);


     $data = getDatosLitigacionMpUnidad2($conn, $mes, $anio, $idUnidad, $idMp);


	$objPHPExcel->getActiveSheet()->SetCellValue("D12", $data[0][0]); //Existencia anterior
	$objPHPExcel->getActiveSheet()->SetCellValue("H12", $data[0][105]);  //Recibidas por otro ministerio publico

	$objPHPExcel->getActiveSheet()->SetCellValue("D13", $data[0][1]); //Carpetas Judicializadas
	$objPHPExcel->getActiveSheet()->SetCellValue("D14", $data[0][2]); //Con detenido
	$objPHPExcel->getActiveSheet()->SetCellValue("D15", $data[0][3]); //Sin detenido

	$objPHPExcel->getActiveSheet()->SetCellValue("D18", $data[0][91]); //Formulaciones de la imputacion SOLICITADAS
	$objPHPExcel->getActiveSheet()->SetCellValue("D19", $data[0][92]); //Formulaciones de la imputacion OTORGADAS
	$objPHPExcel->getActiveSheet()->SetCellValue("D20", $data[0][93]); //Formulaciones de la imputacion NEGADAS

	$objPHPExcel->getActiveSheet()->SetCellValue("D23", $data[0][94]); //Control de la detencion Legal
	$objPHPExcel->getActiveSheet()->SetCellValue("D24", $data[0][95]); //Control de la detencion Ilegal

	$objPHPExcel->getActiveSheet()->SetCellValue("D27", $data[0][4]); //Auto de vinculacion
	$objPHPExcel->getActiveSheet()->SetCellValue("D28", $data[0][5]); //Auto de no vinculación
	$objPHPExcel->getActiveSheet()->SetCellValue("D29", $data[0][6]); //Mixtos

	$objPHPExcel->getActiveSheet()->SetCellValue("D32", $data[0][96]); //Medidas cautelares solicitadas
	$objPHPExcel->getActiveSheet()->SetCellValue("D33", $data[0][98]); //Medidas cautelares otorgadas
	$objPHPExcel->getActiveSheet()->SetCellValue("D34", $data[0][97]); //Medidas cautelares negadas


	$objPHPExcel->getActiveSheet()->SetCellValue("D36", $data[0][7]); //Imposicion de medidas cautelares
	$objPHPExcel->getActiveSheet()->SetCellValue("D37", $data[0][8]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D38", $data[0][9]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D39", $data[0][10]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D40", $data[0][11]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D41", $data[0][12]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D42", $data[0][13]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D43", $data[0][14]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D44", $data[0][15]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D45", $data[0][16]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D46", $data[0][17]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D47", $data[0][18]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D48", $data[0][19]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D49", $data[0][20]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D50", $data[0][21]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D51", $data[0][22]);


	// $objPHPExcel->getActiveSheet()->SetCellValue("H72", $data[0][23]); //Sobreseimientos decretados
	$objPHPExcel->getActiveSheet()->SetCellValue("D111", $data[0][24]); //Prescripción de la accion penal
	$objPHPExcel->getActiveSheet()->SetCellValue("D112", $data[0][151]); //Prescripción de la accion penal
	// $objPHPExcel->getActiveSheet()->SetCellValue("H75", $data[0][26]); //Acuerdo reparatorio
	// $objPHPExcel->getActiveSheet()->SetCellValue("H76", $data[0][27]); //Suspencion condicional del proceso
	// $objPHPExcel->getActiveSheet()->SetCellValue("H77", $data[0][28]); //Criterio de oportunidad
	// $objPHPExcel->getActiveSheet()->SetCellValue("H78", $data[0][29]); //Terminacion anticipada
	
	// $objPHPExcel->getActiveSheet()->SetCellValue("H79", $data[0][31]); //Acumulación
	$objPHPExcel->getActiveSheet()->SetCellValue("D52", $data[0][32]); //Citaciones

	$objPHPExcel->getActiveSheet()->SetCellValue("D54", $data[0][33]); //Cateos solicitados
	$objPHPExcel->getActiveSheet()->SetCellValue("D55", $data[0][34]); //Cateos concedidos
	$objPHPExcel->getActiveSheet()->SetCellValue("D56", $data[0][35]); //Cateos negados

	$objPHPExcel->getActiveSheet()->SetCellValue("D58", $data[0][36]); //Ordenes negadas
	$objPHPExcel->getActiveSheet()->SetCellValue("D59", $data[0][37]); //Aprehension
	$objPHPExcel->getActiveSheet()->SetCellValue("D60", $data[0][38]); //Comparecencia
	$objPHPExcel->getActiveSheet()->SetCellValue("D61", $data[0][107]); //Ordenes solicitadas
	$objPHPExcel->getActiveSheet()->SetCellValue("D62", $data[0][108]); //Aprehension
	$objPHPExcel->getActiveSheet()->SetCellValue("D63", $data[0][109]); //Comparecencia

	$objPHPExcel->getActiveSheet()->SetCellValue("D65", $data[0][50]); //mANDAMIENTOS JUDICIALES GIRADOS
	$objPHPExcel->getActiveSheet()->SetCellValue("D66", $data[0][51]); 
	$objPHPExcel->getActiveSheet()->SetCellValue("D67", $data[0][52]);

	$objPHPExcel->getActiveSheet()->SetCellValue("D68", $data[0][53]); //Mandamientos judiciales cumplidos
	$objPHPExcel->getActiveSheet()->SetCellValue("D69", $data[0][54]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D70", $data[0][55]);

	$objPHPExcel->getActiveSheet()->SetCellValue("D71", $data[0][110]); //Medidas de proteccion
	$objPHPExcel->getActiveSheet()->SetCellValue("D72", $data[0][111]); //total de victimas de protección

	$objPHPExcel->getActiveSheet()->SetCellValue("D74", $data[0][112]); //Actos de investigacion CON control judicial
	$objPHPExcel->getActiveSheet()->SetCellValue("D75", $data[0][113]); //Intervención en tiempo real
	$objPHPExcel->getActiveSheet()->SetCellValue("D76", $data[0][114]); //Toma de muestras
	$objPHPExcel->getActiveSheet()->SetCellValue("D77", $data[0][115]); //Exhumaciíon
	$objPHPExcel->getActiveSheet()->SetCellValue("D78", $data[0][116]);  //Obtención de datos reservados
	$objPHPExcel->getActiveSheet()->SetCellValue("D79", $data[0][117]);  //Intervencion de comunicaciones
	$objPHPExcel->getActiveSheet()->SetCellValue("D80", $data[0][118]); //Providencia precautoria

	$objPHPExcel->getActiveSheet()->SetCellValue("D83", $data[0][119]); //Actos de investigacion SIN control judicial
	$objPHPExcel->getActiveSheet()->SetCellValue("D84", $data[0][120]); //Cadena de custodia
	$objPHPExcel->getActiveSheet()->SetCellValue("D85", $data[0][121]); //Inspeccion de lugar distina a los hechos
 $objPHPExcel->getActiveSheet()->SetCellValue("D86", $data[0][122]); //Inspeccion de inmuebles
 $objPHPExcel->getActiveSheet()->SetCellValue("D87", $data[0][123]); //Entrevista entre testigos
 $objPHPExcel->getActiveSheet()->SetCellValue("D88", $data[0][124]); //Reconocimiento entre persona
 $objPHPExcel->getActiveSheet()->SetCellValue("D89", $data[0][125]); //Solicitud de informes periciales
 $objPHPExcel->getActiveSheet()->SetCellValue("D90", $data[0][126]); //Información de institutos de seguridad
 $objPHPExcel->getActiveSheet()->SetCellValue("D91", $data[0][127]); //Reconocimiento ó examen fisico de persona

 $objPHPExcel->getActiveSheet()->SetCellValue("H15", $data[0][128]); //Resoluciones de juicio oral
 $objPHPExcel->getActiveSheet()->SetCellValue("H16", $data[0][129]); //Audiencia juicio oral
 $objPHPExcel->getActiveSheet()->SetCellValue("H17", $data[0][130]); //Audiencia de fallo
 $objPHPExcel->getActiveSheet()->SetCellValue("H18", $data[0][132]); //Audiencia de individualizacion de sancion
 $objPHPExcel->getActiveSheet()->SetCellValue("H19", $data[0][133]); //Procedimiento especial
 $objPHPExcel->getActiveSheet()->SetCellValue("H20", $data[0][131]); //Audiencia absolutorio
 $objPHPExcel->getActiveSheet()->SetCellValue("H21", $data[0][134]); //Audiencia condenatorio


	$objPHPExcel->getActiveSheet()->SetCellValue("H58", $data[0][43]); //Apleaciones no admitidas
	$objPHPExcel->getActiveSheet()->SetCellValue("H41", $data[0][30]); //Procedimientos abreviados
	$objPHPExcel->getActiveSheet()->SetCellValue("H42", $data[0][135]); //Mecanismos de aceleracion

	$objPHPExcel->getActiveSheet()->SetCellValue("H87", $data[0][44]); //Sentencias dictadas
	$objPHPExcel->getActiveSheet()->SetCellValue("H88", $data[0][45]); //Revoca
	$objPHPExcel->getActiveSheet()->SetCellValue("H89", $data[0][46]); //Modifica
	$objPHPExcel->getActiveSheet()->SetCellValue("H90", $data[0][47]); //Confirma
	$objPHPExcel->getActiveSheet()->SetCellValue("H91", $data[0][48]);  //Reposicion del procedimiento

	//$objPHPExcel->getActiveSheet()->SetCellValue("H13", $data[0][49]); //Total de carpetas judicializadas en tramite
	$objPHPExcel->getActiveSheet()->SetCellValue("H13", $data[0][150]); //Total de carpetas judicializadas en tramite

	$objPHPExcel->getActiveSheet()->SetCellValue("H30", $data[0][56]); //Total de audiencias

	$objPHPExcel->getActiveSheet()->SetCellValue("D93", $data[0][99]); //Acusaciones presentadas
	$objPHPExcel->getActiveSheet()->SetCellValue("D94", $data[0][57]); //Audiencia intermedia escrita
	$objPHPExcel->getActiveSheet()->SetCellValue("D95", $data[0][58]); //Audiencia intermedia oral

	$objPHPExcel->getActiveSheet()->SetCellValue("H37", $data[0][59]); //Soluciones alternas
	$objPHPExcel->getActiveSheet()->SetCellValue("H38", $data[0][60]); //Suspension condicional del proceso
	$objPHPExcel->getActiveSheet()->SetCellValue("H39", $data[0][61]); //Acuerdos reparatorios

	$objPHPExcel->getActiveSheet()->SetCellValue("H23", $data[0][62]); //Sentencias
	$objPHPExcel->getActiveSheet()->SetCellValue("H24", $data[0][63]); //Sentencias condenatorias
	$objPHPExcel->getActiveSheet()->SetCellValue("H25", $data[0][64]); //Sentencias absolutorias
	$objPHPExcel->getActiveSheet()->SetCellValue("H26", $data[0][65]); //Sentencias Mixtas
	$objPHPExcel->getActiveSheet()->SetCellValue("H27", $data[0][66]); //Se condena la reparación del daño
	$objPHPExcel->getActiveSheet()->SetCellValue("H28", $data[0][67]); //No se condena

	$objPHPExcel->getActiveSheet()->SetCellValue("H83", $data[0][68]); //Incompetencias
	$objPHPExcel->getActiveSheet()->SetCellValue("H84", $data[0][69]); //Decretadas
	$objPHPExcel->getActiveSheet()->SetCellValue("H85", $data[0][70]); //Admitidas

	$objPHPExcel->getActiveSheet()->SetCellValue("H44", $data[0][71]); //Apelaciones contra resolucion del juez de control
	$objPHPExcel->getActiveSheet()->SetCellValue("H45", $data[0][72]); //negar anticipo de prueba
	$objPHPExcel->getActiveSheet()->SetCellValue("H46", $data[0][73]); //Negar acuerdo reparatorio
	$objPHPExcel->getActiveSheet()->SetCellValue("H47", $data[0][74]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H48", $data[0][75]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H49", $data[0][76]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H50", $data[0][77]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H51", $data[0][78]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H53", $data[0][79]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H54", $data[0][80]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H55", $data[0][81]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H56", $data[0][82]); //Apelaciones excluir medios de prueba

	$objPHPExcel->getActiveSheet()->SetCellValue("H60", $data[0][136]); //Apelaciones por amparo

	$objPHPExcel->getActiveSheet()->SetCellValue("H62", $data[0][137]); //Amparos
	$objPHPExcel->getActiveSheet()->SetCellValue("H63", $data[0][138]); //Amparo directo
	$objPHPExcel->getActiveSheet()->SetCellValue("H64", $data[0][139]); //Amparo indirecto

	$objPHPExcel->getActiveSheet()->SetCellValue("H68", $data[0][83]); //Apelaciones contra resoluciones del tribunal de enjuiciamiento
	$objPHPExcel->getActiveSheet()->SetCellValue("H69", $data[0][84]); //Desistimiento de la acción penal
	$objPHPExcel->getActiveSheet()->SetCellValue("H70", $data[0][85]); // sentencia definitiva

	$objPHPExcel->getActiveSheet()->SetCellValue("H32", $data[0][86]); //De las sentencias dictadas
	$objPHPExcel->getActiveSheet()->SetCellValue("H33", $data[0][87]); //Revocaciones favorables a mp
	$objPHPExcel->getActiveSheet()->SetCellValue("H34", $data[0][88]); //Modificaciones favorables a mp
	$objPHPExcel->getActiveSheet()->SetCellValue("H35", $data[0][89]); //Confirmaciones favorables a mp

	$objPHPExcel->getActiveSheet()->SetCellValue("H93", $data[0][39]); //Desistimiento del recurso
	$objPHPExcel->getActiveSheet()->SetCellValue("H94", $data[0][40]); //Por parte del acusado
	$objPHPExcel->getActiveSheet()->SetCellValue("H95", $data[0][41]); //Por parte del defensor
	$objPHPExcel->getActiveSheet()->SetCellValue("H96", $data[0][42]); //Por parte del ministerio publico

	$objPHPExcel->getActiveSheet()->SetCellValue("H99", $data[0][90]); //Por cambios de situacion juridica declarados sin materia
	$objPHPExcel->getActiveSheet()->SetCellValue("H101", $data[0][106]); //Canalizados por cese de funciones

	$objPHPExcel->getActiveSheet()->SetCellValue("D101", $data[0][140]); //Canalizados por cese de funciones
	$objPHPExcel->getActiveSheet()->SetCellValue("D102", $data[0][141]); //Canalizados por cese de funciones
	$objPHPExcel->getActiveSheet()->SetCellValue("D103", $data[0][142]); //Canalizados por cese de funciones
	$objPHPExcel->getActiveSheet()->SetCellValue("D104", $data[0][143]); //Canalizados por cese de funciones
	$objPHPExcel->getActiveSheet()->SetCellValue("D105", $data[0][144]); //Canalizados por cese de funciones
	$objPHPExcel->getActiveSheet()->SetCellValue("D106", $data[0][145]); //Canalizados por cese de funciones
	$objPHPExcel->getActiveSheet()->SetCellValue("D107", $data[0][146]); //Canalizados por cese de funciones
	$objPHPExcel->getActiveSheet()->SetCellValue("D108", $data[0][147]); //Canalizados por cese de funciones
	$objPHPExcel->getActiveSheet()->SetCellValue("D109", $data[0][148]); //Canalizados por cese de funciones
	$objPHPExcel->getActiveSheet()->SetCellValue("D110", $data[0][149]); //Canalizados por cese de funciones

	$nombre_reporte = $nombrereporte.".xlsx";

	//Obtenemos el numero total de MP en la unidad
	$dataMp = getDataMP_documentExcel($conn, $mes, $anio, $idUnidad);
	$totalMP = sizeof($dataMp);
 $k = 0;
 $tituloSheet = [];

	//temp sheet copy
for($pageIndex=1; $pageIndex <= $totalMP; $pageIndex++){
	$tituloSheet[$k] = formatTitleSheet($dataMp[$k][152], $dataMp[$k][153], $dataMp[$k][154]);
	$tempSheet = $objPHPExcel->getSheet(0)->copy();
	$tempSheet->setTitle($tituloSheet[$k]);
	$objPHPExcel->addSheet($tempSheet);

	$sheet = $objPHPExcel->getSheet($pageIndex);
 $sheet->SetCellValue("D10", $dataMp[$k][152].' '.$dataMp[$k][153].' '.$dataMp[$k][154]);


 $sheet->SetCellValue("D12", $dataMp[$k][0]); //Existencia anterior
	$sheet->SetCellValue("H12", $dataMp[$k][105]);  //Recibidas por otro ministerio publico

	$sheet->SetCellValue("D13", $dataMp[$k][1]); //Carpetas Judicializadas
	$sheet->SetCellValue("D14", $dataMp[$k][2]); //Con detenido
	$sheet->SetCellValue("D15", $dataMp[$k][3]); //Sin detenido

	$sheet->SetCellValue("D18", $dataMp[$k][91]); //Formulaciones de la imputacion SOLICITADAS
	$sheet->SetCellValue("D19", $dataMp[$k][92]); //Formulaciones de la imputacion OTORGADAS
	$sheet->SetCellValue("D20", $dataMp[$k][93]); //Formulaciones de la imputacion NEGADAS

 $sheet->SetCellValue("D23", $dataMp[$k][94]); //Control de la detencion Legal
	$sheet->SetCellValue("D24", $dataMp[$k][95]); //Control de la detencion Ilegal

	$sheet->SetCellValue("D27", $dataMp[$k][4]); //Auto de vinculacion
 $sheet->SetCellValue("D28", $dataMp[$k][5]); //Auto de no vinculación
	$sheet->SetCellValue("D29", $dataMp[$k][6]); //Mixtos

	$sheet->SetCellValue("D32", $dataMp[$k][96]); //Medidas cautelares solicitadas
	$sheet->SetCellValue("D33", $dataMp[$k][98]); //Medidas cautelares otorgadas
	$sheet->SetCellValue("D34", $dataMp[$k][97]); //Medidas cautelares negadas


	$sheet->SetCellValue("D36", $dataMp[$k][7]); //Imposicion de medidas cautelares
	$sheet->SetCellValue("D37", $dataMp[$k][8]);
	$sheet->SetCellValue("D38", $dataMp[$k][9]);
	$sheet->SetCellValue("D39", $dataMp[$k][10]);
	$sheet->SetCellValue("D40", $dataMp[$k][11]);
	$sheet->SetCellValue("D41", $dataMp[$k][12]);
	$sheet->SetCellValue("D42", $dataMp[$k][13]);
	$sheet->SetCellValue("D43", $dataMp[$k][14]);
	$sheet->SetCellValue("D44", $dataMp[$k][15]);
 $sheet->SetCellValue("D45", $dataMp[$k][16]);
	$sheet->SetCellValue("D46", $dataMp[$k][17]);
	$sheet->SetCellValue("D47", $dataMp[$k][18]);
	$sheet->SetCellValue("D48", $dataMp[$k][19]);
	$sheet->SetCellValue("D49", $dataMp[$k][20]);
	$sheet->SetCellValue("D50", $dataMp[$k][21]);
	$sheet->SetCellValue("D51", $dataMp[$k][22]);


	// $objPHPExcel->getActiveSheet()->SetCellValue("H72", $data[0][23]); //Sobreseimientos decretados
 $sheet->SetCellValue("D111", $dataMp[$k][24]); //Prescripción de la accion penal
	$sheet->SetCellValue("D112", $dataMp[$k][151]); //Prescripción de la accion penal
	// $objPHPExcel->getActiveSheet()->SetCellValue("H75", $data[0][26]); //Acuerdo reparatorio
	// $objPHPExcel->getActiveSheet()->SetCellValue("H76", $data[0][27]); //Suspencion condicional del proceso
	// $objPHPExcel->getActiveSheet()->SetCellValue("H77", $data[0][28]); //Criterio de oportunidad
	// $objPHPExcel->getActiveSheet()->SetCellValue("H78", $data[0][29]); //Terminacion anticipada
	
	// $objPHPExcel->getActiveSheet()->SetCellValue("H79", $data[0][31]); //Acumulación

	$sheet->SetCellValue("D52", $dataMp[$k][32]); //Citaciones

	$sheet->SetCellValue("D54", $dataMp[$k][33]); //Cateos solicitados
	$sheet->SetCellValue("D55", $dataMp[$k][34]); //Cateos concedidos
 $sheet->SetCellValue("D56", $dataMp[$k][35]); //Cateos negados

	$sheet->SetCellValue("D58", $dataMp[$k][36]); //Ordenes negadas
	$sheet->SetCellValue("D59", $dataMp[$k][37]); //Aprehension
 $sheet->SetCellValue("D60", $dataMp[$k][38]); //Comparecencia
	$sheet->SetCellValue("D61", $dataMp[$k][107]); //Ordenes solicitadas
	$sheet->SetCellValue("D62", $dataMp[$k][108]); //Aprehension
	$sheet->SetCellValue("D63", $dataMp[$k][109]); //Comparecencia

	$sheet->SetCellValue("D65", $dataMp[$k][50]); //mANDAMIENTOS JUDICIALES GIRADOS
	$sheet->SetCellValue("D66", $dataMp[$k][51]); 
	$sheet->SetCellValue("D67", $dataMp[$k][52]);

	$sheet->SetCellValue("D68", $dataMp[$k][53]); //Mandamientos judiciales cumplidos
	$sheet->SetCellValue("D69", $dataMp[$k][54]);
	$sheet->SetCellValue("D70", $dataMp[$k][55]);

	$sheet->SetCellValue("D71", $dataMp[$k][110]); //Medidas de proteccion
	$sheet->SetCellValue("D72", $dataMp[$k][111]); //total de victimas de protección

	$sheet->SetCellValue("D74", $dataMp[$k][112]); //Actos de investigacion CON control judicial
	$sheet->SetCellValue("D75", $dataMp[$k][113]); //Intervención en tiempo real
	$sheet->SetCellValue("D76", $dataMp[$k][114]); //Toma de muestras
	$sheet->SetCellValue("D77", $dataMp[$k][115]); //Exhumaciíon
	$sheet->SetCellValue("D78", $dataMp[$k][116]);  //Obtención de datos reservados
	$sheet->SetCellValue("D79", $dataMp[$k][117]);  //Intervencion de comunicaciones
 $sheet->SetCellValue("D80", $dataMp[$k][118]); //Providencia precautoria

	$sheet->SetCellValue("D83", $dataMp[$k][119]); //Actos de investigacion SIN control judicial
	$sheet->SetCellValue("D84", $dataMp[$k][120]); //Cadena de custodia
 $sheet->SetCellValue("D85", $dataMp[$k][121]); //Inspeccion de lugar distina a los hechos
 $sheet->SetCellValue("D86", $dataMp[$k][122]); //Inspeccion de inmuebles
 $sheet->SetCellValue("D87", $dataMp[$k][123]); //Entrevista entre testigos
 $sheet->SetCellValue("D88", $dataMp[$k][124]); //Reconocimiento entre persona
 $sheet->SetCellValue("D89", $dataMp[$k][125]); //Solicitud de informes periciales
 $sheet->SetCellValue("D90", $dataMp[$k][126]); //Información de institutos de seguridad
 $sheet->SetCellValue("D91", $dataMp[$k][127]); //Reconocimiento ó examen fisico de persona

 $sheet->SetCellValue("H15", $dataMp[$k][128]); //Resoluciones de juicio oral
 $sheet->SetCellValue("H16", $dataMp[$k][129]); //Audiencia juicio oral
 $sheet->SetCellValue("H17", $dataMp[$k][130]); //Audiencia de fallo
 $sheet->SetCellValue("H18", $dataMp[$k][132]); //Audiencia de individualizacion de sancion
 $sheet->SetCellValue("H19", $dataMp[$k][133]); //Procedimiento especial
 $sheet->SetCellValue("H20", $dataMp[$k][131]); //Audiencia absolutorio
 $sheet->SetCellValue("H21", $dataMp[$k][134]); //Audiencia condenatorio


	$sheet->SetCellValue("H58", $dataMp[$k][43]); //Apleaciones no admitidas
	$sheet->SetCellValue("H41", $dataMp[$k][30]); //Procedimientos abreviados
	$sheet->SetCellValue("H42", $dataMp[$k][135]); //Mecanismos de aceleracion

	$sheet->SetCellValue("H87", $dataMp[$k][44]); //Sentencias dictadas
	$sheet->SetCellValue("H88", $dataMp[$k][45]); //Revoca
 $sheet->SetCellValue("H89", $dataMp[$k][46]); //Modifica
	$sheet->SetCellValue("H90", $dataMp[$k][47]); //Confirma
	$sheet->SetCellValue("H91", $dataMp[$k][48]);  //Reposicion del procedimiento

	//$objPHPExcel->getActiveSheet()->SetCellValue("H13", $data[0][49]); //Total de carpetas judicializadas en tramite

	$sheet->SetCellValue("H13", $dataMp[$k][150]); //Total de carpetas judicializadas en tramite NUEVO CAMPO NUCS

	$sheet->SetCellValue("H30", $dataMp[$k][56]); //Total de audiencias

	$sheet->SetCellValue("D93", $dataMp[$k][99]); //Acusaciones presentadas
	$sheet->SetCellValue("D94", $dataMp[$k][57]); //Audiencia intermedia escrita
	$sheet->SetCellValue("D95", $dataMp[$k][58]); //Audiencia intermedia oral

	$sheet->SetCellValue("H37", $dataMp[$k][59]); //Soluciones alternas
	$sheet->SetCellValue("H38", $dataMp[$k][60]); //Suspension condicional del proceso
	$sheet->SetCellValue("H39", $dataMp[$k][61]); //Acuerdos reparatorios

	$sheet->setCellValue("H23", $dataMp[$k][62]); //Sentencias
	$sheet->SetCellValue("H24", $dataMp[$k][63]); //Sentencias condenatorias
	$sheet->SetCellValue("H25", $dataMp[$k][64]); //Sentencias absolutorias
	$sheet->SetCellValue("H26", $dataMp[$k][65]); //Sentencias Mixtas
	$sheet->SetCellValue("H27", $dataMp[$k][66]); //Se condena la reparación del daño
	$sheet->SetCellValue("H28", $dataMp[$k][67]); //No se condena

	$sheet->SetCellValue("H83", $dataMp[$k][68]); //Incompetencias
	$sheet->SetCellValue("H84", $dataMp[$k][69]); //Decretadas
	$sheet->SetCellValue("H85", $dataMp[$k][70]); //Admitidas

	$sheet->SetCellValue("H44", $dataMp[$k][71]); //Apelaciones contra resolucion del juez de control
	$sheet->SetCellValue("H45", $dataMp[$k][72]); //negar anticipo de prueba
	$sheet->SetCellValue("H46", $dataMp[$k][73]); //Negar acuerdo reparatorio
	$sheet->SetCellValue("H47", $dataMp[$k][74]);
	$sheet->SetCellValue("H48", $dataMp[$k][75]);
	$sheet->SetCellValue("H49", $dataMp[$k][76]);
	$sheet->SetCellValue("H50", $dataMp[$k][77]);
	$sheet->SetCellValue("H51", $dataMp[$k][78]);
	$sheet->SetCellValue("H53", $dataMp[$k][79]);
	$sheet->SetCellValue("H54", $dataMp[$k][80]);
	$sheet->SetCellValue("H55", $dataMp[$k][81]);
	$sheet->SetCellValue("H56", $dataMp[$k][82]); //Apelaciones excluir medios de prueba

	$sheet->SetCellValue("H60", $dataMp[$k][136]); //Apelaciones por amparo

	$sheet->SetCellValue("H62", $dataMp[$k][137]); //Amparos
	$sheet->SetCellValue("H63", $dataMp[$k][138]); //Amparo directo
	$sheet->SetCellValue("H64", $dataMp[$k][139]); //Amparo indirecto

	$sheet->SetCellValue("H68", $dataMp[$k][83]); //Apelaciones contra resoluciones del tribunal de enjuiciamiento
	$sheet->SetCellValue("H69", $dataMp[$k][84]); //Desistimiento de la acción penal
	$sheet->SetCellValue("H70", $dataMp[$k][85]); // sentencia definitiva

	$sheet->SetCellValue("H32", $dataMp[$k][86]); //De las sentencias dictadas
	$sheet->SetCellValue("H33", $dataMp[$k][87]); //Revocaciones favorables a mp
	$sheet->SetCellValue("H34", $dataMp[$k][88]); //Modificaciones favorables a mp
	$sheet->SetCellValue("H35", $dataMp[$k][89]); //Confirmaciones favorables a mp

	$sheet->SetCellValue("H93", $dataMp[$k][39]); //Desistimiento del recurso
	$sheet->SetCellValue("H94", $dataMp[$k][40]); //Por parte del acusado
	$sheet->SetCellValue("H95", $dataMp[$k][41]); //Por parte del defensor
	$sheet->SetCellValue("H96", $dataMp[$k][42]); //Por parte del ministerio publico

	$sheet->SetCellValue("H99", $dataMp[$k][90]); //Por cambios de situacion juridica declarados sin materia
	$sheet->SetCellValue("H101", $dataMp[$k][106]); //Canalizados por cese de funciones

	
	$sheet->SetCellValue("D101", $dataMp[$k][140]); //Canalizados por cese de funciones
	$sheet->SetCellValue("D102", $dataMp[$k][141]); //Canalizados por cese de funciones
	$sheet->SetCellValue("D103", $dataMp[$k][142]); //Canalizados por cese de funciones
 $sheet->SetCellValue("D104", $dataMp[$k][143]); //Canalizados por cese de funciones
	$sheet->SetCellValue("D105", $dataMp[$k][144]); //Canalizados por cese de funciones
	$sheet->SetCellValue("D106", $dataMp[$k][145]); //Canalizados por cese de funciones
	$sheet->SetCellValue("D107", $dataMp[$k][146]); //Canalizados por cese de funciones
	$sheet->SetCellValue("D108", $dataMp[$k][147]); //Canalizados por cese de funciones
	$sheet->SetCellValue("D109", $dataMp[$k][148]); //Canalizados por cese de funciones
	$sheet->SetCellValue("D110", $dataMp[$k][149]); //Canalizados por cese de funciones

 


 unset($tempSheet);
	$k++;
	///////IMPRIMIMOS LOS DATOS INDIVIDUALES DE LOS MINISTERIOS PUBLICOS EN EL DESCARGABLE/////////
}



	$objPHPExcel->getActiveSheet()->getProtection()->setSelectLockedCells(false);
	$objPHPExcel->getActiveSheet()->getProtection()->setSelectUnlockedCells(false);
	$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(false);
	$objPHPExcel->getActiveSheet()->getProtection()->setFormatRows(false);
	$objPHPExcel->getActiveSheet()->getProtection()->setInsertColumns(true);
	$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
	$objPHPExcel->getActiveSheet()->getProtection()->setInsertHyperlinks(true);
	$objPHPExcel->getActiveSheet()->getProtection()->setDeleteColumns(true);
	$objPHPExcel->getActiveSheet()->getProtection()->setDeleteRows(true);
	$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
	$objPHPExcel->getActiveSheet()->getProtection()->setAutofilter(true);
	$objPHPExcel->getActiveSheet()->getProtection()->setObjects(true);
	$objPHPExcel->getActiveSheet()->getProtection()->setScenarios(true);
	$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
	//$objPHPExcel->getActiveSheet()->getProtection()->setPassword('2D0P1E8');


	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save(utf8_decode("downloadReport/$nombre_reporte"));

?>
