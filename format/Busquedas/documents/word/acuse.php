<?

header('Content-Type: text/html; charset=utf-8'); 

include ("../../../../Conexiones/Conexion.php");
include("../../../../funcionesBusquedas.php");
require '../../../../vendors/autoloadWord.php';


use \PHPOffice\PhpWord\PhpWord;

$phpWord = new PhpWord();
$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('acuse.docx');


if (isset($_POST["imputado"])){ //Recibe nombre del imputado
 $cad = $_POST["imputado"];
 $imputado = implode(' ',array_filter(explode(' ',$cad)));  //Eliminamos espacios
}

//Obtenemos fecha actual
$dia = date("d");
$mes_actual = date("n");
$mes = mes_nombre($mes_actual);
$anio = date("Y");


$templateProcessor->setValues( array('nombre' => $imputado , 'mes' => $mes , 'año' => $anio , 'dia' => $dia ) );

/*******PROCESO DE GUARDADO DEL DOCUMENTO*************/
$file = 'acuse.docx';
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