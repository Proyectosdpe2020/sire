<?php
session_start();
//include("../../Conexiones/Conexion.php");
include("../../Conexiones/ConexionSIRE.php");
include("../../funciones.php");
include("../../funcionesProcesosPenales.php");


require_once '../librerias/PHPExcel.php';
include '../librerias/PHPExcel/IOFactory.php';



if (isset($_GET["mesIni"])) {
	$mesIni = $_GET["mesIni"];
}
if (isset($_GET["anioIni"])) {
	$anioIni = $_GET["anioIni"];
}
if (isset($_GET["mesFin"])) {
	$mesFin = $_GET["mesFin"];
}
if (isset($_GET["anioFin"])) {
	$anioFin = $_GET["anioFin"];
}
if (isset($_GET["idFiscalia"])) {
	$idFiscalia = $_GET["idFiscalia"];
}
if (isset($_GET["juzgado"])) {
	$juzgado = $_GET["juzgado"];
}


if ($idFiscalia == 1) {
	$fisname = "Fiscalía Regional de Apatzingan";
}
if ($idFiscalia == 2) {
	$fisname = "Fiscalía Regional de La Piedad";
}
if ($idFiscalia == 3) {
	$fisname = "Fiscalía Regional de Lázaro Cárdenas";
}
if ($idFiscalia == 4) {
	$fisname = "Fiscalía Regional de Morelia";
}
if ($idFiscalia == 5) {
	$fisname = "Fiscalía Regional de Uruapan";
}
if ($idFiscalia == 6) {
	$fisname = "Fiscalía Regional de Zamora";
}
if ($idFiscalia == 7) {
	$fisname = "Fiscalía Regional de Zitácuaro";
}
if ($idFiscalia == 8) {
	$fisname = "Fiscalía Regional de Coalcoman";
}
if ($idFiscalia == 9) {
	$fisname = "Fiscalía Regional de Huetamo";
}
if ($idFiscalia == 10) {
	$fisname = "Fiscalía Regional de Jiquilpan";
}
if ($idFiscalia == 0) {
	$fisname = "Todas las Fiscalias";
}
//$mesNom = Mes_Nombre($mes);
if ($idFiscalia == 0) {
	$nameJuz = "Acumulado Estatal";
} else {
	$n = getNameJuzgadoPenal($conn, $juzgado);
	$nameJuz = $n[0][1];
}

$meInis = Mes_Nombre($mesIni);
$meFins = Mes_Nombre($mesFin);

$periodo = $meInis . "-" . $anioIni . " A " . $meFins . " " . $anioFin;


$objPHPExcel = new PHPExcel();
$objReader = PHPExcel_IOFactory::createReader('Excel2007');

$plantilla = "plantillas/plantillaProcesosPenales.xlsx";

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

$ain = $anioIni;
$afi = $anioFin;

//////// AQUI PROCESO PARA CONTAR LOS NUMEROS  /////////
$anioIniSelected = $anioIni;
$anioFinSelected = $anioFin;

$anioIni = intVal($anioIni);
$anioFin = intVal($anioFin);

$ain = $anioIni;
$afi = $anioFin;

//// construir array de diferencia de años 
$arrayAnios = array();
$indic = 0;

for ($f = $ain; $f <= $afi; $f++) {
	$arrayAnios[$indic] = intVal($ain);
	$indic++;
	$ain++;
}


///// recorrer arreglo de anios y contando meses de cada anio

$indice = 0;
//// FOR QUE LLENA LAS AUDIENCIAS ////


$arrHojas = array("ACUM PROCESOS 1", "ACUM PROCESOS 2", "ACUM PROCESOS 3", "ACUM PROCESOS 4", "ACUM PROCESOS 5");

