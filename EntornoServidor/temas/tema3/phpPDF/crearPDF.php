<?php

require('./fpdf186/fpdf.php');
require('./contenido.php');

$pdf = new Contenido();

$pdf->AddPage();
$pdf->SetFont('Courier','B',20);
$pdf->Write(10, "Hola Mundo");
$pdf->Image("./portada.jpg",50,40,100,74);
$pdf->AddPage();

$pdf->Cell(30,10,"Prueba",1,0,"C",false);
$pdf->Cell(30,10,"Prueba",1,0,"C",false);
$pdf->Cell(30,10,"Prueba",1,0,"C",false);

$array = array(
    array('pc1','Lenovo','1TB','4GB RAM'),
    array('pc2','Dell','2TB','16GB RAM'),
    array('pc3','HP','1TB','8GB RAM'),
    array('pc4','Even','2TB','4GB RAM'),
);


$pdf->AddPage();

creaTabla($array,$pdf);

$pdf->Output();

function creaTabla($array, $pdf){
    $pdf->SetFont('Arial','B',15);
    $pdf->SetFillColor(1,100,255);
    $pdf->Cell(40,10,"PC",1,0,"C",true);
    $pdf->Cell(40,10,"Marca",1,0,"C",true);
    $pdf->Cell(40,10,"Disco Duro",1,0,"C",true);
    $pdf->Cell(40,10,"RAM",1,0,"C",true);

    $pdf->Ln();

    foreach ($array as $row) {
        foreach ($row as $dato){
            $pdf->Cell(40,10,$dato,1,0,'C',false);
        }
        $pdf->Ln();
    }

}