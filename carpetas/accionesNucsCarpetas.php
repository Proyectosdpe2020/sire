<?php

include ("../Conexiones/conexionSicap.php");
include ("../Conexiones/conexionSicap1.php");
include("../funcioneSicap.php");

include ("../Conexiones/Conexion.php");
include ("../Conexiones/conexionCMASC.php");
include("../funciones.php");
include("../funcionesCarpetasV2.php");



if (isset($_POST["acc"])){ $acc = $_POST["acc"]; }
if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }

switch ($acc) {


 case 'existeNuc':


          //// SE OBTIENE EL NOMBRE DEL ULTIMO MP DE LA MISMA UNIDAD QUE HIZO LA DETERMINACION /////
 $arreglo[0] = "SI";
 $arreglo[1] = "NO";


 if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
 if (isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }

 if($aux=get_nuc_sicap ($nuc,$conSic)){  echo json_encode(array('first'=>$arreglo[0]));  }else{
  echo json_encode(array('first'=>$arreglo[1]));
 }

 break; 


 case 'insertNucCarpetas':


 $arreglo[0] = "SI";
 $arreglo[1] = "NO";

 $datossicap=get_datos_carpeta_capturado($conSic, $nuc);
 $idCarpeta = $datossicap[0][0];

 if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }


 $datossicap=get_datos_carpeta_capturado($conSic, $nuc);
 $exped = $datossicap[0][2];
 $carpid = $datossicap[0][0];

 if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
 if (isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }
 if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
 if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
 if (isset($_POST["deten"])){ $deten = $_POST["deten"]; }
 if (isset($_POST["envioselect"])){ $envioselect = $_POST["envioselect"]; }






 $queryTransaction = "  
 BEGIN                     
 BEGIN TRY 
 BEGIN TRANSACTION
 SET NOCOUNT ON    

 INSERT INTO estatusNucsCarpetas VALUES('$nuc', $estatResolucion, $idMp, $idUnidad, GETDATE(), $anio, $mes, '$idCarpeta', $deten, $envioselect)  

 COMMIT
 END TRY
 BEGIN CATCH 
 ROLLBACK TRANSACTION
 RAISERROR('No se realizo la transaccion',16,1)
 END CATCH
 END
 ";           

 $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));  

                  //echo $queryTransaction;

 if ($result) {
  echo json_encode(array('first'=>$arreglo[0]));
 }else{
  echo json_encode(array('first'=>$arreglo[1]));
 }



 break;


 case 'showtableCarpetasNucsV2':

 if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
 if (isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }
 if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
 if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
 if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }    
 if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }   
 if (isset($_POST["deten"])){ $deten = $_POST["deten"]; }   

 ?>

 <table class="table table-striped tblTransparente">
  <thead>
   <tr class="cabezeraTabla">
    <th class="col-xs-1 col-sm-1 col-md-1 textCent">No</th>
    <th class="col-xs-5 col-sm-5 col-md-5 textCent">Numero Caso </th>
    <th class="col-xs-5 col-sm-5 col-md-5 textCent">Expediente</th>
    <th class="col-xs-1 col-sm-1 col-md-1 textCent">Acción</th>
   </tr>
  </thead>
  <tbody>

   <? 


   $dataNucsXtipoResolucion = getDataXtipoResolucion($conn, $estatResolucion, $mes, $anio, $idUnidad, $idMp, $deten); 


   for ($i=0; $i < sizeof($dataNucsXtipoResolucion) ; $i++) { 
    ?>
    <tr style="text-align: center !important;">

     <td><? echo $i+1; ?></td>
     <td><? echo $dataNucsXtipoResolucion[$i][0]; ?></td>
     <td><? echo $dataNucsXtipoResolucion[$i][1]; ?></td>
     <td>

      <center> <button type="button" onclick="deleteCarpetaResolV2(<? echo $dataNucsXtipoResolucion[$i][2]; ?>,<? echo $idMp; ?>,<? echo $anio; ?>,<? echo $mes; ?>,<? echo $estatResolucion; ?>,<? echo $idUnidad; ?>)" class="btn btn-warning btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-trash"></span> Eliminar </button></center>

     </td>

    </tr>  
    <?
   }



   ?>


  </tbody>
 </table>

 <?


 break;



 case 'deleteResolCarpeV2':


 $arreglo[0] = "SI";
 $arreglo[1] = "NO";

 if (isset($_POST["id"])){ $id = $_POST["id"]; }



 $queryTransaction = "  
 BEGIN                     
 BEGIN TRY 
 BEGIN TRANSACTION
 SET NOCOUNT ON

 DELETE FROM estatusNucsCarpetas WHERE idEstatusNucsCarpetas = $id

 COMMIT
 END TRY
 BEGIN CATCH 
 ROLLBACK TRANSACTION
 RAISERROR('No se realizo la transaccion',16,1)
 END CATCH
 END
 ";

 $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));  
 if ($result) { echo json_encode(array('first'=>$arreglo[0])); }else{ echo json_encode(array('first'=>$arreglo[1]));}


 break;



 case 'insertDataCarpetas':


 $arreglo[0] = "SI";
 $arreglo[1] = "NO";

 if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
 if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
 if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
 if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
 if (isset($_POST["inputCdeten"])){ $inputCdeten = $_POST["inputCdeten"]; }
 if (isset($_POST["inputSdeten"])){ $inputSdeten = $_POST["inputSdeten"]; }
 if (isset($_POST["reCbreCbOtrUni"])){ $reCbreCbOtrUni = $_POST["reCbreCbOtrUni"]; }
 if (isset($_POST["inputEnvUATP"])){ $inputEnvUATP = $_POST["inputEnvUATP"]; }
 if (isset($_POST["inputEnvUI"])){ $inputEnvUI = $_POST["inputEnvUI"]; }
 if (isset($_POST["inputEnvImpDesc"])){ $inputEnvImpDesc = $_POST["inputEnvImpDesc"]; }


 $dataCar = countDataCarpe($conn, $mes, $anio, $idUnidad, $idMp);


 if($dataCar[0][0] == 0){


  $queryTransaction = "  
  BEGIN                     
  BEGIN TRY 
  BEGIN TRANSACTION
  SET NOCOUNT ON

  INSERT INTO carpetasDatos VALUES($mes,$anio,$idUnidad,$idMp,GETDATE(), $inputCdeten, $inputSdeten, $reCbreCbOtrUni, $inputEnvUATP, $inputEnvUI, $inputEnvImpDesc, 0, 0)

  COMMIT
  END TRY
  BEGIN CATCH 
  ROLLBACK TRANSACTION
  RAISERROR('No se realizo la transaccion',16,1)
  END CATCH
  END
  ";


 }else{

  if($dataCar[0][0] > 0){

   $queryTransaction = "  
   BEGIN                     
   BEGIN TRY 
   BEGIN TRANSACTION
   SET NOCOUNT ON

   UPDATE carpetasDatos SET iniciadasConDetenido = $inputCdeten, iniciadasSinDetenido = $inputSdeten, recibidasPorOtraUnidad = $reCbreCbOtrUni, enviadasUATP = $inputEnvUATP, enviadasUI = $inputEnvUI, enviImpDes = $inputEnvImpDesc WHERE idCarpetasDatos = ".$dataCar[0][1]."

   COMMIT
   END TRY
   BEGIN CATCH 
   ROLLBACK TRANSACTION
   RAISERROR('No se realizo la transaccion',16,1)
   END CATCH
   END
   ";

  }

 }




 $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));  
 if ($result) { echo json_encode(array('first'=>$arreglo[0])); }else{ echo json_encode(array('first'=>$arreglo[1]));}


 break;


 case 'updateTotalTrabajar':


          //// SE OBTIENE EL NOMBRE DEL ULTIMO MP DE LA MISMA UNIDAD QUE HIZO LA DETERMINACION /////
 $arreglo[0] = "SI";
 $arreglo[1] = "NO";

 if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
 if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
 if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
 if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }

 $existenciaAnt = getExistenciaAnterior($conn, $mes, $anio, $idUnidad, $idMp);

 if($existenciaAnt){ 

  $tramiteAnte = $existenciaAnt[0][0];  
  $bandHabTramite = 0;
 }else{ 

  $tramiteAnte = 0; 
  $bandHabTramite = 1;

 }
 $datoCar = getDatosCarpetas($conn, $mes, $anio, $idUnidad, $idMp);
 $totIni = $datoCar[0][6];
 $recibiotrund = $datoCar[0][2];

