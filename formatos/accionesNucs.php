<?php

  include ("../Conexiones/conexionSicap.php");
	include("../funcioneSicap.php");

 include ("../Conexiones/Conexion.php");
 include("../funciones.php");

	

  if (isset($_POST["acc"])){ $acc = $_POST["acc"]; }
  if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }

switch ($acc) {

      case 'getExp':

          $datossicap=get_datos_carpeta_capturado($conSic, $nuc);
              ?> 
              <div id="expedCont">
                <input id="expediente"  type=""   name="expediente" value="<? echo $datossicap[0][2]; ?>"  tabindex="0"  placeholder="" style="height:38px;"  class="fechas form-control redondear"  disabled/>
              </div>  
              <?
        
        break;

      case 'caninsert':

          $arreglo[0] = "SI";
          $arreglo[1] = "NO";  
          if (isset($_POST["acc"])){ $acc = $_POST["acc"]; }
          if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
          if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
          if (isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }
          if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
          if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
          if (isset($_POST["deten"])){ $deten = $_POST["deten"]; }
          if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }

          if (isset($_POST["numcasos"])){ $numcasos = $_POST["numcasos"]; }


          ///OBTENER LAS CARPETAS DEL AGENTE
          $carpeAgente = getDistincCarpetasAgente($conSic, $idMp, $estatResolucion, $mes, $anio, $deten);
          $numResol = 0;
          for ($i=0; $i < sizeof($carpeAgente); $i++) { 
            
              $CaepetaId = $carpeAgente[$i][0];
              $lastDetermin = getLastDeterminacionCarpetaEsta2($conSic, $CaepetaId, $estatResolucion);

              for ($k=0; $k < sizeof($lastDetermin); $k++) { 

                  $idUnidade = $lastDetermin[$k][2];                
                    if ($idUnidad == $idUnidade) {
                          $numResol++;
                    }
              }

          }


          if($numResol >= $numcasos){   echo json_encode(array('first'=>$arreglo[1]));   }elseif ($numResol < $numcasos) {
            echo json_encode(array('first'=>$arreglo[0]));
          }

          break;  



              case 'caninsertLit':

          $arreglo[0] = "SI";
          $arreglo[1] = "NO";  
          if (isset($_POST["acc"])){ $acc = $_POST["acc"]; }
          if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
          if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
          if (isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }
          if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
          if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
          if (isset($_POST["deten"])){ $deten = $_POST["deten"]; }
          if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }

          if (isset($_POST["numcasos"])){ $numcasos = $_POST["numcasos"]; }


          ///OBTENER LAS CARPETAS DEL AGENTE
          $carpeAgente = getDistincCarpetasAgente($conSic, $idMp, $estatResolucion, $mes, $anio, $deten);
          $numResol = 0;
          for ($i=0; $i < sizeof($carpeAgente); $i++) { 
            
              $CaepetaId = $carpeAgente[$i][0];
              $lastDetermin = getLastDeterminacionCarpetaEsta2($conSic, $CaepetaId, $estatResolucion);

              for ($k=0; $k < sizeof($lastDetermin); $k++) { 

                  $idUnidade = $lastDetermin[$k][2];                
                    if ($idUnidad == $idUnidade) {
                          $numResol++;
                    }
              }

          }


          if($numResol >= $numcasos){   echo json_encode(array('first'=>$arreglo[1]));   }elseif ($numResol < $numcasos) {
            echo json_encode(array('first'=>$arreglo[0]));
          }

          break;  

