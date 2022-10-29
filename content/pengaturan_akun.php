<?php

if (isset($_POST["ubah_password_user"])) {
	if (ubah_password_user($_POST) > 0) {
		echo "
                    <script>
                        setTimeout(function() {
                            swal({
                                title: 'Berhasil !',
                                text: 'Data berhasil diubah !',
                                type: 'success',
                                showConfirmButton: false,
                                timer: 300
                            }, function() {
                                window.location ='./index.php?p=pengaturan_akun';
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
                                text: 'Gagal mengubah data !',
								type: 'warning',
								showConfirmButton: false,
                                timer: 300
                            }, function() {
                                window.location ='./index.php?p=pengaturan_akun';
                            });
                        }, 300);
                    </script>
            ";
	}
}

?>

<div class="container-fluid" style="padding-top: 80px;">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Pengaturan
				</div>
				<div class="card-body">
					<div class="row justify-content-center">

						<div class="col-lg-4 border pt-4">
							<p class="font-weight-bold">Ubah Password</p>
							<hr style="height: 2px; background: #ddd; margin-top: -15px;">
							<form action="" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="id_user" value="<?= $id_user; ?>">

								<div class="form-group show_hide_password">
									<label for="password_lama">Password Lama</label>
									<div class="input-group">
										<input type="password" name="password_lama" id="password_lama" class="form-control" placeholder="Masukkan password lama ..." required>
										<div class="input-group-addon">
											<div class="btn btn-info">
												<i class="fa fa-eye-slash" aria-hidden="true"></i>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group show_hide_password2">
									<label for="password_baru">Password Baru</label>
									<div class="input-group">
										<input type="password" name="password_baru" class="form-control" placeholder="Masukkan password baru ..." required>
										<div class="input-group-addon">
											<div class="btn btn-info">
												<i class="fa fa-eye-slash" aria-hidden="true"></i>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group show_hide_password3">
									<label for="konfirmasi_password">Konfirmasi Password</label>
									<div class="input-group">
										<input type="password" name="konfirmasi_password" class="form-control" placeholder="Masukkan ulang password baru ..." required>
										<div class="input-group-addon">
											<div class="btn btn-info">
												<i class="fa fa-eye-slash" aria-hidden="true"></i>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group mt-4">
									<button class="btn btn-success btn-block" type="submit" name="ubah_password_user">
										<i class="fa fa-save"></i> SIMPAN
									</button>
								</div>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>