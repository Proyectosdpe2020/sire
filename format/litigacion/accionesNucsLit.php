<?php

  include ("../../Conexiones/conexionSicap.php");
	include("../../funcioneSicap.php");

 include ("../../Conexiones/Conexion.php");
 include("../../funciones.php");
  include("../../funcioneLit.php");

	

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


           if( $estatResolucion != 19 || $estatResolucion != 7 ||$estatResolucion != 15 ||$estatResolucion != 13 ||$estatResolucion != 14 ){
              //////// Ver la determinacion si ya existe en tabla estatusNucs ///////////////////
               $carpeAgente = getDistincCarpetasAgenteLitigacion($conn, $idMp, $estatResolucion, $mes, $anio); 
            }else{
               ///OBTENER LAS CARPETAS DEL AGENTE ESTO EN SICAP
               $carpeAgente = getDistincCarpetasAgente($conSic, $idMp, $estatResolucion, $mes, $anio, $deten); 
            }       



          $numResol = 0;


          for ($i=0; $i < sizeof($carpeAgente); $i++) { 
            
                   
                          $numResol++;
                    
              

          }


          if($numResol >= $numcasos){   echo json_encode(array('first'=>$arreglo[1]));   }elseif ($numResol < $numcasos) {
            echo json_encode(array('first'=>$arreglo[0]));
          }

          break;  

////////////// Revisa si un nuca ya existe o no         

      case 'checkinsert':

          if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
          if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
          if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
          if (isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }

          
          $datossicap=get_datos_carpeta_capturado($conSic, $nuc);
          $idCarpeta = $datossicap[0][0];       


          $arreglo[0] = "SI";
          $arreglo[1] = "NO";

          if( $estatResolucion != 19  ||$estatResolucion != 15 ||$estatResolucion != 13 ||$estatResolucion != 14 ){

              //////// Ver la determinacion si ya existe en tabla estatusNucs ///////////////////
              $lastDetermin = getLastDeterminacionCarpetaLitigacion($conn, $nuc, $estatResolucion);
            

            }else{

                 ///////////// Se obtiene la ultima determinacion para saber en que unidad esta ESTO EN SICAP
              $lastDetermin = getLastDeterminacionCarpetaEsta($conSic, $idCarpeta, $estatResolucion, $mes); 

            }

         



            $idResolMP = $lastDetermin[0][0];
            $carpid = $lastDetermin[0][1];
            $idUnidade = $lastDetermin[0][2];

         // $nucinfo = getExisteNuc($conSic, $idCarpeta, $idUnidad);

          if ($idUnidad == $idUnidade) {  echo json_encode(array('first'=>$arreglo[0]));  
          }else{ 

            echo json_encode(array('first'=>$arreglo[1])); 
          }
          
          break; 

