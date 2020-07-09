<?php
//require('fpdf-1.82/fpdf.php');
require('mcTable.php');
//session_start();

//$records = json_decode($_POST['records'], true);

$records = $_SESSION['question_records'];

$position = 'Fiscalía General';
$user = '[Nombre, Cargo y Firma]';
$ur = $records[0]['unity'];
$year = $records[0]['year'];
$periods = array(
    array(
        'Enero-Marzo',
        'Abril-Junio',
        'MJulio-Septiembre',
        'Octubre-Diciembre'
    ),
    array(
        'Enero',
        'Febrero',
        'Marzo'
    ),
    array(
        'Abril',
        'Mayo',
        'Junio'
    ),
    array(
        'Julio',
        'Agosto',
        'Sepiembre'
    ),
    array(
        'Octubre',
        'Noviembre',
        'Diciembre'
    )
);

$headers = array(
    'Denuncias / Querellas / Otros Requisitos Equivalentes',
    'Número de Carpetas de Investigación iniciadas',
    'Víctimas u Ofendidos',
    'Número de Carpetas Investigacióniniciadas',
    'Órdenes de Aprehensión o Detención de CII en '.$year,
    'Detenidos de CII en '.$year,
    'Estatus de los Procedimientos Derivados de las CII en '.$year,
    'Estatus de las Vinculaciones a Proceso derivadas de las CII en '.$year,
    'Imputados Vinculados a Proceso o en Espera',
    'Imputados con Sentencia'
);


//$pdf2 = new FPDF();
$pdf2 = new PDF_MC_Table();
$pdf2->AddPage();

$pdf2->SetFont('Arial','',10);

/*$pdf2->AliasNbPages();
$pdf2->Cell(380, 2, 'Pagina ' . $pdf2->PageNo() . '/{nb}', 0, 0, 'C');
*/
$pdf2->Ln();
$pdf2->SetFont('Arial','B',26);
$pdf2->Cell(190, 10, iconv('UTF-8', 'windows-1252', 'Cuestionario'), "", "", 'C');

$pdf2->SetFont('Arial','B',14);
$pdf2->Ln();

$pdf2->Cell(190, 7, iconv('UTF-8', 'windows-1252', 'INDICADORES ESTRATÉGICOS DEL'), "", "", 'C');

$pdf2->SetFont('Arial','B',14);
$pdf2->Ln();
$pdf2->Cell(190, 7, iconv('UTF-8', 'windows-1252', 'MODELO DE EVALUACIÓN Y SEGUIMIENTO DE LA'), "", "", 'C');

$pdf2->SetFont('Arial','B',14);
$pdf2->Ln();
$pdf2->Cell(190, 7, iconv('UTF-8', 'windows-1252', 'CONSOLIDACIÓN DEL SISTEMA DE JUSTICIA PENAL'), "", "", 'C');

$pdf2->SetFont('Arial','B',14);
$pdf2->Ln();
$pdf2->Cell(190, 7, iconv('UTF-8', 'windows-1252', 'INFORMACIÓN DE '.strval($year)), "", "", 'C');

$pdf2->Ln();
$pdf2->SetFont('Arial','',10);

$pdf2->Ln(10);

$pdf2->SetFont('','B','');
$pdf2->Cell(20, 7, iconv('UTF-8', 'windows-1252', 'Trimestre:'), "", "", 'L');
$pdf2->SetFont('','','');

switch($records[0]['period_id']){
    case 1:
        $pdf2->MultiCell(150,7,iconv('UTF-8', 'windows-1252', '1er trimestre'), 'J');
    break;

    case 2:
        $pdf2->MultiCell(150,7,iconv('UTF-8', 'windows-1252', '2do trimestre'), 'J');
    break;

    case 3:
        $pdf2->MultiCell(150,7,iconv('UTF-8', 'windows-1252', '3er trimestre'), 'J');
    break;

    case 4:
        $pdf2->MultiCell(150,7,iconv('UTF-8', 'windows-1252', '4to trimestre'), 'J');
    break;

    default:
        $pdf2->MultiCell(150,7,iconv('UTF-8', 'windows-1252', ''), 'J');
}
//$pdf2->MultiCell(150,7,iconv('UTF-8', 'windows-1252', $records[0]['period_id']==1?'1er trimestre':$records[0]['period_id']==2?'2do trimestre':$records[0]['period_id']==3?'3er trimestre': ''), 'J');

$pdf2->Ln(1);

