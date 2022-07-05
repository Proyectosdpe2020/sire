
					<? 
					include ("../../../Conexiones/Conexion.php");
			include("../../../funcioneTrimes.php");
			include("../../../funciones.php");	

					if (isset($_GET["per"])){ $per = $_GET["per"]; }
					if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
					if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
					if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }
					
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

					$data = getDAtaQuestion($conn, 15, $per, $anio, $idUnidad);
					$data2 = getDAtaQuestion($conn, 16, $per, $anio, $idUnidad);
					$data3 = getDAtaQuestion($conn, 17, $per, $anio, $idUnidad);
					$getEnv = getInfOCarpetasEnv($conn, $idEnlace, 11);
					$envt = $getEnv[0][0]; 
					$sumTotal = $data[0][3] + $data2[0][3] + $data3[0][3];		

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
					$totalValidateQuest_4_1 = getDAtaSIREQuestionValidateQuestion_4_1($conn,$periodoValidate, $anio, $idUn);

					if($per == 2){ $mes1 = 4; $m1 = "Abril"; $mes2 = 5; $m2 = "Mayo"; $mes3 = 6; $m3 = "Junio"; $nme = "Abril - Junio";}
					if($per == 3){ $mes1 = 7; $m1 = "Julio"; $mes2 = 8; $m2 = "Agosto"; $mes3 = 9; $m3 = "Septiembre"; $nme = "Julio - Septiembre";}
					if($per == 4){ $mes1 = 10; $m1 = "Octubre"; $mes2 = 11; $m2 = "Noviembre"; $mes3 = 12; $m3 = "Diciembre";  $nme = "Octubre - Diciembre";}

				?>


				<h5 class="card-title tituloPregunta">Pregunta 6: Número de detenidos en flagrancia <?php echo "$anio";?></h5><br>
				<div class="textoPregunta" >
					<ul>
						<li style="list-style-type: circle !important">
							Cuál es el número de detenidos en flagrancia, por orden de aprehensión o caso urgente derivados de las carpetas de investigación iniciadas en <?php echo "$anio";?>?
						</li>
					</ul>
				</div><br><hr><br>
				<table class="tableTrimes">
					<thead>
						<tr>
							<th scope="col">No.</th>
							<th scope="col">Detenidos de CII en <?php echo "$anio";?></th>
							<th scope="col">2017</th>
							<th scope="col">2018</th>
							<th scope="col">2019</th>
							<th scope="col">2020</th>
							<th scope="col">2021</th>
							<th scope="col">Años Anteriores</th>
							<th scope="col"><? echo $m1; ?></th>
							<th scope="col"><? echo $m2; ?></th>
							<th scope="col"><? echo $m3; ?></th>
							<th scope="col" style="background-color: #C09F77;">Total</th>
						</tr>
					</thead>
					<tbody>
						<? 
						
							$dataQuestAn15 = getDataAnteriores($conn, 15, $idEnlace, $idUnidad, $anio, $per);
							$dataQuestAn16 = getDataAnteriores($conn, 16, $idEnlace, $idUnidad, $anio, $per);
							$dataQuestAn17 = getDataAnteriores($conn, 17, $idEnlace, $idUnidad, $anio, $per);

							$d1 = getArrayCounts($conn, 15, $idEnlace, $idUnidad, $per, 0);
							$d2 = getArrayCounts($conn, 16, $idEnlace, $idUnidad, $per, 0);				
							$d3 = getArrayCounts($conn, 17, $idEnlace, $idUnidad, $per, 0);		

							$d10 = getCountNucsTrim($conn, $anio, 15, $idEnlace, $idUnidad, $per, $mes1);
							$d11 = getCountNucsTrim($conn, $anio, 15, $idEnlace, $idUnidad, $per, $mes2);
							$d12 = getCountNucsTrim($conn, $anio, 15, $idEnlace, $idUnidad, $per, $mes3);
							$totd10 = $d10[0][0] + $d11[0][0] + $d12[0][0];
							$d20 = getCountNucsTrim($conn, $anio, 16, $idEnlace, $idUnidad, $per, $mes1);
							$d21 = getCountNucsTrim($conn, $anio, 16, $idEnlace, $idUnidad, $per, $mes2);
							$d22 = getCountNucsTrim($conn, $anio, 16, $idEnlace, $idUnidad, $per, $mes3);
							$totd20 = $d20[0][0] + $d21[0][0] + $d22[0][0];
							$d30 = getCountNucsTrim($conn, $anio, 17, $idEnlace, $idUnidad, $per, $mes1);
							$d31 = getCountNucsTrim($conn, $anio, 17, $idEnlace, $idUnidad, $per, $mes2);
							$d32 = getCountNucsTrim($conn, $anio, 17, $idEnlace, $idUnidad, $per, $mes3);
							$totd30 = $d30[0][0] + $d31[0][0] + $d32[0][0];

							$todgen = $totd10+$totd20+$totd30;
						
						?>
						<tr>
							<th scope="row">6.1</th>
							<td style="text-align: left;">Número de detenidos en flagrancia</td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2017, <? echo $per; ?>, 15, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d1[0]; ?></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2018, <? echo $per; ?>, 15, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d1[1]; ?></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2019, <? echo $per; ?>, 15, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d1[2]; ?></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2020, <? echo $per; ?>, 15, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d1[3]; ?></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2021, <? echo $per; ?>, 15, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d1[4]; ?></td>

							<td class="cPo" onclick="loaNucTrimes(0,0, <? echo $per; ?>, 15, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)">Capturar</td>

							<td class="cPo" onclick="loaNucTrimes(<? echo $mes1; ?>,<? echo $anio; ?>, <? echo $per; ?>, 15, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes2; ?>,<? echo $anio; ?>, <? echo $per; ?>, 15, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes3; ?>,<? echo $anio; ?>, <? echo $per; ?>, 15, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d12[0][0]; ?></td>
							<td class="blockInp"><input type="number" value="<? echo $totd10; ?>" id="p10tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">6.2</th>
							<td style="text-align: left;">Número de detenidos por orden de aprehensión</td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2017, <? echo $per; ?>, 16, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d2[0]; ?></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2018, <? echo $per; ?>, 16, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d2[1]; ?></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2019, <? echo $per; ?>, 16, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d2[2]; ?></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2020, <? echo $per; ?>, 16, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d2[3]; ?></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2021, <? echo $per; ?>, 16, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d2[4]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(0,0, <? echo $per; ?>, 16, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)">Capturar</td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes1; ?>,<? echo $anio; ?>, <? echo $per; ?>, 16, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d20[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes2; ?>,<? echo $anio; ?>, <? echo $per; ?>, 16, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d21[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes3; ?>,<? echo $anio; ?>, <? echo $per; ?>, 16, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d22[0][0]; ?></td>
							<td class="blockInp"><input type="number" value="<? echo $totd20; ?>" id="p10tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">6.3</th>
							<td style="text-align: left;">Número de detenidos por caso urgente</td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2017, <? echo $per; ?>, 17, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d3[0]; ?></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2018, <? echo $per; ?>, 17, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d3[1]; ?></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2019, <? echo $per; ?>, 17, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d3[2]; ?></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2020, <? echo $per; ?>, 17, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d3[3]; ?></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2021, <? echo $per; ?>, 17, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d3[4]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(0,0, <? echo $per; ?>, 17, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)">Capturar</td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes1; ?>,<? echo $anio; ?>, <? echo $per; ?>, 17, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d30[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes2; ?>,<? echo $anio; ?>, <? echo $per; ?>, 17, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d31[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes3; ?>,<? echo $anio; ?>, <? echo $per; ?>, 17, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d32[0][0]; ?></td>
							<td class="blockInp"><input type="number" value="<? echo $totd30; ?>" id="p10tot" readonly></td>
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
							<td style=" border: inset 0pt"><strong>TOTAL:</strong></td>
							<td class="blockInp"><strong><?php echo $todgen; ?></strong></td>
						</tr>
					</tbody>
				</table><br><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important">
							<div class="imagenWarning">
							 <img src="images/warning.png"  class="imgWarning" alt="">
							 	Nota.- Los datos proporcionados en el reactivo 6.1 (número de detenidos en flagrancia) deberán ser cuando menos iguales o superiores al reactivo 4.1 (carpetas de investigación iniciadas con detendido en flagrancia) de la pregunta número 4
							</div>
						</li>
					</ul>
				</div><br><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
							 Por su parte, los datos proporcionados en el reactivo 6.2 (número de detenidos por orden de aprehensión) deberan ser iguales o mayores a los datos proporcionados en el reactivo 5.3 (número de órdenes de aprehensión cumplimentadas) de la pregunta número 5. Lo anterior no es aplicable si la persona o personas se encuentren privadas de la libertad, es decir, en el centro penitenciario en cumplimiento de su sentencia condenatoria o en cumplimiento de la medida cautelar de prisión preventiva.
							</div>
						</li>
					</ul>
				</div><br><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
							 	De la misma forma, los datos proporcionados en el reactivo 6.3(número de detenidos por caso urgente) deberán ser iguales o mayores a los datos proporcionados en el reactivo 5.5 (número de órdenes de detención por caso urgente cumplimentadas) de la pregunta número 5.
							</div>
						</li>
					</ul>
				</div>
				<div class="botonGuardar">
					<? if($envt == 0){ ?>
					<button type="button" class="btn btn-success" id="guardarPregunta" onclick="saveQuest6(6, <? echo $per; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)">GUARDAR</button> <? } ?>
				</div>
			