<?php
session_start();
include ("../Conexiones/Conexion.php");
include("../funciones.php");
include("../funcionesCarpetasV2.php");


require_once 'librerias/PHPExcel.php';
include 'librerias/PHPExcel/IOFactory.php';

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


$nombrereporte = "CarpetasInvestigacion-".$idUnidad."-".$mes."-".$anio;

$objPHPExcel = new PHPExcel();
$objReader = PHPExcel_IOFactory::createReader('Excel2007');

$plantilla = "plantillas/plantillaCarpetas.xlsx";

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


$objPHPExcel->getActiveSheet()->SetCellValue("C4", $mesNom);
$objPHPExcel->getActiveSheet()->SetCellValue("B5", $nomUnidadAnio);
$objPHPExcel->getActiveSheet()->SetCellValue("B6", $tituloFiscalia);

$Inicio = "11";

	/// se cambio de getMpsEnlaceUnidad a getsMpsENlace

	/*if($idfis == 4){ $mpsENlace=getMpsEnlace($conn, $idEnlace); }else{

			$mpsENlace=getMpsEnlaceUnidad($conn, $idEnlace, 1);

		}*/


		if($idEnlace == 18 || $idEnlace == 22 || $idEnlace == 16 || $idEnlace == 23 || $idEnlace == 19 || $idEnlace == 15 || $idEnlace == 21 || $idEnlace == 17 || $idEnlace == 14){


			if($idEnlace == 18){ $unidadedes = "IN(116,117,118,119)"; }
			if($idEnlace == 22){ $unidadedes = "IN(120,121,122,123,124,125)"; }
			if($idEnlace == 16){ $unidadedes = "IN(108,109,110,111,112,113,114,115,1008,1009,1010)"; }
			if($idEnlace == 23){ $unidadedes = "IN(71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,94,95,96,97,98)"; }
			
			if($idEnlace == 19){ $unidadedes = "IN(62,63,64,65,66,67,68,69,70,152,1005,1006,1050)"; }
			if($idEnlace == 15){ $unidadedes = "IN(53,54,55,56,57,58,59,60,61,150,151)"; }
			if($idEnlace == 21){ $unidadedes = "IN(27,28,29,30,31,32,93,102,103)"; }
			if($idEnlace == 17){ $unidadedes = "IN(16,17,18,19,20,21,22,23,24,25,26,153,154)"; }
			if($idEnlace == 14){ $unidadedes = "IN(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,92,100,101)"; }

			$mpsENlace = getDataMpsUniMesAnioUnids($conn, $unidadedes, $anio, $mes);	
			////// PARA LOS DATOS AGREGADOS A PARTIR DE JULIO 2021
			$datazx = getDatosCarpetasV2AllUnidad($conn, $mes, $anio, $unidadedes);

		}else{

			$mpsENlace = getDataMpsUniMesAnio($conn, $idUnidad, $anio, $mes);
			////// PARA LOS DATOS AGREGADOS A PARTIR DE JULIO 2021
			$unso = "IN(".$idUnidad.")";
			$datazx = getDatosCarpetasV2AllUnidad($conn, $mes, $anio, $unso);

		}



		$acum1= 0;		$acum2= 0;		$acum3= 0;		$acum4= 0;		$acum5= 0;		$acum6= 0;		$acum7= 0;		$acum8= 0;		$acum9= 0;		$acum10= 0;		$acum11= 0;		$acum12= 0;		$acum13= 0;		$acum14= 0;		$acum15= 0;		$acum16= 0;		$acum17= 0;		$acum18= 0;		$acum19= 0;		$acum20= 0;		$acum21= 0;		$acum22= 0; $acum23= 0; $acum24= 0;


		if($anio <= 2021 && $mes <= 6){



			///////////////////////////////// MENOR DE JULIO AL 2021 //////////////////



			for( $i=0; $i<sizeof($mpsENlace); $i++){


				$objPHPExcel->getActiveSheet()->getStyle("D$Inicio:AA$Inicio")->getAlignment()->setHorizontal(
					PHPExcel_Style_Alignment::HORIZONTAL_CENTER
				);

				$objPHPExcel->getActiveSheet()->getStyle("D$Inicio:AA$Inicio")->getAlignment()->setVertical(
					PHPExcel_Style_Alignment::VERTICAL_CENTER
				);


				$objPHPExcel->setActiveSheetIndex(0)->mergeCells("B$Inicio:C$Inicio");

		/////Variables
				$nomCompleto = $mpsENlace[$i][1];			

				$idUnidadMp = $mpsENlace[$i][27];
				$idMp = $mpsENlace[$i][26];


				$unidaddata = getNunidad($conn, $idUnidadMp);
				$nunid = $unidaddata[0][0];
				$unidadMp =  $nunid;



				$nomMpUnidad = 		$unidadMp.PHP_EOL."(   ".$nomCompleto."   )";
				$objPHPExcel->getActiveSheet()->SetCellValue("B$Inicio", $nomMpUnidad);

				$objPHPExcel->getActiveSheet()->getStyle("B$Inicio")->getFont()->setBold(true); 

				$objPHPExcel->getActiveSheet()->getStyle("B$Inicio")->getAlignment()->setHorizontal(
					PHPExcel_Style_Alignment::HORIZONTAL_CENTER
				);

				$objPHPExcel->getActiveSheet()->getStyle("B$Inicio")->getAlignment()->setVertical(
					PHPExcel_Style_Alignment::VERTICAL_CENTER
				);

				$objPHPExcel->getActiveSheet()->getStyle("B$Inicio")->getAlignment()->setWrapText(true);

		////PINTAR EL FORMATO DE LAS CELDAS
				$objPHPExcel->getActiveSheet()->getStyle("B$Inicio:AA$Inicio")->applyFromArray($BStyle);



				$carpeta = getInfoCarpeta($conn, $mes, $anio, $idUnidadMp, $idMp);




				for($j=0; $j<sizeof($carpeta); $j++){

					$objPHPExcel->getActiveSheet()->SetCellValue("D$Inicio", $carpeta[$j][0]);  $acum1 = $acum1 + $carpeta[$j][0];
					$objPHPExcel->getActiveSheet()->SetCellValue("E$Inicio", $carpeta[$j][1]);	$acum2 = $acum2 + $carpeta[$j][1];
					$objPHPExcel->getActiveSheet()->SetCellValue("F$Inicio", $carpeta[$j][2]);	$acum3 = $acum3 + $carpeta[$j][2];
					$objPHPExcel->getActiveSheet()->SetCellValue("G$Inicio", $carpeta[$j][3]);	$acum4 = $acum4 + $carpeta[$j][3];
					$objPHPExcel->getActiveSheet()->SetCellValue("H$Inicio", $carpeta[$j][26]);	$acum24 = $acum24 + $carpeta[$j][26];
					$objPHPExcel->getActiveSheet()->SetCellValue("I$Inicio", $carpeta[$j][4]);	$acum5 = $acum5 + $carpeta[$j][4];
					$objPHPExcel->getActiveSheet()->SetCellValue("J$Inicio", $carpeta[$j][5]);	$acum6 = $acum6 + $carpeta[$j][5];
					$objPHPExcel->getActiveSheet()->SetCellValue("K$Inicio", $carpeta[$j][6]);	$acum7 = $acum7 + $carpeta[$j][6];
					$objPHPExcel->getActiveSheet()->SetCellValue("L$Inicio", $carpeta[$j][7]);	$acum8 = $acum8 + $carpeta[$j][7];
					$objPHPExcel->getActiveSheet()->SetCellValue("M$Inicio", $carpeta[$j][8]);	$acum9 = $acum9 + $carpeta[$j][8];
					$objPHPExcel->getActiveSheet()->SetCellValue("N$Inicio", $carpeta[$j][9]);	$acum10 = $acum10 + $carpeta[$j][9];
					$objPHPExcel->getActiveSheet()->SetCellValue("O$Inicio", $carpeta[$j][10]);	$acum11 = $acum11 + $carpeta[$j][10];
					$objPHPExcel->getActiveSheet()->SetCellValue("P$Inicio", $carpeta[$j][11]);	$acum12 = $acum12 + $carpeta[$j][11];
					$objPHPExcel->getActiveSheet()->SetCellValue("Q$Inicio", $carpeta[$j][12]);	$acum13 = $acum13 + $carpeta[$j][12];
					$objPHPExcel->getActiveSheet()->SetCellValue("R$Inicio", $carpeta[$j][13]);	$acum14 = $acum14 + $carpeta[$j][13];
					$objPHPExcel->getActiveSheet()->SetCellValue("S$Inicio", $carpeta[$j][14]);	$acum15 = $acum15 + $carpeta[$j][14];
					$objPHPExcel->getActiveSheet()->SetCellValue("T$Inicio", $carpeta[$j][15]);	$acum16 = $acum16 + $carpeta[$j][15];
					$objPHPExcel->getActiveSheet()->SetCellValue("U$Inicio", $carpeta[$j][16]);	$acum17 = $acum17 + $carpeta[$j][16];
					$objPHPExcel->getActiveSheet()->SetCellValue("V$Inicio", $carpeta[$j][17]);	$acum18 = $acum18 + $carpeta[$j][17];
					$objPHPExcel->getActiveSheet()->SetCellValue("W$Inicio", $carpeta[$j][18]);	$acum19 = $acum19 + $carpeta[$j][18];
					$objPHPExcel->getActiveSheet()->SetCellValue("X$Inicio", $carpeta[$j][19]);	$acum20 = $acum20 + $carpeta[$j][19];
					$objPHPExcel->getActiveSheet()->SetCellValue("Y$Inicio", $carpeta[$j][20]);	$acum21 = $acum21 + $carpeta[$j][20];


					$objPHPExcel->getActiveSheet()->SetCellValue("Z$Inicio", $carpeta[$j][24]);	$acum22 = $acum22 + $carpeta[$j][24];
					$objPHPExcel->getActiveSheet()->SetCellValue("AA$Inicio", $carpeta[$j][21]);	$acum23 = $acum23 + $carpeta[$j][21];

				}


				$Inicio++;
			}




			$renglonquedado = $Inicio;
			$totales = $renglonquedado + 1;

			$objPHPExcel->getActiveSheet()->SetCellValue("B$totales", "TOTAL");

			$objPHPExcel->getActiveSheet()->getStyle("B$totales:c$totales")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2F2F2');
			$objPHPExcel->getActiveSheet()->getStyle("D$totales")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2F2F2');
			$objPHPExcel->getActiveSheet()->getStyle("E$totales:AA$totales")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('CCFFCC');

			$objPHPExcel->getActiveSheet()->getStyle("B$totales:AA$totales")->getAlignment()->setHorizontal(
				PHPExcel_Style_Alignment::HORIZONTAL_CENTER
			);

			$objPHPExcel->getActiveSheet()->getStyle("B$totales:AA$totales")->getAlignment()->setVertical(
				PHPExcel_Style_Alignment::VERTICAL_CENTER
			);

			$objPHPExcel->getActiveSheet()->SetCellValue("D$totales", $acum1);
			$objPHPExcel->getActiveSheet()->SetCellValue("E$totales", $acum2);
			$objPHPExcel->getActiveSheet()->SetCellValue("F$totales", $acum3);
			$objPHPExcel->getActiveSheet()->SetCellValue("G$totales", $acum4);
			$objPHPExcel->getActiveSheet()->SetCellValue("H$totales", $acum24);
			$objPHPExcel->getActiveSheet()->SetCellValue("I$totales", $acum5);
			$objPHPExcel->getActiveSheet()->SetCellValue("J$totales", $acum6);
			$objPHPExcel->getActiveSheet()->SetCellValue("K$totales", $acum7);
			$objPHPExcel->getActiveSheet()->SetCellValue("L$totales", $acum8);
			$objPHPExcel->getActiveSheet()->SetCellValue("M$totales", $acum9);
			$objPHPExcel->getActiveSheet()->SetCellValue("N$totales", $acum10);
			$objPHPExcel->getActiveSheet()->SetCellValue("O$totales", $acum11);
			$objPHPExcel->getActiveSheet()->SetCellValue("P$totales", $acum12);
			$objPHPExcel->getActiveSheet()->SetCellValue("Q$totales", $acum13);
			$objPHPExcel->getActiveSheet()->SetCellValue("R$totales", $acum14);
			$objPHPExcel->getActiveSheet()->SetCellValue("S$totales", $acum15);
			$objPHPExcel->getActiveSheet()->SetCellValue("T$totales", $acum16);
			$objPHPExcel->getActiveSheet()->SetCellValue("U$totales", $acum17);
			$objPHPExcel->getActiveSheet()->SetCellValue("V$totales", $acum18);
			$objPHPExcel->getActiveSheet()->SetCellValue("W$totales", $acum19);
			$objPHPExcel->getActiveSheet()->SetCellValue("X$totales", $acum20);
			$objPHPExcel->getActiveSheet()->SetCellValue("Y$totales", $acum21);
			$objPHPExcel->getActiveSheet()->SetCellValue("Z$totales", $acum22);
			$objPHPExcel->getActiveSheet()->SetCellValue("AA$totales", $acum23);

			$firma = $renglonquedado + 4;
			$nomTitularCargo = $firma +1;
			$nomTitular = $nomTitularCargo +1;

			$objPHPExcel->getActiveSheet()->getStyle("j$firma:p$firma")->applyFromArray($BStyle2);
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells("j$nomTitular:p$nomTitular");
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells("K$nomTitularCargo:O$nomTitularCargo");

			$objPHPExcel->getActiveSheet()->SetCellValue("K$nomTitularCargo", $cargot."\n".$nombreTT);	
			$objPHPExcel->getActiveSheet()->getStyle("k$nomTitularCargo")->getAlignment()->setWrapText(true);


			$objPHPExcel->getActiveSheet()->getStyle("k$nomTitularCargo:o$nomTitularCargo")->getAlignment()->setHorizontal(
				PHPExcel_Style_Alignment::HORIZONTAL_CENTER
			);

			$objPHPExcel->getActiveSheet()->getStyle("k$nomTitularCargo:o$nomTitularCargo")->getAlignment()->setVertical(
				PHPExcel_Style_Alignment::VERTICAL_CENTER
			);


			$objPHPExcel->getActiveSheet()->getStyle("B$totales:AA$totales")->applyFromArray($BStyle);
			$objPHPExcel->getActiveSheet()->SetCellValue("B$totales", "TOTAL");
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells("B$totales:C$totales");


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




			///////////////////////////////// MENOR DE JULIO AL 2021 //////////////////





		}else{


					/////////////////////////////////////////// EN CAMBIOOOO

			for( $i=0; $i<sizeof($datazx); $i++){


				$objPHPExcel->getActiveSheet()->getStyle("D$Inicio:AA$Inicio")->getAlignment()->setHorizontal(
					PHPExcel_Style_Alignment::HORIZONTAL_CENTER
				);

				$objPHPExcel->getActiveSheet()->getStyle("D$Inicio:AA$Inicio")->getAlignment()->setVertical(
					PHPExcel_Style_Alignment::VERTICAL_CENTER
				);


				$objPHPExcel->setActiveSheetIndex(0)->mergeCells("B$Inicio:C$Inicio");

		/////Variables
				$nomCompleto = $datazx[$i][9];			

				$idUnidadMp = $datazx[$i][7];
				$idMp = $datazx[$i][8];


				$unidaddata = getNunidad($conn, $idUnidadMp);
				$nunid = $unidaddata[0][0];
				$unidadMp =  $nunid;



				$nomMpUnidad = 		$unidadMp.PHP_EOL."(   ".$nomCompleto."   )";
				$objPHPExcel->getActiveSheet()->SetCellValue("B$Inicio", $nomMpUnidad);

				$objPHPExcel->getActiveSheet()->getStyle("B$Inicio")->getFont()->setBold(true); 

				$objPHPExcel->getActiveSheet()->getStyle("B$Inicio")->getAlignment()->setHorizontal(
					PHPExcel_Style_Alignment::HORIZONTAL_CENTER
				);

				$objPHPExcel->getActiveSheet()->getStyle("B$Inicio")->getAlignment()->setVertical(
					PHPExcel_Style_Alignment::VERTICAL_CENTER
				);

				$objPHPExcel->getActiveSheet()->getStyle("B$Inicio")->getAlignment()->setWrapText(true);

		////PINTAR EL FORMATO DE LAS CELDAS
				$objPHPExcel->getActiveSheet()->getStyle("B$Inicio:AA$Inicio")->applyFromArray($BStyle);



				$carpeta = getInfoCarpeta($conn, $mes, $anio, $idUnidadMp, $idMp);

				if($mes == 1){ $mesAnterior = 12; $anioAnte = ($anio-1); }else{ $anioAnte = $anio; $mesAnterior = ($mes - 1); 	}

				$existenciaAnt = getExistenciaAnterior($conn, $mesAnterior, $anioAnte, $idUnidadMp, $datazx[$i][8]);

				if($existenciaAnt){ 

					$tramiteAnte = $existenciaAnt[0][0];  
					$bandHabTramite = 0;
				}else{ 

					$tramiteAnte = 0; 
					$bandHabTramite = 1;

				}



				$d1 = getCountNucs($conn, 1, $mes, $anio, $datazx[$i][7], $datazx[$i][8], 0);/// ABIERTO REINICIADO

				$d2 = getCountNucs($conn, 22, $mes, $anio, $datazx[$i][7], $datazx[$i][8], 1); ///// ENVIADA A LITIGACION
				$d3 = getCountNucs($conn, 22, $mes, $anio, $datazx[$i][7], $datazx[$i][8], 0); //// ENVIADA A LITIGACION

				$d4 = getCountNucs($conn, 2, $mes, $anio, $datazx[$i][7], $datazx[$i][8], 0); /////// ABSTENCIONES
				$d5 = getCountNucs($conn, 5, $mes, $anio, $datazx[$i][7], $datazx[$i][8], 0); ////// ARCHIVO TEMPORAL
				$d6 = getCountNucs($conn, 20, $mes, $anio, $datazx[$i][7], $datazx[$i][8], 0); ////  NO EJERCICIO DE LA ACCION PENAL
				$d7 = getCountNucs($conn, 21, $mes, $anio, $datazx[$i][7], $datazx[$i][8], 0); ///// INCOMPETENCIA
				$d8 = getCountNucs($conn, 3, $mes, $anio, $datazx[$i][7], $datazx[$i][8], 0); //////// ACUMULACION
				$d9 = getCountNucs($conn, 23, $mes, $anio, $datazx[$i][7], $datazx[$i][8], 0); //////// MEDIACION
				$d10 = getCountNucs($conn, 24, $mes, $anio, $datazx[$i][7], $datazx[$i][8], 0);  //// CONCILIACION
				$d11 = getCountNucs($conn, 25, $mes, $anio, $datazx[$i][7], $datazx[$i][8], 0); ///// CRITERIOS DE OPORTUNIDAD
				$d12 = getCountNucs($conn, 15, $mes, $anio, $datazx[$i][7], $datazx[$i][8], 0); ///// SUSPENSION CONDICIONAL


					$totaTrabvajar = $tramiteAnte + $datazx[$i][6] + $d1[0][0] + $datazx[$i][2] ;
					$totjud = $d3[0][0] + $d2[0][0];

					$totDeterminaciones = $d2[0][0] + $d3[0][0] + $d4[0][0] + $d5[0][0] + $d6[0][0] + $d7[0][0] + $d8[0][0] + $d9[0][0] + $d10[0][0] + $d11[0][0] + $d12[0][0];


					$enviads = $datazx[$i][3] + $datazx[$i][4] + $datazx[$i][5];

									$enviaddetermns = $enviads + $totDeterminaciones;

									$totTramitss = $totaTrabvajar - $enviaddetermns;
			

					$objPHPExcel->getActiveSheet()->SetCellValue("D$Inicio", $tramiteAnte);  $acum1 = $acum1 + $tramiteAnte;

						$objPHPExcel->getActiveSheet()->SetCellValue("E$Inicio", $datazx[$i][0]);	$acum2 = $acum2 + $datazx[$i][0];
						$objPHPExcel->getActiveSheet()->SetCellValue("F$Inicio", $datazx[$i][1]);	$acum3 = $acum3 + $datazx[$i][1];
						$objPHPExcel->getActiveSheet()->SetCellValue("G$Inicio", $datazx[$i][6]);	$acum4 = $acum4 + $datazx[$i][6];

						$objPHPExcel->getActiveSheet()->SetCellValue("H$Inicio", $d1[0][0]);	$acum24 = $acum24 + $d1[0][0];
						$objPHPExcel->getActiveSheet()->SetCellValue("I$Inicio", $datazx[$i][2]);	$acum5 = $acum5 + $datazx[$i][2];

						$objPHPExcel->getActiveSheet()->SetCellValue("J$Inicio", $totaTrabvajar);	$acum6 = $acum6 + $totaTrabvajar;

						$objPHPExcel->getActiveSheet()->SetCellValue("K$Inicio", $d2[0][0]);	$acum7 = $acum7 + $d2[0][0];
						$objPHPExcel->getActiveSheet()->SetCellValue("L$Inicio", $d3[0][0]);	$acum8 = $acum8 + $d3[0][0];
						$objPHPExcel->getActiveSheet()->SetCellValue("M$Inicio", $totjud);	$acum9 = $acum9 + $totjud;

						$objPHPExcel->getActiveSheet()->SetCellValue("N$Inicio", $d4[0][0]);	$acum10 = $acum10 + $d4[0][0];
						$objPHPExcel->getActiveSheet()->SetCellValue("O$Inicio", $d5[0][0]);	$acum11 = $acum11 + $d5[0][0];
						$objPHPExcel->getActiveSheet()->SetCellValue("P$Inicio", $d6[0][0]);	$acum12 = $acum12 + $d6[0][0];

						$objPHPExcel->getActiveSheet()->SetCellValue("Q$Inicio", $d9[0][0]);	$acum13 = $acum13 + $d9[0][0];

						$objPHPExcel->getActiveSheet()->SetCellValue("R$Inicio", $d10[0][0]);	$acum14 = $acum14 + $d10[0][0];

						$objPHPExcel->getActiveSheet()->SetCellValue("S$Inicio", $d11[0][0]);	$acum15 = $acum15 + $d11[0][0];

						$objPHPExcel->getActiveSheet()->SetCellValue("T$Inicio", $d12[0][0]);	$acum16 = $acum16 + $d12[0][0];
						$objPHPExcel->getActiveSheet()->SetCellValue("U$Inicio", $d7[0][0]);	$acum17 = $acum17 + $d7[0][0];
						$objPHPExcel->getActiveSheet()->SetCellValue("V$Inicio", $d8[0][0]);	$acum18 = $acum18 + $d8[0][0];

						$objPHPExcel->getActiveSheet()->SetCellValue("W$Inicio", $totDeterminaciones);	$acum19 = $acum19 + $totDeterminaciones;

						$objPHPExcel->getActiveSheet()->SetCellValue("X$Inicio", $datazx[$i][3]);	$acum20 = $acum20 + $datazx[$i][3];
						$objPHPExcel->getActiveSheet()->SetCellValue("Y$Inicio", $datazx[$i][4]);	$acum21 = $acum21 + $datazx[$i][4];
						$objPHPExcel->getActiveSheet()->SetCellValue("Z$Inicio", $datazx[$i][5]);	$acum22 = $acum22 + $datazx[$i][5];

						$objPHPExcel->getActiveSheet()->SetCellValue("AA$Inicio", $totTramitss);	$acum23 = $acum23 + $totTramitss;

					


					$Inicio++;
				}




				$renglonquedado = $Inicio;
				$totales = $renglonquedado + 1;

				$objPHPExcel->getActiveSheet()->SetCellValue("B$totales", "TOTAL");

				$objPHPExcel->getActiveSheet()->getStyle("B$totales:c$totales")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2F2F2');
				$objPHPExcel->getActiveSheet()->getStyle("D$totales")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2F2F2');
				$objPHPExcel->getActiveSheet()->getStyle("E$totales:AA$totales")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('CCFFCC');

				$objPHPExcel->getActiveSheet()->getStyle("B$totales:AA$totales")->getAlignment()->setHorizontal(
					PHPExcel_Style_Alignment::HORIZONTAL_CENTER
				);

				$objPHPExcel->getActiveSheet()->getStyle("B$totales:AA$totales")->getAlignment()->setVertical(
					PHPExcel_Style_Alignment::VERTICAL_CENTER
				);

				$objPHPExcel->getActiveSheet()->SetCellValue("D$totales", $acum1);
				$objPHPExcel->getActiveSheet()->SetCellValue("E$totales", $acum2);
				$objPHPExcel->getActiveSheet()->SetCellValue("F$totales", $acum3);
				$objPHPExcel->getActiveSheet()->SetCellValue("G$totales", $acum4);
				$objPHPExcel->getActiveSheet()->SetCellValue("H$totales", $acum24);
				$objPHPExcel->getActiveSheet()->SetCellValue("I$totales", $acum5);
				$objPHPExcel->getActiveSheet()->SetCellValue("J$totales", $acum6);
				$objPHPExcel->getActiveSheet()->SetCellValue("K$totales", $acum7);
				$objPHPExcel->getActiveSheet()->SetCellValue("L$totales", $acum8);
				$objPHPExcel->getActiveSheet()->SetCellValue("M$totales", $acum9);
				$objPHPExcel->getActiveSheet()->SetCellValue("N$totales", $acum10);
				$objPHPExcel->getActiveSheet()->SetCellValue("O$totales", $acum11);
				$objPHPExcel->getActiveSheet()->SetCellValue("P$totales", $acum12);
				$objPHPExcel->getActiveSheet()->SetCellValue("Q$totales", $acum13);
				$objPHPExcel->getActiveSheet()->SetCellValue("R$totales", $acum14);
				$objPHPExcel->getActiveSheet()->SetCellValue("S$totales", $acum15);
				$objPHPExcel->getActiveSheet()->SetCellValue("T$totales", $acum16);
				$objPHPExcel->getActiveSheet()->SetCellValue("U$totales", $acum17);
				$objPHPExcel->getActiveSheet()->SetCellValue("V$totales", $acum18);
				$objPHPExcel->getActiveSheet()->SetCellValue("W$totales", $acum19);
				$objPHPExcel->getActiveSheet()->SetCellValue("X$totales", $acum20);
				$objPHPExcel->getActiveSheet()->SetCellValue("Y$totales", $acum21);
				$objPHPExcel->getActiveSheet()->SetCellValue("Z$totales", $acum22);
				$objPHPExcel->getActiveSheet()->SetCellValue("AA$totales", $acum23);

				$firma = $renglonquedado + 4;
				$nomTitularCargo = $firma +1;
				$nomTitular = $nomTitularCargo +1;

				$objPHPExcel->getActiveSheet()->getStyle("j$firma:p$firma")->applyFromArray($BStyle2);
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells("j$nomTitular:p$nomTitular");
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells("K$nomTitularCargo:O$nomTitularCargo");

				$objPHPExcel->getActiveSheet()->SetCellValue("K$nomTitularCargo", $cargot."\n".$nombreTT);	
				$objPHPExcel->getActiveSheet()->getStyle("k$nomTitularCargo")->getAlignment()->setWrapText(true);


				$objPHPExcel->getActiveSheet()->getStyle("k$nomTitularCargo:o$nomTitularCargo")->getAlignment()->setHorizontal(
					PHPExcel_Style_Alignment::HORIZONTAL_CENTER
				);

				$objPHPExcel->getActiveSheet()->getStyle("k$nomTitularCargo:o$nomTitularCargo")->getAlignment()->setVertical(
					PHPExcel_Style_Alignment::VERTICAL_CENTER
				);


				$objPHPExcel->getActiveSheet()->getStyle("B$totales:AA$totales")->applyFromArray($BStyle);
				$objPHPExcel->getActiveSheet()->SetCellValue("B$totales", "TOTAL");
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells("B$totales:C$totales");


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


			$objWriter1 = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter1->save(utf8_decode("downloadReport/$nombre_reporte"));




			///////////////////////////////////////////// EN CAMBIOOOO



			}






			?>
