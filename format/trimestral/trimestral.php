
	<?php

	

	session_start();

	/*if($_SESSION['idArchivo'] != 11){ 
    	unset($_SESSION['yainicieIE']); 
    	$_SESSION['yainicieIE']="NO";
		header("Location: http://201.116.252.158:8080/HELO900803/SIRE");    	
    }*/

	include ("../../Conexiones/Conexion.php");
	include("../../funciones.php");	
	include ("../../Conexiones/conexionSicap.php");
    include("../../funcioneLit.php");
	include("../../funcioneTrimes.php");

	if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
	if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
	

	

	
	$per1 = getPeriodoTrim($conn,  $idEnlace);
	$per = $per1[0][0];
	$anioGlobal = $per1[0][1];
	$format = 11; // ESTE ES EL FORMATO AL CUAL SE HACE REFERENCIA

	if($per == 1){ $m1 = "Enero"; $m2 = "Febrero"; $m3 = "Marzo"; $nme = "Enero - Marzo"; $arr = array(1,2,3);}
	if($per == 2){ $m1 = "Abril"; $m2 = "Mayo"; $m3 = "Junio"; $nme = "Abril - Junio"; $arr = array(4,5,6);}
	if($per == 3){ $m1 = "Julio"; $m2 = "Agosto"; $m3 = "Septiembre"; $nme = "Julio - Septiembre"; $arr = array(7,8,9);}
	if($per == 4){ $m1 = "Octubre"; $m2 = "Noviembre"; $m3 = "Diciembre"; $nme = "Octubre - Diciembre"; $arr = array(10,11,12);}

	$data = getDAtaQuestion($conn, 1, $per, $anioGlobal, $idUnidad);
	$data2 = getDAtaQuestion($conn, 2, $per, $anioGlobal, $idUnidad);
	$getEnv = getInfOCarpetasEnv($conn, $idEnlace, $format);
	$envt = $getEnv[0][0]; 
	$envta = $getEnv[0][1];
	$sumTotal = $data[0][3] + $data2[0][3];

	$fisid = getIdFiscaliaEnlace($conn, $idEnlace);
					
					
					if($fisid[0][0]  == 4){
						$idUn = "IN(".$idUnidad.")";
					}else{
						if($fisid[0][0] == 5){
							if($idUnidad != 1031) {
							 $idUn = "IN(159,150,151,53,54,55,56,57,58,59,60,61)";
						 }else{
						 	$idUn = "IN(".$idUnidad.")";
						 }
						}
						if($fisid[0][0] == 1){
							$idUn = "IN(158,100,101,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,92)";
						}
						if($fisid[0][0] == 2){
							$idUn = "IN(153,154,161,16,17,18,19,20,21,22,23,24,25,26)";
							}
						if($fisid[0][0] == 3){
							$idUn = "IN(157,93,102,103,27,28,29,30,31,32)";
							}	
						if($fisid[0][0] == 6){
							$idUn = "IN(152,164,1005,1006,62,63,64,65,66,67,68,69,70)";
							}
						if($fisid[0][0] == 7){
							$idUn = "IN(94,95,96,97,98,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91)";
							}
						if($fisid[0][0] == 8){
							$idUn = "IN(111,112,113,114,115,163,1008,1009,1010,108,109,110)";
							}
						if($fisid[0][0] == 9){
							$idUn = "IN(120,121,122,123,124,125,160)";		
							}				
						if($fisid[0][0] == 10){
							$idUn = "IN(116,117,118,119,162)";		
							}										
					}


					$periodoValidate = '('.$arr[0].','.$arr[1].','.$arr[2].')';
					$totalValidateQuest4 = getDAtaSIREQuestionValidateQuestion($conn,$periodoValidate, $anioGlobal, $idUn);

	?>
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">-->

	<div id="contenido">

		<div class="right_col contentMain" role="main">

			<div style="" class="x_panel principalPanel">

				<div class="x_panel panelCabezera">
					<table border="0" class="alwidth">						
							<tr>								
								<td id="nomostrar" class="imgSelloCabezera" width="5%" height="125"></td>								
								<td width="50%">
											<div class="tituloCentralSegu">
												<div class="titulosCabe1">
													<label class="titulo1" style="color: #686D72;">REGISTRO DE INDICADORES TRIMESTRALES</label>
													<h4> <label id="titfisc" class="titulo2">Dirección de Planeación y Estadística</label></h4>
												</div>
											</div>
								</td>
								<td id="nomostrar" class="imgdgtipeCabezera" width="10%" height="125"></td>
							</tr>
					</table>
				</div>	

				<!--CONTENIDO TRIMESTRAL-->
				<div class="container-fluid">
				  <div class="row">
				    <div class="col-12">
				     <div class="card">
								  <div class="card-body">
								    <h5 class="card-title tituloIndicadores"><strong>INDICADORES ESTRATÉGICOS DEL MODELO DE EVALUACIÓN Y SEGUIMIENTO DE LA CONSOLIDACIÓN DEL SISTEMA DE JUSTICIA PENAL INFORMADOS A LA SECRETARÍA DE GOBERNACIÓN</strong></h5><BR>
								    <h6 class="card-subtitle mb-2 tituloPeriodo"><strong>INFORMACIÓN: <? echo $anioGlobal; ?><br>
																																																						           PERIODO: <? echo $nme; ?></strong></h6>
								    
								  </div>							  
				    	<div class="botonAyuda">
				    	 <!--<button type="button" class="botonAcciones" id="ayudaOPC"  onclick="generarExcel()">Generar Excel</button> -->	
										<button type="button" class="botonAcciones" id="ayudaOPC"  onclick="showModalAyuda(1)">Ayuda</button>	
										<button type="button" class="botonAcciones"  onclick = "generateReport(<?php echo $anioGlobal.','.$per.','.$idUnidad.','.$idEnlace ?>)" <? if($envt == 0){ echo "disabled"; } ?>>Descargar Reporte</button>
										<? if($envt == 0){  ?>
										<button type="button" class="botonAcciones"  onclick="enviarDPEtrim(<? echo $idEnlace; ?>, <? echo $anioGlobal; ?>, <? echo $format; ?>, <? echo $per; ?>, <? echo $idUnidad; ?>)">Enviar a DPE</button> <? } ?>
										<? if($envt == 1 && $envta == 0){  ?>
										<button type="button" data-toggle="modal" href="#myModaSubirArchivoUser" class="botonAcciones"  onclick="subirArchivoEnlace(<? echo $idUnidad; ?>, <? echo $per; ?>, <? echo $anioGlobal; ?> , <? echo $idEnlace; ?>,<? echo $format; ?>);">Subir Archivo</button> <? } ?>

									</div><br>	    
								</div>
				    </div>
				  </div><BR>

 					<!--SECCION PREGUNTA-->
				  <div class="row">
				  	<div class="col-12">
				  		<div class="card" >
				  			<div class="card-body" id="ajaxContainerQUes">
				  				<h5 class="card-title tituloPregunta">Pregunta 1: Número de denuncias, querellas u otros requisitos </h5><br>
				<div class="textoPregunta" >
					<ul>
						<li style="list-style-type: circle !important">
							¿Cuál es el número de <strong>denuncias, querellas u otros requisitos</strong> equivalentes que se recibieron en la Fiscalía General de la entidad federativa (incluyendo las recibidas en los Centros de Justicia para Mujeres) durante el periodo de los meses de <?php echo "$m1, $m2 y $m3" ?> del <?php echo "$anioGlobal"?>.
						</li>
					</ul>
				</div><br><hr><br>
				<table class="tableTrimes">
					<thead>
						<tr>
							<th scope="col">No.</th>
							<th scope="col">Denuncias / Querellas / Otros Requisitos Equivalentes</th>
							<th scope="col"><? echo $m1; ?></th>
							<th scope="col"><? echo $m2; ?></th>
							<th scope="col"><? echo $m3; ?></th>
							<th scope="col" style="background-color: #C09F77;">Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">1.1</th>
							<td style="text-align: left;">Denuncias</td>
							<td><input type="number" value="<? echo $data[0][0]; ?>" id="p1m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data[0][1]; ?>" id="p1m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data[0][2]; ?>" id="p1m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data[0][3]; ?>" id="p1Tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">1.2</th>
							<td style="text-align: left;">Querellas u otros requisitos equivalentes</td>
							<td><input type="number" value="<? echo $data2[0][0]; ?>" id="p2m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data2[0][1]; ?>" id="p2m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data2[0][2]; ?>" id="p2m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data2[0][3]; ?>" id="p2Tot" readonly></td>
							<input id="totalValidateQuest4" name="totalValidateQuest4" type="hidden" value="<?php echo $totalValidateQuest4[0][0]; ?>">
						</tr>
						<tr>
						 <th style=" border: inset 0pt" scope="row"></th>
							<td style=" border: inset 0pt"></td>
							<td style=" border: inset 0pt"></td>
							<td style=" border: inset 0pt"></td>
							<td style=" border: inset 0pt"><strong>TOTAL:</strong></td>
							<td class="blockInp"><strong><?php if($sumTotal != null){ echo $sumTotal; } ?></strong></td>
						</tr>
						</tr>
					</tbody>
				</table><br>
				<div class="botonGuardar">
					<? if($envt == 0){ ?>
					<button type="button" class="btn btn-success" id="guardarPregunta" onclick="saveQuest1(1, <? echo $per; ?>, <? echo $anioGlobal; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)">GUARDAR</button> <? } ?>
				</div>
								</div>
							</div>
						</div>
					</div><br>
					<!--SECCION PREGUNTA-->
					<!--SECCION PAGINADOR-->
					<div class="row">
				    <div class="col-12">
				     <div class="card">
								  <div class="card-body2">
								  				<div class="circlesContainer" id="circlesContainer">
								  					<?  
								  							$arrQue2 = array(3, 4); $validaQuest2 = validaQuest($conn, $arrQue2, $per, $anioGlobal, $idUnidad);
								  							$arrQue4 = array(8, 9); $validaQuest4 = validaQuest($conn, $arrQue4, $per, $anioGlobal, $idUnidad);
								  							$arrQue1 = array(1, 2); $validaQuest1 = validaQuest($conn, $arrQue1, $per, $anioGlobal, $idUnidad);
								  							$arrQue3 = array(5, 6, 7); $validaQuest3 = validaQuest($conn, $arrQue3, $per, $anioGlobal, $idUnidad);
								  							$arrQue3 = array(5, 6, 7); $validaQuest3 = validaQuest($conn, $arrQue3, $per, $anioGlobal, $idUnidad);
								  							$arrQue5 = array(10, 11, 12, 13, 14); $validaQuest5 = validaQuest($conn, $arrQue5, $per, $anioGlobal, $idUnidad);
								  							$arrQue6 = array(15,16,17); $validaQuest6 = validaQuest($conn, $arrQue6, $per, $anioGlobal, $idUnidad);
								  							$arrQue7 = array(18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33); $validaQuest7 = validaQuest($conn, $arrQue7, $per, $anioGlobal, $idUnidad);
								  							$arrQue8 = array(34,35,36,37,38,39,40,41,42,43,44,45,46,47); $validaQuest8 = validaQuest($conn, $arrQue8, $per, $anioGlobal, $idUnidad);
								  							$arrQue9 = array(48,49,50,51); $validaQuest9 = validaQuest($conn, $arrQue9, $per, $anioGlobal, $idUnidad);
								  							$arrQue10 = array(52,53,54,55); $validaQuest10 = validaQuest($conn, $arrQue10, $per, $anioGlobal, $idUnidad); 

								  					 ?>
								    				<table class="tablecircles">
								    						<tr>
								    								<td><button onclick="getQUestionAjax(1,<? echo $per; ?>,<? echo $anioGlobal; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" class="circle <? if($validaQuest1 == 1){ echo "circleOk"; }else{ echo "circleNone"; } ?>"><h4>1</h4></button></td>
								    								<td><button onclick="getQUestionAjax(2,<? echo $per; ?>,<? echo $anioGlobal; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" class="circle <? if($validaQuest2 == 1){ echo "circleOk"; }else{ echo "circleNone"; } ?>"><h4>2</h4></button></td>
								    								<td><button onclick="getQUestionAjax(3,<? echo $per; ?>,<? echo $anioGlobal; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" class="circle <? if($validaQuest3 == 1){ echo "circleOk"; }else{ echo "circleNone"; } ?>"><h4>3</h4></button></td>
								    								<td><button onclick="getQUestionAjax(4,<? echo $per; ?>,<? echo $anioGlobal; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" class="circle <? if($validaQuest4 == 1){ echo "circleOk"; }else{ echo "circleNone"; } ?>"><h4>4</h4></button></td>
								    								<td><button onclick="getQUestionAjax(5,<? echo $per; ?>,<? echo $anioGlobal; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" class="circle <? if($validaQuest5 == 1){ echo "circleOk"; }else{ echo "circleNone"; } ?>"><h4>5</h4></button></td>	
								    								<td><button onclick="getQUestionAjax(6,<? echo $per; ?>,<? echo $anioGlobal; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" class="circle <? if($validaQuest6 == 1){ echo "circleOk"; }else{ echo "circleNone"; } ?>"><h4>6</h4></button></td>
								    								<td><button onclick="getQUestionAjax(7,<? echo $per; ?>,<? echo $anioGlobal; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" class="circle <? if($validaQuest7 == 1){ echo "circleOk"; }else{ echo "circleNone"; } ?>"><h4>7</h4></button></td>
								    								<td><button onclick="getQUestionAjax(8,<? echo $per; ?>,<? echo $anioGlobal; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" class="circle <? if($validaQuest8 == 1){ echo "circleOk"; }else{ echo "circleNone"; } ?>"><h4>8</h4></button></td>
								    								<td><button onclick="getQUestionAjax(9,<? echo $per; ?>,<? echo $anioGlobal; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" class="circle <? if($validaQuest9 == 1){ echo "circleOk"; }else{ echo "circleNone"; } ?>"><h4>9</h4></button></td>
								    								<td><button onclick="getQUestionAjax(10,<? echo $per; ?>,<? echo $anioGlobal; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" class="circle <? if($validaQuest10 == 1){ echo "circleOk"; }else{ echo "circleNone"; } ?>"><h4>10</h4></button></td>
								    						</tr>
								    				</table>	</div>							    
								  </div>
								</div>
				    </div>
				  </div>
					<!--SECCION PAGINADOR-->
					 <!--MODAL AYUDA-->
				  <div class="modal fade bs-example-modal-sm" id="modalAyuda" role="dialog" data-backdrop="static" data-keyboard="false">
							<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 55%; margin-top: 0.5%;">
								<div class="modal-content" style="">
									<div id="contModalAyuda">
										
									</div>
								</div>
							</div>
						</div>
						<!--MODAL AYUDA-->

				</div>
				<!--CONTENIDO TRIMESTRAL-->
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



		<div class="modal fade" id="modalNucsTrimes" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
     					
						<div id="contentMod"></div>

    </div>
  </div>
</div>

<div class="modal fade" id="modalNucsTrimeShow" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
     					
						<div id="contentModShow"></div>

    </div>
  </div>
</div>

		


	</html>