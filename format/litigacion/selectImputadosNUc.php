<?php
session_start();
include("../../Conexiones/Conexion.php");
include("../../funciones.php");
include("../../Conexiones/conexionSicap.php");
include("../../funcioneSicap.php");

if (isset($_POST["nuc"])) {
	$nuc = $_POST["nuc"];
}
if (isset($_POST["estatusResolucion"])) {
	$estatusResolucion = $_POST["estatusResolucion"];
}

if (isset($_POST["mes"])) {
	$mes = $_POST["mes"];
}

if (isset($_POST["anio"])) {
	$anio = $_POST["anio"];
}

if (isset($_POST["deten"])) {
	$deten = $_POST["deten"];
}

if (isset($_POST["idUnidad"])) {
	$idUnidad = $_POST["idUnidad"];
}

if (isset($_POST["idMp"])) {
	$idMp = $_POST["idMp"];
}


?>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-9">
		<label>Selecciona el Imputado relacionado a la determinación :</label>
		<select id="imputadoSeletedEnv" name="imputadoSeletedEnv" tabindex="6" class="form-control redondear" style="font-size: 18px !important;" required>
			<option value="0">Selecciona</option>
			<?
			$dataImputadosNUc = getImputadosXnuc($conn, $nuc);
			for ($k = 0; $k < sizeof($dataImputadosNUc); $k++) {

				if ($guardado[0][3] == $dataImputadosNUc[$k][7]) {
			?>
					<option style="font-weight: bold !important;" selected value="<? echo $dataImputadosNUc[$k][7]; ?>"><? echo $dataImputadosNUc[$k][0] . " " . $dataImputadosNUc[$k][1] . " " . $dataImputadosNUc[$k][2]; ?></option>
				<?
				} else {
				?>
					<option style="font-weight: bold !important;" value="<? echo $dataImputadosNUc[$k][7]; ?>"><? echo $dataImputadosNUc[$k][0] . " " . $dataImputadosNUc[$k][1] . " " . $dataImputadosNUc[$k][2]; ?></option>
			<?
				}
			}
			?>

		</select>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-3">
		<label>.</label>
		<button type="button" onclick="saveDeterminacionXimputado(<? echo $nuc; ?>, <? echo $idMp ?>, <? echo $estatusResolucion; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $deten; ?>, <? echo $idUnidad; ?> )" class="btn btn-success btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-floppy-open"></span> Guardar</button>
	</div>
</div>