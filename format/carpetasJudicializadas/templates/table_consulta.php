<?
include ("../../../Conexiones/Conexion.php");
include ("../../../Conexiones/conexionSicap.php");
include("../../../funcionesCarpetasJudicializadas.php"); 

if (isset($_POST["anio"])){ $anio = $_POST["anio"]; } 
if (isset($_POST["mes"])){ $mes= $_POST["mes"]; } 
if (isset($_POST["estatus"])){ $estatus= $_POST["estatus"]; } 

if($estatus == 1){
 $data = getDataCarpetasJudi($conn, $anio, $mes);
 for ($i=0; $i < sizeof($data); $i++) {  
  $checkUnidadesLiti = checkUnidadesLiti($data[$i][5])?> 
  <tr>
   <td><? echo $data[$i][2]; ?></td>
   <td><? echo $data[$i][14]; ?></td>
   <td><? echo $data[$i][1]; ?></td>
   <td><? echo $data[$i][4]; ?></td>
   <td><?if($checkUnidadesLiti){echo $data[$i][6].' '.ucwords(strtolower($data[$i][19]));}else{ echo $data[$i][6]; }  ?></td>
   <td><?if($data[$i][10] != ""){echo $data[$i][12];}else{ echo $data[$i][16];}  ?></td>
   <td><? echo $data[$i][8]; ?></td>
  </tr>
<?}
}elseif ($estatus == 2) {
 $data = getDataVinculaciones($conSic, $anio, $mes);
  for ($i=0; $i < sizeof($data); $i++) {  
   $checkUnidadesLiti = checkUnidadesLiti($data[$i][11]); 
   $getDataUnidad = getDataUnidad($conn , $data[$i][11]);
   $getDataFechaInvComp = getDataFechaInvComp($conn, $data[$i][2]);
   if(sizeof($getDataFechaInvComp) > 0){
    $fecha = fechaCastellano(date_format($getDataFechaInvComp[0][2],"Y/m/d H:i:s"));
   }
   ?>
   <tr>
    <td><? echo $data[$i][0]; ?></td>
    <td><? echo $data[$i][1]; ?></td>
    <td>Vinculación a proceso</td>
    <td><? echo $data[$i][10]; ?></td>
    <td><?if($checkUnidadesLiti){ echo $getDataUnidad[0][3].' '.ucwords(strtolower($getDataUnidad[0][2]));  }else{ echo $getDataUnidad[0][3];  } ?></td>
    <td><? echo $data[$i][9]; ?></td>
    <td><? echo $data[$i][6]; ?></td>
    <td><center><?if(sizeof($getDataFechaInvComp) > 0){ ?><?echo $fecha; ?> <span onclick="showModalFechaTerminacion(<?echo $data[$i][0]; ?>, <? echo $data[$i][2]; ?>,1, '<?echo date_format($getDataFechaInvComp[0][2],"Y-m-d");?>' )" style="cursor: pointer; color: blue; font-size: 18px;" class="glyphicon glyphicon-edit"></span><? }else{ ?><span onclick="showModalFechaTerminacion(<?echo $data[$i][0]; ?>, <? echo $data[$i][2]; ?>, 0, 0)" style="cursor: pointer; color: green; font-size: 18px;" class="glyphicon glyphicon-calendar"></span><? } ?></center></td>
  </tr>
<? } 
}?>


