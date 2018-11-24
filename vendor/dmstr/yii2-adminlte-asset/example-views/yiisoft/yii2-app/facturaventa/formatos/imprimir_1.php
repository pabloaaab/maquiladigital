<?php
use inquid\pdf\FPDF;

class PDF extends FPDF
{

  function Header()
  {

    $this->SetY(10);
    $this->SetX(10);
    $this->setFont('Arial','',10);
    $this->setFillColor(255,255,255);
    $this->cell(277,5,"ORDER OF PAYMENTS",0,1,'C',1); 
    $this->SetX(10);
    $this->cell(277,5,"FEDERAL BUREAU OF ARBITRATION",0,1,'C',1);  

  }

function Content()
{
   
  
       
}

  function Footer()
  {

    $this->SetY(-8);
    $this->SetFont('Arial','',7);
    $this->Cell(0,10,'Page '.$this->PageNo().' of {nb}',0,0,'R');
  }
}

$pdf = new PDF('L', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Content();
$pdf->Output();

exit;
