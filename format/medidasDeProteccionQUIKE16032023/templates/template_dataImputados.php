<?php
include ("../../../Conexiones/conexionMedidas.php");
include ("../../../Conexiones/conexionSicap.php");
include("../../../funcionesMedidasProteccion.php");	

if (isset($_POST["idImputado"])){ $idImputado = $_POST["idImputado"]; }	
if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }	
if (isset($_POST["idMedida"])){ $idMedida = $_POST["idMedida"]; }	

$getDataImputados = getDataImputados($connMedidas, 0,1,$idImputado); 
$nombre  = $getDataImputados[0][2];
$paterno  = $getDataImputados[0][3];
$materno  = $getDataImputados[0][4];
$genero  = $getDataImputados[0][5];
$edad  = $getDataImputados[0][6];
?>     

       <div class="row">
								<div class="col-xs-12 col-sm-12  col-md-3">
									<button type="button" class="btn btn-primary btn-lg" onclick="updateImputado(<?php echo $idEnlace; ?> , <?echo $idImputado; ?>, <?php echo $idMedida; ?>)">Actualizar imputado</button>
								</div>
							</div><br>
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-3">
									<label for="nombreImpu">Nombre: <span class="aste">(*)</span></label>
									<input class="form-control mandda gehit" value="<?echo $nombre; ?>"  id="nombreImpu"  type="text">
								</div>
								<div class="col-xs-12 col-sm-12  col-md-3">
									<label for="paternoImpu">Paterno: <span class="aste">(*)</span></label>
									<input class="form-control mandda gehit" value="<?echo $paterno; ?>"  id="paternoImpu"  type="text">
								</div>
								<div class="col-xs-12 col-sm-12  col-md-3">
									<label for="maternoImpu">Materno: <span class="aste">(*)</span></label>
									<input class="form-control mandda gehit" value="<?echo $materno; ?>"  id="maternoImpu"  type="text">
								</div>
								<div class="col-xs-12 col-sm-12  col-md-2">
									<label for="generoImpu">Género: <span class="aste">(*)</span></label>
									<select class="form-control" id="generoImpu" name="generoImpu">
										<option value="0" selected>Seleccione</option>
									 <option class="fontBold" value="1" <?if($genero == 1){ ?> selected <? } ?> >Masculino</option>
									 <option class="fontBold" value="2" <?if($genero == 2){ ?> selected <? } ?> >Femenino</option>
									 <option class="fontBold" value="3" <?if($genero == 3){ ?> selected <? } ?> >Desconocido</option>
									</select>
								</div>
								<div class="col-xs-12 col-sm-12  col-md-1">
									<label for="edadImpu">Edad: <span class="aste">(*)</span></label>
									<select class="form-control" id="edadImpu">
										<option value="">Seleccione</option>
										<option class="fontBold" value="0">Desconocida</option>
										 <?php for ($i=18; $i<=100; $i++){ ?>
										 	<option class="fontBold" value="<?php echo $i;?>" <?if($i == $edad){ ?> selected <? } ?> ><?php echo $i;?> Años</option>
										 <?php } ?>
									</select>
								</div>
							</div>       
