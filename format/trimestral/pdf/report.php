<?php
//require('fpdf-1.82/fpdf.php');
require('mcTable.php');
//session_start();

//$records = json_decode($_POST['records'], true);

$records = $_SESSION['question_records'];
$involved_people = $_SESSION['involved_people'];

$position = 'Fiscalía General';
$user = '[Nombre, Cargo y Firma]';
$ur = $records[0]['unity'];
$year = $records[0]['year'];
$periods = array(
    array(
        'Enero - Marzo',
        'Abril - Junio',
        'Julio - Septiembre',
        'Octubre - Diciembre'
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
$pdf2->Cell(190, 10, iconv('UTF-8', 'windows-1252', 'INFORME TRIMESTRAL'), "", "", 'C');

$pdf2->SetFont('Arial','B',14);
$pdf2->Ln(15);

$pdf2->Cell(190, 7, iconv('UTF-8', 'windows-1252', 'INDICADORES ESTRATÉGICOS DEL MODELO DE EVALUACIÓN'), "", "", 'C');

$pdf2->SetFont('Arial','B',14);
$pdf2->Ln(6);
$pdf2->Cell(190, 7, iconv('UTF-8', 'windows-1252', 'Y SEGUIMIENTO DE LA CONSOLIDACIÓN DEL SISTEMA DE'), "", "", 'C');

$pdf2->SetFont('Arial','B',14);
$pdf2->Ln(6);
$pdf2->Cell(190, 7, iconv('UTF-8', 'windows-1252', 'JUSTICIA PENAL INFORMACIÓN DE '.strval($year)), "", "", 'C');

$pdf2->Ln();
$pdf2->SetFont('Arial','',10);

$pdf2->Ln(10);

$pdf2->SetFont('','B','');
$pdf2->Cell(20, 7, iconv('UTF-8', 'windows-1252', 'Trimestre:'), "", "", 'L');
$pdf2->SetFont('','','');

switch($records[0]['period_id']){
    case 1:
        $pdf2->MultiCell(150,7,iconv('UTF-8', 'windows-1252', 'Enero - Marzo del '.strval($year)), 'J');
    break;

    case 2:
        $pdf2->MultiCell(150,7,iconv('UTF-8', 'windows-1252', 'Abril - Junio del '.strval($year)), 'J');
    break;

    case 3:
        $pdf2->MultiCell(150,7,iconv('UTF-8', 'windows-1252', 'Julio - Septiembre del '.strval($year)), 'J');
    break;

    case 4:
        $pdf2->MultiCell(150,7,iconv('UTF-8', 'windows-1252', 'Octubre - Diciembre del '.strval($year)), 'J');
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
$pdf2->Cell(22, 7, iconv('UTF-8', 'windows-1252', 'Institución:'), "", "", 'L');
$pdf2->SetFont('','','');
$pdf2->MultiCell(150,7,iconv('UTF-8', 'windows-1252', 'Fiscalía General del Estado de Michoacán'), 'J');

$pdf2->Ln(1);

$pdf2->SetFont('','B','');
$pdf2->Cell(17, 7, iconv('UTF-8', 'windows-1252', 'Unidad:'), "", "", 'L');
$pdf2->SetFont('','','');
$pdf2->MultiCell(150,7,iconv('UTF-8', 'windows-1252', $ur), 'J');

$pdf2->Ln(1);

$pdf2->SetFont('', '', 12);

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
    set_table_header($pdf2, $records, $periods, $headers[$i], $w[$i]);
    set_table_content($pdf2, $records, $i+1, $w[$i]);
    $pdf2->Ln(10);
}

set_sign_field($pdf2, $user, $position, $involved_people);
    
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
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'Número de denuncias, querellas u otros requisitos equivalentes que se recibieron en su unidad durante el '.strval($year).'.'), 'J');
        break;
        case 2:
            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "2.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'Número de carpetas de investigación iniciadas durante el '.strval($year).' con motivó de las denuncias, querellas u otros requisitos equivalentes que se recibieron en su unidad en ese mismo año.'), 'J');

            $pdf2->Ln();

            $pdf2->Cell(10, 5, "", "", "", 'C');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'Carpetas de investigación se iniciaron en el '.strval($year).' correspondientes a denuncias, querellas u otros requisitos equivalentes recibidos en '.strval($year-1).'.'), 'J');

            $pdf2->Ln();
        break;
        case 3:
            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "3.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'Número de víctimas u ofendidos que derivan de las carpetas de investigación iniciadas en '.strval($year).'.'), 'J');

            $pdf2->Ln();
        break;
        case 4:
            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "4.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'Carpetas de investigación se iniciaron en '.strval($year).' con al menos un detenido en flagrancia y cuántas se iniciaron sin detenido.'), 'J');
        break;
        case 5:
            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "5.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'Derivado de las carpetas de investigación iniciadas (CII) en '.strval($year).', número de órdenes de aprehensión solicitadas por el Ministerio Público; el número de órdenes de aprehensión ordenadas por el Juez de Control y el número de órdenes de aprehensión cumplimentadas por la Policía.'), 'J');

            $pdf2->Ln();

            $pdf2->Cell(10, 5, "", "", "", 'C');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'Órdenes de detención por caso urgente fueron emitidas por el Ministerio Público y cuántas de éstas fueron cumplimentadas por la policía.'), 'J');

            $pdf2->Ln();
        break;
        case 6:
            $pdf2->Ln();

            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "6.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'Número de detenidos en flagrancia, por órden de aprehensión o caso urgente derivados de las carpetas de investigación iniciadas en '.strval($year).'.'), 'J');

            $pdf2->Ln();
        break;
        case 7:
            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "7.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'Procedimientos realizados por los agentes del Ministerio Público derivados de las carpetas de investigación iniciadas en '.strval($year).' y en qué estatus se encuentran desde su inicio hasta el auto de vinculación a proceso dentro de los rubros señalados, conforme los registros de su unidad en los cortes referidos.'), 'J');

            $pdf2->Ln();
        break;
        case 8:
            $pdf2->Ln();

            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "8.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'Procedimientos que se han generado de las vinculaciones a proceso derivadas de las carpetas de investigación iniciadas en '.strval($year).' y en qué estatus se encuentran dentro de los rubros señalados, conforme los registros de su unidad en los cortes referidos.'), 'J');

            $pdf2->Ln();
        break;
        case 9:
            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "9.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'Derivado de las carpetas de investigación iniciadas en '.strval($year).'; imputados a los que se les dictó auto de vinculación a proceso o que se encontraban en espera de la audiencia de vinculación se les impuso alguna medida cautelar.'), 'J');

            $pdf2->Ln();
        break;
        case 10:
            $pdf2->SetFont('','B');
            $pdf2->Cell(10, 5, "10.", "", "", 'C');
            $pdf2->SetFont('','');
            $pdf2->MultiCell(175,6,iconv('UTF-8', 'windows-1252', 'Derivado de las carpetas de investigación iniciadas en '.strval($year).'; Imputados que tuvieron sentencias condenatorias o absolutorias por tipo de procedimiento.'), 'J');

            $pdf2->Ln(12);
        break;
    }
}

