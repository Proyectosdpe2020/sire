<?php
session_start();
include ("../Conexiones/Conexion.php");
include("../funciones.php");
include("../funcionesCarpetasV2.php");


require_once 'librerias/PHPExcel.php';
include 'librerias/PHPExcel/IOFactory.php';

if (isset($_POST["unidad"])){ $unidad = $_POST["unidad"]; }
if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
if (isset($_POST["estNuc"])){ $estNuc = $_POST["estNuc"]; }

$idUsuario = $_SESSION['useridIE'];

if($anio == 0){ $queryanios = "anio > 2020"; }else{ $queryanios = "anio = $anio"; }
if($mes == 0){ $querymes = "mes IN(1,2,3,4,5,6,7,8,9,10,11,12)";}else{ $querymes  = "mes = $mes";}
if($estNuc == 0){$queryestatus = "idEstatus IN(1,22,2,5,20,21,3,23,24,25,15)";}else{ $queryestatus = "idEstatus = $estNuc";}


$datauser = getInfoEnlaceUsuario($conn, $idUsuario);
$idfis = $datauser[0][1];

$mesNom = Mes_Nombre($mes);
$nombrereporte = "nucsCarpetasInvestigacion-".$unidad."-".$mes."-".$anio;

$objPHPExcel = new PHPExcel();
$objReader = PHPExcel_IOFactory::createReader('Excel2007');

$plantilla = "plantillas/plantillaCarpetasNucs.xlsx";

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

$Inicio = "2";

		if($idEnlace == 18 || $idEnlace == 22 || $idEnlace == 16 || $idEnlace == 23 || $idEnlace == 19 || $idEnlace == 15 || $idEnlace == 21 || $idEnlace == 17 || $idEnlace == 14){

			if($unidad== 0){	

			if($idEnlace == 18){ $unidadedes = "IN(116,117,118,119)"; }
			if($idEnlace == 22){ $unidadedes = "IN(120,121,122,123,124,125)"; }
			if($idEnlace == 16){ $unidadedes = "IN(108,109,110,111,112,113,114,115,1008,1009,1010)"; }
			if($idEnlace == 23){ $unidadedes = "IN(71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,94,95,96,97,98)"; }
			
			if($idEnlace == 19){ $unidadedes = "IN(62,63,64,65,66,67,68,69,70,152,1005,1006,1050,1054)"; }
			if($idEnlace == 15){ $unidadedes = "IN(53,54,55,56,57,58,59,60,61,150,151)"; }
			if($idEnlace == 21){ $unidadedes = "IN(27,28,29,30,31,32,93,102,103)"; }
			if($idEnlace == 17){ $unidadedes = "IN(16,17,18,19,20,21,22,23,24,25,26,153,154)"; }
			if($idEnlace == 14){ $unidadedes = "IN(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,92,100,101)"; }

		}else{
			$unidadedes = "IN(".$unidad.")";
		}

		}else{
			$unidadEnlace = getUnidadEnlaceFormat($conn, $idEnlace, 1);
			$unidadedes = "IN(".$unidadEnlace[0][0].")";
		}

		if($unidad == 0 && $anio == 0 && $mes == 0 && $estNuc == 0){
			//// SE HACE UNA CONSULTA DE TODAS LAS DETERMINACIONES DEL USUARIO EN CURSO
				$allDataNucs = getAllDataNucs($conn, $unidadedes);
				for( $e=0; $e<sizeof($allDataNucs); $e++){
					$objPHPExcel->getActiveSheet()->SetCellValue("A$Inicio", $allDataNucs[$e][0]);
					$objPHPExcel->getActiveSheet()->SetCellValue("B$Inicio", $allDataNucs[$e][1]);
					$objPHPExcel->getActiveSheet()->SetCellValue("C$Inicio", $allDataNucs[$e][2]);
					$objPHPExcel->getActiveSheet()->SetCellValue("D$Inicio", $allDataNucs[$e][3]);
					$objPHPExcel->getActiveSheet()->SetCellValue("E$Inicio", $allDataNucs[$e][4]);
					$objPHPExcel->getActiveSheet()->SetCellValue("F$Inicio", $allDataNucs[$e][5]);
					$objPHPExcel->getActiveSheet()->SetCellValue("G$Inicio", $allDataNucs[$e][6]);
					$objPHPExcel->getActiveSheet()->SetCellValue("h$Inicio", $allDataNucs[$e][7]);
					$Inicio++;
				}

		}else{

			$allDataNucsOther = getAllDataNucsOther($conn, $queryanios, $querymes, $queryestatus, $unidadedes);
			for( $e=0; $e<sizeof($allDataNucsOther); $e++){
				$objPHPExcel->getActiveSheet()->SetCellValue("A$Inicio", $allDataNucsOther[$e][0]);
				$objPHPExcel->getActiveSheet()->SetCellValue("B$Inicio", $allDataNucsOther[$e][1]);
				$objPHPExcel->getActiveSheet()->SetCellValue("C$Inicio", $allDataNucsOther[$e][2]);
				$objPHPExcel->getActiveSheet()->SetCellValue("D$Inicio", $allDataNucsOther[$e][3]);
				$objPHPExcel->getActiveSheet()->SetCellValue("E$Inicio", $allDataNucsOther[$e][4]);
				$objPHPExcel->getActiveSheet()->SetCellValue("F$Inicio", $allDataNucsOther[$e][5]);
				$objPHPExcel->getActiveSheet()->SetCellValue("G$Inicio", $allDataNucsOther[$e][6]);
				$objPHPExcel->getActiveSheet()->SetCellValue("h$Inicio", $allDataNucsOther[$e][7]);
				$Inicio++;
			}
			
		}		
	
	
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
						$objWriter1->save(utf8_decode("downloadNucs/$nombre_reporte"));
