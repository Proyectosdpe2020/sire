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


	$objPHPExcel->getActiveSheet()->SetCellValue("D7", $fisname);
	$objPHPExcel->getActiveSheet()->SetCellValue("D8", $nomuni);
	$objPHPExcel->getActiveSheet()->SetCellValue("D9", $mesNom);
	$objPHPExcel->getActiveSheet()->SetCellValue("F9", $anio);


     $data = getDatosLitigacionMpUnidad2($conn, $mes, $anio, $idUnidad);


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


	$objPHPExcel->getActiveSheet()->SetCellValue("H72", $data[0][23]); //Sobreseimientos decretados
	$objPHPExcel->getActiveSheet()->SetCellValue("H73", $data[0][24]); //Prescripción de la accion penal
	$objPHPExcel->getActiveSheet()->SetCellValue("H74", $data[0][25]); //por mecanismos alternativos
	$objPHPExcel->getActiveSheet()->SetCellValue("H75", $data[0][26]); //Acuerdo reparatorio
	$objPHPExcel->getActiveSheet()->SetCellValue("H76", $data[0][27]); //Suspencion condicional del proceso
	$objPHPExcel->getActiveSheet()->SetCellValue("H77", $data[0][28]); //Criterio de oportunidad
	$objPHPExcel->getActiveSheet()->SetCellValue("H78", $data[0][29]); //Terminacion anticipada
	
	$objPHPExcel->getActiveSheet()->SetCellValue("H79", $data[0][31]); //Acumulación
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

	$objPHPExcel->getActiveSheet()->SetCellValue("H13", $data[0][49]); //Total de carpetas judicializadas en tramite

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

	$objPHPExcel->getActiveSheet()->SetCellValue("H93", $data[0][86]); //Desistimiento del recurso
	$objPHPExcel->getActiveSheet()->SetCellValue("H94", $data[0][87]); //Por parte del acusado
	$objPHPExcel->getActiveSheet()->SetCellValue("H95", $data[0][88]); //Por parte del defensor
	$objPHPExcel->getActiveSheet()->SetCellValue("H96", $data[0][88]); //Por parte del ministerio publico

	$objPHPExcel->getActiveSheet()->SetCellValue("H99", $data[0][90]); //Por cambios de situacion juridica declarados sin materia
	$objPHPExcel->getActiveSheet()->SetCellValue("H101", $data[0][106]); //Canalizados por cese de funciones

	$nombre_reporte = $nombrereporte.".xlsx";


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
