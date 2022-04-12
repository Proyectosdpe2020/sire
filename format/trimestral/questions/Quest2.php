				<? 
					include ("../../../Conexiones/Conexion.php");
			include("../../../funcioneTrimes.php");
				include("../../../funciones.php");	

					if (isset($_GET["per"])){ $per = $_GET["per"]; }
					if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
					if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
					if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }
					if($per == 1){ $m1 = "Enero"; $m2 = "Febrero"; $m3 = "Marzo"; $nme = "Enero - Marzo"; $arr = array(1,2,3);}
					if($per == 2){ $m1 = "Abril"; $m2 = "Mayo"; $m3 = "Junio"; $nme = "Abril - Junio"; $arr = array(4,5,6);}
					if($per == 3){ $m1 = "Julio"; $m2 = "Agosto"; $m3 = "Septiembre"; $nme = "Julio - Septiembre"; $arr = array(7,8,9);}
					if($per == 4){ $m1 = "Octubre"; $m2 = "Noviembre"; $m3 = "Diciembre"; $nme = "Octubre - Diciembre"; $arr = array(10,11,12);}

					$data = getDAtaQuestion($conn, 3, $per, $anio, $idUnidad);
					$data2 = getDAtaQuestion($conn, 4, $per, $anio, $idUnidad);
					$getEnv = getInfOCarpetasEnv($conn, $idEnlace, 11);
					$envt = $getEnv[0][0]; 
					$sumTotal = $data[0][3]; 

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
					$totalValidateQuest4 = getDAtaSIREQuestionValidateQuestion($conn,$periodoValidate, $anio, $idUn);
				?>

				<h5 class="card-title tituloPregunta">Pregunta 2: Número de carpetas de investigación iniciadas durante el año <?php echo "$anio";?>.</h5><br>
				<div class="textoPregunta" >
					<ul>
						<li style="list-style-type: circle !important">
							¿Cuál es el número de carpetas de investigación iniciadas durante el año  <?php echo "$anio";?> con motivo de las denuncias, querellas u otros requisitos equivalentes que se recibieron en la Fiscalía General de la entidad federativa (incluyendo las recibidas en los Centros de Justicia para Mujeres) en ese mismo año?
						</li>
					</ul>
				</div><br><br>
				<div class="textoPregunta" >
					<ul>
						<li style="list-style-type: circle !important">
							¿Cuántas carpetas de investigación se iniciaron en el año  <?php echo "$anio";?> correspondientes a denuncias, querellas u otros requisitos equivalentes recibidos en <?php echo strval($anio-1); ?>, <strong>PERO QUE SE INICIARON EN <?php echo "$anio";?></strong>?
						</li>
					</ul>
				</div><br><br>
				<table class="tableTrimes">
					<thead>
						<tr>
							<th scope="col">No.</th>
							<th scope="col">Número de carpetas de investigación iniciadas</th>
							 <th scope="col"><? echo $m1; ?></th>
						     <th scope="col"><? echo $m2; ?></th>
							 <th scope="col"><? echo $m3; ?></th>
							<th scope="col" style="background-color: #C09F77;">Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">2.1</th>
							<td style="text-align: left;">Carpetas de investigación iniciadas por denuncias, querellas u otros requisitos equivalentes recibidos en <?php echo "$anio";?></td>
							<td><input type="number" value="<? echo $data[0][0]; ?>" id="p3m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data[0][1]; ?>" id="p3m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data[0][2]; ?>" id="p3m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data[0][3]; ?>" id="p3tot" value="0" readonly></td>
						</tr>
						<tr>
							<th scope="row">2.2</th>
							<td style="text-align: left;">Carpetas de investigación iniciadas por denuncias, querellas u otros requisitos equivalentes recibidos en <?php echo strval($anio-1); ?></td>
							<td><input type="number" value="0" id="p4m1" <? if($envt == 1){ echo "readonly"; } ?> readonly></td>
							<td><input type="number" value="0" id="p4m2" <? if($envt == 1){ echo "readonly"; } ?> readonly></td>
							<td><input type="number" value="0" id="p4m3" <? if($envt == 1){ echo "readonly"; } ?> readonly></td>
							<td class="blockInp"><input type="number" value="0" id="p4tot" value="0" readonly></td>
							<input id="totalValidateQuest4" name="totalValidateQuest4" type="hidden" value="<?php echo $totalValidateQuest4[0][0]; ?>">
						</tr>
						<tr>
						 <th style=" border: inset 0pt" scope="row"></th>
							<td style=" border: inset 0pt"></td>
							<td style=" border: inset 0pt"></td>
							<td style=" border: inset 0pt"></td>
							<td style=" border: inset 0pt"><strong>TOTAL:</strong></td>
							<td class="blockInp"><strong><?php if($sumTotal != null){ echo $sumTotal; }else{echo "0";} ?></strong></td>
						</tr>
					</tbody>
				</table><br><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
							 <img src="images/warning.png"  class="imgWarning" alt="">
							 	Nota.- Los datos proporcionados en el reactivo 2:1 (carpetas de investigación iniciadas por denuncias, querellas u otros requisitos equivalentes recibidos en el año <?php echo "$anio";?>) no podrán ser superiores a la suma de los reactivos 1.1 al 1.2 de la pregunta número 1.
							</div>
						</li>
					</ul>
				</div>
				<div class="botonGuardar">
					<? if($envt == 0){ ?>
					<button type="button" onclick="saveQuest2(2, <? echo $per; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" class="btn btn-success" id="guardarPregunta">GUARDAR</button><? } ?>
				</div>
		