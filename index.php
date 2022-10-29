<?php

session_start();
setlocale(LC_TIME, 'id_ID');

include "function.php";

// cek session
if (empty($_SESSION["login-etamu-app-kejari"])) {
  header("Location: login.php");
  exit;
} else {
  $id_user = $_SESSION['id_user'];

  $data_user = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_user='$id_user' ");
  if ($row = mysqli_fetch_assoc($data_user)) {
    $username = $row['username'];
    $foto_user = $row['foto'];
    $level = $row['level'];
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>E-TAMU | KEJAKSAAN NEGERI DAIRI</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="E-TAMU" name="keywords">
  <meta content="E-TAMU | KEJAKSAAN NEGERI DAIRI" name="description">
  <meta content="Ronaldo Pei Piro" name="author">
  <link href="img/kejari.png" rel="icon">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400&display=swap" rel="stylesheet">
  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/datatables/jquery.dataTables.min.css" rel="stylesheet">
  <link href="lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="lib/js_select_2/select2.min.css" rel="stylesheet">
  <link href="lib/sweet_alert/sweetalert.css" rel="stylesheet">
  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">

  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/datatables/jquery.dataTables.min.js"></script>
  <script src="lib/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/counterup/counterup.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/js_select_2/select2.min.js"></script>
  <script src="lib/sweet_alert/sweetalert.min.js"></script>

</head>

<body>
  <header id="header">
    <div class="container-fluid">
      <div id="logo" class="pull-left d-flex">
        <a href="./" class="row">
          <img src="img/kejari.png" class="ml-3" style="height: 40px;">
          <p class="text-uppercase ml-3 mt-3">E-TAMU KEJARI DAIRI</p>
        </a>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li <?= (!isset($_GET['p'])) ? ' class="menu-active" ' : ''; ?>><a href="./">DASHBOARD</a></li>
          <?php if ($level != "pegawai") : ?>
            <li <?= ((isset($_GET['p'])) and ($_GET['p'] == "data_tamu")) ? ' class="menu-active" ' : ''; ?>>
              <a href="index.php?p=data_tamu">DATA TAMU</a>
            </li>
          <?php endif; ?>
          <!-- <li <?= ((isset($_GET['p'])) and ($_GET['p'] == "pengaturan_akun")) ? ' class="menu-active" ' : ''; ?>>
            <a href="index.php?p=pengaturan_akun">PENGATURAN</a>
          </li> -->
          <li class="text-white ml-4 d-flex">
            <a href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar ?')">
              KELUAR
              <i class="fa fa-sign-out"></i>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </header><!-- #header -->

  <main id="main" style="min-height: 100vh;">
    <?php include 'content.php'; ?>
    <footer id="footer" class="text-center">
      COPYRIGHT &copy; <?= date('Y'); ?> | KEJAKSAAN NEGERI DAIRI
    </footer><!-- #footer -->
  </main>

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <script src="js/main.js"></script>

  <script language="Javascript">
    $(document).ready(function() {

      $(".show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if ($('.show_hide_password input').attr("type") == "text") {
          $('.show_hide_password input').attr('type', 'password');
          $('.show_hide_password i').addClass("fa-eye-slash");
          $('.show_hide_password i').removeClass("fa-eye");
        } else if ($('.show_hide_password input').attr("type") == "password") {
          $('.show_hide_password input').attr('type', 'text');
          $('.show_hide_password i').removeClass("fa-eye-slash");
          $('.show_hide_password i').addClass("fa-eye");
        }
      });

      $(".show_hide_password2 a").on('click', function(event) {
        event.preventDefault();
        if ($('.show_hide_password2 input').attr("type") == "text") {
          $('.show_hide_password2 input').attr('type', 'password');
          $('.show_hide_password2 i').addClass("fa-eye-slash");
          $('.show_hide_password2 i').removeClass("fa-eye");
        } else if ($('.show_hide_password2 input').attr("type") == "password") {
          $('.show_hide_password2 input').attr('type', 'text');
          $('.show_hide_password2 i').removeClass("fa-eye-slash");
          $('.show_hide_password2 i').addClass("fa-eye");
        }
      });

      $(".show_hide_password3 a").on('click', function(event) {
        event.preventDefault();
        if ($('.show_hide_password3 input').attr("type") == "text") {
          $('.show_hide_password3 input').attr('type', 'password');
          $('.show_hide_password3 i').addClass("fa-eye-slash");
          $('.show_hide_password3 i').removeClass("fa-eye");
        } else if ($('.show_hide_password3 input').attr("type") == "password") {
          $('.show_hide_password3 input').attr('type', 'text');
          $('.show_hide_password3 i').removeClass("fa-eye-slash");
          $('.show_hide_password3 i').addClass("fa-eye");
        }
      });

      $('.js-select-2').select2();

    });
  </script>

</body>

</html>