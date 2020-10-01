	<?php

				include ("../../Conexiones/Conexion.php");
				include("../../funcionesPueDispo.php");	

				if (isset($_POST["newBrwosers_id"])){ $newBrwosers_id = $_POST["newBrwosers_id"]; }
				if (isset($_POST["areaAdsc"])){ $areaAdsc = $_POST["areaAdsc"]; }	
				
				$mandos = getDataMandoTableAdm($conn, $newBrwosers_id, $areaAdsc);
    for ($i = 0; $i < sizeof($mandos); $i++) { ?>
    	<tr>
	    	<td class="textCent numMando"></td>
						<td><? echo $mandos[$i][1]; ?></td>
						<td class="textCent"><? echo $mandos[$i][5]; ?></td>
						<td class="textCent"><? echo $mandos[$i][6]; ?></td>
						<td class="textCent"><? echo$mandos[$i][7]; ?></td>
						<td class="textCent"><? echo$mandos[$i][11]; ?></td>
						<td class="textCent"><center><label class="glyphicon glyphicon-edit" data-toggle="modal" href="#puestdispos" 
						onclick="showModalEditarMando(<? echo $mandos[$i][0]; ?>)" style="width: 95%; cursor: pointer; font-weight: bold; color: green;">  Editar </label></center></td>
				 </tr>
	 <?} 
?>





						
						
					