////////////// Revisa si un nuca ya existe o no         

      case 'checkinsert':


          if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
          if (isset($_POST["acc"])){ $acc = $_POST["acc"]; }
          if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
          if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
          if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
          if (isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }

          $datossicap=get_datos_carpeta_capturado($conSic, $nuc);
          $idCarpeta = $datossicap[0][0];       


          $arreglo[0] = "SI";
          $arreglo[1] = "NO";

          ///////////// Se obtiene la ultima determinacion para saber en que unidad esta
          $lastDetermin = getLastDeterminacionCarpetaEsta($conSic, $idCarpeta, $estatResolucion, $mes, $anio);

            $idResolMP = $lastDetermin[0][0];
            $carpid = $lastDetermin[0][1];
            $idUnidade = $lastDetermin[0][2];

         // $nucinfo = getExisteNuc($conSic, $idCarpeta, $idUnidad);

          if ($idUnidad == $idUnidade) {  echo json_encode(array('first'=>$arreglo[0]));  
          }else{ 

            echo json_encode(array('first'=>$arreglo[1])); 
          }
          
          break; 


            case 'checkinsertlit':


          if (isset($_POST["acc"])){ $acc = $_POST["acc"]; }
          if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
          if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
          if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
          if (isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }

          $datossicap=get_datos_carpeta_capturado($conSic, $nuc);
          $idCarpeta = $datossicap[0][0];       


          $arreglo[0] = "SI";
          $arreglo[1] = "NO";

          ///////////// Se obtiene la ultima determinacion para saber en que unidad esta
          $lastDetermin = getLastDeterminacionCarpetaEsta($conSic, $idCarpeta, $estatResolucion, $mes);

            $idResolMP = $lastDetermin[0][0];
            $carpid = $lastDetermin[0][1];
            $idUnidade = $lastDetermin[0][2];

         // $nucinfo = getExisteNuc($conSic, $idCarpeta, $idUnidad);

          if ($idUnidad == $idUnidade) {  echo json_encode(array('first'=>$arreglo[0]));  
          }else{ 

            echo json_encode(array('first'=>$arreglo[1])); 
          }
          
          break; 

////////////////  INSER

////////////////  INSERTA LOS DATOS DE LA NUEVA RESOLUCION QUE SE PRODUCE AL CAMBIAR EL ESTATUS 

        case 'insertNuc':


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

              $queryTransaction = "  
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON    
                       
                            INSERT INTO Resoluciones (CarpetaID, Fechaoficio, Fechaingreso, Judicializada, CatModalidadesEstadisticasID, EstatusID, AgenteID, UsuarioID, NumOficio, deten, mes, anio, idUnidad) VALUES ($carpid, GETDATE(), GETDATE(), 0, 0, $estatResolucion, $idMp, 0, 'S/O', $deten, $mes, $anio, $idUnidad)                       

                          COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";           

                  $result = sqlsrv_query($conSic,$queryTransaction, array(), array( "Scrollable" => 'static' ));  
          
                  //echo $queryTransaction;

                if ($result) {
                    echo json_encode(array('first'=>$arreglo[0]));
                  }else{
                    echo json_encode(array('first'=>$arreglo[1]));
                  }
            
     
        
        break;


        case 'insertNucLit':


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

              $queryTransaction = "  
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON    
                       
                            INSERT INTO Resoluciones (CarpetaID, Fechaoficio, Fechaingreso, Judicializada, CatModalidadesEstadisticasID, EstatusID, AgenteID, UsuarioID, NumOficio, deten, mes, anio, idUnidad) VALUES ($carpid, GETDATE(), GETDATE(), 0, 0, $estatResolucion, $idMp, 0, 'S/O', $deten, $mes, $anio, $idUnidad)                       

                          COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";           

                  $result = sqlsrv_query($conSic,$queryTransaction, array(), array( "Scrollable" => 'static' ));  
          
                  //echo $queryTransaction;

                if ($result) {
                    echo json_encode(array('first'=>$arreglo[0]));
                  }else{
                    echo json_encode(array('first'=>$arreglo[1]));
                  }
            
     
        
        break;


