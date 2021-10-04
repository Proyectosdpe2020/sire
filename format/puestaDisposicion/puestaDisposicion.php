 
	<?php
	session_start();

		

	include ("../../Conexiones/Conexion.php");
	include("../../funciones.php");	
	include ("../../Conexiones/conexionSicap.php");
		include("../../funcioneLit.php");
	include("../../funcioneSicap.php");
		include("../../funcionesPueDispo.php");	


 	$idUsuario = $_SESSION['useridIE'];
 	

	if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }

	$enlace = getInfoEnlaceUsuario($conn, $idUsuario);
	$idEnlace = $enlace[0][0];
	$idfisca = $enlace[0][1];	


	$tipoArchov = get_type_archive($conn, $idEnlace);
	$tiparchiv = $tipoArchov[0][0];
/*
	$mescap = getMesCapEnlaceArchivo($conn, $idEnlace, 9);	
	$mescapen = $mescap[0][0];

	$mesCapturar = $mescapen;
 */

 $mescap = getMesCapEnlacePolicia($conn, $idEnlace, 9);	
	$anioCap = $mescap[0][0];
	$mesCap = $mescap[0][1];
	$enviado = $mescap[0][2];
	$enviadoArc = $mescap[0][3];
 


	//$anioCaptura = 2021;

 	
 	$idUsuario = $_SESSION['useridIE'];

 	 	if(date("l") === "Monday"){ $numeroDia = 1; $diaLetra = "Lunes"; }
 	  if(date("l") === "Tuesday"){ $numeroDia = 2; 	$diaLetra = "Martes";}
 	  if(date("l") === "Wednesday"){ $numeroDia = 3; 	$diaLetra = "Miercoles";}
   	if(date("l") === "Thursday"){ $numeroDia = 4; 	$diaLetra = "Jueves";}
 	 	if(date("l") === "Friday"){ $numeroDia = 5; 	$diaLetra = "Viernes";}
 	 	if(date("l") === "Saturday"){ $numeroDia = 6; 	$diaLetra = "Sabado";}
 	 	if(date("l") === "Sunday"){ $numeroDia = 7; 	$diaLetra = "Domingo";}

 	 	$diames= date("d");
 	 	
 	 	$currentmonth = date("n");
 	 	$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
		$mesNom = Mes_Nombre($currentmonth);

	?>

	<div id="contenido" style="">
		<div class="right_col" role="main" style="">

			<div style="" class="x_panel principalPanel" >

				<div class="x_panel panelCabezera">

					<table border="0" class="alwidth">						
							<tr>								
								<td id="nomostrar" class="imgSelloCabezera" width="5%" height="125"></td>								
								<td width="50%">
											<div class="tituloCentralSegu">
												<div class="titulosCabe1">
													<label class="titulo1" style="color: #686D72;">Registro Diario de Actividades</label>
													<h4> <label id="titfisc" class="titulo2">Fiscalía General del Estado de Michoácan</label></h4>
												</div>
											</div>
								</td>
								<td id="nomostrar" class="imgdgtipeCabezera" width="10%" height="125"></td>
							</tr>
					</table>


				</div>

				<div class="row pad20">

					<div class="col-xs-6 col-sm-4  col-md-1">
						<label for="heard">Año:</label><br>
						<select id="anioCmasc" name="selMes" tabindex="6" class="form-control redondear selectTranparent" onchange="reloadDaysMonth(<? echo $idEnlace; ?>)" required>
							 <?php
							 $dataAnio = getDataAnio();
							 for ($i = 0; $i < sizeof($dataAnio); $i++){
							 	$anioCaptura = $dataAnio[$i][0];	?>
									<option value="<? echo $anioCaptura; ?>" selected><? echo $anioCaptura; ?></option>
								<? } ?>
						</select>
					</div>

					<div class="col-xs-6 col-sm-4  col-md-1">
						<label for="heard">Mes:</label><br><div id="contMonth">
						<select id="mesPuestaSelected" name="selMes" tabindex="6"class="form-control redondear selectTranparent" onchange="loadDaysMonth(<? echo $anioCaptura; ?>, <? echo $idEnlace; ?>, 0)" required>
							
							<? 
								for ($g=1; $g <= 12 ; $g++) { 											
											if($g == intval($currentmonth)){
													?>
													<option value="<? echo $currentmonth; ?>" selected><? echo $mesNom; ?></option>
													<?
												}else{ 
													?>
													<option value="<? echo $g; ?>" ><? echo $meses[$g-1]; ?></option>
													<?
												}
										}
							 ?>
							
						</select></div>
					</div>

					<div class="col-xs-6 col-sm-4  col-md-1">
						<label for="heard">Día:</label><br>
							<div id="contDays">
						<select id="diaSeleted" name="selMes" tabindex="6"class="form-control redondear selectTranparent" onchange="loadDataPuestDay(<? echo $anioCaptura; ?>, <? echo $idEnlace; ?>, 0)" required>
							<option value="0">Todo</option>
							<? 
									$diasNumero = cal_days_in_month(CAL_GREGORIAN, $currentmonth, $anioCaptura);

									for ($t=1; $t <= $diasNumero ; $t++) { 												
												if($t == $diames){
													?>
														<option value="<? echo $t; ?>" selected> <? echo "".$diaLetra."-".$diames; ?></option>	
													<?
												}else{
														$fecha = $t."-".$currentmonth."-".$anioCaptura; 
														$nommesa =  getDiaMesnombre($fecha);
													?>
														<option value="<? echo $t; ?>"> <? echo "".$nommesa."-".$t; ?></option>	
													<?
												}
									}
							?>
							
						</select></div>
					</div>

					<div class="col-xs-6 col-sm-4  col-md-6">
						<label for="heard">Agente:</label><br>
						<select id="mesCmasc" name="selMes" tabindex="6"class="form-control redondear selectTranparent" required>
							<option value="" >  Todos </option>
						</select>
					</div>

			
					<div class="col-xs-12 col-sm-12  col-md-3">
								<label class="transparente">.</label>		
								<center><button type="button" data-toggle="modal" href="#puestdispos" style="white-space: normal;"  onclick="showmodalPueDispo(0, <? echo $idEnlace; ?>,0,<? echo $tiparchiv; ?>, 1);" class="btn btn-success btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-plus-sign"></span> Registro Nueva Actividad </button></center>

					</div>
					

				</div>
				<br>
				<div class="col-md-6 col-md-offset-3" id="preloaderIMG" hidden>
						<img src="images/cargando.gif"/>
					</div>

				<table id="gridPolicia" class="display table table-striped  table-hover" width="100%" >
				<thead>
					<tr class="cabeceraConsultaPolicia">
						<th class="textCent">ID</th>
													<th class="textCent10">Agente</th>
													<th class="">Nuc</th>
													<th class=" textCent">Fecha Evento</th>
													<th class=" textCent">Fecha Informe</th>
													<th class=" textCent">Fiscalía</th>
													<th class=" textCent">Municipio</th>
													<th class=" textCent">Colonia</th>
													<th class=" textCent">Calle </th>
													<th class=" textCent">Numero</th>													
													<th class=" textCent">Codigo Postal</th>	
													<th class="textCent">Accion </th>
		
					</tr>
				</thead> 
				<tbody id="contentConsulta">
					<? 
																				$dataPuestasDia = get_data_puesta_dia($conn, $numeroDia, $diames, $anioCaptura, $idfisca, $idEnlace, $currentmonth);


																							for ($h=0; $h < sizeof($dataPuestasDia) ; $h++) { 

																									?>
																										<tr><td> <? echo $dataPuestasDia[$h][0]; ?> </td>
																										<td> <? echo $dataPuestasDia[$h][1]; ?> </td>
																										<td> <? echo $dataPuestasDia[$h][2]; ?> </td>
																									<td> 	<center><? echo $dataPuestasDia[$h][3]->format('Y-m-d H:i'); ?></center> </td>
																										<td> <center><? echo $dataPuestasDia[$h][4]->format('Y-m-d H:i'); ?></center></td>
																										<td> <center><? echo $dataPuestasDia[$h][5]; ?></center> </td>
																										<td> <center><? echo $dataPuestasDia[$h][6]; ?></center> </td>
																										<td> <? echo $dataPuestasDia[$h][7]; ?> </td>
																										<td> <? echo $dataPuestasDia[$h][8]; ?> </td>
																										<td> <center><? echo $dataPuestasDia[$h][9]; ?></center> </td>
																										<td> <center><? echo $dataPuestasDia[$h][10]; ?></center> </td>
<td><center><label class="glyphicon glyphicon-edit" data-toggle="modal" href="#puestdispos" onclick="showmodalPueDispo(1, <? echo $idEnlace; ?>, <? echo $dataPuestasDia[$h][0]; ?>, <? echo 	$tiparchiv; ?>, 1)" style="width: 95%; cursor: pointer; font-weight: bold; color: green;">  Editar</label></center></td></tr>
																									<?		

																							}																			

															 ?>
   </tbody>
  </table><br>

				

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

		</body>


