<?php
				include("../../Conexiones/Conexion.php");
				include("../../funcionesPueDispo.php");
				include("../../sqlPersonas.php");
			
	?>


 
	<div class="modal-header" style="background-color:#152F4A;">
		<center><label style=" color: white; font-weight: bold; font-size: 2rem;">AGREGAR NUEVO MANDO</label></center>
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
										<label for="addNombreMando">Nombre:<span class="aste">(*)</span></label>
											<input value="" type="text" style="text-transform:uppercase;" class="form-control" id="addNombreMando" name="addNombreMando" onkeyup="javascript:this.value=this.value.toUpperCase();">
								</div>
								<div class="col-xs-4">
									 <label for="addApPaterno">Apellido Paterno:<span class="aste">(*)</span></label>
											<input value="" type="text" style="text-transform:uppercase;" class="form-control" id="addApPaterno" name="addApPaterno" 
											onkeyup="javascript:this.value=this.value.toUpperCase();">
								</div>
								<div class="col-xs-4">
									<label for="addApMaterno">Apellido Materno:<span class="aste">(*)</span></label>
											<input value="" type="text" style="text-transform:uppercase;" class="form-control" id="addApMaterno" name="addApMaterno" 
											onkeyup="javascript:this.value=this.value.toUpperCase();">
								</div>
							</div><br><br>

							<div class="row">
								<div class="col-xs-4">
										<label for="addCargo">Cargo:<span class="aste">(*)</span></label>
											<select id="addCargo" name="addCargo" tabindex="6" class="form-control redondear selectTranparent" required>
											<option value="0">Selecciona</option>
											<?
											$getCargo = getCargo($conn);
											for ($i=0; $i < sizeof($getCargo); $i++) {
												$idCargo = $getCargo[$i][0];	$nombre = $getCargo[$i][1];	?>
												<option style="color: black; font-weight: bold;" value="<? echo $idCargo; ?>" ><? echo $nombre; ?></option>
											<? } ?>
											</select>
								</div>
								<div class="col-xs-4">
									 <label for="addFuncion">Función:<span class="aste">(*)</span></label>
											<select id="addFuncion" name="addFuncion" tabindex="6" class="form-control redondear selectTranparent" required>
											<option value="0">Selecciona</option>
											<?
											$getFuncion = getFuncion($conn);
											for ($i=0; $i < sizeof($getFuncion ); $i++) {
												$idFuncion = $getFuncion [$i][0];	$nombre = $getFuncion [$i][1];	?>
												<option style="color: black; font-weight: bold;" value="<? echo $idFuncion; ?>" ><? echo $nombre; ?></option>
											<? } ?>
											</select>
								</div>
								<div class="col-xs-4">
									<label for="addAreaAdscripcion">Área de Adscripción:<span class="aste">(*)</span></label>
											<select id="addAreaAdscripcion" name="addAreaAdscripcion" tabindex="6" class="form-control redondear selectTranparent" required>
											<option value="0">Selecciona</option>
											<?
											$getAreaAdscripcion = getareaAdscripcion($conn);
											for ($i=0; $i < sizeof($getAreaAdscripcion); $i++) {
												$idAreaAdscripcion = $getAreaAdscripcion[$i][0];	$nombre = $getAreaAdscripcion[$i][1];	?>
												<option style="color: black; font-weight: bold;" value="<? echo $idAreaAdscripcion; ?>" ><? echo $nombre; ?></option>
											<? } ?>
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
	<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="closeModalModuloAdm()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button></center></div>
	<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="agregarMando()" type="button" class="btn btn-primary redondear" >Guardar</button></center></div>
</div>
<br>