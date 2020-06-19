<?php
require('fpdf-1.82/fpdf.php');
session_start();

//$records = json_decode($_POST['records'], true);

$records = $_SESSION['question_records'];

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

// Colors, line width and bold font
$pdf->SetLineWidth(.1);
$pdf->SetDrawColor(0);
$pdf->SetFont('','',9);


$pdf->SetFillColor(124,139,158);
$pdf->SetTextColor(255);
$pdf->SetFont('','B');

$pdf->Cell($w[0],7,iconv('UTF-8', 'windows-1252', "N°"),1,0,'C', 'F');
$pdf->Cell($w[1],7,'Denuncias / Querellas / Otros Requisitos Equivalentes','TBR',0,'C', 'F');

$pdf->Cell($w[2],7,'Abril','TBR',0,'C', 'F');
$pdf->Cell($w[3],7,'Mayo','TBR',0,'C', 'F');
$pdf->Cell($w[4],7,'Junio','TBR',0,'C', 'F');

$pdf->SetFillColor(192,159,119);

$pdf->Cell($w[5],7,'Total','TBR',0,'C', 'F');

$pdf->Ln();



$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);
$pdf->SetFont('');

$pdf->Cell($w[0],6,iconv('UTF-8', 'windows-1252', "1.1"),'LBR',0,'C',0);
$pdf->Cell($w[1],6,iconv('UTF-8', 'windows-1252', "Denuncias"),'BR',0,'L',0);

$pdf->Cell($w[2],6,'6','BR',0,'C', 'F');
$pdf->Cell($w[3],6,'6','BR',0,'C', 'F');
$pdf->Cell($w[4],6,'6','BR',0,'C', 'F');

$pdf->SetFillColor(233, 207, 184);

$pdf->Cell($w[5],6,iconv('UTF-8', 'windows-1252', "18"),'BR',0,'C', 'F');

$pdf->Ln();



$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);
$pdf->SetFont('');

$pdf->Cell($w[0],6,iconv('UTF-8', 'windows-1252', "1.2"),'LBR',0,'C',0);
$pdf->Cell($w[1],6,iconv('UTF-8', 'windows-1252', "Querellas u otros requisitos equivalentes"),'BR',0,'L',0);

$pdf->Cell($w[2],6,'6','BR',0,'C', 'F');
$pdf->Cell($w[3],6,'7','BR',0,'C', 'F');
$pdf->Cell($w[4],6,'6','BR',0,'C', 'F');

$pdf->SetFillColor(233, 207, 184);

$pdf->Cell($w[5],6,iconv('UTF-8', 'windows-1252', "19"),'BR',0,'C', 'F');

$pdf->Ln();


$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);
$pdf->SetFont('','B');

$pdf->Cell($w[0],6,iconv('UTF-8', 'windows-1252', ""),'LB',0,'C',0);
$pdf->Cell($w[1]+$w[2]+$w[3]+$w[4],6,iconv('UTF-8', 'windows-1252', "Total"),'BR',0,'L',0);
$pdf->Cell($w[5],6,iconv('UTF-8', 'windows-1252', "37"),'BR',0,'C',0);
$pdf->Ln();


/*
$pdf->Cell(40,5,' ','LTR',0,'L',0);   // empty cell with left,top, and right borders
$pdf->Cell(50,5,'Words Here',1,0,'L',0);
$pdf->Cell(50,5,'Words Here',1,0,'L',0);
$pdf->Cell(40,5,'Words Here','LR',1,'C',0);  // cell with left and right borders
$pdf->Cell(50,5,'[ x ] abc',1,0,'L',0);
$pdf->Cell(50,5,'[ x ] checkbox1',1,0,'L',0);
$pdf->Cell(40,5,'','LBR',1,'L',0);   // empty cell with left,bottom, and right borders
$pdf->Cell(50,5,'[ x ] def',1,0,'L',0);
$pdf->Cell(50,5,'[ x ] checkbox2',1,0,'L',0);
*/
$pdf->Output();
?>