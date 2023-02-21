<?php
include ("../../Conexiones/Conexion.php");
include("../../funcionesEstadoDeFuerza.php");
//Flag 1: Editar y Flag 0 : Agregar nuevo mano
if(isset($_POST['idMando'])){
 $flag = 1; 
	$idMando = $_POST['idMando'];
	$mandos = getDataMandoTable($conn, $idMando, 0);
	$idMando = $mandos[0][0];
 $nombreMando = $mandos[0][1];
 $nombre = $mandos[0][2];
 $paterno = $mandos[0][3];
 $materno = $mandos[0][4];
	$cargo  = $mandos[0][5];
	$funcion  = $mandos[0][6];
	$areadscri  = $mandos[0][7];
	$getIdCargo  = $mandos[0][8];
	$getIdFuncion  = $mandos[0][9];
	$getIdAreadscri  = $mandos[0][10];
	$estatus = $mandos[0][11];
	$sexo = $mandos[0][12];
	$getIdFiscalia = $mandos[0][13];
	$getIdSeccion = $mandos[0][14];
	$comisionado = $mandos[0][15];
	if($mandos[0][16] != ""){ $fechaAlta = $mandos[0][16]->format('Y-m-d'); } else { $fechaAlta = "0000-00-00"; } //Provicional
 if($mandos[0][19] != ""){ $fechaActualAdsc = $mandos[0][19]->format('Y-m-d'); } else { $fechaActualAdsc = "0000-00-00"; } //Provicional
	$nombreFis = $mandos[0][17];
	$nombreAdsc = $mandos[0][18];
	$foto = getDataFoto($conn, $idMando); //Obtenemos el src de la foto
	$srcFoto = $foto[0][1];
}else{
	$flag = 0;
	$idMando = 0;
}
?>

<div class="modal-header" style="background-color:#152F4A;">
	<center><h4  style="font-weight: bold; color: white;" class="modal-title">ACTUALIZACIÓN DE ADSCRIPCION</h4></center>
</div>

<div class="modal-body">

	<!--******************* ADSCRIPCION, FUNCIÓN Y CARGO **********************!-->
				<div class="panel panel-default">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong>CAMBIO DE ADSCRIPCIÓN</strong></h5>

						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4">
							<label for="cambio_fisUnid">Fiscalías, Direcciones o Unidades:<span class="aste">(*)</span></label>
							<select id="cambio_fisUnid" name="cambio_fisUnid" tabindex="6" class="form-control redondear selectTranparent" 
							 onchange="getAreaAdscripcion(2)" required>
								<option value="0">Selecciona</option>
								<?$getFiscalias = getFiscalias($conn);
								for ($i=0; $i < sizeof($getFiscalias); $i++) {
									$idFiscalia = $getFiscalias[$i][0];	$nombre = $getFiscalias[$i][1];	?>
									<option style="color: black; font-weight: bold;" value="<? echo $idFiscalia ?>" <?if($flag == 1 && $idFiscalia == $getIdFiscalia){ ?> selected <? } ?> ><? echo $nombre; ?></option>
									<? } ?>
								</select>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4">
							<label for="cambio_areaAdscripcion">Área de Adscripción:<span class="aste">(*)</span></label>
								<select id="cambio_areaAdscripcion" name="cambio_areaAdscripcion" tabindex="6" class="form-control redondear selectTranparent" <? if($flag == 1){ ?> disabled <? } ?> required>
								<? if($flag == 1){ ?>
									 <option style="color: black; font-weight: bold;" value="<? echo $idAreaAdscripcion; ?>" ><? echo $nombreAdsc; ?></option>
								<? } ?>
							</select>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-4">
								<label for="cambio_seccion">Sección:<span class="aste">(*)</span></label>
								<select id="cambio_seccion" name="cambio_seccion" tabindex="6" class="form-control redondear selectTranparent" required>
									<option value="0">Selecciona</option>
									<?$getAreaAdscripcion = getareaAdscripcion($conn);
									for ($i=0; $i < sizeof($getAreaAdscripcion); $i++) {
										$idAreaAdscripcion = $getAreaAdscripcion[$i][0];	$nombre = $getAreaAdscripcion[$i][1];	?>
										<option style="color: black; font-weight: bold;" value="<? echo $idAreaAdscripcion; ?>" <?if($flag == 1 && $idAreaAdscripcion == $getIdAreadscri){ ?> selected <? } ?> ><? echo $nombre; ?></option>
										<? } ?>
									</select>
								</div>
					</div><br><br>

					<div class="row">
						<div class="col-xs-12 col-sm-4  col-md-4">
							<label for="heard">Fecha de cambio de adscripciòn :</label><span class="aste">(*)</span>
							<input id="fechaCambioAdscrip" type="date" value="<?if($flag == 1){ echo $fechaActualAdsc; } ?>" name="fechaCambioAdscrip" class="fechas form-control gehit"  />
						</div>
						<div class="col-xs-12 col-sm-4 col-md-4">
							<label for="cambio_estatusMando">Estatus:<span class="aste">(*)</span></label>
							<select id="cambio_estatusMando" name="cambio_estatusMando" tabindex="6" class="form-control redondear selectTranparent" required>
								<option value="0">Selecciona</option>
								<option style="color: black; font-weight: bold;" value="VI" <?if($estatus == 'Activo'){ ?> selected <? } ?> >Activo</option>
								<option style="color: black; font-weight: bold;" value="BA" <?if($estatus == 'Inactivo'){ ?> selected <? } ?> >Inactivo</option>
							</select>
						</div>
					</div><br>

				</div>
			</div>
</div><br><br>

<div class="modal-footer">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="closeModalAdscripciones()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button></center></div>
		<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="saveDbAdscripcion(<? echo $idMando; ?> , <? echo $flag; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button></center></div>
	</div>
</div>


