<?  

	include ("../Conexiones/Conexion.php");
	include("../funciones.php");	
	include("../funcioneLit.php");	
			
	if (isset($_POST["idUsuario"])){ $idUsuario = $_POST["idUsuario"]; }

	if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }

	if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
	if (isset($_POST["format"])){ $format = $_POST["format"]; }



	$nUni = getNunidad($conn, $idUnidad);
	$nameUni = $nUni[0][0];

	$namefis = getNameFiscaEnlace2($conn, $idEnlace);

	$mescap = getMesCapEnlaceArchivo($conn, $idEnlace, 4);	
	$mescapen = $mescap[0][0];

	$mescap = getAnioCapEnlaceArchivo($conn, $idEnlace, 4);	
	$aniocapen = $mescap[0][0];


	$mesCapturar = $mescapen;
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

	$data = getDatosLitigacionMpUnidad2($conn, $mesCapturar,$anioCaptura, $idUnidad);



?>

<html>
<body>
<head>
</head>
		<div id="contenido">
							<div class="right_col" role="main" style ="height: auto;">

													<div class="x_panel principalPaneli" style="">

															<div class="x_panel ">
																		
																		<table border="0" class="alwidth">						
																					<tr>								
																						<td id="nomostrar" class="imgSelloCabezera" width="5%" height="125"></td>								
																						<td width="50%">
																									<div class="tituloCentralSegu">
																										<div class="titulosCabe1">
																											<h4> <label class="titulo2">Fiscalía General del Estado de Michoácan</label></h4>
																											<label class="titulo100" style="color: #566573 ; font-weight: bolder;">DIRECCIÓN GENERAL DE TECNOLOGÍAS DE LA INFORMACIÓN, PLANEACIÓN Y ESTADÍSTICA</label>
																											<h4> <label class="titulo2">Dirección de Planeación y Estadística</label></h4>
																										</div>
																									</div>
																						</td>
																						<td id="nomostrar" class="imgdgtipeCabezera" width="10%" height="125"></td>
																					</tr>
																			</table><br><br>

																				<table border="0" id="table111" width="100%" style="margin-top: -50px;">						
																					<tr >					
																									<td style="width: 30%;" class="tdFiscalia"><label class="labelFiscalia">Fiscalía Regional:</label></td>			
																									<td colspan="3" style="width: 70%; color: #566573 ; font-weight: bolder;" class="tdFiscalia">FISCALÍA REGIONAL DE  <? echo $namefis[0][0]; ?></td>			
																					</tr>
																						<tr >					
																									<td style="width: 30%;" class="tdFiscalia"><label class="labelFiscalia">Área de Adscripción:</label></td>			
																									<td colspan="3" style="width: 70%;" class="">
																											
																											<select id="enlaceid" class="form-control redondear selectTranparent">								
																						


																						<option value="0" selected=""><? echo $nameUni; ?></option>


																					</select>

																									</td>			
																					</tr>
																						<tr >					
																									<td style="width: 30%;" class="tdFiscalia"><label class="labelFiscalia">Periodo que informa:</label></td>	
																									<td style="width: 10%;" class="">
																										
																											<select id="anioHistoriqueLiti" name="selMes" onchange="getDataHistoricaBDlitiga(<? echo $idUnidad; ?>)" tabindex="6" class="form-control redondear selectTranparent" required>
																					
																														<?
																																	$arrayANios = array(2020,2021);

																																	for ($p=0; $p < sizeof($arrayANios) ; $p++) { 
																																					
																																					if($arrayANios[$p] == $anioCaptura){
																																						?>  <option value="<? echo $arrayANios[$p];  ?>" selected><? echo $arrayANios[$p] ?></option>  <?
																																					}else{
																																							?>  	<option value="<? echo $arrayANios[$p]; ?>" ><? echo $arrayANios[$p]  ?></option>  <?
																																					}
																																	}
																														 ?>
																											</select>

																									</td>			
																									<td style="width: 40%;" class="">	



																										<select id="mesHistoriqueLiti" name="selMes" onchange="getDataHistoricaBDlitiga(<? echo $idUnidad; ?>)" tabindex="6" class="form-control redondear selectTranparent">											
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
																		        

																		        	</td>			
																		        	<td style="width: 20%;">
																		        						
																		        							<button type="button" data-toggle="modal" href=""  onclick="descargarHistoricLitig(4, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>);" class="btn btn-success btn-sm redondear btnCapturarTbl"><i class="far fa-file-excel" style="font-size:1.5em"></i> Descargar </button>

																		        	</td>
																					</tr><br>																	

																				
																		

																			</table>


																						<div class="row"  style=" padding: 10px; margin: 10px;">
																				
																							<div class="col-xs-12 col-sm-12  col-md-12">
																									
																														<div class="row" id="contDataUpdLitigacionUnidad">
																																	
																																		<div class="col-xs-12 col-sm-4 col-md-4" style=" ">

																																									<table border="0" id="table1110" width="100%" style="margin-top: -10px;">						
																		                        	<div id="respDesc"></div>
																																													<tr >					
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia">Existencia anterior (+)</label></td>			
																																																<td style="width: 3%; font-weight: bold;" class="tdFiscalia"><center><? echo $data[0][0] ?></center></td>		
																																												</tr>
																																												<tr >					
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia">Recibidas por Otro Ministerio Público</label></td>			
																																																<td style="width: 3%; font-weight: bold;" class="tdFiscalia"><center><? echo $data[0][105] ?></center></td>		
																																												</tr>
																																												
																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Carpetas Judicializadas</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][1] ?></center></td>		
																																												</tr>
																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Con detenido (+)</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][2] ?></center></td>				
																																												</tr>
																																												 <tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Sin detenido (+)</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][3] ?></center></td>		
																																												</tr>
																																												<tr>
																																													<td>
																																														<br><label class="labelFiscalia">ETAPA INICIAL</label>
																																													</td>
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Formulaciones de Imputación</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][92] + $data[0][93]; ?></center></td>		
																																												</tr>
																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Solicitadas</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][91] ?></center></td>				
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Otorgadas</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][92] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Negadas</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][93] ?></center></td>		
																																												</tr>

																																														<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Control de la Detención</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][94] + $data[0][95] ?></center></td>		
																																												</tr>
																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Legal</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][94] ?></center></td>				
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Ilegal</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][95] ?></center></td>		
																																												</tr>

																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Vinculación a proceso</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][4] + $data[0][5] + $data[0][6] ?></center></td>		
																																												</tr>
																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Auto de vinculación </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][4] ?></center></td>				
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Auto de no vinculación (-)</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][5] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Mixtos</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][6] ?></center></td>		
																																												</tr>


																																														<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Medidas Cautelares</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][97] + $data[0][98] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Solicitadas</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][96] ?></center></td>				
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Otorgadas</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][98] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Negadas</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][97] ?></center></td>		
																																												</tr>



																																																<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Imposición de medidas cautelares</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][7] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Prisión preventiva oficiosa</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][8] ?></center></td>				
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Prisión preventiva justificada</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][9] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Presentación periodica ante el juez</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][10] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">La exhibición de una garantia economica</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][11] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">El embargo de bienes</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][12] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">La inmovilización de cuentas y demas valores</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][13] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">La prohibición de salir sin autorización que fije el juez</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][14] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">El sometimiento al cuidado o vigilacia o institucio determinada</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][15] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">La pohibición de concurrir a determinadas reuniones o ciertos lugares</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][16] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">La prohibición de convivir o comunicarse con determinadas personas</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][17] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">La separación inmediata del domicilio</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][18] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">La suspensión temporal en el ejercicio del cargo</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][19] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">La suspensión temporal en actividad profesional o laboral</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][20] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">La colocación de localizadores electrónicos</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][21] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">El resguardo en su propio domicilio con las modalidades que el juez disponga</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][22] ?></center></td>		
																																												</tr>
	
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Citaciones</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][32] ?></center></td>		
																																												</tr>

																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Cateos Solicitados</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][33] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2"> Cateos concedidos</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][34] ?></center></td>				
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Cateos negados</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][35] ?></center></td>		
																																												</tr>
																																									

																																														<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Órdenes negadas</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][36] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Aprehensión</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][37] ?></center></td>				
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Comparecencia</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][38] ?></center></td>		
																																												</tr>

																																														<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Órdenes Solicitadas</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][107] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Aprehensión</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][108] ?></center></td>				
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Comparecencia</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][109] ?></center></td>		
																																												</tr>

																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Mandamientos Judiciales Girados</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][50] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Órdenes de aprehensión </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][51] ?></center></td>				
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Órdenes de comparecencia </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][52] ?></center></td>		
																																												</tr>


																																														<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Mandamientos Judiciales Cumplidos</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][53] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Órdenes de aprehensión </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][54] ?></center></td>				
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Órdenes de comparecencia </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][55] ?></center></td>		
																																												</tr>

																																									
																																									

																																										</table>



																																			</div>
																																	 

																																	 	<div class="col-xs-12 col-sm-4 col-md-4" style="">


																																	 			<table border="0" id="table1110" width="100%" style="margin-top: -10px;">	

																																	 				      <tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Medidas de protección</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][110] ?></center></td>		
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Total de víctimas de protección </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][111] ?></center></td>		
																																												</tr>


																																	 				      <tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Actos de investigación CON control judicial</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][112] ?></center></td>		
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Intervención en tiempo real </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][113] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Toma de muestras </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][114] ?></center></td>		
																																												</tr>
																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Exhumación </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][115] ?></center></td>		
																																												</tr>
																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Obtención de datos reservados </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][116] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Intervención de comunicación en su modalidad de extracción </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][117] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">La providencia precautoria (embargo de bienes e inmovilizacion de cuentas bancarias) </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][118] ?></center></td>		
																																												</tr>


																																	 				      <tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Actos de investigación SIN control judicial</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][119] ?></center></td>		
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Cadena de custodia </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][120] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Inspección de lugar distinto a hechos </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][121] ?></center></td>		
																																												</tr>
																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Inspección de inmuebles </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][122] ?></center></td>		
																																												</tr>
																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Entrevistas entre testigos  </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][123] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Reconocimiento entre personas </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][124] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Solicitud de informes periciales </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][125] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Solicitud de información de Institutos de Seguridad </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][126] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Reconocimiento o examen físico de persona </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][127] ?></center></td>		
																																												</tr>

																																												<tr>
																																													<td>
																																														<br><label class="labelFiscalia">ETAPA INTERMEDIA</label>
																																													</td>
																																												</tr>

																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Acusaciones Presentadas</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][99] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Audiencia Intermedia escrita </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][57] ?></center></td>				
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Audiencia Intermedia oral </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][58] ?></center></td>		
																																												</tr>

																																												<tr>
																																													<td>
																																														<br><label class="labelFiscalia">JUICIO ORAL</label>
																																													</td>
																																												</tr>

																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Resoluciones de Juicio oral</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][128] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Audiencia de juicio oral </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][129] ?></center></td>				
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Audiencia de fallo </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][130] ?></center></td>				
																																												</tr>
																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Audiencia de individualización de sanción </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][132] ?></center></td>				
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Procedimiento especial </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][133] ?></center></td>				
																																												</tr>
																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Absolutorio </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][131] ?></center></td>				
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Condenatorio </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][134] ?></center></td>				
																																												</tr>

																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Sentencias</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][62] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Condenatorias (-)</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][63] ?></center></td>				
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Absolutorias (-)</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][64] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Mixtas (-)</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][65] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Se condena reparación del daño</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][66] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">No se condena reparación del daño</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][67] ?></center></td>		
																																												</tr>

																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Total de audiencias</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][56] ?></center></td>		
																																												</tr>

																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">De las sentencias dictadas</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][86] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Revocaciones favorables al Ministerio Público</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][87] ?></center></td>				
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Modificaciones favorables al Ministerio Público</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][88] ?></center></td>		
																																												</tr>

																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Confirmaciones favorables al Ministerio Público</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][89] ?></center></td>		
																																												</tr>

																																												<tr>
																																													<td>
																																														<br><label class="labelFiscalia">SALIDAS ALTERNAS Y/O TERMINACIÓN ANTICIPADA</label>
																																													</td>
																																												</tr>		

																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Soluciones alternas</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][59] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Suspensión condicional del proceso </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][60] ?></center></td>				
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Acuerdo reparatorio </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][61] ?></center></td>		
																																												</tr>
																																														<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Procedimientos abreviados </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][30] ?></center></td>		
																																												</tr>
																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Mecanismos de aceleración </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][135] ?></center></td>		
																																												</tr>

																																										</table>


																																	 	</div>


																																			<div class="col-xs-12 col-sm-4 col-md-4" style="">



																																							<table border="0" id="table1110" width="100%" style="margin-top: -10px;">			

																																												<tr>
																																													<td>
																																														<br><label class="labelFiscalia">INCIDENTES Y/O RECURSOS NO SUJETOS A ETAPA PROCESAL</label>
																																													</td>
																																												</tr>			
																																													

																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Apelaciones contra resolución del juez de control</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][71] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Negar anticipo de prueba</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][72] ?></center></td>				
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Negar acuerdo reparatorio</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][73] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Negar o cancelar orden de aprehensión</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][74] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Negar orden de cateo</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][75] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%; " class="tdFiscalia"><label class="labelFiscalia2">Providencias Precautorias o Medida Cautelar</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][76] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Las que pongan termino al procedimiento o lo suspedan</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][77] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Auto que resuelve la vinculaciona proceso</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][78] ?></center></td>		
																																												</tr>
																																														<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Las que concedan, revoquen o nieguenla suspensión condicional del proceso</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][79] ?></center></td>		
																																												</tr>

		<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Negativa de abrir procedimiento abreviado</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][80] ?></center></td>		
																																												</tr>

		<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Sentencia definitiva en el procedimiento abreviado/label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][81] ?></center></td>		
																																												</tr>

		<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Excluir algún medio de prueba</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][82] ?></center></td>		
																																												</tr>

																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Apelaciones no admitidas</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][43] ?></center></td>		
																																												</tr>
																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Apelaciones por amparo</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][136] ?></center></td>		
																																												</tr>

																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Amparos</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][137] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Amparo directo</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][138] ?></center></td>				
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Amparo indirecto</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][139] ?></center></td>		
																																												</tr>



																																														<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Apelaciones contra resoluciones del Tribunal de enjuiciamiento</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][83] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Desistimiento de la acción penal</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][84] ?></center></td>				
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Sentencia definitiva</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][85] ?></center></td>		
																																												</tr>

																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Sobreseimientos decretados</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][23] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Prescripción de la acción penal (-)</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][24] ?></center></td>				
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Por mecanismos alternativos (-)</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][25] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Acuerdo reparatorio</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][26] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Suspension condicional del proceso</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][27] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Criterio de oportunidad</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][28] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Terminación anticipada (-)</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][29] ?></center></td>		
																																												</tr>

																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Acumulación (-)</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][31] ?></center></td>		
																																												</tr>

																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Incompetencias</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][68] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Decretadas (-)</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][69] ?></center></td>				
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Admitidas (+)</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][70] ?></center></td>		
																																												</tr>

																																												

																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Causas dados de baja (-)</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][90] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Por cambio de situación jurídica declarados sin materia</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][90] ?></center></td>				
																																												</tr>


																																														<tr >					
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia">Canalizadas por cese de funciones del Ministerio Público</label></td>			
																																																<td style="width: 3%; font-weight: bold;" class="tdFiscalia"><center><? echo $data[0][106] ?></center></td>		
																																												</tr>


																																														<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Desistimiento del recurso (-)</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][39] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Por parte del acusado</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][40] ?></center></td>				
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Por parte del defensor</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][41] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Por parte del Ministerio Público</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][42] ?></center></td>		
																																												</tr>

																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Sentencias dictadas (-)</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][44] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Revoca</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][45] ?></center></td>				
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Modifica</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][46] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Confirma</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][47] ?></center></td>		
																																												</tr>
																																														<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Reposición del procedimiento</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][48] ?></center></td>		
																																												</tr>



																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Total de Carpetas Judicializadas en trámite</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][49] ?></center></td>		
																																												</tr>


																																										</table>



																																			</div>

																														</div>


																							</div>


																			</div>


																

																	

															</div>

															<!-- Aqui comienza la tabla para el repositorio de archivos -->

															 


													</div>			

													 <div id="contenidoTablaRepositorioAdmin">
							    													
															  		
							    													<BR>
																		   


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

 



										



