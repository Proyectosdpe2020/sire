<?php
include ("../../../Conexiones/conexionMedidas.php");
include ("../../../Conexiones/conexionSicap.php");
include("../../../funcionesMedidasProteccion.php");	

if (isset($_POST["idConstanciaLlamada"])){ $idConstanciaLlamada= $_POST["idConstanciaLlamada"]; }	
if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }	
if (isset($_POST["idMedida"])){ $idMedida = $_POST["idMedida"]; }	

$getDataConstanciaLlamadas = getDataConstanciaLlamadas($connMedidas, $idMedida,1,$idConstanciaLlamada);
$fecha = $getDataConstanciaLlamadas[0][2]->format('Y-m-d H:i');
$observaciones  = $getDataConstanciaLlamadas[0][3];
?>     

       <div class="row">
								<div class="col-xs-12 col-sm-12  col-md-2">
								<button type="button" class="btn btn-primary btn-lg" onclick="updateConstanciaLlamada(<?php echo $idEnlace; ?> , <?echo $idConstanciaLlamada; ?>, <?php echo $idMedida; ?>)">Actualizar información</button>
							 </div>
							</div><br>
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-2">
									<label for="heard">Fecha y hora: <span class="aste">(*)</span></label>
									<input id="dateConstanciaLlamada" type="datetime-local" value="<? echo $fechaev=str_ireplace(' ','T', $fecha); ?>" name="dateConstanciaLlamada" class="fechas form-control gehit" />
								</div>
								<div class="col-xs-12 col-sm-12  col-md-4">
									<label for="obsConstanciaLlamada">Observaciones: <span class="aste">(*)</span></label>
									<input class="form-control mandda gehit" value="<? echo $observaciones; ?>"  id="obsConstanciaLlamada"  type="text">
								</div>
							</div>

