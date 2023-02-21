<?
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
	$nombreFis = $mandos[0][17];
	$nombreAdsc = $mandos[0][18];
	if($mandos[0][19] != ""){ $fechaActualAdsc = $mandos[0][19]->format('Y-m-d'); } else { $fechaActualAdsc = "0000-00-00"; } //Provicional
	$observaciones = $mandos[0][20];
	$foto = getDataFoto($conn, $idMando); //Obtenemos el src de la foto
	$srcFoto = $foto[0][1];
}else{
	$flag = 0;
	$idMando = 0;
}
?>

<div class="modal-header" style="background-color:#152F4A;">
	<center><label style=" color: white; font-weight: bold; font-size: 2rem;">ACTUALIZAR INFORMACIÓN </label></center>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-group panelunoDisposicdo" >
	<div class="row"  style="padding: 1px;">
		<div class="row" style="padding: 20px;"><!-- ROOWWWWWW PRINCIPAL --> 
			<form onsubmit="return false" action="return false">

					<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6">
									<div class="col-xs-12 col-sm-12 col-md-6"><sapn class="reporte btn btn-default glyphicon glyphicon-download" onclick="descargarReporteCompleto(<? echo $idMando; ?>)">Descargar Reporte</span></div>
							</div>
						</div><br><br>

					<!--******************* DATOS GENERALES**********************!-->
				<div class="panel panel-default">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong> DATOS GENERALES </strong></h5>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 centerUploadImg">
								<img id="imgMando" <?if($flag == 1){ ?>src="format/estadoDeFuerza/inserts/fotografias/<? echo $srcFoto; ?>"<? }else{ ?>src="format/estadoDeFuerza/inserts/fotografias/upload_img.png"<? } ?> alt="Tu imagen" />
							</div>
						</div><br><br>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 centerUploadImg">
								<span class="btn btn-default btn-file glyphicon glyphicon-upload"> CARGAR FOTOGRAFIA <input type="file" id="file" name="file"></span>						  
							</div>
						</div><br>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 centerUploadImg">
								<progress value="0" max="100" class="progress" id="progreso">0%</progress>
								<label for="" id="etiqueta"> 0%</label>
								<?if($flag == 1 && $srcFoto != "upload_img.png"){?>
								<span onclick="deleteFoto(<? echo $idMando; ?>, <? echo $foto[0][0]; ?>, '<? echo $srcFoto; ?>')" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span>	<? } ?>			  
							</div>
						</div><br><br>
						<div class="row">
							<div class="col-xs-12 col-sm-3 col-md-3">
								<label for="nombre">Nombre:<span class="aste">(*)</span></label>
								<input value="<?if($flag == 1){ echo $nombre; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="nombre" name="nombre" onkeyup="javascript:this.value=this.value.toUpperCase();">
							</div>
							<div class="col-xs-12 col-sm-3 col-md-3">
								<label for="ap_paterno">Apellido Paterno:<span class="aste">(*)</span></label>
								<input value="<?if($flag == 1){ echo $paterno; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="ap_paterno" name="ap_paterno" onkeyup="javascript:this.value=this.value.toUpperCase();">
							</div>
							<div class="col-xs-12 col-sm-3 col-md-3">
								<label for="ap_materno">Apellido Materno:<span class="aste">(*)</span></label>
								<input value="<?if($flag == 1){ echo $materno; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="ap_materno" name="ap_materno" onkeyup="javascript:this.value=this.value.toUpperCase();">
							</div>
							<div class="col-xs-12 col-sm-3 col-md-3">
								<label for="sexo">Sexo:<span class="aste">(*)</span></label><br>
								<label class="radio-inline">
									<input type="radio" name="sexo" value="1" <? if($flag == 1 && $sexo == 1){ ?> checked <? } ?> > Hombre
								</label>
								<label class="radio-inline">
									<input type="radio" name="sexo" value="2" <? if($flag == 1 && $sexo == 2){ ?> checked <? } ?> > Mujer
								</label>
							</div>
						</div><br>
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4">
							 <label for="cargo">Cargo:<span class="aste">(*)</span></label>
									<select id="cargo" name="cargo" tabindex="6" class="form-control redondear selectTranparent" required>
										<option value="0">Selecciona</option>
										<?$getCargo = getCargo($conn);
										for ($i=0; $i < sizeof($getCargo); $i++) {
											$idCargo = $getCargo[$i][0];	$nombre = $getCargo[$i][1];	?>
											<option style="color: black; font-weight: bold;" value="<? echo $idCargo; ?>" <?if($flag == 1 && $idCargo == $getIdCargo){ ?> selected <? } ?> ><? echo $nombre; ?> </option>
											<? } ?>
									</select>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<label for="funcion">Función:<span class="aste">(*)</span></label>
									<select id="funcion" name="funcion" tabindex="6" class="form-control redondear selectTranparent" required>
										<option value="0">Selecciona</option>
										<?$getFuncion = getFuncion($conn);
										for ($i=0; $i < sizeof($getFuncion ); $i++) {
											$idFuncion = $getFuncion [$i][0];	$nombre = $getFuncion [$i][1];	?>
											<option style="color: black; font-weight: bold;" value="<? echo $idFuncion; ?>" <?if($flag == 1 && $idFuncion == $getIdFuncion){ ?> selected <? } ?> ><? echo $nombre; ?></option>
										<? } ?>
									</select>
								</div>
							 <div class="col-xs-12 col-sm-3 col-md-3">
							 	<label for="heard">Fecha de alta :</label><span class="aste"> *¨</span>
							 	<input id="fechaAlta" type="date" value="<?if($flag == 1){ echo $fechaAlta; } ?>" name="fechaAlta" class="fechas form-control gehit" <? if($flag == 1){ ?> disabled <? } ?> />
							 </div>
						</div>

						<hr>
						<div class="row">
							<div class="col-xs-12 col-sm-3 col-md-3">
								<label for="fisUnid">Fiscalías, Direcciones o Unidades: <span class="aste">(*)</span></label>
								<select id="fisUnid" name="fisUnid" tabindex="6" class="form-control redondear selectTranparent" onchange="getAreaAdscripcion(1)" <? if($flag == 1){ ?> disabled <? } ?> required>
									<option value="0">Selecciona</option>
									<?$getFiscalias = getFiscalias($conn);
									for ($i=0; $i < sizeof($getFiscalias); $i++) {
									$idFiscalia = $getFiscalias[$i][0];	$nombre = $getFiscalias[$i][1];	?>
									<option style="color: black; font-weight: bold;" value="<? echo $idFiscalia ?>" <?if($flag == 1 && $idFiscalia == $getIdFiscalia){ ?> selected <? } ?> ><? echo $nombre; ?></option>
								<? } ?>
							</select>
						</div>
						<div class="col-xs-12 col-sm-3 col-md-3">
							<label for="areaAdscripcion">Área de Adscripción:<span class="aste">(*)</span></label>
							<select id="areaAdscripcion" name="areaAdscripcion" tabindex="6" class="form-control redondear selectTranparent" <? if($flag == 1){ ?> disabled <? } ?> required>
								<? if($flag == 1){ ?>
									 <option style="color: black; font-weight: bold;" value="<? echo $getIdAreadscri ; ?>" ><? echo $nombreAdsc; ?></option>
								<? } ?>
							</select>
						</div>
						<div class="col-xs-12 col-sm-3 col-md-3">
							<label for="seccion">Sección:<span class="aste">(*)</span></label>
								<select id="seccion" name="seccion" tabindex="6" class="form-control redondear selectTranparent" <? if($flag == 1){ ?> disabled <? } ?> required>
									<option value="0">Selecciona</option>
									<?$getAreaAdscripcion = getareaAdscripcion($conn);
									for ($i=0; $i < sizeof($getAreaAdscripcion); $i++) {
										$idAreaAdscripcion = $getAreaAdscripcion[$i][0];	$nombre = $getAreaAdscripcion[$i][1];	?>
										<option style="color: black; font-weight: bold;" value="<? echo $idAreaAdscripcion; ?>" <?if($flag == 1 && $idAreaAdscripcion == $getIdSeccion){ ?> selected <? } ?> ><? echo $nombre; ?></option>
										<? } ?>
									</select>
							</div>
							<div class="col-xs-12 col-sm-3 col-md-3">
									<label for="heard">Fecha de actual adscripción :</label><span class="aste"> *¨</span>
									<input id="fechaActualAdsc" type="date" value="<?if($flag == 1){ echo $fechaActualAdsc; } ?>" name="fechaActualAdsc" class="fechas form-control gehit" 
									<? if($flag == 1){ ?> disabled <? } ?> />
							</div>
					</div><br>

							<div class="row" style="text-align: right;">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="chekCom"><br>
										<input type="checkbox" id="comisionado" name="comisionado" value="1" <?if($flag == 1 && $comisionado == 1){?> checked <? } ?> >
										<label for="comisionado"><span></span>Comisionado</label>
									</div>
								</div>
							</div>

					</div>
				</div><br>
				<?
					$dataValidaDir = dataValidaDir($conn, $idMando);
					$dataValidaCtoEmer = dataValidaCtoEmer($conn, $idMando);
					$dataValidaFolio = dataValidaFolio($conn, $idMando);
				?>

				<div class="row">
					<?if($dataValidaDir != 1){?>
					<div class="col-xs-12 col-sm-3 col-md-3 btnModal">
						<button type="button" class="btn btn-success btn-lg btn-block" onclick="showModalDireccion(<? echo $idMando; ?>, 0)">DIRECCIÓN</button>
					</div><? } ?>
					<div class="col-xs-12 col-sm-3 col-md-3 btnModal">
						<button type="button" class="btn btn-success btn-lg btn-block" onclick="showModalVehiculos(<? echo $idMando; ?>, 0)">VEHICULOS</button>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 btnModal">
						<button type="button" class="btn btn-success btn-lg btn-block" onclick="showModalArmas(<? echo $idMando; ?>, 0)">ARMAS</button>
					</div>
					<?if($dataValidaCtoEmer != 1){?>
					<div class="col-xs-12 col-sm-3 col-md-3 btnModal">
						<button type="button" class="btn btn-success btn-lg btn-block" onclick="showModalContactoEmergencia(<? echo $idMando; ?>, 0)">CONTACTO EMERGENCIA</button>
					</div><? } ?>
					<?if($dataValidaFolio != 1){?>
					<div class="col-xs-12 col-sm-3 col-md-3 btnModal">
						<button type="button" class="btn btn-success btn-lg btn-block" onclick="showModalFolios(<? echo $idMando; ?>, 0)">FOLIOS</button>
					</div><? } ?>
					<?if($flag == 1){?>
					<div class="col-xs-12 col-sm-3 col-md-3 btnModal">
						<button type="button" class="btn btn-success btn-lg btn-block" onclick="showModalAdscripciones(<? echo $idMando; ?>)">CAMBIO DE ADSCRIPCIÓN</button>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 btnModal">
						<button type="button" class="btn btn-success btn-lg btn-block" onclick="showModalIncapacidad(<? echo $idMando; ?>, 0)">INCAPACIDADES</button>
					</div>
				<? } ?>
				</div><br><br>

	<!--******************* INICIA TABLA DE DATOS **********************!-->
				<div class="row" style=" background-color: #EAEAEA;">

					<?if($idMando != 0){ 

					$getDataDireccion = getDataDireccion($conn, $idMando, 0); //Envia 0 para consulta de todos los items de ese mando
					if(sizeof($getDataDireccion) > 0){ ?>
					<div id="domicilioInf">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<center><label style="font-weight: bold; color:#3b2f2f ; font-size: 2rem;">Domicilio</label></center>
							<div class="row" style="padding: 20px;">
								<table class="table tablaEstadoFuerza">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">Domicilio</th>
											<th scope="col">Lugar de origen</th>
											<th scope="col"><center>Ciudad</center></th>
											<th scope="col"><center>Estado / Provincia</center></th>
											<th scope="col"><center>Codigo postal</center></th>
											<th scope="col"><center>Teléfono</center></th>
											<th scope="col"><center>Acciones</center></th>
											<th scope="col"><center>Acciones</center></th>
										</tr>
									</thead>
									<tbody>
									<?for ($h=0; $h < sizeof($getDataDireccion) ; $h++){?> 																																										
										<tr>
											<td><? echo $h+1; ?></td>
											<td><? echo $getDataDireccion[$h][2]; ?></td>
											<td><? echo $getDataDireccion[$h][3]; ?></td>
											<td><? echo $getDataDireccion[$h][4]; ?></td>
											<td><? echo $getDataDireccion[$h][5]; ?></td>
											<td><? echo $getDataDireccion[$h][6]; ?></td>
											<td><? echo $getDataDireccion[$h][7]; ?></td>
											<td><center><span onclick="deleteItemData(1, <? echo $getDataDireccion [$h][0]; ?>, <? echo $idMando; ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span></center></td>
											<td> <center><span onclick="showModalDireccion(<? echo $idMando; ?>, <? echo $getDataDireccion[$h][0]; ?>)" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center> </td>
										</tr>
									<? } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				<? } ?>

				<?$getDataVehiculo = getDataVehiculos($conn, $idMando, 0); //Envia 0 para consulta de todos los items de ese mando
					if(sizeof($getDataVehiculo) > 0){ ?>
					<div id="domicilioInf">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<center><label style="font-weight: bold; color:#3b2f2f ; font-size: 2rem;">Vehiculos a dispocisión</label></center>
							<div class="row" style="padding: 20px;">
								<table class="table tablaEstadoFuerza">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col"><center>Marca</center></th>
											<th scope="col"><center>Modelo</center></th>
											<th scope="col"><center>Placas</center></th>
											<th scope="col"><center>Vehiculo Actual</center></th>
											<th scope="col"><center>Acciones</center></th>
											<th scope="col"><center>Acciones</center></th>
										</tr>
									</thead>
									<tbody>
									<?for ($h=0; $h < sizeof($getDataVehiculo) ; $h++){?> 																																										
										<tr>
											<td><? echo $h+1; ?></td>
											<td><center><? echo $getDataVehiculo[$h][2]; ?></center></td>
											<td><center><? echo $getDataVehiculo[$h][3]; ?></center></td>
											<td><center><? echo $getDataVehiculo[$h][4]; ?></center></td>
											<td><center>Si</center></td>
											<td><center><span onclick="deleteItemData(2, <? echo $getDataVehiculo[$h][0]; ?>, <? echo $idMando; ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span></center></td>
											<td><center><span onclick="showModalVehiculos(<? echo $idMando; ?>, <? echo $getDataVehiculo[$h][0]; ?>)" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center></td>
										</tr>
									<? } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				<? } ?>

				<?$getDataArmas = getDataArmas($conn, $idMando, 0); //Envia 0 para consulta de todos los items de ese mando
					if(sizeof($getDataArmas) > 0){ ?>
					<div id="domicilioInf">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<center><label style="font-weight: bold; color:#3b2f2f ; font-size: 2rem;">Posesión de armas</label></center>
							<div class="row" style="padding: 20px;">
								<table class="table tablaEstadoFuerza">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col"><center>Marca</center></th>
											<th scope="col"><center>Modelo</center></th>
											<th scope="col"><center>Matricula</center></th>
											<th scope="col"><center>Calibre</center></th>
											<th scope="col"><center>Folio</center></th>
											<th scope="col"><center>Catégoria</center></th>
											<th scope="col"><center>Acciones</center></th>
											<th scope="col"><center>Acciones</center></th>
										</tr>
									</thead>
									<tbody>
									<?for ($h=0; $h < sizeof($getDataArmas) ; $h++){?> 																																										
										<tr>
											<td><? echo $h+1; ?></td>
											<td><center><? echo $getDataArmas[$h][3]; ?></center></td>
											<td><center><? echo $getDataArmas[$h][4]; ?></center></td>
											<td><center><? echo $getDataArmas[$h][5]; ?></center></td>
											<td><center><? echo $getDataArmas[$h][6]; ?></center></td>
											<td><center><? echo $getDataArmas[$h][7]; ?></center></td>
											<td><center><? echo $getDataArmas[$h][8]; ?></center></td>
											<td><center><span onclick="deleteItemData(3, <? echo $getDataArmas[$h][0]; ?>, <? echo $idMando; ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span></center></td>
											<td><center><span onclick="showModalArmas(<? echo $idMando; ?>, <? echo $getDataArmas[$h][0]; ?>)" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center></td>
										</tr>
									<? } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				<? } ?>

					<?$getDataContEmerg = getDataContEmerg($conn, $idMando, 0); //Envia 0 para consulta de todos los items de ese mando
					if(sizeof($getDataContEmerg) > 0){ ?>
					<div id="domicilioInf">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<center><label style="font-weight: bold; color:#3b2f2f ; font-size: 2rem;">Contacto de emergencia</label></center>
							<div class="row" style="padding: 20px;">
								<table class="table tablaEstadoFuerza">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col"><center>Nombre</center></th>
											<th scope="col"><center>Parentesco</center></th>
											<th scope="col"><center>Teléfono</center></th>
											<th scope="col"><center>Dirección</center></th>
											<th scope="col"><center>Ciudad / Estado</center></th>
											<th scope="col"><center>Acciones</center></th>
											<th scope="col"><center>Acciones</center></th>
										</tr>
									</thead>
									<tbody>
									<?for ($h=0; $h < sizeof($getDataContEmerg) ; $h++){?> 																																										
										<tr>
											<td><? echo $h+1; ?></td>
											<td><center><? echo $getDataContEmerg[$h][2]; ?></center></td>
											<td><center><? echo $getDataContEmerg[$h][3]; ?></center></td>
											<td><center><? echo $getDataContEmerg[$h][4]; ?></center></td>
											<td><center><? echo $getDataContEmerg[$h][5]; ?></center></td>
											<td><center><? echo $getDataContEmerg[$h][6]; ?></center></td>
											<td><center><span onclick="deleteItemData(4, <? echo $getDataContEmerg[$h][0]; ?>, <? echo $idMando; ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span></center></td>
											<td><center><span onclick="showModalContactoEmergencia(<? echo $idMando; ?>, <? echo $getDataContEmerg[$h][0]; ?>)" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center></td>
										</tr>
									<? } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				<? } ?>

				<?$getDataFolios = getDataFolios($conn, $idMando, 0); //Envia 0 para consulta de todos los items de ese mando
					if(sizeof($getDataFolios) > 0){ ?>
					<div id="domicilioInf">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<center><label style="font-weight: bold; color:#3b2f2f ; font-size: 2rem;">Folios</label></center>
							<div class="row" style="padding: 20px;">
								<table class="table tablaEstadoFuerza">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col"><center>Seguro social</center></th>
											<th scope="col"><center>CURP</center></th>
											<th scope="col"><center>CUIP</center></th>
											<th scope="col"><center>Folio credencial</center></th>
											<th scope="col"><center>CUP</center></th>
											<th scope="col"><center>Acciones</center></th>
											<th scope="col"><center>Acciones</center></th>
										</tr>
									</thead>
									<tbody>
									<?for ($h=0; $h < sizeof($getDataFolios) ; $h++){?> 																																										
										<tr>
											<td><? echo $h+1; ?></td>
											<td><center><? echo $getDataFolios[$h][2]; ?></center></td>
											<td><center><? echo $getDataFolios[$h][3]; ?></center></td>
											<td><center><? echo $getDataFolios[$h][4]; ?></center></td>
											<td><center><? echo $getDataFolios[$h][5]; ?></center></td>
											<td><center><? echo $getDataFolios[$h][6]; ?></center></td>
											<td><center><span onclick="deleteItemData(5, <? echo $getDataFolios[$h][0]; ?>, <? echo $idMando; ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span></center></td>
											<td><center><span onclick="showModalFolios(<? echo $idMando; ?>, <? echo $getDataFolios[$h][0]; ?>)" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center></td>
										</tr>
									<? } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				<? } ?>

					<?$getDataIncapacidad = getDataIncapacidad($conn, $idMando, 0); //Envia 0 para consulta de todos los items de ese mando
					if(sizeof($getDataIncapacidad) > 0){ ?>
					<div id="domicilioInf">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<center><label style="font-weight: bold; color:#3b2f2f ; font-size: 2rem;">Incapacidades solicitadas</label></center>
							<div class="row" style="padding: 20px;">
								<table class="table tablaEstadoFuerza">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col"><center>Fecha de inicio</center></th>
											<th scope="col"><center>Fecha de fin</center></th>
											<th scope="col"><center>Motivo</center></th>
											<th scope="col"><center>Acciones</center></th>
											<th scope="col"><center>Acciones</center></th>
										</tr>
									</thead>
									<tbody>
									<?for ($h=0; $h < sizeof($getDataIncapacidad) ; $h++){?> 																																										
										<tr>
											<td><? echo $h+1; ?></td>
											<td><center><? echo $getDataIncapacidad[$h][2]; ?></center></td>
											<td><center><? echo $getDataIncapacidad[$h][3]; ?></center></td>
											<td><center><? echo $getDataIncapacidad[$h][4]; ?></center></td>
											<td><center><span onclick="deleteItemData(6, <? echo $getDataIncapacidad[$h][0]; ?>, <? echo $idMando; ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span></center></td>
											<td><center><span onclick="showModalIncapacidad(<? echo $idMando; ?>, <? echo $getDataIncapacidad[$h][0]; ?>)" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center></td>
										</tr>
									<? } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				<? } ?>

				<?$getDataHistoAdscrip = getDataHistorialAdscripcion($conn, $idMando); 
					if(sizeof($getDataHistoAdscrip) > 0){ ?>
					<div id="domicilioInf">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<center><label style="font-weight: bold; color:#3b2f2f ; font-size: 2rem;">Historial de adscripciones</label></center>
							<div class="row" style="padding: 20px;">
								<table class="table tablaEstadoFuerza">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col"><center>Fiscalía </center></th>
											<th scope="col"><center>Adscripción</center></th>
											<th scope="col"><center>fecha de adscripción</center></th>
											<th scope="col"><center>¿Actual adscripción?</center></th>
											<th scope="col"><center>Acciones</center></th>
										</tr>
									</thead>
									<tbody>
									<?for ($h=0; $h < sizeof($getDataHistoAdscrip) ; $h++){?> 																																										
										<tr>
											<td><? echo $h+1; ?></td>
											<td><center><? echo $getDataHistoAdscrip[$h][2]; ?></center></td>
											<td><center><? echo $getDataHistoAdscrip[$h][6]; ?></center></td>
											<td><center><? echo $getDataHistoAdscrip[$h][7]; ?></center></td>
											<td><center><?if($h == 0){ if(sizeof($getDataHistoAdscrip) == 1){ ?><span class="glyphicon glyphicon glyphicon-ok"></span> <button type="button" class="btn btn-link" onclick="generarFormatoPrimerAdscrip(<? echo $idMando; ?>)">Formato Asigna Adscripción</button> <? }else{?>
												<span class="glyphicon glyphicon glyphicon-ok"></span> <button type="button" class="btn btn-link" onclick="generarFormatoAdscripcion(<? echo $idMando; ?>)">Formato cambio de adscripción</button> <? } }else{ ?> <span class="glyphicon glyphicon-minus-sign"></span>  <? } ?></center></td>
											<td><center><?if($h != 0){ ?><span onclick="deleteItemData(7, <? echo $getDataHistoAdscrip[$h][0]; ?>, <? echo $idMando; ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span><? } ?></center></td>
										</tr>
									<? } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				<? } ?>


		 <?	} ?>

				</div><br><br>
				<!--******************* TERMINA TABLA DE DATOS **********************!-->
																								
				<!--******************* OBSERVACIONES **********************!-->
				<div class="panel panel-default">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong>OBSERVACIONES</strong></h5>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
								<textarea class="form-control" rows="4" id="observacionesMando" name="observacionesMando"><?if($flag == 1){ echo $observaciones; } ?></textarea>
							</div>
						</div>
					</div>
				</div><br>


						

						</div><!-- ROOWWWWWW PRINCIPAL --> 
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="closeModalEstadoDeFuerza()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button></center></div>
	<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="saveDataMando(<? echo $idMando; ?> , <? echo $flag; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button></center></div>
</div>
<br>

<script type="text/javascript">
  $("#file").change(function () {
    readImage(this);
  });
</script>