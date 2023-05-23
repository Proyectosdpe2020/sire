<?
session_start();

include("../../Conexiones/Conexion.php");
include("../../Conexiones/conexionSicap.php");
include("../../funciones.php");
include("../../funcioneSicap.php");
include("../../funcioneLit.php");



if (isset($_POST["nuc"])) {
	$nuc = $_POST["nuc"];
}
if (isset($_POST["curp"])) {
	$curp = $_POST["curp"];
}

//echo $estatus."----".$tipoestatus;

$idUsuario = $_SESSION['useridIE'];

$dataImputado = getDataFromImputadoCurp($conn, $curp);

?>


<div class="modal-header" style="background-color:#3c6084;">
	<center>
		<h4 class="modal-title" style="color:white; font-weight: bold;"> Registra el Imputado para la Carpeta ( <?php echo "  " . $nuc . "  "; ?> )</h4>
	</center>
</div>



<div>

	<div class="panel-body ">

		<div class="card" style="zoom: 100% !important;">
			<div class="card-body">

				<label>Nombre (s): </label> <? echo $dataImputado[0][0] . " " . $dataImputado[0][1] . " " . $dataImputado[0][2]; ?><br>
				<label>Edad : </label> <? echo $dataImputado[0][3]; ?><br>
				<label>Sexo : </label> <? if ($dataImputado[0][4] == "M") {
																															echo "Masculino";
																														}
																														if ($dataImputado[0][4] == "F") {
																															echo "Femenino";
																														} ?><br>
				<label>Curp : </label> <? echo $dataImputado[0][5]; ?><br><br>

				<div class="row mt-1">
					<div class="col-xs-12 col-sm-12 col-md-6">
						<center><button style="width: 100%;" type="button" class="btn btn-success redondear" onclick="guardarImputadoRegistrado(<? echo $dataImputado[0][7];  ?>, <? echo $nuc; ?>)">Guardar el Imputado</button></center>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6">
						<center><button style="width: 100%;" type="button" class="btn btn-primary redondear" onclick="salirImputadoRegistrado()">Salir</button></center>
					</div>
				</div>
			</div>
		</div>

	</div>

</div>