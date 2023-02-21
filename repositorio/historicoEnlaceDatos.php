<?  

include ("../Conexiones/Conexion.php");
include("../funciones.php");	
include("../funcionesCarpetasV2.php");

if (isset($_POST["idUsuario"])){ $idUsuario = $_POST["idUsuario"]; }

if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }

if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
if (isset($_POST["format"])){ $format = $_POST["format"]; }

$nUni = getNunidad($conn, $idUnidad);
$nameUni = $nUni[0][0];

$mescap = getMesCapEnlaceArchivo($conn, $idEnlace, 1);	
$mescapen = $mescap[0][0];
$mescap = getAnioCapEnlaceArchivo($conn, $idEnlace, 1);	
$aniocapen = $mescap[0][0];


$fecha_actual_system=date("d/m/Y");

$anioactualdate = date("Y");

$mesCapturar = 5;
$anioCaptura = $aniocapen;
$mesNom = Mes_Nombre($mesCapturar);


switch ($format) {
	case 1:
	$chartipearch = "Carpetas de Investigación";
	break;

	case 4:
	$chartipearch = "Litigación";
	break;	

}

?>

<html>
<body>
	<head>
	</head>
	<div id="contenido">
		<div class="right_col" role="main" style ="height: auto;">

			<div style="" class="x_panel principalPanel">

				<div class="x_panel panelCabezera">

					<table border="0" class="alwidth">						
						<tr>								
							<td id="nomostrar" class="imgSelloCabezera" width="5%" height="125"></td>								
							<td width="50%">
								<div class="tituloCentralSegu">
									<div class="titulosCabe1">
										<label class="titulo1">Datos Historicos de Formatos Estadísticos DPE</label>
										<h4> <label class="titulo2">Fiscalía General del Estado de Michoácan</label></h4>
									</div>
								</div>
							</td>
							<td id="nomostrar" class="imgdgtipeCabezera" width="10%" height="125"></td>
						</tr>
					</table>

				</div>

				<div class="row">

					<div class="col-xs-12 col-sm-2  col-md-2">
						<label for="heard">Año:</label><br>
						<select id="anioHistorique" name="selMes" onchange="getDataHistoricaBD(<? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" tabindex="6" class="form-control redondear selectTranparent" required>

							<?
							$arrayANios = array(2020,2021,2022,2023,2024,2025,2026,2027,2028,2029,2030);

							for ($p=0; $p < sizeof($arrayANios) ; $p++) { 

								if($arrayANios[$p] == $anioCaptura){
									?>  <option value="<? echo $arrayANios[$p];  ?>" selected><? echo $arrayANios[$p] ?></option>  <?
								}else{
									?>  	<option value="<? echo $arrayANios[$p]; ?>" ><? echo $arrayANios[$p]  ?></option>  <?
								}
							}
							?>
						</select>
					</div>

					<div class="col-xs-12 col-sm-2  col-md-2">
						<label for="heard">Mes:</label><br>
						<select id="mesHistorique" name="selMes" onchange="getDataHistoricaBD(<? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" tabindex="6" class="form-control redondear selectTranparent">											
							<? 
							$arrayMeses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

							for ($k=1; $k <= 12 ; $k++) { 

								if($k == $mescapen){
									?>
									<option value="<? echo $k ?>" selected><? echo $arrayMeses[$k-1] ?></option>
									<?
								}else{

									?>
									<option value="<? echo $k ?>" ><? echo $arrayMeses[$k-1] ?></option>
									<?
								}
							}


							?>


						</select>
					</div>

					<div class="col-xs-12 col-sm-10  col-md-6">
						<label for="heard">Unidad:</label>
						<div id="contenidoEnlacesSelect">							
							<select id="enlaceid" class="form-control redondear selectTranparent">								



								<option value="0" selected="">Todos</option>


							</select>

						</div>
					</div>

					<div class="col-xs-12 col-sm-10  col-md-2">
						<label for="heard" style="color: transparent;">.</label>
						<div id="contenidoProyectosListAgru">							
							<button type="button" data-toggle="modal" href=""  onclick="descargarHisrtoricV2(1, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>);" class="btn btn-success btn-sm redondear btnCapturarTbl"><i class="far fa-file-excel" style="font-size:1.5em"></i> Descargar </button>

						</div>
					</div>
					<br>
				</div>
				<!-- Aqui comienza la tabla para el repositorio de archivos -->

				<div id="contenidoTablaRepositorioAdmin">

					<div id="respuestaDescargarCarpeta32"></div>
					<BR>
					<div id="contTableDataHistorique"><table class="table-hover" style="width: 100% !important;">

						<tbody style="">
							<tr style="border: solid 1px !important; ">
								<td style="background-color: whitesmoke; font-weight: bold; width: 300px !important; padding: 50px !important; border: solid 1px #E4E4E4;" rowspan="2">Agente del Ministerio Público</td>
								<td style="background-color: #d8d8d8 !important; text-align: center; padding: 10px !important; border: solid 1px #E4E4E4;" rowspan="2">Existencia Anterior</td>
								<td style="text-align: center; background-color: #ccffcc !important; padding: 10px !important; border: solid 1px #E4E4E4;" colspan="2">Iniciadas</td> 
								<td style="background-color: #ccffcc !important; padding: 10px !important; text-align: center; border: solid 1px #E4E4E4;" rowspan="2">Total Iniciadas</td>
								<td style="background-color: #ccffcc !important; padding: 10px !important; border: solid 1px #E4E4E4;" rowspan="2"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Reiniciadas</label></td>
								<td style="background-color: #ccffcc !important; padding: 10px !important; border: solid 1px #E4E4E4;" rowspan="2"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Recibidas por Otra Unidad</label></td>
								<td style="background-color: #ccffcc !important; padding: 10px !important; border: solid 1px #E4E4E4; text-align: center;" rowspan="2">Total a Trabajar</td>
								<td style="text-align: center; background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;" colspan="2">Judicializadas</td>
								<td style="background-color: #ccffff; padding: 10px !important; text-align: center; border: solid 1px #E4E4E4;" rowspan="2" >Total Judicializadas</td>
								<td style="background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;" rowspan="2"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Abstención de Investigación</label></td>
								<td style="background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;" rowspan="2"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Archivo Temporal</label></td>
								<td style="background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;" rowspan="2"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">No Ejercicio de la Acción Penal</label></td>
								<td style="text-align: center; background-color: #ccffff; border: solid 1px #E4E4E4;" colspan="4">Salidas Alternas</td>
								<td style=" background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;" rowspan="2"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Incompetencia</label></td>
								<td style="background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;" rowspan="2"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Acumulación</label></td>
								<td style="background-color: #ccffff; border: solid 1px #E4E4E4; text-align: center;" rowspan="2">Total Resoluciones</td>
								<td style="background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;" rowspan="2"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Enviadas a Unidad de Atención Temprana</label></td>
								<td style="background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;" rowspan="2"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Enviadas a Unidas de Investigación</label></td>
								<td style="background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;" rowspan="2"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Enviadas a Imputado Desconocido</label></td>
								<td style="background-color: #d8d8d8 !important; padding: 10px !important; border: solid 1px #E4E4E4;" rowspan="2">Tramite</td>

							</tr>
							<tr style="border: solid 1px !important;">
								<td style="text-align: center; background-color: #ccffcc !important; padding: 10px !important; border: solid 1px #E4E4E4;"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Con Detenido</label></td>
								<td style="text-align: center; background-color: #ccffcc !important; padding: 10px !important; border: solid 1px #E4E4E4;"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Sin Detenido</label></td>
								<td style="text-align: center; background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Con Detenido</label></td>
								<td style="text-align: center; background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;" ><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Sin Detenido</label></td>
								<td style="text-align: center; background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Mediación</label></td>
								<td style="text-align: center; background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;" ><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Conciliación</label></td>
								<td style="text-align: center; background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Criterios de Oportunidad</label></td>
								<td style="text-align: center; background-color: #ccffff; padding: 10px !important; border: solid 1px #E4E4E4;"><label style="writing-mode: vertical-lr; transform: rotate(180deg);">Suspension Condicional del Proceso</label></td>
							</tr>
							<? 

							$dos2 =0; 	$dos3 = 0;	$dos4 = 0;	$dos5 = 0; $dos6 = 0;	$dos7 = 0;			$dos8 = 0;	$dos9 = 0;	$dos10 = 0;			$dos11 = 0;		$dos12 = 0; 	$dos13 = 0;	$dos14 = 0; 
							$dos15 = 0; $dos16 = 0; 			$dos17 = 0;			$dos18 = 0;	$dos19 = 0; 		$dos20 = 0;		$dos21 = 0;	$dos22 = 0;		$dos23 = 0; 	$dos24 = 0; 
							$dos25 = 0;



							if($idEnlace == 18 || $idEnlace == 22 || $idEnlace == 16 || $idEnlace == 23 || $idEnlace == 19 || $idEnlace == 15 || $idEnlace == 21 || $idEnlace == 17 || $idEnlace == 14){


								if($idEnlace == 18){ $unidadedes = "IN(116,117,118,119)"; }
								if($idEnlace == 22){ $unidadedes = "IN(120,121,122,123,124,125)"; }
								if($idEnlace == 16){ $unidadedes = "IN(108,109,110,111,112,113,114,115,1008,1009,1010)"; }
								if($idEnlace == 23){ $unidadedes = "IN(71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,94,95,96,97,98)"; }
								if($idEnlace == 19){ $unidadedes = "IN(62,63,64,65,66,67,68,69,70,152,1005,1006)"; }
								if($idEnlace == 15){ $unidadedes = "IN(53,54,55,56,57,58,59,60,61,150,151)"; }
								if($idEnlace == 21){ $unidadedes = "IN(27,28,29,30,31,32,93,102,103)"; }
								if($idEnlace == 17){ $unidadedes = "IN(16,17,18,19,20,21,22,23,24,25,26,153,154)"; }
								if($idEnlace == 14){ $unidadedes = "IN(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,92,100,101)"; }

								$data = getDataMpsUniMesAnioUnids($conn, $unidadedes, $anioCaptura, $mescapen);	
								////// PARA LOS DATOS AGREGADOS A PARTIR DE JULIO 2021
								$datazx = getDatosCarpetasV2AllUnidad($conn, $mescapen, $anioCaptura, $unidadedes);
								

							}else{

								$data = getDataMpsUniMesAnio($conn, $idUnidad, $anioCaptura, $mescapen);
								////// PARA LOS DATOS AGREGADOS A PARTIR DE JULIO 2021
								$unso = "IN(".$idUnidad.")";
								$datazx = getDatosCarpetasV2AllUnidad($conn, $mescapen, $anioCaptura, $unso);
								
							}

							//////////////////////////////////////////////// 2021 HASTA JUNIO SE UTILIZA ESTA CONSULTA O CICLO ////////////////////////////////////////////////
							///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
							///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
							///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
							if($aniocapen <= 2021 && $mescapen <= 6){



								for( $i=0; $i<sizeof($data); $i++){

									$idUnidadese = $data[$i][27];
									$naun = getNunidad($conn, $idUnidadese);


									$dos2 = $dos2 + $data[$i][2]; $dos3 = $dos3 + $data[$i][3]; 	$dos4 = $dos4 + $data[$i][4]; 	$dos5 = $dos5 + $data[$i][5]; 	$dos6 = $dos6 + $data[$i][6]; 
									$dos7 = $dos7 + $data[$i][7]; $dos8 = $dos8 + $data[$i][8]; 	$dos9 = $dos9 + $data[$i][9]; 	$dos10 = $dos10 + $data[$i][10]; 	$dos11 = $dos11 + $data[$i][11]; 
									$dos12 = $dos12 + $data[$i][12]; $dos13 = $dos13 + $data[$i][13]; $dos14 = $dos14 + $data[$i][14]; 	$dos15 = $dos15 + $data[$i][15]; $dos16 = $dos16 + $data[$i][16]; 
									$dos17 = $dos17 + $data[$i][17]; $dos18 = $dos18 + $data[$i][18]; $dos19 = $dos19 + $data[$i][19]; 	$dos20 = $dos20 + $data[$i][20]; 	$dos21 = $dos21 + $data[$i][21]; 
									$dos22 = $dos22 + $data[$i][22]; $dos23 = $dos23 + $data[$i][23]; $dos24 = $dos24 + $data[$i][24]; 	$dos25 = $dos25 + $data[$i][25]; 

									$nombre = $data[$i][1];		
									?>
									<tr style="background-color:rgba(255,255,255,0.8); border: solid 1px #E4E4E4 !important; ">																															
										<td style="width: 300px !important;  padding: 10px !important;  border: solid 1px #E4E4E4 !important;">	<? echo "<label style='font-weight: bold;'>".$nombre."</label><br>".$naun[0][0]; ?></td>
										<td style="font-weight: bold;  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][2]; ?></td>
										<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][3]; ?></td>
										<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][4]; ?></td>
										<td style="font-weight: bold;  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][5]; ?></td>
										<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][6]; ?></td>
										<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][7]; ?></td>
										<td style=" font-weight: bold; border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][8]; ?></td>
										<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][9]; ?></td>
										<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][10]; ?></td>
										<td style=" font-weight: bold; border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][11]; ?></td>
										<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][12]; ?></td>
										<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][13]; ?></td>
										<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][14]; ?></td>
										<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][15]; ?></td>
										<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][16]; ?></td>
										<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][17]; ?></td>
										<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][18]; ?></td>
										<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][19]; ?></td>
										<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][20]; ?></td>
										<td style=" font-weight: bold; border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][21]; ?></td>
										<td style=" border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][22]; ?></td>
										<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][23]; ?></td>
										<td style="  border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][24]; ?></td>
										<td style=" font-weight: bold; border: solid 1px #E4E4E4 !important; text-align: center;">	<? echo $data[$i][25]; ?></td>
									</tr>				

									<?


								}

								?>

								<tr style="background-color: white !important; border: solid 1px #E4E4E4 !important; ">

									<td style="background-color: #ccffff;  border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	TOTAL </td>
									<td style="background-color: #ccffff; padding: 15px !important;  border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos2; ?> </td>
									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos3; ?> </td>
									<td style="background-color: #ccffff;  border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos4; ?> </td>
									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos5; ?> </td>
									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos6; ?> </td>
									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos7; ?> </td>
									<td style="background-color: #ccffff;  border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos8; ?> </td>
									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos9; ?> </td>
									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos10; ?> </td>
									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos11; ?> </td>
									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos12; ?> </td>
									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos13; ?> </td>
									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos14; ?> </td>
									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos15; ?> </td>
									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos16; ?> </td>
									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos17; ?> </td>
									<td style="background-color: #ccffff; border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos18; ?> </td>
									<td style="background-color: #ccffff;  border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos19; ?> </td>
									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos20; ?> </td>
									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos21; ?> </td>
									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos22; ?> </td>
									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos23; ?> </td>
									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos24; ?> </td>
									<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;">	<? echo $dos25; ?> </td>


								</tr>

								<?
							}	
							//////////////////////////////////////////////// 2021 HASTA JUNIO SE UTILIZA ESTA CONSULTA O CICLO ////////////////////////////////////////////////
							///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
							///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
							///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
							else{



								if ($mescapen == 1) {
									$mesAnterior = 12;
									$anioAnte = ($aniocapen - 1);
								} else {
									$anioAnte = $aniocapen;
									$mesAnterior = ($mescapen - 1);
								}
					
					
								for ($i = 0; $i < sizeof($datazx); $i++) {
						
									$idUnidadese = $datazx[$i][7];
									$naun = getNunidad($conn, $idUnidadese);
									$nombre = $datazx[$i][9];
					
					
									$nuevaexistenciaAnt = getDataCarpetasDatosExistenciaAnteriorV2($conn, $mesAnterior, $anioAnte, $datazx[$i][7], $datazx[$i][8]);
											$tramAnterior =  intval($nuevaexistenciaAnt[0][7]);
						
											$nuevaexistencia = getDataCarpetasDatosExistenciaAnteriorV2($conn, $mescapen, $aniocapen, $datazx[$i][7], $datazx[$i][8], 0);
											$tramAnterior2 =  intval($nuevaexistencia[0][7]);
											
											$de11 = getCountNucs($conn, 1, $mescapen, $aniocapen, $datazx[$i][7], $datazx[$i][8], 0);
						
											$de21 = getCountNucs($conn, 22, $mescapen, $aniocapen, $datazx[$i][7], $datazx[$i][8], 1);
											$de31 = getCountNucs($conn, 22, $mescapen, $aniocapen, $datazx[$i][7], $datazx[$i][8], 0);
						
											$de41 = getCountNucs($conn, 2, $mescapen, $aniocapen, $datazx[$i][7], $datazx[$i][8], 0);
											$de51 = getCountNucs($conn, 5, $mescapen, $aniocapen, $datazx[$i][7], $datazx[$i][8], 0);
											$de61 = getCountNucs($conn, 20, $mescapen, $aniocapen, $datazx[$i][7], $datazx[$i][8], 0);
											$de71 = getCountNucs($conn, 21, $mescapen, $aniocapen, $datazx[$i][7], $datazx[$i][8], 0);
											$de81 = getCountNucs($conn, 3, $mescapen, $aniocapen, $datazx[$i][7], $datazx[$i][8], 0);
											$de91 = getCountNucs($conn, 23, $mescapen, $aniocapen, $datazx[$i][7], $datazx[$i][8], 0);
											$de101 = getCountNucs($conn, 24, $mescapen, $aniocapen, $datazx[$i][7], $datazx[$i][8], 0);
											$de111 = getCountNucs($conn, 25, $mescapen, $aniocapen, $datazx[$i][7], $datazx[$i][8], 0);
											$de121 = getCountNucs($conn, 15, $mescapen, $aniocapen, $datazx[$i][7], $datazx[$i][8], 0);
						
											$iniciadasCd = $nuevaexistencia[0][5];
											$iniciadasSd = $nuevaexistencia[0][6];
											$iniciadas = $nuevaexistencia[0][0];
											$recibidas = $nuevaexistencia[0][1];
						
								
											$totalTrabajar = intval($tramAnterior) + intval($iniciadas) + intval($recibidas) + intval($de11[0][0]); 
						
											$judicializadas = $de21[0][0] + $de31[0][0];
											$totResoluciones = $de21[0][0] + $de31[0][0] + $de41[0][0] + $de51[0][0] + $de61[0][0] + $de71[0][0] + $de81[0][0] + $de91[0][0] + $de101[0][0] + $de111[0][0] + $de121[0][0];
						
											$enviUATP = $nuevaexistencia[0][2];
											$enviUI = $nuevaexistencia[0][3];
											$enviMp = $nuevaexistencia[0][4];
						
											$tramiteFinls = 	$totalTrabajar - ($totResoluciones + $enviUATP + $enviUI + $enviMp);
					
					
									?>
																<tr style="background-color:rgba(255,255,255,0.8); border: solid 1px #E4E4E4 !important; ">
																	<td style="width: 300px !important;  padding: 10px !important;  border: solid 1px #E4E4E4 !important;"> <? echo "<label style='font-weight: bold;'>" . $nombre . "</label><br>" . $naun[0][0]; ?></td>
																	<td style="font-weight: bold;  border: solid 1px #E4E4E4 !important; text-align: center;"> <? echo $tramAnterior; ?></td>
																	<td style="  border: solid 1px #E4E4E4 !important; text-align: center;"> <? echo $iniciadasCd; ?></td>
																	<td style="  border: solid 1px #E4E4E4 !important; text-align: center;"> <? echo $iniciadasSd; ?></td>
																	<td style="font-weight: bold;  border: solid 1px #E4E4E4 !important; text-align: center;"> <? echo $iniciadas; ?></td>
																	<td style="  border: solid 1px #E4E4E4 !important; text-align: center;"> <? echo number_format($de11[0][0]); ?></td>
																	<td style="  border: solid 1px #E4E4E4 !important; text-align: center;"> <? echo $recibidas; ?></td>
																	<td style=" font-weight: bold; border: solid 1px #E4E4E4 !important; text-align: center;"> <? echo $totalTrabajar; ?></td>
					
																	<td style="  border: solid 1px #E4E4E4 !important; text-align: center;"> <? echo number_format($de21[0][0]); ?></td>
																	<td style="  border: solid 1px #E4E4E4 !important; text-align: center;"> <? echo number_format($de31[0][0]); ?></td>
																	<td style=" font-weight: bold; border: solid 1px #E4E4E4 !important; text-align: center;"> <? echo $judicializadas; ?></td>
																	<td style="  border: solid 1px #E4E4E4 !important; text-align: center;"> <? echo number_format($de41[0][0]); ?></td>												
																	<td style="  border: solid 1px #E4E4E4 !important; text-align: center;"> <? echo number_format($de51[0][0]); ?></td>												
																	<td style="  border: solid 1px #E4E4E4 !important; text-align: center;"> <? echo number_format($de61[0][0]); ?></td>												
																	<td style="  border: solid 1px #E4E4E4 !important; text-align: center;"> <? echo number_format($de91[0][0]); ?></td>												
																	<td style="  border: solid 1px #E4E4E4 !important; text-align: center;"> <? echo number_format($de101[0][0]); ?></td>												
																	<td style="  border: solid 1px #E4E4E4 !important; text-align: center;"> <? echo number_format($de111[0][0]); ?></td>
																	<td style="  border: solid 1px #E4E4E4 !important; text-align: center;"> <? echo number_format($de121[0][0]); ?></td>
																	<td style="  border: solid 1px #E4E4E4 !important; text-align: center;"> <? echo number_format($de71[0][0]); ?></td>
																	<td style="  border: solid 1px #E4E4E4 !important; text-align: center;"> <? echo number_format($de81[0][0]); ?></td>
																	
																	<td style=" font-weight: bold; border: solid 1px #E4E4E4 !important; text-align: center;"> <? echo $totResoluciones; ?></td>
																	<td style=" border: solid 1px #E4E4E4 !important; text-align: center;"> <? echo $enviUATP; ?></td>
																	<td style="  border: solid 1px #E4E4E4 !important; text-align: center;"> <? echo $enviUI; ?></td>
																	<td style="  border: solid 1px #E4E4E4 !important; text-align: center;"> <? echo $enviMp; ?></td>
																	<td style=" font-weight: bold; border: solid 1px #E4E4E4 !important; text-align: center;"> <? echo $tramiteFinls; ?></td>
																</tr>
						
															<?
					
					
									////// LO FINAL //////
									$dos2 = $dos2 + $tramAnterior;
									$dos3 = $dos3 + $iniciadasCd;
									$dos4 = $dos4 + $iniciadasSd;
									$dos5 = $dos5 + $iniciadas;
									$dos6 = $dos6 + number_format($de11[0][0]);
					
									$dos7 = $dos7 + $recibidas;
									$dos8 = $dos8 + $totalTrabajar;
									$dos9 = $dos9 + number_format($de21[0][0]);
									$dos10 = $dos10 + number_format($de31[0][0]);
									$dos11 = $dos11 + number_format($judicializadas);
					
									$dos12 = $dos12 + number_format($de41[0][0]);
									$dos13 = $dos13 + number_format($de51[0][0]);
									$dos14 = $dos14 + number_format($de61[0][0]);
									$dos15 = $dos15 + number_format($de91[0][0]);
									$dos16 = $dos16 + number_format($de101[0][0]);
					
									$dos17 = $dos17 + number_format($de111[0][0]);
									$dos18 = $dos18 + number_format($de121[0][0]);
									$dos19 = $dos19 + number_format($de71[0][0]);
									$dos20 = $dos20 + number_format($de81[0][0]);
									$dos21 = $dos21 + number_format($totResoluciones);
					
									$dos22 = $dos22 + $enviUATP;
									$dos23 = $dos23 + $enviUI;
									$dos24 = $dos24 + $enviMp;
									$dos25 = $dos25 + $tramiteFinls;
									//// LO FINAL /////
					
								}
					
			

								?>


<tr style="background-color: white !important; border: solid 1px #E4E4E4 !important; ">
	
	<td style="background-color: #ccffff;  border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> TOTAL </td>
	<td style="background-color: #ccffff; padding: 15px !important;  border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> <? echo $dos2; ?> </td>
	<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> <? echo $dos3; ?> </td>
	<td style="background-color: #ccffff;  border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> <? echo $dos4; ?> </td>
	<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> <? echo $dos5; ?> </td>
	<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> <? echo $dos6; ?> </td>
	<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> <? echo $dos7; ?> </td>
	<td style="background-color: #ccffff;  border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> <? echo number_format($dos8); ?> </td>
	<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> <? echo $dos9; ?> </td>
	<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> <? echo $dos10; ?> </td>
	<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> <? echo $dos11; ?> </td>
	<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> <? echo $dos12; ?> </td>
	<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> <? echo $dos13; ?> </td>
	<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> <? echo $dos14; ?> </td>
	<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> <? echo $dos15; ?> </td>
	<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> <? echo $dos16; ?> </td>
	<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> <? echo $dos17; ?> </td>
	<td style="background-color: #ccffff; border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> <? echo $dos18; ?> </td>
	<td style="background-color: #ccffff;  border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> <? echo $dos19; ?> </td>
	<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> <? echo $dos20; ?> </td>
	<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> <? echo $dos21; ?> </td>
	<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> <? echo $dos22; ?> </td>
	<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> <? echo $dos23; ?> </td>
	<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> <? echo $dos24; ?> </td>
	<td style="background-color: #ccffff;   border: solid 1px #E4E4E4 !important; text-align: center; font-weight: bolder;"> <? echo $dos25; ?> </td>


				</tr>


								<?



							}

							?>




						</tbody>

					</table><br><br></div>



					<div class="x_panel piepanel">
						<div class="piepanel2">
							<div class="piepanel3">
								<div class="piepanel4">
									<label style="color: #686D72;">SISTEMA INTEGRAL DE REGISTRO ESTADISTICO Copyright © Todos los Derechos Reservados</label>
								</div>
							</div>

						</div>				
					</div>



				</div>


			</div>			

		</div>


	</div>









