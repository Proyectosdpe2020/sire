<?

header('Content-Type: text/html; charset=utf-8'); 

include ("../../../../Conexiones/Conexion.php");
include("../../../../funcionesEstadoDeFuerza.php");
require '../../../../vendors/autoloadWord.php';

//require_once 'bootstrap.php';
use \PHPOffice\PhpWord\PhpWord;
use \PhpOffice\PhpWord\Style\Language;
//use \PHPOffice\PhpWord\Element\Table;

//Obtenemos los datos generales del mando
if (isset($_POST["idMando"])){ $idMando = $_POST['idMando']; }

$phpWord = new PhpWord();
$phpWord->getSettings()->setThemeFontLang(new Language("ES-MX"));

/*CREAMOS EL CONTENIDO*/
$section = $phpWord->addSection(array('marginLeft' => 600, 'marginRight' => 600,
    'marginTop' => 600, 'marginBottom' => 600 , 'colsSpace' => 5000));

/*Inicia cabecera*/
$header = $section->addHeader();
$header->addImage(
    '../../../../images/logoFiscaliaTrimesReporte.png',
    array(
        'width'         => 520,
        'height'        => 100,
        'marginTop'     => -1,
        'marginLeft'    => -1,
        'wrappingStyle' => 'behind'
    )
);
/*Termina cabecera*/

$footer = $section->addFooter();
$footer->addImage(
    '../../../../images/footer.PNG',
    array(
        'width'         => 600,
        'height'        => 20,
        'positioning' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
        'posHorizontal' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
        'posVertical' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
        'marginLeft' => -34,
        'marginTop'=>20,
        'wrappingStyle'=> 'behind'
    )
);

/*Inicia parametros de configuracion*/
$fontStyleBold = array('name' => 'Arial', 'size' => 12, 'bold' => true, 'color' => 'black');
$fontStyleNomal = array('name' => 'Arial', 'size' => 11, 'bold' => false);
$paragraphOptions = array('spaceBefore' => 0, 'spaceAfter' => 0);
/*Termina parametros de configuracion*/

/*Fotografia*/
$getDataFoto = getDataFoto($conn, $idMando);
$section->addImage(
    '../../inserts/fotografias/'.$getDataFoto[0][1],
    array(
        'width' => 150,
				    'height' => 150,
				    'wrappingStyle' => 'square',
				    'positioning' => 'absolute',
				    'posHorizontal'    => \PhpOffice\PhpWord\Style\Image::POSITION_HORIZONTAL_RIGHT,
				    'posVertical'    => \PhpOffice\PhpWord\Style\Image::POSITION_VERTICAL_TOP,
				    'posHorizontalRel' => 'margin',
				    'posVerticalRel' => 'line',
				    'wrappingStyle'=>'behind',
    )
);
/*Fotografia*/

/*DATOS GENERALES*/
$getDataFicha1 = getDataFicha1($conn, $idMando);
if($getDataFicha1[0][8] != ""){ $fechaAlta = $getDataFicha1[0][8]->format('Y-m-d'); } else { $fechaAlta = "n/e"; } //Provicional

$section->addText($getDataFicha1[0][1] , $fontStyleBold, $paragraphOptions);
$section->addText($getDataFicha1[0][2] , $fontStyleBold);
$section->addTextBreak(1);
$textrun = $section->addTextRun();
$textrun->addText("Teléfono: " , $fontStyleNomal);
$textrun->addText($getDataFicha1[0][9], $fontStyleBold);
$textrun->addTextBreak(1);
$textrun->addText("Fecha de ingreso: " , $fontStyleNomal);
$textrun->addText($fechaAlta, $fontStyleBold);
$textrun->addTextBreak(1);
$textrun->addText("Lugar de origen: " , $fontStyleNomal);
$textrun->addText($getDataFicha1[0][10], $fontStyleBold);
$textrun->addTextBreak(2);
$textrun->addText("Adscripción:" ,  $fontStyleBold, $paragraphOptions);
$section->addText($getDataFicha1[0][7] , $fontStyleNomal , $paragraphOptions);
$section->addText($getDataFicha1[0][4] , $fontStyleNomal , $paragraphOptions);
/*DATOS GENERALES*/
$section->addTextBreak(1);

