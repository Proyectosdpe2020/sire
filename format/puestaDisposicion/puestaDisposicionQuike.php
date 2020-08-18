
	<?php
	session_start();
	include ("../../Conexiones/Conexion.php");
	include("../../funciones.php");	
	include ("../../Conexiones/conexionSicap.php");
		include("../../funcioneLit.php");
	include("../../funcioneSicap.php");


 	$idUsuario = $_SESSION['useridIE'];

	if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }

	$enlace = getInfoEnlaceUsuario($conn, $idUsuario);
	$idEnlace = $enlace[0][0];
	$idfisca = $enlace[0][1];	



	$mescap = getMesCapEnlaceArchivo($conn, $idEnlace, 9);	
	$mescapen = $mescap[0][0];

	$mesCapturar = $mescapen;


	$anioCaptura = 2019;


 	$mesNom = Mes_Nombre($mesCapturar);
 	$idUsuario = $_SESSION['useridIE'];


	?>

	<div id="contenido">
		<div class="right_col" role="main">

			<div style="" class="x_panel principalPanel">

				<div class="x_panel panelCabezera">

					<table border="0" class="alwidth">						
							<tr>								
								<td id="nomostrar" class="imgSelloCabezera" width="5%" height="125"></td>								
								<td width="50%">
											<div class="tituloCentralSegu">
												<div class="titulosCabe1">
													<label class="titulo1" style="color: #686D72;">Registro Diário de Puestas a Disposición</label>
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
						<select id="anioCmasc" name="selMes" tabindex="6" class="form-control redondear selectTranparent" required>
							<option value="2018" selected><? echo $anioCaptura; ?></option>
						</select>
					</div>

					<div class="col-xs-6 col-sm-4  col-md-1">
						<label for="heard">Mes:</label><br>
						<select id="mesCmasc" name="selMes" tabindex="6"class="form-control redondear selectTranparent" required>
							<option value="<? echo $mesCapturar; ?>" selected><? echo $mesNom; ?></option>
						</select>
					</div>

					<div class="col-xs-6 col-sm-4  col-md-1">
						<label for="heard">Día:</label><br>
						<select id="mesCmasc" name="selMes" tabindex="6"class="form-control redondear selectTranparent" required>
							<option value="<? echo $mesCapturar; ?>" selected> Miercoles-9</option>
						</select>
					</div>

					<div class="col-xs-6 col-sm-4  col-md-6">
						<label for="heard">Mando:</label><br>
						<select id="mesCmasc" name="selMes" tabindex="6"class="form-control redondear selectTranparent" required>
							<option value="<? echo $mesCapturar; ?>" >  Todos </option>
							<option value="<? echo $mesCapturar; ?>" selected>  CHRISTIAN DONALDO CORTES BARCENAS </option>
						</select>
					</div>

					<div class="col-xs-6 col-sm-4  col-md-1">
								<label class="transparente">.</label>		
								<center><button type="button"  onclick="" class="btn btn-warning btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-cloud-download"></span> Descargar </button></center>

					</div>
					<div class="col-xs-6 col-sm-4  col-md-2">
								<label class="transparente">.</label>		
								<center><button type="button" data-toggle="modal" href="#puestdispos" style="white-space: normal;"  onclick="showmodalPueDispo();" class="btn btn-success btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-plus-sign"></span> Nueva Puesta Disposición </button></center>

					</div>
					

				</div>

				<div id="respuestaDescargarCarpeta"> 
								
				</div>

					<div class="contTblMPs" id="contTblMPs2">

						<div id="tablempss" class="row pad20">							
					
								<table class="table table-hover">
									<thead>
										<tr class="cabezeraTabla10">
											<th class="col-xs-1 col-sm-1 col-md-1 textCent">ID</th>
													<th class="col-xs-1 col-sm-4 col-md-3textCent10">Mando</th>
													<th class="col-xs-4 col-sm-4 col-md-1 ">Nuc</th>
													<th class="col-xs-4 col-sm-4 col-md-1 textCent">Fecha Evento</th>
													<th class="col-xs-4 col-sm-4 col-md-1 textCent">Fecha Informe</th>
													<th class="col-xs-4 col-sm-4 col-md-2 textCent">Dirección</th>
													<th class="col-xs-4 col-sm-4 col-md-2 textCent">Colonia</th>
													<th class="col-xs-4 col-sm-4 col-md-1 textCent">Codigo Postal </th>
													<th class="col-xs-1 col-sm-1 col-md-1 textCent">Municipio</th>													
													<th class="col-xs-1 col-sm-1 col-md-1 textCent">Fiscalia</th>
													
													<th class="textCent">Accion </th>

										</tr>
									</thead>
									<tbody>
										

														<tr>
																
																<td class="textCent tddispo">4547</td>
																	<td class="tddispo">CHRISTIAN DONALDO CORTES BARCENAS </td>
																		<td class=" tddispo">10032048787</td>
																			<td class="textCent tddispo">10/12019</td>
																				<td class="textCent tddispo">10/12019</td>
																					<td class="textCent tddispo">Calle sin numero Col Prados Verdes S/N</td>
																					<td class="textCent tddispo">Prados Verdes</td>
																						<td class="textCent tddispo">550044</td>
																							<td class="textCent tddispo">Morelia</td>
																								<td class="textCent tddispo">Morelia</td>
																									<td class="textCent tddispo"><button  type="button" onclick="" class="btn btn-info btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-eye-open"></span> </button></td>

														</tr>

																<tr>
																
																<td class="textCent tddispo">4547</td>
																	<td class="tddispo">CHRISTIAN DONALDO CORTES BARCENAS </td>
																		<td class=" tddispo">10032048787</td>
																			<td class="textCent tddispo">10/12019</td>
																				<td class="textCent tddispo">10/12019</td>
																					<td class="textCent tddispo">Calle sin numero Col Prados Verdes S/N</td>
																					<td class="textCent tddispo">Prados Verdes</td>
																						<td class="textCent tddispo">550044</td>
																							<td class="textCent tddispo">Morelia</td>
																								<td class="textCent tddispo">Morelia</td>
																									<td class="textCent tddispo"><button  type="button" onclick="" class="btn btn-info btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-eye-open"></span> </button></td>

														</tr>

		<tr>
																
																<td class="textCent tddispo">4547</td>
																	<td class="tddispo">CHRISTIAN DONALDO CORTES BARCENAS </td>
																		<td class=" tddispo">10032048787</td>
																			<td class="textCent tddispo">10/12019</td>
																				<td class="textCent tddispo">10/12019</td>
																					<td class="textCent tddispo">Calle sin numero Col Prados Verdes S/N</td>
																					<td class="textCent tddispo">Prados Verdes</td>
																						<td class="textCent tddispo">550044</td>
																							<td class="textCent tddispo">Morelia</td>
																								<td class="textCent tddispo">Morelia</td>
																									<td class="textCent tddispo"><button  type="button" onclick="" class="btn btn-info btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-eye-open"></span> </button></td>

														</tr>

		<tr>
																
																<td class="textCent tddispo">4547</td>
																	<td class="tddispo">CHRISTIAN DONALDO CORTES BARCENAS </td>
																		<td class=" tddispo">10032048787</td>
																			<td class="textCent tddispo">10/12019</td>
																				<td class="textCent tddispo">10/12019</td>
																					<td class="textCent tddispo">Calle sin numero Col Prados Verdes S/N</td>
																					<td class="textCent tddispo">Prados Verdes</td>
																						<td class="textCent tddispo">550044</td>
																							<td class="textCent tddispo">Morelia</td>
																								<td class="textCent tddispo">Morelia</td>
																									<td class="textCent tddispo"><button  type="button" onclick="" class="btn btn-info btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-eye-open"></span> </button></td>

														</tr>

		<tr>
																
																<td class="textCent tddispo">4547</td>
																	<td class="tddispo">CHRISTIAN DONALDO CORTES BARCENAS </td>
																		<td class=" tddispo">10032048787</td>
																			<td class="textCent tddispo">10/12019</td>
																				<td class="textCent tddispo">10/12019</td>
																					<td class="textCent tddispo">Calle sin numero Col Prados Verdes S/N</td>
																					<td class="textCent tddispo">Prados Verdes</td>
																						<td class="textCent tddispo">550044</td>
																							<td class="textCent tddispo">Morelia</td>
																								<td class="textCent tddispo">Morelia</td>
																									<td class="textCent tddispo"><button  type="button" onclick="" class="btn btn-info btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-eye-open"></span> </button></td>

														</tr>

		<tr>
																
																<td class="textCent tddispo">4547</td>
																	<td class="tddispo">CHRISTIAN DONALDO CORTES BARCENAS </td>
																		<td class=" tddispo">10032048787</td>
																			<td class="textCent tddispo">10/12019</td>
																				<td class="textCent tddispo">10/12019</td>
																					<td class="textCent tddispo">Calle sin numero Col Prados Verdes S/N</td>
																					<td class="textCent tddispo">Prados Verdes</td>
																						<td class="textCent tddispo">550044</td>
																							<td class="textCent tddispo">Morelia</td>
																								<td class="textCent tddispo">Morelia</td>
																									<td class="textCent tddispo"><button  type="button" onclick="" class="btn btn-info btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-eye-open"></span> </button></td>

														</tr>

		<tr>
																
																<td class="textCent tddispo">4547</td>
																	<td class="tddispo">CHRISTIAN DONALDO CORTES BARCENAS </td>
																		<td class=" tddispo">10032048787</td>
																			<td class="textCent tddispo">10/12019</td>
																				<td class="textCent tddispo">10/12019</td>
																					<td class="textCent tddispo">Calle sin numero Col Prados Verdes S/N</td>
																					<td class="textCent tddispo">Prados Verdes</td>
																						<td class="textCent tddispo">550044</td>
																							<td class="textCent tddispo">Morelia</td>
																								<td class="textCent tddispo">Morelia</td>
																									<td class="textCent tddispo"><button  type="button" onclick="" class="btn btn-info btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-eye-open"></span> </button></td>

														</tr>

		<tr>
																
																<td class="textCent tddispo">4547</td>
																	<td class="tddispo">CHRISTIAN DONALDO CORTES BARCENAS </td>
																		<td class=" tddispo">10032048787</td>
																			<td class="textCent tddispo">10/12019</td>
																				<td class="textCent tddispo">10/12019</td>
																					<td class="textCent tddispo">Calle sin numero Col Prados Verdes S/N</td>
																					<td class="textCent tddispo">Prados Verdes</td>
																						<td class="textCent tddispo">550044</td>
																							<td class="textCent tddispo">Morelia</td>
																								<td class="textCent tddispo">Morelia</td>
																									<td class="textCent tddispo"><button  type="button" onclick="" class="btn btn-info btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-eye-open"></span> </button></td>

														</tr>

		<tr>
																
																<td class="textCent tddispo">4547</td>
																	<td class="tddispo">CHRISTIAN DONALDO CORTES BARCENAS </td>
																		<td class=" tddispo">10032048787</td>
																			<td class="textCent tddispo">10/12019</td>
																				<td class="textCent tddispo">10/12019</td>
																					<td class="textCent tddispo">Calle sin numero Col Prados Verdes S/N</td>
																					<td class="textCent tddispo">Prados Verdes</td>
																						<td class="textCent tddispo">550044</td>
																							<td class="textCent tddispo">Morelia</td>
																								<td class="textCent tddispo">Morelia</td>
																									<td class="textCent tddispo"><button  type="button" onclick="" class="btn btn-info btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-eye-open"></span> </button></td>

														</tr>

		<tr>
																
																<td class="textCent tddispo">4547</td>
																	<td class="tddispo">CHRISTIAN DONALDO CORTES BARCENAS </td>
																		<td class=" tddispo">10032048787</td>
																			<td class="textCent tddispo">10/12019</td>
																				<td class="textCent tddispo">10/12019</td>
																					<td class="textCent tddispo">Calle sin numero Col Prados Verdes S/N</td>
																					<td class="textCent tddispo">Prados Verdes</td>
																						<td class="textCent tddispo">550044</td>
																							<td class="textCent tddispo">Morelia</td>
																								<td class="textCent tddispo">Morelia</td>
																									<td class="textCent tddispo"><button  type="button" onclick="" class="btn btn-info btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-eye-open"></span> </button></td>

														</tr>

		<tr>
																
																<td class="textCent tddispo">4547</td>
																	<td class="tddispo">CHRISTIAN DONALDO CORTES BARCENAS </td>
																		<td class=" tddispo">10032048787</td>
																			<td class="textCent tddispo">10/12019</td>
																				<td class="textCent tddispo">10/12019</td>
																					<td class="textCent tddispo">Calle sin numero Col Prados Verdes S/N</td>
																					<td class="textCent tddispo">Prados Verdes</td>
																						<td class="textCent tddispo">550044</td>
																							<td class="textCent tddispo">Morelia</td>
																								<td class="textCent tddispo">Morelia</td>
																									<td class="textCent tddispo"><button  type="button" onclick="" class="btn btn-info btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-eye-open"></span> </button></td>

														</tr>

		<tr>
																
																<td class="textCent tddispo">4547</td>
																	<td class="tddispo">CHRISTIAN DONALDO CORTES BARCENAS </td>
																		<td class=" tddispo">10032048787</td>
																			<td class="textCent tddispo">10/12019</td>
																				<td class="textCent tddispo">10/12019</td>
																					<td class="textCent tddispo">Calle sin numero Col Prados Verdes S/N</td>
																					<td class="textCent tddispo">Prados Verdes</td>
																						<td class="textCent tddispo">550044</td>
																							<td class="textCent tddispo">Morelia</td>
																								<td class="textCent tddispo">Morelia</td>
																									<td class="textCent tddispo"><button  type="button" onclick="" class="btn btn-info btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-eye-open"></span> </button></td>

														</tr>




														

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

										<div id="modalValidateNucs" class="modal-dialog modal-sm" style="height: 80vh !important; width: 55%; margin-top: 1%;" >

																	<div class="modal-content" style="background-color: white !important; height: 100vh;   border-radius: 20px;" >

																					<div style="height: 5%; width: 100%; padding: 0 !important; border-radius:  20px 20px 0px 0px; background-color:  #008BCA;">

																									<div style="border-radius: 20px;">

																														<center><label style="padding-top: 10px; color: white; font-weight: bold; font-size: 2rem;">Puesta a Disposición</label></center>
																									</div>

																					</div>
																					
																					<div id="contMOdalPuedispos" style="padding: 1%;">
																						

																									


																					</div>


																	</div>				
										</div>												

		</div>



	</html>