<?php

include 'database.php';
setlocale(LC_TIME, 'id_ID');
date_default_timezone_set('Asia/Jakarta');

function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function rupiah($angka)
{
  $hasil_rupiah = "Rp. " . number_format($angka, 2, ',', '.');
  return $hasil_rupiah;
}

function tglIndonesia($str)
{
  $tr   = trim($str);
  $str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
  return $str;
}

function tambah_data_tamu()
{
  global $conn;

  $tanggal = date('d/m/Y');
  $waktu = date("H:i:s");

  $nama = $_POST['nama'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $alamat = $_POST['alamat'];
  $no_hp = $_POST['no_hp'];
  $asal_instansi = $_POST['asal_instansi'];
  $keperluan = $_POST['keperluan'];
  $bertemu = $_POST['bertemu'];

  $img = $_POST['webcam'];
  $folderPath = "upload/";

  $image_parts = explode(";base64,", $img);
  $image_type_aux = explode("image/", $image_parts[0]);
  $image_type = $image_type_aux[1];
  $image_base64 = base64_decode($image_parts[1]);
  $foto = uniqid() . '.png';
  $file = $folderPath . $foto;
  file_put_contents($file, $image_base64);

  mysqli_query($conn, "INSERT INTO tb_tamu (tanggal, waktu, nama, jenis_kelamin, alamat, no_hp, asal_instansi, keperluan, bertemu, foto) VALUES ('$tanggal', '$waktu', '$nama', '$jenis_kelamin', '$alamat', '$no_hp', '$asal_instansi', '$keperluan', '$bertemu', '$foto')");
  return mysqli_affected_rows($conn);
}

function hapus_data_tamu()
{
  global $conn;

  $id_tamu = $_POST['id_tamu'];

  $data_tamu = mysqli_query($conn, "SELECT * FROM tb_tamu WHERE id_tamu='$id_tamu' ");
  if ($row = mysqli_fetch_assoc($data_tamu)) {
    $foto = $row["foto"];
    unlink("upload/" . $foto);

    mysqli_query($conn, "DELETE FROM tb_tamu WHERE id_tamu='$id_tamu' ");
  }

  return mysqli_affected_rows($conn);
}


// Pengaturan Akun
function ubah_username()
{
  global $conn;

  $id_user = $_POST['id_user'];
  $username = htmlspecialchars($_POST['username']);

  mysqli_query($conn, "UPDATE tb_user SET username='$username' WHERE id_user='$id_user' ");
  return mysqli_affected_rows($conn);
}

function ubah_password_user()
{
  global $conn;

  $id_user = $_POST['id_user'];
  $password_lama = $_POST['password_lama'];
  $password_baru = $_POST['password_baru'];
  $konfirmasi_password = $_POST['konfirmasi_password'];

  $data_user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE id_user='$id_user' "));

  if (mysqli_num_rows($data_user) === 1) {
    if (password_verify($password_lama, $data_user["password"])) {
      if ($password_baru != $konfirmasi_password) {
        echo "<script>
              alert('Password baru tidak sesuai dengan konfirmasi !')
            </script>
            ";
        return false;
      } else {
        $password_baru_hash = password_hash($password_baru, PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE tb_user SET password='$password_baru_hash' WHERE id_user='$id_user' ");
        return mysqli_affected_rows($conn);
      }
    } else {
      echo "<script>
              alert('Password lama yang anda masukkan salah !')
            </script>
            ";
      return false;
    }
  }
}
// Akhir Pengaturan Akun