<?  

	include ("../Conexiones/Conexion.php");
	include("../funciones.php");	
			
	if (isset($_POST["idUsuario"])){ $idUsuario = $_POST["idUsuario"]; }
	if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }



	$fecha_actual_system=date("d/m/Y");

	$anioactualdate = date("Y");

	$mesCapturar = 5;
	$anioCaptura = 2019;
	$mesNom = Mes_Nombre($mesCapturar);

	$enlace = getIdEnlaceUsuario($conn, $idUsuario);
							$idEnlace = $enlace[0][0];



?>

<html>
<body>
<head>
</head>
		<div id="contenido">
							<div class="right_col" role="main" style ="height: auto;">

													<div style="" class="x_panel principalPanel">

															<div class="x_panel panelCabezera">
																		
																		<table border="0" class="alwidth">						
																					<tr>								
																						<td id="nomostrar" class="imgSelloCabezera" width="5%" height="125"></td>								
																						<td width="50%">
																									<div class="tituloCentralSegu">
																										<div class="titulosCabe1">
																											<label class="titulo1">Archivos Historicos de Formatos Estadísticos DPE</label>
																											<h4> <label class="titulo2">Fiscalía General del Estado de Michoácan</label></h4>
																										</div>
																									</div>
																						</td>
																						<td id="nomostrar" class="imgdgtipeCabezera" width="10%" height="125"></td>
																					</tr>
																			</table>

															</div>

															<div class="row">

																			<div class="col-xs-12 col-sm-2  col-md-2">
																				<label for="heard">Año:</label><br>
																				<select id="anioArchSelectedAdmin" name="selMes" tabindex="6" class="form-control redondear selectTranparent" required>
																					<option value="2019" selected><? echo $anioCaptura; ?></option>
																				</select>
																			</div>

																			<div class="col-xs-12 col-sm-2  col-md-2">
																				<label for="heard">Mes:</label><br>
																				<select id="mesAdminarch" name="selMes" tabindex="6" class="form-control redondear selectTranparent" onchange="updTableArchAdmin(<? echo $idEnlace; ?>);" required>
																					
																					<?

																								$arrayMes = array('Enero','Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

																								for ($i=1; $i <= 12; $i++) { 
																						
																											if( $i == $mesCapturar ){ 

																												?>
																														<option value="<? echo $i; ?>" selected><? echo $arrayMes[$i-1]; ?></option>
																											 <?}else{?>
																											 		<option value="<? echo $i; ?>"><? echo $arrayMes[$i-1]; ?></option>
																											 <?
																											 }	

																								} 


																					?>


																				</select>
																			</div>

																			<div class="col-xs-12 col-sm-10  col-md-6">
																				<label for="heard">Enlace:</label>
																				<div id="contenidoEnlacesSelect">							
																					<select id="enlaceid" class="form-control redondear selectTranparent" onchange="updTableArchAdmin2();" required>								
																						


																						<option value="0" selected="">Todos</option>

																						<? 

																								$enlances = getAllEnlacesInfoUNidad($conn, 1);

																								for ($i=0; $i < sizeof($enlances); $i++) { 
																											

																											$idEnl = $enlances[$i][0];
																											$nomEnl = $enlances[$i][1];
																											$nUn = $enlances[$i][2];
																											$pater = $enlances[$i][3];
																											$matern = $enlances[$i][4];

																											?>
																														<option value="<? echo $idEnl; ?>"><? echo $nomEnl." ".$pater." ".$matern."  -  ".$nUn ?></option>
																											<?


																								}

																						?>


																					</select>

																				</div>
																			</div>

																			<div class="col-xs-12 col-sm-10  col-md-2">
																				<label for="heard">Tipo Archivo:</label>
																				<div id="contenidoProyectosListAgru">							
																					<select id="tipoarchReposi" class="form-control redondear selectTranparent" onchange="cargarEnlacesSelecTipoArch();" required>							
	
																						

																						<option value="1" selected="">Carpetas de Investigacíon</option>
																						<option value="4"="">Litigación</option>

																						<? 

																						?>


																					</select>

																				</div>
																			</div>
																			<br>
															</div>
															<!-- Aqui comienza la tabla para el repositorio de archivos -->

															  <div id="contenidoTablaRepositorioAdmin">
							    													

							    													<BR>
																		    	 <table class="table table-striped tblTransparente " >
																												<thead>
																													<tr class="cabezeraTabla ">
																														<th class="">No</th>
																														<th class="textCent">Nombre Archivo</th>
																														<th class="textCent">Fecha Descarga</th>
																														<th class="textCent">Mes</th>
																														<th class="textCent">Anio</th>
																														<th class="textCent">Usuario</th>
																														<th class="textCent">Fiscalía</th>
																														<th class="textCent">Unidad</th>
																														<th class="textCent">Tipo Archivo</th>
																														<th class="textCent">Accion</th>
																													</tr>
																												</thead>
																				
																										<tbody>
																												<? 

																															$archivosTodos = getHistoricosEnlaceFilterAdmin($conn, $idEnlace, $anioCaptura, $mesCapturar, 1, $idUsuario);	
																															
																															$turila = "http://201.116.252.158:8080/sire/repositorio/";
																															
																															for( $i=0; $i<sizeof($archivosTodos); $i++){

																															
																																$idArchivoHistorico = $archivosTodos[$i][0];
																																$nombreArchivo = $archivosTodos[$i][1];
																																$fechaDescarga = $archivosTodos[$i][2];
																																$mes = $archivosTodos[$i][3];
																																$anio = $archivosTodos[$i][4];
																																$nombre = $archivosTodos[$i][5];
																																$paterno = $archivosTodos[$i][6];
																																$materno = $archivosTodos[$i][7];
																																$nUnidad = $archivosTodos[$i][8];
																																$idTipoArchivo = $archivosTodos[$i][9];
																																$type_file = $archivosTodos[$i][10];
																																$idFiscalia = $archivosTodos[$i][11];
																																$nFiscalia = $archivosTodos[$i][12];
																																//$nunidad = $archivosTodos[$i][13];

																																$mesnom = Mes_Nombre($mes);
																																$usuarioname = $nombre." ".$paterno." ".$materno;
																				

																																if($idEnlace == 34){ $nunidad = "Delitos Vinculados a Violencia de Genero"; }



																																$mesNombre = Mes_Nombre($mes);

																																$newfechaDescarga = $fechaDescarga->format('d/m/y H:i:s');																															

 																															?>

 																															<tr >
																																<td class="tdRowMain"><center><label><? echo ($i+1); ?></label></center></td>
																																<td class="tdRowMain" style="padding: 0px !important;"><? echo $nombreArchivo; ?></td>
																																	<td class="tdRowMain"><? echo $newfechaDescarga; ?></td>
																																<td class="tdRowMain"><center><? echo $mesNombre; ?></center></td>
																																<td class="tdRowMain"><center><? echo $anio; ?></center></td>
																								
																																<td class="tdRowMain"><center><? echo $usuarioname; ?></center></td>
																																<td class="tdRowMain"><center><? echo $nFiscalia;  ?></center></td>
																																<td class="tdRowMain" style="font-weight: bold !important; color: #43a047 !important;"><? echo $nUnidad;  ?></td>
																																<td class="tdRowMain"><center><? echo $type_file;  ?></center></td>
																																
																												

																																<td class="tdRowMain"><center><button type="button" data-toggle="modal" href=""  onclick="descargarArchivoHistorico('<? echo $nombreArchivo; ?>', <? echo $idTipoArchivo; ?>);" class="btn btn-success btn-sm redondear btnCapturarTbl"><i class="far fa-file-excel" style="font-size:1.5em"></i> Descargar </button></center></td>
																																</tr>
																																			<?	} ?> 
																			


																										</tbody>

																									</table>

																	
																	 </div>


													</div>			

   				</div>


   	</div>

 



										



