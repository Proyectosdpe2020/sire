
	<?php
	session_start();
	include ("../Conexiones/Conexion.php");
	include("../funciones.php");	
	include ("../Conexiones/conexionSicap.php");
	include("../funcioneSicap.php");

	if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
	
 $idUsuario = $_SESSION['useridIE'];

	$enlace = getInfoEnlaceUsuario($conn, $idUsuario);
	$idEnlace = $enlace[0][0];
	$idfisca = $enlace[0][1];


	$enlaunid = getUnidadEnlaceFormat($conn, $idEnlace, 1);	
	$idunienlace = $enlaunid[0][0];	

	$mescap = getMesCapEnlaceArchivo($conn, $idEnlace, 1);	
	$mescapen = $mescap[0][0];

	$mesCapturar = $mescapen;

	$ANIOSCAP = get_anio_enlace($conn,  $idEnlace, 1);
	$anioCaptura = $ANIOSCAP[0][0];

	$mesNom = Mes_Nombre($mesCapturar);


 
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

				<div class="row pad20">

					<div class="col-xs-6 col-sm-4  col-md-1">
						<label for="heard">Año:</label><br>
						<select id="recipientAnio2" name="selMes" tabindex="6" class="form-control redondear selectTranparent" required>
							<option value="2018" selected><? echo $anioCaptura; ?></option>
						</select>
					</div>

					<div class="col-xs-6 col-sm-4  col-md-1">
						<label for="heard">Mes:</label><br>
						<select id="recipientmes" name="selMes" tabindex="6"class="form-control redondear selectTranparent" required>
							<option value="<? echo $mesCapturar; ?>" selected><? echo $mesNom; ?></option>
						</select>
					</div>

					<div class="col-xs-6 col-sm-4  col-md-4">	
						<label for="heard">Unidad:</label>
						<div id="contenidoProyectosListAgru">							
							<? 

								$enlace = getInfoEnlaceUsuario($conn, $idUsuario);
									$idEnlace = $enlace[0][0];
									$idfisca = $enlace[0][1];

									if($idfisca == 4){$unidads = getDistincUnidadesMPs($conn, $idEnlace);}else{

												$unidads = getDistincUnidadesMPsFis($conn, $idEnlace, 1);

									}
									

							?>

							<select id="unidadFormato" class="form-control redondear selectTranparent" onchange="updTableMpUnidad(<? echo $idEnlace ?>);" required>								<option value="0" >TODOS</option>
								
							<? /* if($idUnidad == 0){ */?>

								<!--<option value="0" selected="">TODOS</option>-->
								
								<? /*}else{ ?>
								<!--<option value="0" >TODOS</option>-->
								<? } ?>

								<? 									

									/*for ($p=0; $p < sizeof($unidads); $p++) { 
										
										$idUnidadi = $unidads[$p][0];
										$nUnidad = $unidads[$p][1];

										if ($idUnidad == $idUnidadi) {*/
										?>
										   <!--<option id="formatUnid" value="<? echo $idUnidadi; ?>" selected><? echo $nUnidad; ?></option>-->
										<?
										/*}else{
?>
		<!--	<option id="formatUnid" value="<? echo $idUnidadi; ?>"><? echo $nUnidad; ?></option>-->
<?

										}
									}*/

									// Obtener todas las unidades que corresponden a un enlace	


								?>


							</select>

						</div>
					</div>


					<div class="col-xs-6 col-sm-4  col-md-2">
					<label class="transparente">.</label>					

					<?
					
							

							$arrayCapturadas = array();


							$numOFforms = getFormsAccesosEnlace($conn, $idEnlace); 

								if($numOFforms == 1 ){

									$mpsList = getMpsEnlaceUnidadFormato($conn, $idEnlace, 1);
								}else{

									if( $idUnidad == 0){

										/*
										if($idfisca == 4){ $mpsList = getMpsEnlace($conn, $idEnlace); }else{  

											$mpsList = getMpsEnlaceUnidad($conn, $idEnlace, 1); 
											}
										*/
													$mpsList = getMpsEnlaceUnidadFormato($conn, $idEnlace, 1);

										


									}else{


										/*	
										//	$mpsList = getEnlMpUnidad($conn, $idUnidad, $idEnlace);
										if($idfisca == 4){ $mpsList = getEnlMpUnidad($conn, $idUnidad, $idEnlace);; }else{ $mpsList = getEnlMpUnidad2($conn, $idUnidad, $idEnlace); }

											$unInfo = getInfoUnidad($conn, $idUnidad);
											$nomUnidad = $unInfo[0][1]; */
											$mpsList = getMpsEnlaceUnidadFormato($conn, $idEnlace, 1);

									}

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




	$numOFforms = getFormsAccesosEnlace($conn, $idEnlace); 

								if($numOFforms == 1 ){

									$enviado = getEnviadoEnlaceFormato($conn, $idEnlace, 1);
									$env = $enviado[0][0];
									$envArch = $enviado[0][1];

								}else{

								$enviado = getEnviadoEnlace($conn, $idEnlace);
								$env = $enviado[0][0];
								$envArch = $enviado[0][1];


								}

								

									   	

					?>

					<button type="button" href="#validateNucs" data-toggle="modal" onclick="mostrarModalValidacionNUcs('<? echo $varValidado; ?>', <? echo $idEnlace; ?>, <? echo $mesCapturar; ?>, <? echo $anioCaptura; ?>);" class="btn btn-primary btn-sm redondear btnEnvDPE" <? if( $env == 1){ echo "disabled"; } ?>><span class="glyphicon glyphicon-ok"></span> Enviar a DPE</button>



					</div>

					<!--<div class="col-xs-6 col-sm-4  col-md-1">
								<label class="transparente">.</label>		
								<center><button type="button"  onclick="descargar(<? echo $idunienlace; ?>, <? echo $mesCapturar; ?>, <? echo $anioCaptura; ?> , <? echo $idEnlace; ?>);" class="btn btn-success btn-sm redondear btnCapturarTbl" <? if($env == 1){}else{ echo "disabled"; } ?> ><span class="glyphicon glyphicon-cloud-download"></span> Descargar </button></center>
					</div>-->

					<div class="col-xs-6 col-sm-4  col-md-2">
							<label class="transparente">.</label>		
							<center><button type="button" data-toggle="modal" href="#myModaSubirArchivoUser"  onclick="subirArchivoEnlace(<? echo $idUnidad; ?>, <? echo $mesCapturar; ?>, <? echo $anioCaptura; ?> , <? echo $idEnlace; ?>,1);" class="btn btn-danger btn-sm redondear btnCapturarTbl" <? if($env == 1){ if($envArch == 1){ echo "disabled"; } }else{ echo "disabled"; } ?>><span class="glyphicon glyphicon-cloud-upload"></span> Subir Archivo </button></center>
						
					</div>

					<div class="col-xs-6 col-sm-4  col-md-2">
							<label class="transparente">.</label>		
							<center><button type="button" data-toggle="modal" href="#myModaVistaPrevia"  onclick="getDataVistaPrevia(<? echo $idUnidad; ?>, <? echo $mesCapturar; ?>, <? echo $anioCaptura; ?>, <? echo $idEnlace; ?>);" class="btn btn-warning btn-sm redondear btnCapturarTbl" ><span class="glyphicon glyphicon-eye-open"></span> Vista Previa </button></center>
						
					</div>

					<br>

				</div>

				<div id="respuestaDescargarCarpeta"> 
								
				</div>

					<div class="contTblMPs" id="contTblMPs2"><br>
					<div id="tablempss" style="width: 100% !important; ">
						<div class="row pad20">							
							<div class="col-xs-12 col-sm-12  col-md-12">
								<table id="" style="background-color:rgba(255,255,255,0.4);" class="table table-striped ">
									<thead>
										<tr class="cabezeraTabla">
											<th class="col-xs-1 col-sm-1 col-md-1 textCent">Capturado? </th>
													<th class="col-xs-1 col-sm-1 col-md-1 textCent">No</th>
													<th class="col-xs-4 col-sm-4 col-md-3 ">Nombre Ministerio Público</th>
													<th class="col-xs-4 col-sm-4 col-md-4 textCent">Unidad</th>
													<th class="col-xs-1 col-sm-1 col-md-1 textCent">Mes</th>													
													<th class="col-xs-1 col-sm-1 col-md-1 textCent">Anio</th>

												

													<? if($env == 1){}else{ ?>
													<th class="textCent">Accion </th>
													<th class="textCent">Accion </th>
													<? } ?>

													<th class="textCent">Accion </th>

										</tr>
									</thead>
									<tbody>
								<? 			


								$arrayEstatus = array(22,22,2,5,20,21,3,23,24,25,15); 
        $arrayTipoEsts = array('judCd', 'judSd', 'abst', 'arch', 'neap', 'incom', 'acum', 'medi', 'conci', 'crite', 'sucond');  
        $bandCHeckEnv = 0;			

								for ($i=0; $i < sizeof($mpsList); $i++) { 

											$nombre = $mpsList[$i][0];
											$apPatern = $mpsList[$i][1];
											$apMetern = $mpsList[$i][2];
											$idUnidad = $mpsList[$i][3];
											$idMp = $mpsList[$i][4];

											$capturado = getCapturadoMesAnioMP($conn, $mesCapturar, $anioCaptura, $idMp, $idUnidad);
											$nomCompleto = $nombre." ".$apPatern." ".$apMetern;
											


											if($numOFforms == 1 ){
										
													$unInfo = getMpunidadFormato($conn, $idEnlace, 1, $idMp, $idUnidad);
													$nomUnidad = $unInfo[0][1]; 
											}else{

												$unfifo =  getNunidad($conn, $idUnidad);
												$nomUnidad = $unfifo[0][0];

											}
											


											?>
											<tr>
												<td class="tdRowMain"><? if ($capturado == 1) { ?><span class="glyphicon glyphicon-ok spanOK"></span><?	}else{ ?><span class="glyphicon glyphicon-remove spanRemove"></span><? } ?></td>

		

												<td class="tdRowMain negr"><? echo ($i+1); ?></td>
												<td class="tdRowMain2"><? echo $nomCompleto; ?></td>
												<td class="tdRowMain"><? echo $nomUnidad; ?></td>
												<td class="tdRowMain"><? echo $mesNom; ?></td>
												<td class="tdRowMain"><? echo $anioCaptura; ?></td>											


														<? if($env == 1){} else { ?>
														<td class="tdRowMain"><center> <button type="button" data-toggle="modal" href="#myModaFormato"  onclick="cargarMOdalFormato('<? echo $nomCompleto; ?>',<? echo $idMp; ?>, <? echo $idUnidad; ?>, <? echo $mesCapturar; ?>, <? echo $anioCaptura; ?>);" class="btn btn-primary btn-sm redondear btnCapturarTbl" <? if ($capturado == 1) { echo "disabled";	} ?> ><span class="glyphicon glyphicon-pencil"></span> Capturar </button></center></td>

														<td class="tdRowMain"><center> <button type="button" data-toggle="modal" href="#myModaFormatoEditar"  onclick="cargarMOdalFormatoEditar('<? echo $nomCompleto; ?>',<? echo $idMp; ?>, <? echo $idUnidad; ?>, <? echo $mesCapturar; ?>, <? echo $anioCaptura; ?>);" class="btn btn-warning btn-sm redondear btnCapturarTbl" <? if ($capturado == 1) {}else{ echo "disabled"; } ?>><span class="glyphicon glyphicon-edit"></span> Editar </button></center></td>
														<? } ?>

														<td class="tdRowMain"><center><button type="button" data-toggle="modal" href="#myModaFormatoVer"  onclick="cargarMOdalFormatoVer('<? echo $nomCompleto; ?>',<? echo $idMp; ?>, <? echo $idUnidad; ?>, <? echo $mesCapturar; ?>, <? echo $anioCaptura; ?>);" class="btn btn-info btn-sm redondear btnCapturarTbl" <? if ($capturado == 1) {}else{ echo "disabled"; } ?>><span class="glyphicon glyphicon-search"></span> Ver Formato </button></center></td>

													
												</tr>			




											<?

									# code...
								}

								?>
									 </tbody>
									</table>
									</div>
							</div>
						</div>	

						</div><br>

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


<!-- ESTE ES EL MODAL QUE VA A CARGAR LA PANTALLA FINAL PARA LA VALIDACION NUCS CORRESPONDAN AL NUMERO PUESTO EL EL CAMPO NUMERICO  -->

<div class="modal fade bs-example-modal-sm" id="validateNucs" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalValidateNucs" class="modal-dialog modal-sm" style="height: 750px !important; width: 45%; margin-top: 5%;" >

																	<div class="modal-content" style="background-color: transparent !important; box-shadow: none !important; border: none !important;" >

																					<div id="contMOdalValidateNucs">
																						

																										<div ><center><img style="width:150;height:150; margin-top: 15% !important;" src="img/cargando (1).gif"><br><h3 style="color: white; font-weight: bold; font-family: helvetica;">        Validando Información...</h3></center></div>


																					</div>


																	</div>				
										</div>												

		</div>

	</html>