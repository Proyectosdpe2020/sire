<?

session_start();
include("../Conexiones/Conexion.php");
include("../Conexiones/conexionSicap.php");
include("../funciones.php");

if (isset($_POST["nombreCompletoMP"])) {
	$nombreCompletoMP = $_POST["nombreCompletoMP"];
}
if (isset($_POST["idMp"])) {
	$idMp = $_POST["idMp"];
}
if (isset($_POST["idUnidad"])) {
	$idUnidad = $_POST["idUnidad"];
}
if (isset($_POST["mes"])) {
	$mes = $_POST["mes"];
}
if (isset($_POST["anio"])) {
	$anio = $_POST["anio"];
}

$idUsuario = $_SESSION['useridIE'];
$unInfo = getInfoUnidad($conn, $idUnidad);
$nomUnidad = $unInfo[0][1];

if ($mes == 1) {
	$mesAnterior = 12;
	$anioAnte = ($anio - 1);
} else {
	$anioAnte = $anio;
	$mesAnterior = ($mes - 1);
}

if ($anio <= 2021 && $mes <= 6) {



	$existenciaAnt = getExistenciaAnterior($conn, $mesAnterior, $anioAnte, $idUnidad, $idMp);

	////////////// OBTIENE EL TRAMITE ANTERIOR DE LOS DATOS INGRESADOS DEL MES ANTERIOR /////////////////////
	
	
	if ($existenciaAnt) {
	
		$tramiteAnte = $existenciaAnt[0][0];
		$bandHabTramite = 0;
	} else {
	
		$tramiteAnte = 0;
		$bandHabTramite = 1;
	}


}else{

	echo "hwrwe";

	if ($mes == 1) {
		$mesAnterior = 12;
		$anioAnte = ($anio - 1);
	} else {
		$anioAnte = $anio;
		$mesAnterior = ($mes - 2);
	}

	if ($existenciaAnt) {
	
		$tramiteAnte = $existenciaAnt[0][0];
		$bandHabTramite = 0;
	} else {
	
		$tramiteAnte = 0;
		$bandHabTramite = 1;
	}

	

////////////////////// NUEVOS TRAMITES COUNT NUCSS //////////////////////////

$existNew = getDataCarpetasDatosExistenciaAnteriorV2($conn, $mesAnterior, $anioAnte, $idUnidad, $idMp);


$d1 = getCountNucs($conn, 1, $mesAnterior, $anioAnte, $idUnidad, $idMp, 0);

$d2 = getCountNucs($conn, 22, $mesAnterior, $anioAnte, $idUnidad, $idMp, 1);
$d3 = getCountNucs($conn, 22, $mesAnterior, $anioAnte, $idUnidad, $idMp, 0);

$d4 = getCountNucs($conn, 2, $mesAnterior, $anioAnte, $idUnidad, $idMp, 0);
$d5 = getCountNucs($conn, 5, $mesAnterior, $anioAnte, $idUnidad, $idMp, 0);
$d6 = getCountNucs($conn, 20, $mesAnterior, $anioAnte, $idUnidad, $idMp, 0);
$d7 = getCountNucs($conn, 21, $mesAnterior, $anioAnte, $idUnidad, $idMp, 0);
$d8 = getCountNucs($conn, 3, $mesAnterior, $anioAnte, $idUnidad, $idMp, 0);
$d9 = getCountNucs($conn, 23, $mesAnterior, $anioAnte, $idUnidad, $idMp, 0);
$d10 = getCountNucs($conn, 24, $mesAnterior, $anioAnte, $idUnidad, $idMp, 0);
$d11 = getCountNucs($conn, 25, $mesAnterior, $anioAnte, $idUnidad, $idMp, 0);
$d12 = getCountNucs($conn, 15, $mesAnterior, $anioAnte, $idUnidad, $idMp, 0);

$totaTrabvajar = $tramiteAnte + $datazx[$k][6] + $d1[0][0] + $datazx[$k][2] ;
$totDeterminaciones = $d2[0][0] + $d3[0][0] + $d4[0][0] + $d5[0][0] + $d6[0][0] + $d7[0][0] + $d8[0][0] + $d9[0][0] + $d10[0][0] + $d11[0][0] + $d12[0][0];
$enviads = $existNew[$k][2] + $existNew[$k][3] + $existNew[$k][4];
$enviaddetermns = $enviads + $totDeterminaciones;

$totTramitss = $totaTrabvajar - $enviaddetermns;

}

?>

