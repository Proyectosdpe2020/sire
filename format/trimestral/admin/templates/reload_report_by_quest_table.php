<?php
include("../../../../Conexiones/Conexion.php");
include("../../../../funciones.php");

if (isset($_GET["anioTrimes"])){ $anioTrimes = $_GET["anioTrimes"]; }
if (isset($_GET["periodoTrimes"])){ $periodoTrimes = $_GET["periodoTrimes"]; }
?>

<? $data = reportByQuestTable($conn, $periodoTrimes, $anioTrimes); 
   for ($i=0; $i < sizeof($data); $i++) {  ?>
   	<tr>
   		<td class="textCent"><strong><? echo $data[$i][0]; ?></strong></td>
     <td><strong><? echo $data[$i][1]; ?></strong></td>
     <td class="textCent"><strong><? echo $data[$i][2]; ?></strong></td>
   	</tr>
<? } ?>

                 
   