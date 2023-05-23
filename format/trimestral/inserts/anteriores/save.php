<?
include("../../../../Conexiones/Conexion.php");
include("../../../../funcioneTrimes.php");

if (isset($_GET["per"])) {
  $per = $_GET["per"];
}
if (isset($_GET["anio"])) {
  $anio = $_GET["anio"];
}
if (isset($_GET["quest"])) {
  $quest = $_GET["quest"];
}
if (isset($_GET["idUnidad"])) {
  $idUnidad = $_GET["idUnidad"];
}
if (isset($_GET["idenlace"])) {
  $idEnlace = $_GET["idenlace"];
}
$a = json_decode($_GET["arrData"], true);

$arAnios = array(2017, 2018, 2019, 2020, 2021, 2022);
$strPrgts = "";
if ($quest == 5) {
  $tam = 5;///// ESTE ES EL TAMAÑO DE LOS ARREGLOS EN ESTE CASO ES 5 POR QUE CONTIENE 5 PREGUNTAS LA PREGUNTA 5
  $arPregnts = array(10, 11, 12, 13, 14);  
} 
if ($quest == 6) {   $tam = 3;  $arPregnts = array(15, 16, 17);  } 
if ($quest == 7) {   $tam = 16;  $arPregnts = array(18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33);  } 
if ($quest == 8) {   $tam = 14;  $arPregnts = array(34,35,36,37,38,39,40,41,42,43,44,45,46,47);  } 
if ($quest == 9) {   $tam = 3;  $arPregnts = array(48, 49, 50, 51);  } 
if ($quest == 10) {   $tam = 4;  $arPregnts = array(52, 53, 54, 55);  } 

////FOR PARA CONCATENAR  LAS PREGUNTAS
for ($e=0; $e < sizeof($arPregnts) ; $e++) { 
  $strPrgts = $strPrgts.intval($arPregnts[$e]).",";
}

$strfin = "IN (".$strPrgts;
$strrfin1 = substr($strfin, 0, -1);
$sfin = $strrfin1.")";

$query = "  SELECT idDatosAnteriorTrimestral FROM trimestral.datosAnteriorTrimestral WHERE idPregunta $sfin  AND periodo = $per AND anio = $anio AND idUnidad = $idUnidad AND idEnlace = $idEnlace ";
$stmt = sqlsrv_query($conn, $query, array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
$row_count = sqlsrv_num_rows($stmt);

if ($row_count > 0) {


  $varQuerys = "";
  for ($i = 0; $i < $tam; $i++) {

    $val1 = intval($a[$i][0]);
    $val2 = intval($a[$i][1]);
    $val3 = intval($a[$i][2]);
    $val4 = intval($a[$i][3]);
    $val5 = intval($a[$i][4]);
    $val6 = intval($a[$i][5]);

    $queryTransaction = " 
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON    

                          UPDATE trimestral.datosAnteriorTrimestral SET val2017 = $val1 WHERE idPregunta = $arPregnts[$i] AND periodo = $per AND anio = $anio AND idUnidad = $idUnidad AND idEnlace = $idEnlace 
                          UPDATE trimestral.datosAnteriorTrimestral SET val2018 = $val2 WHERE idPregunta = $arPregnts[$i] AND periodo = $per AND anio = $anio AND idUnidad = $idUnidad AND idEnlace = $idEnlace 
                          UPDATE trimestral.datosAnteriorTrimestral SET val2019 = $val3 WHERE idPregunta = $arPregnts[$i] AND periodo = $per AND anio = $anio AND idUnidad = $idUnidad AND idEnlace = $idEnlace 
                          UPDATE trimestral.datosAnteriorTrimestral SET val2020 = $val4 WHERE idPregunta = $arPregnts[$i] AND periodo = $per AND anio = $anio AND idUnidad = $idUnidad AND idEnlace = $idEnlace 
                          UPDATE trimestral.datosAnteriorTrimestral SET val2021 = $val5 WHERE idPregunta = $arPregnts[$i] AND periodo = $per AND anio = $anio AND idUnidad = $idUnidad AND idEnlace = $idEnlace 
                          UPDATE trimestral.datosAnteriorTrimestral SET val2022 = $val6 WHERE idPregunta = $arPregnts[$i] AND periodo = $per AND anio = $anio AND idUnidad = $idUnidad AND idEnlace = $idEnlace 
                          
                          COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";
  $result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

  $arreglo[0] = "NO";
  $arreglo[1] = "SI";

  if ($result) {
    echo json_encode(array('first' => $arreglo[1]));
  } else {
    echo json_encode(array('first' => $arreglo[0]));
  }

  }

  
} else {



  $varQuerys = "";
  for ($i = 0; $i < $tam; $i++) {

    $val1 = intval($a[$i][0]);
    $val2 = intval($a[$i][1]);
    $val3 = intval($a[$i][2]);
    $val4 = intval($a[$i][3]);
    $val5 = intval($a[$i][4]);
    $val6 = intval($a[$i][5]);


    $queryTransaction = " 
          BEGIN                     
          BEGIN TRY 
            BEGIN TRANSACTION
                SET NOCOUNT ON    

                INSERT INTO trimestral.datosAnteriorTrimestral VALUES($arPregnts[$i],$idEnlace,$idUnidad,$anio,$per,$val1,$val2,$val3,$val4,$val5,$val6 )
                
                COMMIT
          END TRY
          BEGIN CATCH 
                ROLLBACK TRANSACTION
                RAISERROR('No se realizo la transaccion',16,1)
          END CATCH
          END
        ";

    echo $queryTransaction;

    $result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

    $arreglo[0] = "NO";
    $arreglo[1] = "SI";

    if ($result) {
      echo json_encode(array('first' => $arreglo[1]));
    } else {
      echo json_encode(array('first' => $arreglo[0]));
      exit();
    }
  }
}