<!-- ESTE ES EL MODAL QUE VA A CARGAR LA PANTALLA FINAL PARA LA VALIDACION NUCS CORRESPONDAN AL NUMERO PUESTO EL EL CAMPO NUMERICO  -->


			<div class="modal fade bs-example-modal-sm" id="puestdispos" role="dialog" data-backdrop="static" data-keyboard="false">
										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 85%; margin-top: 0.5%;">
																	<div class="modal-content" style="">
																					<div id="contMOdalPuedispos"></div>
																	</div>				
										</div>					
			</div>

		
			<div class="modal fade bs-example-modal-sm" id="puestdisposVehic" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 40%; margin-top: 0.5%;">
																	<div class="modal-content" style="">
																					<div id="contMOdalPuedisposVehic"></div>
																	</div>				
										</div>			
			</div>


						<div class="modal fade bs-example-modal-sm" id="modalPersonas" role="dialog" data-backdrop="static" data-keyboard="false">
										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 55%; margin-top: 0.5%;">
																	<div class="modal-content" style="">
																					<div id="contModalPersonas">																						
																					</div>
																	</div>				
										</div>		
						</div>


							<div class="modal fade bs-example-modal-sm" id="modalForestales" role="dialog" data-backdrop="static" data-keyboard="false">
										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 35%; margin-top: 2.5%;">
																	<div class="modal-content" style="">
																					<div id="contModalForestales2">																						
																					</div>
																	</div>				
										</div>		
						</div>

							<div class="modal fade bs-example-modal-sm" id="modalDrogase" role="dialog" data-backdrop="static" data-keyboard="false">
										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 30%; margin-top: 2.5%;">
																	<div class="modal-content" style="">
																					<div id="contModalDrogas">												
																					</div>
																	</div>				
										</div>		
						</div>

										<div class="modal fade bs-example-modal-sm" id="modalObjetoAsegurado" role="dialog" data-backdrop="static" data-keyboard="false">
										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 30%; margin-top: 2.5%;">
																	<div class="modal-content" style="">
																					<div id="contModalObjetoAsegurado">																						
																					</div>
																	</div>				
										</div>		
						</div>


							<div class="modal fade bs-example-modal-sm" id="modalDineroAsegurado" role="dialog" data-backdrop="static" data-keyboard="false">
										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 45%; margin-top: 2.5%;">
																	<div class="modal-content" style="">
																					<div id="contModalDineroAsegurado">																						
																					</div>
																	</div>				
										</div>		
						</div>

							<div class="modal fade bs-example-modal-sm" id="modalDefunciones" role="dialog" data-backdrop="static" data-keyboard="false">
										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 45%; margin-top: 2.5%;">
																	<div class="modal-content" style="">
																					<div id="contModalDefunciones">																						
																					</div>
																	</div>				
										</div>		
						</div>

						<div class="modal fade bs-example-modal-sm" id="modalTrabajosDeCampo" role="dialog" data-backdrop="static" data-keyboard="false">
										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 30%; margin-top: 2.5%;">
																	<div class="modal-content" style="">
																					<div id="contModalTrabajosDeCampo">																						
																					</div>
																	</div>				
										</div>		
						</div>

							<div class="modal fade bs-example-modal-sm" id="modalArmasAseguradas" role="dialog" data-backdrop="static" data-keyboard="false">
										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 45%; margin-top: 2.5%;">
																	<div class="modal-content" style="">
																					<div id="contModalArmasAseguradas">																						
																					</div>
																	</div>				
										</div>		
						</div>

		




	</html>