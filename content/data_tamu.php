<?php
$tanggal = date('d/m/Y');
$bulan_ini = date('m');
$tahun_ini = date('Y');

if (isset($_POST["filter"])) {
	$jenis_filter = $_POST["filter"];
	if ($_POST["filter"] == "0") {
		$data_tamu = mysqli_query($conn, "SELECT * FROM tb_tamu WHERE tanggal LIKE '$tanggal' ORDER BY id_tamu DESC");
	} elseif ($_POST["filter"] == "1") {
		date_default_timezone_set(date_default_timezone_get());
		$dt = strtotime($tanggal);
		$awal_minggu = date('N', $dt) == 1 ? date('d/m/Y', $dt) : date('d/m/Y', strtotime('last monday', $dt));
		$akhir_minggu =	date('N', $dt) == 7 ? date('d/m/Y', $dt) : date('d/m/Y', strtotime('next sunday', $dt));
		$awal = $awal_minggu;
		$akhir = $akhir_minggu;

		$data_tamu = mysqli_query($conn, "SELECT * FROM tb_tamu WHERE tanggal BETWEEN '$awal' AND '$akhir' ORDER BY id_tamu DESC");
	} elseif ($_POST["filter"] == "2") {
		$data_tamu = mysqli_query($conn, "SELECT * FROM tb_tamu WHERE tanggal LIKE '%/$bulan_ini/$tahun_ini' ORDER BY id_tamu DESC");
	} elseif ($_POST["filter"] == "3") {
		$data_tamu = mysqli_query($conn, "SELECT * FROM tb_tamu WHERE tanggal LIKE '%/%/$tahun_ini' ORDER BY id_tamu DESC");
	} elseif ($_POST["filter"] == "4") {
		$data_tamu = mysqli_query($conn, "SELECT * FROM tb_tamu ORDER BY id_tamu DESC");
	}
} else {
	$data_tamu = mysqli_query($conn, "SELECT * FROM tb_tamu ORDER BY id_tamu DESC");
	$jenis_filter = "4";
}


if (isset($_POST["hapus_data_tamu"])) {
	if (hapus_data_tamu($_POST) > 0) {
		echo "
                    <script>
                        setTimeout(function() {
                            swal({
                                title: 'Berhasil !',
                                text: 'Data tamu berhasil ditambahkan !',
                                type: 'success',
                                showConfirmButton: false,
                                timer: 100
                            }, function() {
                                window.location ='index.php?p=data_tamu';
                            });
                        }, 300);
                    </script>
            ";
	} else {
		echo "
                    <script>
                        setTimeout(function() {
                            swal({
                                title: 'Gagal !',
                                text: 'Data tamu gagal ditambahkan !',
                                type: 'warning',
                            	showConfirmButton: false,
                                timer: 100
                            }, function() {
                                window.location ='index.php?p=data_tamu';
                            });
                        }, 300);
                    </script>
            ";
	}
}

?>

