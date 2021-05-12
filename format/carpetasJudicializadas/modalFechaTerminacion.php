<? 

 include ("../../Conexiones/Conexion.php");
 include ("../../Conexiones/conexionSicap.php");
	include("../../funciones.php");
	include("../../funcioneSicap.php");
	include("../../funcioneLit.php");
	include("../../funcionesLitSENAP.php");

	if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
	if (isset($_POST["resolucionID"])){ $resolucionID = $_POST["resolucionID"]; }
	if (isset($_POST["bandera"])){ $bandera= $_POST["bandera"]; }
	if (isset($_POST["fecha"])){ $fecha= $_POST["fecha"]; }

?>

<div class="modal-header" style="background-color:#152F4A;">
	<center><h4  style="font-weight: bold; color: white;" class="modal-title">Vinculaciones a proceso</h4></center>
</div>

<div class="modal-body ">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<h4>Fecha de termino de investigación complementaria del NUC: <strong><? echo $nuc; ?></strong></h4>
		</div>
	</div><br>

	<div class="row">
		<div class="col-xs-12 col-sm-12  col-md-12">
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
						<label for="fechaTerminoInv">Fecha de termino: </label>
						<input id="fechaTerminoInv" type="date" value="<?if($bandera == 1){echo $fecha; } ?>" name="fechaTerminoInv" class="fechas form-control gehit"  />
					</div>
			</div>
			<?if($bandera == 1){?>
			<br>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
						Eliminar <span onclick="eliminarFechaTermino(<?echo $resolucionID; ?>)" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-remove"></span>
					</div>
			</div>
		<? } ?>
	 </div>
	</div><br><br>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<button style="width: 88%;" onclick="closeModalFechaTerminacion()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button>
		</div>
		<div class="col-xs-12 col-sm-6  col-md-6 ">
			<button style="width: 88%;" onclick="insertFechaTerminacion(<?echo $resolucionID; ?>, <? echo $bandera; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		</div>
	</div>

 <!-- Termina Monto de la reparación del daño impuesta :-->

</div>

<div class="modal-footer">
	
</div>




																												
																													
																																																			
																								
																													
																																																			
																					