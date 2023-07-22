<?php
header('Content-Type: text/html; charset=utf-8'); 

include ("../../Conexiones/Conexion.php");
include("../../Conexiones/conexionSicap.php");


if(isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; } 

$consulta="select * from imputadoLitigacion where nuc = $nuc " ;
$indice = 0;
$stmt = sqlsrv_query( $conn, $consulta);

while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
    $arreglo[$indice][0]=$row['idImputadoLitigacion'];
    $arreglo[$indice][1]=$row['nombre'];
    $arreglo[$indice][2]=$row['paterno'];
    $arreglo[$indice][3]=$row['materno'];
    $arreglo[$indice][4]=$row['edad'];
    $arreglo[$indice][5]=$row['sexo'];
    $arreglo[$indice][6]=$row['curp'];
    $arreglo[$indice][7]=$row['nuc'];
    $indice++;
  }

 

  if(isset($arreglo)){
    $d = array('imputado' => $arreglo);
    echo json_encode($d);
  }else{
    $d = array('imputado' => 'SIN IMPUTADO');
    echo json_encode($d);
  }


?>