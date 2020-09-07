 
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

	$mescap = getMesCapEnlaceArchivo($conn, $idEnlace, 9);	
	$mescapen = $mescap[0][0];

	$mesCapturar = $mescapen;




	$anioCaptura = 2020;

 	
 	$idUsuario = $_SESSION['useridIE'];

 	 	if(date("l") === "Monday"){ $numeroDia = 1; $diaLetra = "Lunes"; }
 	  if(date("l") === "Tuesday"){ $numeroDia = 2; 	$diaLetra = "Martes";}
 	  if(date("l") === "Wednesday"){ $numeroDia = 3; 	$diaLetra = "Miercoles";}
   	if(date("l") === "Thursday"){ $numeroDia = 4; 	$diaLetra = "Jueves";}
 	 	if(date("l") === "Friday"){ $numeroDia = 5; 	$diaLetra = "Viernes";}
 	 	if(date("l") === "Saturday"){ $numeroDia = 6; 	$diaLetra = "Sabado";}
 	 	if(date("l") === "Sunday"){ $numeroDia = 7; 	$diaLetra = "Domingo";}

 	 	$diames= date("d");
 	 	
 	 	$currentmonth = date("m");
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
													<label class="titulo1" style="color: #686D72;">Actualizacion de mandos </label>
													<h4> <label id="titfisc" class="titulo2">Fiscalía General del Estado de Michoácan</label></h4>
												</div>
											</div>
								</td>
								<td id="nomostrar" class="imgdgtipeCabezera" width="10%" height="125"></td>
							</tr>
					</table>


				</div>

				<div class="row pad20">

					<div class="col-xs-6 col-sm-4  col-md-4">
						<label for="heard">Area de adscripción</label><br>
						<select id="areaAdsc" name="areaAdsc" tabindex="6" class="form-control redondear selectTranparent" required>
							<option value="" selected>areas</option>
						</select>
					</div>
	

					<div class="col-xs-6 col-sm-4  col-md-5">
						<label for="heard">Mando:</label><br>
						<select id="mesCmasc" name="selMes" tabindex="6"class="form-control redondear selectTranparent" required>
							<option value="" >  Todos </option>
						</select>
					</div>
 
		
					<div class="col-xs-6 col-sm-4  col-md-3">
								<label class="transparente">.</label>		
								<center><button type="button" data-toggle="modal" href="#puestdispos" style="white-space: normal;"  onclick="showmodalPueDispo(0, <? echo $idEnlace; ?>,0,<? echo $tiparchiv; ?>, 1);" class="btn btn-success btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-plus-sign"></span> REGISTRAR NUEVO MANDO </button></center>

					</div>
					

				</div>

				<div id="respuestaDescargarCarpeta"> 
								
				</div>

					<div class="contTblMPs" id="contTblMPs2">

						<div id="tablePuestasData" class="row pad20">							
					
								<table class="table table-striped  table-hover">
									<thead>
										<tr class="cabezeraTabla10">
											<th class="textCent">#</th>
										 <th class="textCent10">Nombre</th>
											<th class="textCent10">Cargo</th>
											<th class="textCent10">Función</th>
											<th class="textCent10">Area de adscripción</th>
											<th class="textCent10">ACCIONES</th>
										</tr>
									</thead>
									<tbody>
										<td>1</td>
										<td>JOSE DANIEL PEREZ LOVOA</td>
										<td>AGENTE DEL MINISTERIO PUBLICO</td>
										<td>AGENTE DEL MINISTERIO PUBLICO</td>
										<td>AGENTE DEL MINISTERIO PUBLICO</td>
										<td>EDITAR</td>
									</tbody>
									</table>
							
							</div>

						</div><br>

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