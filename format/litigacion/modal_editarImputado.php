<?php

 include ("../../Conexiones/Conexion.php");
 include ("../../Conexiones/conexionSicap.php");
	include("../../funciones.php");
	include("../../funcioneSicap.php");
	include("../../funcioneLit.php");
	include("../../funcionesLitSENAP.php");


if(isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; } 


?>


<div class="modal-header" style="background-color:#152F4A;">
	<center><label style="color: white; font-weight: bold; font-size: 2rem;">Carga de Nucs desde archivo EXCEL </label></center>
</div>

<div class="modal-body panel_modalCargaNucsExcel">
	<!--DATOS GENERALES-->
	<div class="panel panel-default fd1">
		<div class="panel-body">
  <div class="row">
  	<div class="col-xs-4"> 
  	 <form onsubmit="return false" action="return false" id="filesForm">
	  		<label style="font-weight:bold">Carga archivo Excel *</label>
	  		<span class="btn btn-default btn-file glyphicon glyphicon-upload"> CARGAR FOTOGRAFIA <input type="file" id="file" name="file"></span>		
	  		<progress value="0" max="100" class="progress" id="progreso">0%</progress>
								<label for="" id="etiqueta"> 0%</label>
  		</form>		
  	</div>
  </div><br />
  

		<!--	<h5 class="text-on-pannel"><strong>Vista previa de nucs</strong></h5>-->
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12 input-group-lg">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Vista previa de nucs.</h3>
						</div>
						<div class="panel-body">	
							<button type="button" class="editar btn btn-primary btn-lg redondear" data-target="#modalNucs_imputados" >asdads</button>
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-12 input-group-lg">
										<div class="col-md-6 col-md-offset-3" id="preloaderIMG" hidden>
											<img src="images/cargando.gif"/>
										</div>

								<table id="gridPolicia" class="display table table-striped  table-hover" width="100%" >
									<thead>
										<tr class="cabeceraConsultaPolicia" >
											<th >#</th>
											<th >Capturado?</th>
											<th >NUC</th>
											<th >IMPUTADO</th>
											<th >ETAPA</th>
										</tr>
									</thead>
									<tbody id="contentConsulta">
										
										</tbody>
									</table><br>

								</div>
							</div><br>
						</div>
						<div class="panel-footer">
						
					 </div>
					</div>	
				</div>	
			</div>

			<div class="row" id="div_nuc_invalidos" hidden="true">
				<div class="col-xs-12 col-sm-12  col-md-12 input-group-lg">
					<div class="panel panel-danger">
						<div class="panel-heading">
							<h3 class="panel-title">DATOS INVALIDOS.</h3>
						</div>
						<div class="panel-body" style="background-color: lightyellow;">	
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-12 input-group-lg">
									<label>Los siguientes datos no han sido procesados debido a que es un dato invalido ó el NUC no se ha podido validar. Verifique en su archivo excel cada uno de los siguientes datos e ingreselos manualmente.</label>
								</div>
							</div><br>
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-12 input-group-lg">
										<div class="col-md-6 col-md-offset-3" id="preloaderIMG" hidden>
											<img src="images/cargando.gif"/>
										</div>
         
										<table id="gridPolicia2" class="display table table-striped  table-hover" width="100%">
											<thead>
												<tr class="cabeceraConsultaPolicia" >
													<th class="textCent">#</th>
													<th class="textCent10">NUC</th>
												</tr>
											</thead>
											<tbody id="contentConsulta2">
											
											</tbody>
										</table><br>

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
			<button type="button" class="btn btn-primary btn-lg" style="width: 100%;" onclick="guardar_mandamiento_agraviado(<? echo $tipoModal; ?> , <? echo $idEnlace; ?>, <?echo $idUnidad; ?> , <?echo $idfisca; ?> , <? echo $ID_MANDAMIENTO_INTERNO; ?> , <? echo $tipoActualizacion; ?>, <?echo $ID_DATOS_AGRAVIADO_INTERNO; ?> , <? echo $GET_ID_MANDAMIENTO_INTERNO; ?>) " ><span class="glyphicon glyphicon-floppy-disk"></span> Guardar información</button>
		</div>
		<div class="col-xs-12 col-sm-12  col-md-3">
			<button type="button" class="btn btn-default btn-lg" data-dismiss="modal" onclick="closeModalCargarExcel()" >Cerrar</button>
		</div>
	</div>
</div>



