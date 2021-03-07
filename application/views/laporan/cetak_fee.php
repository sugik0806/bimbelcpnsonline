<?php 
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
    
    public function Header() {
        $image_file = K_PATH_IMAGES.'logo_example.jpg';
        $this->Image($image_file, 20, 5, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetFont('helvetica', 'B', 18);
        $this->SetY(13);
        $this->Cell(0, 15, 'Fee Pemasaran', 0, false, 'C', 0, '', 0, false, 'M', 'M');
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
$pdf->SetAuthor('Bimbel CPNS Online');
$pdf->SetTitle('Laporan Fee Pemasaran');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins PDF_MARGIN_LEFT
$pdf->SetMargins(12, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
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
   $sum+= $value->harga;
}

$total = number_format($sum);

$sumFee = 0;
foreach($laporan as $key=>$value)
{
   $sumFee+= $value->referal_fee;
}

$total_fee = number_format($sumFee);
//echo $sum;

$skd = <<<EOD
<p align="center">Periode : $tgl_awal - $tgl_akhir </p>
<p align="center">$penerima_nya </p>
<br><br><br>
<table border="1" style="border-collapse:collapse">
    <thead>
        <tr align="center">
            <th width="5%">No.</th>
            <th width="15%">Nama</th>
            <th width="15%">Kelas</th>
            <th width="15%">Harga</th>
            <th width="12%">Angka Unik</th>
            <th width="12%">Diskon</th>
            <th width="12%">Fee</th>
            <th width="17%">Penerima fee</th>
        </tr>        
    </thead>
    <tbody>
EOD;


$no = 1;
foreach($laporan as $key=>$row) {
$net = number_format($row->harga);
$angka_unik = number_format($row->angka_unik);
$diskon = number_format($row->diskon);
$referal_fee = number_format($row->referal_fee);
$penerima = $row->penerima_fee;

$skd .= <<<EOD
    <tr align="center">
        <td align="center" width="5%">{$no}</td>
        <td width="15%">{$row->nama}</td>
        <td width="15%">{$row->nama_kelas}</td>
        <td width="15%">Rp. {$net}</td>
        <td width="12%">Rp. {$angka_unik}</td>
        <td width="12%">Rp. {$diskon}</td>
        <td width="12%">Rp. {$referal_fee}</td>
        <td width="17%">$penerima</td>
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
      <td></td>
      <td></td>
      <td></td>
      <td>Total</td>
      <td>Rp. {$total_fee}</td>
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
