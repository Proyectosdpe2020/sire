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
    <h5 class="text-on-pannel"><strong>Actualizar Datos de Acuerdo Reparatorio</strong></h5>

    <div class="row">
     <div class="col-xs-6">

      <label class="colorLetras" for="inputlg">Estatus</label>
      <div class="iconiput">
       <input type="number" placeholder="cantidad" class="first" id=""/>
       <span onclick=""><div id=""><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
      </div> 

     </div>
    </div>

    <div class="row">
     <div class="col-xs-4">

      <label class="colorLetras" for="inputlg">Fecha de Alta</label>
      <div class="iconiput">
       <input type="number" placeholder="cantidad" class="first" id=""/>
       <span onclick=""><div id=""><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
      </div> 

     </div>
     <div class="col-xs-4">
      <label class="colorLetras" for="inputlg">Fecha de Acuerdo</label>
      <div class="iconiput">
       <input type="number" placeholder="cantidad" class="first"  id=""/>
       <span ><div id=""><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
      </div> 
     </div>
     <div class="col-xs-4">
      <label class="colorLetras" for="inputlg">Fecha de Cumplimiento</label>
      <div class="iconiput">
       <input type="number" placeholder="cantidad" class="first"  id=""/>
       <span ><div id=""><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
      </div> 
     </div>

    </div>

    <div class="row">
     <div class="col-xs-4">

      <label class="colorLetras" for="inputlg">Tipo de Cuadernillo</label>
      <div class="iconiput">
       <input type="number" placeholder="cantidad" class="first" id=""/>
       <span onclick=""><div id=""><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
      </div> 

     </div>
     <div class="col-xs-4">
      <label class="colorLetras" for="inputlg">NUC</label>
      <div class="iconiput">
       <input type="number" placeholder="cantidad" class="first"  id=""/>
       <span ><div id=""><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
      </div> 
     </div>
     <div class="col-xs-4">
      <label class="colorLetras" for="inputlg">No. de Cuadernillo/Suspensíon Condicional</label>
      <div class="iconiput">
       <input type="number" placeholder="cantidad" class="first"  id=""/>
       <span ><div id=""><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
      </div> 
     </div>

    </div>

    <div class="row">
     <div class="col-xs-4">

      <label class="colorLetras" for="inputlg">Lugar donde se celebro el Acuerdo</label>
      <div class="iconiput">
       <input type="number" placeholder="cantidad" class="first" id=""/>
       <span onclick=""><div id=""><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
      </div> 

     </div>
     <div class="col-xs-4">
      <label class="colorLetras" for="inputlg">Tipo de Daño</label>
      <div class="iconiput">
       <input type="number" placeholder="cantidad" class="first"  id=""/>
       <span ><div id=""><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
      </div> 
     </div>
     <div class="col-xs-4">
      <label class="colorLetras" for="inputlg">MP Facilitador</label>
      <div class="iconiput">
       <input type="number" placeholder="cantidad" class="first"  id=""/>
       <span ><div id=""><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
      </div> 
     </div>

    </div>

    <div class="row">
     <div class="col-xs-4">

      <label class="colorLetras" for="inputlg">Delito Principal</label>
      <div class="iconiput">
       <input type="number" placeholder="cantidad" class="first" id=""/>
       <span onclick=""><div id=""><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
      </div> 

     </div>
     <div class="col-xs-4">
      <label class="colorLetras" for="inputlg">Delito Secundario</label>
      <div class="iconiput">
       <input type="number" placeholder="cantidad" class="first"  id=""/>
       <span ><div id=""><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
      </div> 
     </div>
     <div class="col-xs-4">
      <label class="colorLetras" for="inputlg">Tipo de Delito</label>
      <div class="iconiput">
       <input type="number" placeholder="cantidad" class="first"  id=""/>
       <span ><div id=""><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
      </div> 
     </div>

    </div>


    <div class="row">
     <div class="col-xs-12">

      <label class="colorLetras" for="inputlg">Síntesis del Acuerdo</label>
      <div class="iconiput">

       <textarea id="w3review" name="w3review" rows="10"  style="width: 100%; resize: none;">At w3schools.com you will learn how to make a website. They offer free tutorials in all web development technologies.
       </textarea>

      </div> 

     </div>
    </div>


    <div class="row">
     <div class="col-xs-4">

      <label class="colorLetras" for="inputlg">Región</label>
      <div class="iconiput">
       <input type="number" placeholder="cantidad" class="first" id=""/>
       <span onclick=""><div id=""><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
      </div> 

     </div>
     <div class="col-xs-4">
      <label class="colorLetras" for="inputlg">Distritos Judiciales</label>
      <div class="iconiput">
       <input type="number" placeholder="cantidad" class="first"  id=""/>
       <span ><div id=""><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
      </div> 
     </div>
     <div class="col-xs-4">
      <label class="colorLetras" for="inputlg">Tipo de Cumplimiento</label>
      <div class="iconiput">
       <input type="number" placeholder="cantidad" class="first"  id=""/>
       <span ><div id=""><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
      </div> 
     </div>

    </div>

   </div>
  </div>                                                                
 </div>