/*TABLA DOMICILIO*/
$getDataDomicilio = getDataDireccion($conn , $idMando, 0);
if($getDataDomicilio > 0){
	$section->addText("Dirección", $fontStyleBold);
	$tableStyle = array(
	    'borderSize'  => 8, 
	    'borderColor' => 'black', 
	    'width'       => 10700, 
	    'unit'        => \PHPOffice\PhpWord\SimpleType\TblWidth::TWIP 
	);
	$tableDomicilio = $section->addTable($tableStyle);
	$styleCellHeader = array('bgColor'=>'#152F4A'); //Estilo cabecera
	$styleFontHeader = array('align' => 'center'); //Estilo fuente cabecera
	$tableDomicilio->addRow();
	$tableDomicilio->addCell(10, $styleCellHeader)->addText('#', $styleFontHeader, array('align' => 'center') );
	$tableDomicilio->addCell(10, $styleCellHeader)->addText('Domicilio', $styleFontHeader, array('align' => 'center'));
	$tableDomicilio->addCell(1500, $styleCellHeader)->addText('Lugar de origen', $styleFontHeader, array('align' => 'center'));
	$tableDomicilio->addCell(10, $styleCellHeader)->addText('Ciudad', $styleFontHeader, array('align' => 'center'));
	$tableDomicilio->addCell(1500, $styleCellHeader)->addText('Estado / Provincia', $styleFontHeader, array('align' => 'center'));
	$tableDomicilio->addCell(1300, $styleCellHeader)->addText('Código Postal', $styleFontHeader, array('align' => 'center'));
	$tableDomicilio->addCell(10, $styleCellHeader)->addText('Teléfono', $styleFontHeader, array('align' => 'center'));
	$contDom = 1;
	for($i = 0; $i < sizeof($getDataDomicilio); $i++){
		  $tableDomicilio->addRow();
				$tableDomicilio->addCell(10)->addText($contDom, $styleFontHeader, array('align' => 'center'));
				$tableDomicilio->addCell(10)->addText($getDataDomicilio[$i][2], $styleFontHeader, array('align' => 'center'));
				$tableDomicilio->addCell(10)->addText($getDataDomicilio[$i][3], $styleFontHeader, array('align' => 'center'));
				$tableDomicilio->addCell(10)->addText($getDataDomicilio[$i][4], $styleFontHeader, array('align' => 'center'));
				$tableDomicilio->addCell(10)->addText($getDataDomicilio[$i][5], $styleFontHeader, array('align' => 'center'));
				$tableDomicilio->addCell(10)->addText($getDataDomicilio[$i][6], $styleFontHeader, array('align' => 'center'));
				$tableDomicilio->addCell(10)->addText($getDataDomicilio[$i][7], $styleFontHeader, array('align' => 'center'));
				$contDom++;
		}
		$section->addTextBreak(1);
}
	/*TERMINA TABLA DOMICILIO*/

/*TABLA VEHICULOS*/
$getDataVehiculos = getDataVehiculos($conn , $idMando, 0);
if($getDataVehiculos > 0){
	$section->addText("Vehículos en posesión:", $fontStyleBold);
	$tableStyle = array(
	    'borderSize'  => 8, 
	    'borderColor' => 'black', 
	    'width'       => 10700, 
	    'unit'        => \PHPOffice\PhpWord\SimpleType\TblWidth::TWIP 
	);
	$tableVehiculos = $section->addTable($tableStyle);
	$styleCellHeader = array('bgColor'=>'#152F4A'); //Estilo cabecera
	$styleFontHeader = array('align' => 'center'); //Estilo fuente cabecera
	$tableVehiculos->addRow();
	$tableVehiculos->addCell(10, $styleCellHeader)->addText('#', $styleFontHeader, array('align' => 'center') );
	$tableVehiculos->addCell(10, $styleCellHeader)->addText('Marca', $styleFontHeader, array('align' => 'center'));
	$tableVehiculos->addCell(1500, $styleCellHeader)->addText('Modelo', $styleFontHeader, array('align' => 'center'));
	$tableVehiculos->addCell(10, $styleCellHeader)->addText('Placas', $styleFontHeader, array('align' => 'center'));
	$contVehi = 1;
	for($i = 0; $i < sizeof($getDataVehiculos); $i++){
		  $tableVehiculos->addRow();
				$tableVehiculos->addCell(10)->addText($contVehi, $styleFontHeader, array('align' => 'center'));
				$tableVehiculos->addCell(10)->addText($getDataVehiculos[$i][2], $styleFontHeader, array('align' => 'center'));
				$tableVehiculos->addCell(10)->addText($getDataVehiculos[$i][3], $styleFontHeader, array('align' => 'center'));
				$tableVehiculos->addCell(10)->addText($getDataVehiculos[$i][4], $styleFontHeader, array('align' => 'center'));
				$contVehi++;
		}
		$section->addTextBreak(1);
}
	/*TERMINA TABLA VEHICULOS*/

	/*TABLA ARMAS*/
