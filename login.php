<?php
session_start();
require "function.php";

// cek session
if (isset($_SESSION["login-etamu-app-kejari"])) {
	header("Location: index.php");
	exit;
}

if (isset($_POST["login"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username='$username' ");

	if (mysqli_num_rows($result) === 1) {
		$row = mysqli_fetch_assoc($result);
		if (password_verify($password, $row["password"])) {
			$_SESSION['id_user'] = $row["id_user"];
			$_SESSION['level'] = $row["level"];

			$_SESSION['login-etamu-app-kejari'] = true;

			header("Location: index.php ");
			exit;
		}
	}
	echo "<script>
			setTimeout(function() {
				swal({
					title: 'Login Gagal !',
					text: 'Username / Password Salah !',
					type: 'warning',
					showConfirmButton: false,
					timer: 200
				}, function() {
					window.location = 'login.php';
				});
			}, 300);
		</script>";
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

	<main id="main">
		<div class="container-fluid" style="background: url('img/bg-login.jpg'); background-repeat: no-repeat; background-size: cover; width: 100%; min-height: 100vh;">
			<div class="row justify-content-center d-flex align-items-center" style="min-height: 100vh;">
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="card border-0">
						<div class="card-header text-center text-white font-weight-bold" style="background: #0083ff;">
							LOGIN APLIKASI E-TAMU <br>
							<img src="img/kejari.png" style="height: 80px; margin: 10px 0;"> <br>
							<span>KEJAKSAAN NEGERI DAIRI</span>
						</div>
						<div class="card-body">
							<form action="" method="post">
								<div class="form-group">
									<label for="username">Username</label>
									<input type="text" name="username" id="username" required class="form-control" placeholder="Masukkan username ...." autofocus>
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" name="password" id="password" required class="form-control" placeholder="Masukkan password ....">
									<input type="checkbox" class="mt-2" onclick="myFunction()">
									<span style="font-size: 12px;">Tampilkan Password</span>
								</div>
								<div class="form-group">
									<button type="submit" name="login" class="btn btn-sm btn-success btn-block mt-4">
										<i class="fa fa-save"></i> Masuk
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<footer id="footer" class="text-center">
			COPYRIGHT &copy; <?= date('Y'); ?> | KEJAKSAAN NEGERI DAIRI
		</footer>
		<!-- #footer -->
	</main>

	<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

	<script src="js/main.js"></script>

	<script>
		function myFunction() {
			var x = document.getElementById("password");
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		}
	</script>

</body>

</html>