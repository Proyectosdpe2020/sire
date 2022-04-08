<? 
   include ("../../../Conexiones/Conexion.php");
   include("../../../funcioneTrimes.php");

   if (isset($_GET["per"])){ $per = $_GET["per"]; }
   if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
   if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
   if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }
   if (isset($_GET["sumQuest1"])){ $sumQuest1 = $_GET["sumQuest1"]; }
   if (isset($_GET["sumQuest2"])){ $sumQuest2 = $_GET["sumQuest2"]; }
   if (isset($_GET["sumQuest3"])){ $sumQuest3 = $_GET["sumQuest3"]; }
   if (isset($_GET["sumQuest4"])){ $sumQuest4 = $_GET["sumQuest4"]; }
   if (isset($_GET["totalValidateQuest4"])){ $totalValidateQuest4 = $_GET["totalValidateQuest4"]; }
   if (isset($_GET["quest"])){ $quest = $_GET["quest"]; }

switch($quest){
  case 1:
     $arreglo[0] = "NO";
     $arreglo[1] = "SI";

     if ($sumQuest1 == $totalValidateQuest4){
      echo json_encode(array('first'=>$arreglo[1]));
     }else{    
        echo json_encode(array('first'=>$arreglo[0]));  
     }
  break;
  case 2:
     $arreglo[0] = "NO";
     $arreglo[1] = "SI";

     if ($sumQuest2 == $totalValidateQuest4){
      echo json_encode(array('first'=>$arreglo[1]));
     }else{
      echo json_encode(array('first'=>$arreglo[0]));
     }
  break;
  case 3:
     $arreglo[0] = "NO";
     $arreglo[1] = "SI";

     if ($sumQuest3 >= $totalValidateQuest4){
      echo json_encode(array('first'=>$arreglo[1]));
     }else{
      echo json_encode(array('first'=>$arreglo[0]));
     }
  break;
  case 4:
     $query = " SELECT SUM(total) as total FROM trimestral.seguimiento WHERE idEnlace = $idEnlace and idPeriodo = $per and anio = $anio and idPregunta in (1,2) ";
     $stmt = sqlsrv_query($conn, $query);
     while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
     {
      $sumQuest1 = $row['total'];
     }

     $arreglo[0] = "NO";
     $arreglo[1] = "SI";

     if ($sumQuest4 == $sumQuest1){
      echo json_encode(array('first'=>$arreglo[1]));
     }else{
      echo json_encode(array('first'=>$arreglo[0]));
     }
  break;
}

   
?>