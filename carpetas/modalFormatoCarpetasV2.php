<? 

session_start();
include ("../Conexiones/Conexion.php");
include ("../Conexiones/conexionSicap.php");
include("../funciones.php");	
include("../funcionesCarpetasV2.php");

if (isset($_POST["nombreCompletoMP"])){ $nombreCompletoMP = $_POST["nombreCompletoMP"]; }
if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }

$idUsuario = $_SESSION['useridIE'];
$unInfo = getInfoUnidad($conn, $idUnidad);
$nomUnidad = $unInfo[0][1]; 

if($mes == 1){ $mesAnterior = 12; $anioAnte = ($anio-1); }else{ $anioAnte = $anio; $mesAnterior = ($mes - 1); 	}



$existenciaAnt = getExistenciaAnterior($conn, $mesAnterior, $anioAnte, $idUnidad, $idMp);

if($existenciaAnt){ 

	$tramiteAnte = $existenciaAnt[0][0];  
	$bandHabTramite = 0;
}else{ 

	$tramiteAnte = 0; 
	$bandHabTramite = 1;

}

$d1 = getCountNucs($conn, 1, $mes, $anio, $idUnidad, $idMp, 0);

$d2 = getCountNucs($conn, 22, $mes, $anio, $idUnidad, $idMp, 1); 
$d3 = getCountNucs($conn, 22, $mes, $anio, $idUnidad, $idMp, 0); 

$d4 = getCountNucs($conn, 2, $mes, $anio, $idUnidad, $idMp, 0); 
$d5 = getCountNucs($conn, 5, $mes, $anio, $idUnidad, $idMp, 0); 
$d6 = getCountNucs($conn, 20, $mes, $anio, $idUnidad, $idMp, 0); 
$d7 = getCountNucs($conn, 21, $mes, $anio, $idUnidad, $idMp, 0); 
$d8 = getCountNucs($conn, 3, $mes, $anio, $idUnidad, $idMp, 0); 
$d9 = getCountNucs($conn, 23, $mes, $anio, $idUnidad, $idMp, 0); 
$d10 = getCountNucs($conn, 24, $mes, $anio, $idUnidad, $idMp, 0); 
$d11 = getCountNucs($conn, 25, $mes, $anio, $idUnidad, $idMp, 0); 
$d12 = getCountNucs($conn, 15, $mes, $anio, $idUnidad, $idMp, 0); 

$totDeterminaciones = $d2[0][0] + $d3[0][0] + $d4[0][0] + $d5[0][0] + $d6[0][0] + $d7[0][0] + $d8[0][0] + $d9[0][0] + $d10[0][0] + $d11[0][0] + $d12[0][0];

$datoCar = getDatosCarpetas($conn, $mes, $anio, $idUnidad, $idMp);
$totIni = $datoCar[0][6];
$recibiotrund = $datoCar[0][2];

$totaTrabvajar = $tramiteAnte + $totIni + $d1[0][0] + $recibiotrund ;
$totalJudicializadass = $d2[0][0] + $d3[0][0];

$totTramitss = $totaTrabvajar - ($totDeterminaciones + $datoCar[0][3] + $datoCar[0][4] + $datoCar[0][5])


?>

