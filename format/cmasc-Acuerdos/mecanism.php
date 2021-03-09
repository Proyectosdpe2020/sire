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


<div class="row" style="zoom:125%; width: 100%; margin: 0 auto;">

 <div class="col-xs-12">
  <br>
  <div class="panel panel-default " style="">
   <div class="panel-body">
    <h5 class="text-on-pannel"><strong>Mecanismos Utilizados</strong></h5>

    <div class="row">
     <div class="col-xs-6">

      <label class="colorLetras" for="inputlg">Conciliación</label>
      <div class="iconiput">
       <input type="number" placeholder="cantidad" class="first" id=""/>
       <span onclick=""><div id=""><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
      </div> 

     </div>
    </div>

    <div class="row">
     <div class="col-xs-12">

      <label class="colorLetras" for="inputlg">Lugar de Cumplimiento</label>
      <div class="iconiput">
       <input type="number" placeholder="Especifica el lugar de Cumplimiento" class="first" id=""/>
       <span onclick=""><div id=""><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
      </div> 
    </div>

    </div>

     <div class="row">
     <div class="col-xs-12">

      <label class="colorLetras" for="inputlg">Dirección del lugar donde sera el Cumplimiento</label>
      <div class="iconiput">
       <input type="number" placeholder="Especifica la dirección del lugar donde sera el Cumplimiento" class="first" id=""/>
       <span onclick=""><div id=""><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
      </div> 
    </div>

    </div>

       <div class="row">
     <div class="col-xs-6">
      <label class="colorLetras " for="inputlg">Fecha de Inicio</label>
      <div class="iconiput fechIn">
       <input type="date" placeholder="" class="first fechIn"  id=""/>
      </div> 
     </div>
     <div class="col-xs-6">
      <label class="colorLetras " for="inputlg">Fecha de Termino</label>
      <div class="iconiput fechIn">
       <input type="date" placeholder="" class="first fechIn"  id=""/>
      </div> 
     </div>

    </div>



    <div class="row">
     <div class="col-xs-12">

      <br><label class="colorLetras" for="inputlg">Descripción</label>
      <div class="iconiput">

       <textarea  placeholder="Especifica una descripción" id="w3review" name="w3review" rows="10"  style="width: 100%; resize: none;"></textarea>

      </div> 

     </div>
    </div>


   </div>
  </div>                                                                
 </div>



