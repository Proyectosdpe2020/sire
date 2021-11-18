<?php
include ("../../../Conexiones/conexionMedidas.php");
include ("../../../Conexiones/conexionSicap.php");
include("../../../funcionesMedidasProteccion.php");	

if (isset($_POST["idCuadernoAntecedentes"])){ $idCuadernoAntecedentes = $_POST["idCuadernoAntecedentes"]; }	
if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }	
if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }	
if (isset($_POST["idMedida"])){ $idMedida = $_POST["idMedida"]; }	

$getDataGenerales = getDataGenerales($connMedidas, 0,1,$idCuadernoAntecedentes); 
$numAntecedentes  = $getDataGenerales[0][1];
$temporalidad  = $getDataGenerales[0][2];
$fechaConclusion = $getDataGenerales[0][3]->format('Y-m-d H:i');

?>     
      <div class="row">
								<div class="col-xs-12 col-sm-12  col-md-2">
								 <button type="button" class="btn btn-primary btn-lg" onclick="updateDatosGenerales(<?php echo $idEnlace; ?> , <?echo $idCuadernoAntecedentes; ?>, <?php echo $idMedida; ?>)">Actualizar</button>
							 </div>
					 </div><br>
       <div class="row">
        <div class="col-xs-12 col-sm-12  col-md-3">
									<label for="nuc">NUC: </label>
									<input class="form-control mandda gehit" value="<?echo $nuc; ?>"  id="nuc"  type="text" disabled>
							 </div>
        <div class="col-xs-12 col-sm-12  col-md-3">
									<label for="numAntecedentes">CUADERNO DE ANTECEDENTES: <span class="aste">(*)</span></label>
									<input class="form-control mandda gehit" value="<?echo $numAntecedentes; ?>"  id="numAntecedentes"  type="text">
								</div>
								<div class="col-xs-12 col-sm-12  col-md-3">
								 <label for="temporalidad">TEMPORALIDAD: <span class="aste">(*)</span></label>
									<select class="form-control" id="temporalidad">
										 <option value="">Seleccione</option>
										 <?php for ($i=1; $i<=99; $i++){ ?>
										 	<option class="fontBold" value="<?php echo $i; ?>" <?if($i == $temporalidad){ ?> selected <? } ?> ><?php echo $i;?> días</option>
										 <?php } ?>
									</select>
								</div> 
								<div class="col-xs-12 col-sm-12  col-md-3">
									<label for="fechaConclusion">Fecha de conclusión: <span class="aste">(*)</span></label>
									<input id="fechaConclusion" type="datetime-local" value="<? echo $fechaev=str_ireplace(' ','T', $fechaConclusion); ?>" name="fechaConclusion" class="fechas form-control gehit" />
								</div>
							</div>


