<?

header('Content-Type: text/html; charset=utf-8'); 

include ("../../../Conexiones/conexionMedidas.php");
include("../../../funcionesMedidasProteccion.php");
require '../../../vendors/autoloadWord.php';


use \PHPOffice\PhpWord\PhpWord;

$phpWord = new PhpWord();
$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('constancia.docx');

//Obtenemos los datos generales del mando
if (isset($_POST["idConstanciaLlamada"])){ $idConstanciaLlamada = json_decode($_POST['idConstanciaLlamada'], true); }
if (isset($_POST["idMedida"])){ $idMedida = json_decode($_POST['idMedida'], true); }

//Obtenemos información de la constancia de llamadas
$getDataConstanciaLlamadas = getDataConstanciaLlamadas($connMedidas, $idMedida,1,$idConstanciaLlamada);
$fecha = $getDataConstanciaLlamadas[0][2]->format('Y-m-d H:i');
$observaciones  = $getDataConstanciaLlamadas[0][3];

$getDataMedida = get_data_medida($connMedidas, $idMedida);

$getDataVictimas = getDataVictimas($connMedidas, $idMedida); 

$templateProcessor->setValues( array('nuc' => mb_strtoupper($getDataMedida[0][1], "UTF-8") , 'observaciones' => mb_strtoupper($observaciones, "UTF-8") ) );

//DATA VICTIMAS
$resultadoVictimas = '';
$victimasArray = array();
if(sizeof($getDataVictimas) > 0 ) {
  for ($h=0; $h < sizeof($getDataVictimas) ; $h++){
    $victimasArray[$h] = $getDataVictimas[$h][7];
  }
  foreach($victimasArray as $temp){
    //Concatenamos cada posición
    $resultadoVictimas = $resultadoVictimas." ".$temp.",";
  }
  $templateProcessor->setValues( array('victima' => mb_strtoupper($resultadoVictimas, "UTF-8")  ) );
}
//DATA VICTIMAS

//DATA IMPUTADOS
$resultadoImpu = '';
$imputadosArray = array();
$getDataImputados = getDataImputados($connMedidas, $idMedida,0,0); 
if(sizeof($getDataImputados) > 0) {
  for ($h=0; $h < sizeof($getDataImputados) ; $h++){
    $imputadosArray[$h] = $getDataImputados[$h][8];
  }
  foreach($imputadosArray as $temp){
    //Concatenamos cada posición
    $resultadoImpu = $resultadoImpu." ".$temp.",";
  }
  $templateProcessor->setValues( array('imputado' => mb_strtoupper($resultadoImpu, "UTF-8")  ) );
}
//DATA IMPUTADOS

//DATA DELITO
$getDataDelito = getDataDelitoMedida($connMedidas, $idMedida);
$templateProcessor->setValues( array('delito' => mb_strtoupper($getDataDelito[0][3], "UTF-8")  ) );
//DATA DELITO

//DATA MEDIDAS ASIGNADAS
$resultadoFraccion = '';
$fraccionesArray = array();
$getDataFracciones= getDataFracciones($connMedidas, $idMedida); 
if(sizeof($getDataFracciones) > 0) {
  for ($h=0; $h < sizeof($getDataFracciones) ; $h++){
    $fraccionesArray[$h] = $getDataFracciones[$h][0];
  }
  foreach($fraccionesArray as $temp){
    //Concatenamos cada posición
    $resultadoFraccion = $resultadoFraccion." ".$temp.",";
  }
  $templateProcessor->setValues( array('fracciones' => mb_strtoupper($resultadoFraccion, "UTF-8")  ) );
}


/*******PROCESO DE GUARDADO DEL DOCUMENTO*************/
$file = 'HelloWorld.docx';
header("Content-Description: File Transfer");
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');
//$xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007'); usar si se crea plantilla desde cero
ob_start(); //INICIAMOS EL BUFFER DE SALIDA 
$templateProcessor->saveAs('php://output');
$xlsData = ob_get_contents(); //permite obtener los contenidos del buffer sin imprimir en pantalla
ob_end_clean(); // desechar todo el buffer, sin imprimir en pantalla

$response =  array(
        'op' => 'ok',
        'file' => "data:application/vnd.openxmlformats-officedocument.wordprocessingml.document;base64,".base64_encode($xlsData)
    );

die(json_encode($response)); 
?>