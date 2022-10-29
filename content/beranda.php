<?php

if (isset($_POST["tambah_data_tamu"])) {
    if (tambah_data_tamu($_POST) > 0) {
        echo "<script>
                    setTimeout(function() {
                        swal({
                            title: 'Berhasil !',
                            text: 'Data berhasil ditambahkan !',
                            type: 'success',
                            showConfirmButton: false,
                            timer: 100
                        }, function() {
                            window.location ='./';
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
                                text: 'Data gagal ditambahkan !',
                                type: 'warning',
                                 showConfirmButton: false,
                                timer: 100
                            }, function() {
                                window.location ='./';
                            });
                        }, 300);
                    </script>
            ";
    }
}

?>

<section id="about">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <div class="row justify-content-between">
                            <div class="col-6 pt-3">
                                <h5>INPUT DATA TAMU</h5>
                            </div>
                            <div class="col-6 text-right pt-2">
                                <div>
                                    <?php
                                    $satu_hari  = mktime(0, 0, 0, date("n"), date("j"), date("Y"));
                                    echo "<b>" . tglIndonesia(date('D, d F Y', $satu_hari)) . "</b>";
                                    ?>
                                </div>
                                <div id="clock" style="color: #fff; font-weight: 600;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama lengkap ..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                            <option value="">--- Pilih Jenis Kelamin ---</option>
                                            <option value="Pria">Pria</option>
                                            <option value="Wanita">Wanita</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea name="alamat" id="alamat" rows="3" class="form-control" placeholder="Masukkan alamat ..." required></textarea>
                                    </div>
                                    <div class=" form-group">
                                        <label for="no_hp">No. Handphone</label>
                                        <input type="text" name="no_hp" id="no_hp" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="08XX XXXX ...." required>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="asal_instansi">Asal Instansi</label>
                                        <input type="text" name="asal_instansi" id="asal_instansi" placeholder="Masukkan asal instansi ..." class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="keperluan">Keperluan</label>
                                        <textarea name="keperluan" id="keperluan" rows="7" class="form-control" placeholder="Masukkan keperluan tamu disini ...." required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="bertemu">Bertemu</label>
                                        <select name="bertemu" id="bertemu" class="form-control js-select-2" style="width: 100%;">
                                            <option value="">--- Pilih Pegawai ---</option>
                                            <?php $data_pegawai  = mysqli_query($conn, "SELECT tb_pegawai.*, tb_unit_kerja.*, tb_pegawai.id as id_pegawai FROM tb_pegawai JOIN tb_unit_kerja ON tb_pegawai.id_u_kerja = tb_unit_kerja.id ORDER BY tb_unit_kerja.id ASC "); ?>
                                            <?php while ($row = mysqli_fetch_assoc($data_pegawai)) : ?>
                                                <option value="<?= $row['nama_peg']; ?> -- <?= $row['u_kerja']; ?>">
                                                    <span style="font-weight: bold;"><?= $row['nama_peg']; ?></span> ( <?= $row['u_kerja']; ?>)
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <p>Ambil Foto</p>
                                    <div id="camera">Capture</div>
                                    <div id="webcam" style="margin-top: 20px;">
                                        <input type="button" value="Ambil Gambar" class="btn btn-sm btn-success" onClick="preview()">
                                    </div>
                                    <div id="simpan" style="display:none; margin-top: 20px;">
                                        <input type="button" value="Batal" class="btn btn-sm btn-danger" style="width: 120px; margin-right: 10px;" onClick="batal()">
                                        <input type="submit" name="tambah_data_tamu" class="btn btn-sm btn-success" style="width: 120px;" value="Simpan" onClick="simpan()">
                                        <input type="hidden" name="webcam" class="image-tag">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="lib/webcam/webcam.js"></script>
<script>
    // konfigursi webcam
    Webcam.set({
        width: 420,
        height: 250,
        image_format: 'jpg',
        jpeg_quality: 100
    });
    Webcam.attach('#camera');

    function preview() {
        // untuk preview gambar sebelum di upload
        Webcam.freeze();
        // ganti display webcam menjadi none dan simpan menjadi terlihat
        document.getElementById('webcam').style.display = 'none';
        document.getElementById('simpan').style.display = '';
    }

    function batal() {
        // batal preview
        Webcam.unfreeze();

        // ganti display webcam dan simpan seperti semula
        document.getElementById('webcam').style.display = '';
        document.getElementById('simpan').style.display = 'none';
    }

    function simpan() {
        // ambil foto
        Webcam.snap(function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('hasil').innerHTML = '<img src="' + data_uri + '"/>';

            Webcam.unfreeze();

            document.getElementById('webcam').style.display = '';
            document.getElementById('simpan').style.display = 'none';
        });
    }
</script>

<script language="Javascript">
    var jam = <?= date('H'); ?>;
    var menit = <?= date('i'); ?>;
    var detik = <?= date('s'); ?>;

    function clock() {
        if (detik != 0 && detik % 60 == 0) {
            menit++;
            detik = 0;
        }
        second = detik;

        if (menit != 0 && menit % 60 == 0) {
            jam++;
            menit = 0;
        }
        minute = menit;

        if (jam != 0 && jam % 24 == 0) {
            jam = 0;
        }
        hour = jam;

        if (detik < 10) {
            second = '0' + detik;
        }
        if (menit < 10) {
            minute = '0' + menit;
        }
        if (jam < 10) {
            hour = '0' + jam;
        }
        zona_waktu = " WIB";
        waktu = hour + ':' + minute + ':' + second + zona_waktu;
        document.getElementById("clock").innerHTML = waktu;
        detik++;
    }
    setInterval(clock, 1000);
</script>