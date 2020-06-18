
	<?php
	session_start();
	include ("../../Conexiones/Conexion.php");
	include("../../funciones.php");	
	include ("../../Conexiones/conexionSicap.php");
		include("../../funcioneLit.php");
	include("../../funcioneSicap.php");

	if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }

	$mesCapturar = 5;
	$anioCaptura = 2019;

	$idFiscalia = 4;


 $mesNom = Mes_Nombre($mesCapturar);
 $idUsuario = $_SESSION['useridIE'];
 $varValidado = 0;

 $enlace = getInfoEnlaceUsuario($conn, $idUsuario);
									$idEnlace = $enlace[0][0];

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
													<label class="" style="color: #686D72; font-size: 1.7em;">REGISTRO DE INFORMACIÓN DE PERSONAS DESAPARECIDAS, NO LOCALIZADAS Y/O AUSENTES</label>
													<h4> <label id="titfisc" class="titulo2">Fiscalía General del Estado de Michoácan</label></h4>
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
						<select id="anioCmasc" name="selMes" tabindex="6" class="form-control redondear selectTranparent" required>
							<option value="2018" selected><? echo $anioCaptura; ?></option>
						</select>
					</div>

					<div class="col-xs-6 col-sm-4  col-md-1">
						<label for="heard">Mes:</label><br>
						<select id="mesCmasc" name="selMes" tabindex="6"class="form-control redondear selectTranparent" required>
							<option value="<? echo $mesCapturar; ?>" selected><? echo $mesNom; ?></option>
						</select>
					</div>

					<div class="col-xs-6 col-sm-4  col-md-8">
						<label for="heard">Unidad:</label>
						<div id="contenidoProyectosListAgru">							
						
							<select id="unidadFormato" class="form-control redondear selectTranparent" onchange="updTableMpUnidadLit(<? echo $idEnlace ?>);" required>								
								
							<? if($idUnidad == 0){ ?>

								<option value="0" selected="">TODOS</option>
								<? }else{ ?>
								<option value="0" >TODOS</option>
								<? } ?>

								<? 									

									for ($p=0; $p < sizeof($unidads); $p++) { 
										
										$idUnidadi = $unidads[$p][0];
										$nUnidad = $unidads[$p][1];

										if ($idUnidad == $idUnidadi) {	
										?>
										   <option id="formatUnid" value="<? echo $idUnidadi; ?>" selected><? echo $nUnidad; ?></option>
										<?
										}else{
?>
			<option id="formatUnid" value="<? echo $idUnidadi; ?>"><? echo $nUnidad; ?></option>
<?

										}
									}

									// Obtener todas las unidades que corresponden a un enlace	


								?>


							</select>

						</div>
					</div>


					<div class="col-xs-12 col-sm-12  col-md-2">
					<label class="transparente">.</label>					


					<button type="button" href="#capInfoDesapenciar" data-toggle="modal" onclick="mostrarModalInfoDesapar('<? echo $varValidado; ?>', <? echo $idEnlace; ?>, <? echo $mesCapturar; ?>, <? echo $anioCaptura; ?>);" class="btn btn-primary btn-sm redondear btnEnvDPE" ><span class="glyphicon glyphicon-ok"></span> Enviar a DPE</button>



					</div>

			
					

				</div>

				<div id="respuestaDescargarCarpeta"> 
								
				</div>

					<div class="contTblMPs" id="contTblMPs2">

						<div id="tablempss" class="row pad20">							
					
								<table class="table table-striped tblTransparente">
									<thead>
										<tr class="cabezeraTabla">
											<th class="textCent">Validado</th>
													<th class="textCent">No</th>
													<th class="textCent">Nuc</th>
													<th class="textCent">Expediente</th>
													<th class="textCent">Nombre Completo Victima</th>
													<th class="textCent">Sexo</th>
														<th class="textCent">Edad</th>
													<th class="textCent">Delito</th>
													<th class="textCent">Fecha Inicio</th>													
													<th class="textCent">Fecha Comision</th>

													<th class="textCent">Accion </th>

										</tr>
									</thead>
									<tbody>
								<? 			


								$arrayEstatus = array(22,22,2,5,20,21,3,23,24,25,15); 
        $arrayTipoEsts = array('judCd', 'judSd', 'abst', 'arch', 'neap', 'incom', 'acum', 'medi', 'conci', 'crite', 'sucond');  
        $bandCHeckEnv = 0;			

        							$desparecedos = getDataDesaparecidos($conSic, $mesCapturar, $anioCaptura);
        								$inc = 0;

								for ($i=0; $i < sizeof($desparecedos); $i++) { 

											$idcarpeta = $desparecedos[$i][0];
											$NUC = $desparecedos[$i][1];
											$Expediente = $desparecedos[$i][2];
											$Nombre = $desparecedos[$i][3];


											$FechaInicio = $desparecedos[$i][4]->format('Y-m-d H:i:s');
											$FechaComisionMp = $desparecedos[$i][5]->format('Y-m-d H:i:s');
											$municipioID = $desparecedos[$i][6];


												$ficaliaf = getIdFiscaliaXmunicipio($conSic, $municipioID);
												$iffisca = $ficaliaf[0][0];


												if($idFiscalia == $iffisca){												


											$datavict = getVictimaDataSicap($conSic, $idcarpeta);

											$NombreVic = $datavict[0][1];
											$paterno = $datavict[0][2];
											$materno = $datavict[0][3];

											$nocmo = $NombreVic." ".$paterno." ".$materno;

											$sexo = $datavict[0][6];
											if($sexo == 2){ $sex = "Femenino"; }else{

														if($sexo == 1) { $sex = "Masculino"; }else{ $sex = "Desconocido"; }

											}
												$eda = $datavict[0][5];
											
											

											?>



											<tr>
												<td class="tdRowMain"><span class="glyphicon glyphicon-remove spanRemove"></span></td>

		

												<td class="tdRowMain negr"><? echo ($inc+1); ?></td>
												<td class="tdRowMain2"><? echo $NUC; ?></td>
												<td class="tdRowMain"><? echo $Expediente; ?></td>
												<td class="tdRowMain" style="font-weight: bolder; text-align: left !important; color:rgba(248,164,103) !important;"><? echo $nocmo; ?></td>
												<td class="tdRowMain"><? echo $sex; ?></td>
												<td class="tdRowMain"><? echo $eda; ?></td>
												<td class="tdRowMain"><? echo $Nombre; ?></td>
												<td class="tdRowMain"><? echo $FechaInicio; ?></td>
												<td class="tdRowMain"><? echo $FechaComisionMp; ?></td>											


														<td class="tdRowMain"><center><button type="button" data-toggle="modal" href="#capInfoDesap"  onclick="mostrarModalInfoDesapar('<? echo $varValidado; ?>', <? echo $idEnlace; ?>, <? echo $mesCapturar; ?>, <? echo $anioCaptura; ?>);" class="btn btn-info btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-pencil"></span> Capturar Información </button></center></td>													
												</tr>			

											<?
												$inc++;

												}
									# code...  
								}

								?>
									 </tbody>
									</table>
							
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

