<?
header('Content-Type: text/html; charset=utf-8');
include ("../../../Conexiones/Conexion.php");
include("../../../funcionesEstadoDeFuerza.php");

if (isset($_POST["idFoto"])){ $idFoto = $_POST["idFoto"]; }
if (isset($_POST["idMando"])){ $idMando = $_POST["idMando"]; }
if (isset($_POST["srcFoto"])){ $srcFoto = $_POST["srcFoto"]; }
$ext = 'fotografias/';

/*Elimina la fotografia del mando*/
	$queryTransaction = "
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON                                    
                                    DELETE FROM estadoFuerza.fotografias WHERE idFoto = $idFoto AND idMando = $idMando
                              COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";                   

$result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));
$arreglo[0] = "NO";
$arreglo[1] = "SI";
if ($result){
  unlink($ext.$srcFoto); //Eliminamos la fotografia de la carpeta
	 $d = array('first' => $arreglo[1] , 'idLastMando' => $idMando);
  echo json_encode($d);
}else{
	echo json_encode(array('first'=>$arreglo[0]));
}

?>