$getDataArmas = getDataArmas($conn , $idMando, 0);
if($getDataArmas > 0){
	$section->addText("Armas en posesión:", $fontStyleBold);
	$tableStyle = array(
	    'borderSize'  => 8, 
	    'borderColor' => 'black', 
	    'width'       => 10700, 
	    'unit'        => \PHPOffice\PhpWord\SimpleType\TblWidth::TWIP 
	);
	$tableArmas = $section->addTable($tableStyle);
	$styleCellHeader = array('bgColor'=>'#152F4A'); //Estilo cabecera
	$styleFontHeader = array('align' => 'center'); //Estilo fuente cabecera
	$tableArmas->addRow();
	$tableArmas->addCell(10, $styleCellHeader)->addText('#', $styleFontHeader, array('align' => 'center') );
	$tableArmas->addCell(10, $styleCellHeader)->addText('Marca', $styleFontHeader, array('align' => 'center'));
	$tableArmas->addCell(1500, $styleCellHeader)->addText('Modelo', $styleFontHeader, array('align' => 'center'));
	$tableArmas->addCell(10, $styleCellHeader)->addText('Matricula', $styleFontHeader, array('align' => 'center'));
	$tableArmas->addCell(10, $styleCellHeader)->addText('Calibre', $styleFontHeader, array('align' => 'center'));
	$tableArmas->addCell(10, $styleCellHeader)->addText('Folio', $styleFontHeader, array('align' => 'center'));
	$tableArmas->addCell(10, $styleCellHeader)->addText('Categoría', $styleFontHeader, array('align' => 'center'));
	$contArmas = 1;
	for($i = 0; $i < sizeof($getDataArmas); $i++){
		  $tableArmas->addRow();
				$tableArmas->addCell(10)->addText($contArmas, $styleFontHeader, array('align' => 'center'));
				$tableArmas->addCell(10)->addText($getDataArmas[$i][3], $styleFontHeader, array('align' => 'center'));
				$tableArmas->addCell(10)->addText($getDataArmas[$i][4], $styleFontHeader, array('align' => 'center'));
				$tableArmas->addCell(10)->addText($getDataArmas[$i][5], $styleFontHeader, array('align' => 'center'));
				$tableArmas->addCell(10)->addText($getDataArmas[$i][6], $styleFontHeader, array('align' => 'center'));
				$tableArmas->addCell(10)->addText($getDataArmas[$i][7], $styleFontHeader, array('align' => 'center'));
				$tableArmas->addCell(10)->addText($getDataArmas[$i][2], $styleFontHeader, array('align' => 'center'));
				$contArmas++;
		}
		$section->addTextBreak(1);
}
	/*TERMINA TABLA ARMAS*/

	/*TABLA CONTACTO DE EMERGENCIA*/
