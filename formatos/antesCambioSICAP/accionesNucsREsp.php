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

          if (isset($_POST["numcasos"])){ $numcasos = $_POST["numcasos"]; }

          $nucResol2 = getResolucionesMP($conn, $idMp, $estatResolucion, $mes, $anio, $deten);
          $numResol = sizeof($nucResol2);

          if($numResol >= $numcasos){   echo json_encode(array('first'=>$arreglo[1]));   }elseif ($numResol < $numcasos) {
            echo json_encode(array('first'=>$arreglo[0]));
          }

          break;  

////////////// Revisa si un nuca ya existe o no         

      case 'checkinsert':

          if (isset($_POST["acc"])){ $acc = $_POST["acc"]; }
          if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }


          $arreglo[0] = "SI";
          $arreglo[1] = "NO";

          $nucinfo = getExisteNuc($conn, $nuc);

          if ($nucinfo) {  echo json_encode(array('first'=>$arreglo[0]));  
          }else{ 

            echo json_encode(array('first'=>$arreglo[1])); 
          }
          
          break; 



        case 'insertNuc':

        $arreglo[0] = "SI";
        $arreglo[1] = "NO";


        $nucinfo = getExisteNuc($conn, $nuc);  

        if ($nucinfo) {  echo json_encode(array('first'=>$arreglo[0]));  
          }else{ 


          $datossicap=get_datos_carpeta_capturado($conSic, $nuc);
          $exped = $datossicap[0][2];

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

                        IF EXISTS (SELECT  idResolucionMp, idMp, idEstatusResolucion, mes, anio, nuc, expediente FROM resolucionMP WHERE idMp = $idMp AND idEstatusResolucion = $estatResolucion AND mes = $mes AND anio = $anio AND deten = $deten AND nuc = $nuc)                         
                        BEGIN
                            select 'si'
                        END
                        ELSE
                        BEGIN
                            INSERT INTO resolucionMP (idMp, idEstatusResolucion, mes, anio, nuc, Expediente, deten) VALUES ($idMp, $estatResolucion, $mes, $anio, '$nuc', '$exped', $deten)
                        END        



                          COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";           

                  $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));  
          


                if ($result) {
                    echo json_encode(array('first'=>$arreglo[0]));
                  }else{
                    echo json_encode(array('first'=>$arreglo[1]));
                  }
            
          }
        
        break;



        case 'showtable':

          if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
          if (isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }
          if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
          if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
          if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
          if (isset($_POST["deten"])){ $deten = $_POST["deten"]; }


         
         

          

              $nucResol = getResolucionesMP($conn, $idMp, $estatResolucion, $mes, $anio, $deten);
              

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
               $numResolJudi = sizeof($nucResol);

                    for ($i=0; $i < sizeof($nucResol) ; $i++) { 
                 
                 $idResolMP = $nucResol[$i][0];
                 $nuc = $nucResol[$i][5];
                 $exp = $nucResol[$i][6];

                 ?>
                   <tr>
                    
                      <td class="tdRowMain negr"><? echo ($i+1); ?></td>
                      <td class="tdRowMain negr"><? echo $nuc; ?></td>
                      <td class="tdRowMain negr"><? echo $exp; ?></td>

                      <td class="tdRowMain"><center> <button type="button" onclick="deleteResol(<? echo $idResolMP; ?>, <? echo $idMp; ?>, <? echo $anio; ?>, <? echo $mes; ?>, <? echo $estatResolucion ?>, <? echo $nuc; ?>, <? echo $deten; ?>)" class="btn btn-warning btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-trash"></span> Eliminar </button></center></td>

                   </tr>
                 <?
              }

               ?>



                </tbody>

                 </table>
             
              <?
        
        break;

        case 'showtable2':

          if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
          if (isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }
          if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
          if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }         
           if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
          if (isset($_POST["deten"])){ $deten = $_POST["deten"]; }

              $nucResol2 = getResolucionesMP($conn, $idMp, $estatResolucion, $mes, $anio, $deten);

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
                     $nuc = $nucResol2[$j][5];
                     $exp = $nucResol2[$j][6];

                     ?>
                       <tr>
                        
                          <td class="tdRowMain negr"><? echo ($j+1); ?></td>
                          <td class="tdRowMain negr"><? echo $nuc; ?></td>
                          <td class="tdRowMain negr"><? echo $exp; ?></td>

                          <td class="tdRowMain"><center> <button type="button" onclick="deleteResol(<? echo $idResolMP; ?>, <? echo $idMp; ?>, <? echo $anio; ?>, <? echo $mes; ?>, <? echo $estatResolucion ?>, <? echo $nuc; ?>, <? echo $deten; ?>)" class="btn btn-warning btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-trash"></span> Eliminar </button></center></td>

                       </tr>
                     <?
                  }

                   ?>



                    </tbody>

                     </table>
                
              <?
        
        break;


        case 'deleteResol':
        

         $arreglo[0] = "SI";
         $arreglo[1] = "NO";

          if (isset($_POST["idResol"])){ $idResol = $_POST["idResol"]; }

              $queryTransaction = "  
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON
                                   
                             DELETE FROM resolucionMP WHERE idResolucionMp = $idResol

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



         case 'validateCheck':
          

         $arreglo[0] = "SI";
         $arreglo[1] = "NO";


         if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
          if (isset($_POST["estatus"])){ $estatus = $_POST["estatus"]; }
          if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
          if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }   
          if (isset($_POST["deten"])){ $deten = $_POST["deten"]; }
          if (isset($_POST["cant"])){ $cant = $_POST["cant"]; }

          $nucResol2 = getResolucionesMP($conn, $idMp, $estatus, $mes, $anio, $deten);
          $numResolJudi = sizeof($nucResol2);



          if ($numResolJudi < $cant) {
            echo json_encode(array('first'=>$arreglo[1]));
          }else if ( $numResolJudi > $cant ) {
            echo json_encode(array('first'=>$arreglo[1]));
          }else { 

                if( $numResolJudi == $cant ){ echo json_encode(array('first'=>$arreglo[0])); }

          }


          break;

          case 'validateitok':
          

         $arreglo[0] = "SI";
         $arreglo[1] = "NO";


          if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
          if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
          if (isset($_POST["anio"])){ $anio = $_POST["anio"]; } 

          $condetenido = getResolucionesMPtotal($conn, $idMp, 8, $mes, $anio, 2);
          $sindetenido = getResolucionesMPtotal($conn, $idMp, 8, $mes, $anio, 1);
          $absten = getResolucionesMPtotal($conn, $idMp, 2, $mes, $anio, 0);
          $archte = getResolucionesMPtotal($conn, $idMp, 5, $mes, $anio, 0);
          $neap = getResolucionesMPtotal($conn, $idMp, 20, $mes, $anio, 0);
          $med = getResolucionesMPtotal($conn, $idMp, 18, $mes, $anio, 0);
          $conci = getResolucionesMPtotal($conn, $idMp, 17, $mes, $anio, 0);
          $crieter = getResolucionesMPtotal($conn, $idMp, 1, $mes, $anio, 0);
          $scp = getResolucionesMPtotal($conn, $idMp, 15, $mes, $anio, 0);
          $incompe = getResolucionesMPtotal($conn, $idMp, 21, $mes, $anio, 0);
          $acuml = getResolucionesMPtotal($conn, $idMp, 3, $mes, $anio, 0);  


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
          <?


          break;


           case 'validateitokUpd':
          

         $arreglo[0] = "SI";
         $arreglo[1] = "NO";


          if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
          if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
          if (isset($_POST["anio"])){ $anio = $_POST["anio"]; } 

          $condetenidoUpd = getResolucionesMPtotal($conn, $idMp, 8, $mes, $anio, 2);
          $sindetenidoUpd = getResolucionesMPtotal($conn, $idMp, 8, $mes, $anio, 1);
          $abstenUpd = getResolucionesMPtotal($conn, $idMp, 2, $mes, $anio, 0);
          $archteUpd = getResolucionesMPtotal($conn, $idMp, 5, $mes, $anio, 0);
          $neapUpd = getResolucionesMPtotal($conn, $idMp, 20, $mes, $anio, 0);
          $medUpd = getResolucionesMPtotal($conn, $idMp, 18, $mes, $anio, 0);
          $conciUpd = getResolucionesMPtotal($conn, $idMp, 17, $mes, $anio, 0);
          $crieterUpd = getResolucionesMPtotal($conn, $idMp, 1, $mes, $anio, 0);
          $scpUpd = getResolucionesMPtotal($conn, $idMp, 15, $mes, $anio, 0);
          $incompeUpd = getResolucionesMPtotal($conn, $idMp, 21, $mes, $anio, 0);
          $acumlUpd = getResolucionesMPtotal($conn, $idMp, 3, $mes, $anio, 0);  


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




    
    }    




?>