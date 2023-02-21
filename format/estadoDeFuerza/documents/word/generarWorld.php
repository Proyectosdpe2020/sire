<?

header('Content-Type: text/html; charset=utf-8'); 

include ("../../../../Conexiones/Conexion.php");
include("../../../../funcionesEstadoDeFuerza.php");
require '../../../../vendors/autoloadWord.php';


use \PHPOffice\PhpWord\PhpWord;

$phpWord = new PhpWord();
$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('formato.docx');

//Obtenemos los datos generales del mando
if (isset($_POST["jObjectDataGeneralMando"])){ $data = json_decode($_POST['jObjectDataGeneralMando'], true); }
if (isset($_POST["idMando"])){ $idMando = json_decode($_POST['idMando'], true); }
//Obtenemos el nombre del cargo actual
$getNombreCargo = getNombreCargo($conn, $data[4]);
//Obtenemos la penultima adscripcion del compañero
$getPenultimaAds = getPenultimaAds($conn, $idMando);
//Obtenemos la actual adscripcion del compañero
$getActualAdscripcion = getActualAdscripcion($conn, $idMando);
//Obtenemos fecha actual
$getFechaActual = getFechaActual();

//fecha del documento
$templateProcessor->setValues( array('dia' => $getFechaActual[0][0], 'mes' => $getFechaActual[0][1], 'anio' => $getFechaActual[0][2]) );

//Nombre y cargo
$templateProcessor->setValues( array('nombre' => $data[0], 'ap_paterno' => $data[1], 'ap_materno' => $data[2], 'cargo' => $getNombreCargo[0][1]) );

$getPrefijo0 = getPrefijo0($getPenultimaAds[0][5]);
$templateProcessor->setValues( array('prefijo0' => $getPrefijo0 ) );
$getPrefijo1 = getPrefijo1($getPenultimaAds[0][2]);

//Penultima Adscription
if($getPenultimaAds[0][5] == 18 || $getPenultimaAds[0][5] == 19){
 $templateProcessor->setValues( array('pentultimaAdscripcion' => mb_strtoupper($getPenultimaAds[0][6], "UTF-8"), 'penultimaFiscalia' => '') );
 $templateProcessor->setValues( array('prefijo1' => '' ) );
}else{
 $templateProcessor->setValues( array('pentultimaAdscripcion' => mb_strtoupper($getPenultimaAds[0][6], "UTF-8"), 'penultimaFiscalia' => mb_strtoupper($getPenultimaAds[0][3], "UTF-8")) );
 $templateProcessor->setValues( array('prefijo1' => $getPrefijo1 ) );
}

//DEFINIR PREFIJO POR CADA UNIDAD DEPENDIENDO DEL catFiscalias
if($data[6] == 24 || $data[6] == 25){
 $prefijo = "al";
}else{
 $prefijo = "a la";
}

$templateProcessor->setValues( array('prefijo2' => $prefijo ) );

$getPrefijo3 = getPrefijo3($data[6]);

//Actual Adscription
if($data[7] == 18 || $data[7] == 19){
  $templateProcessor->setValues( array('actualAdscripcion' => mb_strtoupper($getActualAdscripcion[0][1], "UTF-8"), 'actualFiscalia' => '' ) );
  $templateProcessor->setValues( array('prefijo3' => '' ) );
}else{
 $templateProcessor->setValues( array('prefijo3' => $getPrefijo3 ) );
 $templateProcessor->setValues( array('actualAdscripcion' => mb_strtoupper($getActualAdscripcion[0][1], "UTF-8"), 'actualFiscalia' => mb_strtoupper($getActualAdscripcion[0][2], "UTF-8")) );
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