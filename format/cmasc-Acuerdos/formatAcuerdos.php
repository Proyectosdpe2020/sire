<?php
session_start();
include ("../../Conexiones/Conexion.php");
include("../../funciones.php");	
include("../../funCmascAcurd.php");

if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }

$mesCapturar = 1;
$anioCaptura = 2021;


$mesNom = Mes_Nombre($mesCapturar);
$idUsuario = $_SESSION['useridIE'];
?>

<div id="contenido">
 <div class="right_col" role="main">

  <div style="" class="x_panel principalPanel">

   <div class="x_panel panelCabezera">

    <table border="0" class="alwidth">
     <tr>
      <td id="nomostrar" class="imgSelloCabezera" width="5%" height="125"></td>
      <td width="50%">
       <div class="tituloCentralSegu">
        <div class="titulosCabe1">
         <label class="titulo1" style="color: #686D72;">Centro de Mecanismos Alternativos deSolución de Controversias</label>
         <h3> <label class="titulo2">Acuerdos en CMASC</label></h3>

         <h4> <label class="titulo2">Fiscalía General del Estado de Michoácan</label></h4>
        </div>
       </div>
      </td>
      <td id="nomostrar" class="imgdgtipeCabezera" width="10%" height="125"></td>
     </tr>
    </table>


   </div>

   <div class="row pad20">

    <div class="col-xs-12 col-sm-2  col-md-1">
     <label style="font-size: 1.8rem;" for="heard">Año:</label><br>
     <select id="anioCmasc" name="selMes" tabindex="6" class="form-control redondear selectTranparent"  style="height: 4vh;"
     required>
     <option value="<? echo $anioCaptura; ?>" selected><? echo $anioCaptura; ?></option>
    </select>
   </div>

   <div class="col-xs-12 col-sm-2  col-md-2">
    <label style="font-size: 1.8rem;" for="heard">Mes:</label><br>
    <select id="mesCmasc" name="selMes" tabindex="6" class="form-control redondear selectTranparent"  style="height: 4vh;"
    required>
    <option value="<? echo $mesCapturar; ?>" selected>
     <? echo $mesNom; ?>
    </option>
   </select>
  </div>

  <div class="col-xs-12 col-sm-10  col-md-7">
   <label style="font-size: 1.8rem;" for="heard">Unidad:</label>
   <div id="contenidoProyectosListAgru">
    <? 

    $enlace = getInfoEnlaceUsuario($conn, $idUsuario);
    $idEnlace = $enlace[0][0];
    $idfisca = $enlace[0][1];

    if($idfisca == 4){$unidads = getDistincUnidadesMPs($conn, $idEnlace);}else{

     $unidads = getDistincUnidadesMPsFis($conn, $idEnlace);

    }


    ?>

    <select id="unidadFormato" class="form-control redondear selectTranparent" style="height: 4vh;">
     onchange="updTableMpUnidad(<? echo $idEnlace ?>);" required>


     <option value="0" selected="">Centro de Mecanismos Alternativos de Solución de Controversias
     </option>
    </select>

   </div>
  </div>
  <div class="col-xs-12 col-sm-10  col-md-2">
   <label style="font-size: 1.8rem;" for="heard">Número de Caso a Buscar:</label>
   <div class="iconiput" id="contenidoProyectosListAgru">
    <input placeholder="Número de Caso" autocomplete="on" class="nucAcur"  type="text" name="" onFocus="if (this.value=='Nombre') this.value='';">
   </div>
  </div>

 </div>

 <div id="respuestaDescargarCarpeta"></div>

 <div class="contTblMPs" id="contAcuerdDiv">

  <div class="row pad20">


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
     <th>Edit</th>
     <th>Delete</th>
    </thead>
    <tbody>

     <? 
     $data = getAcuerds($conn);
     for ($i=0; $i < sizeof($data) ; $i++) { 
      ?>
      <tr id="trtableAcu">
       <td><input type="checkbox" class="checkthis" /></td>
       <td><? echo $i+1; ?></td>
       <td class="tdAcurd1"><? echo $data[$i][0]; ?></td>
       <td><? echo $data[$i][1]; ?></td>
       <td><? echo $data[$i][2]; ?></td>
       <td><? echo $data[$i][3]->format('Y-m-d H:i:s'); ?></td>
       <td><? echo $data[$i][4]; ?></td>
       <td><?  echo Mes_Nombre($data[$i][5]) ; ?></td>
       <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button onclick="getCuadernAcuer(<? echo $data[$i][0]; ?>, <? echo $idEnlace; ?>)" class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
       <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
      </tr>
      <?
     }
     ?>


    </tbody>

   </table>


  </div>

 </div>

 <div class="x_panel piepanel">
  <div class="piepanel2">
   <div class="piepanel3">
    <div class="piepanel4">
     <label style="color: #686D72;">SISTEMA INTEGRAL DE REGISTRO ESTADISTICO Copyright © Todos
     los Derechos Reservados</label>
    </div>
   </div>

  </div>
 </div>


</div>

</body>

</html>