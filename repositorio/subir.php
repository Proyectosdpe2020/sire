<?php

      header('Content-Type: text/html; charset=utf-8');
      include("../funciones.php");
      include ("../Conexiones/Conexion.php");
        
      if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
      if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }
      if (isset($_GET["mes"])){ $mes = $_GET["mes"]; }
      if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
      if (isset($_GET["oberv"])){ $oberv = $_GET["oberv"]; }
      if (isset($_GET["idTipoArch"])){ $idTipoArch = $_GET["idTipoArch"]; }



      $unInfo = getInfoUnidad($conn, $idUnidad);
      $nomUnidad = $unInfo[0][1]; 

      if($idUnidad == 106){ $nomUnidad = "delitos vinculados violencia fam"; } 
      if($idUnidad == 47){ $nomUnidad = "Fiscalia Especializada en Delitos contra el Medio Ambiente"; }
      if($idUnidad == 44){ $nomUnidad = "Fiscalia Especializada en Busqueda de Personas Desaparecidas"; }
       if($idUnidad == 48){ $nomUnidad = "Unidad de Combate al Secuestro"; }
      /// por el largo del nombre del archivo tubo que cambiar para mas corto sea

      if($idTipoArch == 11){
        $nombreReporte = "Trimestral-".$idEnlace."-".$idUnidad."-".$mes."-".$anio;
      } else{
        $nombreReporte = $nomUnidad.$idEnlace."-".$idUnidad."-".$mes."-".$anio;
      } 
      

      $ubicacion = 'documentos/';

      foreach ($_FILES as $key) {

        if ($key['error'] == UPLOAD_ERR_OK) {


            $nombreOriginal = $key['name'];
            $temporal = $key['tmp_name'];
            $fileSize = $key['size'];

            $nuevoname = formatearNombre($nombreReporte);
            $namefinal = $nuevoname.".pdf";

            $destino = $ubicacion.$nuevoname.".pdf";          


                   $queryTransaction = "  

                    BEGIN 
                    
                    BEGIN TRY 
                      BEGIN TRANSACTION

                          SET NOCOUNT ON


                            INSERT INTO archivo (idEnlace,idUnidad, idTipoArchivo, nombreArchivo, observacionesUser, tamanio, fechaSubida, ubicacion, mes, anio, estatusArch) 
                            VALUES ($idEnlace, $idUnidad, $idTipoArch,'$nuevoname','$oberv',$fileSize,GETDATE(),'$destino',$mes,$anio,'env') 
                          
                            UPDATE enlaceMesValidaEnviado SET enviadoArchivo = 1 WHERE idEnlace = $idEnlace AND idAnio = $anio AND idFormato = $idTipoArch

                          COMMIT
                    END TRY

                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH

                    END


                  ";

                  echo $queryTransaction;

                

                  $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));  

                  $arreglo[0] = "NO";
                  $arreglo[1] = "SI";

                  if ($result) {
                    echo json_encode(array('first'=>$arreglo[1]));
                    move_uploaded_file($temporal, $destino);
                  }else{
                    echo json_encode(array('first'=>$arreglo[0]));
                  }

              }else{
                $arreglo[0] = "NO";
                echo json_encode(array('first'=>$arreglo[0]));
              }         



            # code...
        }
          # code...
      








?>
