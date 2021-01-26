<?php
include('database.php');
$database = new Database();
$result = $database->runQuery("SELECT * FROM register");
$header = $database->runQuery("SELECT UCASE(`COLUMN_NAME`) 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='impexp' 
AND `TABLE_NAME`='register'
and `COLUMN_NAME` in ('ID','Name','Email','Phone')");

require('fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',6);

foreach($header as $heading) {
	foreach($heading as $column_heading)
		$pdf->Cell(42,8,$column_heading,1);
}
foreach($result as $row) {
	$pdf->Ln();
	foreach($row as $column)
		$pdf->Cell(42,8,$column,1);
}
$pdf->Output();
?>