<? 

 include ("../../Conexiones/Conexion.php");
 include ("../../Conexiones/conexionSicap.php");
	include("../../funciones.php");
	include("../../funcioneSicap.php");
	include("../../funcioneLit.php");
	include("../../funcionesLitSENAP.php");

	if (isset($_POST["idEstatusNucs"])){ $idEstatusNucs = $_POST["idEstatusNucs"]; } else{ $idEstatusNucs = 0; }
	if (isset($_POST["estatus"])){ $estatus = $_POST["estatus"]; }
	if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
	if (isset($_POST["idCarpeta"])){ $idCarpeta = $_POST["idCarpeta"]; }

		if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
	if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
	if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
	if (isset($_POST["deten"])){ $deten = $_POST["deten"]; }
		if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }

	$getNucExpedienteSicap = getNucExpedienteSicap($conSic, $nuc);
	$expediente = $getNucExpedienteSicap[0][0];

	if($estatus == 19 || $estatus == 14){ if (isset($_POST["idResolMP"])){ $idResolMP = $_POST["idResolMP"]; }else{ $idResolMP = 0; } }
	
?>

<div class="modal-header" style="background-color:#152F4A;">
	<center><h4  style="font-weight: bold; color: white;" class="modal-title">Estadística de Imputados por carpeta</h4></center>
</div>

<div class="modal-body ">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<h4>Ingrese datos generales de los imputados del NUC: <strong><? echo $nuc; ?></strong></h4>
		</div>
	</div><br>

<?
$getData = getDataImputados($conn, $idEstatusNucs);
	 	if(sizeof($getData) > 0){ 
	 		$opcInsert = 1; 
	 	}else{
	 		$opcInsert = 0; 
	 	}
?>
<div id="contDataImputados">
	<div class="row">
		<div class="col-xs-12 col-sm-4  col-md-4">
			<label for="nombre_imputado">Nombre: </label>
			<input id="nombre_imputado" type="text" value="" name="nombre_imputado" placeholder="NOMBRE" maxlength="40" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="return validaInput_litigacion(event, 'varchar')" class="fechas form-control gehit"  />
		</div>
		<div class="col-xs-12 col-sm-4  col-md-4">
			<label for="apellido_paterno">Apellido Paterno: </label>
			<input id="apellido_paterno" type="text" value="" name="apellido_paterno" placeholder="APELLIDO PATERNO" maxlength="50" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="return validaInput_litigacion(event, 'varchar')" class="fechas form-control gehit"  />
		</div>
		<div class="col-xs-12 col-sm-4  col-md-4">
			<label for="apellido_materno">Apellido Materno: </label>
			<input id="apellido_materno" type="text" value="" name="apellido_materno" placeholder="APELLIDO MATERNO" maxlength="50" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="return validaInput_litigacion(event, 'varchar')" class="fechas form-control gehit"  />
		</div>
	</div><br>
	<div class="row">
		<div class="col-xs-12 col-sm-12  col-md-3">
			<label for="edad">Edad:</label>
			<input type="number" class="form-control" value="" id="edad" placeholder="ESPECIFICA LA EDAD" >
		</div>
		<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
			<label for="id_sexo">Sexo</label><br>
				<input type="radio" id="id_sexo" name="id_sexo"  value="M"  >
				<label for="cv_sexo" >Masculino</label>&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" id="id_sexo" name="id_sexo"  value="F"  >
				<label for="cv_sexo" >Femenino</label>
			</div>
	</div>
</div>
	<hr>
	<div class="row">
		<div class="col-xs-12 col-sm-12  col-md-12">
			<table class="table table-bordered">
				<thead>
					<tr class="cabeceraTablaVictimas">
						<th>#</th>
						<th>Nombre</th>
						<th>Apellido Paterno</th>
						<th>Apellido Materno</th>
						<th>Edad</th>
						<th>Sexo</th>
						<th>Acciones</th>
					</tr>
				</thead>
		<?$getData = getDataImputados($conn, $idEstatusNucs);
		  $total_imputados = sizeof($getData);
	 	if(sizeof($getData) > 0){ ?>
				<tbody>
				<?for ($h=0; $h < sizeof($getData) ; $h++) { ?>
					<tr>
						<th><center><?echo $h+1; ?></center></th>
						<th><center><?echo $getData[$h][2]; ?></center></th>
						<th><center><?echo $getData[$h][3]; ?></center></th>
						<th><center><?echo $getData[$h][4]; ?></center></th>
						<th><center><?echo $getData[$h][5]; ?></center></th>
						<th><center><?echo $getData[$h][6]; ?></center></th>
						<td><center><center><img src="img/editarMandamiento2.png" data-toggle="modal" href="#mandamientos"  onclick="edita_imputado(<? echo $getData[$h][0]; ?>)"><img src="img/eliminar.png"  onclick="elimiar_imputado(<?echo $idEstatusNucs ?> , <? echo $getData[$h][0]; ?> , <? echo $total_imputados; ?>);"></center></td>
													</tr>
					</tr>
					<? } ?>
				</tbody>
				<? } ?>
			</table>
		</div>
	</div>
	<br><br><br><br>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<button style="width: 88%;" onclick="closeModalNucsLitigInfo()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button>
		</div>
		<div class="col-xs-12 col-sm-6  col-md-6 ">
			<?if(	$opcInsert == 0 ){ ?>
			<button style="width: 88%;" onclick="sendDataFormImputados(<? echo $nuc; ?>, <? echo $estatus; ?>, <? echo $idMp; ?> , <? echo $mes; ?> , <? echo $anio; ?> , <? echo $deten; ?> , <? echo $idUnidad; ?> ,  <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Aceptar</button>
			<?}elseif(	$opcInsert == 1 ){?>
			<button style="width: 88%;" onclick="insertImputados_nuevo_db(<? echo $idEstatusNucs; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Agregar nuevo imputado</button>
			<? } ?>
		</div>
	</div>

</div>

<div class="modal-footer">
	
</div>




																												
																													
																																																			
																					