function set_sign_field($pdf2, $user, $position, $involved_people){

    if(isset($involved_people['third_person'])){
        $pdf2->Ln(-30);
    }
    
    $pdf2->Ln(5);

    $pdf2->Cell(70, 70, iconv('UTF-8', 'windows-1252', 'Elaboró'), "", "", 'C');
    $pdf2->Cell(170, 70, iconv('UTF-8', 'windows-1252', 'Validó'), "", "", 'C');
    $pdf2->Ln(15);
    $pdf2->Cell(70, 70, iconv('UTF-8', 'windows-1252', $involved_people['elaborated_by']['name']), "", "", 'C');
    $pdf2->Cell(170, 70, iconv('UTF-8', 'windows-1252',  $involved_people['validated_by']['name']), "", "", 'C');
    $pdf2->Ln(1);
    //$pdf2->Cell(70, 80, iconv('UTF-8', 'windows-1252', $involved_people['elaborated_by']['position']), "", "", 'C');
    //$pdf2->Cell(170, 80, iconv('UTF-8', 'windows-1252', $involved_people['validated_by']['position']), "", "", 'C');

    if(strlen($involved_people['validated_by']['position']) > 51){

        $pdf2->Ln(40);
        $pdf2->Cell(80, 6, iconv('UTF-8', 'windows-1252', $involved_people['elaborated_by']['position']), "", "", 'C');
        $pdf2->Cell(25, 6, '', "", "", 'C');
        $pdf2->MultiCell(95,6,iconv('UTF-8', 'windows-1252', $involved_people['validated_by']['position']), 0, 'C');

    }
    else{
        $pdf2->Cell(70, 80, iconv('UTF-8', 'windows-1252', $involved_people['elaborated_by']['position']), "", "", 'C');
        $pdf2->Cell(170, 80, iconv('UTF-8', 'windows-1252', $involved_people['validated_by']['position']), "", "", 'C');
    }

    if(isset($involved_people['third_person'])){
        $pdf2->Ln(-20);

        $pdf2->Cell(180, 80, iconv('UTF-8', 'windows-1252', $involved_people['third_person']['function']), "", "", 'C');

        $pdf2->Ln(8);

        $pdf2->Cell(180, 80, iconv('UTF-8', 'windows-1252', $involved_people['third_person']['name']), "", "", 'C');
        $pdf2->Ln(5);
        $pdf2->Cell(180, 80, iconv('UTF-8', 'windows-1252', $involved_people['third_person']['position']), "", "", 'C');
    }

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