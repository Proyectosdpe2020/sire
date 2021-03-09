<?php
session_start();
include ("../../Conexiones/Conexion.php");
include("../../funciones.php");	
include("../../funCmascAcurd.php");
if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }

$mesCapturar = 1;
$anioCaptura = 2021;


$mesNom = Mes_Nombre($mesCapturar);
$idUsuario = $_SESSION['useridIE'];
?>

  <div class="row">

       <table id="mytable" style="zoom:150%; font-family: arial !important;" class="table table-bordred table-striped">

    <thead class="theadTabls">

     <th><input type="checkbox" id="checkall" /></th>
     <th>No</th>
     <th>Número de Caso</th>
     <th>Tipo de Acuerdo</th>
     <th>Tipo de Mecanismo</th>
     <th>Fecha Ingreso</th>
     <th>Año</th>
     <th>Mes</th>
    </thead>
    <tbody>

     <? 
     $data = getAcuerdsNuc($conn, $nuc);
     for ($i=0; $i < sizeof($data) ; $i++) { 
      ?>
      <tr id="trtableAcu" style="background:rgba(21,47,74,.2);">
       <td><input type="checkbox" checked="true" class="checkthis" disabled /></td>
       <td><? echo $i+1; ?></td>
       <td class="tdAcurd1"><? echo $data[$i][0]; ?></td>
       <td><? echo $data[$i][1]; ?></td>
       <td><? echo $data[$i][2]; ?></td>
       <td><? echo $data[$i][3]->format('Y-m-d H:i:s'); ?></td>
       <td><? echo $data[$i][4]; ?></td>
       <td><?  echo Mes_Nombre($data[$i][5]) ; ?></td>
      </tr>
      <?
     }
     ?>


    </tbody>

   </table>

  </div>


  <div class="row">

    <div class="tab theadTabls tabCuadrn">

        <button class="tablinksAcerd" onclick="openTabAcuerd2(event,'cuadern.php', <? echo $idEnlace; ?>,<? echo $anioCaptura; ?>,<? echo $mesCapturar; ?>)"><label class="titleMenuTop">Actualización de Cuadernillo</label></button>

        <button class="tablinksAcerd" onclick="openTabAcuerd2(event,'mecanism.php', <? echo $idEnlace; ?>,<? echo $anioCaptura; ?>,<? echo $mesCapturar; ?>)"><label class="titleMenuTop">Mecanismos Utilizados</label></button>

        <button class="tablinksAcerd" onclick=""><label  class="titleMenuTop">Registro de Victimas y Ofensores</label></button>   

        <button style="float: right;" class="tablinksAcerd" onclick=""><label class="titleMenuTop">Gestion de Clausulas</label></button> 

    </div>
    <div id="contentTabs" class="tabcontent"> <? echo "el nuc que llega aqui es: ".$nuc; ?></div>
</div>



