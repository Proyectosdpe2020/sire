<?

header('Content-Type: text/html; charset=utf-8');
include ("../../../Conexiones/Conexion.php");

if (isset($_POST['mes'])){ $mes = $_POST['mes']; }
if (isset($_POST['idMp'])){ $idMp = $_POST['idMp']; }
if (isset($_POST['anio'])){ $anio = $_POST['anio']; }

$query = "SELECT COALESCE(SUM(medPro.masculino),0) + COALESCE(SUM(medPro.femenino),0) + COALESCE(SUM(medPro.moral),0) + 
                 COALESCE(SUM(medPro.desconocido),0) AS totalVictimas
            FROM estatusNucs estNuc
            LEFT JOIN medidasDeProteccion medPro ON medPro.idEstatusNucs = estNuc.idEstatusNucs
            where estNuc.idEstatus = 129 and estNuc.mes = $mes and estNuc.idMp = $idMp and estNuc.anio = $anio"; 
 $indice = 0;
 $stmt = sqlsrv_query($conn, $query);
 while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
 {
   $total = $row['totalVictimas'];
 } 
 $arreglo[1] = $total;
  $d = array('victimas' => $arreglo[1]);
  echo json_encode($d);


?>