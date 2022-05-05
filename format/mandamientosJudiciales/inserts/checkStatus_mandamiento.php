<?
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionSIMAJ.php");
include("../../../funcionesMandamientos.php");

if(isset($_POST["ID_MANDAMIENTO"])){ $ID_MANDAMIENTO = $_POST["ID_MANDAMIENTO"]; }


			$consulta = " SELECT ISNULL(ESTATUS_AUTORIZACION,0) as ESTATUS_AUTORIZACION FROM SIMAJ.dbo.A_DATOS_MANDAMIENTOS WHERE ID_MANDAMIENTO = $ID_MANDAMIENTO  ";
		$result = sqlsrv_query($connSIMAJ, $consulta, array(), array( "Scrollable" => 'static' ));
	 while ($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC )){  
	  $ESTATUS_AUTORIZACION = $row['ESTATUS_AUTORIZACION'];
	 }

	 $arreglo[0] = "NO";
	 $arreglo[1] = "SI";
	 $arreglo[2] = $ESTATUS_AUTORIZACION;  //RECIBE 1 O 0

	 $d = array('first' => $arreglo[1] , 'ESTATUS_AUTORIZACION' => $arreglo[2]);
	 if ($result) {
	  echo json_encode($d);
	 }else{
	  echo json_encode(array('first'=>$arreglo[0]));
	 }
?>