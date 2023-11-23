<?
class Contenido extends FPDF{
    function Header(){
        $this->SetFont('Courier','B',14);
        $this->SetTextColor(100,100,100);
        $this->SetX(70);
        $this->Write(5, "DWES, Claudio Moyano");
        $this->Ln();
    }

    function Footer(){
        $this->SetFont('Courier','B',14);
        $this->SetTextColor(100,100,100);
        //cerca al lado derecho
        // $this->SetY(-20);
        // $this->SetX(-20);
        $this->SetXY(-20,-20);
        $this->Write(5,$this->PageNo());
        $this->Ln();
    }
}