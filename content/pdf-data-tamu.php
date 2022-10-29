<?php
require_once '../vendor/autoload.php';
// require_once '../vendor/autoload.php';
require '../function.php';
$tanggal = date('d/m/Y');
$bulan_ini = date('m');
$tahun_ini = date('Y');

$data_tamu = mysqli_query($conn, "SELECT * FROM tb_tamu ORDER BY id_tamu DESC");

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L'], ['defaultPageNumStyle' => '1']);
$mpdf->setFooter('Data Tamu | Kejaksaan Negeri Dairi | ' . $tanggal);
$mpdf->AddPage('L', '', '', '', '', 6, 6, 6, 6, 5, 5);
ini_set("pcre.backtrack_limit", "9999999999999");

$html = '
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Rekap Data Tamu - Kejaksaan Negeri Dairi</title>
	</head>
	<body>
		<img src="../img/kejari.png" style="height: 50px;" />
		<p style="text-align: center; font-weight: bold; margin-top: -45px;">
			REKAP DATA TAMU <br>
			KEJAKSAAN NEGERI DAIRI
		</p>
		<hr style="height: 2px; color: #000; margin: 10px 0 20px 0 ;">
		<table cellpadding="3" border="0" cellspacing="1" style="width:100%; font-size: 10px;">
			<tr>
	            <th style="text-align: center; width: 20px; border-left: solid 1px #000; border-bottom: solid 1px #000; border-top: solid 1px #000;">No.</th>
	            <th style="text-align: center; width:100px; border-left: solid 1px #000; border-bottom: solid 1px #000; border-top: solid 1px #000;">Tanggal & Waktu</th>
	            <th style="text-align: center; width:150px; border-left: solid 1px #000; border-bottom: solid 1px #000; border-top: solid 1px #000;">Nama</th>
	            <th style="text-align: center; width:100px; border-left: solid 1px #000; border-bottom: solid 1px #000; border-top: solid 1px #000;">Jenis Kelamin</th>
	            <th style="text-align: center; width:100px; border-left: solid 1px #000; border-bottom: solid 1px #000; border-top: solid 1px #000;">Alamat</th>
	            <th style="text-align: center; width:100px; border-left: solid 1px #000; border-bottom: solid 1px #000; border-top: solid 1px #000;">No. Handphone</th>
	            <th style="text-align: center; width:100px; border-left: solid 1px #000; border-bottom: solid 1px #000; border-top: solid 1px #000;">Asal Instansi</th>
	            <th style="text-align: center; width:100px; border-left: solid 1px #000; border-bottom: solid 1px #000; border-top: solid 1px #000;">Bertemu</th>
	            <th style="text-align: center; width:120px; border: solid 1px #000;">Keperluan</th>
			</tr>
			';

$no = 1;
while ($row = mysqli_fetch_assoc($data_tamu)) {
	$html .= '
					<tr>
						<td style="text-align: center; border-left: solid 1px #000; border-top: solid 1px #000; border-bottom: solid 1px #000;">
						' . $no++ . '
						</td>
						<td style="text-align: left; border-left: solid 1px #000; border-top: solid 1px #000; border-bottom: solid 1px #000;">
						' . $row['tanggal'] . ' <br>
						' . $row['waktu'] . ' WIB
						</td> 
						<td style="text-align: left; border-left: solid 1px #000; border-top: solid 1px #000; border-bottom: solid 1px #000;">
							' . $row["nama"] . '
						</td>
						<td style="text-align: left; border-left: solid 1px #000; border-top: solid 1px #000; border-bottom: solid 1px #000;">
							' . $row["jenis_kelamin"] . '
						</td>
						<td style="text-align: left; border-left: solid 1px #000; border-top: solid 1px #000; border-bottom: solid 1px #000;">
							' . $row["alamat"] . '
						</td>
						<td style="text-align: center; border-left: solid 1px #000; border-top: solid 1px #000; border-bottom: solid 1px #000;">
							' . $row["no_hp"] . '
						</td>
						<td style="text-align: left; border-left: solid 1px #000; border-top: solid 1px #000; border-bottom: solid 1px #000;">
							' . $row["asal_instansi"] . '
						</td>
						<td style="text-align: left; border-left: solid 1px #000; border-top: solid 1px #000; border-bottom: solid 1px #000;">
							' . $row["bertemu"] . '
						</td>
						<td style="text-align: left; border: solid 1px #000;">
							' . $row["keperluan"] . '
						</td>
					</tr>
					';
}

$html .= '
		</table>
	</body>
	</html>
	';

$mpdf->WriteHTML($html);
$namafile = "Rekap Data Tamu - Kejaksaan Negeri Dairi.pdf";
$mpdf->Output($namafile, 'I');