$getDataContEmerg = getDataContEmerg($conn , $idMando, 0);
if($getDataContEmerg > 0){
	$section->addText("Contacto de emergencia:", $fontStyleBold);
	$tableStyle = array(
	    'borderSize'  => 8, 
	    'borderColor' => 'black', 
	    'width'       => 10700, 
	    'unit'        => \PHPOffice\PhpWord\SimpleType\TblWidth::TWIP 
	);
	$tableContEmerg = $section->addTable($tableStyle);
	$styleCellHeader = array('bgColor'=>'#152F4A'); //Estilo cabecera
	$styleFontHeader = array('align' => 'center'); //Estilo fuente cabecera
	$tableContEmerg->addRow();
	$tableContEmerg->addCell(10, $styleCellHeader)->addText('#', $styleFontHeader, array('align' => 'center') );
	$tableContEmerg->addCell(10, $styleCellHeader)->addText('Nombre', $styleFontHeader, array('align' => 'center'));
	$tableContEmerg->addCell(1500, $styleCellHeader)->addText('Parentesco', $styleFontHeader, array('align' => 'center'));
	$tableContEmerg->addCell(10, $styleCellHeader)->addText('Teléfono', $styleFontHeader, array('align' => 'center'));
	$tableContEmerg->addCell(10, $styleCellHeader)->addText('Dirección', $styleFontHeader, array('align' => 'center'));
	$tableContEmerg->addCell(10, $styleCellHeader)->addText('Ciudad', $styleFontHeader, array('align' => 'center'));
	$contContEmerg = 1;
	for($i = 0; $i < sizeof($getDataContEmerg); $i++){
		  $tableContEmerg->addRow();
				$tableContEmerg->addCell(10)->addText($contContEmerg, $styleFontHeader, array('align' => 'center'));
				$tableContEmerg->addCell(10)->addText($getDataContEmerg[$i][2], $styleFontHeader, array('align' => 'center'));
				$tableContEmerg->addCell(10)->addText($getDataContEmerg[$i][3], $styleFontHeader, array('align' => 'center'));
				$tableContEmerg->addCell(10)->addText($getDataContEmerg[$i][4], $styleFontHeader, array('align' => 'center'));
				$tableContEmerg->addCell(10)->addText($getDataContEmerg[$i][5], $styleFontHeader, array('align' => 'center'));
				$tableContEmerg->addCell(10)->addText($getDataContEmerg[$i][6], $styleFontHeader, array('align' => 'center'));
				$contContEmerg++;
		}
		$section->addTextBreak(1);
}
	/*TERMINA TABLA CONTACTO DE EMERGENCIA*/

		/*TABLA FOLIOS*/
$getDataFolios = getDataFolios($conn , $idMando, 0);
if($getDataFolios > 0){
	$section->addText("Folios:", $fontStyleBold);
	$tableStyle = array(
	    'borderSize'  => 8, 
	    'borderColor' => 'black', 
	    'width'       => 10700, 
	    'unit'        => \PHPOffice\PhpWord\SimpleType\TblWidth::TWIP 
	);
	$tableFolios = $section->addTable($tableStyle);
	$styleCellHeader = array('bgColor'=>'#152F4A'); //Estilo cabecera
	$styleFontHeader = array('align' => 'center'); //Estilo fuente cabecera
	$tableFolios->addRow();
	$tableFolios->addCell(10, $styleCellHeader)->addText('#', $styleFontHeader, array('align' => 'center') );
	$tableFolios->addCell(10, $styleCellHeader)->addText('Nombre', $styleFontHeader, array('align' => 'center'));
	$tableFolios->addCell(1500, $styleCellHeader)->addText('Parentesco', $styleFontHeader, array('align' => 'center'));
	$tableFolios->addCell(10, $styleCellHeader)->addText('Teléfono', $styleFontHeader, array('align' => 'center'));
	$tableFolios->addCell(10, $styleCellHeader)->addText('Dirección', $styleFontHeader, array('align' => 'center'));
	$tableFolios->addCell(10, $styleCellHeader)->addText('Ciudad', $styleFontHeader, array('align' => 'center'));
	$contFolios = 1;
	for($i = 0; $i < sizeof($getDataFolios); $i++){
		  $tableFolios->addRow();
				$tableFolios->addCell(10)->addText($contFolios, $styleFontHeader, array('align' => 'center'));
				$tableFolios->addCell(10)->addText($getDataFolios[$i][2], $styleFontHeader, array('align' => 'center'));
				$tableFolios->addCell(10)->addText($getDataFolios[$i][3], $styleFontHeader, array('align' => 'center'));
				$tableFolios->addCell(10)->addText($getDataFolios[$i][4], $styleFontHeader, array('align' => 'center'));
				$tableFolios->addCell(10)->addText($getDataFolios[$i][5], $styleFontHeader, array('align' => 'center'));
				$tableFolios->addCell(10)->addText($getDataFolios[$i][6], $styleFontHeader, array('align' => 'center'));
				$contFolios++;
		}
		$section->addTextBreak(1);
}
	/*TERMINA TABLA FOLIOS*/

			/*TABLA INCAPACIDADES*/
