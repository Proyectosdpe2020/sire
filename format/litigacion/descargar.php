<?php
	session_start();
	include ("../../Conexiones/Conexion.php");
	include("../../funciones.php");


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

	$plantilla = "plantillas/litigacion.xlsx";

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



	/// se cambio de getMpsEnlaceUnidad a getsMpsENlace

	/*if($idfis == 4){ $mpsENlace=getMpsEnlaceUnidad($conn, $idEnlace, 4); }else{

			$mpsENlace=getMpsEnlaceUnidad($conn, $idEnlace, 4);

	}*/


	$mpsENlace = getMpsEnlaceUnidadFormato($conn, $idEnlace, 4);



	$totalmps = sizeof($mpsENlace);	




				$var1 = 0;	$var2 = 0;	$var3 = 0;	$var4 = 0; $var5 = 0; $var6 = 0;	$var7 = 0;	$impomedcaute = 0;	$ppoficio = 0;	$var8 = 0;	$var10 = 0;	$exhibiGaeco = 0; $embvien = 0;			$var11 = 0;		$var14 = 0;	$var15 = 0;	$var16 = 0;	$var17 = 0;	$var18 = 0;	$var19 = 0;	$var20 = 0;	$var21 = 0;	$var22 = 0;	$var23 = 0;	$var24 = 0;	$var25 = 0;	$var26 = 0;
				$var27 = 0; $var28 = 0;	$var29 = 0;	$var30 = 0;	$var31 = 0;	$var32 = 0;	$var33 = 0;	$var34 = 0;	$var35 = 0;	$var36 = 0;	$var37 = 0;	$var38 = 0;	$var39 = 0;	$var40 = 0;	$var41 = 0;
				$var42 = 0; $var43 = 0;	$var44 = 0;	$var45 = 0;	$var46 = 0;	$var47 = 0; $var48 = 0;	$var49 = 0;	$var50 = 0;	$var51 = 0;	$var52 = 0;	$var53 = 0;	$var54 = 0;	$var55 = 0;	$var56 =0;

				$var99 = 0;	$var57 = 0;	$var58 = 0;	$var59 = 0;	$var60 = 0;	$var61 = 0;	$var62 = 0;	$var63 = 0;	$var64 = 0;	$var65 = 0;	$var66 = 0;	$var67 = 0;	$var68 = 0;	$var69 = 0;	$var70 = 0;
				$var71 = 0; $var72 = 0;	$var73 = 0;	$var74 = 0;	$var75 = 0;	$var76 = 0;	$var77 = 0;	$var78 = 0;	$var79 = 0;	$var80 = 0;	$var81 = 0;	$var82 = 0;	$var83 = 0;	$var84 = 0; $var85 = 0;
				$var86 = 0;	$var87 = 0;	$var88 = 0;	$var89 = 0;	$var90 = 0;	$var91 = 0;	$var92 = 0;	$var93 = 0;	$var94 = 0;	$var95 = 0;	$var96 = 0;	$var97 = 0;	$var98 = 0;

	for( $i=0; $i<sizeof($mpsENlace); $i++){


				$idMp = $mpsENlace[$i][4];
	
				//$datalit = getDatosLitigacionMp($conn, $idMp, $mes, $anio, $idfis);
				$datalit = getDatosLitigacionMpUnidad($conn, $idMp, $mes, $anio, $idfis, $idUnidad);	

				$var1 = $var1 + $datalit[0][0];
				
				$var2 = $var2 + $datalit[0][2];
				$var3 = $var3 + $datalit[0][3];
				
				$var4 = $var4 + $datalit[0][1];

				$var5 = $var5 + $datalit[0][4];
				$var6 = $var6 + $datalit[0][5];
				$var7 = $var7 + $datalit[0][6];

				$impomedcaute = $impomedcaute + $datalit[0][7];
				$ppoficio = $ppoficio + $datalit[0][8];
				$var8 = $var8 + $datalit[0][9];
				$var10 = $var10 + $datalit[0][10];
				$exhibiGaeco = $exhibiGaeco + $datalit[0][11];
				$embvien = $embvien + $datalit[0][12];	
				$var11 = $var11 + $datalit[0][13];		
				$var14 = $var14 + $datalit[0][14];
				$var15 = $var15 + $datalit[0][15];
				$var16 = $var16 + $datalit[0][16];
				$var17 = $var17 + $datalit[0][17];
				$var18 = $var18 + $datalit[0][18];
				$var19 = $var19 + $datalit[0][19];
				$var20 = $var20 + $datalit[0][20];
				$var21 = $var21 + $datalit[0][21];
				$var22 = $var22 + $datalit[0][22];

				$var23 = $var23 + $datalit[0][23];
				$var24 = $var24 + $datalit[0][24];
				$var25 = $var25 + $datalit[0][25];
				$var26 = $var26 + $datalit[0][26];
				$var27 = $var27 + $datalit[0][27];
				$var28 = $var28 + $datalit[0][28];
				$var29 = $var29 + $datalit[0][29];
				$var30 = $var30 + $datalit[0][30];
				$var31 = $var31 + $datalit[0][31];
				$var32 = $var32 + $datalit[0][32];

				$var33 = $var33 + $datalit[0][33];
				$var34 = $var34 + $datalit[0][34];
				$var35 = $var35 + $datalit[0][35];

				$var36 = $var36 + $datalit[0][36];
				$var37 = $var37 + $datalit[0][37];
				$var38 = $var38 + $datalit[0][38];

				$var39 = $var39 + $datalit[0][39];
				$var40 = $var40 + $datalit[0][40];
				$var41 = $var41 + $datalit[0][41];
				$var42 = $var42 + $datalit[0][42];

				$var43 = $var43 + $datalit[0][43];

				$var44 = $var44 + $datalit[0][44];
				$var45 = $var45 + $datalit[0][45];
				$var46 = $var46 + $datalit[0][46];
				$var47 = $var47 + $datalit[0][47];

				$var48 = $var48 + $datalit[0][48];

				$var49 = $var49 + $datalit[0][49];

				$var50 = $var50 + $datalit[0][50];
				$var51 = $var51 + $datalit[0][51];
				$var52 = $var52 + $datalit[0][52];

				$var53 = $var53 + $datalit[0][53];
				$var54 = $var54 + $datalit[0][54];
				$var55 = $var55 + $datalit[0][55];

				$var56 = $var56 + $datalit[0][56];

				$var99 = $var99 + $datalit[0][99];
				$var57 = $var57 + $datalit[0][57];
				$var58 = $var58 + $datalit[0][58];

				$var59 = $var59 + $datalit[0][59];
				$var60 = $var60 + $datalit[0][60];
				$var61 = $var61 + $datalit[0][61];

				$var62 = $var62 + $datalit[0][62];
				$var63 = $var63 + $datalit[0][63];
				$var64 = $var64 + $datalit[0][64];
				$var65 = $var65 + $datalit[0][65];
				$var66 = $var66 + $datalit[0][66];
				$var67 = $var67 + $datalit[0][67];

				$var68 = $var68 + $datalit[0][68];
				$var69 = $var69 + $datalit[0][69];
				$var70 = $var70 + $datalit[0][70];

				$var71 = $var71 + $datalit[0][71];
				$var72 = $var72 + $datalit[0][72];
				$var73 = $var73 + $datalit[0][73];
				$var74 = $var74 + $datalit[0][74];
				$var75 = $var75 + $datalit[0][75];
				$var76 = $var76 + $datalit[0][76];
				$var77 = $var77 + $datalit[0][77];
				$var78 = $var78 + $datalit[0][78];
				$var79 = $var79 + $datalit[0][79];
				$var80 = $var80 + $datalit[0][80];
				$var81 = $var81 + $datalit[0][81];
				$var82 = $var82 + $datalit[0][82];

				$var83 = $var83 + $datalit[0][83];
				$var84 = $var84 + $datalit[0][84];
				$var85 = $var85 + $datalit[0][85];

				$var86 = $var86 + $datalit[0][86];
				$var87 = $var87 + $datalit[0][87];
				$var88 = $var88 + $datalit[0][88];
				$var89 = $var89 + $datalit[0][89];

				$var90 = $var90 + $datalit[0][90];

				$var91 = $var91 + $datalit[0][91];
				$var92 = $var92 + $datalit[0][92];
				$var93 = $var93 + $datalit[0][93];

				$var94 = $var94 + $datalit[0][94];
				$var95 = $var95 + $datalit[0][95];

				$var96 = $var96 + $datalit[0][96];
				$var97 = $var97 + $datalit[0][97];
				$var98 = $var98 + $datalit[0][98];

	}



	$objPHPExcel->getActiveSheet()->SetCellValue("D12", $var1);

	$objPHPExcel->getActiveSheet()->SetCellValue("D14", $var4);
	$objPHPExcel->getActiveSheet()->SetCellValue("D15", $var2);
	$objPHPExcel->getActiveSheet()->SetCellValue("D16", $var3);///OK

	$objPHPExcel->getActiveSheet()->SetCellValue("D19", $var91);
	$objPHPExcel->getActiveSheet()->SetCellValue("D20", $var92);
	$objPHPExcel->getActiveSheet()->SetCellValue("D21", $var93);

	$objPHPExcel->getActiveSheet()->SetCellValue("D24", $var94);
	$objPHPExcel->getActiveSheet()->SetCellValue("D25", $var95);

	$objPHPExcel->getActiveSheet()->SetCellValue("D28", $var5);
	$objPHPExcel->getActiveSheet()->SetCellValue("D29", $var6);
	$objPHPExcel->getActiveSheet()->SetCellValue("D30", $var7);

	$objPHPExcel->getActiveSheet()->SetCellValue("D33", $var96);
	$objPHPExcel->getActiveSheet()->SetCellValue("D34", $var98);
	$objPHPExcel->getActiveSheet()->SetCellValue("D35", $var97);


	$objPHPExcel->getActiveSheet()->SetCellValue("D37", $impomedcaute);
	$objPHPExcel->getActiveSheet()->SetCellValue("D38", $ppoficio);
	$objPHPExcel->getActiveSheet()->SetCellValue("D39", $var8);
	$objPHPExcel->getActiveSheet()->SetCellValue("D40", $var10);
	$objPHPExcel->getActiveSheet()->SetCellValue("D41", $exhibiGaeco);
	$objPHPExcel->getActiveSheet()->SetCellValue("D42", $embvien);
	$objPHPExcel->getActiveSheet()->SetCellValue("D43", $var11);
	$objPHPExcel->getActiveSheet()->SetCellValue("D44", $var14);
	$objPHPExcel->getActiveSheet()->SetCellValue("D45", $var15);
	$objPHPExcel->getActiveSheet()->SetCellValue("D46", $var16);
	$objPHPExcel->getActiveSheet()->SetCellValue("D47", $var17);
	$objPHPExcel->getActiveSheet()->SetCellValue("D48", $var18);
	$objPHPExcel->getActiveSheet()->SetCellValue("D49", $var19);
	$objPHPExcel->getActiveSheet()->SetCellValue("D50", $var20);
	$objPHPExcel->getActiveSheet()->SetCellValue("D51", $var21);
	$objPHPExcel->getActiveSheet()->SetCellValue("D52", $var22);


	$objPHPExcel->getActiveSheet()->SetCellValue("D54", $var23);
	$objPHPExcel->getActiveSheet()->SetCellValue("D55", $var24);
	$objPHPExcel->getActiveSheet()->SetCellValue("D56", $var25);
	$objPHPExcel->getActiveSheet()->SetCellValue("D57", $var26);
	$objPHPExcel->getActiveSheet()->SetCellValue("D58", $var27);
	$objPHPExcel->getActiveSheet()->SetCellValue("D59", $var28);
	$objPHPExcel->getActiveSheet()->SetCellValue("D60", $var29);
	$objPHPExcel->getActiveSheet()->SetCellValue("D61", $var30);
	$objPHPExcel->getActiveSheet()->SetCellValue("D63", $var31);
	$objPHPExcel->getActiveSheet()->SetCellValue("D65", $var32);

	$objPHPExcel->getActiveSheet()->SetCellValue("D67", $var33);
	$objPHPExcel->getActiveSheet()->SetCellValue("D68", $var34);
	$objPHPExcel->getActiveSheet()->SetCellValue("D69", $var35);

	$objPHPExcel->getActiveSheet()->SetCellValue("D71", $var36);
	$objPHPExcel->getActiveSheet()->SetCellValue("D72", $var37);
	$objPHPExcel->getActiveSheet()->SetCellValue("D73", $var38);

	$objPHPExcel->getActiveSheet()->SetCellValue("D75", $var39);
	$objPHPExcel->getActiveSheet()->SetCellValue("D76", $var40);
	$objPHPExcel->getActiveSheet()->SetCellValue("D77", $var41);
	$objPHPExcel->getActiveSheet()->SetCellValue("D78", $var42);

	$objPHPExcel->getActiveSheet()->SetCellValue("D80", $var43);

	$objPHPExcel->getActiveSheet()->SetCellValue("D82", $var44);
	$objPHPExcel->getActiveSheet()->SetCellValue("D83", $var45);
	$objPHPExcel->getActiveSheet()->SetCellValue("D84", $var46);
	$objPHPExcel->getActiveSheet()->SetCellValue("D85", $var47);

	$objPHPExcel->getActiveSheet()->SetCellValue("D86", $var48);

	$objPHPExcel->getActiveSheet()->SetCellValue("D88", $var49);

	$objPHPExcel->getActiveSheet()->SetCellValue("H14", $var50);
	$objPHPExcel->getActiveSheet()->SetCellValue("H15", $var51);
	$objPHPExcel->getActiveSheet()->SetCellValue("H16", $var52);

	$objPHPExcel->getActiveSheet()->SetCellValue("H18", $var53);
	$objPHPExcel->getActiveSheet()->SetCellValue("H19", $var54);
	$objPHPExcel->getActiveSheet()->SetCellValue("H20", $var55);

	$objPHPExcel->getActiveSheet()->SetCellValue("H22", $var56);

	$objPHPExcel->getActiveSheet()->SetCellValue("H24", $var99);
	$objPHPExcel->getActiveSheet()->SetCellValue("H25", $var57);
	$objPHPExcel->getActiveSheet()->SetCellValue("H26", $var58);

	$objPHPExcel->getActiveSheet()->SetCellValue("H28", $var59);
	$objPHPExcel->getActiveSheet()->SetCellValue("H29", $var60);
	$objPHPExcel->getActiveSheet()->SetCellValue("H30", $var61);

	$objPHPExcel->getActiveSheet()->SetCellValue("H32", $var62);
	$objPHPExcel->getActiveSheet()->SetCellValue("H33", $var63);
	$objPHPExcel->getActiveSheet()->SetCellValue("H34", $var64);
	$objPHPExcel->getActiveSheet()->SetCellValue("H35", $var65);
	$objPHPExcel->getActiveSheet()->SetCellValue("H36", $var66);
	$objPHPExcel->getActiveSheet()->SetCellValue("H37", $var67);

	$objPHPExcel->getActiveSheet()->SetCellValue("H39", $var68);
	$objPHPExcel->getActiveSheet()->SetCellValue("H40", $var69);
	$objPHPExcel->getActiveSheet()->SetCellValue("H41", $var70);

	$objPHPExcel->getActiveSheet()->SetCellValue("H43", $var71);
	$objPHPExcel->getActiveSheet()->SetCellValue("H44", $var72);
	$objPHPExcel->getActiveSheet()->SetCellValue("H45", $var73);
	$objPHPExcel->getActiveSheet()->SetCellValue("H46", $var74);
	$objPHPExcel->getActiveSheet()->SetCellValue("H47", $var75);
	$objPHPExcel->getActiveSheet()->SetCellValue("H48", $var76);
	$objPHPExcel->getActiveSheet()->SetCellValue("H49", $var77);
	$objPHPExcel->getActiveSheet()->SetCellValue("H50", $var78);
	$objPHPExcel->getActiveSheet()->SetCellValue("H51", $var79);
	$objPHPExcel->getActiveSheet()->SetCellValue("H53", $var80);
	$objPHPExcel->getActiveSheet()->SetCellValue("H54", $var81);
	$objPHPExcel->getActiveSheet()->SetCellValue("H55", $var82);

	$objPHPExcel->getActiveSheet()->SetCellValue("H58", $var83);
	$objPHPExcel->getActiveSheet()->SetCellValue("H59", $var84);
	$objPHPExcel->getActiveSheet()->SetCellValue("H60", $var85);

	$objPHPExcel->getActiveSheet()->SetCellValue("H62", $var86);
	$objPHPExcel->getActiveSheet()->SetCellValue("H63", $var87);
	$objPHPExcel->getActiveSheet()->SetCellValue("H64", $var88);
	$objPHPExcel->getActiveSheet()->SetCellValue("H65", $var89);

	$objPHPExcel->getActiveSheet()->SetCellValue("H68", $var90);

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
