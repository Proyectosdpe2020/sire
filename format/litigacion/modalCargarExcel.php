<?php

 include ("../../Conexiones/Conexion.php");
 include ("../../Conexiones/conexionSicap.php");
	include("../../funciones.php");
	include("../../funcioneSicap.php");
	include("../../funcioneLit.php");
	include("../../funcionesLitSENAP.php");


if(isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; } 
if(isset($_POST["mes"])){ $mes = $_POST["mes"]; } 
if(isset($_POST["anio"])){ $anio = $_POST["anio"]; } 
if(isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; } 
if(isset($_POST["deten"])){ $deten = $_POST["deten"]; } 
if(isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; } 


?>


<div class="modal-header" style="background-color:#152F4A;">
	<center><label style="color: white; font-weight: bold; font-size: 2rem;">Carga de Nucs desde archivo Excel </label></center>
</div>

<input type="hidden" id="idMp" value="<?echo $idMp; ?>" >
<input type="hidden" id="mes" value="<?echo $mes; ?>" >
<input type="hidden" id="anio" value="<?echo $anio; ?>" >
<input type="hidden" id="estatResolucion" value="<?echo $estatResolucion; ?>" >
<input type="hidden" id="idUnidad" value="<?echo $idUnidad; ?>" >

<div class="modal-body panel_modalCargaNucsExcel">
	<!--DATOS GENERALES-->
	<div class="panel panel-default fd1">
		<div class="panel-body">
  <div class="row">
  	<div class="col-xs-4"> 
  	 <form onsubmit="return false" action="return false" id="filesForm">
	  		<label style="font-weight:bold">Carga archivo Excel *</label>
	  		<span class="btn btn-default btn-file glyphicon glyphicon-upload"> CARGAR EXCEL <input type="file" id="file" name="file"></span>		
	  		<!--<progress value="0" max="100" class="progress" id="progreso">0%</progress>
								<label for="" id="etiqueta"> 0%</label>-->
  		</form>		
  	</div>
  	 <div class="preloaderSelect_NUC" hidden >Validando archivo Excel, espere un momento...<img width="50px"  src="img/loaderData.gif"></div>
  </div><br />
  

		<!--	<h5 class="text-on-pannel"><strong>Vista previa de nucs</strong></h5>-->
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12 input-group-lg">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Vista previa de NUCS.</h3>
						</div>
						<div class="panel-body">	
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
											<th >ACCIONES</th>
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
							<h3 class="panel-title">DATOS NO VALIDADOS.</h3>
						</div>
						<div class="panel-body" style="background-color: lightyellow;">	
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-12 input-group-lg">
									<label>Los siguientes datos no han sido procesados debido a que es un dato invalido o el NUC no se ha podido validar en SIGI y SICAP. Verifique en su archivo Excel cada uno de los siguientes datos e ingreselos manualmente.</label>
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
		<div class="col-xs-12 col-sm-12  col-md-6 col-md-offset-6">
			<button type="button" class="btn btn-default btn-lg" data-dismiss="modal" onclick="closeModalCargarExcel()" >Cerrar ventana</button>
		</div>
	</div>
</div>


<!--MODAL PARA AGREGAR IMPUTADOS-->

<div class="modal fade bs-example-modal-sm" id="editar" role="dialog" data-backdrop="static" data-keyboard="false" style="overflow: auto">
	<div id="modalVistaCss" class="modal-dialog modal-sm" style="width: 80%; margin-top: 1%; ">
		<div class="modal-content">
			<div id="contmodal_editarImputado">
			 
			 <div class="modal-header" style="background-color:#152F4A;">
	<center><label style="color: white; font-weight: bold; font-size: 2rem;">Datos del imputado </label></center>
</div>

<div class="modal-body panel_registroMandamientos">

	<!--DATOS GENERALES-->
	<div class="panel panel-default fd1">
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong>Datos del imputado</strong></h5>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12 input-group-lg">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Ingrese los datos del imputado con el nuc: <label id="nuc_label"></label></h3>
						</div>
						<div class="panel-body">
							<form id="frmeditar">
									<div class="row">
										<div class="col-xs-12 col-sm-12  col-md-4 input-group-lg">
						     <input type="hidden" class="form-control" id="id_registro" placeholder="idRegistro" aria-describedby="sizing-addon1" maxlength="40" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="" value="" >
										</div>
									</div><br>
									<div class="row">
										<div class="col-xs-12 col-sm-12  col-md-4 input-group-lg">
											<label for="nombre"><span class="glyphicon glyphicon-user"></span> Nombre del inculpado:</label><br>
						     <input type="text" class="form-control" id="nombre" placeholder="ESPECIFICA EL NOMBRE DEL INCULPADO" aria-describedby="sizing-addon1" maxlength="40" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="" value="" >
										</div>
										<div class="col-xs-12 col-sm-12  col-md-4 input-group-lg">
											<label for="ap_paterno">Apellido paterno :</label><br>
						 				<input type="text" class="form-control" id="ap_paterno" placeholder="ESPECIFICA EL APELLIDO PATERNO" aria-describedby="sizing-addon1" maxlength="50" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="" value="" >
										</div>
										<div class="col-xs-12 col-sm-12  col-md-4 input-group-lg">
											<label for="ap_materno">Apellido materno:</label><br>
						     <input type="text" class="form-control" id="ap_materno" placeholder="ESPECIFICA EL APELLIDO MATERNO" aria-describedby="sizing-addon1" maxlength="50" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="" value="" >
										</div>
									</div><br>
										<div class="row">
											<div class="col-xs-12 col-sm-12  col-md-5 input-group-lg">
												<label for="id_sexo">Sexo</label><br>
												<input type="radio" id="id_sexo" name="id_sexo" value="M" style="height:25px; width:25px;" checked>
												<label for="cv_sexo" style="font-size: 20px;">Masculino</label>&nbsp;&nbsp;&nbsp;&nbsp;
												<input type="radio" id="id_sexo" name="id_sexo" value="F" style="height:25px; width:25px;">
												<label for="cv_sexo" style="font-size: 20px;">Femenino</label>
											</div>
											<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
												<label for="edad">Edad:</label><br>
							     			<input type="number" class="form-control" id="edad" placeholder="EDAD" aria-describedby="sizing-addon1" maxlength="2" value="" >
											</div>
											<div class="col-xs-12 col-sm-12  col-md-4 input-group-lg">
											<label for="curp">CURP:</label><br>
									     <input type="text" class="form-control" id="curp" placeholder="ESPECIFICA EL CURP" aria-describedby="sizing-addon1" maxlength="50" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="" value="" >
											</div>
										</div>
						 </form>
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
			<button type="button" class="btn btn-primary btn-lg" id="agregar_imputado" style="width: 100%;"><span class="glyphicon glyphicon-floppy-disk"></span> Aceptar </button>
		</div>
		<div class="col-xs-12 col-sm-12  col-md-3">
			<button type="button" class="btn btn-default btn-lg"  onclick="closeModalImputados()" >Cerrar ventana</button>
		</div>
	</div>
</div>


			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
  $("#file").change(function () {
  	console.log('hola');
    cargar_excel(this);
  });
</script>