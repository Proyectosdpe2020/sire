<?php
session_start();
include("../../Conexiones/Conexion.php");
include("../../funciones.php");
include("../../funcionesProcesosPenales.php");

if (isset($_POST["idUnidad"])) {
	$idUnidad = $_POST["idUnidad"];
}
if (isset($_POST["idEnlace"])) {
	$idEnlace = $_POST["idEnlace"];
}

$dataCap = getMesCapEnlaceArchivo($conn, $idEnlace, 21);

$anioCapturando = $dataCap[0][1];
$mesCapturando = $dataCap[0][0];

$enviado = getEnviadoEnlaceFormato($conn, $idEnlace, 21);
$env = $enviado[0][0];
$envArch = $enviado[0][1];

$fisca = getFiscaliaDEenlace($conn, $idEnlace);
$fiscaliaID = $fisca[0][0];



$juzgado = getJuzgadosFiscaliasProcesosPenales($conn, $fiscaliaID);

$mesNom = Mes_Nombre($mesCapturando);
$idUsuario = $_SESSION['useridIE'];
$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$anios = array(2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030);

$juzgadFirs = topJuzgadoXFiscalia($conn, $fiscaliaID);


$data = getRegistrosProcesosPenalesData($conn, $mesCapturando, $anioCapturando, $fiscaliaID, $juzgadFirs[0][0]);
$a = sizeof($data);
$b = 0;
if ($a >= 1) {
	$b = 1;
}


?>

