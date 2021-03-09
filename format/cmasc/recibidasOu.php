<?php
session_start();
include ("../../Conexiones/Conexion.php");
include("../../funciones.php"); 
include("../../funCmasc.php");  

if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }

if($mes == 1){ 
	$mesAnterior = 12; $anioAnte = ($anio-1); 

	$totNucTra = currentNucsTramitCount($conn, $idEnlace,  $anioAnte);

}else{ 
	$anioAnte = $anio; $mesAnterior = ($mes - 1);

	$totNucTra = currentNucsTramitCount1($conn, $idEnlace, $mesAnterior, $mes);	
}

$dataREcibAnt = getDataMainRecib($conn, $idEnlace, $mesAnterior, $anioAnte);
$tam = sizeof($dataREcibAnt);


if ($tam > 0) {     $tramitAnter = $dataREcibAnt[0][7];       }else{ $tramitAnter = 0; }

$dataREcibCurrent = getDataMainRecib($conn, $idEnlace, $mes, $anioAnte);


	///GET TRAMITE ALL NUCS THAT CONTAINS 1 IN TRAMITE
	$trmit = getAllTramitCurrent($conn);

?>

<div id="contentTabs" class="">

	<!-- AQUI INICIA EL CODIGO PARA AGREGAR LA PRIMER ESTAÑA ( RECIBIDAS POR OTRA UNIDAD ) -->
	<div class="row">

		<div class="col-xs-12 col-sm-12  col-md-6" style="zoom:130% !important;">
			<br>
			<div class="">
				<div class="">

					<div class="panel panel-default fd1" style="">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Existencia Anterior </strong></h5>
							<input class="form-control input-md redondear inputext" id="taRec" type="number"
							pattern="[0-9]+" value="<? echo $totNucTra[0][0]; ?>" readonly>
						</div>
					</div>

				</div>


				<div class="panel panel-default fd1" style="">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong> Recibidas de otras unidades </strong></h5>

						<div class="row">
							<div class="col-xs-12">

								<div class="row">

									<div class="col-xs-9">
										<label style="font-weight:bold">Unidad de la que se recibe *</label>
										<select id="unidRecib" name="selMes" tabindex="6"class="form-control redondear selectTranparent" required>     
											<option value="0" selected>Selecciona Unidad</option>                                                                  
											<?
											$unids = getAllUnidCmas($conn);
											for ($w=0; $w < sizeof($unids) ; $w++) { 
												?>
												<option value="<? echo $unids[$w][0] ?>" ><? echo $unids[$w][1]; ?></option>
												<?
											}    
											?>
										</select>
									</div>
									<div class="col-xs-3">
										<label style="font-weight:bold; color:transparent;">.</label>
										<button onclick="openModalRecib(<? echo $idEnlace; ?>, <? echo $anio; ?>, <? echo $mes; ?>, <? echo $tramitAnter; ?>)" type="button" data-toggle="" href="" class="btn btn-info"
											style="width: 100%;">Agregar</button>
										</div>

									</div>
									<br>
									<table class="table table-striped">
										<thead>
											<tr class="cabezeraTabla">
												<th scope="col">#</th>
												<th scope="col">Unidad</th>
												<th scope="col">Ordinario</th>
												<th scope="col">Reproceso</th>
												<th scope="col">Revisar</th>
											</tr>
										</thead>
										<tbody>

											<?

											$dataUnidsMainRec = getRecbMesAnioEnlc($conn, $mes, $anio, $idEnlace);
											$sumord = 0; $sumrepro = 0; $sumProce = 0; $sumDesec = 0;
											for ($g=0; $g < sizeof($dataUnidsMainRec) ; $g++) { 
												$countOrd = countNucsOrdRepr($conn, $mes, $anio, $idEnlace, 0, $dataUnidsMainRec[$g][0]);
												$countRepro = countNucsOrdRepr($conn, $mes, $anio, $idEnlace, 1, $dataUnidsMainRec[$g][0]);

												$countProced = countNucsProcDese($conn, $mes, $anio, $idEnlace, 0, $dataUnidsMainRec[$g][0]);
												$countDesec = countNucsProcDese($conn, $mes, $anio, $idEnlace, 1, $dataUnidsMainRec[$g][0]);
												$sumord = $sumord + $countOrd[0][0];
												$sumrepro = $sumrepro + $countRepro[0][0];
												$sumProce = $sumProce + $countProced[0][0];
												$sumDesec = $sumDesec + $countDesec[0][0];
												?>
												<tr>
													<th scope="row"><? echo $g+1; ?></th>
													<td><? echo $dataUnidsMainRec[$g][1]; ?></td>
													<td class="textCent"><? echo $countOrd[0][0]; ?></td>
													<td class="textCent"><? echo $countRepro[0][0]; ?></td>
													<td class="textCent"><span onclick="openModalRecibUnid(<? echo $idEnlace; ?>, <? echo $anio; ?>, <? echo $mes; ?>, <? echo $dataUnidsMainRec[$g][0] ?>, <? echo $tramitAnter; ?>)" class="glyphicon glyphicon-eye-open" style="color: green; font-size: 16px; cursor: pointer;"></span></td>
												</tr>
												<?													
											}
											$totaRec = $sumord + $sumrepro;
											?>    
										</tbody>
									</table>

									<div class="row">

										<div class="col-xs-6">
											<label class="colorLetras" for="inputlg">Total Ordinario :</label>
											<input class="form-control input-md redondear inputext" onblur=""
											id="procedentes" value="<? echo $sumord; ?>"
											type="number" readonly>
										</div>
										<div class="col-xs-6">
											<label class="colorLetras" for="inputlg">Total Reproceso :</label>
											<input class="form-control input-md redondear inputext" onblur=""
											id="desechadas" value="<? echo $sumrepro; ?>"
											type="number" readonly>
										</div>

									</div>

								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="col-xs-12 col-sm-12  col-md-6" style="zoom:130% !important;">

				<br>
				<div class="">


					<div class="panel panel-default fd1" style="">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Del Total de Solicitudes Recibidas </strong></h5>

							<div class="panel panel-default fd1" style="">
								<div class="panel-body">
									<h5 class="text-on-pannel"><strong> Total Recibidas </strong></h5>
									<input class="form-control input-md redondear inputext" readonly id="totalRecibidas"
									type="number" value="<? echo $totaRec; ?>">
								</div>
							</div>



							<div class="row">

								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Procedentes :</label>
									<input class="form-control input-md redondear inputext" onblur="" style="background-color: white;" id="procedentes"
									value="<? echo $sumProce; ?>" type="number" readonly>
								</div>
								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Desechadas :</label>
									<input class="form-control input-md redondear inputext" style="background-color: white;" onblur="" id="desechadas"
									value="<? echo $sumDesec; ?>" type="number" readonly>
								</div>

							</div>
						</div>
					</div>

					<div class="panel panel-default" style="">
						<div class="panel-body">

							<center>
								<h5><strong> Tipos de Solicitante del Acuerdo </strong></h5>
							</center>

							<div class="row">

								<div class="col-xs-12">
									<div class="panel panel-default fd1" style="">
										<div class="panel-body">
											<h5 class="text-on-pannel"><strong> Solicitante Victima </strong></h5>

											<div class="row">

												<div class="col-xs-6">
													<label class="colorLetras" for="inputlg">Hombres :</label>
													<input class="form-control input-md redondear inputext" onblur=""
													id="svhom" value="<? echo $dataREcibCurrent[0][2]; ?>"
													type="number">
												</div>
												<div class="col-xs-6">
													<label class="colorLetras" for="inputlg">Mujeres :</label>
													<input class="form-control input-md redondear inputext" onblur=""
													id="svmuj" value="<? echo $dataREcibCurrent[0][3];  ?>"
													type="number">
												</div>

											</div>
										</div>
									</div>
								</div>
								<div class="col-xs-12">

									<div class="panel panel-default fd1" style="">
										<div class="panel-body">
											<h5 class="text-on-pannel"><strong> Solicitante Imputado </strong></h5>

											<div class="row">

												<div class="col-xs-6">
													<label class="colorLetras" for="inputlg">Hombres :</label>
													<input class="form-control input-md redondear inputext" onblur=""
													id="sihom" value="<? echo $dataREcibCurrent[0][4];  ?>"
													type="number">
												</div>
												<div class="col-xs-6">
													<label class="colorLetras" for="inputlg">Mujeres :</label>
													<input class="form-control input-md redondear inputext" onblur=""
													id="simuj" value="<? echo $dataREcibCurrent[0][5];  ?>"
													type="number">
												</div>

											</div>
										</div>
									</div>

								</div>

							</div>
						</div>
					</div>

					<div class="panel panel-default fd1" style="">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Numero de Invitaciones Generadas </strong></h5>
							<input class="form-control input-md redondear inputext" id="numInvRec" type="number"
							value="<?  echo $dataREcibCurrent[0][6];  ?>" value="">
						</div>
					</div>

					<div class="panel panel-default fd1" style="">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Tramite : </strong></h5>
							<input class="form-control input-md redondear inputext" id="tramiteFinalCmasc" readonly
							type="number" value="<?  echo $trmit[0][0]; ?>">
						</div>
					</div>

					<div class="row">

						<div class="col-xs-12 col-sm-12 col-md-12">
							<center><button style="width: 100%; height: 44px;" id="btnSaveRecib"  type="button"
								class="btn btn-primary redondear" onclick="saveDataRecib(<? echo $idEnlace; ?>, <? echo $anio; ?>, <? echo $mes; ?>)">Guardar Datos</button></center>
							</div>

							<div id="responseSave"></div>


						</div>
						<br>

					</div>



				</div>

			</div>







			<!-- AQUI  ETERMINAL CODIGO PARA AGREGAR LA PRIMER ESTAÑA ( RECIBIDAS POR OTRA UNIDAD ) -->

		</div>



		<div class="modal fade bs-example-modal-sm" id="modalReci" role="dialog" data-backdrop="static" data-keyboard="false">

			<div id="modalVistaCss" class="modal-dialog modal-sm" style="width: 43%;  margin-top: 1%;">

				<div class="modal-content">

					<div id="contmodRecibidasCmasc">


					</div>

				</div>
			</div>

		</div>