$pdf2->SetFont('','B','');
$pdf2->Cell(35, 7, iconv('UTF-8', 'windows-1252', 'Entidad Federativa:'), "", "", 'L');
$pdf2->SetFont('','','');
$pdf2->MultiCell(150,7,iconv('UTF-8', 'windows-1252', 'Michoacán de Ocampo'), 'J');

$pdf2->Ln(1);

$pdf2->SetFont('','B','');
$pdf2->Cell(20, 7, iconv('UTF-8', 'windows-1252', 'Institución:'), "", "", 'L');
$pdf2->SetFont('','','');
$pdf2->MultiCell(150,7,iconv('UTF-8', 'windows-1252', 'Fiscalía General del Estado de Michoacán'), 'J');

$pdf2->Ln(1);

$pdf2->SetFont('','B','');
$pdf2->Cell(20, 7, iconv('UTF-8', 'windows-1252', 'Unidad:'), "", "", 'L');
$pdf2->SetFont('','','');
$pdf2->MultiCell(150,7,iconv('UTF-8', 'windows-1252', $ur), 'J');

$pdf2->Ln(12);

$pdf2->SetFont('', '', 12);

$pdf2->MultiCell(190,5,iconv('UTF-8', 'windows-1252', 'Antes del llenado del cuestionario le solicitamos consulte el "Instructivo" que acompaña al presente anexo. Le solicitamos también que previamente revise la información suministrada para asegurar que ésta sea consistente y congruente entre los diversos'), 'J');

$pdf2->Ln(10);

$w = array(
    array(10, 90, 20, 20, 20, 30),
    array(10, 90, 20, 20, 20, 30),
    array(10, 90, 20, 20, 20, 30),
    array(10, 90, 20, 20, 20, 30),
    array(10, 90, 20, 20, 20, 30),
    array(10, 90, 20, 20, 20, 30),
    array(10, 90, 20, 20, 20, 30),
    array(10, 90, 20, 20, 20, 30),
    array(10, 90, 20, 20, 20, 30),
    array(10, 90, 20, 20, 20, 30)
);

for($i = 0; $i < 10; $i++){

    set_paragraph($pdf2, $i+1, $year);
    $pdf2->Ln();
    $pdf2->Ln();
    set_table_header($pdf2, $records, $periods, $headers[$i], $w[$i]);
    set_table_content($pdf2, $records, $i+1, $w[$i]);
    $pdf2->Ln(14);
}

set_sign_field($pdf2, $user, $position);
    
$pdf2->Output();


function set_table_header($pdf2, $records, $periods, $header, $w){
    $pdf2->SetLineWidth(.1);
    $pdf2->SetDrawColor(0);
    $pdf2->SetFont('','',10);


    $pdf2->SetTextColor(0);
    $pdf2->SetFont('','');

    $pdf2->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C'));
    
    $pdf2->SetWidths($w);

    

    $pdf2->SetFillColors(array(
        array(124, 139, 158),
        array(124, 139, 158),
        array(124, 139, 158),
        array(124, 139, 158),
        array(124, 139, 158),
        array(192, 159, 119)
    ));


    $pdf2->Row(array(
        iconv('UTF-8', 'windows-1252', 'N°'),
        iconv('UTF-8', 'windows-1252', $header),
        $periods[$records[0]['period_id']][0],
        $periods[$records[0]['period_id']][1],
        $periods[$records[0]['period_id']][2],
        'Total'
    ),'h');
    
}