////////////////  INSERTA LOS DATOS DE LA NUEVA RESOLUCION QUE SE PRODUCE AL CAMBIAR EL ESTATUS 

        case 'insertNuc':


        $arreglo[0] = "SI";
        $arreglo[1] = "NO";

        if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
        if (isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }
        if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
        if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
        if (isset($_POST["deten"])){ $deten = $_POST["deten"]; }  
        if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }

          
           if( $estatResolucion != 19 ){

              //////// Ver la determinacion si ya existe en tabla estatusNucs ///////////////////
              $datossicap=get_datos_carpeta_capturadoLiti($conSic, $nuc);



                    $nuc = $datossicap[0][1];  
                    $carpid = $datossicap[0][0];                      


               


                      $queryTransaction = "  
                            
                            BEGIN                     
                            BEGIN TRY 
                              BEGIN TRANSACTION
                                  SET NOCOUNT ON    
                               
                                              INSERT INTO estatusNucs (nuc, idEstatus, idmp, idUnidad, fecha, anio, mes, idCarpeta) VALUES ('$nuc', $estatResolucion, $idMp, $idUnidad, GETDATE(), $anio, $mes, $carpid)             

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
            

                    



            }else{

                 ///////////// Se obtiene la ultima determinacion para saber en que unidad esta ESTO EN SICAP
              $datossicap=get_datos_carpeta_capturado($conSic, $nuc);

                  $exped = $datossicap[0][2];
                  $carpid = $datossicap[0][0];                  

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
                    

                    }
        
        break;

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
                                                      <th class="col-xs-4 col-sm-4 col-md-4 textCent">Numero Caso </th>
                                                      <th class="col-xs-6 col-sm-6 col-md-6 textCent">Expediente</th>          
                                                      <th class="col-xs-1 col-sm-1 col-md-1 textCent">Acción</th>
                                           </tr>
                                    </thead>
                                    <tbody>
                          
                                        
                                         

                                   <?                                 

                                  //// Obtener las carpetas del Mp 
                                  $sumador = 0; 
                                  $carpeAgente = getDistincCarpetasAgenteLitigacion($conn, $idMp, $estatResolucion, $mes, $anio, $idUnidad);

                                  for ($i=0; $i < sizeof($carpeAgente) ; $i++) { 

                                    $nuc = $carpeAgente[$i][0];
                                    //// Por cada Carpeta Obtener la Ultima Determinacion que se realizo
                                       $lastDetermin = getLastDeterminacionCarpetaLitig($conn, $nuc);
                                       
                                       for ($k=0; $k < sizeof($lastDetermin); $k++) { 

                                          $idEstatusNucs = $lastDetermin[$k][0];
                                          $nuc = $lastDetermin[$k][1];
                                          $idUnidade = $lastDetermin[$k][2];
                                          $EstatusID = $lastDetermin[$k][3];
                                          $idCarpeta = $lastDetermin[$k][4];

                                                                        

                                           $nucs = getNucExpSicap($conSic, $idCarpeta);
                                           $nuc = $nucs[0][0];
                                           $exp = $nucs[0][1];      

                                           ?>
                                           <tr>
                                            
                                              <td class="tdRowMain negr"><? echo ($sumador+1); ?></td>
                                              <td class="tdRowMain negr"><? echo $nuc; ?></td>
                                              <td class="tdRowMain negr"><? echo $exp; ?></td>

                                              <td class="tdRowMain"><center> <button type="button" onclick="deleteResolLit(<? echo $idEstatusNucs; ?>, <? echo $idMp; ?>, <? echo $anio; ?>, <? echo $mes; ?>, <? echo $estatResolucion ?>, <? echo $nuc; ?>, <? echo $idUnidad; ?>)" class="btn btn-warning btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-trash"></span> Eliminar </button></center></td>

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

                          <td class="tdRowMain"><center> <button type="button" onclick="deleteResol(<? echo $idResolMP; ?>, <? echo $idMp; ?>, <? echo $anio; ?>, <? echo $mes; ?>, <? echo $estatResolucion ?>, <? echo $nuc; ?>, <? echo $deten; ?>, <? echo $idUnidad; ?>)" class="btn btn-warning btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-trash"></span> Eliminar </button></center></td>

                       </tr>
                     <?
                  }

                   ?>



                    </tbody>

                     </table>
                
              <?
        
        break;

//////////////////////// ELIMINA UNA RESOLUCION SI ES QUE SE LE REQUIERE

        case 'deleteResol':
        

         $arreglo[0] = "SI";
         $arreglo[1] = "NO";

          if (isset($_POST["idEstatusNucs"])){ $idEstatusNucs = $_POST["idEstatusNucs"]; }
          if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
          if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
          if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
          if (isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }
          if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
          if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }

  

              $queryTransaction = "                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON
                                   
                             DELETE FROM estatusNucs WHERE idEstatus = $estatResolucion AND idMp = $idMp AND anio = $anio AND mes = $mes AND nuc = $nuc AND idUnidad = $idUnidad

                          COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";


                 // echo $queryTransaction;
                  $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));  
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

          ///////////////////////////// CICLO PARA CREAR LOS INPUTS CON LA CANTIDAD DE NUCS POR CADA ESTATUS /////////////////////////////

          $vari = "valor";

          $arregloEsatusLit = array( 1,2,3,4,5,6,7,10,12,98,97,96,17,18,95,20,21,22,23,24,25,26,27,28,29,30,31,89,99,90,91,93,32,33,34,35,36,38,40,41,43,44,45,46,48,49,50,53,57,58,60,61,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88 );

         
          for ($p=0; $p < sizeof($arregloEsatusLit) ; $p++) {                 



                if($p != 9 &&  $p != 10  &&  $p != 11 &&  $p != 14){

                      $valor = getLAstResolucionesFromAdetermLit($conn, $idMp, $arregloEsatusLit[$p], $mes, $anio, 0, $idUnidad);

                      ?> 
                      <input id="valor<? echo $arregloEsatusLit[$p]; ?>" type="hidden" value="<? echo $valor; ?>" name="">
                      <?

                }else{


                if($p == 9){

                          $valor = getLAstResolucionesFromAdetermLit($conn, $idMp, $arregloEsatusLit[9], $mes, $anio, 0, $idUnidad);

                          ?> 
                          <input id="valor13" type="hidden" value="<? echo $valor; ?>" name="">
                          <?
                      }

                         if($p == 10){
                          $valor = getLAstResolucionesFromAdetermLit($conn, $idMp, $arregloEsatusLit[10], $mes, $anio, 0, $idUnidad);
                          ?> 
                          <input id="valor14" type="hidden" value="<? echo $valor; ?>" name="">
                          <?
                      }

                         if($p == 11){
                          $valor = getLAstResolucionesFromAdetermLit($conn, $idMp, $arregloEsatusLit[11], $mes, $anio, 0, $idUnidad);
                          ?> 
                          <input id="valor15" type="hidden" value="<? echo $valor; ?>" name="">
                          <?
                      }

                            if($p == 14){
                          $valor = getLAstResolucionesFromAdetermLit($conn, $idMp, $arregloEsatusLit[14], $mes, $anio, 0, $idUnidad);
                          ?> 
                          <input id="valor19" type="hidden" value="<? echo $valor; ?>" name="">
                          <?
                      }

                }
                
          }

          //// para los campos de SICAP

          $vincproceso = getLAstResolucionesFromAdetermLitigSicap($conSic, $idMp, 19, $mes, $anio, 0, $idUnidad);
          $scproceso = getLAstResolucionesFromAdetermLitigSicap($conSic, $idMp, 15, $mes, $anio, 0, $idUnidad);
          $proAbre = getLAstResolucionesFromAdetermLitigSicap($conSic, $idMp, 13, $mes, $anio, 0, $idUnidad);
          $condena = getLAstResolucionesFromAdetermLitigSicap($conSic, $idMp, 14, $mes, $anio, 0, $idUnidad);

          ?>

          <input id="vincproceso" type="hidden" value="<? echo $vincproceso; ?>" name="">
          <input id="scproceso" type="hidden" value="<? echo $scproceso; ?>" name="">
          <input id="proAbre" type="hidden" value="<? echo $proAbre; ?>" name="">
          <input id="condena" type="hidden" value="<? echo $condena; ?>" name="">

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
          <?


          break;


           case 'getDataNuc':
          
          //// SE OBTIENE EL NOMBRE DEL ULTIMO MP DE LA MISMA UNIDAD QUE HIZO LA DETERMINACION /////

          if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
          if (isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }
          if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }


            $datossicap=get_datos_carpeta_capturado($conSic, $nuc);
            $idCarpeta = $datossicap[0][0];   


            if( $estatResolucion != 19 ){

              //////// Ver la determinacion si ya existe en tabla estatusNucs ///////////////////
            $lastdeterm = getLastDeterminacionCarpetaLitigacion($conn, $nuc, $estatResolucion);
            

            }  else{

            //////// Ver la determinacion si ya existe en SICAP tabla Resoluciones ///////////////////
            $lastdeterm = getLastDeterminacionCarpetaEsta2($conSic, $idCarpeta, $estatResolucion);
            
            }


            $idresol = $lastdeterm[0][0];
            $idun = $lastdeterm[0][2];
            $idagen = $lastdeterm[0][3];

            if($idresol != ""){

                  
            $nmp = getNombreMP($conn, $idagen); 

            $nommp = $nmp[0][0]; $paternoMp = $nmp[0][1]; $maternoMp = $nmp[0][2];
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
         
          
            if($aux=get_nuc_sicap ($nuc,$conSic)){  echo json_encode(array('first'=>$arreglo[0]));  }else{

                echo json_encode(array('first'=>$arreglo[1]));

            }


          break; 


                case 'existeNuclitigacion':
          
          //// SE OBTIENE EL NOMBRE DEL ULTIMO MP DE LA MISMA UNIDAD QUE HIZO LA DETERMINACION /////
            $arreglo[0] = "SI";
            $arreglo[1] = "NO";
            
            if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
            if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
            if (isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }
            if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
            if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
            if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
   
            /// SI LOS ESTATUS SON AUDIENCIAS, FORMULACIONES, ORDENES APREHENSION, VINCULACIONES A PROCESO
            if($estatResolucion == 60 || $estatResolucion == 61 || $estatResolucion == 63 || $estatResolucion == 50 || $estatResolucion == 53 || $estatResolucion == 3 || $estatResolucion == 4 || $estatResolucion == 5 || $estatResolucion == 10 || $estatResolucion == 12 || $estatResolucion == 78){

                echo json_encode(array('first'=>$arreglo[0]));

            }else{

                    $existe =  get_existeCarpetaNucsLiti($conn, $nuc, $anio, $mes, $idMp, $idUnidad, $estatResolucion); 

                    if($existe){ echo json_encode(array('first'=>$arreglo[1])); }else{

                        echo json_encode(array('first'=>$arreglo[0]));

                    }

            }


         

          break; 

 


 


    
    }    




?>