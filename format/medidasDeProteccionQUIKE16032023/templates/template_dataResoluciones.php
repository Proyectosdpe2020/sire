<?php
include ("../../../Conexiones/conexionMedidas.php");
include ("../../../Conexiones/conexionSicap.php");
include("../../../funcionesMedidasProteccion.php");	

if (isset($_POST["idResolucion"])){ $idResolucion = $_POST["idResolucion"]; }	
if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }	
if (isset($_POST["idMedida"])){ $idMedida = $_POST["idMedida"]; }	

$getDataResolucion = getDataResoluciones($connMedidas, 0,1,$idResolucion); 
$ratifica  = $getDataResolucion[0][2];
$modifica  = $getDataResolucion[0][3];
$ratificacionObs  = $getDataResolucion[0][4];
$modificaObs  = $getDataResolucion[0][5];

?>     

       <div class="row">
								<div class="col-xs-12 col-sm-12  col-md-2">
									<button type="button" class="btn btn-primary btn-lg" onclick="updateResolucion(<?php echo $idEnlace; ?> , <?echo $idResolucion; ?>, <?php echo $idMedida; ?>)">Actualizar información</button>
								</div>
							</div><br>
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-2">
									<label for="ratificacion">Ratificación: <span class="aste">(*)</span></label>
									<select class="form-control" id="ratificacion">
										 <option value="">Seleccione</option>
									  <option class="fontBold" value="1" <?if($ratifica == 'Si'){ ?> selected <? } ?> >Si</option>
									  <option class="fontBold" value="0" <?if($ratifica == 'No'){ ?> selected <? } ?> >No</option>
									</select>
								</div>
								<div class="col-xs-12 col-sm-12  col-md-4">
									<label for="observacionRatifica">Observación: <span class="aste">(*)</span></label>
									<input class="form-control mandda gehit" value="<?echo $ratificacionObs; ?>"  id="observacionRatifica"  type="text">
								</div>
								<div class="col-xs-12 col-sm-12  col-md-2">
									<label for="modifica">Modificada: <span class="aste">(*)</span></label>
									<select class="form-control" id="modifica">
										 <option value="">Seleccione</option>
									  <option class="fontBold" value="1" <?if($modifica == 'Si'){ ?> selected <? } ?> >Si</option>
									  <option class="fontBold" value="0" <?if($modifica == 'No'){ ?> selected <? } ?> >No</option>
									</select>
								</div>
								<div class="col-xs-12 col-sm-12  col-md-4">
									<label for="observacionModifica">Observación: <span class="aste">(*)</span></label>
									<input class="form-control mandda gehit" value="<?echo $modificaObs; ?>"  id="observacionModifica"  type="text">
								</div>
							</div>

