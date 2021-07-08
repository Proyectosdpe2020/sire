	<?php

				include ("../../Conexiones/Conexion.php");
				include("../../funcionesPueDispo.php");	

				if (isset($_POST["messelected"])){ $messelected = $_POST["messelected"]; }	
				if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
				if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }

				if(date("l") === "Monday"){ $numeroDia = 1; $diaLetra = "Lunes"; }
 	    if(date("l") === "Tuesday"){ $numeroDia = 2; 	$diaLetra = "Martes";}
 	    if(date("l") === "Wednesday"){ $numeroDia = 3; 	$diaLetra = "Miercoles";}
   		if(date("l") === "Thursday"){ $numeroDia = 4; 	$diaLetra = "Jueves";}
 	 	if(date("l") === "Friday"){ $numeroDia = 5; 	$diaLetra = "Viernes";}
 	 	if(date("l") === "Saturday"){ $numeroDia = 6; 	$diaLetra = "Sabado";}
 	 	if(date("l") === "Sunday"){ $numeroDia = 7; 	$diaLetra = "Domingo";}	

			?>



	
<select id="diaSeleted" name="selMes" tabindex="6"class="form-control redondear selectTranparent" onchange="loadDataPuestDay(<? echo $anio; ?>, <? echo $idEnlace; ?>, 0)" required>

							<? 

									$diasNumero = cal_days_in_month(CAL_GREGORIAN, $messelected, $anio);

									for ($t=1; $t <= $diasNumero ; $t++) { 												
												if($t == $diames){
													?>
														<option value="<? echo $diames; ?>" selected> <? echo "".$diaLetra."-".$diames; ?></option>	
													<?
												}else{
														$fecha = $t."-".$messelected."-".$anio; 
														$nommesa =  getDiaMesnombre($fecha);
													?>
														<option value="<? echo $t; ?>"> <? echo "".$nommesa."-".$t; ?></option>	
													<?
												}
									}
							?>
							
						</select>