function set_table_content($pdf2, $records, $section, $w){

    $total = 0;
    $ind = false;

    $pdf2->SetFillColor(255,255,255);
    
    $pdf2->SetTextColor(0);
    $pdf2->SetFont('');

    $pdf2->SetAligns(array('C', 'L', 'C', 'C', 'C', 'C'));

    $pdf2->SetWidths($w);

    for($i = 0, $n = 1; $i < count($records); $i++){

        if($records[$i]['section'] == $section){

            $pdf2->SetFillColors(array(
                array(255, 255, 255),
                array(255, 255, 255),
                array(255, 255, 255),
                array(255, 255, 255),
                array(255, 255, 255),
                array(233, 207, 184)
            ));
            
            if($section == 7 && $n == 12){

                $pdf2->SetWidths(array(190));

                $pdf2->Row(array(
                    iconv('UTF-8', 'windows-1252', 'DERIVADOS A MECANISMOS ALTERNATIVOS (ANTES DEL AUTO DE VINCULACIÓN A PROCESO)')
                ),'c');

                $pdf2->SetWidths($w);
            }

            else if($section == 8 && $n == 10){

                $pdf2->SetWidths(array(190));

                $pdf2->Row(array(
                    iconv('UTF-8', 'windows-1252', 'DERIVADOS A MECANISMOS ALTERNATIVOS (ANTES DEL AUTO DE VINCULACIÓN A PROCESO)')
                ),'c');

                $pdf2->SetWidths($w);
            }


            $pdf2->Row(array(
                iconv('UTF-8', 'windows-1252', $section.'.'.$n),
                iconv('UTF-8', 'windows-1252', $records[$i]['question']),
                $records[$i]['count'][0],
                $records[$i]['count'][1],
                $records[$i]['count'][2],
                $records[$i]['count'][0]+$records[$i]['count'][1]+$records[$i]['count'][2]
            ),'c');
            
            $ind = true;

            $n++;

            $total+=$records[$i]['count'][0]+$records[$i]['count'][1]+$records[$i]['count'][2];

        }

    }

    if($ind){
        set_table_total($pdf2, $records, $section, $w, $total);
    }

    
}

function set_table_header2($pdf2, $records, $periods, $header, $w){
    $pdf2->SetLineWidth(.1);
    $pdf2->SetDrawColor(0);
    $pdf2->SetFont('','',9);


    $pdf2->SetFillColor(124,139,158);
    $pdf2->SetTextColor(255);
    $pdf2->SetFont('','B');

    $pdf2->Cell($w[0],6,iconv('UTF-8', 'windows-1252', "N°"),1,0,'C', 'F');
    $pdf2->Cell($w[1],6,iconv('UTF-8', 'windows-1252', $header),1,0,'C', 'F');

    $pdf2->Cell($w[2],6,$periods[$records[0]['period_id']][0],1,0,'C', 'F');
    $pdf2->Cell($w[3],6,$periods[$records[0]['period_id']][1],1,0,'C', 'F');
    $pdf2->Cell($w[4],6,$periods[$records[0]['period_id']][2],1,0,'C', 'F');

    $pdf2->SetFillColor(192,159,119);

    $pdf2->Cell($w[5],6,'Total',1,0,'C', 'F');

    $pdf2->Ln();
    
}

function set_table_content2($pdf2, $records, $section, $w){

    $total = 0;
    $ind = false;

    for($i = 0, $n = 1; $i < count($records); $i++){

        if($records[$i]['section'] == $section){

            $ind = true;

            $pdf2->SetFillColor(255,255,255);
            $pdf2->SetTextColor(0);
            $pdf2->SetFont('');

            $pdf2->Cell($w[0],6,iconv('UTF-8', 'windows-1252', $section.'.'.$n),1,0,'C',0);
            $pdf2->Cell($w[1],6,iconv('UTF-8', 'windows-1252', $records[$i]['question']),1,0,'L',0);

            $pdf2->Cell($w[2],6,$records[$i]['count'][0],1,0,'C', 'F');
            $pdf2->Cell($w[3],6,$records[$i]['count'][1],1,0,'C', 'F');
            $pdf2->Cell($w[4],6,$records[$i]['count'][2],1,0,'C', 'F');

            $pdf2->SetFillColor(233, 207, 184);

            $pdf2->Cell($w[5],6,iconv('UTF-8', 'windows-1252', $records[$i]['count'][0]+$records[$i]['count'][1]+$records[$i]['count'][2]),1,0,'C', 'F');

            $pdf2->Ln();

            $n++;

            $total+=$records[$i]['count'][0]+$records[$i]['count'][1]+$records[$i]['count'][2];

        }

    }

    if($ind){
        set_table_total($pdf2, $records, $section, $w, $total);
    }

    
}

function set_table_total($pdf2, $records, $section, $w, $total){

    $pdf2->SetFillColor(255,255,255);
    $pdf2->SetTextColor(0);
    $pdf2->SetFont('','B');

    $pdf2->Cell($w[0],6,iconv('UTF-8', 'windows-1252', ""),1,0,'C',0);
    $pdf2->Cell($w[1]+$w[2]+$w[3]+$w[4],6,iconv('UTF-8', 'windows-1252', "Total"),1,0,'L',0);
    $pdf2->Cell($w[5],6,iconv('UTF-8', 'windows-1252', $total),1,0,'C',0);
    $pdf2->Ln();
    
}

