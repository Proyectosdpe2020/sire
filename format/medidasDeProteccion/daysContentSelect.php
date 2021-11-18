	<?php

		//include("../../funcionesPueDispo.php");	


include ("../../Conexiones/conexionMedidas.php");


include("../../funcionesMedidasProteccion.php");	

				if (isset($_POST["mesMedidaSelected"])){ $mesMedidaSelected = $_POST["mesMedidaSelected"]; }	
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



	
<select id="diaSeleted" name="selDia" tabindex="6"class="form-control redondear selectTranparent" onchange="loadDataPuestDay(<? echo $anio; ?>, <? echo $idEnlace; ?>, 0)" required>
<option value="0">Todo</option>
							<? 

									$diasNumero = cal_days_in_month(CAL_GREGORIAN, $mesMedidaSelected, $anio);

									for ($t=1; $t <= $diasNumero ; $t++) { 												
												if($t == $diames){
													?>
														<option value="<? echo $diames; ?>" selected> <? echo "".$diaLetra."-".$diames; ?></option>	
													<?
												}else{
														$fecha = $t."-".$mesMedidaSelected."-".$anio; 
														$nommesa =  getDiaMesnombre($fecha);
													?>
														<option value="<? echo $t; ?>"> <? echo "".$nommesa."-".$t; ?></option>	
													<?
												}
									}
							?>
							
						</select>