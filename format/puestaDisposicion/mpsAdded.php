<?php
				include("../../Conexiones/Conexion.php");
				include("../../funciones2.php");
				include("../../sqlPersonas.php"); 


				if (isset($_POST["names"])){ $names = $_POST["names"]; }	
				if (isset($_POST["patrn"])){ $patrn = $_POST["patrn"]; }	
				if (isset($_POST["matrn"])){ $matrn = $_POST["matrn"]; }

				if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }	
				if (isset($_POST["f"])){ $f = $_POST["f"]; }		

				$getDataMps = getDataMpsSearch($conn, $names, $patrn, $matrn);

	?>
														<br>
														<table class="table table-striped hovermps">
													  <thead>
													    <tr>
													      <th style="text-align: center !important;" scope="col">#</th>
													      <th scope="col">Nombre (s)</th>
													      <th scope="col">Paterno</th>
													      <th scope="col">Materno</th>
													     	<th scope="col">ID Mp</th>
													      <th scope="col" style="text-align: center;">Experiencia</th>
													      <th scope="col" style="text-align: center;">Acción</th>
													    </tr>
													  </thead>
													  <tbody>
													 								
													  				<? 

													  						for ($h=0; $h < sizeof($getDataMps) ; $h++) {

													  									$exC = mpExperienciaCarp($conn, $getDataMps[$h][0]);
													  									$exL = mpExperienciaLit($conn, $getDataMps[$h][0]);
													  									$ex = $exC[0][0] + $exL[0][0];
													  								?>
													  										<tr>
													  														
													  														<th><? echo $h+1; ?>  </th>
													  														<th><? echo $getDataMps[$h][1]; ?>  </th>
													  														<th><? echo $getDataMps[$h][2]; ?>  </th>
													  														<th><? echo $getDataMps[$h][3]; ?>  </th>
													  														<th><? echo $getDataMps[$h][0]; ?>  </th>
													  														<th style="background-color: <? if($ex > 0){ echo "#ABEBC6"; }else{  echo "#F9E79F";  } ?>; color: black; font-weight: bold; text-align: center;"><? if($ex > 0){ echo "SI"; }else{  echo "NO";  } ?></th>
													  														<th style="text-align: center;"><a onclick="addMptoUnid(<? echo $getDataMps[$h][0]; ?>, <? echo $idEnlace; ?>, <? echo $f; ?>)">Agregar +</a></th>

													  										</tr>
												  									<?
													  						}

													  				?>

													  </tbody>
													</table>