<?

session_start();
include("../Conexiones/Conexion.php");
include("../Conexiones/conexionSicap.php");
include("../funciones.php");
include("../funcionesCarpetasV2.php");

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
} else {


	if ($anio <= 2021 && $mes > 6) {


		if ($mes == 1) {
			$mesAnterior = 12;
			$anioAnte = ($anio - 1);
		} else {
			$anioAnte = $anio;
			$mesAntAnterior = ($mes - 2);
			$mesAntAnterior3 = ($mes - 3);
			$mesAnterior = ($mes - 1);
		}

		$existenciaAnt = getExistenciaAnteriorV2($conn, $mesAnterior, $anioAnte, $idUnidad, $idMp);



		if ($existenciaAnt) {

			$tramiteAnte = $existenciaAnt[0][0];

			$bandHabTramite = 0;
		} else {

			$tramiteAnte = 0;
			$bandHabTramite = 1;
		}




		////////////////// NUEVOS CODIGOS PARA TRAMITES ////////////////////////
		////////////////// NUEVOS CODIGOS PARA TRAMITES ////////////////////////
		////////////////// NUEVOS CODIGOS PARA TRAMITES ////////////////////////

		////////////// SI EL MES ES 7 /////////////////////////
		////////////// SI EL MES ES 7 /////////////////////////
		////////////// SI EL MES ES 7 /////////////////////////

		$d11 = getCountNucs($conn, 1, 7, $anio, $idUnidad, $idMp, 0);

		$d21 = getCountNucs($conn, 22, 7, $anio, $idUnidad, $idMp, 1);
		$d31 = getCountNucs($conn, 22, 7, $anio, $idUnidad, $idMp, 0);

		$d41 = getCountNucs($conn, 2, 7, $anio, $idUnidad, $idMp, 0);
		$d51 = getCountNucs($conn, 5, 7, $anio, $idUnidad, $idMp, 0);
		$d61 = getCountNucs($conn, 20, 7, $anio, $idUnidad, $idMp, 0);
		$d71 = getCountNucs($conn, 21, 7, $anio, $idUnidad, $idMp, 0);
		$d81 = getCountNucs($conn, 3, 7, $anio, $idUnidad, $idMp, 0);
		$d91 = getCountNucs($conn, 23, 7, $anio, $idUnidad, $idMp, 0);
		$d101 = getCountNucs($conn, 24, 7, $anio, $idUnidad, $idMp, 0);
		$d111 = getCountNucs($conn, 25, 7, $anio, $idUnidad, $idMp, 0);
		$d121 = getCountNucs($conn, 15, 7, $anio, $idUnidad, $idMp, 0);

		$existNewJulio = getDataCarpetasDatosExistenciaAnteriorV2($conn, 7, $anio, $idUnidad, $idMp);

		$exiAntJulio = getExistenciaAnterior($conn, 6, $anio, $idUnidad, $idMp);

		$totaTrabJulio = $exiAntJulio[0][0] + $existNewJulio[0][0] + $d11[0][0] + $existNewJulio[0][1];
		$totDeterminacionesJulio = $d21[0][0] + $d31[0][0] + $d41[0][0] + $d51[0][0] + $d61[0][0] + $d71[0][0] + $d81[0][0] + $d91[0][0] + $d101[0][0] + $d111[0][0] + $d121[0][0];

		$enviadsJulio = $existNewJulio[0][2] + $existNewJulio[0][3] + $existNewJulio[0][4];
		$enviaddetermnsJulio = $enviadsJulio + $totDeterminacionesJulio;

		$totTramiteJulio = $totaTrabJulio - $enviaddetermnsJulio;


		////////////// SI EL MES ES 7 /////////////////////////
		////////////// SI EL MES ES 7 /////////////////////////
		////////////// SI EL MES ES 7 /////////////////////////

		////////////// SI EL MES ES 8 /////////////////////////
		////////////// SI EL MES ES 8 /////////////////////////
		////////////// SI EL MES ES 8 /////////////////////////

		$d1 = getCountNucs($conn, 1, 8, $anio, $idUnidad, $idMp, 0);

		$d2 = getCountNucs($conn, 22, 8, $anio, $idUnidad, $idMp, 1);
		$d3 = getCountNucs($conn, 22, 8, $anio, $idUnidad, $idMp, 0);

		$d4 = getCountNucs($conn, 2, 8, $anio, $idUnidad, $idMp, 0);
		$d5 = getCountNucs($conn, 5, 8, $anio, $idUnidad, $idMp, 0);
		$d6 = getCountNucs($conn, 20, 8, $anio, $idUnidad, $idMp, 0);
		$d7 = getCountNucs($conn, 21, 8, $anio, $idUnidad, $idMp, 0);
		$d8 = getCountNucs($conn, 3, 8, $anio, $idUnidad, $idMp, 0);
		$d9 = getCountNucs($conn, 23, 8, $anio, $idUnidad, $idMp, 0);
		$d10 = getCountNucs($conn, 24, 8, $anio, $idUnidad, $idMp, 0);
		$d11 = getCountNucs($conn, 25, 8, $anio, $idUnidad, $idMp, 0);
		$d12 = getCountNucs($conn, 15, 8, $anio, $idUnidad, $idMp, 0);

		$existNewAgos = getDataCarpetasDatosExistenciaAnteriorV2($conn, 8, $anio, $idUnidad, $idMp);

		$totaTrabAgo = $totTramiteJulio + $existNewAgos[0][0] + $d1[0][0] + $existNewAgos[0][1];
		$totDeterminacionesAgo = $d2[0][0] + $d3[0][0] + $d4[0][0] + $d5[0][0] + $d6[0][0] + $d7[0][0] + $d8[0][0] + $d9[0][0] + $d10[0][0] + $d11[0][0] + $d12[0][0];

		$enviadsAgo = $existNewAgos[0][2] + $existNewAgos[0][3] + $existNewAgos[0][4];
		$enviaddetermnsAgo = $enviadsAgo + $totDeterminacionesAgo;

		$totTramiteAgosto = $totaTrabAgo - $enviaddetermnsAgo;

		////////////// SI EL MES ES 8 /////////////////////////
		////////////// SI EL MES ES 8 /////////////////////////
		////////////// SI EL MES ES 8 /////////////////////////

		////////////// SI EL MES ES 9 /////////////////////////
		////////////// SI EL MES ES 9 /////////////////////////
		////////////// SI EL MES ES 9 /////////////////////////

		$dd1 = getCountNucs($conn, 1, 9, $anio, $idUnidad, $idMp, 0);

		$dd2 = getCountNucs($conn, 22, 9, $anio, $idUnidad, $idMp, 1);
		$dd3 = getCountNucs($conn, 22, 9, $anio, $idUnidad, $idMp, 0);

		$dd4 = getCountNucs($conn, 2, 9, $anio, $idUnidad, $idMp, 0);
		$dd5 = getCountNucs($conn, 5, 9, $anio, $idUnidad, $idMp, 0);
		$dd6 = getCountNucs($conn, 20, 9, $anio, $idUnidad, $idMp, 0);
		$dd7 = getCountNucs($conn, 21, 9, $anio, $idUnidad, $idMp, 0);
		$dd8 = getCountNucs($conn, 3, 9, $anio, $idUnidad, $idMp, 0);
		$dd9 = getCountNucs($conn, 23, 9, $anio, $idUnidad, $idMp, 0);
		$dd10 = getCountNucs($conn, 24, 9, $anio, $idUnidad, $idMp, 0);
		$dd11 = getCountNucs($conn, 25, 9, $anio, $idUnidad, $idMp, 0);
		$dd12 = getCountNucs($conn, 15, 9, $anio, $idUnidad, $idMp, 0);

		$existNewSep = getDataCarpetasDatosExistenciaAnteriorV2($conn, 9, $anio, $idUnidad, $idMp, 0);

		$totaTrabSep = $totTramiteAgosto + $existNewSep[0][0] + $dd1[0][0] + $existNewSep[0][1];
		$totDeterminacionesSep = $dd2[0][0] + $dd3[0][0] + $dd4[0][0] + $dd5[0][0] + $dd6[0][0] + $dd7[0][0] + $dd8[0][0] + $dd9[0][0] + $dd10[0][0] + $dd11[0][0] + $dd12[0][0];

		$enviadsSep = $existNewSep[0][2] + $existNewSep[0][3] + $existNewSep[0][4];
		$enviaddetermnsSep = $enviadsSep + $totDeterminacionesSep;

		$totTramiteSeptiembre = $totaTrabSep - $enviaddetermnsSep;

		////////////// SI EL MES ES 9 /////////////////////////
		////////////// SI EL MES ES 9 /////////////////////////
		////////////// SI EL MES ES 9 /////////////////////////



		if ($mes == 7) {


			$tramAnterior =  $exiAntJulio[0][0];

			$de11 = getCountNucs($conn, 1, 7, $anio, $idUnidad, $idMp, 0);

			$de21 = getCountNucs($conn, 22, 7, $anio, $idUnidad, $idMp, 1);
			$de31 = getCountNucs($conn, 22, 7, $anio, $idUnidad, $idMp, 0);

			$de41 = getCountNucs($conn, 2, 7, $anio, $idUnidad, $idMp, 0);
			$de51 = getCountNucs($conn, 5, 7, $anio, $idUnidad, $idMp, 0);
			$de61 = getCountNucs($conn, 20, 7, $anio, $idUnidad, $idMp, 0);
			$de71 = getCountNucs($conn, 21, 7, $anio, $idUnidad, $idMp, 0);
			$de81 = getCountNucs($conn, 3, 7, $anio, $idUnidad, $idMp, 0);
			$de91 = getCountNucs($conn, 23, 7, $anio, $idUnidad, $idMp, 0);
			$de101 = getCountNucs($conn, 24, 7, $anio, $idUnidad, $idMp, 0);
			$de111 = getCountNucs($conn, 25, 7, $anio, $idUnidad, $idMp, 0);
			$de121 = getCountNucs($conn, 15, 7, $anio, $idUnidad, $idMp, 0);


			$iniciadas = $existNewJulio[0][0];
			$recibidas = $existNewJulio[0][1];
			$totalTrabajar = $totaTrabJulio;
			$judicializadas = $de21[0][0] + $de31[0][0];
			$totResoluciones = $totDeterminacionesJulio;
			$enviUATP = $existNewJulio[0][2];
			$enviUI = $existNewJulio[0][3];
			$enviMp = $existNewJulio[0][4];

			$tramiteFinls = 	$totTramiteJulio;
		}
		if ($mes == 8) {



			$tramAnterior =  $totTramiteJulio;

			$de11 = getCountNucs($conn, 1, 8, $anio, $idUnidad, $idMp, 0);

			$de21 = getCountNucs($conn, 22, 8, $anio, $idUnidad, $idMp, 1);
			$de31 = getCountNucs($conn, 22, 8, $anio, $idUnidad, $idMp, 0);

			$de41 = getCountNucs($conn, 2, 8, $anio, $idUnidad, $idMp, 0);
			$de51 = getCountNucs($conn, 5, 8, $anio, $idUnidad, $idMp, 0);
			$de61 = getCountNucs($conn, 20, 8, $anio, $idUnidad, $idMp, 0);
			$de71 = getCountNucs($conn, 21, 8, $anio, $idUnidad, $idMp, 0);
			$de81 = getCountNucs($conn, 3, 8, $anio, $idUnidad, $idMp, 0);
			$de91 = getCountNucs($conn, 23, 8, $anio, $idUnidad, $idMp, 0);
			$de101 = getCountNucs($conn, 24, 8, $anio, $idUnidad, $idMp, 0);
			$de111 = getCountNucs($conn, 25, 8, $anio, $idUnidad, $idMp, 0);
			$de121 = getCountNucs($conn, 15, 8, $anio, $idUnidad, $idMp, 0);


			$iniciadas = $existNewAgos[0][0];
			$recibidas = $existNewAgos[0][1];
			$totalTrabajar = $totaTrabAgo;
			$judicializadas = $de21[0][0] + $de31[0][0];
			$totResoluciones = $totDeterminacionesAgo;
			$enviUATP = $existNewAgos[0][2];
			$enviUI = $existNewAgos[0][3];
			$enviMp = $existNewAgos[0][4];

			$tramiteFinls = 	$totTramiteAgosto;
		}

		if ($mes == 9) {



			$tramAnterior =  $totTramiteAgosto;



			$de11 = getCountNucs($conn, 1, 9, $anio, $idUnidad, $idMp, 0);

			$de21 = getCountNucs($conn, 22, 9, $anio, $idUnidad, $idMp, 1);
			$de31 = getCountNucs($conn, 22, 9, $anio, $idUnidad, $idMp, 0);

			$de41 = getCountNucs($conn, 2, 9, $anio, $idUnidad, $idMp, 0);
			$de51 = getCountNucs($conn, 5, 9, $anio, $idUnidad, $idMp, 0);
			$de61 = getCountNucs($conn, 20, 9, $anio, $idUnidad, $idMp, 0);
			$de71 = getCountNucs($conn, 21, 9, $anio, $idUnidad, $idMp, 0);
			$de81 = getCountNucs($conn, 3, 9, $anio, $idUnidad, $idMp, 0);
			$de91 = getCountNucs($conn, 23, 9, $anio, $idUnidad, $idMp, 0);
			$de101 = getCountNucs($conn, 24, 9, $anio, $idUnidad, $idMp, 0);
			$de111 = getCountNucs($conn, 25, 9, $anio, $idUnidad, $idMp, 0);
			$de121 = getCountNucs($conn, 15, 9, $anio, $idUnidad, $idMp, 0);

			$iniciadasCd = $existNewSep[0][5];
			$iniciadasSd = $existNewSep[0][6];
			$iniciadas = $existNewSep[0][0];
			$recibidas = $existNewSep[0][1];
			$totalTrabajar = $totaTrabSep;
			$judicializadas = $de21[0][0] + $de31[0][0];
			$totResoluciones = $totDeterminacionesSep;
			$enviUATP = $existNewSep[0][2];
			$enviUI = $existNewSep[0][3];
			$enviMp = $existNewSep[0][4];

			$tramiteFinls = 	$totTramiteSeptiembre;
		}


		///// SE HARA UN PARCH PARA PODER CERRAR LO QUE QUEDA DE 2021

		if ($mes > 9) {

			$nuevaexistenciaAnt = getDataCarpetasDatosExistenciaAnteriorV2($conn, $mesAnterior, $anioAnte, $idUnidad, $idMp, 0);
			$tramAnterior =  intval($nuevaexistenciaAnt[0][7]);

			$nuevaexistencia = getDataCarpetasDatosExistenciaAnteriorV2($conn, $mes, $anio, $idUnidad, $idMp, 0);
			$tramAnterior2 =  intval($nuevaexistencia[0][7]);

			$de11 = getCountNucs($conn, 1, $mes, $anio, $idUnidad, $idMp, 0);

			$de21 = getCountNucs($conn, 22, $mes, $anio, $idUnidad, $idMp, 1);
			$de31 = getCountNucs($conn, 22, $mes, $anio, $idUnidad, $idMp, 0);

			$de41 = getCountNucs($conn, 2, $mes, $anio, $idUnidad, $idMp, 0);
			$de51 = getCountNucs($conn, 5, $mes, $anio, $idUnidad, $idMp, 0);
			$de61 = getCountNucs($conn, 20, $mes, $anio, $idUnidad, $idMp, 0);
			$de71 = getCountNucs($conn, 21, $mes, $anio, $idUnidad, $idMp, 0);
			$de81 = getCountNucs($conn, 3, $mes, $anio, $idUnidad, $idMp, 0);
			$de91 = getCountNucs($conn, 23, $mes, $anio, $idUnidad, $idMp, 0);
			$de101 = getCountNucs($conn, 24, $mes, $anio, $idUnidad, $idMp, 0);
			$de111 = getCountNucs($conn, 25, $mes, $anio, $idUnidad, $idMp, 0);
			$de121 = getCountNucs($conn, 15, $mes, $anio, $idUnidad, $idMp, 0);

			$iniciadasCd = $nuevaexistencia[0][5];
			$iniciadasSd = $nuevaexistencia[0][6];
			$iniciadas = $nuevaexistencia[0][0];
			$recibidas = $nuevaexistencia[0][1];


			$totalTrabajar = intval($tramAnterior) + intval($iniciadas) + intval($recibidas) + intval($de11[0][0]);

			$judicializadas = $de21[0][0] + $de31[0][0];
			$totResoluciones = $de21[0][0] + $de31[0][0] + $de41[0][0] + $de51[0][0] + $de61[0][0] + $de71[0][0] + $de81[0][0] + $de91[0][0] + $de101[0][0] + $de111[0][0] + $de121[0][0];

			$enviUATP = $nuevaexistencia[0][2];
			$enviUI = $nuevaexistencia[0][3];
			$enviMp = $nuevaexistencia[0][4];

			$tramiteFinls = 	$totalTrabajar - ($totResoluciones + $enviUATP + $enviUI + $enviMp);
		}





		////////////////// NUEVOS CODIGOS PARA TRAMITES ////////////////////////
		////////////////// NUEVOS CODIGOS PARA TRAMITES ////////////////////////
		////////////////// NUEVOS CODIGOS PARA TRAMITES ////////////////////////

	} else {



		if ($mes == 1) {
			$mesAnterior = 12;
			$anioAnte = ($anio - 1);
		} else {
			$anioAnte = $anio;
			$mesAnterior = ($mes - 1);
		}

		/// AQUI VAN LOS TRAMITES YA RECOGIDOS DE LA TABLA CARPETASDATOS A PARTIR DE 2022
		$existenciaAnt =	getExistenciaAnteriorV2($conn, $mesAnterior, $anioAnte, $idUnidad, $idMp);

		if ($existenciaAnt) {

			$tramAnterior = $existenciaAnt[0][0];
			$bandHabTramite = 0;
		} else {

			$tramAnterior = 0;
			$bandHabTramite = 1;
		}

		$nuevaexistenciaAnt = getDataCarpetasDatosExistenciaAnteriorV2($conn, $mesAnterior, $anioAnte, $idUnidad, $idMp, 0);
		$tramAnterior =  intval($nuevaexistenciaAnt[0][7]);

		$nuevaexistencia = getDataCarpetasDatosExistenciaAnteriorV2($conn, $mes, $anio, $idUnidad, $idMp, 0);
		$tramAnterior2 =  intval($nuevaexistencia[0][7]);

		$de11 = getCountNucs($conn, 1, $mes, $anio, $idUnidad, $idMp, 0);

		$de21 = getCountNucs($conn, 22, $mes, $anio, $idUnidad, $idMp, 1);
		$de31 = getCountNucs($conn, 22, $mes, $anio, $idUnidad, $idMp, 0);

		$de41 = getCountNucs($conn, 2, $mes, $anio, $idUnidad, $idMp, 0);
		$de51 = getCountNucs($conn, 5, $mes, $anio, $idUnidad, $idMp, 0);
		$de61 = getCountNucs($conn, 20, $mes, $anio, $idUnidad, $idMp, 0);
		$de71 = getCountNucs($conn, 21, $mes, $anio, $idUnidad, $idMp, 0);
		$de81 = getCountNucs($conn, 3, $mes, $anio, $idUnidad, $idMp, 0);
		$de91 = getCountNucs($conn, 23, $mes, $anio, $idUnidad, $idMp, 0);
		$de101 = getCountNucs($conn, 24, $mes, $anio, $idUnidad, $idMp, 0);
		$de111 = getCountNucs($conn, 25, $mes, $anio, $idUnidad, $idMp, 0);
		$de121 = getCountNucs($conn, 15, $mes, $anio, $idUnidad, $idMp, 0);

		$iniciadasCd = $nuevaexistencia[0][5];
		$iniciadasSd = $nuevaexistencia[0][6];
		$iniciadas = $nuevaexistencia[0][0];
		$recibidas = $nuevaexistencia[0][1];


		$totalTrabajar = intval($tramAnterior) + intval($iniciadas) + intval($recibidas) + intval($de11[0][0]);

		$judicializadas = $de21[0][0] + $de31[0][0];
		$totResoluciones = $de21[0][0] + $de31[0][0] + $de41[0][0] + $de51[0][0] + $de61[0][0] + $de71[0][0] + $de81[0][0] + $de91[0][0] + $de101[0][0] + $de111[0][0] + $de121[0][0];

		$enviUATP = $nuevaexistencia[0][2];
		$enviUI = $nuevaexistencia[0][3];
		$enviMp = $nuevaexistencia[0][4];

		$tramiteFinls = 	$totalTrabajar - ($totResoluciones + $enviUATP + $enviUI + $enviMp);
	}
}