for ($a = 0; $a < sizeof($arrHojas); $a++) {

	//// ESTABLECE EN QUE HOJA SE VA A INSERTAR EL CONTENIDO 


	if ($a == 0) {
		$objPHPExcel->setActiveSheetIndexByName($arrHojas[$a]);
		$objPHPExcel->getActiveSheet()->SetCellValue("B5", $fisname);
		$objPHPExcel->getActiveSheet()->SetCellValue("N4", $periodo);

		if ($idFiscalia == 0) {

			$IDSFISCALIAS = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
			$nameFiscalias = array("Apatzingan", "La Piedad", "Lázaro Cárdenas", "Morelia", "Uruapan", "Zamora", "Zítacuaro", "Coalcoman", "Huetamo", "Jiquilpan");
			$renInicio = "11";
			for ($r = 0; $r < sizeof($IDSFISCALIAS); $r++) {
				$objPHPExcel->getActiveSheet()->SetCellValue("C" . $renInicio, $nameFiscalias[$r]);
				$arraySumas = array(
					0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
				);


				/////////FISCALIAS CEROS Y REPORTE DE ESTADO ////////////////////
				/////////////////////// FOR ///////////////////////
				for ($j = 0; $j < sizeof($arrayAnios); $j++) {
					$lastAnio = $arrayAnios[sizeof($arrayAnios) - 1];
					///// DESARROLLAR EL METODO PARA QUE TOME TODOS LOS MESES DE LOS AÑOS ENTRE EL RANGO 
					for ($i = 0; $i < 12; $i++) {
						if ($arrayAnios[$j] == $anioIniSelected) {

							if ($mesIni == $mesFin && $anioIniSelected == $anioFinSelected) {

								if (($i + 1) == $mesIni) {
									if ($idFiscalia == 0) {

										$data = getRegistrosProcesosPenalesDataEstatalXfiscalia($conn, $mesIni, $anioIniSelected, $IDSFISCALIAS[$r]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[0]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[2]));
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[3]));

										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[4]));

										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[5]));
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, number_format($arraySumas[6]));
										$objPHPExcel->getActiveSheet()->SetCellValue("K" . $renInicio, number_format($arraySumas[7]));
										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, number_format($arraySumas[9]));
										$objPHPExcel->getActiveSheet()->SetCellValue("M" . $renInicio, number_format($arraySumas[11]));

										$objPHPExcel->getActiveSheet()->SetCellValue("N" . $renInicio, number_format($arraySumas[12]));
										$objPHPExcel->getActiveSheet()->SetCellValue("O" . $renInicio, number_format($arraySumas[13]));
										$objPHPExcel->getActiveSheet()->SetCellValue("P" . $renInicio, number_format($arraySumas[15]));
										$objPHPExcel->getActiveSheet()->SetCellValue("Q" . $renInicio, number_format($arraySumas[17]));
										$objPHPExcel->getActiveSheet()->SetCellValue("R" . $renInicio, number_format($arraySumas[19]));
									} else {
										//$data = getRegistrosProcesosPenalesData($conn, $mesIni, $anioIniSelected, $idFiscalia, $juzgados[$r][0]);

									}
								}
							} else {
								if ($mesIni == ($i + 1) or $mesIni <= ($i + 1)) {

									if ($idFiscalia == 0) {
										$data = getRegistrosProcesosPenalesDataEstatalXfiscalia($conn, $i + 1, $arrayAnios[0], $IDSFISCALIAS[$r]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[0]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[2]));
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[3]));

										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[4]));

										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[5]));
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, number_format($arraySumas[6]));
										$objPHPExcel->getActiveSheet()->SetCellValue("K" . $renInicio, number_format($arraySumas[7]));
										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, number_format($arraySumas[9]));
										$objPHPExcel->getActiveSheet()->SetCellValue("M" . $renInicio, number_format($arraySumas[11]));

										$objPHPExcel->getActiveSheet()->SetCellValue("N" . $renInicio, number_format($arraySumas[12]));
										$objPHPExcel->getActiveSheet()->SetCellValue("O" . $renInicio, number_format($arraySumas[13]));
										$objPHPExcel->getActiveSheet()->SetCellValue("P" . $renInicio, number_format($arraySumas[15]));
										$objPHPExcel->getActiveSheet()->SetCellValue("Q" . $renInicio, number_format($arraySumas[17]));
										$objPHPExcel->getActiveSheet()->SetCellValue("R" . $renInicio, number_format($arraySumas[19]));
									} else {
										//$data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[0], $idFiscalia, $juzgados[$r][0]);

									}
								}
							}
						} else {
							if ($arrayAnios[$j] == $lastAnio) {

								if ($mesFin >= ($i + 1)) {
									if ($idFiscalia == 0) {
										$data = getRegistrosProcesosPenalesDataEstatalXfiscalia($conn, $i + 1, $arrayAnios[sizeof($arrayAnios) - 1], $IDSFISCALIAS[$r]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[0]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[2]));
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[3]));

										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[4]));

										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[5]));
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, number_format($arraySumas[6]));
										$objPHPExcel->getActiveSheet()->SetCellValue("K" . $renInicio, number_format($arraySumas[7]));
										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, number_format($arraySumas[9]));
										$objPHPExcel->getActiveSheet()->SetCellValue("M" . $renInicio, number_format($arraySumas[11]));

										$objPHPExcel->getActiveSheet()->SetCellValue("N" . $renInicio, number_format($arraySumas[12]));
										$objPHPExcel->getActiveSheet()->SetCellValue("O" . $renInicio, number_format($arraySumas[13]));
										$objPHPExcel->getActiveSheet()->SetCellValue("P" . $renInicio, number_format($arraySumas[15]));
										$objPHPExcel->getActiveSheet()->SetCellValue("Q" . $renInicio, number_format($arraySumas[17]));
										$objPHPExcel->getActiveSheet()->SetCellValue("R" . $renInicio, number_format($arraySumas[19]));
									} else {
										//$data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[sizeof($arrayAnios) - 1], $idFiscalia, $juzgados[$r][0]);									
									}
								}
							} else {
								if ($arrayAnios[$j] != $anioIniSelected or $arrayAnios[$j] != $lastAnio) {

									if ($idFiscalia == 0) {
										$data = getRegistrosProcesosPenalesDataEstatalXfiscalia($conn, $i + 1, $arrayAnios[$j], $IDSFISCALIAS[$r]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[0]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[2]));
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[3]));

										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[4]));

										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[5]));
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, number_format($arraySumas[6]));
										$objPHPExcel->getActiveSheet()->SetCellValue("K" . $renInicio, number_format($arraySumas[7]));
										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, number_format($arraySumas[9]));
										$objPHPExcel->getActiveSheet()->SetCellValue("M" . $renInicio, number_format($arraySumas[11]));

										$objPHPExcel->getActiveSheet()->SetCellValue("N" . $renInicio, number_format($arraySumas[12]));
										$objPHPExcel->getActiveSheet()->SetCellValue("O" . $renInicio, number_format($arraySumas[13]));
										$objPHPExcel->getActiveSheet()->SetCellValue("P" . $renInicio, number_format($arraySumas[15]));
										$objPHPExcel->getActiveSheet()->SetCellValue("Q" . $renInicio, number_format($arraySumas[17]));
										$objPHPExcel->getActiveSheet()->SetCellValue("R" . $renInicio, number_format($arraySumas[19]));
									} else {
										//$data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[$j], $idFiscalia, $juzgados[$r][0]);

									}
								}
							}
						}
					} /// FIN FOR
				}
				$renInicio++;
				////////////////////// FOR  ///////////////////////
				/////////FISCALIAS CEROS Y REPORTE DE ESTADO ////////////////////
			}
		} else {


			$juzgados  = getJuzgadoXfiscalia($conn, $idFiscalia);

			$renInicio = "11";
			for ($r = 0; $r < sizeof($juzgados); $r++) {

				$objPHPExcel->getActiveSheet()->SetCellValue("C" . $renInicio, $juzgados[$r][1]);

				$arraySumas = array(
					0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
				);
				/////////////////////// FOR ///////////////////////
				for ($j = 0; $j < sizeof($arrayAnios); $j++) {
					$lastAnio = $arrayAnios[sizeof($arrayAnios) - 1];
					///// DESARROLLAR EL METODO PARA QUE TOME TODOS LOS MESES DE LOS AÑOS ENTRE EL RANGO 
					for ($i = 0; $i < 12; $i++) {
						if ($arrayAnios[$j] == $anioIniSelected) {

							if ($mesIni == $mesFin && $anioIniSelected == $anioFinSelected) {

								if (($i + 1) == $mesIni) {
									if ($juzgados[$r][0] == 0) {
										//$data = getRegistrosSalasPenalesDataEstatal($conn, $mesIni, $anioIniSelected, $idFiscalia);
									} else {
										$data = getRegistrosProcesosPenalesData($conn, $mesIni, $anioIniSelected, $idFiscalia, $juzgados[$r][0]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[0]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[2]));
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[3]));

										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[4]));

										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[5]));
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, number_format($arraySumas[6]));
										$objPHPExcel->getActiveSheet()->SetCellValue("K" . $renInicio, number_format($arraySumas[7]));
										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, number_format($arraySumas[9]));
										$objPHPExcel->getActiveSheet()->SetCellValue("M" . $renInicio, number_format($arraySumas[11]));

										$objPHPExcel->getActiveSheet()->SetCellValue("N" . $renInicio, number_format($arraySumas[12]));
										$objPHPExcel->getActiveSheet()->SetCellValue("O" . $renInicio, number_format($arraySumas[13]));
										$objPHPExcel->getActiveSheet()->SetCellValue("P" . $renInicio, number_format($arraySumas[15]));
										$objPHPExcel->getActiveSheet()->SetCellValue("Q" . $renInicio, number_format($arraySumas[17]));
										$objPHPExcel->getActiveSheet()->SetCellValue("R" . $renInicio, number_format($arraySumas[19]));
									}
								}
							} else {



								// if ($mesIni == ($i + 1) or $mesIni <= ($i + 1)) {
								if ($mesIni == ($i + 1) or ($i + 1) <= $mesFin) {
									if ($juzgados[$r][0] == 0) {
										//$data = getRegistrosSalasPenalesDataEstatal($conn, $i + 1, $arrayAnios[0], $idFiscalia);
									} else {
										$data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[0], $idFiscalia, $juzgados[$r][0]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[0]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[2]));
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[3]));

										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[4]));

										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[5]));
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, number_format($arraySumas[6]));
										$objPHPExcel->getActiveSheet()->SetCellValue("K" . $renInicio, number_format($arraySumas[7]));
										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, number_format($arraySumas[9]));
										$objPHPExcel->getActiveSheet()->SetCellValue("M" . $renInicio, number_format($arraySumas[11]));

										$objPHPExcel->getActiveSheet()->SetCellValue("N" . $renInicio, number_format($arraySumas[12]));
										$objPHPExcel->getActiveSheet()->SetCellValue("O" . $renInicio, number_format($arraySumas[13]));
										$objPHPExcel->getActiveSheet()->SetCellValue("P" . $renInicio, number_format($arraySumas[15]));
										$objPHPExcel->getActiveSheet()->SetCellValue("Q" . $renInicio, number_format($arraySumas[17]));
										$objPHPExcel->getActiveSheet()->SetCellValue("R" . $renInicio, number_format($arraySumas[19]));
									}
								}
							}
						} else {
							if ($arrayAnios[$j] == $lastAnio) {

								if ($mesFin >= ($i + 1)) {
									if ($juzgados[$r][0] == 0) {
										//$data = getRegistrosSalasPenalesDataEstatal($conn, $i + 1, $arrayAnios[sizeof($arrayAnios) - 1], $idFiscalia);
									} else {
										$data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[sizeof($arrayAnios) - 1], $idFiscalia, $juzgados[$r][0]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[0]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[2]));
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[3]));

										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[4]));

										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[5]));
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, number_format($arraySumas[6]));
										$objPHPExcel->getActiveSheet()->SetCellValue("K" . $renInicio, number_format($arraySumas[7]));
										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, number_format($arraySumas[9]));
										$objPHPExcel->getActiveSheet()->SetCellValue("M" . $renInicio, number_format($arraySumas[11]));

										$objPHPExcel->getActiveSheet()->SetCellValue("N" . $renInicio, number_format($arraySumas[12]));
										$objPHPExcel->getActiveSheet()->SetCellValue("O" . $renInicio, number_format($arraySumas[13]));
										$objPHPExcel->getActiveSheet()->SetCellValue("P" . $renInicio, number_format($arraySumas[15]));
										$objPHPExcel->getActiveSheet()->SetCellValue("Q" . $renInicio, number_format($arraySumas[17]));
										$objPHPExcel->getActiveSheet()->SetCellValue("R" . $renInicio, number_format($arraySumas[19]));
									}
								}
							} else {
								if ($arrayAnios[$j] != $anioIniSelected or $arrayAnios[$j] != $lastAnio) {

									if ($juzgados[$r][0] == 0) {
										//$data = getRegistrosSalasPenalesDataEstatal($conn, $i + 1, $arrayAnios[$j], $idFiscalia);
									} else {
										$data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[$j], $idFiscalia, $juzgados[$r][0]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[0]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[2]));
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[3]));

										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[4]));

										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[5]));
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, number_format($arraySumas[6]));
										$objPHPExcel->getActiveSheet()->SetCellValue("K" . $renInicio, number_format($arraySumas[7]));
										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, number_format($arraySumas[9]));
										$objPHPExcel->getActiveSheet()->SetCellValue("M" . $renInicio, number_format($arraySumas[11]));

										$objPHPExcel->getActiveSheet()->SetCellValue("N" . $renInicio, number_format($arraySumas[12]));
										$objPHPExcel->getActiveSheet()->SetCellValue("O" . $renInicio, number_format($arraySumas[13]));
										$objPHPExcel->getActiveSheet()->SetCellValue("P" . $renInicio, number_format($arraySumas[15]));
										$objPHPExcel->getActiveSheet()->SetCellValue("Q" . $renInicio, number_format($arraySumas[17]));
										$objPHPExcel->getActiveSheet()->SetCellValue("R" . $renInicio, number_format($arraySumas[19]));
									}
								}
							}
						}
					} /// FIN FOR


				}

				$renInicio++;
				////////////////////// FOR  ///////////////////////


			}
		}
	}

	if ($a == 1) {
		$objPHPExcel->setActiveSheetIndexByName($arrHojas[$a]);
		$objPHPExcel->getActiveSheet()->SetCellValue("B5", $fisname);
		$objPHPExcel->getActiveSheet()->SetCellValue("K4", $periodo);

		if ($idFiscalia == 0) {

			$IDSFISCALIAS = array(1, 2, 3, 4, 5, 6, 7);
			$nameFiscalias = array("Apatzingan", "La Piedad", "Lázaro Cárdenas", "Morelia", "Uruapan", "Zamora", "Zítacuaro");

			//$juzgados  = getJuzgadoXfiscalia($conn, $idFiscalia);

			$renInicio = "11";
			for ($r = 0; $r < sizeof($IDSFISCALIAS); $r++) {

				$objPHPExcel->getActiveSheet()->SetCellValue("C" . $renInicio, $nameFiscalias[$r]);

				$arraySumas = array(
					0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
				);
				/////////////////////// FOR ///////////////////////
				for ($j = 0; $j < sizeof($arrayAnios); $j++) {
					$lastAnio = $arrayAnios[sizeof($arrayAnios) - 1];
					///// DESARROLLAR EL METODO PARA QUE TOME TODOS LOS MESES DE LOS AÑOS ENTRE EL RANGO 
					for ($i = 0; $i < 12; $i++) {
						if ($arrayAnios[$j] == $anioIniSelected) {

							if ($mesIni == $mesFin && $anioIniSelected == $anioFinSelected) {

								if (($i + 1) == $mesIni) {
									if ($idFiscalia == 0) {
										$data = getRegistrosProcesosPenalesDataEstatalXfiscalia($conn, $mesIni, $anioIniSelected, $IDSFISCALIAS[$r]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[44]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[45]));

										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[46]));
										$objPHPExcel->getActiveSheet()->SetCellValue("G" . $renInicio, number_format($arraySumas[48]));
										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[50]));
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[52]));
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, number_format($arraySumas[53]));

										$objPHPExcel->getActiveSheet()->SetCellValue("K" . $renInicio, number_format($arraySumas[54]));
										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, number_format($arraySumas[56]));
									} else {
										// $data = getRegistrosProcesosPenalesData($conn, $mesIni, $anioIniSelected, $idFiscalia, $IDSFISCALIAS[$r]);

									}
								}
							} else {
								if ($mesIni == ($i + 1) or $mesIni <= ($i + 1)) {

									if ($idFiscalia == 0) {
										$data = getRegistrosProcesosPenalesDataEstatalXfiscalia($conn, $i + 1, $arrayAnios[0], $IDSFISCALIAS[$r]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[44]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[45]));

										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[46]));
										$objPHPExcel->getActiveSheet()->SetCellValue("G" . $renInicio, number_format($arraySumas[48]));
										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[50]));
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[52]));
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, number_format($arraySumas[53]));

										$objPHPExcel->getActiveSheet()->SetCellValue("K" . $renInicio, number_format($arraySumas[54]));
										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, number_format($arraySumas[56]));
									} else {
										// $data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[0], $idFiscalia, $IDSFISCALIAS[$r]);

									}
								}
							}
						} else {
							if ($arrayAnios[$j] == $lastAnio) {

								if ($mesFin >= ($i + 1)) {
									if ($idFiscalia == 0) {
										$data = getRegistrosProcesosPenalesDataEstatalXfiscalia($conn, $i + 1, $arrayAnios[sizeof($arrayAnios) - 1], $IDSFISCALIAS[$r]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[44]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[45]));

										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[46]));
										$objPHPExcel->getActiveSheet()->SetCellValue("G" . $renInicio, number_format($arraySumas[48]));
										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[50]));
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[52]));
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, number_format($arraySumas[53]));

										$objPHPExcel->getActiveSheet()->SetCellValue("K" . $renInicio, number_format($arraySumas[54]));
										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, number_format($arraySumas[56]));
									} else {
										// $data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[sizeof($arrayAnios) - 1], $idFiscalia, $IDSFISCALIAS[$r]);

									}
								}
							} else {
								if ($arrayAnios[$j] != $anioIniSelected or $arrayAnios[$j] != $lastAnio) {

									if ($idFiscalia == 0) {
										$data = getRegistrosProcesosPenalesDataEstatalXfiscalia($conn, $i + 1, $arrayAnios[$j], $IDSFISCALIAS[$r]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[44]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[45]));

										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[46]));
										$objPHPExcel->getActiveSheet()->SetCellValue("G" . $renInicio, number_format($arraySumas[48]));
										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[50]));
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[52]));
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, number_format($arraySumas[53]));

										$objPHPExcel->getActiveSheet()->SetCellValue("K" . $renInicio, number_format($arraySumas[54]));
										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, number_format($arraySumas[56]));
									} else {
										// $data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[$j], $idFiscalia, $juzgados[$r][0]);

									}
								}
							}
						}
					} /// FIN FOR


				}
				$renInicio++;
				////////////////////// FOR  ///////////////////////
			}
		} else {

			$juzgados  = getJuzgadoXfiscalia($conn, $idFiscalia);

			$renInicio = "11";
			for ($r = 0; $r < sizeof($juzgados); $r++) {

				$objPHPExcel->getActiveSheet()->SetCellValue("C" . $renInicio, $juzgados[$r][1]);

				$arraySumas = array(
					0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
				);
				/////////////////////// FOR ///////////////////////
				for ($j = 0; $j < sizeof($arrayAnios); $j++) {
					$lastAnio = $arrayAnios[sizeof($arrayAnios) - 1];
					///// DESARROLLAR EL METODO PARA QUE TOME TODOS LOS MESES DE LOS AÑOS ENTRE EL RANGO 
					for ($i = 0; $i < 12; $i++) {
						if ($arrayAnios[$j] == $anioIniSelected) {

							if ($mesIni == $mesFin && $anioIniSelected == $anioFinSelected) {

								if (($i + 1) == $mesIni) {
									if ($juzgados[$r][0] == 0) {
										//$data = getRegistrosSalasPenalesDataEstatal($conn, $mesIni, $anioIniSelected, $idFiscalia);
									} else {

										$data = getRegistrosProcesosPenalesData($conn, $mesIni, $anioIniSelected, $idFiscalia, $juzgados[$r][0]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[44]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[45]));

										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[46]));
										$objPHPExcel->getActiveSheet()->SetCellValue("G" . $renInicio, number_format($arraySumas[48]));
										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[50]));
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[52]));
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, number_format($arraySumas[53]));

										$objPHPExcel->getActiveSheet()->SetCellValue("K" . $renInicio, number_format($arraySumas[54]));
										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, number_format($arraySumas[56]));
									}
								}
							} else {



								// if ($mesIni == ($i + 1) or $mesIni <= ($i + 1)) {
									if ($mesIni == ($i + 1) or ($i+1) <= $mesFin) {		
									if ($juzgados[$r][0] == 0) {
										//$data = getRegistrosSalasPenalesDataEstatal($conn, $i + 1, $arrayAnios[0], $idFiscalia);
									} else {
										$data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[0], $idFiscalia, $juzgados[$r][0]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[44]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[45]));

										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[46]));
										$objPHPExcel->getActiveSheet()->SetCellValue("G" . $renInicio, number_format($arraySumas[48]));
										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[50]));
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[52]));
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, number_format($arraySumas[53]));

										$objPHPExcel->getActiveSheet()->SetCellValue("K" . $renInicio, number_format($arraySumas[54]));
										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, number_format($arraySumas[56]));
									}
								}
							}
						} else {
							if ($arrayAnios[$j] == $lastAnio) {

								if ($mesFin >= ($i + 1)) {
									if ($juzgados[$r][0] == 0) {
										//$data = getRegistrosSalasPenalesDataEstatal($conn, $i + 1, $arrayAnios[sizeof($arrayAnios) - 1], $idFiscalia);
									} else {
										$data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[sizeof($arrayAnios) - 1], $idFiscalia, $juzgados[$r][0]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[44]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[45]));

										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[46]));
										$objPHPExcel->getActiveSheet()->SetCellValue("G" . $renInicio, number_format($arraySumas[48]));
										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[50]));
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[52]));
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, number_format($arraySumas[53]));

										$objPHPExcel->getActiveSheet()->SetCellValue("K" . $renInicio, number_format($arraySumas[54]));
										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, number_format($arraySumas[56]));
									}
								}
							} else {
								if ($arrayAnios[$j] != $anioIniSelected or $arrayAnios[$j] != $lastAnio) {

									if ($juzgados[$r][0] == 0) {
										//$data = getRegistrosSalasPenalesDataEstatal($conn, $i + 1, $arrayAnios[$j], $idFiscalia);
									} else {
										$data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[$j], $idFiscalia, $juzgados[$r][0]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[44]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[45]));

										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[46]));
										$objPHPExcel->getActiveSheet()->SetCellValue("G" . $renInicio, number_format($arraySumas[48]));
										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[50]));
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[52]));
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, number_format($arraySumas[53]));

										$objPHPExcel->getActiveSheet()->SetCellValue("K" . $renInicio, number_format($arraySumas[54]));
										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, number_format($arraySumas[56]));
									}
								}
							}
						}
					} /// FIN FOR


				}
				$renInicio++;
				////////////////////// FOR  ///////////////////////
			}
		}
	}

	if ($a == 2) {

		$objPHPExcel->setActiveSheetIndexByName($arrHojas[$a]);
		$objPHPExcel->getActiveSheet()->SetCellValue("B5", $fisname);
		$objPHPExcel->getActiveSheet()->SetCellValue("Q4", $periodo);

		if ($idFiscalia == 0) {

			$IDSFISCALIAS = array(1, 2, 3, 4, 5, 6, 7);
			$nameFiscalias = array("Apatzingan", "La Piedad", "Lázaro Cárdenas", "Morelia", "Uruapan", "Zamora", "Zítacuaro");

			$renInicio = "11";
			for ($r = 0; $r < sizeof($IDSFISCALIAS); $r++) {

				$objPHPExcel->getActiveSheet()->SetCellValue("C" . $renInicio, $nameFiscalias[$r]);

				$arraySumas = array(
					0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
				);
				/////////////////////// FOR ///////////////////////
				for ($j = 0; $j < sizeof($arrayAnios); $j++) {
					$lastAnio = $arrayAnios[sizeof($arrayAnios) - 1];
					///// DESARROLLAR EL METODO PARA QUE TOME TODOS LOS MESES DE LOS AÑOS ENTRE EL RANGO 
					for ($i = 0; $i < 12; $i++) {
						if ($arrayAnios[$j] == $anioIniSelected) {

							if ($mesIni == $mesFin && $anioIniSelected == $anioFinSelected) {

								if (($i + 1) == $mesIni) {
									if ($idFiscalia == 0) {
										$data = getRegistrosProcesosPenalesDataEstatalXfiscalia($conn, $mesIni, $anioIniSelected, $IDSFISCALIAS[$r]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[26]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[28]));
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[30]));
										$objPHPExcel->getActiveSheet()->SetCellValue("G" . $renInicio, number_format($arraySumas[32]));
										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[34]));
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[36]));
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, number_format($arraySumas[65]));
										$objPHPExcel->getActiveSheet()->SetCellValue("K" . $renInicio, number_format($arraySumas[66]));
										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, number_format($arraySumas[67]));
										$objPHPExcel->getActiveSheet()->SetCellValue("M" . $renInicio, number_format($arraySumas[68]));
										$objPHPExcel->getActiveSheet()->SetCellValue("N" . $renInicio, number_format($arraySumas[69]));
										$objPHPExcel->getActiveSheet()->SetCellValue("O" . $renInicio, number_format($arraySumas[70]));
										$objPHPExcel->getActiveSheet()->SetCellValue("P" . $renInicio, number_format($arraySumas[71]));
										$objPHPExcel->getActiveSheet()->SetCellValue("Q" . $renInicio, number_format($arraySumas[72]));
										$objPHPExcel->getActiveSheet()->SetCellValue("R" . $renInicio, number_format($arraySumas[73]));
									} else {
										// $data = getRegistrosProcesosPenalesData($conn, $mesIni, $anioIniSelected, $idFiscalia, $juzgados[$r][0]);										
									}
								}
							} else {
								if ($mesIni == ($i + 1) or $mesIni <= ($i + 1)) {

									if ($idFiscalia == 0) {
										$data = getRegistrosProcesosPenalesDataEstatalXfiscalia($conn, $i + 1, $arrayAnios[0], $IDSFISCALIAS[$r]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[26]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[28]));
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[30]));
										$objPHPExcel->getActiveSheet()->SetCellValue("G" . $renInicio, number_format($arraySumas[32]));
										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[34]));
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[36]));
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, number_format($arraySumas[65]));
										$objPHPExcel->getActiveSheet()->SetCellValue("K" . $renInicio, number_format($arraySumas[66]));
										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, number_format($arraySumas[67]));
										$objPHPExcel->getActiveSheet()->SetCellValue("M" . $renInicio, number_format($arraySumas[68]));
										$objPHPExcel->getActiveSheet()->SetCellValue("N" . $renInicio, number_format($arraySumas[69]));
										$objPHPExcel->getActiveSheet()->SetCellValue("O" . $renInicio, number_format($arraySumas[70]));
										$objPHPExcel->getActiveSheet()->SetCellValue("P" . $renInicio, number_format($arraySumas[71]));
										$objPHPExcel->getActiveSheet()->SetCellValue("Q" . $renInicio, number_format($arraySumas[72]));
										$objPHPExcel->getActiveSheet()->SetCellValue("R" . $renInicio, number_format($arraySumas[73]));
									} else {
										// $data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[0], $idFiscalia, $juzgados[$r][0]);

									}
								}
							}
						} else {
							if ($arrayAnios[$j] == $lastAnio) {

								if ($mesFin >= ($i + 1)) {
									if ($idFiscalia == 0) {
										$data = getRegistrosProcesosPenalesDataEstatalXfiscalia($conn, $i + 1, $arrayAnios[sizeof($arrayAnios) - 1], $IDSFISCALIAS[$r]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[26]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[28]));
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[30]));
										$objPHPExcel->getActiveSheet()->SetCellValue("G" . $renInicio, number_format($arraySumas[32]));
										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[34]));
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[36]));
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, number_format($arraySumas[65]));
										$objPHPExcel->getActiveSheet()->SetCellValue("K" . $renInicio, number_format($arraySumas[66]));
										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, number_format($arraySumas[67]));
										$objPHPExcel->getActiveSheet()->SetCellValue("M" . $renInicio, number_format($arraySumas[68]));
										$objPHPExcel->getActiveSheet()->SetCellValue("N" . $renInicio, number_format($arraySumas[69]));
										$objPHPExcel->getActiveSheet()->SetCellValue("O" . $renInicio, number_format($arraySumas[70]));
										$objPHPExcel->getActiveSheet()->SetCellValue("P" . $renInicio, number_format($arraySumas[71]));
										$objPHPExcel->getActiveSheet()->SetCellValue("Q" . $renInicio, number_format($arraySumas[72]));
										$objPHPExcel->getActiveSheet()->SetCellValue("R" . $renInicio, number_format($arraySumas[73]));
									} else {
										// $data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[sizeof($arrayAnios) - 1], $idFiscalia, $juzgados[$r][0]);

									}
								}
							} else {
								if ($arrayAnios[$j] != $anioIniSelected or $arrayAnios[$j] != $lastAnio) {

									if ($idFiscalia == 0) {
										$data = getRegistrosProcesosPenalesDataEstatalXfiscalia($conn, $i + 1, $arrayAnios[$j], $IDSFISCALIAS[$r]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[26]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[28]));
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[30]));
										$objPHPExcel->getActiveSheet()->SetCellValue("G" . $renInicio, number_format($arraySumas[32]));
										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[34]));
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[36]));
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, number_format($arraySumas[65]));
										$objPHPExcel->getActiveSheet()->SetCellValue("K" . $renInicio, number_format($arraySumas[66]));
										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, number_format($arraySumas[67]));
										$objPHPExcel->getActiveSheet()->SetCellValue("M" . $renInicio, number_format($arraySumas[68]));
										$objPHPExcel->getActiveSheet()->SetCellValue("N" . $renInicio, number_format($arraySumas[69]));
										$objPHPExcel->getActiveSheet()->SetCellValue("O" . $renInicio, number_format($arraySumas[70]));
										$objPHPExcel->getActiveSheet()->SetCellValue("P" . $renInicio, number_format($arraySumas[71]));
										$objPHPExcel->getActiveSheet()->SetCellValue("Q" . $renInicio, number_format($arraySumas[72]));
										$objPHPExcel->getActiveSheet()->SetCellValue("R" . $renInicio, number_format($arraySumas[73]));
									} else {
										// $data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[$j], $idFiscalia, $juzgados[$r][0]);

									}
								}
							}
						}
					} /// FIN FOR


				}
				$renInicio++;
				////////////////////// FOR  ///////////////////////
			}
		} else {

			$juzgados  = getJuzgadoXfiscalia($conn, $idFiscalia);

			$renInicio = "11";
			for ($r = 0; $r < sizeof($juzgados); $r++) {

				$objPHPExcel->getActiveSheet()->SetCellValue("C" . $renInicio, $juzgados[$r][1]);

				$arraySumas = array(
					0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
				);
				/////////////////////// FOR ///////////////////////
				for ($j = 0; $j < sizeof($arrayAnios); $j++) {
					$lastAnio = $arrayAnios[sizeof($arrayAnios) - 1];
					///// DESARROLLAR EL METODO PARA QUE TOME TODOS LOS MESES DE LOS AÑOS ENTRE EL RANGO 
					for ($i = 0; $i < 12; $i++) {
						if ($arrayAnios[$j] == $anioIniSelected) {

							if ($mesIni == $mesFin && $anioIniSelected == $anioFinSelected) {

								if (($i + 1) == $mesIni) {
									if ($juzgados[$r][0] == 0) {
										//$data = getRegistrosSalasPenalesDataEstatal($conn, $mesIni, $anioIniSelected, $idFiscalia);
									} else {
										$data = getRegistrosProcesosPenalesData($conn, $mesIni, $anioIniSelected, $idFiscalia, $juzgados[$r][0]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[26]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[28]));
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[30]));
										$objPHPExcel->getActiveSheet()->SetCellValue("G" . $renInicio, number_format($arraySumas[32]));
										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[34]));
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[36]));
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, number_format($arraySumas[65]));
										$objPHPExcel->getActiveSheet()->SetCellValue("K" . $renInicio, number_format($arraySumas[66]));
										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, number_format($arraySumas[67]));
										$objPHPExcel->getActiveSheet()->SetCellValue("M" . $renInicio, number_format($arraySumas[68]));
										$objPHPExcel->getActiveSheet()->SetCellValue("N" . $renInicio, number_format($arraySumas[69]));
										$objPHPExcel->getActiveSheet()->SetCellValue("O" . $renInicio, number_format($arraySumas[70]));
										$objPHPExcel->getActiveSheet()->SetCellValue("P" . $renInicio, number_format($arraySumas[71]));
										$objPHPExcel->getActiveSheet()->SetCellValue("Q" . $renInicio, number_format($arraySumas[72]));
										$objPHPExcel->getActiveSheet()->SetCellValue("R" . $renInicio, number_format($arraySumas[73]));
									}
								}
							} else {


								// if ($mesIni == ($i + 1) or $mesIni <= ($i + 1)) {
									if ($mesIni == ($i + 1) or ($i+1) <= $mesFin) {		
									if ($juzgados[$r][0] == 0) {
										//$data = getRegistrosSalasPenalesDataEstatal($conn, $i + 1, $arrayAnios[0], $idFiscalia);
									} else {
										$data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[0], $idFiscalia, $juzgados[$r][0]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[26]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[28]));
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[30]));
										$objPHPExcel->getActiveSheet()->SetCellValue("G" . $renInicio, number_format($arraySumas[32]));
										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[34]));
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[36]));
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, number_format($arraySumas[65]));
										$objPHPExcel->getActiveSheet()->SetCellValue("K" . $renInicio, number_format($arraySumas[66]));
										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, number_format($arraySumas[67]));
										$objPHPExcel->getActiveSheet()->SetCellValue("M" . $renInicio, number_format($arraySumas[68]));
										$objPHPExcel->getActiveSheet()->SetCellValue("N" . $renInicio, number_format($arraySumas[69]));
										$objPHPExcel->getActiveSheet()->SetCellValue("O" . $renInicio, number_format($arraySumas[70]));
										$objPHPExcel->getActiveSheet()->SetCellValue("P" . $renInicio, number_format($arraySumas[71]));
										$objPHPExcel->getActiveSheet()->SetCellValue("Q" . $renInicio, number_format($arraySumas[72]));
										$objPHPExcel->getActiveSheet()->SetCellValue("R" . $renInicio, number_format($arraySumas[73]));
									}
								}
							}
						} else {
							if ($arrayAnios[$j] == $lastAnio) {

								if ($mesFin >= ($i + 1)) {
									if ($juzgados[$r][0] == 0) {
										//$data = getRegistrosSalasPenalesDataEstatal($conn, $i + 1, $arrayAnios[sizeof($arrayAnios) - 1], $idFiscalia);
									} else {
										$data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[sizeof($arrayAnios) - 1], $idFiscalia, $juzgados[$r][0]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[26]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[28]));
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[30]));
										$objPHPExcel->getActiveSheet()->SetCellValue("G" . $renInicio, number_format($arraySumas[32]));
										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[34]));
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[36]));
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, number_format($arraySumas[65]));
										$objPHPExcel->getActiveSheet()->SetCellValue("K" . $renInicio, number_format($arraySumas[66]));
										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, number_format($arraySumas[67]));
										$objPHPExcel->getActiveSheet()->SetCellValue("M" . $renInicio, number_format($arraySumas[68]));
										$objPHPExcel->getActiveSheet()->SetCellValue("N" . $renInicio, number_format($arraySumas[69]));
										$objPHPExcel->getActiveSheet()->SetCellValue("O" . $renInicio, number_format($arraySumas[70]));
										$objPHPExcel->getActiveSheet()->SetCellValue("P" . $renInicio, number_format($arraySumas[71]));
										$objPHPExcel->getActiveSheet()->SetCellValue("Q" . $renInicio, number_format($arraySumas[72]));
										$objPHPExcel->getActiveSheet()->SetCellValue("R" . $renInicio, number_format($arraySumas[73]));
									}
								}
							} else {
								if ($arrayAnios[$j] != $anioIniSelected or $arrayAnios[$j] != $lastAnio) {

									if ($juzgados[$r][0] == 0) {
										//$data = getRegistrosSalasPenalesDataEstatal($conn, $i + 1, $arrayAnios[$j], $idFiscalia);
									} else {
										$data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[$j], $idFiscalia, $juzgados[$r][0]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[26]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[28]));
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[30]));
										$objPHPExcel->getActiveSheet()->SetCellValue("G" . $renInicio, number_format($arraySumas[32]));
										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[34]));
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[36]));
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, number_format($arraySumas[65]));
										$objPHPExcel->getActiveSheet()->SetCellValue("K" . $renInicio, number_format($arraySumas[66]));
										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, number_format($arraySumas[67]));
										$objPHPExcel->getActiveSheet()->SetCellValue("M" . $renInicio, number_format($arraySumas[68]));
										$objPHPExcel->getActiveSheet()->SetCellValue("N" . $renInicio, number_format($arraySumas[69]));
										$objPHPExcel->getActiveSheet()->SetCellValue("O" . $renInicio, number_format($arraySumas[70]));
										$objPHPExcel->getActiveSheet()->SetCellValue("P" . $renInicio, number_format($arraySumas[71]));
										$objPHPExcel->getActiveSheet()->SetCellValue("Q" . $renInicio, number_format($arraySumas[72]));
										$objPHPExcel->getActiveSheet()->SetCellValue("R" . $renInicio, number_format($arraySumas[73]));
									}
								}
							}
						}
					} /// FIN FOR


				}
				$renInicio++;
				////////////////////// FOR  ///////////////////////
			}
		}
	}


	if ($a == 3) {

		$objPHPExcel->setActiveSheetIndexByName($arrHojas[$a]);
		$objPHPExcel->getActiveSheet()->SetCellValue("B5", $fisname);
		$objPHPExcel->getActiveSheet()->SetCellValue("I4", $periodo);


		if ($idFiscalia == 0) {

			$IDSFISCALIAS = array(1, 2, 3, 4, 5, 6, 7);
			$nameFiscalias = array("Apatzingan", "La Piedad", "Lázaro Cárdenas", "Morelia", "Uruapan", "Zamora", "Zítacuaro");

			$renInicio = "11";
			for ($r = 0; $r < sizeof($IDSFISCALIAS); $r++) {

				$objPHPExcel->getActiveSheet()->SetCellValue("C" . $renInicio, $nameFiscalias[$r]);

				$arraySumas = array(
					0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
				);
				/////////////////////// FOR ///////////////////////
				for ($j = 0; $j < sizeof($arrayAnios); $j++) {
					$lastAnio = $arrayAnios[sizeof($arrayAnios) - 1];
					///// DESARROLLAR EL METODO PARA QUE TOME TODOS LOS MESES DE LOS AÑOS ENTRE EL RANGO 
					for ($i = 0; $i < 12; $i++) {
						if ($arrayAnios[$j] == $anioIniSelected) {

							if ($mesIni == $mesFin && $anioIniSelected == $anioFinSelected) {

								if (($i + 1) == $mesIni) {

									if ($idFiscalia == 0) {
										$data = getRegistrosProcesosPenalesDataEstatalXfiscalia($conn, $mesIni, $anioIniSelected, $IDSFISCALIAS[$r]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[20]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[21]));
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[22]));
										$objPHPExcel->getActiveSheet()->SetCellValue("G" . $renInicio, number_format($arraySumas[23]));
										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[24]));
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[25]));
									} else {
										// $data = getRegistrosProcesosPenalesData($conn, $mesIni, $anioIniSelected, $idFiscalia, $juzgados[$r][0]);

									}
								}
							} else {
								if ($mesIni == ($i + 1) or $mesIni <= ($i + 1)) {

									if ($idFiscalia == 0) {
										$data = getRegistrosProcesosPenalesDataEstatalXfiscalia($conn, $i + 1, $arrayAnios[0], $IDSFISCALIAS[$r]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[20]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[21]));
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[22]));
										$objPHPExcel->getActiveSheet()->SetCellValue("G" . $renInicio, number_format($arraySumas[23]));
										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[24]));
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[25]));
									} else {
										// $data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[0], $idFiscalia, $juzgados[$r][0]);

									}
								}
							}
						} else {
							if ($arrayAnios[$j] == $lastAnio) {

								if ($mesFin >= ($i + 1)) {
									if ($idFiscalia == 0) {
										$data = getRegistrosProcesosPenalesDataEstatalXfiscalia($conn, $i + 1, $arrayAnios[sizeof($arrayAnios) - 1], $IDSFISCALIAS[$r]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[20]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[21]));
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[22]));
										$objPHPExcel->getActiveSheet()->SetCellValue("G" . $renInicio, number_format($arraySumas[23]));
										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[24]));
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[25]));
									} else {
										// $data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[sizeof($arrayAnios) - 1], $idFiscalia, $juzgados[$r][0]);

									}
								}
							} else {
								if ($arrayAnios[$j] != $anioIniSelected or $arrayAnios[$j] != $lastAnio) {

									if ($idFiscalia == 0) {
										$data = getRegistrosProcesosPenalesDataEstatalXfiscalia($conn, $i + 1, $arrayAnios[$j], $IDSFISCALIAS[$r]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[20]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[21]));
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[22]));
										$objPHPExcel->getActiveSheet()->SetCellValue("G" . $renInicio, number_format($arraySumas[23]));
										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[24]));
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[25]));
									} else {
										// $data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[$j], $idFiscalia, $juzgados[$r][0]);

									}
								}
							}
						}
					} /// FIN FOR


				}
				$renInicio++;
				////////////////////// FOR  ///////////////////////
			}
		} else {

			$juzgados  = getJuzgadoXfiscalia($conn, $idFiscalia);

			$renInicio = "11";
			for ($r = 0; $r < sizeof($juzgados); $r++) {

				$objPHPExcel->getActiveSheet()->SetCellValue("C" . $renInicio, $juzgados[$r][1]);

				$arraySumas = array(
					0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
				);
				/////////////////////// FOR ///////////////////////
				for ($j = 0; $j < sizeof($arrayAnios); $j++) {
					$lastAnio = $arrayAnios[sizeof($arrayAnios) - 1];
					///// DESARROLLAR EL METODO PARA QUE TOME TODOS LOS MESES DE LOS AÑOS ENTRE EL RANGO 
					for ($i = 0; $i < 12; $i++) {
						if ($arrayAnios[$j] == $anioIniSelected) {

							if ($mesIni == $mesFin && $anioIniSelected == $anioFinSelected) {

								if (($i + 1) == $mesIni) {
									if ($juzgados[$r][0] == 0) {
										//$data = getRegistrosSalasPenalesDataEstatal($conn, $mesIni, $anioIniSelected, $idFiscalia);
									} else {
										$data = getRegistrosProcesosPenalesData($conn, $mesIni, $anioIniSelected, $idFiscalia, $juzgados[$r][0]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[20]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[21]));
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[22]));
										$objPHPExcel->getActiveSheet()->SetCellValue("G" . $renInicio, number_format($arraySumas[23]));
										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[24]));
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[25]));
									}
								}
							} else {


								// if ($mesIni == ($i + 1) or $mesIni <= ($i + 1)) {
									if ($mesIni == ($i + 1) or ($i+1) <= $mesFin) {		
									if ($juzgados[$r][0] == 0) {
										//$data = getRegistrosSalasPenalesDataEstatal($conn, $i + 1, $arrayAnios[0], $idFiscalia);
									} else {
										$data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[0], $idFiscalia, $juzgados[$r][0]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[20]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[21]));
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[22]));
										$objPHPExcel->getActiveSheet()->SetCellValue("G" . $renInicio, number_format($arraySumas[23]));
										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[24]));
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[25]));
									}
								}
							}
						} else {
							if ($arrayAnios[$j] == $lastAnio) {

								if ($mesFin >= ($i + 1)) {
									if ($juzgados[$r][0] == 0) {
										//$data = getRegistrosSalasPenalesDataEstatal($conn, $i + 1, $arrayAnios[sizeof($arrayAnios) - 1], $idFiscalia);
									} else {
										$data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[sizeof($arrayAnios) - 1], $idFiscalia, $juzgados[$r][0]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[20]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[21]));
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[22]));
										$objPHPExcel->getActiveSheet()->SetCellValue("G" . $renInicio, number_format($arraySumas[23]));
										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[24]));
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[25]));
									}
								}
							} else {
								if ($arrayAnios[$j] != $anioIniSelected or $arrayAnios[$j] != $lastAnio) {

									if ($juzgados[$r][0] == 0) {
										//$data = getRegistrosSalasPenalesDataEstatal($conn, $i + 1, $arrayAnios[$j], $idFiscalia);
									} else {
										$data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[$j], $idFiscalia, $juzgados[$r][0]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, number_format($arraySumas[20]));
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, number_format($arraySumas[21]));
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, number_format($arraySumas[22]));
										$objPHPExcel->getActiveSheet()->SetCellValue("G" . $renInicio, number_format($arraySumas[23]));
										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, number_format($arraySumas[24]));
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, number_format($arraySumas[25]));
									}
								}
							}
						}
					} /// FIN FOR


				}
				$renInicio++;
				////////////////////// FOR  ///////////////////////
			}
		}
	}

	if ($a == 4) {
		$objPHPExcel->setActiveSheetIndexByName($arrHojas[$a]);
		$objPHPExcel->getActiveSheet()->SetCellValue("B5", $fisname);
		$objPHPExcel->getActiveSheet()->SetCellValue("R4", $periodo);

		if ($idFiscalia == 0) {

			$IDSFISCALIAS = array(1, 2, 3, 4, 5, 6, 7);
			$nameFiscalias = array("Apatzingan", "La Piedad", "Lázaro Cárdenas", "Morelia", "Uruapan", "Zamora", "Zítacuaro");

			$renInicio = "11";
			for ($r = 0; $r < sizeof($IDSFISCALIAS); $r++) {

				$objPHPExcel->getActiveSheet()->SetCellValue("C" . $renInicio, $nameFiscalias[$r]);

				$arraySumas = array(
					0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
				);
				/////////////////////// FOR ///////////////////////
				for ($j = 0; $j < sizeof($arrayAnios); $j++) {
					$lastAnio = $arrayAnios[sizeof($arrayAnios) - 1];
					///// DESARROLLAR EL METODO PARA QUE TOME TODOS LOS MESES DE LOS AÑOS ENTRE EL RANGO 
					for ($i = 0; $i < 12; $i++) {
						if ($arrayAnios[$j] == $anioIniSelected) {

							if ($mesIni == $mesFin && $anioIniSelected == $anioFinSelected) {

								if (($i + 1) == $mesIni) {
									if ($idFiscalia == 0) {
										$data = getRegistrosProcesosPenalesDataEstatalXfiscalia($conn, $mesIni, $anioIniSelected, $IDSFISCALIAS[$r]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$tramite = getTramiteLastMonthEstatal($conn, $mesFin, $anioFin, $IDSFISCALIAS[$r]);
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, $arraySumas[61]);
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, $arraySumas[62]);
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, $arraySumas[63]);

										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, $arraySumas[75]);
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, $arraySumas[76]);
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, $arraySumas[77]);

										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, $arraySumas[38]);
										$objPHPExcel->getActiveSheet()->SetCellValue("M" . $renInicio, $arraySumas[39]);
										$objPHPExcel->getActiveSheet()->SetCellValue("N" . $renInicio, $arraySumas[40]);
										$objPHPExcel->getActiveSheet()->SetCellValue("O" . $renInicio, $arraySumas[41]);
										$objPHPExcel->getActiveSheet()->SetCellValue("P" . $renInicio, $arraySumas[42]);
										$objPHPExcel->getActiveSheet()->SetCellValue("Q" . $renInicio, $arraySumas[43]);
										$objPHPExcel->getActiveSheet()->SetCellValue("S" . $renInicio, $arraySumas[78]);
										$objPHPExcel->getActiveSheet()->SetCellValue("T" . $renInicio, number_format($tramite[0][0]));
									} else {
										// $data = getRegistrosProcesosPenalesData($conn, $mesIni, $anioIniSelected, $idFiscalia, $juzgados[$r][0]);

									}
								}
							} else {
								if ($mesIni == ($i + 1) or $mesIni <= ($i + 1)) {

									if ($idFiscalia == 0) {
										$data = getRegistrosProcesosPenalesDataEstatalXfiscalia($conn, $i + 1, $arrayAnios[0], $IDSFISCALIAS[$r]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$tramite = getTramiteLastMonthEstatal($conn, $mesFin, $anioFin, $IDSFISCALIAS[$r]);
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, $arraySumas[61]);
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, $arraySumas[62]);
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, $arraySumas[63]);

										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, $arraySumas[75]);
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, $arraySumas[76]);
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, $arraySumas[77]);

										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, $arraySumas[38]);
										$objPHPExcel->getActiveSheet()->SetCellValue("M" . $renInicio, $arraySumas[39]);
										$objPHPExcel->getActiveSheet()->SetCellValue("N" . $renInicio, $arraySumas[40]);
										$objPHPExcel->getActiveSheet()->SetCellValue("O" . $renInicio, $arraySumas[41]);
										$objPHPExcel->getActiveSheet()->SetCellValue("P" . $renInicio, $arraySumas[42]);
										$objPHPExcel->getActiveSheet()->SetCellValue("Q" . $renInicio, $arraySumas[43]);
										$objPHPExcel->getActiveSheet()->SetCellValue("S" . $renInicio, $arraySumas[78]);
										$objPHPExcel->getActiveSheet()->SetCellValue("T" . $renInicio, number_format($tramite[0][0]));
									} else {
										// $data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[0], $idFiscalia, $juzgados[$r][0]);

									}
								}
							}
						} else {
							if ($arrayAnios[$j] == $lastAnio) {

								if ($mesFin >= ($i + 1)) {
									if ($idFiscalia == 0) {
										$data = getRegistrosProcesosPenalesDataEstatalXfiscalia($conn, $i + 1, $arrayAnios[sizeof($arrayAnios) - 1], $IDSFISCALIAS[$r]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$tramite = getTramiteLastMonthEstatal($conn, $mesFin, $anioFin, $IDSFISCALIAS[$r]);
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, $arraySumas[61]);
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, $arraySumas[62]);
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, $arraySumas[63]);

										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, $arraySumas[75]);
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, $arraySumas[76]);
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, $arraySumas[77]);

										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, $arraySumas[38]);
										$objPHPExcel->getActiveSheet()->SetCellValue("M" . $renInicio, $arraySumas[39]);
										$objPHPExcel->getActiveSheet()->SetCellValue("N" . $renInicio, $arraySumas[40]);
										$objPHPExcel->getActiveSheet()->SetCellValue("O" . $renInicio, $arraySumas[41]);
										$objPHPExcel->getActiveSheet()->SetCellValue("P" . $renInicio, $arraySumas[42]);
										$objPHPExcel->getActiveSheet()->SetCellValue("Q" . $renInicio, $arraySumas[43]);
										$objPHPExcel->getActiveSheet()->SetCellValue("S" . $renInicio, $arraySumas[78]);
										$objPHPExcel->getActiveSheet()->SetCellValue("T" . $renInicio, number_format($tramite[0][0]));
									} else {
										// $data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[sizeof($arrayAnios) - 1], $idFiscalia, $juzgados[$r][0]);

									}
								}
							} else {
								if ($arrayAnios[$j] != $anioIniSelected or $arrayAnios[$j] != $lastAnio) {

									if ($idFiscalia == 0) {
										$data = getRegistrosProcesosPenalesDataEstatalXfiscalia($conn, $i + 1, $arrayAnios[$j], $IDSFISCALIAS[$r]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$tramite = getTramiteLastMonthEstatal($conn, $mes, $anio, $IDSFISCALIAS[$r]);
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, $arraySumas[61]);
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, $arraySumas[62]);
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, $arraySumas[63]);

										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, $arraySumas[75]);
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, $arraySumas[76]);
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, $arraySumas[77]);

										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, $arraySumas[38]);
										$objPHPExcel->getActiveSheet()->SetCellValue("M" . $renInicio, $arraySumas[39]);
										$objPHPExcel->getActiveSheet()->SetCellValue("N" . $renInicio, $arraySumas[40]);
										$objPHPExcel->getActiveSheet()->SetCellValue("O" . $renInicio, $arraySumas[41]);
										$objPHPExcel->getActiveSheet()->SetCellValue("P" . $renInicio, $arraySumas[42]);
										$objPHPExcel->getActiveSheet()->SetCellValue("Q" . $renInicio, $arraySumas[43]);
										$objPHPExcel->getActiveSheet()->SetCellValue("S" . $renInicio, $arraySumas[78]);
										$objPHPExcel->getActiveSheet()->SetCellValue("T" . $renInicio, number_format($tramite[0][0]));
									} else {
										// $data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[$j], $idFiscalia, $juzgados[$r][0]);

									}
								}
							}
						}
					} /// FIN FOR


				}
				$renInicio++;
				////////////////////// FOR  ///////////////////////
			}
		} else {

			$juzgados  = getJuzgadoXfiscalia($conn, $idFiscalia);

			$renInicio = "11";
			for ($r = 0; $r < sizeof($juzgados); $r++) {

				$objPHPExcel->getActiveSheet()->SetCellValue("C" . $renInicio, $juzgados[$r][1]);

				$arraySumas = array(
					0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
				);
				/////////////////////// FOR ///////////////////////
				for ($j = 0; $j < sizeof($arrayAnios); $j++) {
					$lastAnio = $arrayAnios[sizeof($arrayAnios) - 1];
					///// DESARROLLAR EL METODO PARA QUE TOME TODOS LOS MESES DE LOS AÑOS ENTRE EL RANGO 
					for ($i = 0; $i < 12; $i++) {
						if ($arrayAnios[$j] == $anioIniSelected) {

							if ($mesIni == $mesFin && $anioIniSelected == $anioFinSelected) {

								if (($i + 1) == $mesIni) {
									if ($juzgados[$r][0] == 0) {
										//$data = getRegistrosSalasPenalesDataEstatal($conn, $mesIni, $anioIniSelected, $idFiscalia);
									} else {
										$data = getRegistrosProcesosPenalesData($conn, $mesIni, $anioIniSelected, $idFiscalia, $juzgados[$r][0]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$tramite = getTramiteLastMonth($conn, $mesFin, $anioFin, $idFiscalia, $juzgados[$r][0]);
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, $arraySumas[61]);
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, $arraySumas[62]);
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, $arraySumas[63]);

										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, $arraySumas[75]);
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, $arraySumas[76]);
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, $arraySumas[77]);

										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, $arraySumas[38]);
										$objPHPExcel->getActiveSheet()->SetCellValue("M" . $renInicio, $arraySumas[39]);
										$objPHPExcel->getActiveSheet()->SetCellValue("N" . $renInicio, $arraySumas[40]);
										$objPHPExcel->getActiveSheet()->SetCellValue("O" . $renInicio, $arraySumas[41]);
										$objPHPExcel->getActiveSheet()->SetCellValue("P" . $renInicio, $arraySumas[42]);
										$objPHPExcel->getActiveSheet()->SetCellValue("Q" . $renInicio, $arraySumas[43]);
										$objPHPExcel->getActiveSheet()->SetCellValue("S" . $renInicio, $arraySumas[78]);
										$objPHPExcel->getActiveSheet()->SetCellValue("T" . $renInicio, number_format($tramite[0][0]));
									}
								}
							} else {


								// if ($mesIni == ($i + 1) or $mesIni <= ($i + 1)) {
									if ($mesIni == ($i + 1) or ($i+1) <= $mesFin) {		
									if ($juzgados[$r][0] == 0) {
										//$data = getRegistrosSalasPenalesDataEstatal($conn, $i + 1, $arrayAnios[0], $idFiscalia);
									} else {
										$data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[0], $idFiscalia, $juzgados[$r][0]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										///GET TRAMITE LAST MONTH CAPTURED
										$tramite = getTramiteLastMonth($conn, $mesFin, $anioFin, $idFiscalia, $juzgados[$r][0]);
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, $arraySumas[61]);
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, $arraySumas[62]);
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, $arraySumas[63]);

										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, $arraySumas[75]);
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, $arraySumas[76]);
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, $arraySumas[77]);

										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, $arraySumas[38]);
										$objPHPExcel->getActiveSheet()->SetCellValue("M" . $renInicio, $arraySumas[39]);
										$objPHPExcel->getActiveSheet()->SetCellValue("N" . $renInicio, $arraySumas[40]);
										$objPHPExcel->getActiveSheet()->SetCellValue("O" . $renInicio, $arraySumas[41]);
										$objPHPExcel->getActiveSheet()->SetCellValue("P" . $renInicio, $arraySumas[42]);
										$objPHPExcel->getActiveSheet()->SetCellValue("Q" . $renInicio, $arraySumas[43]);
										$objPHPExcel->getActiveSheet()->SetCellValue("S" . $renInicio, $arraySumas[78]);
										$objPHPExcel->getActiveSheet()->SetCellValue("T" . $renInicio, number_format($tramite[0][0]));
									}
								}
							}
						} else {
							if ($arrayAnios[$j] == $lastAnio) {

								if ($mesFin >= ($i + 1)) {
									if ($juzgados[$r][0] == 0) {
										//$data = getRegistrosSalasPenalesDataEstatal($conn, $i + 1, $arrayAnios[sizeof($arrayAnios) - 1], $idFiscalia);
									} else {
										$data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[sizeof($arrayAnios) - 1], $idFiscalia, $juzgados[$r][0]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$tramite = getTramiteLastMonth($conn, $mesFin, $anioFin, $idFiscalia, $juzgados[$r][0]);
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, $arraySumas[61]);
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, $arraySumas[62]);
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, $arraySumas[63]);

										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, $arraySumas[75]);
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, $arraySumas[76]);
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, $arraySumas[77]);

										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, $arraySumas[38]);
										$objPHPExcel->getActiveSheet()->SetCellValue("M" . $renInicio, $arraySumas[39]);
										$objPHPExcel->getActiveSheet()->SetCellValue("N" . $renInicio, $arraySumas[40]);
										$objPHPExcel->getActiveSheet()->SetCellValue("O" . $renInicio, $arraySumas[41]);
										$objPHPExcel->getActiveSheet()->SetCellValue("P" . $renInicio, $arraySumas[42]);
										$objPHPExcel->getActiveSheet()->SetCellValue("Q" . $renInicio, $arraySumas[43]);
										$objPHPExcel->getActiveSheet()->SetCellValue("S" . $renInicio, $arraySumas[78]);
										$objPHPExcel->getActiveSheet()->SetCellValue("T" . $renInicio, number_format($tramite[0][0]));
									}
								}
							} else {
								if ($arrayAnios[$j] != $anioIniSelected or $arrayAnios[$j] != $lastAnio) {

									if ($juzgados[$r][0] == 0) {
										//$data = getRegistrosSalasPenalesDataEstatal($conn, $i + 1, $arrayAnios[$j], $idFiscalia);
									} else {
										$data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[$j], $idFiscalia, $juzgados[$r][0]);
										for ($k = 0; $k <= 81; $k++) {
											$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
										}
										$tramite = getTramiteLastMonth($conn, $mesFin, $anioFin, $idFiscalia, $juzgados[$r][0]);
										$objPHPExcel->getActiveSheet()->SetCellValue("D" . $renInicio, $arraySumas[61]);
										$objPHPExcel->getActiveSheet()->SetCellValue("E" . $renInicio, $arraySumas[62]);
										$objPHPExcel->getActiveSheet()->SetCellValue("F" . $renInicio, $arraySumas[63]);

										$objPHPExcel->getActiveSheet()->SetCellValue("H" . $renInicio, $arraySumas[75]);
										$objPHPExcel->getActiveSheet()->SetCellValue("I" . $renInicio, $arraySumas[76]);
										$objPHPExcel->getActiveSheet()->SetCellValue("J" . $renInicio, $arraySumas[77]);

										$objPHPExcel->getActiveSheet()->SetCellValue("L" . $renInicio, $arraySumas[38]);
										$objPHPExcel->getActiveSheet()->SetCellValue("M" . $renInicio, $arraySumas[39]);
										$objPHPExcel->getActiveSheet()->SetCellValue("N" . $renInicio, $arraySumas[40]);
										$objPHPExcel->getActiveSheet()->SetCellValue("O" . $renInicio, $arraySumas[41]);
										$objPHPExcel->getActiveSheet()->SetCellValue("P" . $renInicio, $arraySumas[42]);
										$objPHPExcel->getActiveSheet()->SetCellValue("Q" . $renInicio, $arraySumas[43]);
										$objPHPExcel->getActiveSheet()->SetCellValue("S" . $renInicio, $arraySumas[78]);
										$objPHPExcel->getActiveSheet()->SetCellValue("T" . $renInicio, number_format($tramite[0][0]));
									}
								}
							}
						}
					} /// FIN FOR


				}
				$renInicio++;
				////////////////////// FOR  ///////////////////////
			}
		}
	}
}

//////// AQUI PROCESO PARA CONTAR LOS NUMEROS  /////////

$nombrereporte = "ProcesosPenalesAcumulado-" . $idFiscalia . $juzgado . "-" . $mesIni . $anioIni . "-" . $mesFin . $anioFin;
$nombre_reporte = $nombrereporte . ".xlsx";


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
// $objPHPExcel->getActiveSheet()->getProtection()->setPassword('2D0P2E2');


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(utf8_decode("downloadReportProcesosPenales/$nombre_reporte"));
