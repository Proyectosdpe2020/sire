<?php
	session_start();
	include("../../Conexiones/Conexion.php");
	include("../../funCmasc.php");	

if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }

if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
if (isset($_POST["estatus"])){ $estatus = $_POST["estatus"]; }
if (isset($_POST["tipo"])){ $tipo = $_POST["tipo"]; }

	?>


<table class="table table-striped tblTransparente">
        <thead>
         <tr class="cabezeraTabla">
          <th class="col-xs-12 col-sm-12 col-md-1 textCent">No</th>
          <th class="col-xs-12 col-sm-12 col-md-2 textCent">Numero Caso </th>
          <th class="col-xs-12 col-sm-12 col-md-3 textCent">Ultimo - Ordinario/Reproceso </th>
          <th class="col-xs-12 col-sm-12 col-md-3 textCent">Procedente/Desechada </th>
          <th class="col-xs-12 col-sm-12 col-md-3 textCent">Fecha Ingreso </th>
          <th class="col-xs-12 col-sm-12 col-md-1 textCent">Acción</th>
         </tr>
        </thead>
        <tbody>

         <? 

         $dataAcuer = getDataAcuer($conn, $anio, $mes, $idEnlace, $estatus, $tipo);

         for ($d=0; $d < sizeof($dataAcuer); $d++) { 

          $statusRecib = getIngresadosNucAcuer($conn, $dataAcuer[$d][3]);
          if($statusRecib[0][1]==0){ $vars = "Ordinario"; }
          if($statusRecib[0][1]==1){ $vars = "Reproceso"; }
          if($statusRecib[0][2]==0){ $vars1 = "Procedente"; }
          if($statusRecib[0][2]==1){ $vars1 = "Desechada"; }
          ?>
          <tr>
           <td class="textCent"><? echo $d +1; ?></td>
           <td class="textCent"><? echo $dataAcuer[$d][3]; ?></td>
           <td class="textCent"><? echo $vars; ?></td>
           <td class="textCent"><? echo $vars1; ?></td>
           <td class="textCent"><? echo $statusRecib[0][3]->format('Y-m-d H:i:s'); ?></td>
           <td class="textCent">  <span onclick="deleteNucFromAcuerd(<? echo $dataAcuer[$d][0] ?>, <? echo $idEnlace; ?>, <? echo $anio; ?>, <? echo $mes; ?>, <? echo $estatus; ?>, <? echo $tipo; ?>)" class="glyphicon glyphicon-trash" style="color: green; font-size: 16px; cursor: pointer;"></span></td>
          </tr>
          <?
         }

         ?>

        </tbody>
       </table>