<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Siswa Menu || SDN 013 Tanjungpinang Barat</title>

	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">
				<i class="fa fa-edit"></i> Upload Berkas Persyaratan
			</h3>
		</div>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="card-body">

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Berkas Kartu Keluarga</label>
					<div class="col-sm-6">
						<input type="file" id="kk" name="kk">
						<p class="help-block">
							<font color="red">"Format file Jpg/Png"</font>
						</p>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Berkas Akta Lahir</label>
					<div class="col-sm-6">
						<input type="file" id="akta_lahir" name="akta_lahir">
						<p class="help-block">
							<font color="red">"Format file Jpg/Png"</font>
						</p>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Berkas Bukti Pendaftaran</label>
					<div class="col-sm-6">
						<input type="file" id="bukti_registrasi" name="bukti_registrasi">
						<p class="help-block">
							<font color="red">"Format file Jpg/Png"</font>
						</p>
					</div>
				</div>


			</div>
			<div class="card-footer">
				<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
				<a href="?page=data-berkas-berkas" title="Kembali" class="btn btn-secondary">Batal</a>
			</div>
		</form>
	</div>

	<?php
	// Pastikan sesi sudah aktif
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	// Periksa apakah pengguna sudah login
	if (isset($_SESSION['ses_id_login_siswa'])) {
		// Ambil ID login siswa dari sesi
		$id_login_siswa = $_SESSION['ses_id_login_siswa'];

		// Lakukan koneksi ke database dan pastikan koneksi disetel dengan benar
		$koneksi = mysqli_connect("localhost", "root", "", "ppdb_sd13");

		if (!$koneksi) {
			die("Koneksi ke database gagal: " . mysqli_connect_error());
		}

		// Ambil id_siswa dari database berdasarkan id_login_siswa yang sudah login
		$sql_get_id_siswa = "SELECT id_siswa FROM biodata_siswa WHERE id_login_siswa = $id_login_siswa";
		$query_get_id_siswa = mysqli_query($koneksi, $sql_get_id_siswa);

		if ($query_get_id_siswa) {
			$result = mysqli_fetch_assoc($query_get_id_siswa);
			$id_siswa = $result['id_siswa'];

			// Lakukan operasi upload berkas dan simpan ke database
			$sumber = @$_FILES['kk']['tmp_name'];
			$target = 'foto/';
			$nama_file = @$_FILES['kk']['name'];

			$akta_lahir_sumber = @$_FILES['akta_lahir']['tmp_name'];
			$bukti_registrasi_sumber = @$_FILES['bukti_registrasi']['tmp_name'];

			$akta_lahir_target = 'foto/'; // Ganti folder sesuai kebutuhan
			$bukti_registrasi_target = 'foto/'; // Ganti folder sesuai kebutuhan

			$akta_lahir_nama_file = @$_FILES['akta_lahir']['name'];
			$bukti_registrasi_nama_file = @$_FILES['bukti_registrasi']['name'];

			$pindah = move_uploaded_file($sumber, $target . $nama_file);
			$pindah_akta_lahir = move_uploaded_file($akta_lahir_sumber, $akta_lahir_target . $akta_lahir_nama_file);
			$pindah_bukti_registrasi = move_uploaded_file($bukti_registrasi_sumber, $bukti_registrasi_target . $bukti_registrasi_nama_file);

			if (!empty($sumber)) {
				$sql_simpan = "INSERT INTO berkas (kartu_keluarga, akta_lahir, bukti_registrasi, id_siswa) VALUES (
                 '" . $nama_file . "', '" . $akta_lahir_nama_file . "', '" . $bukti_registrasi_nama_file . "', " . $id_siswa . ")";
				$query_simpan = mysqli_query($koneksi, $sql_simpan);
				mysqli_close($koneksi);

				if ($query_simpan) {
					echo "<script>
                Swal.fire({title: 'Tambah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'data.php?page=data-berkas-berkas';
                    }
                })</script>";
				} else {
					echo "<script>
                Swal.fire({title: 'Tambah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'data.php?page=add-berkas';
                    }
                })</script>";
				}
			} else {
				echo "<script>
                Swal.fire({title: 'Gagal, Bukti Registrasi Wajib Diisi', text: '', icon: 'error', confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window location = 'data.php?page=add-berkas';
                    }
                })</script>";
			}
		}
	} else {
		// Tampilkan pesan atau alihkan ke halaman login jika pengguna belum login
		echo 'Anda harus login terlebih dahulu atau Anda tidak memiliki akses.';
		// Contoh alihkan ke halaman login:
		// header("Location: login.php");
	}
	?>