<section id="services">
	<div class="container-fluid pb-5">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="row mt-2 justify-content-between">
							<div class="col-lg-3">
								<form action="" method="post">
									<div class="form-group align-items-center">
										<label for="filter">Periode Data :</label>
										<select name="filter" id="filter" class="form-control" style="width: 200px;" onchange="this.form.submit()">
											<option value="4" <?= ((isset($_POST['filter'])) and ($_POST['filter'] == "4")) ? "selected" : ""; ?>>
												Semua
											</option>
											<option value="0" <?= ((isset($_POST['filter'])) and ($_POST['filter'] == "0")) ? "selected" : ""; ?>>
												Hari ini
											</option>
											<option value="1" <?= ((isset($_POST['filter'])) and ($_POST['filter'] == "1")) ? "selected" : ""; ?>>
												Minggu ini
											</option>
											<option value="2" <?= ((isset($_POST['filter'])) and ($_POST['filter'] == "2")) ? "selected" : ""; ?>>
												Bulan ini
											</option>
											<option value="3" <?= ((isset($_POST['filter'])) and ($_POST['filter'] == "3")) ? "selected" : ""; ?>>
												Tahun ini
											</option>
										</select>
									</div>
								</form>
							</div>

							<div class="col-lg-4">
								<div id="FilterAsalInstansi">
									<label>Asal Instansi :</label>
									<br>
								</div>
							</div>

							<div class="col-lg-3">
								<div id="FilterBertemu">
									<label>Bertemu :</label>
									<br>
								</div>
							</div>

							<div class="col-lg-2 pt-4">
								<form action="./content/pdf-data-tamu.php" method="post" target="_blank">
									<div class="form-group d-flex align-items-center justify-content-end">
										<input type="hidden" name="filter" value="<?= $jenis_filter; ?>">
										<button type="submit" name="cetak" class="btn btn-dark">
											Cetak PDF (*.pdf)
										</button>
									</div>
								</form>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="card shadow">
					<div class="card-body">

						<table class="table table-bordered table-sm table-responsive" id="data-tamu" style="font-size: 14px; width: 100%;">
							<thead>
								<tr class="text-center">
									<th>No.</th>
									<th>Tgl & Waktu</th>
									<th>Tamu</th>
									<th>Asal Instansi</th>
									<th>Bertemu</th>
									<?php if (($level == "admin") or ($level == "user")) : ?>
										<th>Aksi</th>
									<?php endif; ?>
								</tr>
							</thead>

							<tbody>
								<?php $no = 1; ?>
								<?php while ($row = mysqli_fetch_assoc($data_tamu)) : ?>
									<tr>
										<td class="text-center" style="vertical-align: middle;"><?= $no++; ?>.</td>
										<td style="width: 15%; vertical-align: middle;">
											<?= $row["tanggal"]; ?> <?= $row["waktu"]; ?>
										</td>
										<td style="width: 30%; vertical-align: middle;">
											<?= $row['nama']; ?> <br>
											</a>
										</td>
										<td style="vertical-align: middle; width: 20%;"><?= $row["asal_instansi"]; ?></td>
										<td style="width: 30%; vertical-align: middle;">
											<?= $row["bertemu"]; ?>
										</td>
										<?php if (($level == "admin") or ($level == "user")) : ?>
											<td style="vertical-align: middle;">
												<div class="list-unstyled d-flex justify-content-center">
													<li class="mr-1">
														<a id="detail_tamu" data-toggle="modal" data-target="#modal-detail-tamu" data-tanggal="<?= $row['tanggal']; ?>" data-waktu="<?= $row['waktu']; ?> WIB" data-nama-tamu="<?= $row['nama']; ?>" data-jk-tamu="<?= $row['jenis_kelamin']; ?>" data-no-hp-tamu="<?= $row['no_hp']; ?>" data-alamat-tamu="<?= $row['alamat']; ?>" data-asal-instansi-tamu="<?= $row['asal_instansi']; ?>" data-bertemu="<?= $row['bertemu']; ?>" data-keperluan-tamu="<?= $row['keperluan']; ?>" data-foto-tamu="<?= (empty($row['foto'])) ? 'img/bgnoimage.png' : 'upload/' . $row['foto']; ?>" class="btn btn-sm btn-info text-white">
															<i class="fa fa-list"></i> Detail
														</a>
													</li>
													<li>
														<form action="" method="POST">
															<input type="hidden" name="id_tamu" value="<?= $row["id_tamu"]; ?>">
															<button type="submit" name="hapus_data_tamu" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')">
																<i class="fa fa-trash"></i> Hapus
															</button>
														</form>
													</li>
												</div>
											</td>
										<?php endif; ?>
									</tr>
								<?php endwhile; ?>
							</tbody>
						</table>

					</div>
				</div>
			</div>

		</div>

	</div>

</section>