//total reiniciadas
 $d1 = getCountNucs($conn, 1, $mes, $anio, $idUnidad, $idMp);

 $totaTrabvajar = $tramiteAnte + $totIni + $d1[0][0] + $recibiotrund ;

 ?>


 <h5 class="text-on-pannel"><strong> Total a Trabajar</strong></h5>
 <div id="totalTrabajar"><input class="form-control input-md redondear fdesv" id="inputTotalTrabajar" value="<? echo number_format($totaTrabvajar) ?>" type="number" readonly></div>


 <?


 break; 

///////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////


 case 'updateAllFormCarpetsForm': //// ACTUALIZA TODA LA INFO DEL MODULO DE CARPETAS ANTE CUALUIER ACTUALIZACION



 $arreglo[0] = "SI";
 $arreglo[1] = "NO";

 if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
 if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
 if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
 if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }


 if($mes == 1){ $mesAnterior = 12; $anioAnte = ($anio-1); }else{ $anioAnte = $anio; $mesAnterior = ($mes - 1); 	}


 if ($anio <= 2021 && $mes <= 6) {
 
 
 
   $existenciaAnt = getExistenciaAnterior($conn, $mesAnterior, $anioAnte, $idUnidad, $idMp);
 
   ////////////// OBTIENE EL TRAMITE ANTERIOR DE LOS DATOS INGRESADOS DEL MES ANTERIOR /////////////////////
   
   
   if ($existenciaAnt) {
   
     $tramiteAnte = $existenciaAnt[0][0];
     $bandHabTramite = 0;
   } else {
   
     $tramiteAnte = 0;
     $bandHabTramite = 1;
   }
 
 
 }else{
 
   
 
   
 
   if ($mes == 1) {
     $mesAnterior = 12;
     $anioAnte = ($anio - 1);
   } else {
     $anioAnte = $anio;
     $mesAntAnterior = ($mes - 2);
     $mesAnterior = ($mes - 1);
   }
 
   $existenciaAnt = getExistenciaAnterior($conn, $mesAntAnterior, $anioAnte, $idUnidad, $idMp);
 
   if ($existenciaAnt) {
   
     $tramiteAnte = $existenciaAnt[0][0];
     $bandHabTramite = 0;
   } else {
   
     $tramiteAnte = 0;
     $bandHabTramite = 1;
   }
 
   
 
   
 
 ////////////////////// NUEVOS TRAMITES COUNT NUCSS //////////////////////////
 
 $existNew = getDataCarpetasDatosExistenciaAnteriorV2($conn, $mesAnterior, $anioAnte, $idUnidad, $idMp);
 $existNew2 = getDataCarpetasDatosExistenciaAnteriorV2($conn, $mes, $anio, $idUnidad, $idMp);
 
 
 $d1 = getCountNucs($conn, 1, $mesAnterior, $anioAnte, $idUnidad, $idMp, 0);
 
 $d2 = getCountNucs($conn, 22, $mesAnterior, $anioAnte, $idUnidad, $idMp, 1);
 $d3 = getCountNucs($conn, 22, $mesAnterior, $anioAnte, $idUnidad, $idMp, 0);
 
 $d4 = getCountNucs($conn, 2, $mesAnterior, $anioAnte, $idUnidad, $idMp, 0);
 $d5 = getCountNucs($conn, 5, $mesAnterior, $anioAnte, $idUnidad, $idMp, 0);
 $d6 = getCountNucs($conn, 20, $mesAnterior, $anioAnte, $idUnidad, $idMp, 0);
 $d7 = getCountNucs($conn, 21, $mesAnterior, $anioAnte, $idUnidad, $idMp, 0);
 $d8 = getCountNucs($conn, 3, $mesAnterior, $anioAnte, $idUnidad, $idMp, 0);
 $d9 = getCountNucs($conn, 23, $mesAnterior, $anioAnte, $idUnidad, $idMp, 0);
 $d10 = getCountNucs($conn, 24, $mesAnterior, $anioAnte, $idUnidad, $idMp, 0);
 $d11 = getCountNucs($conn, 25, $mesAnterior, $anioAnte, $idUnidad, $idMp, 0);
 $d12 = getCountNucs($conn, 15, $mesAnterior, $anioAnte, $idUnidad, $idMp, 0);
 
 $totaTrabvajar = $tramiteAnte + $existNew[0][0] + $d1[0][0] + $existNew[0][1] ;
 
 $totDeterminaciones = $d2[0][0] + $d3[0][0] + $d4[0][0] + $d5[0][0] + $d6[0][0] + $d7[0][0] + $d8[0][0] + $d9[0][0] + $d10[0][0] + $d11[0][0] + $d12[0][0];
 $enviads = $existNew[0][2] + $existNew[0][3] + $existNew[0][4];
 $enviaddetermns = $enviads + $totDeterminaciones;
 
 $totTramitss = $totaTrabvajar - $enviaddetermns;
 
 }





 $d11 = getCountNucs($conn, 1, $mes, $anio, $idUnidad, $idMp, 0);

