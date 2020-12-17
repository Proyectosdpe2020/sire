<? 

 include ("../../Conexiones/Conexion.php");
 include ("../../Conexiones/conexionSicap.php");
	include("../../funciones.php");
	include("../../funcioneSicap.php");
	include("../../funcioneLit.php");
	include("../../funcionesLitSENAP.php");

	if (isset($_POST["idEstatusNucs"])){ $idEstatusNucs = $_POST["idEstatusNucs"]; }
	if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
	if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
	if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
	if (isset($_POST["estatus"])){ $estatus = $_POST["estatus"]; }
	if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
	if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
	$getNucExpedienteSicap = getNucExpedienteSicap($conSic, $nuc);
	$expediente = $getNucExpedienteSicap[0][0];
	
?>


<div class="modal-header" style="background-color:#152F4A;">
	<center><h4  style="font-weight: bold; color: white;" class="modal-title">Estadística Básica del Sistema Estadistico de Procuración de Justicia (SENAP)</h4></center>
</div>

<div class="modal-body">
	<div class="row">
		<div class="col-xs-12 col-sm-3 col-md-3">
			<h4>Registro estadistico del NUC: <strong><? echo $nuc; ?></strong></h4>
		</div>
	</div><br>

	<div class="row">
		<!--LISTADO DE OPCIONES-->
		<div class="col-xs-12 col-sm-3 col-md-3">
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="show(<? echo $idMando; ?>)">Estado de la CI</button>
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="show(<? echo $idMando; ?>)">Audiencia Inicial</button>
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="show(<? echo $idMando; ?>)">Etapa Intermedia</button>
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="show(<? echo $idMando; ?>)">MASC</button>
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="show(<? echo $idMando; ?>)">Sobreseimiento</button>
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="show(<? echo $idMando; ?>)">Suspensión condicional</button>
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="show(<? echo $idMando; ?>)">Suspensión condicional</button>
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="show(<? echo $idMando; ?>)">Juicio Oral</button>
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="show(<? echo $idMando; ?>)">Sentencia</button>
		</div>
		<!--FORMULARIO-->
		<div class="col-xs-12 col-sm-9 col-md-9">
				<div class="row">
					<div class="col-xs-12 col-sm-3 col-md-3">
						<label for="idSegCaso">Seguimiento del caso:</label>
						<input value="<? echo $expediente; ?>" type="text" style="text-transform:uppercase;" class="form-control" id="idSegCaso" name="idSegCaso" onkeyup="javascript:this.value=this.value.toUpperCase();" disabled>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6">
						<label for="">Etapa procesal en la que se encuentra la CI:</label>
						
					</div>
				</div>
		</div>
	</div><br><br>

</div><br><br>

<div class="modal-footer">
	<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button></center></div>
			<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="" type="button" class="btn btn-primary redondear" >Guardar</button></center></div>
	</div>
</div>




																												
																													
																																																			
																					