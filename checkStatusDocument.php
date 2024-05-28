<?php 
include('Conexiones/Conexion.php');
session_start();

if (isset($_POST['idEnlace'])){ $idEnlace = $_POST['idEnlace']; }
if (isset($_POST['format'])){ $format = $_POST['format']; }


$query = "SELECT a.idArchivo
																,a.idEnlace
																,a.idUnidad
																,a.idTipoArchivo
																,a.nombreArchivo
																,a.observacionesUser
																,a.tamanio
																,a.fechaSubida
																,a.ubicacion
																,a.mes
																,a.anio
																,a.estatusArch
																,a.observacionesRevision
																,a.fechaConcluido
																,a.fechareenviado
																FROM ESTADISTICAV2.dbo.archivo a
																where a.idEnlace = $idEnlace AND a.idTipoArchivo = $format AND 
																a.mes = (SELECT v.mesCap FROM ESTADISTICAV2.dbo.enlaceMesValidaEnviado v WHERE v.idEnlace = $idEnlace AND v.idFormato = $format) AND 
																a.anio = (SELECT v.idAnio FROM ESTADISTICAV2.dbo.enlaceMesValidaEnviado v WHERE v.idEnlace = $idEnlace AND v.idFormato = $format) ";

  $result = sqlsrv_query($conn,$query, array(), array( "Scrollable" => 'static' ));
  $arreglo[0] = "NO";
  $arreglo[1] = "SI";
 

  while ($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC ))
  {
  	$data[0]=$row['idArchivo'];
		 $data[1]=$row['idEnlace'];
		 $data[2]=$row['idUnidad'];
		 $data[3]=$row['idTipoArchivo'];
		 $data[4]=$row['nombreArchivo'];
		 $data[5]=$row['observacionesUser'];
		 $data[6]=$row['tamanio'];
		 $data[7]=$row['fechaSubida'];
		 $data[8]=$row['ubicacion'];
		 $data[9]=$row['mes'];
		 $data[10]=$row['anio'];
		 $data[11]=$row['estatusArch'];
		 $data[12]=$row['observacionesRevision'];
		 $data[13]=$row['fechaConcluido'];
		 $data[14]=$row['fechareenviado'];
		}

  if (count($data) > 0) {
  	echo json_encode(array('first'=>$arreglo[1] , 'estatus_archivo' => $data[11] , 'motivo_rechazo' => $data[12]));
  }else{
  	echo json_encode(array('first'=>$arreglo[0]));
  }

?>