<div class="modal fade bd-example-modal-lg" id="modal-detail-tamu">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Data Tamu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body table-responsive">
				<div class="row align-items-center">
					<div class="col-lg-5">
						<img id="foto_tamu" src="" style="width: 100%; height: 250px; object-fit: contain;">
					</div>
					<div class="col-lg-7">
						<table class="table-sm no-margin" style="font-size: 14px; width: 100%;">
							<tbody>
								<tr>
									<td>Tanggal</td>
									<td>:</td>
									<td><span id="tanggal"></span></td>
								</tr>
								<tr>
									<td>Waktu</td>
									<td>:</td>
									<td><span id="waktu"></span></td>
								</tr>
								<tr>
									<td>Nama Lengkap</td>
									<td>:</td>
									<td><span id="nama_tamu"></span></td>
								</tr>
								<tr>
									<td>Jenis Kelamin</td>
									<td>:</td>
									<td><span id="jk_tamu"></span></td>
								</tr>
								<tr>
									<td>No. Handphone</td>
									<td>:</td>
									<td><span id="no_hp_tamu"></span></td>
								</tr>
								<tr>
									<td>Alamat</td>
									<td>:</td>
									<td><span id="alamat_tamu"></span></td>
								</tr>
								<tr>
									<td>Asal Instansi</td>
									<td>:</td>
									<td><span id="asal_instansi_tamu"></span></td>
								</tr>
								<tr>
									<td>Bertemu</td>
									<td>:</td>
									<td><span id="bertemu"></span></td>
								</tr>
								<tr>
									<td>Keperluan</td>
									<td>:</td>
									<td><span id="keperluan_tamu"></span></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$(document).on('click', '#detail_tamu', function() {
			var tanggal = $(this).data('tanggal');
			var waktu = $(this).data('waktu');
			var nama_tamu = $(this).data('nama-tamu');
			var jk_tamu = $(this).data('jk-tamu');
			var no_hp_tamu = $(this).data('no-hp-tamu');
			var alamat_tamu = $(this).data('alamat-tamu');
			var asal_instansi_tamu = $(this).data('asal-instansi-tamu');
			var bertemu = $(this).data('bertemu');
			var keperluan_tamu = $(this).data('keperluan-tamu');
			var foto_tamu = $(this).data('foto-tamu');

			$('#tanggal').text(tanggal);
			$('#waktu').text(waktu);
			$('#nama_tamu').text(nama_tamu);
			$('#jk_tamu').text(jk_tamu);
			$('#no_hp_tamu').text(no_hp_tamu);
			$('#alamat_tamu').text(alamat_tamu);
			$('#asal_instansi_tamu').text(asal_instansi_tamu);
			$('#bertemu').text(bertemu);
			$('#keperluan_tamu').text(keperluan_tamu);
			$('#foto_tamu').attr("src", foto_tamu);

			$('#modal-item').modal('hide');
		});
	});
</script>

<script>
	$('#data-tamu').DataTable({
		"lengthMenu": [
			[10, 25, 50, 100, -1],
			[10, 25, 50, 100, "All"]
		],
		"paging": true,
		"lengthChange": true,
		"searching": true,
		"ordering": true,
		"info": true,
		"autoWidth": true,
		"responsive": true,

		// "dom": 'rtipS',
		// "deferRender": true,
		"initComplete": function() {
			var columnInstansi = this.api().column(3);
			var columnBertemu = this.api().column(4);

			var valuesInstansi = [];
			columnInstansi.data().each(function(d, j) {
				d.split(",").forEach(function(data) {
					data = data.trim();
					if (valuesInstansi.indexOf(data) === -1) {
						valuesInstansi.push(data);
					}
				});
			});

			var valuesBertemu = [];
			columnBertemu.data().each(function(d, j) {
				d.split(",").forEach(function(data) {
					data = data.trim();
					if (valuesBertemu.indexOf(data) === -1) {
						valuesBertemu.push(data);
					}
				});
			});

			$('<select class="filter form-control"><option value="">Semua</option></select>')
				.append(valuesInstansi.sort().map(function(o) {
					return '<option value="' + o + '">' + o + '</option>';
				}))
				.on('change', function() {
					columnInstansi.search(this.value ? '\\b' + this.value + '\\b' : "", true, false).draw();
				})
				.appendTo('#FilterAsalInstansi');

			$('<select class="filter form-control"><option value="">Semua</option></select>')
				.append(valuesBertemu.sort().map(function(o) {
					return '<option value="' + o + '">' + o + '</option>';
				}))
				.on('change', function() {
					columnBertemu.search(this.value ? '\\b' + this.value + '\\b' : "", true, false).draw();
				})
				.appendTo('#FilterBertemu');
		}
	});
</script>