$d22 = getCountNucs($conn, 22, $mes, $anio, $idUnidad, $idMp, 1);
$d33 = getCountNucs($conn, 22, $mes, $anio, $idUnidad, $idMp, 0);

$d44 = getCountNucs($conn, 2, $mes, $anio, $idUnidad, $idMp, 0);
$d55 = getCountNucs($conn, 5, $mes, $anio, $idUnidad, $idMp, 0);
$d66 = getCountNucs($conn, 20, $mes, $anio, $idUnidad, $idMp, 0);
$d77 = getCountNucs($conn, 21, $mes, $anio, $idUnidad, $idMp, 0);
$d88 = getCountNucs($conn, 3, $mes, $anio, $idUnidad, $idMp, 0);
$d99 = getCountNucs($conn, 23, $mes, $anio, $idUnidad, $idMp, 0);
$d101 = getCountNucs($conn, 24, $mes, $anio, $idUnidad, $idMp, 0);
$d111 = getCountNucs($conn, 25, $mes, $anio, $idUnidad, $idMp, 0);
$d121 = getCountNucs($conn, 15, $mes, $anio, $idUnidad, $idMp, 0);

$totaTrabvajar2 = $totTramitss  + $existNew2[0][0] + $d11[0][0] + $existNew2[0][1] ;
$totDeterminaciones1 = $d22[0][0] + $d33[0][0] + $d44[0][0] + $d55[0][0] + $d66[0][0] + $d77[0][0] + $d88[0][0] + $d99[0][0] + $d101[0][0] + $d111[0][0] + $d121[0][0];
$enviads1 = $existNew2[0][2] + $existNew2[0][3] + $existNew2[0][4];