////////////////////


 case 'showtablelit':

          if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
          if (isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }
          if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
          if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
          if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
          if (isset($_POST["deten"])){ $deten = $_POST["deten"]; }    
          if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }        

           $validaInfo =  validarEstatusShowInfoSica($estatResolucion);          

              ?>
                 
                  <table class="table table-striped tblTransparente">
                                        <thead>
                                           <tr class="cabezeraTabla">
                                                      <th class="col-xs-1 col-sm-1 col-md-1 textCent">No</th>
                                                      <th class="col-xs-5 col-sm-4 col-md-5 textCent">Numero Caso </th>
                                                      <th class="col-xs-5 col-sm-6 col-md-5 textCent">Expediente</th>
                                 <? if($validaInfo){?><th class="col-xs-1 col-sm-1 col-md-1 textCent">Acción</th><? } ?>       
                                                      <th class="col-xs-1 col-sm-1 col-md-1 textCent">Acción</th>
                                           </tr>
                                    </thead>
                                    <tbody>

                                   <?                                 

                                  //// Obtener las carpetas del Mp 
                                       $sumador = 0; 
                                  $carpeAgente = getDistincCarpetasAgenteLiti($conSic, $idMp, $estatResolucion, $mes, $anio, $deten);
                                  
                                  for ($i=0; $i < sizeof($carpeAgente) ; $i++) { 

                                      $resolid = $carpeAgente[$i][0];
                                      $CaepetaId = $carpeAgente[$i][1];
                                      $idUnidadesde = $carpeAgente[$i][2];
                               
                                          if ($idUnidad == $idUnidadesde) {
                                           
                                           $nucs = getNucExpSicap($conSic, $CaepetaId);
                                           $nuc = $nucs[0][0];
                                           $exp = $nucs[0][1];      

                                           ?>
                                           <tr>
                                            
                                              <td class="tdRowMain negr"><? echo ($sumador+1); ?></td>
                                              <td class="tdRowMain negr"><? echo $nuc; ?></td>
                                              <td class="tdRowMain negr"><? echo $exp; ?></td>
                                              <? if($validaInfo){?>
                                              <td class="tdRowMain"><center><button type="button" onclick="showModalNucLitSicaInfo(<? echo $resolid; ?>,  <? echo $estatResolucion ?>, <? echo $nuc; ?>)" class="btn btn-success btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-pencil"></span> Agregar </button></center></td>
                                              <? } ?>

                                              <td class="tdRowMain"><center><button type="button" onclick="deleteResol(<? echo $resolid; ?>, <? echo $idMp; ?>, <? echo $anio; ?>, <? echo $mes; ?>, <? echo $estatResolucion ?>, <? echo $nuc; ?>, <? echo $deten; ?>, <? echo $idUnidad; ?>)" class="btn btn-warning btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-trash"></span> Eliminar </button></center></td>

                                           </tr>
                                           <?  
                                           $sumador++;
                                          } 
                                  }


                                   ?>
                                    </tbody>
                                </table>

                
             
              <?
        
        break;


/////////////////////




/////////////////////// MUESTRA LOS DATOS AL ACTUALIZAR O INSERTAR UN REGISTRO

        case 'showtable':

          if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
          if (isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }
          if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
          if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
          if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
          if (isset($_POST["deten"])){ $deten = $_POST["deten"]; }    
          if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }        

                        

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



                                  //// Obtener las carpetas del Mp 
                                       $sumador = 0; 
                                  $carpeAgente = getDistincCarpetasAgente($conSic, $idMp, $estatResolucion, $mes, $anio, $deten);
                                  
 
                                  for ($i=0; $i < sizeof($carpeAgente) ; $i++) { 

                                    $CaepetaId = $carpeAgente[$i][0];
                                    //// Por cada Carpeta Obtener la Ultima Determinacion que se realizo
                                       $lastDetermin = getLastDeterminacionCarpeta($conSic, $CaepetaId);
                                       for ($k=0; $k < sizeof($lastDetermin); $k++) { 

                                          $idResolMP = $lastDetermin[$k][0];
                                          $carpid = $lastDetermin[$k][1];
                                          $idUnidade = $lastDetermin[$k][2];

                                          if ($idUnidad == $idUnidade) {
                                           
                                           $nucs = getNucExpSicap($conSic, $carpid);
                                           $nuc = $nucs[0][0];
                                           $exp = $nucs[0][1];      

                                           ?>
                                           <tr>
                                            
                                              <td class="tdRowMain negr"><? echo ($sumador+1); ?></td>
                                              <td class="tdRowMain negr"><? echo $nuc; ?></td>
                                              <td class="tdRowMain negr"><? echo $exp; ?></td>

                                              <td class="tdRowMain"><center><button type="button" onclick="deleteResol(<? echo $idResolMP; ?>, <? echo $idMp; ?>, <? echo $anio; ?>, <? echo $mes; ?>, <? echo $estatResolucion ?>, <? echo $nuc; ?>, <? echo $deten; ?>, <? echo $idUnidad; ?>)" class="btn btn-warning btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-trash"></span> Eliminar </button></center></td>

                                           </tr>
                                           <?  
                                           $sumador++;
                                          } 

                                                                      
                                       }


                                  }


                                   ?>
                                    </tbody>
                                </table>

                
             
              <?
        
        break;


