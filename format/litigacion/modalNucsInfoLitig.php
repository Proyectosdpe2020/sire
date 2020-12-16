<? 

 include ("../../Conexiones/Conexion.php");
 include ("../../Conexiones/conexionSicap.php");
	include("../../funciones.php");
	include("../../funcioneSicap.php");
	include("../../funcioneLit.php");

?>


<div class="modal-header" style="background-color:#152F4A;">
	<center><h4  style="font-weight: bold; color: white;" class="modal-title">ACTUALIZACIÓN DE ARMAS</h4></center>
</div>

<div class="modal-body">

	<!--******************* ARMA LARGA **********************!-->
				<div class="panel panel-default">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong> ARMA LARGA </strong></h5>

						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4">
								<label for="marcaArmaLarga">Marca:<span class="aste">(*)</span></label>
								<input value="" type="text" style="text-transform:uppercase;" class="form-control" id="marcaArmaLarga" name="marcaArmaLarga" onkeyup="javascript:this.value=this.value.toUpperCase();">
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4">
								<label for="modeloArmaLarga">Modelo:<span class="aste">(*)</span></label>
								<input value="" type="text" style="text-transform:uppercase;" class="form-control" id="modeloArmaLarga" name="modeloArmaLarga" onkeyup="javascript:this.value=this.value.toUpperCase();">
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4">
								<label for="matriculaArmaLarga">Matricula:<span class="aste">(*)</span></label>
								<input value="" type="text" style="text-transform:uppercase;" class="form-control" id="matriculaArmaLarga" name="matriculaArmaLarga" onkeyup="javascript:this.value=this.value.toUpperCase();">
							</div>
						</div><br><br>

						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="calibreArmaLarga">Calibre:<span class="aste">(*)</span></label>
								<input value="" type="text" style="text-transform:uppercase;" class="form-control" id="calibreArmaLarga" name="calibreArmaLarga" onkeyup="javascript:this.value=this.value.toUpperCase();">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="folioArmaLarga">Folio:<span class="aste">(*)</span></label>
								<input value="" type="text" style="text-transform:uppercase;" class="form-control" id="folioArmaLarga" name="folioArmaLarga" onkeyup="javascript:this.value=this.value.toUpperCase();">
							</div>
						</div>

					</div>
				</div><br>

				<!--******************* ARMA CORTA **********************!-->
				<div class="panel panel-default">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong> ARMA CORTA </strong></h5>

						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4">
								<label for="marcaArmaCorta">Marca:<span class="aste">(*)</span></label>
								<input value="" type="text" style="text-transform:uppercase;" class="form-control" id="marcaArmaCorta" name="marcaArmaCorta" onkeyup="javascript:this.value=this.value.toUpperCase();">
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4">
								<label for="modeloArmaCorta">Modelo:<span class="aste">(*)</span></label>
								<input value="" type="text" style="text-transform:uppercase;" class="form-control" id="modeloArmaCorta" name="modeloArmaCorta" onkeyup="javascript:this.value=this.value.toUpperCase();">
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4">
								<label for="matriculaArmaCorta">Matricula:<span class="aste">(*)</span></label>
								<input value="" type="text" style="text-transform:uppercase;" class="form-control" id="matriculaArmaCorta" name="matriculaArmaCorta" onkeyup="javascript:this.value=this.value.toUpperCase();">
							</div>
						</div><br><br>

						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="calibreArmaCorta">Calibre:<span class="aste">(*)</span></label>
								<input value="" type="text" style="text-transform:uppercase;" class="form-control" id="calibreArmaCorta" name="calibreArmaCorta" onkeyup="javascript:this.value=this.value.toUpperCase();">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6">
								<label for="folioArmaCorta">Folio:<span class="aste">(*)</span></label>
								<input value="" type="text" style="text-transform:uppercase;" class="form-control" id="folioArmaCorta" name="folioArmaCorta" onkeyup="javascript:this.value=this.value.toUpperCase();">
							</div>
						</div>

					</div>
				</div>

</div><br><br>

<div class="modal-footer">
	<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button></center></div>
			<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="" type="button" class="btn btn-primary redondear" >Guardar</button></center></div>
	</div>
</div>




																												
																													
																																																			
																					