<div class="modal-header" style="background-color:#3c6084;">
	<button type="button" class="close" data-dismiss="modal">&times;</button>

	<center><h4 class="modal-title" style="color:white; font-weight: bold;"> <? echo $nomUnidad; ?> V2 </h4></center><br>
	<center><h5 class="modal-title" style="color:white; font-weight: ;"> <? echo $nombreCompletoMP; ?> </h5></center>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-group panelunoLitigacion">								      				


	<div class="row"  style="padding: 15px;">

		<div id="contentAllCarpetsform"> <!-- INICIO DEL CONTENT TOTAL CARPE -->
			
			<div class="row" >

				<div class="col-md-12 col-sm-12 col-xs-12">

					<div class="panel panel-default fd1" style="">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Existencia Anterior </strong></h5>
							<input class="form-control input-md redondear fdesv" id="inputTramiteAnterior" type="number" value="<? if( $bandHabTramite == 1 ){ echo $tramiteAnte; } else { echo $tramiteAnte; } ?>"  <?  echo "readonly"; ?> >
						</div>
					</div><br>

					<div class="panel panel-default fd1">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Iniciadas </strong></h5>

							<div class="row">

								<div class="col-xs-6">
									<label class="colorLetras"  for="inputlg">Con Detenido :</label>
									<input value="<? echo number_format($datoCar[0][0]); ?>" class="form-control input-md redondear fdesv" id="inputCdeten" type="number">
								</div>
								<div class="col-xs-6">
									<label class="colorLetras"  for="inputlg">Sin Detenido :</label>
									<input value="<? echo number_format($datoCar[0][1]); ?>" class="form-control input-md redondear fdesv" id="inputSdeten" type="number">
								</div>

							</div>

							<div class="row">

								<div class="col-md-12 col-sm-12 col-xs-12">
									<label class="colorLetras" for="inputlg">Total Iniciadas :</label>
									<div id="inicidadas"><input value="<? echo number_format($datoCar[0][6]); ?>" class="form-control input-md redondear fdesv colorBloqueado" value="0" id="inpuTotIniciadas" type="number" readonly></div>
								</div>

							</div>																				    	

						</div>
					</div>

					<div class="row">
						<? 					?>
						<div class="col-xs-12">
							<br>
							<div class="panel panel-default fd1" style="">
								<div class="panel-body">
									<h5 class="text-on-pannel"><strong>Reiniciadas :</strong></h5>
									<div class="iconiput">
										<input type="number" value="<? echo number_format($d1[0][0]); ?>" onclick="sendModalCarpetasNucs(1,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" style="cursor: pointer;" readonly placeholder="Clic para ingresar NUCS" class="first"  id="reiniciadasInser"/>
										<span onclick="sendModalCarpetasNucs(1,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)"><div id="checkreiniciadas"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
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
									<input class="form-control input-md redondear fdesv" value="<? echo number_format($datoCar[0][2]); ?>" id="reCbOtrUni" type="number">
								</div>
							</div>			    																											
						</div>

					</div>

					<div class="row">
						<div class="col-xs-12">
							<br>
							<div class="panel panel-default fd1" style="">
								<div class="panel-body">

									<div id="totTrabajarContent">	
										<h5 class="text-on-pannel"><strong> Total a Trabajar</strong></h5>
										<div id="totalTrabajar"><input class="form-control input-md redondear fdesv" id="inputTotalTrabajar" value="<? echo number_format($totaTrabvajar) ?>" type="number" readonly></div>
									</div>

								</div>
							</div>			    																											
						</div>
					</div> 

					<div class="panel panel-default fd1" style="margin-top: 5% !important;">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Resueltas o Determinadas   </strong></h5>

							<div class="row">

								<input id="idmp" type="hidden" value="<? echo $idMp; ?>" name="">
								<input id="mes" type="hidden" value="<? echo $mes; ?>" name="">
								<input id="anio" type="hidden" value="<? echo $anio; ?>" name="">




								<div class="col-xs-6">

									<label class="colorLetras" for="inputlg">Enviadas a Litigación Con Detenido :</label>
									<div class="iconiput">
										<input type="number" value="<? echo number_format($d2[0][0]); ?>" onclick="sendModalCarpetasNucs(22,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 1)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputCdetenju"/>
										<span onclick="sendModalCarpetasNucs(22,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 1)"><div id="checkCdetenju"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
									</div>	

								</div>
								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Enviadas a Litigación Sin Detenido :</label>
									<div class="iconiput">
										<input type="number" value="<? echo number_format($d3[0][0]); ?>" onclick="sendModalCarpetasNucs(22,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputSdetenju"/>
										<span onclick="sendModalCarpetasNucs(22,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)"><div id="checkSdetenju"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
									</div>	

								</div>

							</div>
							<div class="row">

								<div class="col-md-12 col-sm-12 col-xs-12">
									<label class="colorLetras" for="inputlg">Total judicializadas :</label>
									<div id="totalJudicializadas"><input class="form-control input-md redondear fdesv" id="inputJudicializadas" value="<? echo number_format($totalJudicializadass) ?>" type="number" readonly=""></div>
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
											<input type="number" value="<? echo number_format($d4[0][0]); ?>" onclick="sendModalCarpetasNucs(2,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>,0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first"  id="inputAbsInves"/>
											<span onclick="sendModalCarpetasNucs(2,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)"><div id="checkAbsInves"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
										</div>	
									</div>

									<div class="col-xs-12">
										<label class="colorLetras" for="inputlg">Archivo Temporal :</label>
										<div class="iconiput">
											<input type="number" value="<? echo number_format($d5[0][0]); ?>" onclick="sendModalCarpetasNucs(5,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputArcTem"/>
											<span onclick="sendModalCarpetasNucs(5,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)"><div id="checkArcTem"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
										</div>	

									</div>
									<div class="col-xs-12">
										<label class="colorLetras" for="inputlg">No ejercicio de la acción penal :</label>
										<div class="iconiput">
											<input type="number" value="<? echo number_format($d6[0][0]); ?>" onclick="sendModalCarpetasNucs(20,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first"  id="inputNEAP"/>
											<span onclick="sendModalCarpetasNucs(20,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)"><div id="checkNEAP"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
										</div>	

									</div>
									<div class="col-xs-12">
										<label class="colorLetras" for="inputlg">Incompetencia:</label>
										<div class="iconiput">
											<input type="number" value="<? echo number_format($d7[0][0]); ?>" onclick="sendModalCarpetasNucs(21,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputIncompe"/>
											<span onclick="sendModalCarpetasNucs(21,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)"><div id="checkIncompe"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
										</div>	

									</div>
									<div class="col-xs-12">
										<label class="colorLetras" for="inputlg">Acumulación :</label>
										<div class="iconiput">
											<input type="number" value="<? echo number_format($d8[0][0]); ?>" onclick="sendModalCarpetasNucs(3,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputAcumulacion"/>
											<span onclick="sendModalCarpetasNucs(3,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)"><div id="checkAcumulacion"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
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
										<input type="number" value="<? echo number_format($d9[0][0]); ?>" onclick="sendModalCarpetasNucs(23,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputMediacion"/>
										<span onclick="sendModalCarpetasNucs(23,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)"><div id="checkMediacion"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
									</div>	

								</div>
								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Conciliación :</label>
									<div class="iconiput">
										<input type="number" value="<? echo number_format($d10[0][0]); ?>" onclick="sendModalCarpetasNucs(24,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputConciliacion"/>
										<span onclick="sendModalCarpetasNucs(24,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)"><div id="checkConciliacion"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
									</div>	
								</div>

							</div>
							<div class="row">

								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Criterios de Oportunidad :</label>
									<div class="iconiput">
										<input type="number" value="<? echo number_format($d11[0][0]); ?>" onclick="sendModalCarpetasNucs(25,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputCriteOpor"/>
										<span onclick="sendModalCarpetasNucs(25,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)"><div id="checkCriteOpor"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
									</div>	

								</div>
								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Suspensión Condicional del Proceso :</label>
									<div class="iconiput">
										<input type="number" value="<? echo number_format($d12[0][0]); ?>" onclick="sendModalCarpetasNucs(15,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputSCP"/>
										<span onclick="sendModalCarpetasNucs(15,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)"><div id="checkSCP"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
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
									<h5 class="text-on-pannel"><strong> Total de Resoluciones o Determinadas </strong></h5>
									<div id="totalResoluciones"><input class="form-control input-md redondear fdesv" id="inputResoluciones" value="<? echo number_format($totDeterminaciones); ?>" type="number" readonly=""></div>
								</div>
							</div>

						</div>

						<div class="col-xs-12">
							<div class="panel panel-default fd1" style="">
								<div class="panel-body">



									<div class="col-xs-12">
										<label class="colorLetras" for="inputlg">Canalizadas a Unidad de Atención Temprana :</label>
										<input class="first" value="<? echo number_format($datoCar[0][3]); ?>" id="inputEnvUATP" type="number">
									</div>
									<div class="col-xs-12">
										<label class="colorLetras" for="inputlg">Canalizadas a Unidad de Investigación :</label>
										<input class="first" value="<? echo number_format($datoCar[0][4]); ?>"  id="inputEnvUI" type="number">
									</div>
									<div class="col-xs-12">
										<label class="colorLetras" for="inputlg">Canalizadas a Imputado Desconocido :</label>
										<input class="first"  value="<? echo number_format($datoCar[0][5]); ?>" id="inputEnvImpDesc" type="number">
									</div>
									<div class="col-xs-12">
										<label class="colorLetras" for="inputlg">Trámite :</label>
										<div id="tramiteFinal"><input class="form-control input-md redondear fdesv" id="inputTramiteFinal" value="<? echo number_format($totTramitss); ?>" type="number" readonly=""></div>
									</div>


								</div>
							</div>

						</div>


					</div>


				</div>	

			</div>
		</div> <!-- FIN DEL CONTENT TOTAL CARPE -->


	</div>										

</div>




</div>

</div>


</div>


<div id="continputdhidden">

</div>


<div class="row">

	<div class="col-xs-6 col-sm-6 col-md-6"><center><button style="width: 85%;" type="button" class="btn btn-primary redondear" onclick="saveDataCarpetasV2(<? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idMp; ?>)">Actualizar</button></center></div>


	<div class="col-xs-6 col-sm-6 col-md-6"><center><button style="width: 85%;" type="button" class="btn btn-default redondear" id="btnsavecarp" data-dismiss="modal">Cancelar</button></center></div>

</div> 

<br>

<div id="respuestaGuardado"></div>