////////////////////// MUESTRA LOS DATOS AL ACTUALIZAR O INSERTAR UN REGISTRO


        case 'showtable2':

          if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
          if (isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }
          if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
          if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }         
           if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
          if (isset($_POST["deten"])){ $deten = $_POST["deten"]; }

              $nucResol2 = getResolucionesMPsic($conSic, $idMp, $estatResolucion, $mes, $anio, $deten);
              

              ?>
              
                    <table class="table table-striped tblTransparente">
                        <thead>
                           <tr class="cabezeraTabla">
                                      <th class="col-xs-12 col-sm-12 col-md-1 textCent">No</th>
                                      <th class="col-xs-12 col-sm-12 col-md-5 textCent">Numero Caso </th>
                                      <th class="col-xs-12 col-sm-12 col-md-5 textCent">Expediente</th>          
                                      <th class="col-xs-12 col-sm-12 col-md-1 textCent">Acción</th>
                           </tr>
                    </thead>
                    <tbody>

                   <? 

                   $numResolJudi = sizeof($nucResol2);

                        for ($j=0; $j < sizeof($nucResol2) ; $j++) { 
                     
                     $idResolMP = $nucResol2[$j][0];
                 $carpid = $nucResol2[$j][1];

                                                     $nucs = getNucExpSicap($conSic, $carpid);
                                                     $nuc = $nucs[0][0];
                                                      $exp = $nucs[0][1];

                     ?>
                       <tr>
                        
                          <td class="tdRowMain negr"><? echo ($j+1); ?></td>
                          <td class="tdRowMain negr"><? echo $nuc; ?></td>
                          <td class="tdRowMain negr"><? echo $exp; ?></td>

                          <td class="tdRowMain"><center><button type="button" onclick="deleteResol(<? echo $idResolMP; ?>, <? echo $idMp; ?>, <? echo $anio; ?>, <? echo $mes; ?>, <? echo $estatResolucion ?>, <? echo $nuc; ?>, <? echo $deten; ?>, <? echo $idUnidad; ?>)" class="btn btn-warning btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-trash"></span> Eliminar </button></center></td>

                       </tr>
                     <?
                  }

                   ?>



                    </tbody>

                     </table>
                
              <?
        
        break;


        ///////////////////// ELIMINA RESOLUCION SI ES QUE RE REINI IO LA CARPETA ////////////////


         case 'deleteResolReini':
        

         $arreglo[0] = "SI";
         $arreglo[1] = "NO";

          if (isset($_POST["idCaperta"])){ $idCaperta = $_POST["idCaperta"]; }
          if (isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }
           if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
            if (isset($_POST["idUnidade"])){ $idUnidade = $_POST["idUnidade"]; }



              $queryTransaction = "  
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON
                                   
                             DELETE FROM Resoluciones WHERE CarpetaID = $idCaperta AND EstatusID = $estatResolucion AND AgenteID = $idMp AND idUnidad = $idUnidade

                          COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";

             
                 
                  $result = sqlsrv_query($conSic,$queryTransaction, array(), array( "Scrollable" => 'static' ));  
                if ($result) { echo json_encode(array('first'=>$arreglo[0])); }else{ echo json_encode(array('first'=>$arreglo[1]));}


          break;


//////////////////////// ELIMINA UNA RESOLUCION SI ES QUE SE LE REQUIERE

        case 'deleteResol':
        

         $arreglo[0] = "SI";
         $arreglo[1] = "NO";

          if (isset($_POST["idResol"])){ $idResol = $_POST["idResol"]; }



              $queryTransaction = "  
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON
                                   
                             DELETE FROM Resoluciones WHERE ResolucionID = $idResol

                          COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";

           
                  $result = sqlsrv_query($conSic,$queryTransaction, array(), array( "Scrollable" => 'static' ));  
                if ($result) { echo json_encode(array('first'=>$arreglo[0])); }else{ echo json_encode(array('first'=>$arreglo[1]));}


          break;


/////////////////// VALIDA SI LA CANTIDAD QUE SE ESCRBIBIO EN EL INPUT CORREPONDE A LA MISMA CANTIDAD DE NUCS REGISTRADOS


         case 'validateCheck':
          

         $arreglo[0] = "SI";
         $arreglo[1] = "NO";


         if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
          if (isset($_POST["estatus"])){ $estatus = $_POST["estatus"]; }
          if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
          if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }   
          if (isset($_POST["deten"])){ $deten = $_POST["deten"]; }
          if (isset($_POST["cant"])){ $cant = $_POST["cant"]; }

          $nucResol2 = getResolucionesMPsic($conSic, $idMp, $estatus, $mes, $anio, $deten);
          $numResolJudi = sizeof($nucResol2);



          if ($numResolJudi < $cant) {
            echo json_encode(array('first'=>$arreglo[1]));
          }else if ( $numResolJudi > $cant ) {
            echo json_encode(array('first'=>$arreglo[1]));
          }else { 

                if( $numResolJudi == $cant ){ echo json_encode(array('first'=>$arreglo[0])); }

          }


          break;

