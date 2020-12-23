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

	if($estatus == 19){ if (isset($_POST["idResolMP"])){ $idResolMP = $_POST["idResolMP"]; } }
	
?>

<div class="modal-header" style="background-color:#152F4A;">
	<center><h4  style="font-weight: bold; color: white;" class="modal-title">Estadística Básica del Sistema Estadistico de Procuración de Justicia (SENAP)</h4></center>
</div>

<div class="modal-body ">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<h4>Registro estadistico del NUC: <strong><? echo $nuc; ?></strong></h4>
		</div>
	</div><br>

 <? if($estatus == 3 || $estatus == 4){ ?>
	<div class="row">
		<!--¿Hubo formulación de la imputación?:-->
		<input value="1" class="form-control" id="formImputacion" name="formImputacion"  type="hidden">
		<div class="col-xs-12 col-sm-12  col-md-12">
			<label for="fechaFormulacionImpu">Fecha de formulación de la imputación:</label>
			<input id="fechaFormulacionImpu" type="date" value="" name="fechaFormulacionImpu" class="fechas form-control gehit"  />
		</div>
	</div><br><br><br><br>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<button style="width: 88%;" onclick="closeModalNucsLitigInfo()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button>
		</div>
		<div class="col-xs-12 col-sm-6  col-md-6 ">
			<button style="width: 88%;" onclick="insertFormImputacion_db(<? echo $idEstatusNucs; ?>, <? echo $idMp; ?>, <? echo $anio; ?>, <? echo $mes; ?>, <? echo $estatus; ?>, <? echo $nuc; ?>, <? echo $idUnidad; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		</div>
	</div>
 <? } ?>

 <? if($estatus == 19){ ?>
	<div class="row">
		<!--Resolución del auto de vinculación a proceso :-->
		<input value="1" class="form-control" id="resolAutoVincu" name="resolAutoVincu"  type="hidden">
		<div class="col-xs-12 col-sm-12  col-md-12">
			<label for="fechaAutoVinculacion">Fecha en que se dictó el auto de vinculación a proceso: </label>
			<input id="fechaAutoVinculacion" type="date" value="" name="fechaAutoVinculacion" class="fechas form-control gehit"  />
		</div>
	</div><br><br><br><br>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<button style="width: 88%;" onclick="closeModalNucsLitigInfo()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button>
		</div>
		<div class="col-xs-12 col-sm-6  col-md-6 ">
			<button style="width: 88%;" onclick="insertFormResoAutoVinc_db(<? echo $idResolMP; ?>, <? echo $idMp; ?>, <? echo $anio; ?>, <? echo $mes; ?>, <? echo $estatus; ?>, <? echo $nuc; ?>, <? echo $idUnidad; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		</div>
	</div>
 <? } ?>

 <? if($estatus == 17 || $estatus == 18 || $estatus == 20  || $estatus == 21 || $estatus == 22 || $estatus == 23  || $estatus == 24 || $estatus == 25 | $estatus == 26 || $estatus == 95){ ?>
	<div class="row">
		<!--¿Se impuso medida cautelar? :-->
		<input value="1" class="form-control" id="MedCautelar" name="MedCautelar"  type="hidden">
		<div class="col-xs-12 col-sm-12  col-md-12">
			<label for="tipoMedCautelar">Tipo de medidas cautelares impuestas: </label>
			<select id="tipoMedCautelar" name="tipoMedCautelar" tabindex="6" class="form-control redondear" disabled >
				<?$getTipoMedCautelar = getTipoMedCautelar($conSic);
				for ($i=0; $i < sizeof($getTipoMedCautelar); $i++) {
					$idTipoMedidaCautelar = $getTipoMedCautelar[$i][0];	$nombre = $getTipoMedCautelar[$i][1];	
					if(($estatus == 17 || $estatus == 18)  && $idTipoMedidaCautelar == 14){?>
					<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
				 <?   } ?>
				 <?if($estatus == 95 && $idTipoMedidaCautelar == 1){?>
					<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
				 <?   } ?>
				 <?if($estatus == 21 && $idTipoMedidaCautelar == 3){?>
					<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
				 <?   } ?>
				 <?if($estatus == 20 && $idTipoMedidaCautelar == 2){?>
					<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
				 <?   } ?>
				 <?if($estatus == 22 && $idTipoMedidaCautelar == 4){?>
					<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
				 <?   } ?>
				 <?if($estatus == 23 && $idTipoMedidaCautelar == 5){?>
					<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
				 <?   } ?>
				 <?if($estatus == 24 && $idTipoMedidaCautelar == 6){?>
					<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
				 <?   } ?>
				 <?if($estatus == 25 && $idTipoMedidaCautelar == 7){?>
					<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
				 <?   } ?>
					<? } ?>
				</select>
			</div><br>
				<div class="col-xs-12 col-sm-12  col-md-12">
			<label for="fechaAutoVinculacion">Fecha  del cierre de la investigación : </label>
			<input id="fechaAutoVinculacion" type="date" value="" name="fechaAutoVinculacion" class="fechas form-control gehit"  />
		</div><br>
		<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="formulacionAcusacion">¿Se formuló acusación?: </label>
						<select id="formulacionAcusacion" name="formulacionAcusacion" tabindex="6" class="form-control redondear"  onchange="validateFormuAcusa()">
							<option value="0">Selecciona</option>
							<?$getOptionDictonomica = getOptionDictonomica($conn);
							for ($i=0; $i < sizeof($getOptionDictonomica); $i++) {
								$idOpcion = $getOptionDictonomica[$i][0];	$opc = $getOptionDictonomica[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>"><? echo $opc; ?> </option>
							<? } ?>
						</select>
					</div>
	</div><br><br><br><br>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<button style="width: 88%;" onclick="closeModalNucsLitigInfo()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button>
		</div>
		<div class="col-xs-12 col-sm-6  col-md-6 ">
			<button style="width: 88%;" onclick="insertFormResoAutoVinc_db(<? echo $idResolMP; ?>, <? echo $idMp; ?>, <? echo $anio; ?>, <? echo $mes; ?>, <? echo $estatus; ?>, <? echo $nuc; ?>, <? echo $idUnidad; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		</div>
	</div>
 <? } ?>

</div>

<div class="modal-footer">
	
</div>




																												
																													
																																																			
																					