function responsive_table($pdf2, $records, $section, $w){

    for($i = 0, $n = 1; $i < count($records); $i++){

        if($records[$i]['section'] == $section){

            $pdf2->SetFillColor(255,255,255);
            $pdf2->SetTextColor(0);
            $pdf2->SetFont('');

            $pdf2->Row(array(
                $section.'.'.$n,
                utf8_decode($records[$i]['question']),
                utf8_decode($records[$i]['count'][0]),
                utf8_decode($records[$i]['count'][1]),
                utf8_decode($records[$i]['count'][2]),
                utf8_decode($records[$i]['count'][0]+$records[$i]['count'][1]+$records[$i]['count'][2])
            ));


        }

    }
}

function set_paragraph($pdf2, $section, $year){

    $pdf2->SetTextColor(0);
    $pdf2->SetFont('', '', 12);

    switch($section){
        case 1:
            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "1.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', '¿Cuál es el número de denuncias, querellas u otros requisitos equivalentes que se recibieron en la Procuraduría General de Justicia o Fiscalía General de la entidad federativa (incluyendo las recibidas en los Centros de Justicia para Mujeres) durante el '.strval($year).'?'), 'J');
        break;
        case 2:
            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "2.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', '¿Cuál es el número de carpetas de investigación iniciadas durante el '.strval($year).' con motivó de las denuncias, querellas u otros requisitos equivalentes que se recibieron en la Procuraduría General de Justicia o Fiscalía General de la entidad federativa (incluyendo las recibidas en los Centros de Justicia para Mujeres) en ese mismo año?'), 'J');

            $pdf2->Ln();

            $pdf2->Cell(10, 5, "", "", "", 'C');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', '¿Cuántas carpetas de investigación se iniciaron en el '.strval($year).' correspondientes a denuncias, querellas u otros requisitos equivalentes recibidos en '.strval($year-1).'?'), 'J');

            $pdf2->Ln();
        break;
        case 3:
            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "Nota.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'Los datos proporcionados en el reactivo 2.1 (carpetas de investigación iniciadas por denuncias, querellas u otros requisitos equivalentes recibidos en '.strval($year).') no podrán ser superiores a la suma de reactivos 1.1 a 1.2 de la pregunta número 1.'), 'J');

            $pdf2->Ln();

            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "3.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', '¿Cuál es el número de víctimas u ofendidos que derivan de las carpetas de investigación iniciadas en '.strval($year).'?'), 'J');

            $pdf2->Ln();
        break;
        case 4:
            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "3.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', '¿Cuántas carpetas de investigación se iniciaron en '.strval($year).' con al menos un detenido en flagrancia y cuántas se iniciaron sin detenido?'), 'J');
        break;
        case 5:
            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "Nota.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'Si una carpeta de investigación iniciada cuenta con al menos un detenido en flagrancia se registrara en el reactivo 4.1, incluso cuando se presente una situación mixta en la que puedan identificarse personas que no pudieron ser detenidas, pero se cuenta con al menos un detenido en flagrancia. Si la carpeta de investigación iniciada no cuenta con algún detenido se registrará en el reactivo 4.2.'), 'J');

            $pdf2->Ln();

            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "5.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'De las carpetas de investigación iniciadas (CII) en '.strval($year).'. ¿cuál es el número de órdenes de aprehensión solicitadas por el Ministerio Público; el número de órdenes de aprehensión ordenadas por el Juez de Control y el número de órdenes de aprehensióncumplimentadas por la Policía?'), 'J');

            $pdf2->Ln();

            $pdf2->Cell(10, 5, "", "", "", 'C');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', '¿Cuántas órdenes de detención por caso urgente fueron emitidas por el Ministerio Público y cuántas de éstas fueron cumplimentadas por la policía?'), 'J');

            $pdf2->Ln();
        break;
        case 6:
            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "Nota.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'Los datos proporcionados en el reactivo 5.3 (número de órdenes de aprehensión cumplimentadas) no podrán ser superiores al reactivo 5.2 (número de órdenes de aprehensión ordenadas) y éstas a su vez no podrán ser superiores al reactivo 5.1 (número de ordenes de aprehensión solicitadas).'), 'J');

            $pdf2->Ln();

            $pdf2->Cell(10, 5, "", "", "", 'C');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'De la misma forma, los datos proporcionados en el reactivo 5.5 (número de órdenes de detención por caso urgente cumplimentadas) no podrán ser superiores al reactivo 5.4 (número de órdenes de detención por caso urgente emitidas).'), 'J');

            $pdf2->Ln();

            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "6.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', '¿Cuál es el número de detenidos en flagrancia, por órden de aprehensión o caso urgente derivados de las carpetas de investigación iniciadas en '.strval($year).'?'), 'J');

            $pdf2->Ln();
        break;
        case 7:
            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "6.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'Los datos proporcionados en el reactivo 6.1 (número de detenidos en flagrancia) deberán ser cuando menos iguales o superiores al reactivo 4.1 (carpetas de investigación iniciadas con detenido en flagrancia) de la pregunta número 4.'), 'J');

            $pdf2->Ln();

            $pdf2->Cell(10, 5, "", "", "", 'C');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'Por su parte, los datos proporcionados en el reactivo 6.2 (número de detenidos por orden de aprehensión) deberán ser iguales o mayores a los datos proporcionados en el reactivo 5.3 (número de órdenes de aprehensión cumplimentadas) de la pregunta número 5. Lo anterior no es aplicable si la persona o personas se encuentren privadas de la libertad, es decir, en el centro penitenciario en cumplimiento, de su sentencia condenatoria o en cumplimiento de la medida cautelar de prisión preventiva.'), 'J');

            $pdf2->Ln();

            $pdf2->Cell(10, 5, "", "", "", 'C');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'De la misma forma, los datos proporcionados en el reactivo 6.3 (número de detenidos por caso urgente) deberán ser iguales o mayores a los datos proporcionados en el reactivo 5.5 (número de órdenes de detención por caso urgente cumplimentadas) de la pregunta número 5.'), 'J');

            $pdf2->Ln();

            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "7.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', '¿Cuántos procedimientos han realizado los agentes del Ministerio Público derivados de las carpetas de investigación iniciadas en '.strval($year).' y en qué estatus se encuentran desde su inicio hasta el auto de vinculación a proceso dentro de los rubros señalados, conforme los registros de la Procuraduría General de Justicia o Fiscalía General de la entidad federativa en los cortes referidos?'), 'J');

            $pdf2->Ln();

            $pdf2->Cell(10, 5, "", "", "", 'C');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'Para efectos de esta pregunta, debe considerarse que una carpeta de investigación puede derivar simultáneamente en varios procedimientos para definir la vía correspondiente para su terminación dentro del proceso penal, conforme la relación víctimas/ofendidos, imputados y delitos involucrados.'), 'J');

            $pdf2->Ln();

            $pdf2->Cell(10, 5, "", "", "", 'C');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'En este sentido, los procedimientos que han realizado los agentes del Ministerio Público se refieren al número de derivaciones que simultáneamente llevaron a cabo por cada una de las carpetas de investigación iniciadas para definir la vía correspondiente para su terminación dentro del proceso penal. El estatus es la situación que guardan dichos procedimientos en un momento determinado dentro de la etapa de investigación.'), 'J');

            $pdf2->Ln();

            $pdf2->Cell(10, 5, "", "", "", 'C');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'Ejemplo: En enero de '.strval($year).' se inició una carpeta de investigación con dos imputados y un ofendido. Al 30 de marzo de '.strval($year).', esa misma carpeta ha derivado en dos procedimientos: mediante un procedimiento se logró llegar a un acuerdo reparatorio entre la víctima y uno de los imputados, mientras que en otro procedimiento el segundo imputado se encuentra vinculado a proceso. En este caso, debe reportarse el estatus de ambos procedimientos, aun cuando pertenezcan a la misma carpeta de investigación.'), 'J');

            $pdf2->Ln();
        break;
        case 8:
            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "Nota.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'La suma de los datos proporcionados en todos los reactivos de esta pregunta (del 7.1 al 7.16) deberán ser iguales o mayores a la suma de los datos proporcionados en todos los reactivos de la pregunta 2, del 2.1 (carpetas de investigación iniciadas por denuncias, querellas u otros requisitos equivalentes recibidos en '.strval($year).' , respectivamente).'), 'J');

            $pdf2->Ln();

            $pdf2->Cell(10, 5, "", "", "", 'C');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'En el caso de que el Ministerio Público decida la acumulación de procesos, solamente se deberá considerar aquellas carpetas que se concluyeron con motivo de su incorporación a otra'), 'J');

            $pdf2->Ln();

            $pdf2->Cell(10, 5, "", "", "", 'C');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'En caso de que un procedimiento que todavía no haya sido vinculado a proceso se hubiere derivado al OEMASC perteneciente al Poder Judicial por cargas de trabajo u otros motivos, se deberá registrar en este apartado.'), 'J');

            $pdf2->Ln();

            $pdf2->Cell(10, 5, "", "", "", 'C');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'No deberán registrarselos procedimientos derivados al OEMASC dependiente de la Procuraduría o Fiscalía cuando éstos hayan sido vinculados a proceso.'), 'J');

            $pdf2->Ln();

            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "8.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', '¿Cuántos procedimientos se han generado de las vinculaciones a proceso derivadas de las carpetas de investigación iniciadas en '.strval($year).' y en qué estatus se encuentran dentro de los rubros señalados, conforme los registros de la Procuraduría General de Justicia o Fiscalía General de la entidad federativa en los cortes referidos?'), 'J');

            $pdf2->Ln();
        break;
        case 9:
            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "Nota.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'La suma de los datos proporcionados en esta pregunta (reactivos 8.1 al 8.14) deberá ser igual o mayor al dato proporcionado en el reactivo 7.11 (procedimientos vinculados a proceso).'), 'J');

            $pdf2->Ln();

            $pdf2->Cell(10, 5, "", "", "", 'C');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'En caso de que se realicen acuerdos reaparatorios a través del OEMASC dependiente de la Procuraduría o Fiscalía porque no se cuenta con OEMASC dependiente del Poder Judicial, deberá registrarse en éste apartado.'), 'J');

            $pdf2->Ln();

            $pdf2->Cell(10, 5, "", "", "", 'C');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'Si a la fecha de corte una carpeta de investigación tiene más de un procedimiento en el Órgano Jurisdiccional después de la vinculación a proceso, se deberá registrar cada uno de éstos aun cuando se trate de la misma carpeta de investigación.'), 'J');

            $pdf2->Ln();

            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "9.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'De los procedimientos derivados de las carpetas de investigación iniciadas en '.strval($year).', ¿a cuántos imputados de los que se les dictó auto de vinculación a proceso o que se encontraban en espera de la audiencia de vinculación se les impuso alguna medida cautelar?'), 'J');

            $pdf2->Ln();
        break;
        case 10:
            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "10.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'De los procedimientos derivados de las carpetas de investigación iniciadas en '.strval($year).', ¿cuántos imputados tuvieron sentencias condenatorias o absolutorias por tipo de procedimiento?'), 'J');

            $pdf2->Ln();

            $pdf2->Cell(10, 5, "", "", "", 'C');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'En los casos en que existan varias sentencias para un mismo imputado, se considerará lo siguiente:'), 'J');

            $pdf2->Ln();

            $pdf2->Cell(10, 5, "-", "", "", 'C');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'Un imputado con una o más sentencias absolutorias y ninguna condenatoria -> se contabilizará como un imputado con sentencia absolutoria.'), 'J');

            $pdf2->Ln();

            $pdf2->Cell(10, 5, "-", "", "", 'C');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'Un imputado con una o más sentencias condenatorias -> se contabilizará como un imputado con sentencia condenatoria.'), 'J');

            $pdf2->Ln();

            $pdf2->Cell(10, 5, "-", "", "", 'C');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'Un imputado con una o más sentencias absolutorias y una o más sentencias condenatorias -> se contabilizará como un imputado con sentencia condenatoria.'), 'J');

            $pdf2->Ln(12);
        break;
    }
}

function set_sign_field($pdf2, $user, $position){

    $pdf2->Ln(10);

    $pdf2->Ln(3);
    $pdf2->Cell(70, 70, iconv('UTF-8', 'windows-1252', 'Elaboró'), "", "", 'C');
    $pdf2->Cell(170, 70, iconv('UTF-8', 'windows-1252', 'Validó'), "", "", 'C');
    $pdf2->Ln(15);
    $pdf2->Cell(70, 70, iconv('UTF-8', 'windows-1252', $user), "", "", 'C');
    $pdf2->Cell(170, 70, iconv('UTF-8', 'windows-1252', $user), "", "", 'C');
    $pdf2->Ln(1);
    $pdf2->Cell(70, 80, iconv('UTF-8', 'windows-1252', $position), "", "", 'C');
    $pdf2->Cell(170, 80, iconv('UTF-8', 'windows-1252', $position), "", "", 'C');

}


function footer($pdf2)
{
    // Go to 1.5 cm from bottom
    $pdf2->SetY(-15);
    // Select Arial italic 8
    $pdf2->SetFont('Arial','I',8);
    // Print current and total page numbers
    $pdf2->Cell(0,10,'Page '.$pdf2->PageNo().'/{nb}',0,0,'C');
}

?>