///////////// REGISTRA LOS NUMEROS DE CADA CAMPO QUE SE COMPARARA Y PODER HACER LA REVISION


          case 'validateitok':
          

         $arreglo[0] = "SI";
         $arreglo[1] = "NO";


          if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
          if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
          if (isset($_POST["anio"])){ $anio = $_POST["anio"]; } 
          if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; } 


          $condetenido = getLAstResolucionesFromAdeterm($conSic, $idMp, 22, $mes, $anio, 2, $idUnidad);
          $sindetenido = getLAstResolucionesFromAdeterm($conSic, $idMp, 22, $mes, $anio, 1, $idUnidad);
          $absten = getLAstResolucionesFromAdeterm($conSic, $idMp, 2, $mes, $anio, 0, $idUnidad);
          $archte = getLAstResolucionesFromAdeterm($conSic, $idMp, 5, $mes, $anio, 0, $idUnidad);
          $neap = getLAstResolucionesFromAdeterm($conSic, $idMp, 20, $mes, $anio, 0, $idUnidad);
          $med = getLAstResolucionesFromAdeterm($conSic, $idMp, 23, $mes, $anio, 0, $idUnidad);
          $conci = getLAstResolucionesFromAdeterm($conSic, $idMp, 24, $mes, $anio, 0, $idUnidad);
          $crieter = getLAstResolucionesFromAdeterm($conSic, $idMp, 25, $mes, $anio, 0, $idUnidad);
          $scp = getLAstResolucionesFromAdeterm($conSic, $idMp, 15, $mes, $anio, 0, $idUnidad);
          $incompe = getLAstResolucionesFromAdeterm($conSic, $idMp, 21, $mes, $anio, 0, $idUnidad);
          $acuml = getLAstResolucionesFromAdeterm($conSic, $idMp, 3, $mes, $anio, 0, $idUnidad);  
          $reini = getLAstResolucionesFromAdeterm($conSic, $idMp, 1, $mes, $anio, 0, $idUnidad); 


          ?>
                              <input id="condetenido" type="hidden" value="<? echo $condetenido; ?>" name="">
                              <input id="sindetenido" type="hidden" value="<? echo $sindetenido; ?>" name="">
                              <input id="absten" type="hidden" value="<? echo $absten; ?>" name="">
                              <input id="archte" type="hidden" value="<? echo $archte; ?>" name="">
                              <input id="neap" type="hidden" value="<? echo $neap; ?>" name="">
                              <input id="med" type="hidden" value="<? echo $med; ?>" name="">
                              <input id="conci" type="hidden" value="<? echo $conci; ?>" name="">
                              <input id="crieter" type="hidden" value="<? echo $crieter; ?>" name="">
                              <input id="scp" type="hidden" value="<? echo $scp; ?>" name="">
                              <input id="incompe" type="hidden" value="<? echo $incompe; ?>" name="">
                              <input id="acuml" type="hidden" value="<? echo $acuml; ?>" name="">
                              <input id="inpuReini" type="hidden" value="<? echo $reini; ?>" name="">
          <?


          break;


