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
																																									
																																									

																																										</table>



																																			</div>
																																	 

																																		<div class="col-xs-12 col-sm-4 col-md-4" style="">


																																				<table border="0" id="table1110" width="100%" style="margin-top: -10px;">						
																		
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
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Apelaciones no admitidas</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][43] ?></center></td>		
																																												</tr>
																																													<tr>				
																																																<td style="width: 25%;" class="tdFiscalia"><label class="labelFiscalia">Procedimientos abreviados </label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><? echo $data[0][30] ?></center></td>		
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
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Total de audiencias</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][56] ?></center></td>		
																																												</tr>



																																										</table>


																																		</div>


																																			<div class="col-xs-12 col-sm-4 col-md-4" style="">



																																							<table border="0" id="table1110" width="100%" style="margin-top: -10px;">						
																																													

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
																																																<td style="width: 25%;" class="tdFiscalia"><br><label class="labelFiscalia">Total de Carpetas Judicializadas en trámite</label></td>			
																																																<td style="width: 3%; font-weight: bold" class="tdFiscalia"><center><br><? echo $data[0][49] ?></center></td>		
																																												</tr>


																																										</table>



																																			</div>

																														</div>

