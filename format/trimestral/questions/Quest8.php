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

					$data = getDAtaQuestion($conn, 34, $per, $anio, $idUnidad);
					$data2 = getDAtaQuestion($conn, 35, $per, $anio, $idUnidad);
					$data3 = getDAtaQuestion($conn, 36, $per, $anio, $idUnidad);
					$data4 = getDAtaQuestion($conn, 37, $per, $anio, $idUnidad);
					$data5 = getDAtaQuestion($conn, 38, $per, $anio, $idUnidad);
					$data6 = getDAtaQuestion($conn, 39, $per, $anio, $idUnidad);
					$data7 = getDAtaQuestion($conn, 40, $per, $anio, $idUnidad);
					$data8 = getDAtaQuestion($conn, 41, $per, $anio, $idUnidad);
					$data9 = getDAtaQuestion($conn, 42, $per, $anio, $idUnidad);
					$data10 = getDAtaQuestion($conn, 43, $per, $anio, $idUnidad);
					$data11 = getDAtaQuestion($conn, 44, $per, $anio, $idUnidad);
					$data12 = getDAtaQuestion($conn, 45, $per, $anio, $idUnidad);
					$data13 = getDAtaQuestion($conn, 46, $per, $anio, $idUnidad);
					$data14 = getDAtaQuestion($conn, 47, $per, $anio, $idUnidad);
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

				<h5 class="card-title tituloPregunta">Pregunta 8: Procedimientos y Estatus 2020</h5><br>
				<div class="textoPregunta" >
					<ul>
						<li style="list-style-type: circle !important">
							<strong>¿Cuántos procedimientos</strong> se han generado de las vinculaciones a proceso derivadas de las carpetas de investigación iniciadas en el año 2020 y en qué estatus se encuentran dentro de los rubros señalados, conforme los registros de la Fiscalía General de la entidad federativa en los cortes referidos?
						</li>
					</ul>
				</div><br><hr><br>
				<table class="tableTrimes">
					<thead>
						<tr>
							<th scope="col">No.</th>
							<th scope="col">Estatus de las Vinculaciones a Proceso derivadas de las CII en 2020</th>
							<th scope="col"><? echo $m1; ?></th>
							<th scope="col"><? echo $m2; ?></th>
							<th scope="col"><? echo $m3; ?></th>
							<th scope="col" style="background-color: #C09F77;">Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">8.1</th>
							<td style="text-align: left;">En tramite ante el Juez de Control (sin incluir los que se encuentran en trámite por suspensión condicional, por acuerdos reparatorios o por procedimiento abreviado)</td>
							<td><input type="number" value="<? echo $data[0][0]; ?>" id="p34m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data[0][1]; ?>" id="p34m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data[0][2]; ?>" id="p34m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data[0][3]; ?>" id="p34tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">8.2</th>
							<td style="text-align: left;">Determinado por criterio de oportunidad</td>
						<?
									$tota = 0; $tota1 = 0;
									for ($o=0; $o < sizeof($arr) ; $o++) { 

												$data = getDAtaSIREQuestionEstatus($conSic , $arr[$o] , $anio, $idUn, 25, $per1);
												if($o == 2){	$dataEnviados = getDataEnlaceMesValidaEnviado($conn, $arr[2], $anio, $dataEnlaces[0][1], 4); }
												$tota = $tota + $data[0][0];
												if(is_null($data[0][0])){ $data[0][0] = 0; }
												?>
													<td class="blockInp"><input type="number" value="<?if($o == 2 && $dataEnviados[0][0] == 0){ echo " "; }else echo $data[0][0]; ?>" id="p35m<? echo $o+1; ?>" readonly></td>
												<?										
									}
							?>	
							<td class="blockInp"><input type="number" value="<? echo $tota; ?>" id="p35tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">8.3</th>
							<td style="text-align: left;">En trámite por suspensión condicional del proceso aprobada por el Juez de Control (en proceso de cumplimiento)</td>
							<td><input type="number" value="<? echo $data3[0][0]; ?>" id="p36m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data3[0][1]; ?>" id="p36m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data3[0][2]; ?>" id="p36m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data3[0][3]; ?>" id="p36tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">8.4</th>
							<td style="text-align: left;">Cumplida la suspensión condicional del proceso</td>
								<?
									$tota = 0; $tota1 = 0;
									for ($o=0; $o < sizeof($arr) ; $o++) { 

												$data = getDAtaSIREQuestionEstatus($conSic , $arr[$o] , $anio, $idUn, 18, $per1);
												if($o == 2){	$dataEnviados = getDataEnlaceMesValidaEnviado($conn, $arr[2], $anio, $dataEnlaces[0][1], 4); }
												$tota = $tota + $data[0][0];
												if(is_null($data[0][0])){ $data[0][0] = 0; }
												?>
													<td class="blockInp"><input type="number" value="<?if($o == 2 && $dataEnviados[0][0] == 0){ echo " "; }else echo $data[0][0]; ?>" id="p37m<? echo $o+1; ?>" readonly></td>
												<?										
									}
							?>	
							<td class="blockInp"><input type="number" value="<? echo $tota; ?>" id="p37tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">8.5</th>
							<td style="text-align: left;">Resueltos por otras causas de sobreseimiento (sin incluir criterio de oportunidad ni los cumplidos por suspension condicional o por acuerdo reparatorio)</td>
							<td><input type="number" value="<? echo $data5[0][0]; ?>" id="p38m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data5[0][1]; ?>" id="p38m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data5[0][2]; ?>" id="p38m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data5[0][3]; ?>" id="p38tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">8.6</th>
							<td style="text-align: left;">En tramite de procedimiento abreviado</td>
							<td><input type="number" value="<? echo $data6[0][0]; ?>" id="p39m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data6[0][1]; ?>" id="p39m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data6[0][2]; ?>" id="p39m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data6[0][3]; ?>" id="p39tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">8.7</th>
							<td style="text-align: left;">Resueltos por procedimiento abreviado</td>
								<?
									$tota = 0; $tota1 = 0;
									for ($o=0; $o < sizeof($arr) ; $o++) { 

												$data = getDAtaSIREQuestionEstatus($conSic , $arr[$o] , $anio, $idUn, 13, $per1);
												if($o == 2){	$dataEnviados = getDataEnlaceMesValidaEnviado($conn, $arr[2], $anio, $dataEnlaces[0][1], 4); }
												$tota = $tota + $data[0][0];
												if(is_null($data[0][0])){ $data[0][0] = 0; }
												?>
													<td class="blockInp"><input type="number" value="<?if($o == 2 && $dataEnviados[0][0] == 0){ echo " "; }else echo $data[0][0]; ?>" id="p40m<? echo $o+1; ?>" readonly></td>
												<?										
									}
							?>	
							<td class="blockInp"><input type="number" value="<? echo $tota; ?>" id="p40tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">8.8</th>
							<td style="text-align: left;">En trámite ante el Tribunal de Enjuiciamiento (en juicio)</td>
							<td><input type="number" value="<? echo $data8[0][0]; ?>" id="p41m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data8[0][1]; ?>" id="p41m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data8[0][2]; ?>" id="p41m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data8[0][3]; ?>" id="p41tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">8.9</th>
							<td style="text-align: left;">Resueltos por juicio oral</td>
							<td><input type="number" value="<? echo $data9[0][0]; ?>" id="p42m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data9[0][1]; ?>" id="p42m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data9[0][2]; ?>" id="p42m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data9[0][3]; ?>" id="p42tot" readonly></td>
						</tr>
						<tr>
							<td colspan="6" style="background-color: #7C8B9E; font-size: 20px;"><strong>DERIVADOS A MECANISMOS ALTERNATIVOS (DESPUES DE LA VINCULACIÓN A PROCESO)</strong></td>
						</tr>
						<tr>
							<th scope="row">8.10</th>
							<td style="text-align: left;">En trámite en el OEMASC sin acuerdo reparatorio</td>
							<td><input type="number" value="<? echo $data10[0][0]; ?>" id="p43m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data10[0][1]; ?>" id="p43m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data10[0][2]; ?>" id="p43m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data10[0][3]; ?>" id="p43tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">8.11</th>
							<td style="text-align: left;">En trámite en el OEMASC con acuerdo reparatorio firmado (en proceso de cumplimiento)</td>
							<td><input type="number" value="<? echo $data11[0][0]; ?>" id="p44m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data11[0][1]; ?>" id="p44m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data11[0][2]; ?>" id="p44m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data11[0][3]; ?>" id="p44tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">8.12</th>
							<td style="text-align: left;">Resueltos (cumplidos) en OEMASC por mediación</td>
							<td><input type="number" value="<? echo $data12[0][0]; ?>" id="p45m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data12[0][1]; ?>" id="p45m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data12[0][2]; ?>" id="p45m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data12[0][3]; ?>" id="p45tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">8.13</th>
							<td style="text-align: left;">Resueltos (cumplidos) en OEMASC por conciliación</td>
							<td><input type="number" value="<? echo $data13[0][0]; ?>" id="p46m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data13[0][1]; ?>" id="p46m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data13[0][2]; ?>" id="p46m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data13[0][3]; ?>" id="p46tot" readonly></td>
						</tr>
							<tr>
							<th scope="row">8.14</th>
							<td style="text-align: left;">Resueltos (cumplidos) en el OEMASC por acuerdo reparatorio por junta restaurativa</td>
							<td><input type="number" value="<? echo $data14[0][0]; ?>" id="p47m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data14[0][1]; ?>" id="p47m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data14[0][2]; ?>" id="p47m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data14[0][3]; ?>" id="p47tot" readonly></td>
						</tr>
					</tbody>
				</table><br><br>
				<div class="textoNotaSire" >
					<ul>
						<li style="list-style-type: circle !important" >
								Los reactivos 8.2, 8.4 y 8.7 fueron precargados automáticamente correspondiente con la información que fue proporcionada por su unidad en el Sistema Integral de Registro Estadístico (SIRE)<br><br>
						</li>
					</ul>
				</div><br><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
							 <img src="images/warning.png"  class="imgWarning" alt="">
							 	Nota.- La suma de los datos proporcionados en esta pregunta (reactivos 8.1 al 8.14) deberá ser igual o mayor al dato proporcionado en el reactivo 7.11 (procedimientos vinculados a proceso).
							</div>
						</li>
					</ul>
				</div><br><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
							 En caso de que se realicen acuerdos reparatorios a través del OEMASC dependiente de la Fiscalía por que no se cuenta con OEMASC dependiente del Poder Judicial, deberá registrarse en este apartado.
							</div>
						</li>
					</ul>
				</div><br><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
								Si a la fecha de corte de una carpeta de investigación tiene más de un procedimiento en el Órgano Jurisdiccional después de la vinculación a proceso, se deberá registrar casa uno de éstos aun cuando se trate de la misma carpeta de investigación.
							</div>
						</li>
					</ul>
				</div><br><br>
				<div class="botonGuardar">
					<? if($envt == 0){ ?>
					<button type="button" class="btn btn-success" id="guardarPregunta" onclick="saveQuest8(8, <? echo $per; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)">GUARDAR</button> <? } ?>
				</div>
		