<?php
if (isset($_GET['p'])) {
	$page = $_GET['p'];
	switch ($page) {

		case 'data_tamu':
			include "content/data_tamu.php";
			break;

		case 'pengaturan_akun':
			include "content/pengaturan_akun.php";
			break;

		default:
			if ($level == "pegawai") {
				include 'content/data_tamu.php';
			} else {
				include 'content/beranda.php';
			}
			break;
	}
} else {
	if ($level == "pegawai") {
		include 'content/data_tamu.php';
	} else {
		include 'content/beranda.php';
	}
}
