<?  

	include ("../Conexiones/Conexion.php");
	include("../funciones.php");	
	include("../funcioneLit.php");	
			
	if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }

	if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }

	if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }


	$data = getDatosLitigacionMpUnidad2($conn, $mes,$anio, $idUnidad);



?>

	<div class="row" id="contDataUpdLitigacionUnidad">


																																	<div class="col-xs-12 col-sm-12 col-md-12" style=" ">
																																		      	<div class="x_panel panelCabezera">

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
					</table>


				</div>

																																									<table  border="0" id="#table_inicio" width="100%" style="margin-top: 10px;">
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
																																									</table>

																																		</div>
																																	
																																		<div class="col-xs-12 col-sm-12 col-md-12" style=" ">

																																									<table  id="table1110" width="100%" style="margin-top: 10px;">						
																				                       <div id="respDesc"></div>
																																													<tr >					
																																																<td style="width: 100%; text-align: center;" class="tdFiscalia"><label class="labelFiscalia">ETAPA INICIAL </label></td>			
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
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Acumulación (-)</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][31] ?></center></td>		
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
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Apelaciones no admitidas</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][43] ?></center></td>		
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

																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia">Actos de investigación con control judicial </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>		
																																												</tr>

																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia">La providencia precautoria (embargo de bienes e inmovilizacion de cuentas bancarias) </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>		
																																												</tr>

																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia">Toma de muestras </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>		
																																												</tr>

																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia">Exhumación </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>		
																																												</tr>

																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia">Obtención de datos reservados </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>		
																																												</tr>

																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia">Extracción de contenido </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>		
																																												</tr>

																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia">Intervención en tiempo real</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>		
																																												</tr>
																																									
																																									

																																										</table>



																																			</div>
																																	 

																																		<div class="col-xs-12 col-sm-12 col-md-12" style="">


																																				<table border="0" id="table_intermedia" width="100%" style="margin-top: 10px;">						
																		
																																													
																																														<tr>				
																																																<td style="width: 100%; text-align: center;" class="tdFiscalia"><br><label class="labelFiscalia">ETAPA INTERMEDIA</label></td>			
																																
																																												</tr>

																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Acusaciones Presentadas</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][99] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Acusaciones por escrito </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][57] ?></center></td>				
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Audiencia Intermedia  </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][58] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Duración (Horas)  </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][58] ?></center></td>		
																																												</tr>


																																										</table>


																																		</div>

																																		<div class="col-xs-12 col-sm-12 col-md-12" style="">


																																				<table border="0" id="table_alternas" width="100%" style="margin-top: 10px;">						
																		
																																													
																																														<tr>				
																																																<td style="width: 100%; text-align: center;" class="tdFiscalia"><br><label class="labelFiscalia">SALIDAS ALTERNAS</label></td>			
																																
																																												</tr>

																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia2">Soluciones alternas</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][99] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Suspensión condicional del proceso </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][57] ?></center></td>				
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Acuerdo reparatorio   </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][58] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Mecanismos de aceleración  </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][58] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Procedimientos Abreviados  </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][58] ?></center></td>		
																																												</tr>

																																										</table>


																																		</div>


																																		<div class="col-xs-12 col-sm-12 col-md-12" style="">


																																				<table border="0" id="table_juicioOral" width="100%" style="margin-top: 10px;">						
																		
																																													
																																														<tr>				
																																																<td style="width: 100%; text-align: center;" class="tdFiscalia"><br><label class="labelFiscalia">Juicio Oral</label></td>			
																																
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Audiencias de juicio oral</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br>0</center></td>		
																																												</tr>

																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Audiencia de fallo</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Absolutorio</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Condenatorio</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Audiencia de individualización desanción </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Procedimiento especial </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>		
																																												</tr>

																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Sentencias</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br>0</center></td>		
																																												</tr>

																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Condenatorias</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Absolutorias </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Mixta</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Se condena reparación del daño </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">No se condena reparación del daño </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>		
																																												</tr>
																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Incompetencias</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br>0</center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Decretadas </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Admitidas </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>		
																																												</tr>



																																										</table>


																																		</div>



																																			<div class="col-xs-12 col-sm-12 col-md-12" style="">



																																							<table border="0" id="table_etapaProcesal" width="100%" style="margin-top: 10px;">	

																																							<tr>				
																																																<td style="width: 100%; text-align: center;" class="tdFiscalia"><br><label class="labelFiscalia">	INCIDENTES Y/O RESERVAS NO SUJETAS A ETAPA PROCESAL</label></td>			
																																
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
																																																<td style="width: 25%; " class="tdFiscalia"><br><label class="labelFiscalia">Providencias Precautorias o Medida Cautelar</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><br><center><? echo $data[0][76] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Las que pongan termino al procedimiento o lo suspedan</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][77] ?></center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Auto que resuelve la vinculaciona proceso</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><br><center><? echo $data[0][78] ?></center></td>		
																																												</tr>
																																														<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Las que concedan, revoquen o nieguenla suspensión condicional del proceso</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][79] ?></center></td>		
																																												</tr>

		<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Negativa de abrir procedimiento abreviado</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><br><center><? echo $data[0][80] ?></center></td>		
																																												</tr>

		<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Sentencia definitiva en el procedimiento abreviado/label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][81] ?></center></td>		
																																												</tr>

		<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Amparo</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br>0</center></td>		
																																												</tr>



																																														<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Directo</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Indirecto</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][84] ?></center></td>				
																																												</tr>
																																															

																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Sobreseimientos Decretados</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br>0</center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Prescripción de la acción pena</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br></center></td>				
																																												</tr>
																																															<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Por Muerte del Imputado </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>		
																																												</tr>

																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Por mecanismos alternativos</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>		
																																												</tr>

																																														<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Acuerdo reparatorio</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>		
																																												</tr>

																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Suspensión condicional del proceso</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br>0</center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Criterio de oportunidad</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>				
																																												</tr>


																																														<tr >					
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Terminación anticipada</label></td>			
																																																<td style="width: 3%; font-weight: bold;" class="tdFiscalia"><center>0</center></td>		
																																												</tr>



																																														<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Acumulación</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br>0</center></td>		
																																												</tr>
																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Desistimiento del recurso</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br>0</center></td>		
																																												</tr>
																																												<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Por parte del acusado </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center>0</center></td>				
																																												</tr>


																																														<tr >					
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Por parte del defensor </label></td>			
																																																<td style="width: 3%; font-weight: bold;" class="tdFiscalia"><center>0</center></td>		
																																												</tr>

																																												<tr >					
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia2">Por parte del Ministerio Público </label></td>			
																																																<td style="width: 3%; font-weight: bold;" class="tdFiscalia"><center>0</center></td>		
																																												</tr>

																																										</table>



																																			</div>

																														</div>




<!--akiiiiiii-->

