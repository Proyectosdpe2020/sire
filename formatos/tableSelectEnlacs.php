
	<?php
	session_start();
	include ("../Conexiones/Conexion.php");
	include("../funciones2.php");	
	include ("../Conexiones/conexionSicap.php");
	include("../funcioneSicap.php");

		if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
		if (isset($_POST["f"])){ $f = $_POST["f"]; }

	if($f == 1){ $dataMps = getDataMPsMovCarp($conn, $idEnlace, $f); }	
	if($f == 4){ $dataMps = getDataMPsMovLit($conn, $idEnlace, $f); }	

	?>
														<table class="table table-striped hovermps">
													  <thead>
													    <tr>
													      <th style="text-align: center !important;" scope="col">#</th>
													      <th scope="col">Ministerio Público</th>
													      <th scope="col">Unidad</th>
													      <th scope="col">Formato</th>
													      <th style="text-align: center !important;" scope="col">Ext Ant</th>
													      <th style="text-align: center !important;" scope="col">Tramite</th>
													      <th scope="col">Acción</th>
													    </tr>
													  </thead>
													  <tbody>
													    
													  	<? for ($h=0; $h < sizeof($dataMps) ; $h++) {
													  					if($dataMps[$h][5] == 1){ $formt= "Carpetas de Investigación"; }
													  					if($dataMps[$h][5] == 4){ $formt= "Litigación"; }

													  					if($f == 1){$tramites = getTramiteMp2($conn, $dataMps[$h][3], 2021, $dataMps[$h][1]);}
													  					if($f == 4){$tramites = getTramiteMpLiti($conn, $dataMps[$h][3], 2021, $dataMps[$h][1]);}
													  					
													  				?>
													  								<tr style="background-color: <? if($tramites[0][2] != 0){} if($tramites[0][2] == 0){ echo "#F5CBA7";  } ?>;"> 
																		      <th style="text-align: center !important;" scope="row"><? echo $h+1; ?></th>
																		      <td><? echo $dataMps[$h][2] ?></td>
																		      <td><? echo $dataMps[$h][4] ?></td>
																		      <td><? echo $formt; ?></td>
																		      <td style="font-weight: bold; text-align: center;"><? echo $tramites[0][1]; ?></td>
																		      <td style="font-weight: bold; text-align: center; "><? echo $tramites[0][2]; ?></td>
																								<!--<td style="font-weight: bold; text-align: center; "><a onclick="deleteMpEnlcUnid(<? echo $dataMps[$h][0]; ?>)" style="font-weight: bold; color: black;" href="#">Eliminar</a></td> -->
																		      <td>
																		      		<? if($tramites[0][2] > 0){ ?> <label style="color: #06DDA0; font-weight: bold;">Trabajando</label> <? }else{
																		      			if($tramites[0][2] == 0){ ?> <a onclick="deleteMpEnlcUnid(<? echo $dataMps[$h][0]; ?>)" style="font-weight: bold; color: black;" href="#">Eliminar</a> <? }else{ if($tramites[0][2] < 0){ echo "Revisar"; } }
																		      		} ?>
																		      					
																		      </td>
																		    </tr>
													  				<?
													  	} ?>

													    
												
													  </tbody>
													</table>

						