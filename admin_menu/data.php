<?php
//Mulai Sesion
session_start();
if (isset($_SESSION["ses_username"]) == "") {
	header("location: login.php");
} else {
	$data_id = $_SESSION["ses_id"];
	$data_nama = $_SESSION["ses_nama"];
	$data_user = $_SESSION["ses_username"];
	$data_level = $_SESSION["ses_level"];
}

//Koneksi Data Base
include "inc/koneksi.php";

$sql = $koneksi->query("SELECT * from tb_profil");
while ($data = $sql->fetch_assoc()) {

	$nama = $data['nama_profil'];
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin Menu || SDN 013 Tanjungpinang Barat</title>
	<link rel="icon" href="dist/img/logo.png">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<!-- Alert -->
	<script src="plugins/alert.js"></script>
</head>

<body class="hold-transition sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-blue navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#">
						<i class="fas fa-bars text-white"></i>
					</a>
				</li>
			</ul>

			<!-- SEARCH FORM -->
			<ul class="navbar-nav ml-auto">

				<li class="nav-item d-none d-sm-inline-block">
					<a href="#" class="nav-link">
						<font color="white">
							<b>
								ADMIN MENU
							</b>
						</font>
					</a>
				</li>
			</ul>

		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="data.php" class="brand-link text-center">
				<div style="display: flex; flex-direction: column; align-items: center; text-align: center;">
					<img src="dist/img/logo.png" alt="AdminLTE Logo" class="brand-image" style="width: 45px;">
					<span class="brand-text">SDN 013<br>Tanjungpinang Barat</span>
				</div>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user (optional) -->
				<div class="user-panel mt-2 pb-2 mb-2 d-flex">
					<div class="image">
						<img src="dist/img/user.png" class="img-circle elevation-1" alt="User Image">
					</div>
					<div class="info">
						<a href="index.php" class="d-block">
							<?php echo $data_nama; ?>
						</a>
						<span class="badge badge-success">
							<?php echo $data_level; ?>
						</span>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

						<!-- Level  -->
						<?php
						if ($data_level == "Administrator") {
						?>
							<li class="nav-item">
								<a href="data.php" class="nav-link">
									<i class="nav-icon fas fa-tachometer-alt"></i>
									<p>
										Dashboard
									</p>
								</a>
							</li>

							<li class="nav-item">
								<a href="?page=data-siswa" class="nav-link">
									<i class="nav-icon far fa fa-users"></i>
									<p>
										Data Siswa
									</p>
								</a>
							</li>

							<li class="nav-item">
								<a href="?page=data-guru" class="nav-link">
									<i class="nav-icon far fa fa-users"></i>
									<p>
										Data Guru
									</p>
								</a>
							</li>

							<li class="nav-item">
								<a href="?page=proses-verifikasi" class="nav-link">
									<i class="nav-icon far fa fa-user-clock"></i>
									<p>
										Status Verifikasi
									</p>
								</a>
							</li>

							<li class="nav-header">Setting</li>
							<li class="nav-item">
								<a href="?page=data-profil" class="nav-link">
									<i class="nav-icon far fa fa-flag"></i>
									<p>
										Profil Sekolah
									</p>
								</a>
							</li>

							<li class="nav-item">
								<a href="?page=data-pengguna" class="nav-link">
									<i class="nav-icon far fa-user"></i>
									<p>
										Pengguna Sistem
									</p>
								</a>
							</li>

						<?php
						} elseif ($data_level == "Sekretaris") {
						?>

							<li class="nav-item">
								<a href="data.php" class="nav-link">
									<i class="nav-icon fas fa-tachometer-alt"></i>
									<p>
										Dashboard
									</p>
								</a>
							</li>

							<li class="nav-item">
								<a href="?page=data-pegawai" class="nav-link">
									<i class="nav-icon far fa fa-users"></i>
									<p>
										Data Pegawai
									</p>
								</a>
							</li>

							<li class="nav-header">Setting</li>

						<?php
						} elseif ($data_level == "Pegawai") {
						?>

							<li class="nav-item">
								<a href="data.php" class="nav-link">
									<i class="nav-icon fas fa-tachometer-alt"></i>
									<p>
										Dashboard
									</p>
								</a>
							</li>

							<li class="nav-item">
								<a href="?page=data-kepegawaian" class="nav-link">
									<i class="nav-icon far fa fa-users"></i>
									<p>
										Data Pegawai
									</p>
								</a>
							</li>

							<li class="nav-header">Setting</li>

						<?php
						}
						?>

						<li class="nav-item">
							<a onclick="return confirm('Apakah anda yakin akan keluar ?')" href="logout.php" class="nav-link">
								<i class="nav-icon far fa-circle text-danger"></i>
								<p>
									Logout
								</p>
							</a>
						</li>

				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header"></section>
			<!-- Main content -->
			<section class="content">
				<!-- /. WEB DINAMIS -->
				<div class="container-fluid">

					<?php
					if (isset($_GET['page'])) {
						$hal = $_GET['page'];

						switch ($hal) {
								//Klik Halaman Home Pengguna
							case 'admin':
								include "home/admin.php";
								break;
							case 'sekretaris':
								include "home/sekretaris.php";
								break;
							case 'pegawai':
								include "home/pegawai.php";
								break;

								//Pengguna
							case 'data-pengguna':
								include "admin/pengguna/data_pengguna.php";
								break;
							case 'add-pengguna':
								include "admin/pengguna/add_pengguna.php";
								break;
							case 'edit-pengguna':
								include "admin/pengguna/edit_pengguna.php";
								break;
							case 'del-pengguna':
								include "admin/pengguna/del_pengguna.php";
								break;

								//Siswa
							case 'data-siswa':
								include "admin/siswa/data_siswa.php";
								break;
							case 'add-siswa':
								include "admin/siswa/add_siswa.php";
								break;
							case 'edit-siswa':
								include "admin/siswa/edit_siswa.php";
								break;
							case 'del-siswa':
								include "admin/siswa/del_siswa.php";
								break;
							case 'view-siswa':
								include "admin/siswa/view_siswa.php";
								break;
							case 'edit-ayah':
								include "admin/siswa/edit_ayah.php";
								break;
							case 'view-ayah':
								include "admin/siswa/view_ayah.php";
								break;
							case 'edit-ibu':
								include "admin/siswa/edit_ibu.php";
								break;
							case 'view-ibu':
								include "admin/siswa/view_ibu.php";
								break;

								//Guru
							case 'data-guru':
								include "admin/guru/data_guru.php";
								break;
							case 'add-guru':
								include "admin/guru/add_guru.php";
								break;
							case 'edit-guru':
								include "admin/guru/edit_guru.php";
								break;
							case 'del-guru':
								include "admin/guru/del_guru.php";
								break;
							case 'view-guru':
								include "admin/guru/view_guru.php";
								break;

								//biodata
							case 'biodata-ayah':
								include "admin/biodata/view_ayah.php";
								break;
							case 'biodata-ibu':
								include "admin/biodata/view_ibu.php";
								break;

								//verifikasi
							case 'data-verifikasi-belum':
								include "admin/verifikasi/data_verifikasi_belum_disetujui.php";
								break;
							case 'data-verifikasi-sudah':
								include "admin/verifikasi/data_verifikasi_sudah_disetujui.php";
								break;
							case 'data-verifikasi-tidak':
								include "admin/verifikasi/data_verifikasi_tidak_disetujui.php";
								break;
							case 'proses-verifikasi':
								include "admin/verifikasi/proses_verifikasi.php";
								break;
							case 'view-berkas-belum':
								include "admin/verifikasi/view_berkas_belum_disetujui.php";
								break;
							case 'view-berkas-sudah':
								include "admin/verifikasi/view_berkas_sudah_disetujui.php";
								break;
							case 'view-berkas-tidak':
								include "admin/verifikasi/view_berkas_tidak_disetujui.php";
								break;
							case 'hasil-verifikasi':
								include "admin/verifikasi/edit_verifikasi.php";
								break;
							case 'add-verifikasi':
								include "admin/verifikasi/add_verifikasi.php";
								break;


								//Profil
							case 'data-profil':
								include "admin/profil/data_profil.php";
								break;
							case 'edit-profil':
								include "admin/profil/edit_profil.php";
								break;

								//default
							default:
								echo "<center><h1> 404 not Found ! <br> The Website is Under Construction <br> MAINTENANCE in 1 Week <br> <br> See You... </h1></center>";
								break;
						}
					} else {
						//Halaman Home Pengguna
						if ($data_level == "Administrator") {
							include "home/admin.php";
						} elseif ($data_level == "Guru") {
							include "home/guru.php";
						}
					}
					?>
				</div>
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<footer class="main-footer">
			<div class="float-right d-none d-sm-block">
				&copy;
				<a target="_blank" href="https://sekolah.data.kemdikbud.go.id/index.php/chome/profil/c0e217bd-31f5-e011-91fa-abd7b1b23b22">
					<strong>Sistem Informasi || SDN 013 Tanjungpinang Barat</strong>
				</a>
			</div>
			<b>Project Mamang UI 2023</b>
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<script src="plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Select2 -->
	<script src="plugins/select2/js/select2.full.min.js"></script>
	<!-- DataTables -->
	<script src="plugins/datatables/jquery.dataTables.js"></script>
	<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="dist/js/demo.js"></script>
	<!-- page script -->
	<script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

	<script>
		$(function() {
			$("#example1").DataTable();
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
			});
		});
	</script>

	<script>
		$(function() {
			//Initialize Select2 Elements
			$('.select2').select2()

			//Initialize Select2 Elements
			$('.select2bs4').select2({
				theme: 'bootstrap4'
			})
		})
	</script>

</body>

</html>