$getDataInc = getDataIncapacidad($conn , $idMando, 0);
if($getDataInc > 0){
	$section->addText("Incapacidades solicitadas:", $fontStyleBold);
	$tableStyle = array(
	    'borderSize'  => 8, 
	    'borderColor' => 'black', 
	    'width'       => 10700, 
	    'unit'        => \PHPOffice\PhpWord\SimpleType\TblWidth::TWIP 
	);
	$tableIncapa = $section->addTable($tableStyle);
	$styleCellHeader = array('bgColor'=>'#152F4A'); //Estilo cabecera
	$styleFontHeader = array('align' => 'center'); //Estilo fuente cabecera
	$tableIncapa->addRow();
	$tableIncapa->addCell(10, $styleCellHeader)->addText('#', $styleFontHeader, array('align' => 'center') );
	$tableIncapa->addCell(10, $styleCellHeader)->addText('Fecha de inicio', $styleFontHeader, array('align' => 'center'));
	$tableIncapa->addCell(1500, $styleCellHeader)->addText('Fecha de termino', $styleFontHeader, array('align' => 'center'));
	$tableIncapa->addCell(10, $styleCellHeader)->addText('Motivo', $styleFontHeader, array('align' => 'center'));
	$contIncapacidades = 1;
	for($i = 0; $i < sizeof($getDataInc); $i++){
		  $tableIncapa->addRow();
				$tableIncapa->addCell(10)->addText($contIncapacidades, $styleFontHeader, array('align' => 'center'));
				$tableIncapa->addCell(10)->addText($getDataInc[$i][2], $styleFontHeader, array('align' => 'center'));
				$tableIncapa->addCell(10)->addText($getDataInc[$i][3], $styleFontHeader, array('align' => 'center'));
				$tableIncapa->addCell(10)->addText($getDataInc[$i][4], $styleFontHeader, array('align' => 'center'));
				$contIncapacidades++;
		}
		$section->addTextBreak(1);
}
	/*TERMINA TABLA INCAPACIDADES*/

		/*TABLA ADSCRIPCIONES*/
$getDataAdscripcion = getDataHistorialAdscripcion($conn , $idMando);
if($getDataAdscripcion > 0){
	$section->addText("Historial de adscripciones:", $fontStyleBold);
	$tableStyle = array(
	    'borderSize'  => 8, 
	    'borderColor' => 'black', 
	    'width'       => 10700, 
	    'unit'        => \PHPOffice\PhpWord\SimpleType\TblWidth::TWIP 
	);
	$tableAdscrip = $section->addTable($tableStyle);
	$styleCellHeader = array('bgColor'=>'#152F4A'); //Estilo cabecera
	$styleFontHeader = array('align' => 'center'); //Estilo fuente cabecera
	$tableAdscrip->addRow();
	$tableAdscrip->addCell(10, $styleCellHeader)->addText('#', $styleFontHeader, array('align' => 'center') );
	$tableAdscrip->addCell(10, $styleCellHeader)->addText('Fiscalía', $styleFontHeader, array('align' => 'center'));
 $tableAdscrip->addCell(1500, $styleCellHeader)->addText('Adscripción', $styleFontHeader, array('align' => 'center'));
	$tableAdscrip->addCell(10, $styleCellHeader)->addText('Fecha de adscripción', $styleFontHeader, array('align' => 'center'));
	$contAdscripciones = 1;
	for($i = 0; $i < sizeof($getDataAdscripcion); $i++){
		  $tableAdscrip->addRow();
				$tableAdscrip->addCell(10)->addText($contAdscripciones, $styleFontHeader, array('align' => 'center'));
				$tableAdscrip->addCell(10)->addText($getDataAdscripcion[$i][2], $styleFontHeader, array('align' => 'center'));
				$tableAdscrip->addCell(10)->addText($getDataAdscripcion[$i][6], $styleFontHeader, array('align' => 'center'));
				$tableAdscrip->addCell(10)->addText($getDataAdscripcion[$i][7], $styleFontHeader, array('align' => 'center'));
				$contAdscripciones++;
		}
		$section->addTextBreak(1);
}
	/*TERMINA TABLA ADSCRIPCIONES*/


/*******PROCESO DE GUARDADO DEL DOCUMENTO*************/
$file = 'HelloWorld.docx';
header("Content-Description: File Transfer");
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');
ob_start(); //INICIAMOS EL BUFFER DE SALIDA 
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('php://output');
//$objWriter->saveAs('php://output');
$xlsData = ob_get_contents(); //permite obtener los contenidos del buffer sin imprimir en pantalla
ob_end_clean(); // desechar todo el buffer, sin imprimir en pantalla

$response =  array(
        'op' => 'ok',
        'file' => "data:application/vnd.openxmlformats-officedocument.wordprocessingml.document;base64,".base64_encode($xlsData)
    );

die(json_encode($response)); 




?>