<div id="contenido">
	<div class="right_col" role="main">

		<div class="x_panel principalPanel">

			<div class="x_panel panelCabezera">
				<table border="0" class="alwidth">
					<tr>
						<td id="nomostrar" class="imgSelloCabezera" width="5%" height="125"></td>
						<td width="50%">
							<div class="tituloCentralSegu">
								<div class="titulosCabe1">
									<label class="titulo1" style="color: #686D72;">Control y Captura de Procesos Penales</label>
									<h4> <label class="titulo2">Fiscalía General del Estado de Michoácan</label></h4>
									<input type="hidden" id="mesActCaptu" value="<? echo $mesCapturando; ?>" />
									<input type="hidden" id="anioActCaptu" value="<? echo $anioCapturando; ?>" />
									<input type="hidden" id="idEnlacin" value="<? echo $idEnlace; ?>" />
								</div>
							</div>
						</td>
						<td id="nomostrar" class="imgdgtipeCabezera" width="10%" height="125"></td>
					</tr>
				</table>
			</div>


			<div class="panel panel-default">
				<div style="background-color: #f0ead6 !important;" class="panel-heading">

					<div class="row ">

						<div class="col-xs-12 col-sm-6 col-md-4">
							<label> FECHA ACTUAL DE CAPTURA: </label>
							<input class="form-control redondear selectTranparent" value="<?php echo $mesNom . " DE " . $anioCapturando; ?>" type="text" disabled value="">
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label> SUBPROCURADURÍA REGIONAL DE: </label>
							<?php
							$fiscalias =  getFiscaliasUsuario($conn, $idUsuario, 21);
							echo sizeof($fiscalias);
							?>
							<select style=" margin-right: 0%;" id="fiscaliaJuzgado" name="" onchange="loadDataProcesosPenalesJuzgados()" tabindex="6" class="form-control redondear selectTranparent" required>
								<?
								if (sizeof($fiscalias) > 1) {
								?>
									<option selected value="0">TODAS</option>
									<?
								}

								for ($i = 0; $i < sizeof($fiscalias); $i++) {
									if ($fiscalias[$i][0] == 4) {
									?>
										<option selected value="<? echo $fiscalias[$i][0]; ?>">
											<? echo $fiscalias[$i][1]; ?>
										</option>
									<?
									} else { ?>
										<option value="<? echo $fiscalias[$i][0]; ?>">
											<? echo $fiscalias[$i][1]; ?>
										</option>
								<?php
									}
								}
								?>
							</select>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<label> JUZGADO PENAL : </label>
							<div id="contentSelectJuzgadosProceso">
								<select style=" margin-right: 0%;" id="juzgado" onchange="loadDataProcesosPenales()" name="juzgado" tabindex="6" class="form-control redondear selectTranparent" required>
									<?

									for ($h = 0; $h < sizeof($juzgado); $h++) {
									?>
										<option value="<? echo $juzgado[$h][0] ?>">
											<? echo $juzgado[$h][1]; ?>
										</option>
									<?
									}
									?>
								</select>
							</div>
						</div>

					</div>
					<div class="row" style="margin-top:0.5% !important;">

						<div class="col-xs-12 col-sm-8 col-md-8">

							<div class="col-xs-12 col-sm-6 col-md-6">
								<label> INFORME CORRESPONDIENTE AL MES DE </label>
								<select id="mesIni" name="mesIni" onchange="loadDataProcesosPenales()" tabindex="6" class="form-control redondear selectTranparent" required>
									<?
									for ($f = 0; $f < sizeof($meses); $f++) {
										if (($f + 1) == $mesCapturando) {
									?>
											<option value="<? echo $f + 1; ?>" selected>
												<? echo $meses[$f]; ?>
											</option>
										<?
										} else {
										?>
											<option value="<? echo $f + 1; ?>">
												<? echo $meses[$f]; ?>
											</option>
									<? }
									}
									?>
								</select>
							</div>
							<div class="col-xs-12 col-sm-2 col-md-2">
								<label> DE EL AÑO : </label>
								<select id="anioIni" name="anioIni" onchange="loadDataProcesosPenales()" tabindex="6" class="form-control redondear selectTranparent" required>
									<?
									for ($c = 0; $c < sizeof($anios); $c++) {
										if (($anios[$c]) == $anioCapturando) {
									?>
											<option value="<? echo $anios[$c]; ?>" selected>
												<? echo $anios[$c]; ?>
											</option>
										<?
										} else {
										?>
											<option value="<? echo $anios[$c]; ?>">
												<? echo $anios[$c]; ?>
											</option>
									<?
										}
									}
									?>
								</select>

							</div>
							<div class="col-xs-12 col-sm-2 col-md-2">
								<label> A EL MES : </label>
								<select id="mesFin" name="mesFin" tabindex="6" onchange="loadDataProcesosPenales()" class="form-control redondear selectTranparent" required>
									<?
									for ($k = 0; $k < sizeof($meses); $k++) {
										if (($k + 1) == $mesCapturando) {
									?>
											<option value="<? echo $k + 1; ?>" selected>
												<? echo $meses[$k]; ?>
											</option>
										<?
										} else {
										?>
											<option value="<? echo $k + 1; ?>">
												<? echo $meses[$k]; ?>
											</option>
									<?
										}
									}
									?>
								</select>
							</div>
							<div class="col-xs-12 col-sm-2 col-md-2">
								<label> DE EL AÑO. : </label>
								<select id="anioFin" name="anioFin" onchange="loadDataProcesosPenales()" tabindex="6" class="form-control redondear selectTranparent" required>
									<?
									for ($c = 0; $c < sizeof($anios); $c++) {
										if (($anios[$c]) == $anioCapturando) {
									?>
											<option value="<? echo $anios[$c]; ?>" selected>
												<? echo $anios[$c]; ?>
											</option>
										<?
										} else {
										?>
											<option value="<? echo $anios[$c]; ?>">
												<? echo $anios[$c]; ?>
											</option>
									<?
										}
									}
									?>
								</select>
							</div>

						</div>
						<div class="col-xs-12 col-sm-4 col-md-4">
							<?php if ($fiscaliaID == 4) { ?>
								<div class="col-xs-12 col-sm-6 col-md-6"><br>
									<button type="button" onclick="enviarDPEprocesos(<?php echo $idEnlace; ?>, 21)" <?php if ($env == 1) {
																																																																																										echo "disabled";
																																																																																									} ?> class="btn btn-warning btn-sm redondear btnEnvDPE"><span class="glyphicon glyphicon-ok"></span> Enviar a DPE</button>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6"><br>
									<button type="button" data-toggle="modal" href="" onclick="descargarDocProcesoPenales()" class="btn btn-success btn-sm redondear btnCapturarTbl"><i class="far fa-file-excel" style="font-size:1.5em"></i> Descargar </button>
								</div>
							<?php } else { ?>
								<div class="col-xs-12 col-sm-12 col-md-12"><br>
									<button type="button" onclick="enviarDPEprocesos(<?php echo $idEnlace; ?>, 21)" <?php if ($env == 1) {
																																																																																										echo "disabled";
																																																																																									} ?> class="btn btn-success W-50 btn-sm redondear btnEnvDPE"><span class="glyphicon glyphicon-ok"></span> Enviar a DPE</button>
								</div>
							<?php } ?>
						</div>



					</div>

				</div>

				<div id="rsp"></div>
				<div id="mainContentForm" class="panel-body">

					<div class="row">
						<div class="col-sm-6">
							<div class="row">
								<div class="col-sm-12">
									<div class="w3-card-4" style="width:100%">
										<header class="w3-container w3-light-grey">
											<h3 style="font-weight: bold; ">Procesos Iniciados</h3>
										</header><br>
										<div class="w3-container">
											<div class="row">
												<div class="col-sm-12">
													<form>
														<div class="form-group">
															<label for="exampleInputEmail1">EXISTENCIA ANTERIOR</label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][0];
																													} ?>" type="number" class="form-control form-control" id="p1" aria-describedby="emailHelp" placeholder="">
														</div>
													</form>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<form>
														<div class="form-group">
															<label for="exampleInputEmail1">PROCESOS PENALES INICIADOS EN EL PERIODO</label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][1];
																													} ?>" type="number" class="form-control form-control-lg" id="p2" aria-describedby="emailHelp" placeholder="" disabled>
														</div>
														<div class="form-group">
															<label for="exampleInputPassword1">PROCESOS INICIADOS CON DETENIDO(+) : </label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][2];
																													} ?>" type="number" class="form-control" id="p3" placeholder="número">
														</div>
													</form>
												</div>
												<div class="col-sm-6">
													<form>
														<div class="form-group">
															<label for="exampleInputEmail1">PROCESOS INICIADOS SIN DETENIDO :</label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][3];
																													} ?>" type="number" class="form-control" id="p4" aria-describedby="emailHelp" placeholder="Ingresa número">
														</div>
														<div class="form-group">
															<label for="exampleInputPassword1">AVOCAMIENTO POR CESACIÓN DE FUNCIONES (+) </label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][4];
																													} ?>" type="number" class="form-control" id="p5" placeholder="número">
														</div>
													</form>
												</div>
											</div>
										</div>
										<?php if ($env == 1) {
										} else { ?> <button onclick="saveDataProcesos(1, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block w3-2021-ultimate-gray">GUARDAR DATOS</button> <?php } ?>
									</div>
								</div>
							</div><br>

							<div class="row">
								<div class="col-sm-12">

									<div class="row">
										<div class="col-sm-12">
											<div class="w3-card-4 " style="width:100%">
												<header class="w3-container w3-light-grey">
													<h3 style="font-weight: bold; ">Autos de Plazo Constitucional</h3>
												</header><br>
												<div class="w3-container">

													<div class="row">
														<div class="col-sm-12">
															<div class="row  ">
																<div class="col-sm-6"><label for="exampleInputEmail1">FORMAL PRISION: </label>
																	<input value="<?php if ($b == 1) {
																																echo $data[0][5];
																															} ?>" type="number" class="form-control" id="p6" aria-describedby="emailHelp" placeholder="Ingresa número">
																</div>
																<div class="col-sm-6"><label for="exampleInputEmail1">AUTO DE SUJECION A PROCESO: </label>
																	<input value="<?php if ($b == 1) {
																																echo $data[0][6];
																															} ?>" type="number" class="form-control" id="p7" aria-describedby="emailHelp" placeholder="Ingresa número">
																</div>
															</div><br>
															<label for="exampleInputEmail1" class=""><strong>AUTOS DE LIBERTAD POR FALTA DE PRUEBAS PARA PROCESAR:</strong></label><br>
															<div class="row">
																<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL(-): </label>
																	<input value="<?php if ($b == 1) {
																																echo $data[0][7];
																															} ?>" type="number" class="form-control" id="p8" aria-describedby="emailHelp" placeholder="Ingresa número">
																</div>
																<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
																	<input value="<?php if ($b == 1) {
																																echo $data[0][8];
																															} ?>" type="number" class="form-control" id="p9" aria-describedby="emailHelp" placeholder="Ingresa número">
																</div>
															</div>
															<br>
															<label for="exampleInputEmail1" class=""><strong>AUTOS DE LIBERTAD POR DESVANECIMIENTO DE DATOS:</strong></label>
															<div class="row">
																<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL(-): </label>
																	<input value="<?php if ($b == 1) {
																																echo $data[0][9];
																															} ?>" type="number" class="form-control" id="p10" aria-describedby="emailHelp" placeholder="Ingresa número">
																</div>
																<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
																	<input value="<?php if ($b == 1) {
																																echo $data[0][10];
																															} ?>" type="number" class="form-control" id="p11" aria-describedby="emailHelp" placeholder="Ingresa número">
																</div>
															</div>
															<div class="row">
																<div class="col-sm-12"><label for="exampleInputEmail1"> MIXTOS: </label>
																	<input value="<?php if ($b == 1) {
																																echo $data[0][11];
																															} ?>" type="number" class="form-control" id="p12" aria-describedby="emailHelp" placeholder="Ingresa número">
																</div>
															</div><br>
														</div>
													</div>

												</div>
												<?php if ($env == 1) {
												} else { ?><button onclick="saveDataProcesos(2, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block">GUARDAR DATOS</button><?php } ?>
											</div>
										</div>
									</div><br>


									<div class="w3-card-4" style="width:100%">
										<header class="w3-container w3-light-grey">
											<h3 style="font-weight: bold; ">Sobreseimientos Decretados</h3>
										</header><br>
										<div class="w3-container">

											<label for="exampleInputEmail1" class=""><strong>POR PRESCRIPCIÓN DE LA ACCIÓN PENAL: </strong></label>
											<div class="row">
												<div class="col-sm-12">
													<input value="<?php if ($b == 1) {
																												echo $data[0][12];
																											} ?>" type="number" class="form-control" id="p13" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
											</div><br>
											<label for="exampleInputEmail1" class=""><strong>POR PERDON LEGAL:</strong></label>
											<div class="row">
												<div class="col-sm-6"><label for="exampleInputEmail1"> CON PROCESO EN TRAMITE (-): </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][13];
																											} ?>" type="number" class="form-control" id="p14" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
												<div class="col-sm-6"><label for="exampleInputEmail1"> CON PROCESO EN NO TRAMITE: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][14];
																											} ?>" type="number" class="form-control" id="p15" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
											</div><br>
											<label for="exampleInputEmail1" class=""><strong> POR MUERTE DEL INCULPADO:</strong></label>
											<div class="row">
												<div class="col-sm-6"><label for="exampleInputEmail1"> CON PROCESO EN TRAMITE (-): </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][15];
																											} ?>" type="number" class="form-control" id="p16" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
												<div class="col-sm-6"><label for="exampleInputEmail1"> CON PROCESO EN NO TRAMITE: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][16];
																											} ?>" type="number" class="form-control" id="p17" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
											</div><br>
											<label for="exampleInputEmail1" class=""><strong>POR MECANISMOS ALTERNATIVOS DE SOLUCIÓN DE CONTROVERSIAS PENALES</strong></label>
											<div class="row">
												<div class="col-sm-6"><label for="exampleInputEmail1"> CON PROCESO EN TRAMITE(-): </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][17];
																											} ?>" type="number" class="form-control" id="p18" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
												<div class="col-sm-6"><label for="exampleInputEmail1"> CON PROCESO EN NO TRAMITE: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][18];
																											} ?>" type="number" class="form-control" id="p19" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
											</div><br>
											<label for="exampleInputEmail1" class=""><strong>ACUMULACION(-): </strong></label>
											<div class="row">
												<div class="col-sm-12">
													<input value="<?php if ($b == 1) {
																												echo $data[0][19];
																											} ?>" type="number" class="form-control" id="p20" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
											</div><br>
										</div>
										<?php if ($env == 1) {
										} else { ?><button onclick="saveDataProcesos(3, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block">GUARDAR DATOS</button><?php } ?>
									</div>

								</div>
							</div><br>

							<div class="row">
								<div class="col-sm-12">


									<div class="w3-card-4" style="width:100%">
										<header class="w3-container w3-light-grey">
											<h3 style="font-weight: bold; ">Mandamientos Judiciales</h3>
										</header><br>
										<div class="w3-container">

											<label for="exampleInputEmail1" class=""><strong> ORDENES DE APREHENSIÓN CUMPLIDAS:</strong></label>
											<div class="row">
												<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][20];
																											} ?>" type="number" class="form-control" id="p21" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
												<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][21];
																											} ?>" type="number" class="form-control" id="p22" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
											</div><br>
											<label for="exampleInputEmail1" class=""><strong> ÓRDENES DE REAPREHENSIÓN CUMPLIDAS:</strong></label>
											<div class="row">
												<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][22];
																											} ?>" type="number" class="form-control" id="p23" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
												<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][23];
																											} ?>" type="number" class="form-control" id="p24" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
											</div><br>
											<label for="exampleInputEmail1" class=""><strong> ÓRDENES DE COMPARECENCIA CUMPLIDAS:</strong></label>
											<div class="row">
												<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][24];
																											} ?>" type="number" class="form-control" id="p25" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
												<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][25];
																											} ?>" type="number" class="form-control" id="p26" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
											</div><br>
										</div>
										<?php if ($env == 1) {
										} else { ?><button onclick="saveDataProcesos(4, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block">GUARDA DATOS</button><?php } ?>
									</div>

								</div>
							</div><br>

							<div class="row">
								<div class="col-sm-12">

									<div class="w3-card-4" style="width:100%">
										<header class="w3-container w3-light-grey">
											<h3 style="font-weight: bold; ">Total de Presentaciones Voluntarias</h3>
										</header><br>
										<div class="w3-container">

											<label for="exampleInputEmail1" class=""><strong> ORDENES DE APREHENSIÓN :</strong></label>
											<div class="row">
												<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][26];
																											} ?>" type="number" class="form-control" id="p27" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
												<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][27];
																											} ?>" type="number" class="form-control" id="p28" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
											</div><br>
											<label for="exampleInputEmail1" class=""><strong> ÓRDENES DE REAPREHENSIÓN :</strong></label>
											<div class="row">
												<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][28];
																											} ?>" type="number" class="form-control" id="p29" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
												<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][29];
																											} ?>" type="number" class="form-control" id="p30" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
											</div><br>
											<label for="exampleInputEmail1" class=""><strong> ÓRDENES DE COMPARECENCIA:</strong></label>
											<div class="row">
												<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][30];
																											} ?>" type="number" class="form-control" id="p31" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
												<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][31];
																											} ?>" type="number" class="form-control" id="p32" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
											</div><br>
											<label for="exampleInputEmail1" class=""><strong> SIN ORDEN:</strong></label>
											<div class="row">
												<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][32];
																											} ?>" type="number" class="form-control" id="p33" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
												<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][33];
																											} ?>" type="number" class="form-control" id="p34" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
											</div><br>
											<label for="exampleInputEmail1" class=""><strong> PERSONAS PUESTAS A DISP. POR EL M.P. ADSCRITO:</strong></label>
											<div class="row">
												<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][34];
																											} ?>" type="number" class="form-control" id="p35" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
												<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][35];
																											} ?>" type="number" class="form-control" id="p36" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
											</div><br>
											<label for="exampleInputEmail1" class=""><strong> REPOSICION DE PROCEDIMIENTO:</strong></label>
											<div class="row">
												<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][36];
																											} ?>" type="number" class="form-control" id="p37" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
												<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][37];
																											} ?>" type="number" class="form-control" id="p38" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
											</div><br>

										</div>
										<?php if ($env == 1) {
										} else { ?><button onclick="saveDataProcesos(5, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block">GUARDA DATOS</button><?php } ?>
									</div>

								</div>
							</div><br>

							<div class="row">
								<div class="col-sm-12">


									<div class="w3-card-4" style="width:100%">
										<header class="w3-container w3-light-grey">
											<h3 style="font-weight: bold; ">Total de Audiencias</h3>
										</header><br>
										<div class="w3-container">

											<div class="row">
												<div class="col-sm-6">
													<form>
														<div class="form-group">
															<label for="exampleInputEmail1">DE DECLARACIONES PREPARATORIAS A QUE ASISTIÓ:</label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][38];
																													} ?>" type="number" class="form-control form-control-lg" id="p39" aria-describedby="emailHelp" placeholder="">
														</div>
														<div class="form-group">
															<label for="exampleInputPassword1">DE TESTIMONIALES A QUE ASISTIÓ: </label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][39];
																													} ?>" type="number" class="form-control" id="p40" placeholder="número">
														</div>
													</form>
												</div>
												<div class="col-sm-6">
													<form>
														<div class="form-group">
															<label for="exampleInputEmail1">DE FINALES A QUE ASISTIÓ: </label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][40];
																													} ?>" type="number" class="form-control" id="p41" aria-describedby="emailHelp" placeholder="Ingresa número">
														</div>
														<div class="form-group">
															<label for="exampleInputPassword1">AMPLIACIONES DEL EJERCICIO DE LA ACCION PENAL: </label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][41];
																													} ?>" type="number" class="form-control" id="p42" placeholder="número">
														</div>
													</form>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12">
													<form>
														<div class="form-group">
															<label for="exampleInputEmail1">CASOS EN LOS QUE SE MODIFICÓ EL TIPO DE DELITO: </label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][42];
																													} ?>" type="number" class="form-control form-control-lg" id="p43" aria-describedby="emailHelp" placeholder="">
														</div>
														<div class="form-group">
															<label for="exampleInputPassword1">VISTAS: </label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][43];
																													} ?>" type="number" class="form-control" id="p44" placeholder="número">
														</div>
													</form>
												</div>
											</div>

										</div>
										<?php if ($env == 1) {
										} else { ?><button onclick="saveDataProcesos(6, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block">GUARDA DATOS</button><?php } ?>
									</div>

								</div>
							</div><br>

						</div>
						<div class="col-sm-6">


							<div class="row">
								<div class="col-sm-12">

									<div class="w3-card-4" style="width:100%">
										<header class="w3-container w3-light-grey">
											<h3 style="font-weight: bold; ">Suspensión de Proceso</h3>
										</header><br>
										<div class="w3-container">
											<form>
												<div class="form-group">
													<label for="exampleInputEmail1">FALTA DE REQUISITO DE PROCEDIBILIDAD:</label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][44];
																											} ?>" type="number" class="form-control" id="p45" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
												<div class="form-group">
													<label for="exampleInputPassword1">AMPARO:</label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][45];
																											} ?>" type="number" class="form-control" id="p46" placeholder="número">
												</div>
											</form>
										</div>
										<?php if ($env == 1) {
										} else { ?><button onclick="saveDataProcesos(7, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block">GUARDAR DATOS</button><?php } ?>
									</div>

								</div>
							</div><br>




							<div class="row">
								<div class="col-sm-12">
									<div class="w3-card-4" style="width:100%">
										<header class="w3-container w3-light-grey">
											<h3 style="font-weight: bold; ">Total de Sentencias</h3>
										</header><br>
										<div class="w3-container">
											<label for="exampleInputEmail1" class=""><strong>CONDENATORIAS:</strong></label>
											<div class="row">
												<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL(-): </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][46];
																											} ?>" type="number" class="form-control" id="p47" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
												<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][47];
																											} ?>" type="number" class="form-control" id="p48" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
											</div><br>
											<label for="exampleInputEmail1" class=""><strong>ABSOLUTORIAS:</strong></label>
											<div class="row">
												<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL(-): </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][48];
																											} ?>" type="number" class="form-control" id="p49" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
												<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][49];
																											} ?>" type="number" class="form-control" id="p50" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
											</div><br>
											<label for="exampleInputEmail1" class=""><strong>MIXTAS:</strong></label>
											<div class="row">
												<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL(-): </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][50];
																											} ?>" type="number" class="form-control" id="p51" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
												<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][51];
																											} ?>" type="number" class="form-control" id="p52" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
											</div><br>
											<label for="exampleInputEmail1" class=""><strong>SENTENCIAS EN LAS QUE SE CONDENA PAGO DE REPARACION DEL DAÑO: </strong></label>
											<div class="row">
												<div class="col-sm-12">
													<input value="<?php if ($b == 1) {
																												echo $data[0][52];
																											} ?>" type="number" class="form-control" id="p53" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
											</div>
											<br>
											<label for="exampleInputEmail1" class=""><strong>SENTENCIAS EN LAS QUE NO SE CONDENA PAGO DE REPARACION DEL DAÑO: </strong></label>
											<div class="row">
												<div class="col-sm-12">
													<input value="<?php if ($b == 1) {
																												echo $data[0][53];
																											} ?>" type="number" class="form-control" id="p54" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
											</div><br>
										</div>
										<?php if ($env == 1) {
										} else { ?><button onclick="saveDataProcesos(8, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block">GUARDAR DATOS</button><?php } ?>
									</div>
								</div>
							</div> <br>


							<div class="row">
								<div class="col-sm-12">

									<div class="w3-card-4" style="width:100%">
										<header class="w3-container w3-light-grey">
											<h3 style="font-weight: bold; ">Incompetencias</h3>
										</header><br>
										<div class="w3-container">
											<label for="exampleInputEmail1" class=""><strong>DECRETADAS:</strong></label>
											<div class="row">
												<div class="col-sm-6"><label for="exampleInputEmail1"> CON PROCESO EN TRAMITE (-): </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][54];
																											} ?>" type="number" class="form-control" id="p55" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
												<div class="col-sm-6"><label for="exampleInputEmail1"> CON PROCESO EN NO TRAMITE: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][55];
																											} ?>" type="number" class="form-control" id="p56" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
											</div><br>
											<label for="exampleInputEmail1" class=""><strong> ADMITIDAS:</strong></label>
											<div class="row">
												<div class="col-sm-6"><label for="exampleInputEmail1"> CON PROCESO EN TRAMITE (-): </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][56];
																											} ?>" type="number" class="form-control" id="p57" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
												<div class="col-sm-6"><label for="exampleInputEmail1"> CON PROCESO EN NO TRAMITE: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][57];
																											} ?>" type="number" class="form-control" id="p58" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
											</div><br>
										</div>
										<?php if ($env == 1) {
										} else { ?><button onclick="saveDataProcesos(9, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block">GUARDAR DATOS</button><?php } ?>
									</div>



								</div>
							</div><br>
							<div class="row">
								<div class="col-sm-12">

									<div class="w3-card-4" style="width:100%">
										<header class="w3-container w3-light-grey">
											<h3 style="font-weight: bold; ">Órdenes de Reaprehensión Cumplidas</h3>
										</header><br>
										<div class="w3-container">
											<div class="row">
												<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][58];
																											} ?>" type="number" class="form-control" id="p59" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
												<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][59];
																											} ?>" type="number" class="form-control" id="p60" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
											</div><br>
										</div>
										<?php if ($env == 1) {
										} else { ?><button onclick="saveDataProcesos(10, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block">GUARDAR DATOS</button><?php } ?>
									</div>



								</div>
							</div><br>
							<div class="row">
								<div class="col-sm-12">

									<div class="w3-card-4" style="width:100%">
										<header class="w3-container w3-light-grey">
											<h3 style="font-weight: bold; ">Ordenes Negadas</h3>
										</header><br>
										<div class="w3-container">
											<div class="row">
												<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL DE ORDENES NEGADAS: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][60];
																											} ?>" type="number" class="form-control" id="p61" aria-describedby="emailHelp" placeholder="Ingresa número" disabled>
												</div>
												<div class="col-sm-6"><label for="exampleInputEmail1"> DE APREHENSIÓN: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][61];
																											} ?>" type="number" class="form-control" id="p62" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
											</div><br>
											<div class="row">
												<div class="col-sm-6"><label for="exampleInputEmail1"> DE REAPREHENSIÓN: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][62];
																											} ?>" type="number" class="form-control" id="p63" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
												<div class="col-sm-6"><label for="exampleInputEmail1"> DE COMPARECENCIA: </label>
													<input value="<?php if ($b == 1) {
																												echo $data[0][63];
																											} ?>" type="number" class="form-control" id="p64" aria-describedby="emailHelp" placeholder="Ingresa número">
												</div>
											</div><br>
										</div>
										<?php if ($env == 1) {
										} else { ?><button onclick="saveDataProcesos(11, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block">GUARDAR DATOS</button><?php } ?>
									</div>



								</div>
							</div><br>

							<div class="row">
								<div class="col-sm-12">

									<div class="w3-card-4" style="width:100%">
										<header class="w3-container w3-light-grey">
											<h3 style="font-weight: bold; ">Apelaciones Interpuestas</h3>
										</header><br>
										<div class="w3-container">
											<div class="row">
												<div class="col-sm-6">
													<form>
														<div class="form-group">
															<label for="exampleInputEmail1">TOTAL:</label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][64];
																													} ?>" type="number" class="form-control form-control-lg" id="p65" aria-describedby="emailHelp" placeholder="Ingresa número" disabled>
														</div>
													</form>
												</div>
												<div class="col-sm-6">
													<form>
														<div class="form-group">
															<label for="exampleInputEmail1">EN CONTRA DE NEGATIVAS DE ORDEN:</label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][65];
																													} ?>" type="number" class="form-control" id="p66" aria-describedby="emailHelp" placeholder="Ingresa número">
														</div>
													</form>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<form>
														<div class="form-group">
															<label for="exampleInputEmail1">EN CONTRA DE AUTOS DE LIBERTAD: </label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][66];
																													} ?>" type="number" class="form-control form-control-lg" id="p67" aria-describedby="emailHelp" placeholder="Ingresa número">
														</div>
													</form>
												</div>
												<div class="col-sm-6">
													<form>
														<div class="form-group">
															<label for="exampleInputEmail1"> EN CONTRA DE AUTOS DE FORMAL PRISIÓN: </label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][67];
																													} ?>" type="number" class="form-control" id="p68" aria-describedby="emailHelp" placeholder="Ingresa número">
														</div>
													</form>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<form>
														<div class="form-group">
															<label for="exampleInputEmail1">EN CONTRA DE AUTOS DE SUJECIÓN A PROCESO: </label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][68];
																													} ?>" type="number" class="form-control form-control-lg" id="p69" aria-describedby="emailHelp" placeholder="Ingresa número">
														</div>
													</form>
												</div>
												<div class="col-sm-6">
													<form>
														<div class="form-group">
															<label for="exampleInputEmail1">EN CONTRA DE SENTENCIAS ABSOLUTORIAS: </label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][69];
																													} ?>" type="number" class="form-control" id="p70" aria-describedby="emailHelp" placeholder="Ingresa número">
														</div>
													</form>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<form>
														<div class="form-group">
															<label for="exampleInputEmail1">EN CONTRA DE SENTENCIAS CONDENATORIAS: </label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][70];
																													} ?>" type="number" class="form-control form-control-lg" id="p71" aria-describedby="emailHelp" placeholder="Ingresa número">
														</div>
													</form>
												</div>
												<div class="col-sm-6">
													<form>
														<div class="form-group">
															<label for="exampleInputEmail1">EN CONTRA DE SENTENCIAS MIXTAS: </label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][71];
																													} ?>" type="number" class="form-control" id="p72" aria-describedby="emailHelp" placeholder="Ingresa número">
														</div>
													</form>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<form>
														<div class="form-group">
															<label for="exampleInputEmail1"> EN CONTRA DE SOBRESEIMENTOS: </label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][72];
																													} ?>" type="number" class="form-control form-control-lg" id="p73" aria-describedby="emailHelp" placeholder="Ingresa número">
														</div>
													</form>
												</div>
												<div class="col-sm-6">
													<form>
														<div class="form-group">
															<label for="exampleInputEmail1"> EN CONTRA DE OTRAS RESOLUCIONES JUDICIALES: </label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][73];
																													} ?>" type="number" class="form-control" id="p74" aria-describedby="emailHelp" placeholder="Ingresa número">
														</div>
													</form>
												</div>
											</div>
										</div>
										<?php if ($env == 1) {
										} else { ?><button onclick="saveDataProcesos(12, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block">GUARDAR DATOS</button><?php } ?>
									</div>



								</div>
							</div><br>

							<div class="row">
								<div class="col-sm-12">

									<div class="w3-card-4" style="width:100%">
										<header class="w3-container w3-light-grey">
											<h3 style="font-weight: bold; ">Conclusiones</h3>
										</header><br>
										<div class="w3-container">
											<div class="row">
												<div class="col-sm-6">
													<form>
														<div class="form-group">
															<label for="exampleInputEmail1">TOTAL:</label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][74];
																													} ?>" type="number" class="form-control form-control-lg" id="p75" aria-describedby="emailHelp" placeholder="Ingresa número" disabled>
														</div>
													</form>
												</div>
												<div class="col-sm-6">
													<form>
														<div class="form-group">
															<label for="exampleInputEmail1">ACUSATORIAS:</label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][75];
																													} ?>" type="number" class="form-control" id="p76" aria-describedby="emailHelp" placeholder="Ingresa número">
														</div>
													</form>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<form>
														<div class="form-group">
															<label for="exampleInputEmail1">ACUSATORIAS EN AUDIENCIA PRINCIPAL:</label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][76];
																													} ?>" type="number" class="form-control form-control-lg" id="p77" aria-describedby="emailHelp" placeholder="Ingresa número">
														</div>
													</form>
												</div>
												<div class="col-sm-6">
													<form>
														<div class="form-group">
															<label for="exampleInputEmail1">NO ACUSATORIAS:</label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][77];
																													} ?>" type="number" class="form-control" id="p78" aria-describedby="emailHelp" placeholder="Ingresa número">
														</div>
													</form>
												</div>
											</div>
										</div>
										<hr>
										<div class="w3-container">
											<div class="row">
												<div class="col-sm-6">
													<form>
														<div class="form-group"><br>
															<label for="exampleInputEmail1">CESACIÓN DE FUNCIONES (-) :</label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][78];
																													} ?>" type="number" class="form-control form-control-lg" id="p79" aria-describedby="emailHelp" placeholder="Ingresa número">
														</div>
													</form>
												</div>
												<div class="col-sm-6">
													<form>
														<div class="form-group"><br>
															<label for="exampleInputEmail1">TOTAL DE PROCESOS EN TRAMITE: </label>
															<input disabled value="<?php if ($b == 1) {
																																							echo $data[0][81];
																																						} ?>" type="number" class="form-control" id="p80" aria-describedby="emailHelp" placeholder="Ingresa número">
														</div>
													</form>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12">
													<form>
														<div class="form-group">
															<label for="exampleInputEmail1">PEDIMENTOS EN GENERAL: </label>
															<input value="<?php if ($b == 1) {
																														echo $data[0][80];
																													} ?>" type="number" class="form-control form-control-lg" id="p81" aria-describedby="emailHelp" placeholder="Ingresa número">
														</div>
													</form>
												</div>
											</div>
										</div><br>
										<?php if ($env == 1) {
										} else { ?><button onclick="saveDataProcesos(13, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block">GUARDAR DATOS</button> <?php } ?>
									</div>



								</div>
							</div>

						</div>
					</div><br>





				</div>
			</div>

		</div>
	</div>
</div>



</body>

</html>