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

	$plantilla = "plantillas/litigacion2.xlsx";

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


	$objPHPExcel->getActiveSheet()->SetCellValue("D12", $data[0][0]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H12", $data[0][105]);

	$objPHPExcel->getActiveSheet()->SetCellValue("D14", $data[0][1]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D15", $data[0][2]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D16", $data[0][3]);///OK

	$objPHPExcel->getActiveSheet()->SetCellValue("D19", $data[0][91]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D20", $data[0][92]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D21", $data[0][93]);

	$objPHPExcel->getActiveSheet()->SetCellValue("D24", $data[0][94]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D25", $data[0][95]);

	$objPHPExcel->getActiveSheet()->SetCellValue("D28", $data[0][4]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D29", $data[0][5]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D30", $data[0][6]);

	$objPHPExcel->getActiveSheet()->SetCellValue("D33", $data[0][96]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D34", $data[0][98]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D35", $data[0][97]);


	$objPHPExcel->getActiveSheet()->SetCellValue("D37", $data[0][7]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D38", $data[0][8]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D39", $data[0][9]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D40", $data[0][10]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D41", $data[0][11]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D42", $data[0][12]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D43", $data[0][13]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D44", $data[0][14]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D45", $data[0][15]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D46", $data[0][16]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D47", $data[0][17]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D48", $data[0][18]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D49", $data[0][19]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D50", $data[0][20]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D51", $data[0][21]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D52", $data[0][22]);


	$objPHPExcel->getActiveSheet()->SetCellValue("D54", $data[0][23]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D55", $data[0][24]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D56", $data[0][25]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D57", $data[0][26]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D58", $data[0][27]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D59", $data[0][28]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D60", $data[0][29]);
	
	$objPHPExcel->getActiveSheet()->SetCellValue("D63", $data[0][31]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D65", $data[0][32]);

	$objPHPExcel->getActiveSheet()->SetCellValue("D67", $data[0][33]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D68", $data[0][34]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D69", $data[0][35]);

	$objPHPExcel->getActiveSheet()->SetCellValue("D71", $data[0][36]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D72", $data[0][37]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D73", $data[0][38]);

	$objPHPExcel->getActiveSheet()->SetCellValue("D75", $data[0][39]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D76", $data[0][40]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D77", $data[0][41]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D78", $data[0][42]);

	$objPHPExcel->getActiveSheet()->SetCellValue("D80", $data[0][43]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D81", $data[0][30]);

	$objPHPExcel->getActiveSheet()->SetCellValue("D82", $data[0][44]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D83", $data[0][45]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D84", $data[0][46]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D85", $data[0][47]);
	$objPHPExcel->getActiveSheet()->SetCellValue("D86", $data[0][48]);

	$objPHPExcel->getActiveSheet()->SetCellValue("D88", $data[0][49]);

	$objPHPExcel->getActiveSheet()->SetCellValue("H14", $data[0][50]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H15", $data[0][51]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H16", $data[0][52]);

	$objPHPExcel->getActiveSheet()->SetCellValue("H18", $data[0][53]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H19", $data[0][54]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H20", $data[0][55]);

	$objPHPExcel->getActiveSheet()->SetCellValue("H22", $data[0][56]);

	$objPHPExcel->getActiveSheet()->SetCellValue("H24", $data[0][99]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H25", $data[0][57]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H26", $data[0][58]);

	$objPHPExcel->getActiveSheet()->SetCellValue("H28", $data[0][59]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H29", $data[0][60]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H30", $data[0][61]);

	$objPHPExcel->getActiveSheet()->SetCellValue("H32", $data[0][62]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H33", $data[0][63]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H34", $data[0][64]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H35", $data[0][65]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H36", $data[0][66]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H37", $data[0][67]);

	$objPHPExcel->getActiveSheet()->SetCellValue("H39", $data[0][68]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H40", $data[0][69]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H41", $data[0][70]);

	$objPHPExcel->getActiveSheet()->SetCellValue("H43", $data[0][71]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H44", $data[0][72]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H45", $data[0][73]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H46", $data[0][74]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H47", $data[0][75]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H48", $data[0][76]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H49", $data[0][77]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H50", $data[0][78]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H51", $data[0][79]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H53", $data[0][80]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H54", $data[0][81]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H55", $data[0][82]);

	$objPHPExcel->getActiveSheet()->SetCellValue("H58", $data[0][83]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H59", $data[0][84]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H60", $data[0][85]);

	$objPHPExcel->getActiveSheet()->SetCellValue("H62", $data[0][86]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H63", $data[0][87]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H64", $data[0][88]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H65", $data[0][89]);

	$objPHPExcel->getActiveSheet()->SetCellValue("H68", $data[0][90]);
	$objPHPExcel->getActiveSheet()->SetCellValue("H70", $data[0][106]);

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
