
				<? 
					include ("../../../Conexiones/Conexion.php");
					include ("../../../Conexiones/conexionSicap.php");
					include ("../../../Conexiones/conexionCMASC.php");

					include("../../../funcioneTrimes.php");
					include("../../../funciones.php");	


					if (isset($_GET["per"])){ $per = $_GET["per"]; }
					if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
					if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
					if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }

					$hasNucs7 = getHasCapturaNucs($conn, $idEnlace);

					if ($per == 1) {
						$m1 = "Enero";
						$mes1 = 1;
						$m2 = "Febrero";
						$mes2 = 2;
						$m3 = "Marzo";
						$mes3 = 3;
						$nme = "Enero - Marzo";
						$arr = array(1,2,3); $per1 = "IN(1,2,3)";
					}
					if ($per == 2) {
						$mes1 = 4;
						$m1 = "Abril";
						$mes2 = 5;
						$m2 = "Mayo";
						$mes3 = 6;
						$m3 = "Junio";
						$nme = "Abril - Junio";
						$arr = array(4,5,6); $per1 = "IN(4,5,6)";
					}
					if ($per == 3) {
						$mes1 = 7;
						$m1 = "Julio";
						$mes2 = 8;
						$m2 = "Agosto";
						$mes3 = 9;
						$m3 = "Septiembre";
						$nme = "Julio - Septiembre";
						$arr = array(7,8,9); $per1 = "IN(7,8,9)";
					}
					if ($per == 4) {
						$mes1 = 10;
						$m1 = "Octubre";
						$mes2 = 11;
						$m2 = "Noviembre";
						$mes3 = 12;
						$m3 = "Diciembre";
						$nme = "Octubre - Diciembre";
						$arr = array(10,11,12); $per1 = "IN(10,11,12)";
					}

					$data1 = getDAtaQuestion($conn, 18, $per, $anio, $idUnidad);
					$data2 = getDAtaQuestion($conn, 19, $per, $anio, $idUnidad);
					$data3 = getDAtaQuestion($conn, 20, $per, $anio, $idUnidad);
					$data4 = getDAtaQuestion($conn, 21, $per, $anio, $idUnidad);
					$data5 = getDAtaQuestion($conn, 22, $per, $anio, $idUnidad);
					$data6 = getDAtaQuestion($conn, 23, $per, $anio, $idUnidad);
	
					$data7 = getDAtaQuestion($conn, 24, $per, $anio, $idUnidad);
					$data8 = getDAtaQuestion($conn, 25, $per, $anio, $idUnidad);
					$data9 = getDAtaQuestion($conn, 26, $per, $anio, $idUnidad);
					$data10 = getDAtaQuestion($conn, 27, $per, $anio, $idUnidad);

					$data11 = getDAtaQuestion($conn, 28, $per, $anio, $idUnidad);

					$data12 = getDAtaQuestion($conn, 29, $per, $anio, $idUnidad);
					$data13 = getDAtaQuestion($conn, 30, $per, $anio, $idUnidad);
					$data14 = getDAtaQuestion($conn, 31, $per, $anio, $idUnidad);
					$data15 = getDAtaQuestion($conn, 32, $per, $anio, $idUnidad);
					$data16 = getDAtaQuestion($conn, 33, $per, $anio, $idUnidad);
					$getEnv = getInfOCarpetasEnv($conn, $idEnlace, 11);
					$envt = $getEnv[0][0];
					$sumTotal = $data1[0][3] + $data2[0][3] + $data3[0][3] + $data4[0][3] + $data5[0][3] + $data6[0][3] + $data7[0][3] + $data8[0][3] + $data9[0][3] +
					            $data10[0][3] + $data11[0][3] + $data12[0][3] + $data13[0][3] + $data14[0][3] + $data15[0][3] + $data16[0][3];

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
							if($idUnidad != 1052) {
								$idUn = "IN(152,164,1005,1006,62,63,64,65,66,67,68,69,70,1050)";
							}else{
								$idUn = "IN(".$idUnidad.")";
							}
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
					

					$dataEnlaces = getDataEnlacesByIdUnidad($conn, $idUn, $idEnlace);

					if( $dataEnlaces[0][0] == 0 && $dataEnlaces[0][1] == 0){  //check if link dont report litigation or folders (CMASC)
						$dataEnlaces[0][0] = $idEnlace;
					}
				?>

   
				<h5 class="card-title tituloPregunta">Pregunta 7: Procedimientos Iniciados <?php echo "$anio";?>. </h5><br>
				<div class="textoPregunta" >
					<ul>
						<li style="list-style-type: circle !important">
							<strong>¿Cuántos procedimientos</strong> han realizado los agentes del Ministerio Público derivados de las carpetas de Investigación iniciadas en el año <?php echo "$anio";?> y en qué estatus se encuentran desde su inicio hasta el auto de vinculación a proceso dentro de los rubros señalados, conforme los registros de la  Fiscalía General de la entidad federativa en los cortes referidos?
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
							 	<strong>Ejemplo:</strong> En enero del año <?php echo "$anio";?> se inició una carpeta de investigación con dos imputados y un ofendido. Al 30 de marzo del año <?php echo "$anio";?>, esa misma carpeta ha derivado en dos procedimientos: mediante un procedimiento se logró llegar a un acuerdo reparatorio entre la víctima y uno de los imputados, mientras que en otro procedimiento el segundo imputado se encuentra vinculado a proceso. En este caso, debe reportarse el estatus de ambos procedimientos, aun cuando pertenezcan a la misma carperta de investigación. 
							</div>
						</li>
					</ul>
				</div><br><hr><br>
				<table class="tableTrimes">
					<thead>
						<tr>
							<th scope="col">No.</th>
							<th scope="col">Estatus de los Procedimientos Derivados de las CII en <?php echo "$anio";?></th>
							<th scope="col">2017</th>
							<th scope="col">2018</th>
							<th scope="col">2019</th>
							<th scope="col">2020</th>
							<th scope="col">2021</th>
							<th scope="col">2022</th>
							<th scope="col">2023</th>
						 <th scope="col">Años Anteriores</th>
							<th scope="col"><? echo $m1; ?></th>
							<th scope="col"><? echo $m2; ?></th>
							<th scope="col"><? echo $m3; ?></th>
							<th scope="col" style="background-color: #C09F77;">Total</th>
						</tr>
					</thead>
					<tbody>
						<? 
						
						$dataQuestAn18 = getDataAnteriores($conn, 18, $idEnlace, $idUnidad, $anio, $per);
						$dataQuestAn19 = getDataAnteriores($conn, 19, $idEnlace, $idUnidad, $anio, $per);
						$dataQuestAn20 = getDataAnteriores($conn, 20, $idEnlace, $idUnidad, $anio, $per);
						$dataQuestAn21 = getDataAnteriores($conn, 21, $idEnlace, $idUnidad, $anio, $per);
						$dataQuestAn22 = getDataAnteriores($conn, 22, $idEnlace, $idUnidad, $anio, $per);
						$dataQuestAn23 = getDataAnteriores($conn, 23, $idEnlace, $idUnidad, $anio, $per);
						$dataQuestAn24 = getDataAnteriores($conn, 24, $idEnlace, $idUnidad, $anio, $per);
						$dataQuestAn25 = getDataAnteriores($conn, 25, $idEnlace, $idUnidad, $anio, $per);
						$dataQuestAn26 = getDataAnteriores($conn, 26, $idEnlace, $idUnidad, $anio, $per);
						$dataQuestAn27 = getDataAnteriores($conn, 27, $idEnlace, $idUnidad, $anio, $per);
						$dataQuestAn28 = getDataAnteriores($conn, 28, $idEnlace, $idUnidad, $anio, $per);
						$dataQuestAn29 = getDataAnteriores($conn, 29, $idEnlace, $idUnidad, $anio, $per);
						$dataQuestAn30 = getDataAnteriores($conn, 30, $idEnlace, $idUnidad, $anio, $per);
						$dataQuestAn31 = getDataAnteriores($conn, 31, $idEnlace, $idUnidad, $anio, $per);
						$dataQuestAn32 = getDataAnteriores($conn, 32, $idEnlace, $idUnidad, $anio, $per);
						$dataQuestAn33 = getDataAnteriores($conn, 33, $idEnlace, $idUnidad, $anio, $per);

						$d10 = getArrayCounts($conn, 24, $idEnlace, $idUnidad, $per, 0);
						$d11 = getArrayCounts($conn, 25, $idEnlace, $idUnidad, $per, 0);
						$d12 = getArrayCounts($conn, 27, $idEnlace, $idUnidad, $per, 0);
				
						$d101 = getCountNucsTrim($conn, $anio, 24, $idEnlace, $idUnidad, $per, $mes1);
						$d102 = getCountNucsTrim($conn, $anio, 24, $idEnlace, $idUnidad, $per, $mes2);
						$d103 = getCountNucsTrim($conn, $anio, 24, $idEnlace, $idUnidad, $per, $mes3);
						$totd10 = $d101[0][0] + $d102[0][0] + $d103[0][0];
				
						$d111 = getCountNucsTrim($conn, $anio, 25, $idEnlace, $idUnidad, $per, $mes1);
						$d112 = getCountNucsTrim($conn, $anio, 25, $idEnlace, $idUnidad, $per, $mes2);
						$d113 = getCountNucsTrim($conn, $anio, 25, $idEnlace, $idUnidad, $per, $mes3);
						$totd11 = $d111[0][0] + $d112[0][0] + $d113[0][0];
				
						$d121 = getCountNucsTrim($conn, $anio, 27, $idEnlace, $idUnidad, $per, $mes1);
						$d122 = getCountNucsTrim($conn, $anio, 27, $idEnlace, $idUnidad, $per, $mes2);
						$d123 = getCountNucsTrim($conn, $anio, 27, $idEnlace, $idUnidad, $per, $mes3);
						$totd12 = $d121[0][0] + $d122[0][0] + $d123[0][0];
				
						$sumTotal = $data1[0][3] + $data2[0][3] + $data3[0][3] + $data4[0][3] + $data5[0][3] + $data6[0][3] + $data7[0][3] + $data8[0][3] + $data9[0][3] +
					$data10[0][3] + $data11[0][3] + $data12[0][3] + $data13[0][3] + $data14[0][3] + $data15[0][3] + $data16[0][3] +$totd10 +$totd11 +$totd12 ;
						
						
						?>
						<tr>
							<th scope="row">7.1</th>
							<td style="text-align: left;">Determinados en archivo temporal</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 5, $per1, 2017); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
								<input type="number" value="<? echo $data[0][0]; ?>" id="1val2017" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
								<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 5, $per1, 2018); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
								<input type="number" value="<? echo $data[0][0]; ?>" id="1val2018" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 5, $per1, 2019); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
								<input type="number" value="<? echo $data[0][0]; ?>" id="1val2019" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 5, $per1, 2020); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
								<input type="number" value="<? echo $data[0][0]; ?>" id="1val2020" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
								<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 5, $per1, 2021); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
								<input type="number" value="<? echo $data[0][0]; ?>" id="1val2021" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 5, $per1, 2022); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
								<input type="number" value="<? echo $data[0][0]; ?>" id="1val2022" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>

							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 5, $per1, 2023); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
								<input type="number" value="<? echo $data[0][0]; ?>" id="1val2023" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
							
							<td class="blockInp">- - -</td>
							<? $datahis = getDAtaSIREQuestionEstatusResto($conn , $anio, $idUn, 5, $per1, $per); ?>
						<!--	<td class="blockInp"><? echo $datahis[0][0]; ?></td>-->
							<?
									$tota = 0; $tota1 = 0;
									for ($o=0; $o < sizeof($arr) ; $o++) { 
												$data = getDAtaSIREQuestionEstatus($conn , $arr[$o] , $anio, $idUn, 5, $per1);
												if($o == 2){	$dataEnviados = getDataEnlaceMesValidaEnviado($conn, $arr[2], $anio, $dataEnlaces[0][0], 1); }
												$tota = $tota + $data[0][0];
												if(is_null($data[0][0])){ $data[0][0] = 0; }
												?>
													<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>"><input type="number" value="<? 
													
													if($idUnidad == 1001){ if(is_null($data1[0][$o])) {echo "";} else{echo $data1[0][$o];} }else {if($o == 2 && $dataEnviados[0][0] == 0){ 
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
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 2, $per1, 2017); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
								<input type="number" value="<? echo $data[0][0]; ?>" id="2val2017" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
								<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 2, $per1, 2018); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
								<input type="number" value="<? echo $data[0][0]; ?>" id="2val2018" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
								<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 2, $per1, 2019); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
								<input type="number" value="<? echo $data[0][0]; ?>" id="2val2019" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
								<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 2, $per1, 2020); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>" >
								<input type="number" value="<? echo $data[0][0]; ?>" id="2val2020" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
								<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 2, $per1, 2021); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>" >
								<input type="number" value="<? echo $data[0][0]; ?>" id="2val2021" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 2, $per1, 2022); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>" >
								<input type="number" value="<? echo $data[0][0]; ?>" id="2val2022" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>

							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 2, $per1, 2023); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>" >
								<input type="number" value="<? echo $data[0][0]; ?>" id="2val2023" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>

							<td class="blockInp">- - -</td>
							<? $datahis = getDAtaSIREQuestionEstatusResto($conn , $anio, $idUn, 2, $per1, $per); ?>
							<!--<td class="blockInp"><? echo $datahis[0][0]; ?></td>-->
							<?
									$tota = 0; $tota1 = 0;
									for ($o=0; $o < sizeof($arr) ; $o++) { 

												$data = getDAtaSIREQuestionEstatus($conn , $arr[$o] , $anio, $idUn, 2, $per1);
												if($o == 2){	$dataEnviados = getDataEnlaceMesValidaEnviado($conn, $arr[2], $anio, $dataEnlaces[0][0], 1); }
												$tota = $tota + $data[0][0];
												if(is_null($data[0][0])){ $data[0][0] = 0; }
												?>
													<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
													
													<input type="number" value="<?if($idUnidad == 1001){ if(is_null($data2[0][$o])) {echo "";} else{echo $data2[0][$o];} }else {if($o == 2 && $dataEnviados[0][0] == 0){ echo " "; }else {echo $data[0][0];}} ?>" id="p19m<? echo $o+1; ?>" 
													
													<? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?>></td>
												<?										
									}
							?>	
							<td class="blockInp"><input type="number" value="<? echo $tota; ?>" id="p19tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">7.3</th>
							<td style="text-align: left;">Determinados como no ejercicio de la acción penal</td>
								<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 20, $per1, 2017); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>" >
								<input type="number" value="<? echo $data[0][0]; ?>" id="3val2017" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 20, $per1, 2018); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
								<input type="number" value="<? echo $data[0][0]; ?>" id="3val2018" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
								<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 20, $per1, 2019); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
								<input type="number" value="<? echo $data[0][0]; ?>" id="3val2019" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 20, $per1, 2020); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
								<input type="number" value="<? echo $data[0][0]; ?>" id="3val2020" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 20, $per1, 2021); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
								<input type="number" value="<? echo $data[0][0]; ?>" id="3val2021" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 20, $per1, 2022); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
								<input type="number" value="<? echo $data[0][0]; ?>" id="3val2022" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>

								<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 20, $per1, 2023); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
								<input type="number" value="<? echo $data[0][0]; ?>" id="3val2023" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>

							<td class="blockInp">- - -</td>
							<? $datahis = getDAtaSIREQuestionEstatusResto($conn , $anio, $idUn, 20, $per1, $per); ?>
							<!--<td class="blockInp"><? echo $datahis[0][0]; ?></td>-->
							<?
									$tota = 0; $tota1 = 0;
									for ($o=0; $o < sizeof($arr) ; $o++) { 

												$data = getDAtaSIREQuestionEstatus($conn , $arr[$o] , $anio, $idUn, 20, $per1);

												if($o == 2){	$dataEnviados = getDataEnlaceMesValidaEnviado($conn, $arr[2], $anio, $dataEnlaces[0][0], 1); }
												$tota = $tota + $data[0][0];
												if(is_null($data[0][0])){ $data[0][0] = 0; }
												?>
													<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
													<input type="number" value="<?if($idUnidad == 1001){ if(is_null($data3[0][$o])) {echo "";} else{echo $data3[0][$o];} }else {if($o == 2 && $dataEnviados[0][0] == 0){ echo " "; }else {echo $data[0][0];}} ?>" id="p20m<? echo $o+1; ?>" 
													
													<? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?>></td>
												<?										
									}
							?>	
							<td class="blockInp"><input type="number" value="<? echo $tota; ?>" id="p20tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">7.4</th>
							<td style="text-align: left;">Determinados por criterio de oportunidad</td>
								<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 25, $per1, 2017); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>" >
								<input type="number" value="<? echo $data[0][0]; ?>" id="4val2017" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 25, $per1, 2018); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>" >
								<input type="number" value="<? echo $data[0][0]; ?>" id="4val2018" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 25, $per1, 2019); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>" >
								<input type="number" value="<? echo $data[0][0]; ?>" id="4val2019" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 25, $per1, 2020); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>" >
								<input type="number" value="<? echo $data[0][0]; ?>" id="4val2020" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 25, $per1, 2021); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>" >
								<input type="number" value="<? echo $data[0][0]; ?>" id="4val2021" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 25, $per1, 2022); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>" >
								<input type="number" value="<? echo $data[0][0]; ?>" id="4val2022" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>

								<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 25, $per1, 2023); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>" >
								<input type="number" value="<? echo $data[0][0]; ?>" id="4val2023" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>

							<td class="blockInp">- - -</td>
							<? $datahis = getDAtaSIREQuestionEstatusResto($conn , $anio, $idUn, 25, $per1, $per); ?>
							<!--<td class="blockInp"><? echo $datahis[0][0]; ?></td>-->
							<?
									$tota = 0; $tota1 = 0;
									for ($o=0; $o < sizeof($arr) ; $o++) { 

												$data = getDAtaSIREQuestionEstatus($conn , $arr[$o] , $anio, $idUn, 25, $per1);
												if($o == 2){	$dataEnviados = getDataEnlaceMesValidaEnviado($conn, $arr[2], $anio, $dataEnlaces[0][0], 1); }
												$tota = $tota + $data[0][0];
												if(is_null($data[0][0])){ $data[0][0] = 0; }
												?>
													<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
													<input type="number" value="<?if($idUnidad == 1001){ if(is_null($data4[0][$o])) {echo "";} else{echo $data4[0][$o];} }else {if($o == 2 && $dataEnviados[0][0] == 0){ echo " "; }else {echo $data[0][0];}} ?>" id="p21m<? echo $o+1; ?>" 
													
													<? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?>></td>
												<?										
									}
							?>	
							<td class="blockInp"><input type="number" value="<? echo $tota; ?>" id="p21tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">7.5</th>
							<td style="text-align: left;">Por incompetencia</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 21, $per1, 2017); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>" >
								<input type="number" value="<? echo $data[0][0]; ?>" id="5val2017" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 21, $per1, 2018); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>" >
								<input type="number" value="<? echo $data[0][0]; ?>" id="5val2018" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 21, $per1, 2019); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>" >
								<input type="number" value="<? echo $data[0][0]; ?>" id="5val2019" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 21, $per1, 2020); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>" >
								<input type="number" value="<? echo $data[0][0]; ?>" id="5val2020" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 21, $per1, 2021); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>" >
								<input type="number" value="<? echo $data[0][0]; ?>" id="5val2021" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 21, $per1, 2022); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>" >
								<input type="number" value="<? echo $data[0][0]; ?>" id="5val2022" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>

								<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 21, $per1, 2023); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>" >
								<input type="number" value="<? echo $data[0][0]; ?>" id="5val2023" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>

							<td class="blockInp">- - -</td>
							<? $datahis = getDAtaSIREQuestionEstatusResto($conn , $anio, $idUn, 21, $per1, $per); ?>
							<!--<td class="blockInp"><? echo $datahis[0][0]; ?></td>-->
							<?
									$tota = 0; $tota1 = 0;
									for ($o=0; $o < sizeof($arr) ; $o++) { 

												$data = getDAtaSIREQuestionEstatus($conn , $arr[$o] , $anio, $idUn, 21, $per1);
												if($o == 2){	$dataEnviados = getDataEnlaceMesValidaEnviado($conn, $arr[2], $anio, $dataEnlaces[0][0], 1); }
												$tota = $tota + $data[0][0];
												if(is_null($data[0][0])){ $data[0][0] = 0; }
												?>
													<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
													<input type="number" value="<?if($idUnidad == 1001){ if(is_null($data5[0][$o])) {echo "";} else{echo $data5[0][$o];} }else {if($o == 2 && $dataEnviados[0][0] == 0){ echo " "; }else {echo $data[0][0];}} ?>" id="p22m<? echo $o+1; ?>" 
													
													<? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?>></td>
												<?										
									}
							?>	
							<td class="blockInp"><input type="number" value="<? echo $tota; ?>" id="p22tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">7.6</th>
							<td style="text-align: left;">Por acumulación</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 3, $per1, 2017); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
								<input type="number" value="<? echo $data[0][0]; ?>" id="6val2017" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 3, $per1, 2018); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
								<input type="number" value="<? echo $data[0][0]; ?>" id="6val2018" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 3, $per1, 2019); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
								<input type="number" value="<? echo $data[0][0]; ?>" id="6val2019" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 3, $per1, 2020); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
								<input type="number" value="<? echo $data[0][0]; ?>" id="6val2020" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 3, $per1, 2021); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
								<input type="number" value="<? echo $data[0][0]; ?>" id="6val2021" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>
							<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 3, $per1, 2022); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
								<input type="number" value="<? echo $data[0][0]; ?>" id="6val2022" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>

								<?
												$data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 3, $per1, 2023); 
												if(is_null($data[0][0])){ $data[0][0] = 0; }
							 ?>
							<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
								<input type="number" value="<? echo $data[0][0]; ?>" id="6val2023" <? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?> >
							</td>

							<td class="blockInp">- - -</td>
							<? $datahis = getDAtaSIREQuestionEstatusResto($conn , $anio, $idUn, 3, $per1, $per); ?>
							<!--<td class="blockInp"><? echo $datahis[0][0]; ?></td>-->
							<?
									$tota = 0; $tota1 = 0;
									for ($o=0; $o < sizeof($arr) ; $o++) { 

												$data = getDAtaSIREQuestionEstatus($conn , $arr[$o] , $anio, $idUn, 3, $per1);
												if($o == 2){	$dataEnviados = getDataEnlaceMesValidaEnviado($conn, $arr[2], $anio, $dataEnlaces[0][0], 1); }
												$tota = $tota + $data[0][0];
												if(is_null($data[0][0])){ $data[0][0] = 0; }
												?>
													<td class="<? if($idUnidad == 1001){ echo ""; }else{ echo "blockInp"; } ?>">
													<input type="number" value="<?if($idUnidad == 1001){ if(is_null($data6[0][$o])) {echo "";} else{echo $data6[0][$o];} }else {if($o == 2 && $dataEnviados[0][0] == 0){ echo " "; }else {echo $data[0][0];}} ?>" id="p23m<? echo $o+1; ?>" 
													
													<? if($idUnidad == 1001){ echo ""; }else{ echo "readonly"; } ?>></td>
												<?										
									}
							?>	
							<td class="blockInp"><input type="number" value="<? echo $tota; ?>" id="p23tot" readonly></td>
							<input style="display: none !important;" type="number" value="0" id="p24m1">
							<input style="display: none !important;" type="number" value="0" id="p24m2">
							<input style="display: none !important;" type="number" value="0" id="p24m3">
						</tr>
						<tr>
							<th scope="row">7.7</th>
							<td style="text-align: left;">Por sobreseimiento ordenado por el Juez de Control antes de la vinculación a proceso</td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2017, <? echo $per; ?>, 24, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[0]; ?><input type="hidden" value="<? echo $d10[0]; ?>" id="7val2017"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2018, <? echo $per; ?>, 24, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[1]; ?><input type="hidden" value="<? echo $d10[1]; ?>" id="7val2018"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2019, <? echo $per; ?>, 24, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[2]; ?><input type="hidden" value="<? echo $d10[2]; ?>" id="7val2019"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2020, <? echo $per; ?>, 24, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[3]; ?><input type="hidden" value="<? echo $d10[3]; ?>" id="7val2020"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2021, <? echo $per; ?>, 24, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[4]; ?><input type="hidden" value="<? echo $d10[4]; ?>" id="7val2021"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2022, <? echo $per; ?>, 24, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[5]; ?><input type="hidden" value="<? echo $d10[5]; ?>" id="7val2022"></td>	

							<td class="cPo" onclick="loaNucTrimeShow(0,2023, <? echo $per; ?>, 24, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[6]; ?><input type="hidden" value="<? echo $d10[6]; ?>" id="7val2023"></td>	

							<td class="cPo" onclick="loaNucTrimes(0,0, <? echo $per; ?>, 24, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)">Capturar</td>

							<td class="cPo" onclick="loaNucTrimes(<? echo $mes1; ?>,<? echo $anio; ?>, <? echo $per; ?>, 24, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d101[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes2; ?>,<? echo $anio; ?>, <? echo $per; ?>, 24, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d102[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes3; ?>,<? echo $anio; ?>, <? echo $per; ?>, 24, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d103[0][0]; ?></td>
							<td class="blockInp"><input type="number" value="<? echo $totd10; ?>" id="p10tot" readonly><input style="display: none !important;" type="number" value="0" id="p24tot"></td>
						</tr>
						<tr>
							<th scope="row">7.8</th>
							<input style="display: none !important;" type="number" value="0" id="p25m1">
							<input style="display: none !important;" type="number" value="0" id="p25m2">
							<input style="display: none !important;" type="number" value="0" id="p25m3">
							<td style="text-align: left;">Por otra causa que extinga la acción penal</td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2017, <? echo $per; ?>, 25, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[0]; ?><input type="hidden" value="<? echo $d11[0]; ?>" id="8val2017"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2018, <? echo $per; ?>, 25, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[1]; ?><input type="hidden" value="<? echo $d11[1]; ?>" id="8val2018"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2019, <? echo $per; ?>, 25, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[2]; ?><input type="hidden" value="<? echo $d11[2]; ?>" id="8val2019"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2020, <? echo $per; ?>, 25, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[3]; ?><input type="hidden" value="<? echo $d11[3]; ?>" id="8val2020"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2021, <? echo $per; ?>, 25, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[4]; ?><input type="hidden" value="<? echo $d11[4]; ?>" id="8val2021"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2022, <? echo $per; ?>, 25, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[5]; ?><input type="hidden" value="<? echo $d11[5]; ?>" id="8val2022"></td>

							<td class="cPo" onclick="loaNucTrimeShow(0,2023, <? echo $per; ?>, 25, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[6]; ?><input type="hidden" value="<? echo $d11[6]; ?>" id="8val2023"></td>


							<td class="cPo" onclick="loaNucTrimes(0,0, <? echo $per; ?>, 25, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)">Capturar</td>

							<td class="cPo" onclick="loaNucTrimes(<? echo $mes1; ?>,<? echo $anio; ?>, <? echo $per; ?>, 25, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d111[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes2; ?>,<? echo $anio; ?>, <? echo $per; ?>, 25, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d112[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes3; ?>,<? echo $anio; ?>, <? echo $per; ?>, 25, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d113[0][0]; ?></td>
							<td class="blockInp"><input type="number" value="<? echo $totd11; ?>" id="p11tot" readonly><input style="display: none !important;" type="number" value="0" id="p25tot"></td>
						</tr>
						<tr>
							<th scope="row">7.9</th>
							<td style="text-align: left;">Otra decisión/terminación que establezca el código penal de la entidad federativa</td>
							<td class="blockInp"><input type="number" value="0" id="9val2017" readonly></td>
							<td class="blockInp"><input type="number" value="0" id="9val2018" readonly></td>
							<td class="blockInp"><input type="number" value="0" id="9val2019" readonly></td>
							<td class="blockInp"><input type="number" value="0" id="9val2020" readonly></td>
							<td class="blockInp"><input type="number" value="0" id="9val2021" readonly></td>
							<td class="blockInp"><input type="number" value="0" id="9val2022" readonly></td>
							<td class="blockInp"><input type="number" value="0" id="9val2023" readonly></td>
							<td class="blockInp">- - -</td>
							<td class="blockInp"><input type="number" value="0" id="p26m1" <? if($envt == 1 && $idUnidad != 1001){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="0" id="p26m2" <? if($envt == 1 && $idUnidad != 1001){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="0" id="p26m3" <? if($envt == 1 && $idUnidad != 1001){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="0" id="p26tot" readonly></td>
				
						</tr>
						<tr>
							<th scope="row">7.10</th>
							<!--
							<input style="display: none !important;" type="number" value="0" id="p27m1">
							<input style="display: none !important;" type="number" value="0" id="p27m2">
							<input style="display: none !important;" type="number" value="0" id="p27m3">-->
							<?php 				if($hasNucs7[0][0] == 0){							?>																																																														
                <td style="text-align: left;">En trámite en la etapa de investigación (antes del auto de vinculación a proceso).</td>
                <td><input type="number" value="<? echo $dataQuestAn27[0][0]; ?>" id="10val2017"></td>
                <td><input type="number" value="<? echo $dataQuestAn27[0][1]; ?>" id="10val2018"></td>
                <td><input type="number" value="<? echo $dataQuestAn27[0][2]; ?>" id="10val2019"></td>
                <td><input type="number" value="<? echo $dataQuestAn27[0][3]; ?>" id="10val2020"></td>
                <td><input type="number" value="<? echo $dataQuestAn27[0][4]; ?>" id="10val2021"></td>
																<td><input type="number" value="<? echo $dataQuestAn27[0][5]; ?>" id="10val2022"></td>
																<td><input type="number" value="<? echo $dataQuestAn27[0][6]; ?>" id="10val2023"></td>
                <!--<td class="">--</td>-->
                <td class="">Capturar</td>
                <td><input type="number" value="<? echo $data10[0][0]; ?>" id="p27m1" <? if ($envt == 1 && $idUnidad = !1001) {
                                                                                                                                                                                                                                                                                                            echo "readonly";
                                                                                                                                                                                                                                                                                                        } ?>></td>
                <td><input type="number" value="<? echo $data10[0][1]; ?>" id="p27m2" <? if ($envt == 1 && $idUnidad = !1001) {
                                                                                                                                                                                                                                                                                                            echo "readonly";
                                                                                                                                                                                                                                                                                                        } ?>></td>
                <td><input type="number" value="<? echo $data10[0][2]; ?>" id="p27m3" <? if ($envt == 1 && $idUnidad = !1001) {
                                                                                                                                                                                                                                                                                                            echo "readonly";
                                                                                                                                                                                                                                                                                                        } ?>></td>
                <td class="blockInp"><input type="number" value="<? echo $data10[0][3]; ?>" id="p27tot" readonly></td>
    
                <?php } 
    
                                if($hasNucs7[0][0] == 1){							?>		
                   <input style="display: none !important;" type="number" value="0" id="p27m1">
						            	<input style="display: none !important;" type="number" value="0" id="p27m2">
							          <input style="display: none !important;" type="number" value="0" id="p27m3">																																																										
                <td style="text-align: left;">En trámite en la etapa de investigación (antes del auto de vinculación a proceso).</td>
																<input type="hidden" value="<? echo $d12[0]; ?>" id="10val2017">
                <input type="hidden" value="<? echo $d12[1]; ?>" id="10val2018">
                <input type="hidden" value="<? echo $d12[2]; ?>" id="10val2019">
                <input type="hidden" value="<? echo $d12[3]; ?>" id="10val2020">
                <input type="hidden" value="<? echo $d12[4]; ?>" id="10val2021">
																<input type="hidden" value="<? echo $d12[5]; ?>" id="10val2022">
															 <input type="hidden" value="<? echo $d12[6]; ?>" id="10val2023">
                <td class="cPo" onclick="loaNucTrimeShow(0,2017, <? echo $per; ?>, 27, <? echo $idEnlace; ?>, <? echo $idUnidad; ?>, <? echo $anio; ?>)"><? echo $d12[0]; ?></td>
                                <td class="cPo" onclick="loaNucTrimeShow(0,2018, <? echo $per; ?>, 27, <? echo $idEnlace; ?>, <? echo $idUnidad; ?>, <? echo $anio; ?>)"><? echo $d12[1]; ?></td>
                                <td class="cPo" onclick="loaNucTrimeShow(0,2019, <? echo $per; ?>, 27, <? echo $idEnlace; ?>, <? echo $idUnidad; ?>, <? echo $anio; ?>)"><? echo $d12[2]; ?></td>
                                <td class="cPo" onclick="loaNucTrimeShow(0,2020, <? echo $per; ?>, 27, <? echo $idEnlace; ?>, <? echo $idUnidad; ?>, <? echo $anio; ?>)"><? echo $d12[3]; ?></td>
                                <td class="cPo" onclick="loaNucTrimeShow(0,2021, <? echo $per; ?>, 27, <? echo $idEnlace; ?>, <? echo $idUnidad; ?>, <? echo $anio; ?>)"><? echo $d12[4]; ?></td>
																																<td class="cPo" onclick="loaNucTrimeShow(0,2022, <? echo $per; ?>, 27, <? echo $idEnlace; ?>, <? echo $idUnidad; ?>, <? echo $anio; ?>)"><? echo $d12[5]; ?></td>
																																<td class="cPo" onclick="loaNucTrimeShow(0,2023, <? echo $per; ?>, 27, <? echo $idEnlace; ?>, <? echo $idUnidad; ?>, <? echo $anio; ?>)"><? echo $d12[6]; ?></td>
    
                                <td class="cPo" onclick="loaNucTrimes(0,0, <? echo $per; ?>, 27, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)">Capturar</td>
    
                                <td class="cPo" onclick="loaNucTrimes(<? echo $mes1; ?>,<? echo $anio; ?>, <? echo $per; ?>, 27, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d121[0][0]; ?></td>
                                <td class="cPo" onclick="loaNucTrimes(<? echo $mes2; ?>,<? echo $anio; ?>, <? echo $per; ?>, 27, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d122[0][0]; ?></td>
                                <td class="cPo" onclick="loaNucTrimes(<? echo $mes3; ?>,<? echo $anio; ?>, <? echo $per; ?>, 27, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d123[0][0]; ?></td>
                                <td class="blockInp"><input type="number" value="<? echo $totd12; ?>" id="p10tot" readonly><input style="display: none !important;" type="number" value="0" id="p27tot"></td>
    
                <?php } ?>
						</tr>
						<tr>
							<th scope="row">7.11</th>
							<td style="text-align: left;">Vinculados a proceso</td>
							<?
							  $has_litigation = false;
									$has_captured = false;
									$validaEnlace = $idEnlace;
									$data_sended = false;
									$quest_class = "";
									$quest_value = "";
									$quest_readonly = "";

								if( $dataEnlaces[0][1] != 0){  //check if it has litigation
										$validaEnlace = $dataEnlaces[0][1];
										$has_litigation = true; 
										if($idUn == 'IN(34)'){ $idUn = 'IN(167)'; }
										$idUn = 'IN('.$dataEnlaces[0][2].')'; //Para obtener unidad correcta de litigacion NUEVO***
									}	
									else{ 
										$validaEnlace = $dataEnlaces[0][0];
										$has_litigation = false; 
									}  

									if($has_litigation && $idUnidad != 1001){ //write exclusions
										$quest_class =  "blockInp"; 
										$quest_readonly = "readonly"; 
									} 
									else if($idUnidad == 1001){
										$quest_readonly = "";
									}
							?>
       <!---PREGUNTA 7.11 HISTORICO-->
							<?if($has_litigation){
								$data = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 151, $per1, 2017);
								$quest_value = $data[0][0];
							}else{ $quest_value = $dataQuestAn28[0][0]; } ?>
							<td class="<?php echo $quest_class; ?>" >
								<input type="number" value="<?echo $quest_value; ?>" id="11val2017" <? echo $quest_readonly; ?> >
							</td>
							<? if($has_litigation){
								$data = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 151, $per1, 2018);
								$quest_value = $data[0][0];
							}else{ $quest_value = $dataQuestAn28[0][1]; } ?>
							<td class="<?php echo $quest_class; ?>" >
								<input type="number" value="<? echo $quest_value; ?>" id="11val2018" <? echo $quest_readonly; ?> >
							</td>
							<?if($has_litigation){
								$data = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 151, $per1, 2019);
								$quest_value = $data[0][0];
							}else{ $quest_value = $dataQuestAn28[0][2]; } ?>
							<td class="<?php echo $quest_class; ?>" >
								<input type="number" value="<? echo $quest_value; ?>" id="11val2019" <? echo $quest_readonly; ?> >
							</td>
							<?if($has_litigation){ 
								$data = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 151, $per1, 2020);
								$quest_value = $data[0][0];
							}else{ $quest_value = $dataQuestAn28[0][3]; } ?>
							<td class="<?php echo $quest_class; ?>" >
								<input type="number" value="<? echo $quest_value; ?>" id="11val2020" <? echo $quest_readonly; ?> >
							</td>
							<?if($has_litigation){
								$data = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 151, $per1, 2021);
								$quest_value = $data[0][0];
							}else{ $quest_value = $dataQuestAn28[0][4]; } ?>
							<td class="<?php echo $quest_class; ?>" >
								<input type="number" value="<? echo $quest_value; ?>" id="11val2021" <? echo $quest_readonly; ?> >
							</td>
							<?if($has_litigation){
								$data = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 151, $per1, 2022);
								$quest_value = $data[0][0];
							}else{ $quest_value = $dataQuestAn28[0][5]; } ?>
							<td class="<?php echo $quest_class; ?>" >
								<input type="number" value="<? echo $quest_value; ?>" id="11val2022" <? echo $quest_readonly; ?> >
							</td>
								<?if($has_litigation){
								$data = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 151, $per1, 2023);
								$quest_value = $data[0][0];
							}else{ $quest_value = $dataQuestAn28[0][6]; } ?>
							<td class="<?php echo $quest_class; ?>" >
								<input type="number" value="<? echo $quest_value; ?>" id="11val2023" <? echo $quest_readonly; ?> >
							</td>
							<td class="blockInp">- - -</td>
							<!--- TERMINA PREGUNTA 7.11 HISTORICO-->
							<? $datahis = getDAtaSIREQuestionEstatusResto($conn , $anio, $idUn, 19, $per1, $per); ?>
							<!--<td class="blockInp"><? echo $datahis[0][0]; ?></td>-->
							<?
									$tota = 0; $tota1 = 0;

									$has_litigation = false;
									$has_captured = false;
									$validaEnlace = $idEnlace;
									$data_sended = false;

									if(!is_null($data11)){ //check if the question has something
										$data = $data11;
										$has_captured = true;
									}

									if( $dataEnlaces[0][1] != 0){  //check if it has litigation
										$validaEnlace = $dataEnlaces[0][1];
										$has_litigation = true; 
										if($idUn == 'IN(34)'){ $idUn = 'IN(167)'; }
										$idUn = 'IN('.$dataEnlaces[0][2].')'; //Para obtener unidad correcta de litigacion NUEVO***
									}	
									else{ 
										$validaEnlace = $dataEnlaces[0][0];
										$has_litigation = false; 
									} 

									if(getDataEnlaceMesValidaEnviado($conn, $arr[2], $anio, $validaEnlace, 4) != 0){ //check if last month has sended
										$data_sended = true;
									}

									$quest_class = "";
									$quest_value = "";
									$quest_readonly = "";
									$tota = 0;

									if($has_litigation && $idUnidad != 1001){ //write exclusions
										$quest_class =  "blockInp"; 
										$quest_readonly = "readonly"; 
									} 
									else if($idUnidad == 1001){
										$quest_readonly = "";
									}

									for ($o=0; $o < sizeof($arr) ; $o++) { 
          
										if($has_captured){ //set value if has captured or not

											$quest_value =  $data[0][$o]; 
											$tota += $data[0][$o];

										}

										else{

											if($has_litigation){ 
					
												$data = getDAtaSIREQuestionEstatusLiti($conn , $arr[$o] , $anio, $idUn, 151, $per1);
       
												if($data_sended){ //all trimester sended
													$quest_value = $data[0][0];
													$tota += $data[0][0];
												}
												else if($o != 2){ //last month not sended
													$quest_value = $data[0][0];
													$tota += $data[0][0];
												}
												else{ //put blak if its the last month and has no data sended
													$quest_value = "";
												}

											}
										}

										?>
											<td class="<?php echo $quest_class; ?>">
												<input type="number" value="<?php echo $quest_value; ?>" id="p28m<? echo $o+1; ?>" <? echo $quest_readonly; ?> >
											</td>
										<?										
									}
							?>	
							<td class="blockInp"><input type="number" value="<? echo $tota;  ?>" id="p28tot" readonly></td>
						</tr>
						<tr>
							<td colspan="14" style="background-color: #7C8B9E; font-size: 20px;"><strong>DERIVADOS A MECANISMOS ALTERNATIVOS (ANTES DEL AUTO DE VINCULACIÓN A PROCESO)</strong></td>
						</tr>
						<tr>
							<?php
						
							if($envt != 1 && $idEnlace == 67){

								include("cmasc.php");

								$tot_7_12 = $array_7[12][1]+$array_7[12][2]+$array_7[12][3];

							?>
							<th scope="row">7.12</th>
							<td style="text-align: left;">En trámite en el CMASC sin acuerdo reparatorio</td>
							<td><input type="number" value="<? echo $array_7[12][2017]; ?>" id="12val2017" readonly></td>
							<td><input type="number" value="<? echo $array_7[12][2018]; ?>" id="12val2018" readonly></td>
							<td><input type="number" value="<? echo $array_7[12][2019]; ?>" id="12val2019" readonly></td>
							<td><input type="number" value="<? echo $array_7[12][2020]; ?>" id="12val2020" readonly></td>
							<td><input type="number" value="<? echo $array_7[12][2021]; ?>" id="12val2021" readonly></td>
							<td><input type="number" value="<? echo $array_7[12][2022]; ?>" id="12val2022" readonly></td>
							<td><input type="number" value="<? echo $array_7[12][2023]; ?>" id="12val2023" readonly></td>
							<td class="blockInp">- - -</td>
							<td><input type="number" value="<? echo $array_7[12][1]; ?>" id="p29m1" readonly></td>
							<td><input type="number" value="<? echo $array_7[12][2]; ?>" id="p29m2" readonly></td>
							<td><input type="number" value="<? echo $array_7[12][3]; ?>" id="p29m3" readonly></td>
							<td class="blockInp"><input type="number" value="<? echo $tot_7_12; ?>" id="p29tot" readonly></td>

							<?php
							}
							else{
							?>
							<th scope="row">7.12</th>
							<td style="text-align: left;">En trámite en el CMASC sin acuerdo reparatorio</td>
							<td><input type="number" value="<? echo $dataQuestAn29[0][0]; ?>" id="12val2017"></td>
							<td><input type="number" value="<? echo $dataQuestAn29[0][1]; ?>" id="12val2018"></td>
							<td><input type="number" value="<? echo $dataQuestAn29[0][2]; ?>" id="12val2019"></td>
							<td><input type="number" value="<? echo $dataQuestAn29[0][3]; ?>" id="12val2020"></td>
							<td><input type="number" value="<? echo $dataQuestAn29[0][4]; ?>" id="12val2021"></td>
							<td><input type="number" value="<? echo $dataQuestAn29[0][5]; ?>" id="12val2022"></td>
							<td><input type="number" value="<? echo $dataQuestAn29[0][6]; ?>" id="12val2023"></td>
							<td class="blockInp">- - -</td>
							<td><input type="number" value="<? echo $data12[0][0]; ?>" id="p29m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data12[0][1]; ?>" id="p29m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data12[0][2]; ?>" id="p29m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data12[0][3]; ?>" id="p29tot" readonly></td>
							<?php
							}
							?>
						</tr>
						<tr>
							<th scope="row">7.13</th>
							<td style="text-align: left;">En trámite en el CMASC con acuerdo reparatorio firmado (en proceso de cumplimiento)</td>
							<td><input type="number" value="<? echo $dataQuestAn30[0][0]; ?>" id="13val2017"></td>
							<td><input type="number" value="<? echo $dataQuestAn30[0][1]; ?>" id="13val2018"></td>
							<td><input type="number" value="<? echo $dataQuestAn30[0][2]; ?>" id="13val2019"></td>
							<td><input type="number" value="<? echo $dataQuestAn30[0][3]; ?>" id="13val2020"></td>
							<td><input type="number" value="<? echo $dataQuestAn30[0][4]; ?>" id="13val2021"></td>
							<td><input type="number" value="<? echo $dataQuestAn30[0][5]; ?>" id="13val2022"></td>
							<td><input type="number" value="<? echo $dataQuestAn30[0][6]; ?>" id="13val2023"></td>
							<td class="blockInp">- - -</td>
							<td><input type="number" value="<? echo $data13[0][0]; ?>" id="p30m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data13[0][1]; ?>" id="p30m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data13[0][2]; ?>" id="p30m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data13[0][3]; ?>" id="p30tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">7.14</th>
							<td style="text-align: left;">Resueltos (cumplidos) en CMASC por mediación</td>
							<td><input type="number" value="<? echo $dataQuestAn31[0][0]; ?>" id="14val2017"></td>
							<td><input type="number" value="<? echo $dataQuestAn31[0][1]; ?>" id="14val2018"></td>
							<td><input type="number" value="<? echo $dataQuestAn31[0][2]; ?>" id="14val2019"></td>
							<td><input type="number" value="<? echo $dataQuestAn31[0][3]; ?>" id="14val2020"></td>
							<td><input type="number" value="<? echo $dataQuestAn31[0][4]; ?>" id="14val2021"></td>
							<td><input type="number" value="<? echo $dataQuestAn31[0][5]; ?>" id="14val2022"></td>
							<td><input type="number" value="<? echo $dataQuestAn31[0][6]; ?>" id="14val2023"></td>
							<td class="blockInp">- - -</td>
							<td><input type="number" value="<? echo $data14[0][0]; ?>" id="p31m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data14[0][1]; ?>" id="p31m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data14[0][2]; ?>" id="p31m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data14[0][3]; ?>" id="p8tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">7.15</th>
							<td style="text-align: left;">Resueltos (cumplidos) en CMASC por conciliación</td>
							<td><input type="number" value="<? echo $dataQuestAn32[0][0]; ?>" id="15val2017"></td>
							<td><input type="number" value="<? echo $dataQuestAn32[0][1]; ?>" id="15val2018"></td>
							<td><input type="number" value="<? echo $dataQuestAn32[0][2]; ?>" id="15val2019"></td>
							<td><input type="number" value="<? echo $dataQuestAn32[0][3]; ?>" id="15val2020"></td>
							<td><input type="number" value="<? echo $dataQuestAn32[0][4]; ?>" id="15val2021"></td>
							<td><input type="number" value="<? echo $dataQuestAn32[0][5]; ?>" id="15val2022"></td>
							<td><input type="number" value="<? echo $dataQuestAn32[0][6]; ?>" id="15val2023"></td>
							<td class="blockInp">- - -</td>
							<td><input type="number" value="<? echo $data15[0][0]; ?>" id="p32m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data15[0][1]; ?>" id="p32m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data15[0][2]; ?>" id="p32m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data15[0][3]; ?>" id="p32tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">7.16</th>
							<td style="text-align: left;">Resueltos (cumplidos) en CMASC por acuerdo reparatorio por junta restaurativa</td>
							<td><input type="number" value="<? echo $dataQuestAn33[0][0]; ?>" id="16val2017"></td>
							<td><input type="number" value="<? echo $dataQuestAn33[0][1]; ?>" id="16val2018"></td>
							<td><input type="number" value="<? echo $dataQuestAn33[0][2]; ?>" id="16val2019"></td>
							<td><input type="number" value="<? echo $dataQuestAn33[0][3]; ?>" id="16val2020"></td>
							<td><input type="number" value="<? echo $dataQuestAn33[0][4]; ?>" id="16val2021"></td>
							<td><input type="number" value="<? echo $dataQuestAn33[0][5]; ?>" id="16val2022"></td>
							<td><input type="number" value="<? echo $dataQuestAn33[0][6]; ?>" id="16val2023"></td>
							<td class="blockInp">- - -</td>
							<td><input type="number" value="<? echo $data16[0][0]; ?>" id="p33m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data16[0][1]; ?>" id="p33m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data16[0][2]; ?>" id="p33m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data16[0][3]; ?>" id="p33tot" readonly></td>
						</tr>
						<tr>
						 <th style=" border: inset 0pt" scope="row"></th>
							<td style=" border: inset 0pt"></td>
							<td style=" border: inset 0pt"></td>
							<td style=" border: inset 0pt"></td>
							<td style=" border: inset 0pt"></td>
							<td style=" border: inset 0pt"></td>
							<td style=" border: inset 0pt"></td>
							<td style=" border: inset 0pt"></td>
							<td style=" border: inset 0pt"></td>
							<td style=" border: inset 0pt"></td>
							<td style=" border: inset 0pt"></td>
							<td style=" border: inset 0pt"></td>
							<!--<td style=" border: inset 0pt"></td>-->
							<td style=" border: inset 0pt"><strong>TOTAL:</strong></td>
							<td class="blockInp"><strong><?php if($sumTotal != null){ if($envt != 1 && $idEnlace == 67){echo $sumTotal+$tot_7_12;}else{echo $sumTotal;} }else{echo "0";} ?></strong></td>
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
							 	Nota.- La suma de los datos proporcionados en todos los reactivos de esta pregunta (del 7.1 al 7.16) deberán ser igual a la suma de los datos proporcionados en todos los reactivos de la pregunta 2, del 2.1 al 2.2 (carpetas de investigación iniciadas por denuncias, querellas u otros requisitos equivalentes recibidos en 2020 y 2019, respectivamente).
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
								En caso de que un procedimiento que todavía no haya sido vinculado a proceso se hubiere derivado al CMASC perteneciente al Poder Judicial por cargas de trabajo u otros motivos, se deberá registrar en este apartado.
							</div>
						</li>
					</ul>
				</div><br><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
							No deberán registrarse los procedimientos derivados al CMASC dependiente de la Fiscalía cuando éstos hayan sido vinculados a proceso.
							</div>
						</li>
					</ul>
				</div>
				<div class="botonGuardar">
						<? if($envt == 0){ ?> 
					<button type="button" class="btn btn-success" onclick="saveQuest7(7, <? echo $per; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" id="guardarPregunta">GUARDAR</button> <? } ?>
				</div>
			