$tramitefinal = $totaTrabvajar2 - ($totDeterminaciones1 + $enviads1);


 ?>

 <div class="row" >

  <div class="col-md-12 col-sm-12 col-xs-12">

   <div class="panel panel-default fd1" style="">
    <div class="panel-body">
     <h5 class="text-on-pannel"><strong> Existencia Anterior </strong></h5>
     <input class="form-control input-md redondear fdesv" id="inputTramiteAnterior" type="number" value="<? if( $bandHabTramite == 1 ){ echo $totTramitss; } else { echo $totTramitss; } ?>"  <?  echo "readonly"; ?> >
    </div>
   </div><br>

   <div class="panel panel-default fd1">
    <div class="panel-body">
     <h5 class="text-on-pannel"><strong> Iniciadas </strong></h5>

     <div class="row">

      <div class="col-xs-6">
       <label class="colorLetras"  for="inputlg">Con Detenido :</label>
       <input value="<? echo number_format($existNew2[0][5]); ?>" class="form-control input-md redondear fdesv" id="inputCdeten" type="number">
      </div>
      <div class="col-xs-6">
       <label class="colorLetras"  for="inputlg">Sin Detenido :</label>
       <input value="<? echo number_format($existNew2[0][6]); ?>" class="form-control input-md redondear fdesv" id="inputSdeten" type="number">
      </div>

     </div>

     <div class="row">

      <div class="col-md-12 col-sm-12 col-xs-12">
       <label class="colorLetras" for="inputlg">Total Iniciadas :</label>
       <div id="inicidadas"><input value="<? echo number_format($existNew2[0][0]); ?>" class="form-control input-md redondear fdesv colorBloqueado" value="0" id="inpuTotIniciadas" type="number" readonly></div>
      </div>

     </div>                         

    </div>
   </div>

   <div class="row">
    <?      ?>
    <div class="col-xs-12">
     <br>
     <div class="panel panel-default fd1" style="">
      <div class="panel-body">
       <h5 class="text-on-pannel"><strong>Reiniciadas :</strong></h5>
       <div class="iconiput">
        <input type="number" value="<? echo number_format($d11[0][0]); ?>" onclick="sendModalCarpetasNucs(1,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" style="cursor: pointer;" readonly placeholder="Clic para ingresar NUCS" class="first"  id="reiniciadasInser"/>
        <span onclick="sendModalCarpetasNucs(1,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)"><div id="checkreiniciadas"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
       </div>  


      </div>
     </div>                                  
    </div>

   </div>

   <div class="row">

    <div class="col-xs-12">
     <br>
     <div class="panel panel-default fd1" style="">
      <div class="panel-body">
       <h5 class="text-on-pannel"><strong>Recibidas por otra Unidad :</strong></h5>
       <input class="form-control input-md redondear fdesv" value="<? echo number_format($existNew2[0][1]); ?>" id="reCbOtrUni" type="number">
      </div>
     </div>                                  
    </div>

   </div>

   <div class="row">
    <div class="col-xs-12">
     <br>
     <div class="panel panel-default fd1" style="">
      <div class="panel-body">

       <div id="totTrabajarContent"> 
        <h5 class="text-on-pannel"><strong> Total a Trabajar</strong></h5>
        <div id="totalTrabajar"><input class="form-control input-md redondear fdesv" id="inputTotalTrabajar" value="<? echo number_format($totaTrabvajar2) ?>" type="number" readonly></div>
       </div>

      </div>
     </div>                                  
    </div>
   </div> 

   <div class="panel panel-default fd1" style="margin-top: 5% !important;">
    <div class="panel-body">
     <h5 class="text-on-pannel"><strong> Resueltas o Determinadas   </strong></h5>

     <div class="row">

      <input id="idmp" type="hidden" value="<? echo $idMp; ?>" name="">
      <input id="mes" type="hidden" value="<? echo $mes; ?>" name="">
      <input id="anio" type="hidden" value="<? echo $anio; ?>" name="">




      <div class="col-xs-6">

       <label class="colorLetras" for="inputlg">Enviadas a Litigación Con Detenido :</label>
       <div class="iconiput">
        <input type="number" value="<? echo number_format($d22[0][0]); ?>" onclick="sendModalCarpetasNucs(22,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 1)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputCdetenju"/>
        <span onclick="sendModalCarpetasNucs(22,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 1)"><div id="checkCdetenju"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
       </div> 

      </div>
      <div class="col-xs-6">
       <label class="colorLetras" for="inputlg">Enviadas a Litigación Sin Detenido :</label>
       <div class="iconiput">
        <input type="number" value="<? echo number_format($d33[0][0]); ?>" onclick="sendModalCarpetasNucs(22,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputSdetenju"/>
        <span onclick="sendModalCarpetasNucs(22,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)"><div id="checkSdetenju"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
       </div> 

      </div>

     </div>
     <div class="row">

      <div class="col-md-12 col-sm-12 col-xs-12">
       <label class="colorLetras" for="inputlg">Total judicializadas :</label>
       <div id="totalJudicializadas"><input class="form-control input-md redondear fdesv" id="inputJudicializadas" value="<? echo number_format($totalJudicializadass) ?>" type="number" readonly=""></div>
      </div>

     </div>


    </div>
   </div>


   <div class="row">    

    <div class="col-xs-12">
     <div class="panel panel-default fd1" style="">
      <div class="panel-body">


       <div class="col-xs-12">
        <label class="colorLetras" for="inputlg">Abstención de Investigación :</label>
        <div class="iconiput">
         <input type="number" value="<? echo number_format($d44[0][0]); ?>" onclick="sendModalCarpetasNucs(2,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>,0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first"  id="inputAbsInves"/>
         <span onclick="sendModalCarpetasNucs(2,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)"><div id="checkAbsInves"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
        </div> 
       </div>

       <div class="col-xs-12">
        <label class="colorLetras" for="inputlg">Archivo Temporal :</label>
        <div class="iconiput">
         <input type="number" value="<? echo number_format($d55[0][0]); ?>" onclick="sendModalCarpetasNucs(5,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputArcTem"/>
         <span onclick="sendModalCarpetasNucs(5,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)"><div id="checkArcTem"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
        </div> 

       </div>
       <div class="col-xs-12">
        <label class="colorLetras" for="inputlg">No ejercicio de la acción penal :</label>
        <div class="iconiput">
         <input type="number" value="<? echo number_format($d66[0][0]); ?>" onclick="sendModalCarpetasNucs(20,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first"  id="inputNEAP"/>
         <span onclick="sendModalCarpetasNucs(20,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)"><div id="checkNEAP"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
        </div> 

       </div>
       <div class="col-xs-12">
        <label class="colorLetras" for="inputlg">Incompetencia:</label>
        <div class="iconiput">
         <input type="number" value="<? echo number_format($d77[0][0]); ?>" onclick="sendModalCarpetasNucs(21,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputIncompe"/>
         <span onclick="sendModalCarpetasNucs(21,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)"><div id="checkIncompe"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
        </div> 

       </div>
       <div class="col-xs-12">
        <label class="colorLetras" for="inputlg">Acumulación :</label>
        <div class="iconiput">
         <input type="number" value="<? echo number_format($d88[0][0]); ?>" onclick="sendModalCarpetasNucs(3,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputAcumulacion"/>
         <span onclick="sendModalCarpetasNucs(3,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)"><div id="checkAcumulacion"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
        </div> 
        <br>
       </div>


      </div>
     </div>

    </div>



   </div>  


   <div class="row">


   </div>

   <div class="panel panel-default fd1" style="">
    <div class="panel-body">
     <h5 class="text-on-pannel"><strong> Salidas Alternas </strong></h5>

     <div class="row">

      <div class="col-xs-6">
       <label class="colorLetras" for="inputlg">Mediación :</label>
       <div class="iconiput">
        <input type="number" value="<? echo number_format($d99[0][0]); ?>" onclick="sendModalCarpetasNucs(23,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputMediacion"/>
        <span onclick="sendModalCarpetasNucs(23,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)"><div id="checkMediacion"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
       </div> 

      </div>
      <div class="col-xs-6">
       <label class="colorLetras" for="inputlg">Conciliación :</label>
       <div class="iconiput">
        <input type="number" value="<? echo number_format($d101[0][0]); ?>" onclick="sendModalCarpetasNucs(24,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputConciliacion"/>
        <span onclick="sendModalCarpetasNucs(24,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)"><div id="checkConciliacion"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
       </div> 
      </div>

     </div>
     <div class="row">

      <div class="col-xs-6">
       <label class="colorLetras" for="inputlg">Criterios de Oportunidad :</label>
       <div class="iconiput">
        <input type="number" value="<? echo number_format($d111[0][0]); ?>" onclick="sendModalCarpetasNucs(25,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputCriteOpor"/>
        <span onclick="sendModalCarpetasNucs(25,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)"><div id="checkCriteOpor"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
       </div> 

      </div>
      <div class="col-xs-6">
       <label class="colorLetras" for="inputlg">Suspensión Condicional del Proceso :</label>
       <div class="iconiput">
        <input type="number" value="<? echo number_format($d121[0][0]); ?>" onclick="sendModalCarpetasNucs(15,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)" readonly style="cursor: pointer;" placeholder="Clic para ingresar NUCS" class="first" id="inputSCP"/>
        <span onclick="sendModalCarpetasNucs(15,<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, 0)"><div id="checkSCP"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
       </div> 

      </div>

     </div>


    </div>
   </div>


   <div class="row">

    <div class="col-xs-12">
     <br>
     <div class="panel panel-default fd1" style="">
      <div class="panel-body">
       <h5 class="text-on-pannel"><strong> Total de Resoluciones o Determinadas </strong></h5>
       <div id="totalResoluciones"><input class="form-control input-md redondear fdesv" id="inputResoluciones" value="<? echo number_format($totDeterminaciones1); ?>" type="number" readonly=""></div>
      </div>
     </div>

    </div>

    <div class="col-xs-12">
     <div class="panel panel-default fd1" style="">
      <div class="panel-body">



       <div class="col-xs-12">
        <label class="colorLetras" for="inputlg">Canalizadas a Unidad de Atención Temprana :</label>
        <input class="first" value="<? echo number_format($existNew2[0][2]); ?>" id="inputEnvUATP" type="number">
       </div>
       <div class="col-xs-12">
        <label class="colorLetras" for="inputlg">Canalizadas a Unidad de Investigación :</label>
        <input class="first" value="<? echo number_format($existNew2[0][3]); ?>"  id="inputEnvUI" type="number">
       </div>
       <div class="col-xs-12">
        <label class="colorLetras" for="inputlg">Canalizadas a Imputado Desconocido :</label>
        <input class="first"  value="<? echo number_format($existNew2[0][4]); ?>" id="inputEnvImpDesc" type="number">
       </div>
       <div class="col-xs-12">
        <label class="colorLetras" for="inputlg">Trámite :</label>
        <div id="tramiteFinal"><input class="form-control input-md redondear fdesv" id="inputTramiteFinal" value="<? echo number_format($tramitefinal); ?>" type="number" readonly=""></div>
       </div>


      </div>
     </div>

    </div>


   </div>


  </div> 

 </div>

 <?



 break; 





 ///////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////





 case 'reglasValidacionV2':


          //// SE OBTIENE EL NOMBRE DEL ULTIMO MP DE LA MISMA UNIDAD QUE HIZO LA DETERMINACION /////
 $arreglo[0] = "SI"; /// SE SINSERTA
 $arreglo[1] = "NO"; /// NO SE INSERTA

 $arreglo[2] = "NOR"; /// NO SE INSERTA POR SER REINICIADO SIENDO LA PRIMERA VEZ
 $arreglo[3] = "NOCF"; /// NO SE INSERTA POR QUE SU ULTIMO ESTATUS ES DE UN PROCESO QUE YA FINALIZO LA CARPETA
 $arreglo[4] = "NOIR"; /// NO SE INSERTA POR QUE SE DEBE REINICIAR PRIMERO
 $arreglo[5] = "NOIRN"; /// NO SE INSERTA POR QUE SE DEBE REINICIAR PRIMERO
 $arreglo[6] = "NOCMASC"; ///MEDIACION NO SE ENCUENTRA EN LA BASE DE DATOS DE CMASC
 $arreglo[7] = "RECHAZOCMASC"; ///MEDIACION RECIBIDA EN CMASC PERO RECHAZADA
 $arreglo[8] = "NOCONTABILIZA"; ///MEDIACION RECIBIDA EN CMASC PERO A PARTIR DEL DIA 26 DEL MES A CAPTURAR, INGRESAR AL SIGUIENTE MES


 if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
 if (isset($_POST["estatus"])){ $estatus = $_POST["estatus"]; }
 if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
 if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }



