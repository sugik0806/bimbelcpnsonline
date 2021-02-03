<?php 
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
    
    public function Header() {
        $image_file = K_PATH_IMAGES.'logo_example.jpg';
        $this->Image($image_file, 20, 5, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetFont('helvetica', 'B', 18);
        $this->SetY(13);
        $this->Cell(0, 15, 'Laporan Pendapatan', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(20, 5, 'bimbelcpnsonline.id', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(0, 5, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Hasil Ujian');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

// create some HTML content

$sum = 0;
foreach($laporan as $key=>$value)
{
   $sum+= $value->net;
}

$total = number_format($sum);
//echo $sum;

$skd = <<<EOD
<br><br><br>
<table border="1" style="border-collapse:collapse">
    <thead>
        <tr align="center">
            <th width="5%">No.</th>
            <th width="35%">Nama</th>
            <th width="30%">Kelas</th>
            <th width="30%">Harga</th>
        </tr>        
    </thead>
    <tbody>
EOD;


$no = 1;
foreach($laporan as $key=>$row) {
$net = number_format($row->net);
$skd .= <<<EOD
    <tr align="center">
        <td align="center" width="5%">{$no}</td>
        <td width="35%">{$row->nama}</td>
        <td width="30%">{$row->nama_kelas}</td>
        <td width="30%">Rp. {$net}</td>
    </tr>
EOD;
$no++;
}

$skd .= <<<EOD
    </tbody>
    <tfoot>
    <tr align="center">
      <td></td>
      <td></td>
      <td>Total</td>
      <td>Rp. {$total}</td>
    </tr>
  </tfoot>
</table>
EOD;





$html = $skd;
// output the HTML content
$pdf->writeHTML($html, true, 0, true, 0);
// reset pointer to the last page
$pdf->lastPage();
// ---------------------------------------------------------

//Close and output PDF document
//$pdf->Output($laporan[0]->nama.'_'.$laporan[0]->nama_kelas.'.pdf', 'I');
//Close and output PDF document
$pdf->Output('rekap-pendapatan.pdf', 'I');
