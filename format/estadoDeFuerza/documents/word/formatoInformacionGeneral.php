<?

header('Content-Type: text/html; charset=utf-8'); 

include ("../../../../Conexiones/Conexion.php");
include("../../../../funcionesEstadoDeFuerza.php");
require '../../../../vendors/autoloadWord.php';


use \PHPOffice\PhpWord\PhpWord;

$phpWord = new PhpWord();
$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('formatoInformacionGeneral.docx');

//Obtenemos los datos generales del mando
if (isset($_POST["idMando"])){ $idMando = json_decode($_POST['idMando'], true); }

$getDataFicha1 = getDataFicha1($conn, $idMando);
$getDataFoto = getDataFoto($conn, $idMando);
if($getDataFicha1[0][8] != ""){ $fechaAlta = $getDataFicha1[0][8]->format('Y-m-d'); } else { $fechaAlta = "n/e"; } //Provicional

$templateProcessor->setValues( array('nombre' => $getDataFicha1[0][1], 'cargo' => $getDataFicha1[0][2], 'telefono' => $getDataFicha1[0][9],
                                     'fechaIngreso' => $fechaAlta, 'estado' => $getDataFicha1[0][10] ,
                                     'fiscalia' => $getDataFicha1[0][7], 'adscripcion' => $getDataFicha1[0][4]) );

$templateProcessor->setImageValue('personal', array('path' => '../../inserts/fotografias/'.$getDataFoto[0][1], 'wrappingStyle' => 'behind', 'width' => 170, 'height' => 180, 'ratio' => false));

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