<div class="modal fade bs-example-modal-sm" id="capInfoDesap" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalValidateNucs" class="modal-dialog modal-sm" style="height: 87vh !important; width: 65%; margin-top: 1%;" >

																	<div class="modal-content" style="background-color: transparent !important; box-shadow: none !important; border: none !important;" >

																					<div id="contMOdalDesapaGen">Aqui el resultado desap
																						

																								


																					</div>


																	</div>				
										</div>												

		</div>



		<div class="modal fade bs-example-modal-sm" id="modalFormatoLitig" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 40%; margin-top: 1%;">

																	<div class="modal-content">

																					<div id="contMOdalFormatoLitig"></div>

																	</div>				
										</div>												

		</div>

		<div class="modal fade bs-example-modal-sm" id="modalFormatoLitigVer" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 40%; margin-top: 1%;">

																	<div class="modal-content" style="">

																					<div id="contMOdalFormatoVerLitig"></div>

																	</div>				
										</div>												

		</div>

		<div class="modal fade bs-example-modal-sm" id="modalFormatoLitigEditar" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 30%; margin-top: 1%; height: 80vh !important;">

																	<div class="modal-content" style="">

																					<div id="contMOdalFormatoEditarLitig"></div>

																	</div>				
										</div>												

		</div>



		<div class="modal fade bs-example-modal-sm" id="modalNucsLitig" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 40%; margin-top: 1%;">

																	<div class="modal-content">

																					<div id="contmodalnucsLitig"></div>

																	</div>				
										</div>												

					</div>


	</html>