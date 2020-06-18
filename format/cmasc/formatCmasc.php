
	<?php
	session_start();
	include ("../../Conexiones/Conexion.php");
	include("../../funciones.php");	

	if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
		if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }

	$mesCapturar = 1;
	$anioCaptura = 2019;


 $mesNom = Mes_Nombre($mesCapturar);
 $idUsuario = $_SESSION['useridIE'];
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
													<label class="titulo1" style="color: #686D72;">Centro de Mecanismos Alternativos de Solución de Controversias</label>
													<h4> <label class="titulo2">Fiscalía General del Estado de Michoácan</label></h4>
												</div>
											</div>
								</td>
								<td id="nomostrar" class="imgdgtipeCabezera" width="10%" height="125"></td>
							</tr>
					</table>


				</div>

				<div class="row pad20">

					<div class="col-xs-12 col-sm-2  col-md-1">
						<label for="heard">Año:</label><br>
						<select id="anioCmasc" name="selMes" tabindex="6" class="form-control redondear selectTranparent" required>
							<option value="2019" selected>2019</option>
						</select>
					</div>

					<div class="col-xs-12 col-sm-2  col-md-2">
						<label for="heard">Mes:</label><br>
						<select id="mesCmasc" name="selMes" tabindex="6"class="form-control redondear selectTranparent" required>
							<option value="<? echo $mesCapturar; ?>" selected><? echo $mesNom; ?></option>
						</select>
					</div>

					<div class="col-xs-12 col-sm-10  col-md-6">
						<label for="heard">Unidad:</label>
						<div id="contenidoProyectosListAgru">							
							<? 

								$enlace = getInfoEnlaceUsuario($conn, $idUsuario);
									$idEnlace = $enlace[0][0];
									$idfisca = $enlace[0][1];

									if($idfisca == 4){$unidads = getDistincUnidadesMPs($conn, $idEnlace);}else{

												$unidads = getDistincUnidadesMPsFis($conn, $idEnlace);

									}
									

							?>

							<select id="unidadFormato" class="form-control redondear selectTranparent" onchange="updTableMpUnidad(<? echo $idEnlace ?>);" required>								
		

								<option value="0" selected="">Centro de Mecanismos Alternativos de Solución de Controversias</option>
							</select>

						</div>
					</div>


					<div class="col-xs-12 col-sm-10  col-md-1">
					<label class="transparente">.</label>					

					<?
							

							$arrayCapturadas = array();

							if( $idUnidad == 0){


										if($idfisca == 4){ $mpsList = getMpsEnlace($conn, $idEnlace); }else{ $mpsList = getMpsEnlaceUnidad($conn, $idEnlace); }


							}else{

								//	$mpsList = getEnlMpUnidad($conn, $idUnidad, $idEnlace);
								if($idfisca == 4){ $mpsList = getEnlMpUnidad($conn, $idUnidad, $idEnlace);; }else{ $mpsList = getEnlMpUnidad2($conn, $idUnidad, $idEnlace); }

									$unInfo = getInfoUnidad($conn, $idUnidad);
									$nomUnidad = $unInfo[0][1]; 

							}

									for ($j=0; $j < sizeof($mpsList); $j++) { 

												$idMp = $mpsList[$j][4];
												 $idUnidad = $mpsList[$j][3];

												$carpetaVal=validarCarpetaCapturada($conn, $anioCaptura, $mesCapturar, $idUnidad, $idMp);
												if($carpetaVal == 1){ 

													$arrayCapturadas[$j] = 0; 

												}else{ 

													if($carpetaVal == 2){ 

														$arrayCapturadas[$j] = 1;

													 } 

												}
									}			
							$varValidado = "";
								$longitud = count($arrayCapturadas);


								if($longitud == 0){	$varValidado = "si"; 	}else{ 

									for($i=0; $i<$longitud; $i++){
										if($arrayCapturadas[$i] == 0){
											$varValidado = "no";
											break;
										}else{ $varValidado = "si"; }
								 }

								}
								$enviado = getEnviadoEnlace($conn, $idEnlace);
								$env = $enviado[0][0];
								$envArch = $enviado[0][1];
					?>

					<button type="button" onclick="enviarDPE('<? echo $varValidado; ?>', <? echo $idEnlace; ?>);" class="btn btn-primary btn-sm redondear btnEnvDPE" <? if( $env == 1){ echo "disabled"; } ?>><span class="glyphicon glyphicon-ok"></span> Enviar a DPE</button>

					</div>

					<div class="col-xs-12 col-sm-10  col-md-1">
								<label class="transparente">.</label>		
								<center><button type="button"  onclick="descargar(<? echo $idUnidad; ?>, <? echo $mesCapturar; ?>, <? echo $anioCaptura; ?> , <? echo $idEnlace; ?>);" class="btn btn-success btn-sm redondear btnCapturarTbl" <? if($env == 1){}else{ echo "disabled"; } ?> ><span class="glyphicon glyphicon-cloud-download"></span> Descargar </button></center>

					</div>
					<div class="col-xs-12 col-sm-10  col-md-1">
							<label class="transparente">.</label>		
							<center><button type="button" data-toggle="modal" href="#myModaSubirArchivoUser"  onclick="subirArchivoEnlace(<? echo $idUnidad; ?>, <? echo $mesCapturar; ?>, <? echo $anioCaptura; ?> , <? echo $idEnlace; ?>);" class="btn btn-danger btn-sm redondear btnCapturarTbl" <? if($env == 1){ if($envArch == 1){ echo "disabled"; } }else{ echo "disabled"; } ?>><span class="glyphicon glyphicon-cloud-upload"></span> Subir Archivo </button></center>
						
					</div>

					<br>

				</div>

				<div id="respuestaDescargarCarpeta"></div>

					<div class="contTblMPs" id="contTblMPs2">

						<div class="row pad20">			
							
									<div class="tab">

									  <button class="tablinks" onclick="openTabCmasc(event,'recibidasOu.php', <? echo $idEnlace; ?>)"><label class="titleMenuTop">Recibidas por otras Unidades</label></button>
									  <button class="tablinks" onclick="openTabCmasc(event,'acuerdosCeleb.php', <? echo $idEnlace; ?>)"><label class="titleMenuTop">Acuerdos Celebrados por tipo de Mecanismo</label></button>
									  <button class="tablinks" onclick="openTabCmasc(event,'justiciaRestaurativa.php', <? echo $idEnlace; ?>)"><label class="titleMenuTop">Justicia Restaurativa</label></button>
									  <button class="tablinks" onclick="openTabCmasc(event,'justiciaRestaurativaProg.php', <? echo $idEnlace; ?>)"><label class="titleMenuTop">Programas de Justicia Restaurativa</label></button>

									</div>									

									<div id="contentTabs" class="tabcontent"></div>
							
							</div>

						</div>

										<div class="x_panel piepanel">
												<div class="piepanel2">
														<div class="piepanel3">
															<div class="piepanel4">
																							<label style="color: #686D72;">SISTEMA INTEGRAL DE REGISTRO ESTADISTICO Copyright © Todos los Derechos Reservados</label>
															</div>
														</div>

													</div>				
											</div>


									</div>

		</body>
	</html>