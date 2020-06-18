<?  

	include ("../Conexiones/Conexion.php");
	include("../funciones.php");	
			
	if (isset($_POST["tipoarchReposi"])){ $tipoarchReposi = $_POST["tipoarchReposi"]; }


?>


		
																					<select id="enlaceid" class="form-control redondear selectTranparent" onchange="updTableArchAdmin2();" required>								
																						


																						<option value="0" selected="">Todos</option>

																						<? 

																								$enlances = getAllEnlacesInfoUNidad($conn, $tipoarchReposi);

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

																			