<?php 
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    public function Header() {
        $image_file = K_PATH_IMAGES.'logo_example.jpg';
        $this->Image($image_file, 20, 5, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetFont('helvetica', 'B', 18);
        $this->SetY(13);
        $this->Cell(0, 15, 'Hasil Tryout', 0, false, 'C', 0, '', 0, false, 'M', 'M');
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

$mulai = strftime('%A, %d %B %Y', strtotime($ujian->tgl_mulai));
$selesai = strftime('%A, %d %B %Y', strtotime($ujian->terlambat));

// create some HTML content

$skd = <<<EOD
<hr>
<p>
Ringkasan Hasil Tryout
</p>
<table>
    <tr>
        <th>Nama Tryout</th>
        <td>{$ujian->nama_ujian}</td>
        <th>Mata Bimbingan</th>
        <td>{$ujian->nama_matkul}</td> 
    </tr>
    <tr>
        <th>Jumlah Soal</th>
        <td>{$ujian->jumlah_soal}</td>
        <th>Pembimbing</th>
        <td>{$ujian->nama_dosen}</td>
    </tr>
    <tr>
        <th>Waktu</th>
        <td>{$ujian->waktu} Menit</td>
        <th>Nilai Terendah</th>
        <td>{$nilai->min_nilai}</td>
    </tr>
    <tr>
        <th>Tanggal Mulai</th>
        <td>{$mulai}</td>
        <th>Nilai Tertinggi</th>
        <td>{$nilai->max_nilai}</td>
    </tr>
    <tr>
        <th>Tanggal Selasi</th>
        <td>{$selesai}</td>
        <th>Rata-rata Nilai</th>
        <td>{$nilai->avg_nilai}</td>
    </tr>
</table>
EOD;

$skd .= <<<EOD
<br><br><br>
<table border="1" style="border-collapse:collapse">
    <thead>
        <tr align="center">
            <th width="5%">No.</th>
            <th width="25%">Nama</th>
            <th width="15%">Paket</th>
            <th width="10%">Jumlah Benar</th>
            <th width="10%">TWK</th>
            <th width="10%">TIU</th>
            <th width="10%">TKP</th>
            <th width="10%">Nilai</th>
        </tr>        
    </thead>
    <tbody>
EOD;

$no = 1;
foreach($hasil as $row) {
$skd .= <<<EOD
    <tr align="center">
        <td align="center" width="5%">{$no}</td>
        <td width="25%">{$row->nama}</td>
        <td width="15%">{$row->nama_jurusan}</td>
        <td width="10%">{$row->jml_benar}</td>
        <td width="10%">{$row->twk}</td>
        <td width="10%">{$row->tiu}</td>
        <td width="10%">{$row->tkp}</td>
        <td width="10%">{$row->nilai}</td>
    </tr>
EOD;
$no++;
}

$skd .= <<<EOD
    </tbody>
</table>
EOD;




$skb = <<<EOD
<p>
Ringkasan Hasil Tryout
</p>
<table>
    <tr>
        <th>Nama Tryout</th>
        <td>{$ujian->nama_ujian}</td>
        <th>Mata Bimbingan</th>
        <td>{$ujian->nama_matkul}</td> 
    </tr>
    <tr>
        <th>Jumlah Soal</th>
        <td>{$ujian->jumlah_soal}</td>
        <th>Pembimbing</th>
        <td>{$ujian->nama_dosen}</td>
    </tr>
    <tr>
        <th>Waktu</th>
        <td>{$ujian->waktu} Menit</td>
        <th>Nilai Terendah</th>
        <td>{$nilai->min_nilai}</td>
    </tr>
    <tr>
        <th>Tanggal Mulai</th>
        <td>{$mulai}</td>
        <th>Nilai Tertinggi</th>
        <td>{$nilai->max_nilai}</td>
    </tr>
    <tr>
        <th>Tanggal Selasi</th>
        <td>{$selesai}</td>
        <th>Rata-rata Nilai</th>
        <td>{$nilai->avg_nilai}</td>
    </tr>
</table>
EOD;

$skb .= <<<EOD
<br><br><br>
<table border="1" style="border-collapse:collapse">
    <thead>
        <tr align="center">
            <th width="5%">No.</th>
            <th width="40%">Nama</th>
            <th width="35%">Paket</th>
            <th width="10%">Jumlah Benar</th>
            <th width="10%">Nilai</th>
        </tr>        
    </thead>
    <tbody>
EOD;

$no2 = 1;
foreach($hasil as $row) {
$skb .= <<<EOD
    <tr align="center">
        <td align="center" width="5%">{$no}</td>
        <td width="40%">{$row->nama}</td>
        <td width="35%">{$row->nama_jurusan}</td>
        <td width="10%">{$row->jml_benar}</td>
        <td width="10%">{$row->nilai}</td>
    </tr>
EOD;
$no2++;
}

$skb .= <<<EOD
    </tbody>
</table>
EOD;

// output the HTML content
if ($ujian->nama_matkul == "SKB") {
    $pdf->writeHTML($skb, true, 0, true, 0);
}elseif ($ujian->nama_matkul == "SKD") {
    $pdf->writeHTML($skd, true, 0, true, 0);
}


// reset pointer to the last page
$pdf->lastPage();
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('tes.pdf', 'I');