////// PASO 1 VALIDAR QUE EL NUC NO SE ENCUENTRE EN EL HISTORICO DE DETERMINACIONES DE SIRE
////// AQUI SE OBTIENE LA ULTIMA DETERMINACION EN CASO DE QUE SEAN VARIAS Y SE OMITE EN CASO DE QUE LA ULTIMA DETERMINACION FUE UNA REINICIADA SE OMITE Y LA ANTERIOR QUEDA COMO LA ULTIMA

 $datossicap=get_datos_carpeta_capturado($conSic, $nuc);
 $idCarpeta = $datossicap[0][0];   

 $dataLasResolucion = getLastResolucionCarpetaV2($conn, $idCarpeta);

	/// SE AGREGA ESTA FUNCION PARA OBTENER LOS DATOS DE LAS DETERMINACIONES QUE FINALIZAN SU PROCESO 
	$dataLasResolucionTermin = getLastResolucionCarpetaV2termin($conn, $idCarpeta);

 if($dataLasResolucion[0][2] == 1){ $mesee = "Enero"; }
 if($dataLasResolucion[0][2] == 2){ $mesee = "Febrero"; }
 if($dataLasResolucion[0][2] == 3){ $mesee = "Marzo"; }
 if($dataLasResolucion[0][2] == 4){ $mesee = "Abril"; }
 if($dataLasResolucion[0][2] == 5){ $mesee = "Mayo"; }
 if($dataLasResolucion[0][2] == 6){ $mesee = "Junio"; }
 if($dataLasResolucion[0][2] == 7){ $mesee = "Julio"; }
 if($dataLasResolucion[0][2] == 8){ $mesee = "Agosto"; }
 if($dataLasResolucion[0][2] == 9){ $mesee = "Septiembre"; }
 if($dataLasResolucion[0][2] == 10){ $mesee = "Octubre"; }
 if($dataLasResolucion[0][2] == 11){ $mesee = "Noviembre"; }
 if($dataLasResolucion[0][2] == 12){ $mesee = "Diciembre"; }

 $band1 = 0;

 if($dataLasResolucion != null){


  for ($h=0; $h < sizeof($dataLasResolucion) ; $h++) { 
     # code...
   $d = $dataLasResolucion[$h][0];
    //$d == 15 || 
   if($d == 15 ||  $d == 25 || $d == 2 ){
    $band1 = 1; 
    break;
   }
  }   


  if($band1){ 

      /////// CUALQUIERA DE ESTOS ESTATUS RECHAZAN EL VOLVER INSERTAR LA CARPETA DE NUEVO POR QUE EL PROCESO A FINALIZADO
   echo json_encode(   array(  'first'=>$arreglo[3], 'nombre'=>$dataLasResolucionTermin[0][6], 'unidad'=>$dataLasResolucionTermin[0][4], 'fiscalia'=>$dataLasResolucionTermin[0][5], 'estatus'=>$dataLasResolucionTermin[0][1], 'anio'=>$dataLasResolucionTermin[0][3], 'mes'=>$mesee   )   );

  }else{     


    ////////////////// AQUI VALIDAREMOS SI ES EL ULTIMO ESTATUS UN REINICIADO ENTONCES LO PODEMOS AGREGAR Y SI NO ES UN REINICIIADO MANDAR MENSAJE D EPRIMERO REINICIAR

   if($dataLasResolucion[0][0] == 1){


    if($estatus == 1){ 

        //////// EL ULTIMO ESTATUS DE LA CAPETAS ES REINICIADO NO SE PUEDE VOLVER A INGRESAR COMO REINICIADO
     echo json_encode(   array(  'first'=>$arreglo[5], 'nombre'=>$dataLasResolucion[0][6], 'unidad'=>$dataLasResolucion[0][4], 'fiscalia'=>$dataLasResolucion[0][5], 'estatus'=>$dataLasResolucion[0][1], 'anio'=>$dataLasResolucion[0][3], 'mes'=>$mesee   )   );

    }else{
      //UNA VEZ REALIZADA LAS VALIDACIONES VERIFICAMOS SI EL ESTATUS ES UNA MEDIACION Y CHECAMOS SI EL NUC FUE MANDADO PRIMERO A LA UNIDAD DE MEDIACION
     if($estatus == 23){
      $checkCMASC = getEstatusCMASC($conCMASC, $nuc);
      
      //PRIMER PASO SE VERIFICA SI EL NUC INGRESADO YA SE HA RECIBIDO EN CMASC DE LO CONTRARIO NO SE PODRA GUARDAR
      if(sizeof($checkCMASC) > 0){
        $carpetaRecibida = $checkCMASC[0][7];
      $motivoRechazo = $checkCMASC[0][9];
      $fechaIngreso = $checkCMASC[0][2]->format('Y-n-d');
      $anioCapturaSire = $anio;
      $mesCapturaSire = $mes;
      $diaInicialCapturaSire = 26;
      $diaLimiteCapturaSire = 25;
      $fechaCapturaSire = $anioCapturaSire.'-'.$mesCapturaSire.'-'.$diaInicialCapturaSire; //Periodo de captura inician 26 de cada mes anterior
      $periodoIngresoSire = strtotime('- 1 month', strtotime($fechaCapturaSire)); //Se resta un mes al mes de captura actual
      $fechaInicialCaptura = date('d-m-Y',  $periodoIngresoSire);
      $fechaLimiteCaptura = $diaLimiteCapturaSire.'-'.$mesCapturaSire.'-'.$anioCapturaSire;
      $prioridad = $checkCMASC[0][18]; //para saber si es con detenido debe ser = 1
         ////// SI EXISTE EL NUC SE VALIDA SI LA CARPETA RECIBIDA SE ENCUENTRA RECHAZADA, DE SER ASI OBTENER EL MOTIVO DE RECHAZO Y NO DEJAR GUARDAR
           if($carpetaRecibida == 0){
            echo json_encode(   array(  'first'=>$arreglo[7], 'motivoRechazo'=>$motivoRechazo  )   );
           }else{
           if (check_in_range($fechaInicialCaptura, $fechaLimiteCaptura, $fechaIngreso) || $prioridad == 1){
              //SI EL NUC SE HA RECIBIDO POR EL CMASC Y ESTA EN EL RAGO DEJAR GUARDAR
              echo json_encode(   array(  'first'=>$arreglo[0]   )   ); 
            }else{
              echo json_encode(   array(  'first'=>$arreglo[8]  )   );
            }
           }
      } else{
       echo json_encode(   array(  'first'=>$arreglo[6]   )   ); //NO EXISTE EL NUC EN BASE DE DATOS DE CMASC
      }

     }else{
       ////// SE PUEDE INGRESAR EL NUC CON EL ESTATUS 
     echo json_encode(   array(  'first'=>$arreglo[0]   )   );
     }

    }


   }else{


    if($estatus != 1){


       if($estatus == 22){


        ////// SE PUEDE INGRESAR EL NUC CON EL ESTATUS 
     echo json_encode(   array(  'first'=>$arreglo[0]   )   );

       }else{


          ///// SE DEBDE REINICIAR EL NUC PARA PODER UTILIZARLO EN CUALQUIERA DE LOS DEMAS ESTATUS
     echo json_encode(   array(  'first'=>$arreglo[4], 'nombre'=>$dataLasResolucion[0][6], 'unidad'=>$dataLasResolucion[0][4], 'fiscalia'=>$dataLasResolucion[0][5], 'estatus'=>$dataLasResolucion[0][1], 'anio'=>$dataLasResolucion[0][3], 'mes'=>$mesee  )   );

       }

        

    }else{
      //UNA VEZ REALIZADA LAS VALIDACIONES VERIFICAMOS SI EL ESTATUS ES UNA MEDIACION Y CHECAMOS SI EL NUC FUE MANDADO PRIMERO A LA UNIDAD DE MEDIACION
     if($estatus == 23){
      $checkCMASC = getEstatusCMASC($conCMASC, $nuc);
      
      //PRIMER PASO SE VERIFICA SI EL NUC INGRESADO YA SE HA RECIBIDO EN CMASC DE LO CONTRARIO NO SE PODRA GUARDAR
      if(sizeof($checkCMASC) > 0){
        $carpetaRecibida = $checkCMASC[0][7];
      $motivoRechazo = $checkCMASC[0][9];
      $fechaIngreso = $checkCMASC[0][2]->format('Y-n-d');
      $anioCapturaSire = $anio;
      $mesCapturaSire = $mes;
      $diaInicialCapturaSire = 26;
      $diaLimiteCapturaSire = 25;
      $fechaCapturaSire = $anioCapturaSire.'-'.$mesCapturaSire.'-'.$diaInicialCapturaSire; //Periodo de captura inician 26 de cada mes anterior
      $periodoIngresoSire = strtotime('- 1 month', strtotime($fechaCapturaSire)); //Se resta un mes al mes de captura actual
      $fechaInicialCaptura = date('d-m-Y',  $periodoIngresoSire);
      $fechaLimiteCaptura = $diaLimiteCapturaSire.'-'.$mesCapturaSire.'-'.$anioCapturaSire;
      $prioridad = $checkCMASC[0][18]; //para saber si es con detenido debe ser = 1
         ////// SI EXISTE EL NUC SE VALIDA SI LA CARPETA RECIBIDA SE ENCUENTRA RECHAZADA, DE SER ASI OBTENER EL MOTIVO DE RECHAZO Y NO DEJAR GUARDAR
           if($carpetaRecibida == 0){
            echo json_encode(   array(  'first'=>$arreglo[7], 'motivoRechazo'=>$motivoRechazo  )   );
           }else{
            if (check_in_range($fechaInicialCaptura, $fechaLimiteCaptura, $fechaIngreso) || $prioridad == 1 ){
              //SI EL NUC SE HA RECIBIDO POR EL CMASC Y ESTA EN EL RAGO DEJAR GUARDAR
              echo json_encode(   array(  'first'=>$arreglo[0]   )   ); 
            }else{
              echo json_encode(   array(  'first'=>$arreglo[8]  )   );
            }
           }
      } else{
       echo json_encode(   array(  'first'=>$arreglo[6]   )   ); //NO EXISTE EL NUC EN BASE DE DATOS DE CMASC
      }

     }else{
       ////// SE PUEDE INGRESAR EL NUC CON EL ESTATUS 
     echo json_encode(   array(  'first'=>$arreglo[0]   )   );
     }

       

    } 



   }


  }


 }else{ 

      ///////////////////////////////// SE INSERTA SIMPLEMENTE EL NUC PERO SE VERIFICA QUE ANTES NO PROVENGA DEL ESTATUS DE REINICIADO POR QUE SERIA LA PRIMERA VEZ QUE ENTRA
  if($estatus !=  1 ){

 //UNA VEZ REALIZADA LAS VALIDACIONES VERIFICAMOS SI EL ESTATUS ES UNA MEDIACION Y CHECAMOS SI EL NUC FUE MANDADO PRIMERO A LA UNIDAD DE MEDIACION
     if($estatus == 23){
      $checkCMASC = getEstatusCMASC($conCMASC, $nuc);

    
      //PRIMER PASO SE VERIFICA SI EL NUC INGRESADO YA SE HA RECIBIDO EN CMASC DE LO CONTRARIO NO SE PODRA GUARDAR
      if(sizeof($checkCMASC) > 0){


        $carpetaRecibida = $checkCMASC[0][7];
        $motivoRechazo = $checkCMASC[0][9];
        $fechaIngreso = $checkCMASC[0][2]->format('Y-n-d');
        $anioCapturaSire = $anio;
        $mesCapturaSire = $mes;
        $diaInicialCapturaSire = 26;
        $diaLimiteCapturaSire = 25;
        $fechaCapturaSire = $anioCapturaSire.'-'.$mesCapturaSire.'-'.$diaInicialCapturaSire; //Periodo de captura inician 26 de cada mes anterior
        $periodoIngresoSire = strtotime('- 1 month', strtotime($fechaCapturaSire)); //Se resta un mes al mes de captura actual
        $fechaInicialCaptura = date('d-m-Y',  $periodoIngresoSire);
        $fechaLimiteCaptura = $diaLimiteCapturaSire.'-'.$mesCapturaSire.'-'.$anioCapturaSire;
        $prioridad = $checkCMASC[0][18]; //para saber si es con detenido debe ser = 1

         ////// SI EXISTE EL NUC SE VALIDA SI LA CARPETA RECIBIDA SE ENCUENTRA RECHAZADA, DE SER ASI OBTENER EL MOTIVO DE RECHAZO Y NO DEJAR GUARDAR
           if($carpetaRecibida == 0){
            echo json_encode(   array(  'first'=>$arreglo[7], 'motivoRechazo'=>$motivoRechazo  )   );
           }else{
            if (check_in_range($fechaInicialCaptura, $fechaLimiteCaptura, $fechaIngreso) || $prioridad == 1 ){
              //SI EL NUC SE HA RECIBIDO POR EL CMASC Y ESTA EN EL RAGO DEJAR GUARDAR
              echo json_encode(   array(  'first'=>$arreglo[0]   )   ); 
            }else{
              echo json_encode(   array(  'first'=>$arreglo[8]  )   );
            }
           }
      } else{
       echo json_encode(   array(  'first'=>$arreglo[6]   )   ); //NO EXISTE EL NUC EN BASE DE DATOS DE CMASC
      }

     }else{
       ////// SE PUEDE INGRESAR EL NUC CON EL ESTATUS 
     echo json_encode(   array(  'first'=>$arreglo[0]   )   );
     }

  }else{

       ///// NO SE INSERTA POR SER LA PRIMERA VEZ Y QUERER METERLO COMO REINICIADO
   echo json_encode(   array(   'first'=>$arreglo[2]   )   );

  }

 }

 break; 



 case 'validateJudicializte':


 $arreglo[0] = "SI"; /// SE EJECUTARIA EL METODO DE GUARDAR POR QUE NO HAY UNA JUDICIALIZADA ANTES

 if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
 if (isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }
 if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
 if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
 if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }    
 if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }   
 if (isset($_POST["deten"])){ $deten = $_POST["deten"]; }   

 $datossicap=get_datos_carpeta_capturado($conSic, $nuc);
 $idCarpeta = $datossicap[0][0];   

 $dataLasResol = getLastResolJudicializateCarpet($conn, $idCarpeta); 

  ?>

 

   <div class="row">
    <div class="col-xs-12">

     <label>El NUC ya fue enviado a litigación cos los siguientes datos:</label><br>
     <label>NUC : <? echo $dataLasResol[0][7]; ?></label><br>
      <label>Ministerio Público : <? echo $dataLasResol[0][6]; ?></label><br>
      <label>Físcalia : <? echo $dataLasResol[0][5]; ?></label><br>
      <label>Unidad : <? echo $dataLasResol[0][4]; ?></label>


    </div>
   </div><br>

