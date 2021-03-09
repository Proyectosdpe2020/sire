<?php
session_start();
include("../../Conexiones/Conexion.php");
include("../../funCmasc.php");	

if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
if (isset($_POST["tramANt"])){ $tramANt = $_POST["tramANt"]; }

if (isset($_POST["estatus"])){ $estatus = $_POST["estatus"]; }
if (isset($_POST["tipo"])){ $tipo = $_POST["tipo"]; }

$getNameEstaus = getNameEstatus($conn, $estatus);

if($tipo == 1){ $let = "Mediación"; }
if($tipo == 2){ $let = "Conciliación"; }
if($tipo == 3){ $let = "Junta Restaurativa"; }

?>




<div class="modal-header" style="background-color:#3c6084;">
 <center>
  <h4 class="modal-title" style="color:white; font-weight: bold;"> Nucs ingresados por tipo de acuerdo
  </h4>
 </center>
</div>


<div class="col-md-12 col-sm-12 col-xs-12 form-group" style="background-color: white; zoom:110%; height: auto !important;">
 <center><label><h4 style="font-weight:bold; "><? echo $let."-".$getNameEstaus[0][0]; ?></h4></label></center>
 <br>
 <div class="panel panel-default" style="height: 70vh !important;">
  <div class="panel-body" style="height: auto; padding: 40px;">
   <h5 class="text-on-pannel"><strong> VALIDACIÓN DE NUCS </strong></h5>
   
   <div id="contDataNucDeterm"></div>
   <div class="row">

    <div class="col-xs-9">

     <label style="font-weight:bold; ">Número de Caso *</label>
     <input id="nuCmascAcuer" type="number" name="nuc" value="" tabindex="0" placeholder="Ingresa el Número de Caso" style="height:38px; font-weight: bold;"
     class="fechas form-control redondear" autofocus/>

    </div>
    <div class="col-xs-3">

     <label style="font-weight:bold; color: white;">*</label>
     <center><button id="btnAddnucAcuer" style="width: 100%; height:38px;" type="button" class="btn btn-primary redondear"
      onclick="nucFunctionsAcuerd('nuCmascAcuer', <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idEnlace; ?>, <? echo $estatus; ?>, <? echo $tipo; ?>)">Agregar</button></center>

     </div>

    </div>

    <div class="row">
     <br>


     <div id="contTableNucs" style="height: 580px; overflow: scroll; overflow-x: hidden;">

      <div id="contTableNUcsUnids">
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
           <td class="textCent">  <span onclick="deleteNucFromAcuerd(<? echo $dataAcuer[$d][0]; ?>, <? echo $idEnlace; ?>, <? echo $anio; ?>, <? echo $mes; ?>, <? echo $estatus; ?>, <? echo $tipo; ?>, <? echo $dataAcuer[$d][3]; ?>)" class="glyphicon glyphicon-trash" style="color: green; font-size: 16px; cursor: pointer;"></span></td>
          </tr>
          <?
         }

         ?>

        </tbody>
       </table>
      </div>

     </div>

     <br>
     <br>
    </div>



   </div>

  </div>
  <div class="row">
   <div class="col-xs-12 col-sm-12 col-md-12">
    <center><button style="width: 100%;" type="button" class="btn btn-primary redondear"
     onclick="modAcuClose(<? echo $tipo; ?>, <? echo $idEnlace; ?>, <? echo $anio; ?>, <? echo $mes; ?> )">Salir</button></center><br>
    </div>
   </div>

  </div> 


