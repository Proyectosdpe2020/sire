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

<div class="modal-body panelunoLitigacion1">
	<div class="row">
		<div class="col-xs-12 col-sm-3 col-md-3">
			<h4>Registro estadistico del NUC: <strong><? echo $nuc; ?></strong></h4>
		</div>
	</div><br>

 <? if($estatus == 3 || $estatus == 4){ ?>
	<div class="row">
		<!--¿Hubo formulación de la imputación?:-->
		<input value="1" class="form-control" id="formImputacion" name="formImputacion"  type="hidden">
		<div class="col-xs-12 col-sm-4  col-md-4">
			<label for="fechaFormulacionImpu">Fecha de formulación de la imputación:</label>
			<input id="fechaFormulacionImpu" type="date" value="" name="fechaFormulacionImpu" class="fechas form-control gehit"  />
		</div>
	</div>
 <? } ?>

</div>

<div class="modal-footer">
	<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="closeModalNucsLitigInfo()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button></center></div>
			<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="insertDBInfoLiti(<? echo $idEstatusNucs; ?>, <? echo $idMp; ?>, <? echo $anio; ?>, <? echo $mes; ?>, <? echo $estatus; ?>, <? echo $nuc; ?>, <? echo $idUnidad; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button></center></div>
	</div>
</div>




																												
																													
																																																			
																					