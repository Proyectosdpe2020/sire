<?php
require('fpdf-1.82/fpdf.php');
session_start();

//$records = json_decode($_POST['records'], true);

$records = $_SESSION['question_records'];
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

    //echo $periods[$records[0]['period_id']][0]."a";

$pdf = new FPDF();
$pdf->AddPage();


$pdf->SetFont('Arial','B',26);
$pdf->Cell(20,10,'Cuestionario', 0, 0, 'C');

$pdf->SetFont('Arial','B',16);
$pdf->Ln();
$pdf->Cell(20,10,'INDICADORES ESTRATÉGICOS DEL', 0, 0, 'C');

$pdf->SetFont('Arial','B',16);
$pdf->Ln();
$pdf->Cell(20,10,'MODELO DE EVALUACIÓN Y SEGUIMIENTO DE LA', 0, 0, 'C');

$pdf->Ln();
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(190,5,iconv('UTF-8', 'windows-1252', 'Antes del llenado del cuestionario le solicitamos consulte el "Instructivo" que acompaña al presente anexo. Le solicitamos también que previamente revise la información suministrada para asegurar que ésta sea consistente y congruente entre los diversos'), 'J');

$pdf->Ln();

$w = array(10, 90, 20, 20, 20, 30);

set_table_header($pdf, $records, $periods, $w);
set_table_content($pdf, $records, 1, $w);
$pdf->Ln();

set_table_header($pdf, $records, $periods, $w);
set_table_content($pdf, $records, 2, $w);
$pdf->Ln();

set_table_header($pdf, $records, $periods, $w);
set_table_content($pdf, $records, 3, $w);
$pdf->Ln();

set_table_header($pdf, $records, $periods, $w);
set_table_content($pdf, $records, 4, $w);
$pdf->Ln();

set_table_header($pdf, $records, $periods, $w);
set_table_content($pdf, $records, 5, $w);

$pdf->Ln();

set_table_header($pdf, $records, $periods, $w);
set_table_content($pdf, $records, 8, $w);
$pdf->Ln();

$pdf->Output();


function set_table_header($pdf, $records, $periods, $w){
    $pdf->SetLineWidth(.1);
    $pdf->SetDrawColor(0);
    $pdf->SetFont('','',9);


    $pdf->SetFillColor(124,139,158);
    $pdf->SetTextColor(255);
    $pdf->SetFont('','B');

    $pdf->Cell($w[0],7,iconv('UTF-8', 'windows-1252', "N°"),1,0,'C', 'F');
    $pdf->Cell($w[1],7,'Denuncias / Querellas / Otros Requisitos Equivalentes','TBR',0,'C', 'F');

    $pdf->Cell($w[2],7,$periods[$records[0]['period_id']][0],'TBR',0,'C', 'F');
    $pdf->Cell($w[3],7,$periods[$records[0]['period_id']][1],'TBR',0,'C', 'F');
    $pdf->Cell($w[4],7,$periods[$records[0]['period_id']][2],'TBR',0,'C', 'F');

    $pdf->SetFillColor(192,159,119);

    $pdf->Cell($w[5],7,'Total','TBR',0,'C', 'F');

    $pdf->Ln();
    
}


function set_table_content($pdf, $records, $section, $w){

    $total = 0;
    $ind = false;

    for($i = 0, $n = 1; $i < count($records); $i++){

        if($records[$i]['section'] == $section){

            $ind = true;

            $pdf->SetFillColor(255,255,255);
            $pdf->SetTextColor(0);
            $pdf->SetFont('');

            $pdf->Cell($w[0],6,iconv('UTF-8', 'windows-1252', $section.'.'.$n),'LBR',0,'C',0);
            $pdf->Cell($w[1],6,iconv('UTF-8', 'windows-1252', $records[$i]['question']),'BR',0,'L',0);

            $pdf->Cell($w[2],6,$records[$i]['count'][0],'BR',0,'C', 'F');
            $pdf->Cell($w[3],6,$records[$i]['count'][1],'BR',0,'C', 'F');
            $pdf->Cell($w[4],6,$records[$i]['count'][2],'BR',0,'C', 'F');

            $pdf->SetFillColor(233, 207, 184);

            $pdf->Cell($w[5],6,iconv('UTF-8', 'windows-1252', $records[$i]['count'][0]+$records[$i]['count'][1]+$records[$i]['count'][2]),'BR',0,'C', 'F');

            $pdf->Ln();

            $n++;

            $total+=$records[$i]['count'][0]+$records[$i]['count'][1]+$records[$i]['count'][2];

        }

    }

    if($ind){
        set_table_total($pdf, $records, $section, $w, $total);
    }

    
}

function set_table_total($pdf, $records, $section, $w, $total){

    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('','B');

    $pdf->Cell($w[0],6,iconv('UTF-8', 'windows-1252', ""),'LB',0,'C',0);
    $pdf->Cell($w[1]+$w[2]+$w[3]+$w[4],6,iconv('UTF-8', 'windows-1252', "Total"),'BR',0,'L',0);
    $pdf->Cell($w[5],6,iconv('UTF-8', 'windows-1252', $total),'BR',0,'C',0);
    $pdf->Ln();
    
}
?>