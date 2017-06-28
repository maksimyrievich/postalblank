<?php
$tcpdf = new TCPDF('P','mm','A4',true,'UTF-8');
$tcpdf->AddPage();

$tcpdf->SetTextColor(5,0,0);
$tcpdf->Output(__DIR__ .'/blanks/file.pdf','f');
?>