<label>Para volver a enviar el NUC favor de seleccionar el motivo por el cual se vuelve a enviar a Litigación</label><br>

   <div class="row">
    <div class="col-xs-12">

     <label>Motivo de Envío :</label>
     <select id="envioselect" name="envioselect" tabindex="6" class="form-control redondear selectTranparent" required>
      <option value="0" selected>Seleccione un opción</option>
      <option value="1" >Rechazada por problemas de integración</option>
      <option value="2" >Judicializada por Otro Delito</option>
      <option value="3" >Judicializada por Otra Victima</option>
      <option value="4" >Judicializada por Otro Imputado</option>
     </select>
    </div>
   </div><br>

   <div class="row">
    <div class="col-xs-12">

       <div class="col-xs-12">

     <label style="font-weight:bold">.</label>
     <center><button style="width: 100%;" type="button" id="btnSaveNuc" class="btn btn-success redondear" onclick="saveCarpetJudicid(<? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $estatResolucion; ?>, <? echo $idUnidad; ?>, <? echo $deten; ?>)">Agregar NUC</button></center>
    </div>

    </div>
   </div><br>

 

  <?



 break;


 case 'validateJudicializte2':


 $arreglo[0] = "NO"; /// SE EJECUTARIA EL METODO DE GUARDAR POR QUE NO HAY UNA JUDICIALIZADA ANTES
 $arreglo[1] = "SI"; 


 if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
 if (isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }
 if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
 if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
 if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }    
 if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }   
 if (isset($_POST["deten"])){ $deten = $_POST["deten"]; }   

 $datossicap=get_datos_carpeta_capturado($conSic, $nuc);
 $idCarpeta = $datossicap[0][0];   

 $dataLasResol = getLastResolJudicializateCarpet($conn, $idCarpeta); 

 if($dataLasResol != null){


  echo json_encode(   array(  'first'=>$arreglo[1]   )   );


 }else{



   echo json_encode(   array(  'first'=>$arreglo[0]   )   );


 }

 break;




 case 'updateTramites':



  if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
  if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
  if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
  
  $arreglo[0] = "NO"; 
  $arreglo[1] = "SI"; 
  $arreglo[2] = "NOS"; 

  $mpsList = getMpsEnlaceUnidadFormato($conn, $idEnlace, 1);
  $band = 0; //// bandera para saber si ya fueron capturados todos los mps del enlace si alguno no esta capturado entonces no se pued enviar la informacion


  for ($i = 0; $i < sizeof($mpsList); $i++) {

    $dataCarpe = getDataCarpeDatos($conn, $mpsList[$i][4], $mes, $anio, $mpsList[$i][3]);
    if($dataCarpe[0][0] == null){    $band = 1;    break;    }

  }

  if($band == 1 ){ echo json_encode(   array(  'first'=>$arreglo[2]   )   ); } /// NO SE PUEDE ENVIAR
  else{

    $bande = 0;

    for ($j = 0; $j < sizeof($mpsList); $j++) {

      if ($mes == 1) {
        $mesAnterior = 12;
        $anioAnte = ($anio - 1);
      } else {
        $anioAnte = $anio;
        $mesAnterior = ($mes - 1);
      }


        //// IR ACTUALIZANDO CADA UNO DE LOS TRAMITES POR MP
        $tramis = getTramitesActuales2022($conn, $mpsList[$j][3], $mpsList[$j][4], $anio, $mes);
        $tramisAnte = getTramitesActuales2022($conn, $mpsList[$j][3], $mpsList[$j][4], $anioAnte, $mesAnterior);
    
        $queryTransaction = "  
        BEGIN                     
        BEGIN TRY 
        BEGIN TRANSACTION
        SET NOCOUNT ON
     
        UPDATE carpetasDatos SET tramitee = ".$tramis." WHERE idMp = ".$mpsList[$j][4]." AND idAnio = ".$anio." AND idMes = ".$mes." AND idUnidad = ".$mpsList[$j][3]."
        UPDATE carpetasDatos SET tramiteAnterior = ".$tramisAnte." WHERE idMp = ".$mpsList[$j][4]." AND idAnio = ".$anio." AND idMes = ".$mes." AND idUnidad = ".$mpsList[$j][3]."
     
        COMMIT
        END TRY
        BEGIN CATCH 
        ROLLBACK TRANSACTION
        RAISERROR('No se realizo la transaccion',16,1)
        END CATCH
        END
        ";  

        //echo $queryTransaction."<br>";

        $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));  
        if ($result){}else{
          $bande = 1; break;          
        }  
    }

    if($bande == 0){
      echo json_encode(   array(  'first'=>$arreglo[1]   )   ); /// SE PUEDE ENVIAR Y SE ACTUALIZO
    }
    if($bande == 1){
      echo json_encode(   array(  'first'=>$arreglo[0]   )   );/// NO SE PUEDE ENVIAR HUBO UN ERROR
    }
   
  }
  break;






}    




?>