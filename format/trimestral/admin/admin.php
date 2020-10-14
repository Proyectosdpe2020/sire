
<?php
include("../../../Conexiones/Conexion.php");
include("../../../funciones.php");

$availablePeriods = getTrimestralPeriodsAvailable($conn);

?>

<div id="contenido">
	<div class="right_col" role="main">
		<div style="" class="x_panel principalPanel">
			<div class="x_panel panelCabezera">
				<table border="0" class="alwidth">
					<tr>
						<td id="nomostrar" class="imgSelloCabezera" width="5%" height="125"></td>
						<td width="50%">
							<div class="tituloCentralSegu">
								<div class="titulosCabe1">
									<h4> <label class="titulo2">Fiscalía General del Estado de Michoácan</label></h4>
									<label class="titulo100" style="color: #566573 ; font-weight: bolder;">DIRECCIÓN GENERAL DE TECNOLOGÍAS DE LA INFORMACIÓN, PLANEACIÓN Y ESTADÍSTICA</label>
									<h4> <label class="titulo2">Dirección de Planeación y Estadística</label></h4>
								</div>
							</div>
						</td>
						<td id="nomostrar" class="imgdgtipeCabezera" width="10%" height="125"></td>
					</tr>
				</table>
			</div>
			<div id="admin_content"></div>
		</div>
	</div>
</div>