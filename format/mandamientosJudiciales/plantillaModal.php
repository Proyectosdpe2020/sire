<?php
include ("../../Conexiones/Conexion.php");
include ("../../Conexiones/conexionMedidas.php");
include("../../Conexiones/conexionSicap.php");	
//include("../../funcionesPueDispo.php");	
include("../../funcionesMedidasProteccion.php");	

?>


<div class="modal-header" style="background-color:#152F4A;">
	<center><label style="color: white; font-weight: bold; font-size: 2rem;">Datos del inculpado </label></center>
</div>
<div class="modal-body panel_registroMandamientos">
	<!--DATOS GENERALES-->
	<div class="panel panel-default fd1">
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong>Datos del inculpado</strong></h5>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12 input-group-lg">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Ingrese los datos del inculpado.</h3>
						</div>
						<div class="panel-body">	
							
						</div>
						<div class="panel-footer">
						Panel footer
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
			<button type="button" class="btn btn-primary btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar información</button>
		</div>
		<div class="col-xs-12 col-sm-12  col-md-3">
			<button type="button" class="btn btn-default btn-lg" data-dismiss="modal" onclick="closeModalMDP(<?echo $anioActual; ?>, <?echo $idEnlace; ?>, 0)" >Cerrar</button>
		</div>
	</div>
</div>

