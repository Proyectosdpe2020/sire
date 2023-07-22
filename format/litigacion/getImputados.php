<?php
header('Content-Type: text/html; charset=utf-8'); 

include ("../../Conexiones/Conexion.php");
include("../../Conexiones/conexionSicap.php");
include("../../funcionesLitSENAP.php");
require '../../vendors/autoload.php';



  $d = array('first' => $totalDeHojas , 'nucs' =>$nucs, 'longitud' => $longitud, 'nucs_invalido' => $nucs_invalido, 'longitud_invalido' => $longitud_invalido, 
            'idImputado' => $array_imputados);
  echo json_encode($d);


?>