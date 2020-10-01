<?php
				include("../../Conexiones/Conexion.php");
				include("../../funcionesPueDispo.php");
				include("../../sqlPersonas.php");
				$fecha_actual=date("Y-m-d");
				$fecha=strftime( "%Y-%m-%d %H:%M:%S", time() );

				if (isset($_POST["idMando"])){ $idMando = $_POST["idMando"]; }

				$mandos = getDataMandoTableAdm($conn, $idMando, 0);
    
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
	?>


 
	<div class="modal-header" style="background-color:#152F4A;">
		<center><label style=" color: white; font-weight: bold; font-size: 2rem;">ACTUALIZACION DE MANDO</label></center>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12 form-group panelunoDisposicdo" >
		<div class="row"  style="padding: 1px;">
			<div class="row" style="padding: 20px;"><!-- ROOWWWWWW PRINCIPAL --> 
				<form onsubmit="return false" action="return false">
					<div class="panel panel-default">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Datos generales </strong></h5>
							
							<div class="row">
								<div class="col-xs-4">
										<label for="admNombreMando">Nombre:<span class="aste">(*)</span></label>
											<input value="<? echo $nombre; ?>" type="text" style="text-transform:uppercase;" class="form-control" id="admNombreMando" name="admNombreMando" onkeyup="javascript:this.value=this.value.toUpperCase();">
								</div>
								<div class="col-xs-4">
									 <label for="admApPaterno">Apellido Paterno:<span class="aste">(*)</span></label>
											<input value="<? echo $paterno; ?>" type="text" style="text-transform:uppercase;" class="form-control" id="admApPaterno" name="admApPaterno" 
											onkeyup="javascript:this.value=this.value.toUpperCase();">
								</div>
								<div class="col-xs-4">
									<label for="admApMaterno">Apellido Materno:<span class="aste">(*)</span></label>
											<input value="<? echo $materno; ?>" type="text" style="text-transform:uppercase;" class="form-control" id="admApMaterno" name="admApMaterno" 
											onkeyup="javascript:this.value=this.value.toUpperCase();">
								</div>
							</div><br><br>

							<div class="row">
								<div class="col-xs-4">
										<label for="admCargo">Cargo:<span class="aste">(*)</span></label>
											<select id="admCargo" name="admCargo" tabindex="6" class="form-control redondear selectTranparent" required>
											<option value="0">Selecciona</option>
											<?
											$getCargo = getCargo($conn);
											for ($i=0; $i < sizeof($getCargo); $i++) {
												$idCargo = $getCargo[$i][0];	$nombre = $getCargo[$i][1];	?>
												<option style="color: black; font-weight: bold;" value="<? echo $idCargo; ?>" <?if($idCargo == $getIdCargo){ ?> selected <? } ?> ><? echo $nombre; ?></option>
											<? } ?>
											</select>
								</div>
								<div class="col-xs-4">
									 <label for="admFuncion">Función:<span class="aste">(*)</span></label>
											<select id="admFuncion" name="admFuncion" tabindex="6" class="form-control redondear selectTranparent" required>
											<option value="0">Selecciona</option>
											<?
											$getFuncion = getFuncion($conn);
											for ($i=0; $i < sizeof($getFuncion ); $i++) {
												$idFuncion = $getFuncion [$i][0];	$nombre = $getFuncion [$i][1];	?>
												<option style="color: black; font-weight: bold;" value="<? echo $idFuncion; ?>" <?if($idFuncion == $getIdFuncion){ ?> selected <? } ?> ><? echo $nombre; ?></option>
											<? } ?>
											</select>
								</div>
								<div class="col-xs-4">
									<label for="admAreaAdscripcion">Área de Adscripción:<span class="aste">(*)</span></label>
											<select id="admAreaAdscripcion" name="admAreaAdscripcion" tabindex="6" class="form-control redondear selectTranparent" required>
											<option value="0">Selecciona</option>
											<?
											$getAreaAdscripcion = getareaAdscripcion($conn);
											for ($i=0; $i < sizeof($getAreaAdscripcion); $i++) {
												$idAreaAdscripcion = $getAreaAdscripcion[$i][0];	$nombre = $getAreaAdscripcion[$i][1];	?>
												<option style="color: black; font-weight: bold;" value="<? echo $idAreaAdscripcion; ?>" <?if($idAreaAdscripcion == $getIdAreadscri){ ?> selected <? } ?> ><? echo $nombre; ?></option>
											<? } ?>
											</select>
								</div>
							</div><br><br>
							<div class="row">
								<div class="col-xs-4">
									<label for="admEstatusMando">Estatus:<span class="aste">(*)</span></label>
											<select id="admEstatusMando" name="admEstatusMando" tabindex="6" class="form-control redondear selectTranparent" required>
											<option value="0">Selecciona</option>
												<option style="color: black; font-weight: bold;" value="VI" <?if($estatus == 'Activo'){ ?> selected <? } ?> >Activo</option>
												<option style="color: black; font-weight: bold;" value="BA" <?if($estatus == 'Inactivo'){ ?> selected <? } ?> >Inactivo</option>
											</select>
								</div>
							</div>

						</div>
					</div>
					<div id="respuesta"></div>
				</div><!-- ROOWWWWWW PRINCIPAL --> 
			</form>
		</div>
	</div>
</div>
</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="closeModalEditarMando()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button></center></div>
	<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="actualizarMandos(<? echo $idMando; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button></center></div>
</div>
<br>