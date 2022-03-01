<?php
include ("../../Conexiones/Conexion.php");
include("../../Conexiones/conexionSIMAJ.php");	
include("../../funcionesMandamientos.php");	

$fecha_actual=date("d/m/Y");
$fecha=strftime( "%Y-%m-%d %H:%M:%S", time() );
$anioActual = date("Y");
$hoy = date("Y-m-d");//Fecha calendario

if (isset($_POST["tipoModal"])){ $tipoModal = $_POST["tipoModal"]; }
if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
if (isset($_POST["idfisca"])){ $idfisca = $_POST["idfisca"]; }
if (isset($_POST["ID_DELITOS_INTERNO"])){ $ID_DELITOS_INTERNO = $_POST["ID_DELITOS_INTERNO"]; }
if (isset($_POST["ID_MANDAMIENTO_INTERNO"])){ $ID_MANDAMIENTO_INTERNO = $_POST["ID_MANDAMIENTO_INTERNO"]; }

$getData_Delitos = getData_delitos_editar($conn, $ID_DELITOS_INTERNO);
if( sizeof($getData_Delitos > 0) ){
	$ID_DELITO = $getData_Delitos[0][8];
	$ID_MODALIDAD = $getData_Delitos[0][10];
	$ES_PRINCIPAL = $getData_Delitos[0][12];
}



?>


<div class="modal-header" style="background-color:#152F4A;">
	<center><label style="color: white; font-weight: bold; font-size: 2rem;">Datos del Delito </label></center>
</div>
<div class="modal-body panel_registroMandamientos">
	<!--DATOS GENERALES-->
	<div class="panel panel-default fd1">
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong>Delitos</strong></h5>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12 input-group-lg">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title">Editar los datos del delito.</h3>
						</div>
						<div class="panel-body">	
								<div class="row">
										<div class="col-xs-12 col-sm-12  col-md-12 input-group-lg">
											<label for="ID_DELITO_actualizar"><span class="glyphicon glyphicon-list-alt"></span> Delito</label><br>
											<select class="form-control" id="ID_DELITO_actualizar" onchange="reload_modalidad(),validateCampo_OK(this.id)">
													<option class="fontBold" value="">Seleccione un delito</option>
														  <? $delitos = getCatDelitos($connSIMAJ);
										 					for ($i=0; $i < sizeof($delitos); $i++) { 
										 						$cv_delito = $delitos[$i][1];	$descrip_delito = $delitos[$i][2]; ?>
										 					<option class="fontBold" value="<? echo $cv_delito; ?>" <?if($cv_delito == $ID_DELITO) { ?> selected <? } ?> ><? echo $descrip_delito; ?></option>
										 					<? } ?>
												</select>
										</div>
									</div><br>
									<div class="row">
										<div class="col-xs-12 col-sm-12  col-md-12 input-group-lg">
											<label for="ID_MODALIDAD_actualizar">Modalidad</label><br>
											<select class="form-control" id="ID_MODALIDAD_actualizar" onchange="validateCampo_OK(this.id)">
												<option value="9999">SIN DATO</option>
											</select>
										</div>
									</div><br>
									<div class="row">
										<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
											<label  for="ES_PRINCIPAL">Es principal</label><br>
											 <input type="radio" id="ES_PRINCIPAL" name="ES_PRINCIPAL_actualizar" value="1" <?if($ES_PRINCIPAL == 1){ ?> checked <? } ?>  style="height:25px; width:25px;">
						      <label for="ES_PRINCIPAL" style="font-size: 20px;">Si</label>&nbsp;&nbsp;&nbsp;&nbsp;
						      <input type="radio" id="ES_PRINCIPAL" name="ES_PRINCIPAL_actualizar" value="0" <?if($ES_PRINCIPAL == 0){ ?> checked <? } ?> style="height:25px; width:25px;">
						      <label for="ES_PRINCIPAL" style="font-size: 20px;">No</label>
										</div>
									</div>
									</div><br>
						</div>
						<div class="panel-footer">
						
					 </div>
					</div>	
				</div>	
			</div>
		</div>
	</div>
</div>
<!--DATOS GENERALES-->

	
<div class="modal-footer">
	<div class="row">
		<div class="col-xs-12 col-sm-12  col-md-6 col-md-offset-3">
			<button type="button" class="btn btn-primary btn-lg" style="width: 100%;" onclick="actualizar_delito(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>, <?echo $idUnidad; ?> , <?echo $idfisca; ?> , <?echo $ID_MANDAMIENTO_INTERNO; ?> , <?echo $ID_DELITOS_INTERNO; ?> )" ><span class="glyphicon glyphicon-floppy-disk"></span> Editar información</button>
		</div>
		<div class="col-xs-12 col-sm-12  col-md-3">
			<button type="button" class="btn btn-default btn-lg" data-dismiss="modal" onclick="closeModal_agraviados()" >Cerrar</button>
		</div>
	</div>
</div>