///////////// REGISTRA LOS NUMEROS DE CADA CAMPO QUE SE COMPARARA Y PODER HACER LA REVISION EN LA ACTUALIZACION


           case 'validateitokUpd':
          

         $arreglo[0] = "SI";
         $arreglo[1] = "NO";


          if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
          if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
          if (isset($_POST["anio"])){ $anio = $_POST["anio"]; } 
          if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; } 


          $reiniUp = getLAstResolucionesFromAdeterm($conSic, $idMp, 1, $mes, $anio, 0, $idUnidad); 

          $condetenidoUpd = getLAstResolucionesFromAdeterm($conSic, $idMp, 22, $mes, $anio, 2, $idUnidad);
          $sindetenidoUpd = getLAstResolucionesFromAdeterm($conSic, $idMp, 22, $mes, $anio, 1, $idUnidad);
          $abstenUpd = getLAstResolucionesFromAdeterm($conSic, $idMp, 2, $mes, $anio, 0, $idUnidad);
          
          $archteUpd = getLAstResolucionesFromAdeterm($conSic, $idMp, 5, $mes, $anio, 0, $idUnidad);
          
          $neapUpd = getLAstResolucionesFromAdeterm($conSic, $idMp, 20, $mes, $anio, 0, $idUnidad);
          $medUpd = getLAstResolucionesFromAdeterm($conSic, $idMp, 23, $mes, $anio, 0, $idUnidad);
          $conciUpd = getLAstResolucionesFromAdeterm($conSic, $idMp, 24, $mes, $anio, 0, $idUnidad);
          $crieterUpd = getLAstResolucionesFromAdeterm($conSic, $idMp, 25, $mes, $anio, 0, $idUnidad);
          $scpUpd = getLAstResolucionesFromAdeterm($conSic, $idMp, 15, $mes, $anio, 0, $idUnidad);
         
          $incompeUpd = getLAstResolucionesFromAdeterm($conSic, $idMp, 21, $mes, $anio, 0, $idUnidad);
          $acumlUpd = getLAstResolucionesFromAdeterm($conSic, $idMp, 3, $mes, $anio, 0, $idUnidad);  
          $reiniUp = getLAstResolucionesFromAdeterm($conSic, $idMp, 1, $mes, $anio, 0, $idUnidad); 


          ?>
                              <input id="condetenidoUpd" type="hidden" value="<? echo $condetenidoUpd; ?>" name="">
                              <input id="sindetenidoUpd" type="hidden" value="<? echo $sindetenidoUpd; ?>" name="">
                              <input id="abstenUpd" type="hidden" value="<? echo $abstenUpd; ?>" name="">
                              <input id="archteUpd" type="hidden" value="<? echo $archteUpd; ?>" name="">
                              <input id="neapUpd" type="hidden" value="<? echo $neapUpd; ?>" name="">
                              <input id="medUpd" type="hidden" value="<? echo $medUpd; ?>" name="">
                              <input id="conciUpd" type="hidden" value="<? echo $conciUpd; ?>" name="">
                              <input id="crieterUpd" type="hidden" value="<? echo $crieterUpd; ?>" name="">
                              <input id="scpUpd" type="hidden" value="<? echo $scpUpd; ?>" name="">
                              <input id="incompeUpd" type="hidden" value="<? echo $incompeUpd; ?>" name="">
                              <input id="acumlUpd" type="hidden" value="<? echo $acumlUpd; ?>" name="">
                              <input id="reiniUp" type="hidden" value="<? echo $reiniUp; ?>" name="">
          <?


          break;


           case 'getDataNuc':
          
          //// SE OBTIENE EL NOMBRE DEL ULTIMO MP DE LA MISMA UNIDAD QUE HIZO LA DETERMINACION /////

          if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
          if (isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }
          if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }


            $datossicap=get_datos_carpeta_capturado($conSic, $nuc);
            $idCarpeta = $datossicap[0][0];   

            $lastdeterm = getLastDeterminacionCarpetaEsta2($conSic, $idCarpeta, $estatResolucion);
            
            $idresol = $lastdeterm[0][0];
            $idun = $lastdeterm[0][2];
            $idagen = $lastdeterm[0][3];

            if($idresol != ""){

                  
  $nmp = getNombreMP($conn, $idagen); $nommp = $nmp[0][0]; $paternoMp = $nmp[0][1]; $maternoMp = $nmp[0][2];
            $nomMp = $nommp." ".$paternoMp." ".$maternoMp; 

            $nuni = getNunidad($conn, $idUnidad); 
            $nunidad = $nuni[0][0];    


          ?>
                              <input type="hidden" id="nombreMpinput" value="<? echo $nomMp; ?>">
                              <input type="hidden" id="nombreUnidadinput" value="<? echo $nunidad; ?>">
          <?
            }

          


          break; 


           case 'getDataNucLit':
          
          //// SE OBTIENE EL NOMBRE DEL ULTIMO MP DE LA MISMA UNIDAD QUE HIZO LA DETERMINACION /////

          if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
          if (isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }
          if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }


            $datossicap=get_datos_carpeta_capturado($conSic, $nuc);
            $idCarpeta = $datossicap[0][0];   

            $lastdeterm = getLastDeterminacionCarpetaEsta2($conSic, $idCarpeta, $estatResolucion);
            
            $idresol = $lastdeterm[0][0];
            $idun = $lastdeterm[0][2];
            $idagen = $lastdeterm[0][3];

            if($idresol != ""){

                  
            $nmp = getNombreMP($conn, $idagen); $nommp = $nmp[0][0]; $paternoMp = $nmp[0][1]; $maternoMp = $nmp[0][2];
            $nomMp = $nommp." ".$paternoMp." ".$maternoMp; 

            $nuni = getNunidad($conn, $idUnidad); 
            $nunidad = $nuni[0][0];    


          ?>
                              <input type="hidden" id="nombreMpinput" value="<? echo $nomMp; ?>">
                              <input type="hidden" id="nombreUnidadinput" value="<? echo $nunidad; ?>">
          <?
            }

          


          break; 




          case 'lastCheck':
          
          //// SE OBTIENE EL NOMBRE DEL ULTIMO MP DE LA MISMA UNIDAD QUE HIZO LA DETERMINACION /////

          if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
          if (isset($_POST["mesCapturar"])){ $mesCapturar = $_POST["mesCapturar"]; }
          if (isset($_POST["anioCaptura"])){ $anioCaptura = $_POST["anioCaptura"]; }


        $arrayEstatus = array(22,22,2,5,20,21,3,23,24,25,15); 
        $arrayTipoEsts = array('judCd', 'judSd', 'abst', 'arch', 'neap', 'incom', 'acum', 'medi', 'conci', 'crite', 'sucond');  
        $bandCHeckEnv = 0; // SI SE ENCUENTRA EN 0 QUIERE DECIR QUE NO SE PUEDE ENVIAR LA INFORMACION 

        ////// VALIDAR QUE LA CANTIDAD DE CARPETAS (NUCS) SEAN LA MISMA CANTIDAD QUE SE REGISTRO EN EL CAMPO //////
        $mpsListLastCheck = getMpsEnlaceUnidad($conn, $idEnlace);


        for ($h=0; $h < sizeof($mpsListLastCheck); $h++) { 

             $idMp2 = $mpsListLastCheck[$h][4];
             $idUnidad2 = $mpsListLastCheck[$h][3];
             /// OBETENER LOS DATOS DE LA CARPETA POR CADA MP arrelog que contiene los datos por cada mp que se tenga
             $datosCarpeta = getDatosCarpetaMP($conn, $idMp2, $mesCapturar, $anioCaptura, $idUnidad2);
            
             if($datosCarpeta){$capturado = 1;}else{ $capturado = 0;}/// si la bandera esta en 1 quiere decir que existe la carpeta registrada en mes y año mp en la tabla Carpetas
             $totJudCdeten = 0; $totJudSdeten = 0; $abste = 0; $arciv = 0; $neap = 0; $incompe = 0; $acumlu = 0; $media = 0; $conc = 0; 
               $criter = 0; $supecon = 0;  
             
             if($capturado == 0){ 

              $datosCarpeta[0][0] = 0; 
              $datosCarpeta[0][1] = 0;
              $datosCarpeta[0][2] = 0;
              $datosCarpeta[0][3] = 0;
              $datosCarpeta[0][4] = 0;
              $datosCarpeta[0][5] = 0;
              $datosCarpeta[0][6] = 0;
              $datosCarpeta[0][7] = 0;
              $datosCarpeta[0][8] = 0;
              $datosCarpeta[0][9] = 0;
              $datosCarpeta[0][10] = 0;

             }
     
             ////// Obtener un conteo de carpetass (NUCS) que tengan algun estaus              
             //// Ir obteniendo valores por tipo de estatus al momento que se iran comparando tambien              
             for ($q=0; $q <sizeof($arrayTipoEsts) ; $q++) { 
                   
                   if($arrayTipoEsts[$q] == 'judCd'){ $deten = 2;}else{
                   if($arrayTipoEsts[$q] == 'judSd'){ $deten = 1;}else{
                    $deten = 0;
                   }
                  }

                   $carpeAgente = getDistincCarpetasAgente($conSic, $idMp2, $arrayEstatus[$q], $mesCapturar, $anioCaptura, $deten);

                                  for ($i=0; $i < sizeof($carpeAgente) ; $i++) { 
                                      
                                       $CaepetaId = $carpeAgente[$i][0];
                                    //// Por cada Carpeta Obtener la Ultima Determinacion que se realizo
                                       $lastDetermin = getLastDeterminacionCarpeta($conSic, $CaepetaId);
                                       for ($k=0; $k < sizeof($lastDetermin); $k++) { 

                                          $idUnidade = $lastDetermin[$k][2];
                                          $EstatusID = $lastDetermin[$k][3];
                                          if ( $idUnidad2 == $idUnidade && $arrayEstatus[$q] == $EstatusID ) {
                                                  
                                                   if($arrayTipoEsts[$q] == 'judCd'){ $totJudCdeten++; }
                                                   if($arrayTipoEsts[$q] == 'judSd'){ $totJudSdeten++; }
                                                   if($arrayTipoEsts[$q] == 'abst'){ $abste++; }
                                                   if($arrayTipoEsts[$q] == 'arch'){ $arciv++; }
                                                   if($arrayTipoEsts[$q] == 'neap'){ $neap++; }
                                                   if($arrayTipoEsts[$q] == 'incom'){ $incompe++; }
                                                   if($arrayTipoEsts[$q] == 'acum'){ $acumlu++; }
                                                   if($arrayTipoEsts[$q] == 'medi'){ $media++; }
                                                   if($arrayTipoEsts[$q] == 'conci'){ $conc++; }
                                                   if($arrayTipoEsts[$q] == 'crite'){ $criter++; }
                                                   if($arrayTipoEsts[$q] == 'sucond'){ $supecon++; }                                           
                                          } 
                                                                      
                                       }


                                  }   


             }

             if($datosCarpeta[0][0] != $totJudCdeten){ $bandCHeckEnv = 0; break;  }else{ $bandCHeckEnv = 1; }
             if($datosCarpeta[0][1] != $totJudSdeten){ $bandCHeckEnv = 0; break;  }else{ $bandCHeckEnv = 1; }
             if($datosCarpeta[0][2] != $abste){$bandCHeckEnv = 0;  break;  }else{ $bandCHeckEnv = 1; }
             if($datosCarpeta[0][3] != $arciv){ $bandCHeckEnv = 0;  break;  }else{ $bandCHeckEnv = 1; }
             if($datosCarpeta[0][4] != $neap){ $bandCHeckEnv = 0; break;  }else{ $bandCHeckEnv = 1; }
             if($datosCarpeta[0][5] != $incompe){ $bandCHeckEnv = 0; break;  }else{ $bandCHeckEnv = 1; }
             if($datosCarpeta[0][6] != $acumlu){ $bandCHeckEnv = 0; break;  }else{ $bandCHeckEnv = 1; }
             if($datosCarpeta[0][7] != $media){ $bandCHeckEnv = 0; break;  }else{ $bandCHeckEnv = 1; }
             if($datosCarpeta[0][8] != $conc){ $bandCHeckEnv = 0; break;  }else{ $bandCHeckEnv = 1; }
             if($datosCarpeta[0][9] != $criter){ $bandCHeckEnv = 0; break;  }else{ $bandCHeckEnv = 1; }
             if($datosCarpeta[0][10] != $supecon){ $bandCHeckEnv = 0; break; }else{ $bandCHeckEnv = 1; }

             //echo $datosCarpeta[0][2]."-----".$abste."<br><br>"; 
             

            }
             
             $arreglo[0] = "SI";
             $arreglo[1] = "NO";


             if ($bandCHeckEnv == 1) {
               echo json_encode(array('first'=>$arreglo[0]));
             }else{
                 echo json_encode(array('first'=>$arreglo[1]));
             }
    


          break; 


             case 'existeNuc':
          

          //// SE OBTIENE EL NOMBRE DEL ULTIMO MP DE LA MISMA UNIDAD QUE HIZO LA DETERMINACION /////
            $arreglo[0] = "SI";
            $arreglo[1] = "NO";
            

            if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
            if (isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }

            if($estatResolucion == 19 ){
                 echo json_encode(array('first'=>$arreglo[0]));
            }else{
                if($aux=get_nuc_sicap ($nuc,$conSic)){  echo json_encode(array('first'=>$arreglo[0]));  }else{
                echo json_encode(array('first'=>$arreglo[1]));
                }
            }
          
            


          break; 

 


    
    }    




?>