<div class="modal-header" style="background-color:#3c6084;">
	<button type="button" class="close" data-dismiss="modal">&times;</button>

	<center>
		<h4 class="modal-title" style="color:white; font-weight: bold;"> <? echo $nomUnidad; ?> </h4>
	</center><br>
	<center>
		<h5 class="modal-title" style="color:white; font-weight: ;"> <? echo $nombreCompletoMP; ?> </h5>
	</center>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-group panelunoLitigacion">


	<div class="row" style="padding: 15px;">

		<div class="row">

			<div class="col-md-12 col-sm-12 col-xs-12">

				<div class="panel panel-default fd1" style="">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong> Existencia Anterior </strong></h5>
						<input class="form-control input-md redondear fdesv" id="inputTramiteAnterior" onkeyup="actualizarTotalTrabajar()" type="number" value="<? if ($bandHabTramite == 1) {
																																																																																																																																															echo $totTramitss;
																																																																																																																																														} else {
																																																																																																																																															echo $totTramitss;
																																																																																																																																														} ?>" <? echo "readonly"; ?>>
					</div>
				</div><br>

				<div class="panel panel-default fd1">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong> Iniciadas </strong></h5>

						<div class="row">

							<div class="col-xs-6">
								<label class="colorLetras" for="inputlg">Con Detenido :</label>
								<input class="form-control input-md redondear fdesv" onblur="actualizarIniciadas()" id="inputCdeten" type="number">
							</div>
							<div class="col-xs-6">
								<label class="colorLetras" for="inputlg">Sin Detenido :</label>
								<input class="form-control input-md redondear fdesv" onblur="actualizarIniciadas()" id="inputSdeten" type="number">
							</div>

						</div>

						<div class="row">

							<div class="col-md-12 col-sm-12 col-xs-12">
								<label class="colorLetras" for="inputlg">Total Iniciadas :</label>
								<div id="inicidadas"><input class="form-control input-md redondear fdesv colorBloqueado" value="0" id="inpuTotIniciadas" type="number" readonly></div>
							</div>

						</div>

					</div>
				</div>

				<div class="row">

					<div class="col-xs-12">
						<br>
						<div class="panel panel-default fd1" style="">
							<div class="panel-body">
								<h5 class="text-on-pannel"><strong>Reiniciadas :</strong></h5>
								<div class="iconiput">
									<input type="number" placeholder="cantidad" class="first" onkeyup="actualizarTotalTrabajar()" id="reiniciadasInser" />
									<span onclick="sendDataModal('reiniciadasInser',1,0,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
										<div id="checkreiniciadas"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
									</span>
								</div>


							</div>
						</div>
					</div>

				</div>

				<div class="row">

					<div class="col-xs-12">
						<br>
						<div class="panel panel-default fd1" style="">
							<div class="panel-body">
								<h5 class="text-on-pannel"><strong>Recibidas por otra Unidad :</strong></h5>
								<input class="form-control input-md redondear fdesv" onblur="actualizarTotalTrabajar()" id="reCbOtrUni" type="number">
							</div>
						</div>
					</div>

				</div>

				<div class="row">
					<div class="col-xs-12">
						<br>
						<div class="panel panel-default fd1" style="">
							<div class="panel-body">
								<h5 class="text-on-pannel"><strong> Total a Trabajar</strong></h5>
								<div id="totalTrabajar"><input class="form-control input-md redondear fdesv" id="inputTotalTrabajar" value="0" type="number" readonly></div>
							</div>
						</div>
					</div>
				</div>

				<div class="panel panel-default fd1" style="margin-top: 5% !important;">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong> Resueltas o Determinadas </strong></h5>

						<div class="row">

							<input id="idmp" type="hidden" value="<? echo $idMp; ?>" name="">
							<input id="mes" type="hidden" value="<? echo $mes; ?>" name="">
							<input id="anio" type="hidden" value="<? echo $anio; ?>" name="">




							<div class="col-xs-6">

								<label class="colorLetras" for="inputlg">Judicializadas Con Detenido :</label>
								<div class="iconiput">
									<input type="number" placeholder="cantidad" class="first" onkeyup="actualizarJudicializadas(event)" id="inputCdetenju" />
									<span onclick="checkJudicializaCdeten(22,2,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
										<div id="checkCdetenju"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
									</span>
								</div>

							</div>
							<div class="col-xs-6">
								<label class="colorLetras" for="inputlg">Judicializadas Sin Detenido :</label>
								<div class="iconiput">
									<input type="number" placeholder="cantidad" class="first" onkeyup="actualizarJudicializadas(event)" id="inputSdetenju" />
									<span onclick="sendDataModal('inputSdetenju',22,1,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
										<div id="checkSdetenju"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
									</span>
								</div>

							</div>

						</div>
						<div class="row">

							<div class="col-md-12 col-sm-12 col-xs-12">
								<label class="colorLetras" for="inputlg">Total judicializadas :</label>
								<div id="totalJudicializadas"><input class="form-control input-md redondear fdesv" id="inputJudicializadas" value="0" type="number" readonly=""></div>
							</div>

						</div>


					</div>
				</div>


				<div class="row">

					<div class="col-xs-12">
						<div class="panel panel-default fd1" style="">
							<div class="panel-body">


								<div class="col-xs-12">
									<label class="colorLetras" for="inputlg">Abstención de Investigación :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" onkeyup="actualizarResoluciones()" id="inputAbsInves" />
										<span onclick="sendDataModal('inputAbsInves',2,0,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkAbsInves"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>

								<div class="col-xs-12">
									<label class="colorLetras" for="inputlg">Archivo Temporal :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" onkeyup="actualizarResoluciones()" id="inputArcTem" />
										<span onclick="sendDataModal('inputArcTem',5,0,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkArcTem"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>

								</div>
								<div class="col-xs-12">
									<label class="colorLetras" for="inputlg">No ejercicio de la acción penal :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" onkeyup="actualizarResoluciones()" id="inputNEAP" />
										<span onclick="sendDataModal('inputNEAP',20,0,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkNEAP"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>

								</div>
								<div class="col-xs-12">
									<label class="colorLetras" for="inputlg">Incompetencia:</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" onkeyup="actualizarResoluciones()" id="inputIncompe" />
										<span onclick="sendDataModal('inputIncompe',21,0,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkIncompe"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>

								</div>
								<div class="col-xs-12">
									<label class="colorLetras" for="inputlg">Acumulación :</label>
									<div class="iconiput">
										<input type="number" placeholder="cantidad" class="first" onkeyup="actualizarResoluciones()" id="inputAcumulacion" />
										<span onclick="sendDataModal('inputAcumulacion',3,0,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
											<div id="checkAcumulacion"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
									<br>
								</div>


							</div>
						</div>

					</div>



				</div>


				<div class="row">


				</div>

				<div class="panel panel-default fd1" style="">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong> Salidas Alternas </strong></h5>

						<div class="row">

							<div class="col-xs-6">
								<label class="colorLetras" for="inputlg">Mediación :</label>
								<div class="iconiput">
									<input type="number" placeholder="cantidad" class="first" onkeyup="actualizarResoluciones()" id="inputMediacion" />
									<span onclick="sendDataModal('inputMediacion',23,0,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
										<div id="checkMediacion"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
									</span>
								</div>

							</div>
							<div class="col-xs-6">
								<label class="colorLetras" for="inputlg">Conciliación :</label>
								<div class="iconiput">
									<input type="number" placeholder="cantidad" class="first" onkeyup="actualizarResoluciones()" id="inputConciliacion" />
									<span onclick="sendDataModal('inputConciliacion',24,0,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
										<div id="checkConciliacion"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
									</span>
								</div>
							</div>

						</div>
						<div class="row">

							<div class="col-xs-12">
								<label class="colorLetras" for="inputlg">Criterios de Oportunidad :</label>
								<div class="iconiput">
									<input type="number" placeholder="cantidad" class="first" onkeyup="actualizarResoluciones()" id="inputCriteOpor" />
									<span onclick="sendDataModal('inputCriteOpor',25,0,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
										<div id="checkCriteOpor"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
									</span>
								</div>

							</div>
						<!-- 	<div class="col-xs-6">
								<label class="colorLetras" for="inputlg">Suspensión Condicional del Proceso :</label>
								<div class="iconiput">
									<input type="number" placeholder="cantidad" class="first" onkeyup="actualizarResoluciones()" id="inputSCP" />
									<span onclick="sendDataModal('inputSCP',15,0,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)">
										<div id="checkSCP"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
									</span>
								</div>

							</div> -->

						</div>


					</div>
				</div>


				<div class="row">

					<div class="col-xs-12">
						<br>
						<div class="panel panel-default fd1" style="">
							<div class="panel-body">
								<h5 class="text-on-pannel"><strong> Total de Resoluciones o Determinadas </strong></h5>
								<div id="totalResoluciones"><input class="form-control input-md redondear fdesv" id="inputResoluciones" value="0" type="number" readonly=""></div>
							</div>
						</div>

					</div>

					<div class="col-xs-12">
						<div class="panel panel-default fd1" style="">
							<div class="panel-body">



								<div class="col-xs-12">
									<label class="colorLetras" for="inputlg">Canalizadas a Unidad de Atención Temprana :</label>
									<input class="first" onkeyup="actualizarTramite()" id="inputEnvUATP" type="number">
								</div>
								<div class="col-xs-12">
									<label class="colorLetras" for="inputlg">Canalizadas a Unidad de Investigación :</label>
									<input class="first" onkeyup="actualizarTramite()" id="inputEnvUI" type="number">
								</div>
								<div class="col-xs-12">
									<label class="colorLetras" for="inputlg">Canalizadas a Imputado Desconocido :</label>
									<input class="first" onkeyup="actualizarTramite()" id="inputEnvImpDesc" type="number">
								</div>
								<div class="col-xs-12">
									<label class="colorLetras" for="inputlg">Trámite :</label>
									<div id="tramiteFinal"><input class="form-control input-md redondear fdesv" id="inputTramiteFinal" value="0" type="number" readonly=""></div>
								</div>


							</div>
						</div>

					</div>


				</div>


			</div>

		</div>


	</div>

</div>
</div>

</div>


</div>


<div id="continputdhidden">

</div>


<div class="row">

	<div class="col-xs-6 col-sm-6 col-md-6">
		<center><button style="width: 85%;" type="button" class="btn btn-primary redondear" onclick="validateItsok(<? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idMp; ?>)">Guardar</button></center>
	</div>


	<div class="col-xs-6 col-sm-6 col-md-6">
		<center><button style="width: 85%;" type="button" class="btn btn-default redondear" data-dismiss="modal">Cancelar</button></center>
	</div>

</div>

<br>

<div id="respuestaGuardado"></div>