?>

<div class="modal-header" style="background-color:#3c6084;">
	<button type="button" class="close" data-dismiss="modal">&times;</button>

	<center>
		<h4 class="modal-title" style="color:white; font-weight: bold;"> <? echo $nomUnidad; ?> V2 </h4>
	</center><br>
	<center>
		<h5 class="modal-title" style="color:white; font-weight: ;"> <? echo $nombreCompletoMP; ?> </h5>
	</center>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-group panelunoLitigacion">


	<div class="row" style="padding: 15px;">

		<div id="contentAllCarpetsform">
			<!-- INICIO DEL CONTENT TOTAL CARPE -->

			<div class="row">

				<div class="col-md-12 col-sm-12 col-xs-12">

					<div class="panel panel-default fd1" style="">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Existencia Anterior </strong></h5>
							<input class="form-control input-md redondear fdesv" id="inputTramiteAnterior" type="number" value="<? if ($bandHabTramite == 1) {
																																																																																																												echo $tramAnterior;
																																																																																																											} else {
																																																																																																												echo $tramAnterior;
																																																																																																											} ?>" <? echo "readonly"; ?>>
						</div>
					</div><br>

					<div class="panel panel-default fd1">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Iniciadas </strong></h5>

							<div class="row">

								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Con Detenido :</label>
									<input value="<? echo number_format($iniciadasCd); ?>" class="form-control input-md redondear fdesv" id="inputCdeten" type="number">
								</div>
								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Sin Detenido :</label>
									<input value="<? echo number_format($iniciadasSd); ?>" class="form-control input-md redondear fdesv" id="inputSdeten" type="number">
								</div>

							</div>

							<div class="row">

								<div class="col-md-12 col-sm-12 col-xs-12">
									<label class="colorLetras" for="inputlg">Total Iniciadas :</label>
									<div id="inicidadas"><input value="<? echo number_format($iniciadas); ?>" class="form-control input-md redondear fdesv colorBloqueado" value="0" id="inpuTotIniciadas" type="number" readonly></div>
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
										<input type="number" value="<? echo number_format($de11[0][0]); ?>" onclick="sendModalCarpetasNucs(1,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" style="cursor: pointer;" readonly placeholder="Clic para ingresar NUCS" class="first" id="reiniciadasInser" />
										<span onclick="sendModalCarpetasNucs(1,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)">
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
									<input class="form-control input-md redondear fdesv" value="<? echo number_format($recibidas); ?>" id="reCbOtrUni" type="number">
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
										<div id="totalTrabajar"><input class="form-control input-md redondear fdesv" id="inputTotalTrabajar" value="<? echo $totalTrabajar ?>" type="number" readonly></div>
									</div>

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

									<label class="colorLetras" for="inputlg">Enviadas a Litigación Con Detenido :</label>
									<div class="iconiput">
										<input type="number" value="<? echo number_format($de21[0][0]); ?>" onclick="sendModalCarpetasNucs(22,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 1)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputCdetenju" />
										<span onclick="sendModalCarpetasNucs(22,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 1)">
											<div id="checkCdetenju"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>

								</div>
								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Enviadas a Litigación Sin Detenido :</label>
									<div class="iconiput">
										<input type="number" value="<? echo number_format($de31[0][0]); ?>" onclick="sendModalCarpetasNucs(22,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputSdetenju" />
										<span onclick="sendModalCarpetasNucs(22,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)">
											<div id="checkSdetenju"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>

								</div>

							</div>
							<div class="row">

								<div class="col-md-12 col-sm-12 col-xs-12">
									<label class="colorLetras" for="inputlg">Total judicializadas :</label>
									<div id="totalJudicializadas"><input class="form-control input-md redondear fdesv" id="inputJudicializadas" value="<? echo number_format($judicializadas) ?>" type="number" readonly=""></div>
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
											<input type="number" value="<? echo number_format($de41[0][0]); ?>" onclick="sendModalCarpetasNucs(2,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>,0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputAbsInves" />
											<span onclick="sendModalCarpetasNucs(2,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)">
												<div id="checkAbsInves"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
											</span>
										</div>
									</div>

									<div class="col-xs-12">
										<label class="colorLetras" for="inputlg">Archivo Temporal :</label>
										<div class="iconiput">
											<input type="number" value="<? echo number_format($de51[0][0]); ?>" onclick="sendModalCarpetasNucs(5,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputArcTem" />
											<span onclick="sendModalCarpetasNucs(5,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)">
												<div id="checkArcTem"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
											</span>
										</div>

									</div>
									<div class="col-xs-12">
										<label class="colorLetras" for="inputlg">No ejercicio de la acción penal :</label>
										<div class="iconiput">
											<input type="number" value="<? echo number_format($de61[0][0]); ?>" onclick="sendModalCarpetasNucs(20,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputNEAP" />
											<span onclick="sendModalCarpetasNucs(20,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)">
												<div id="checkNEAP"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
											</span>
										</div>

									</div>
									<div class="col-xs-12">
										<label class="colorLetras" for="inputlg">Incompetencia:</label>
										<div class="iconiput">
											<input type="number" value="<? echo number_format($de71[0][0]); ?>" onclick="sendModalCarpetasNucs(21,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputIncompe" />
											<span onclick="sendModalCarpetasNucs(21,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)">
												<div id="checkIncompe"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
											</span>
										</div>

									</div>
									<div class="col-xs-12">
										<label class="colorLetras" for="inputlg">Acumulación :</label>
										<div class="iconiput">
											<input type="number" value="<? echo number_format($de81[0][0]); ?>" onclick="sendModalCarpetasNucs(3,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputAcumulacion" />
											<span onclick="sendModalCarpetasNucs(3,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)">
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
										<input type="number" value="<? echo number_format($de91[0][0]); ?>" onclick="sendModalCarpetasNucs(23,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputMediacion" />
										<span onclick="sendModalCarpetasNucs(23,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)">
											<div id="checkMediacion"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>

								</div>
								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Conciliación :</label>
									<div class="iconiput">
										<input type="number" value="<? echo number_format($de101[0][0]); ?>" onclick="sendModalCarpetasNucs(24,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputConciliacion" />
										<span onclick="sendModalCarpetasNucs(24,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)">
											<div id="checkConciliacion"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>
								</div>

							</div>
							<div class="row">

								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Criterios de Oportunidad :</label>
									<div class="iconiput">
										<input type="number" value="<? echo number_format($de111[0][0]); ?>" onclick="sendModalCarpetasNucs(25,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputCriteOpor" />
										<span onclick="sendModalCarpetasNucs(25,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)">
											<div id="checkCriteOpor"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
										</span>
									</div>

								</div>
								<div class="col-xs-6">
									<label class="colorLetras" for="inputlg">Suspensión Condicional del Proceso :</label>
									<div class="iconiput">
										<input type="number" value="<? echo number_format($de121[0][0]); ?>" onclick="sendModalCarpetasNucs(15,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputSCP" />
										<span onclick="sendModalCarpetasNucs(15,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)">
											<div id="checkSCP"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div>
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
									<h5 class="text-on-pannel"><strong> Total de Resoluciones o Determinadas </strong></h5>
									<div id="totalResoluciones"><input class="form-control input-md redondear fdesv" id="inputResoluciones" value="<? echo number_format($totResoluciones); ?>" type="number" readonly=""></div>
								</div>
							</div>

						</div>

						<div class="col-xs-12">
							<div class="panel panel-default fd1" style="">
								<div class="panel-body">



									<div class="col-xs-12">
										<label class="colorLetras" for="inputlg">Canalizadas a Unidad de Atención Temprana :</label>
										<input class="first" value="<? echo number_format($enviUATP); ?>" id="inputEnvUATP" type="number">
									</div>
									<div class="col-xs-12">
										<label class="colorLetras" for="inputlg">Canalizadas a Unidad de Investigación :</label>
										<input class="first" value="<? echo number_format($enviUI); ?>" id="inputEnvUI" type="number">
									</div>
									<div class="col-xs-12">
										<label class="colorLetras" for="inputlg">Canalizadas a Imputado Desconocido :</label>
										<input class="first" value="<? echo number_format($enviMp); ?>" id="inputEnvImpDesc" type="number">
									</div>
									<div class="col-xs-12">
										<label class="colorLetras" for="inputlg">Trámite :</label>
										<div id="tramiteFinal"><input class="form-control input-md redondear fdesv" id="inputTramiteFinal" value="<? echo $tramiteFinls; ?>" type="number" readonly=""></div>
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

	<div class="col-xs-6 col-sm-6 col-md-6">
		<center><button style="width: 85%;" type="button" class="btn btn-primary redondear" onclick="saveDataCarpetasV2(<? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idMp; ?>)">Actualizar</button></center>
	</div>


	<div class="col-xs-6 col-sm-6 col-md-6">
		<center><button style="width: 85%;" type="button" class="btn btn-default redondear" id="btnsavecarp" data-dismiss="modal">Cancelar</button></center>
	</div>

</div>

<br>

<div id="respuestaGuardado"></div>