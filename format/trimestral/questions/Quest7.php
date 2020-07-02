
				<? 
					include ("../../../Conexiones/Conexion.php");
					include ("../../../Conexiones/conexionSicap.php");
			include("../../../funcioneTrimes.php");
			include("../../../funciones.php");	

					if (isset($_GET["per"])){ $per = $_GET["per"]; }
					if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
					if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
					if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }

					if($per == 1){ $m1 = "Enero"; $m2 = "Febrero"; $m3 = "Marzo"; $nme = "Enero - Marzo"; $arr = array(1,2,3); $per1 = "IN(1,2,3)"; }
					if($per == 2){ $m1 = "Abril"; $m2 = "Mayo"; $m3 = "Junio"; $nme = "Abril - Junio"; $arr = array(4,5,6); $per1 = "IN(4,5,6)"; }
					if($per == 3){ $m1 = "Julio"; $m2 = "Agosto"; $m3 = "Septiembre"; $nme = "Julio - Septiembre"; $arr = array(7,8,9); $per1 = "IN(7,8,9)"; }
					if($per == 4){ $m1 = "Octubre"; $m2 = "Noviembre"; $m3 = "Diciembre"; $nme = "Octubre - Diciembre"; $arr = array(10,11,12); $per1 = "IN(10,11,12)"; }

		
					$data7 = getDAtaQuestion($conn, 24, $per, $anio, $idUnidad);
					$data8 = getDAtaQuestion($conn, 25, $per, $anio, $idUnidad);
					$data9 = getDAtaQuestion($conn, 26, $per, $anio, $idUnidad);
					$data10 = getDAtaQuestion($conn, 27, $per, $anio, $idUnidad);
					
					$data12 = getDAtaQuestion($conn, 29, $per, $anio, $idUnidad);
					$data13 = getDAtaQuestion($conn, 30, $per, $anio, $idUnidad);
					$data14 = getDAtaQuestion($conn, 31, $per, $anio, $idUnidad);
					$data15 = getDAtaQuestion($conn, 32, $per, $anio, $idUnidad);
					$data16 = getDAtaQuestion($conn, 33, $per, $anio, $idUnidad);
					$getEnv = getInfOCarpetasEnv($conn, $idEnlace, 11);
					$envt = $getEnv[0][0];
					$fisid = getIdFiscaliaEnlace($conn, $idEnlace);

					if($fisid[0][0]  == 4){
						$idUn = "IN(".$idUnidad.")";
					}else{
						if($fisid[0][0] == 5){
							$idUn = "IN(159,150,151,53,54,55,56,57,58,59,60,61)";
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
							$idUn = "IN(152,,164,1005,1006,62,63,64,65,66,67,68,69,70)";
							}
						if($fisid[0][0] == 7){
							$idUn = "IN(94,95,96,97,98,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91)";
							}
						if($fisid[0][0] == 8){
							$idUn = "IN(111,,112,113,114,115,163,1008,1009,108,109,110)";
							}
						if($fisid[0][0] == 9){
							$idUn = "IN(120,121,122,123,124,125,160)";		
							}				
						if($fisid[0][0] == 10){
							$idUn = "IN(116,117,118,119,162)";		
							}										
					}

					$dataEnlaces = getDataEnlacesByIdUnidad($conn, $idUn);
				?>


				<h5 class="card-title tituloPregunta">Pregunta 7: Procedimientos Iniciados 2020. echo <? echo $dataEnlaces[0][1]; ?></h5><br>
				<div class="textoPregunta" >
					<ul>
						<li style="list-style-type: circle !important">
							<strong>¿Cuántos procedimientos</strong> han realizado los agentes del Ministerio Público derivados de las carpetas de Investigación iniciadas en el año 2020 y en qué estatus se encuentran desde su inicio hasta el auto de vinculación a proceso dentro de los rubros señalados, conforme los registros de la  Fiscalía General de la entidad federativa en los cortes referidos?
						</li>
					</ul>
				</div><br><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
							 <img src="images/warning.png"  class="imgWarning" alt="">
							 	Para efectos de esta pregunta, debe considerarse que una carpeta de investigación puede derivar simultáneamente en varios procedimientos para definir la vía correspondiente para su terminación dentro del proceso penal, conforme la relación víctimas/ofendidos, imputados y delitos involucrados. 
							</div>
						</li>
					</ul>
				</div><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
							 En este sentido, los procedimientos que han realizado los agentes del Ministerio Público se refieren al número de derivaciones que simultáneamente llevaron a cabo por cada una de las carpetas de investigación iniciadas para definir la vía correspondiente para su terminación dentro del proceso penal. El estatus es la situación que guardan dichos procedimientos en un momento dentro de la etapa de investigación. 
							</div>
						</li>
					</ul>
				</div><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
							 	<strong>Ejemplo:</strong> En enero del año 2020 se inició una carpeta de investigación con dos imputados y un ofendido. Al 30 de marzo del año 2020, esa misma carpeta ha derivado en dos procedimientos: mediante un procedimiento se logró llegar a un acuerdo reparatorio entre la víctima y uno de los imputados, mientras que en otro procedimiento el segundo imputado se encuentra vinculado a proceso. En este caso, debe reportarse el estatus de ambos procedimientos, aun cuando pertenezcan a la misma carperta de investigación. 
							</div>
						</li>
					</ul>
				</div><br><hr><br>
				<table class="tableTrimes">
					<thead>
						<tr>
							<th scope="col">No.</th>
							<th scope="col">Estatus de los Procedimientos Derivados de las CII en 2020</th>
							<th scope="col"><? echo $m1; ?></th>
							<th scope="col"><? echo $m2; ?></th>
							<th scope="col"><? echo $m3; ?></th>
							<th scope="col" style="background-color: #C09F77;">Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">7.1</th>
							<td style="text-align: left;">Determinados en archivo temporal</td>
							<?
									$tota = 0; $tota1 = 0;
									for ($o=0; $o < sizeof($arr) ; $o++) { 

												$data = getDAtaSIREQuestionEstatus($conSic , $arr[$o] , $anio, $idUn, 5, $per1);
												if($o == 2){	$dataEnviados = getDataEnlaceMesValidaEnviado($conn, $arr[2], $anio, $idEnlace, 1); }
												$tota = $tota + $data[0][0];
												if(is_null($data[0][0])){ $data[0][0] = 0; }
												?>
													<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>"><input type="number" value="<? 
													
													if($idUnidad == 1001){ echo ""; }else {if($o == 2 && $dataEnviados[0][0] == 0){ 
														echo " "; 
												  }else {
												  	echo $data[0][0];
												  } }?>" id="p18m<? echo $o+1; ?>" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?>></td>
												<?										
									}
							?>	
							<td class="blockInp"><input type="number" value="<? echo $tota; ?>" id="p18tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">7.2</th>
							<td style="text-align: left;">Determinados como abstención de investigar</td>
							<?
									$tota = 0; $tota1 = 0;
									for ($o=0; $o < sizeof($arr) ; $o++) { 

												$data = getDAtaSIREQuestionEstatus($conSic , $arr[$o] , $anio, $idUn, 2, $per1);
												if($o == 2){	$dataEnviados = getDataEnlaceMesValidaEnviado($conn, $arr[2], $anio, $idEnlace, 1); }
												$tota = $tota + $data[0][0];
												if(is_null($data[0][0])){ $data[0][0] = 0; }
												?>
													<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>"><input type="number" value="<?if($idUnidad == 1001){ echo ""; }else {if($o == 2 && $dataEnviados[0][0] == 0){ echo " "; }else {echo $data[0][0];}} ?>" id="p19m<? echo $o+1; ?>" readonly></td>
												<?										
									}
							?>	
							<td class="blockInp"><input type="number" value="<? echo $tota; ?>" id="p19tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">7.3</th>
							<td style="text-align: left;">Determinados como no ejercicio de la acción penal</td>
							<?
									$tota = 0; $tota1 = 0;
									for ($o=0; $o < sizeof($arr) ; $o++) { 

												$data = getDAtaSIREQuestionEstatus($conSic , $arr[$o] , $anio, $idUn, 20, $per1);
												if($o == 2){	$dataEnviados = getDataEnlaceMesValidaEnviado($conn, $arr[2], $anio, $idEnlace, 1); }
												$tota = $tota + $data[0][0];
												if(is_null($data[0][0])){ $data[0][0] = 0; }
												?>
													<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>"><input type="number" value="<?if($idUnidad == 1001){ echo ""; }else {if($o == 2 && $dataEnviados[0][0] == 0){ echo " "; }else {echo $data[0][0];}} ?>" id="p20m<? echo $o+1; ?>" readonly></td>
												<?										
									}
							?>	
							<td class="blockInp"><input type="number" value="<? echo $tota; ?>" id="p20tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">7.4</th>
							<td style="text-align: left;">Determinados por criterio de oportunidad</td>
							<?
									$tota = 0; $tota1 = 0;
									for ($o=0; $o < sizeof($arr) ; $o++) { 

												$data = getDAtaSIREQuestionEstatus($conSic , $arr[$o] , $anio, $idUn, 25, $per1);
												if($o == 2){	$dataEnviados = getDataEnlaceMesValidaEnviado($conn, $arr[2], $anio, $idEnlace, 1); }
												$tota = $tota + $data[0][0];
												if(is_null($data[0][0])){ $data[0][0] = 0; }
												?>
													<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>"><input type="number" value="<?if($idUnidad == 1001){ echo ""; }else {if($o == 2 && $dataEnviados[0][0] == 0){ echo " "; }else {echo $data[0][0];}} ?>" id="p21m<? echo $o+1; ?>" readonly></td>
												<?										
									}
							?>	
							<td class="blockInp"><input type="number" value="<? echo $tota; ?>" id="p21tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">7.5</th>
							<td style="text-align: left;">Por incompetencia</td>
							<?
									$tota = 0; $tota1 = 0;
									for ($o=0; $o < sizeof($arr) ; $o++) { 

												$data = getDAtaSIREQuestionEstatus($conSic , $arr[$o] , $anio, $idUn, 21, $per1);
												if($o == 2){	$dataEnviados = getDataEnlaceMesValidaEnviado($conn, $arr[2], $anio, $idEnlace, 1); }
												$tota = $tota + $data[0][0];
												if(is_null($data[0][0])){ $data[0][0] = 0; }
												?>
													<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>"><input type="number" value="<?if($idUnidad == 1001){ echo ""; }else {if($o == 2 && $dataEnviados[0][0] == 0){ echo " "; }else {echo $data[0][0];}} ?>" id="p22m<? echo $o+1; ?>" readonly></td>
												<?										
									}
							?>	
							<td class="blockInp"><input type="number" value="<? echo $tota; ?>" id="p22tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">7.6</th>
							<td style="text-align: left;">Por acumulación</td>
							<?
									$tota = 0; $tota1 = 0;
									for ($o=0; $o < sizeof($arr) ; $o++) { 

												$data = getDAtaSIREQuestionEstatus($conSic , $arr[$o] , $anio, $idUn, 3, $per1);
												if($o == 2){	$dataEnviados = getDataEnlaceMesValidaEnviado($conn, $arr[2], $anio, $idEnlace, 1); }
												$tota = $tota + $data[0][0];
												if(is_null($data[0][0])){ $data[0][0] = 0; }
												?>
													<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>"><input type="number" value="<?if($idUnidad == 1001){ echo ""; }else {if($o == 2 && $dataEnviados[0][0] == 0){ echo " "; }else {echo $data[0][0];}} ?>" id="p23m<? echo $o+1; ?>" readonly></td>
												<?										
									}
							?>	
							<td class="blockInp"><input type="number" value="<? echo $tota; ?>" id="p23tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">7.7</th>
							<td style="text-align: left;">Por sobreseimiento ordenado por el Juez de Control antes de la vinculación a proceso</td>
							<td><input type="number" value="<? echo $data7[0][0]; ?>" id="p24m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data7[0][1]; ?>" id="p24m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data7[0][2]; ?>" id="p24m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data7[0][3]; ?>" id="p24tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">7.8</th>
							<td style="text-align: left;">Por otra causa que exiga la acción penal</td>
							<td><input type="number" value="<? echo $data8[0][0]; ?>" id="p25m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data8[0][1]; ?>" id="p25m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data8[0][2]; ?>" id="p25m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data8[0][3]; ?>" id="p25tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">7.9</th>
							<td style="text-align: left;">Otra decisión/terminación que establezca el código penal de la entidad federativa</td>
							<td><input type="number" value="<? echo $data9[0][0]; ?>" id="p26m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data9[0][1]; ?>" id="p26m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data9[0][2]; ?>" id="p26m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data9[0][3]; ?>" id="p26tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">7.10</th>
							<td style="text-align: left;">En trámite en la etapa de investigación (antes del auto de vinculación a proceso).</td>
							<td><input type="number" value="<? echo $data10[0][0]; ?>" id="p27m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data10[0][1]; ?>" id="p27m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data10[0][2]; ?>" id="p27m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data10[0][3]; ?>" id="p27tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">7.11</th>
							<td style="text-align: left;">Vinculados a proceso</td>
							<?
									$tota = 0; $tota1 = 0;
									for ($o=0; $o < sizeof($arr) ; $o++) { 
                   
												$data = getDAtaSIREQuestionEstatus($conSic , $arr[$o] , $anio, $idUn, 19, $per1);
												if($o == 2){	$dataEnviados = getDataEnlaceMesValidaEnviado($conn, $arr[2], $anio, $dataEnlaces[0][1], 4); }
												$tota = $tota + $data[0][0];
												if(is_null($data[0][0])){ $data[0][0] = 0; }
												?>
													<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>"><input type="number" value="<?if($idUnidad == 1001){ echo ""; }else {if($o == 2 && $dataEnviados[0][0] == 0){ echo " "; }else {echo $data[0][0];}} ?>" id="p28m<? echo $o+1; ?>" readonly></td>
												<?										
									}
							?>	
							<td class="blockInp"><input type="number" value="<? echo $tota; ?>" id="p28tot" readonly></td>
						</tr>
						<tr>
							<td colspan="6" style="background-color: #7C8B9E; font-size: 20px;"><strong>DERIVADOS A MECANISMOS ALTERNATIVOS (ANTES DEL AUTO DE VINCULACIÓN A PROCESO)</strong></td>
						</tr>
						<tr>
							<th scope="row">7.12</th>
							<td style="text-align: left;">En trámite en el OEMASC sin acuerdo reparatorio</td>
							<td><input type="number" value="<? echo $data12[0][0]; ?>" id="p29m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data12[0][1]; ?>" id="p29m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data12[0][2]; ?>" id="p29m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data12[0][3]; ?>" id="p29tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">7.13</th>
							<td style="text-align: left;">En trámite en el OEMASC con acuerdo reparatorio firmado (en proceso de cumplimiento)</td>
							<td><input type="number" value="<? echo $data13[0][0]; ?>" id="p30m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data13[0][1]; ?>" id="p30m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data13[0][2]; ?>" id="p30m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data13[0][3]; ?>" id="p30tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">7.14</th>
							<td style="text-align: left;">Resueltos (cumplidos) en OEMASC por mediación</td>
							<td><input type="number" value="<? echo $data14[0][0]; ?>" id="p31m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data14[0][1]; ?>" id="p31m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data14[0][2]; ?>" id="p31m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data14[0][3]; ?>" id="p8tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">7.15</th>
							<td style="text-align: left;">Resueltos (cumplidos) en OEMASC por conciliación</td>
							<td><input type="number" value="<? echo $data15[0][0]; ?>" id="p32m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data15[0][1]; ?>" id="p32m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data15[0][2]; ?>" id="p32m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data15[0][3]; ?>" id="p32tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">7.16</th>
							<td style="text-align: left;">Resueltos (cumplidos) en OEMASC por acuerdo reparatorio por junta restaurativa</td>
							<td><input type="number" value="<? echo $data16[0][0]; ?>" id="p33m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data16[0][1]; ?>" id="p33m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data16[0][2]; ?>" id="p33m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data16[0][3]; ?>" id="p33tot" readonly></td>
						</tr>
					</tbody>
				</table><br><br>
				<div class="textoNotaSire" >
					<ul>
						<li style="list-style-type: circle !important" >
								Los reactivos del 7.1 al 7.6, y 7.11 fueron precargados automáticamente correspondiente con la información que fue proporcionada por su unidad en el Sistema Integral de Registro Estadístico (SIRE)<br><br>
						</li>
					</ul>
				</div><br><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
							 <img src="images/warning.png"  class="imgWarning" alt="">
							 	Nota.- La suma de los datos proporcionados en todos los reactivos de esta pregunta (del 7.1 al 7.16) deberán ser iguales o mayores a la suma de los datos proporcionados en todos los reactivos de la pregunta 2, del 2.1 al 2.2 (carpetas de investigación iniciadas por denuncias, querellas u otros requisitos equivalentes recibidos en 2020 y 2019, respectivamente).
							</div>
						</li>
					</ul>
				</div><br><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
							 En el caso de que el Ministerio Público decida la acumulación de procedimientos, solamente se deberá considerar aquellas carpetas que se concluyeron con motivo de su incorporación a otra.
							</div>
						</li>
					</ul>
				</div><br><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
								En caso de que un procedimiento que todavía no haya sido vinculado a proceso se hubiere derivado al OEMASC perteneciente al Poder Judicial por cargas de trabajo u otros motivos, se deberá registrar en este apartado.
							</div>
						</li>
					</ul>
				</div><br><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
							No deberán registrarse los procedimientos derivados al OEMASC dependiente de la Fiscalía cuando éstos hayan sido vinculados a proceso.
							</div>
						</li>
					</ul>
				</div>
				<div class="botonGuardar">
						<? if($envt == 0){ ?> 
					<button type="button" class="btn btn-success" onclick="saveQuest7(7, <? echo $per; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" id="guardarPregunta">GUARDAR</button> <? } ?>
				</div>
			