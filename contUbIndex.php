
	<?php
	session_start();
	include ("Conexiones/Conexion.php");
	include("funciones.php");	
	include ("Conexiones/conexionSicap.php");
	include("funcioneSicap.php");


	if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }	
	$dataEnlaceArc = getArchvsEnla($conn, $idEnlace);
	?>


		<div class="right_col" role="main">

			<div style="" class="x_panel principalPanel">

				


					<div class="row" style="height: 100vh !important; overflow-y: scroll !important;">
						
						
						<? 

								for ($i=0; $i < sizeof($dataEnlaceArc); $i++) { 

									if($dataEnlaceArc[$i][0] == 1){
									?>
											<div class="col-xs-12 col-sm-6  col-md-6 carpetasLogo" onclick="enviarAindex(1);">
												<div id="imgCarpeLogo">
													<div class="imgCentralCarpe"></div>
												</div>
											</div>
									<?}
									if($dataEnlaceArc[$i][0] == 4){
									?>
											<div class="col-xs-12 col-sm-6  col-md-6 litigacionLogo" onclick="enviarAindex(4);">
														<div id="imgLitiLogo">													
															<div class="imgCentralLit"></div>
														</div>
											</div>	
									<?}
									if($dataEnlaceArc[$i][0] == 11){
									?>
											<div class="col-xs-12 col-sm-6  col-md-6 litigacionLogo" onclick="enviarAindex(11);">
														<div id="imgLitiLogo">													
															<div class="imgCentralTrimestral"></div>
														</div>
											</div>		
									<?}
									
								}

						 ?>

						

						

					</div>	

						
							


			

		</div>
		</div>

		</body>


<!-- ESTE ES EL MODAL QUE VA A CARGAR LA PANTALLA FINAL PARA LA VALIDACION NUCS CORRESPONDAN AL NUMERO PUESTO EL EL CAMPO NUMERICO  -->



	</html>