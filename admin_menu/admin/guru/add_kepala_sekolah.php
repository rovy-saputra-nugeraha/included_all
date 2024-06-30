<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Menu || SDN 013 Tanjungpinang Barat</title>

	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">
				<i class="fa fa-edit"></i> Tambah Data
			</h3>
		</div>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="card-body">

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">NIP</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="nip_kepsek" name="nip_kepsek" placeholder="Masukkan NIP Kepala Sekolah" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Nama Kepala Sekolah</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="nama_kepsek" name="nama_kepsek" placeholder="Masukkan Nama Kepala Sekolah" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Alamat</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="alamat_kepsek" name="alamat_kepsek" placeholder="Masukkan Alamat Domisili Kepala Sekolah" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Kata Pengantar</label>
					<div class="col-sm-10">
					<textarea class="form-control" name="kata_pengantar" rows="8" autocomplete="off" placeholder="Input - jika tidak ada kata pengantar" required></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Foto Kepala Sekolah</label>
					<div class="col-sm-6">
						<input type="file" id="foto_kepsek" name="foto_kepsek">
						<p class="help-block">
							<font color="red">"Format file Jpg/Png"</font>
						</p>
					</div>
				</div>

			</div>
			<div class="card-footer">
				<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
				<a href="?page=data-kepala-sekolah" title="Kembali" class="btn btn-secondary">Batal</a>
			</div>
		</form>
	</div>

	<?php

	if (isset($_POST['Simpan'])) {
		$sumber = @$_FILES['foto_kepsek']['tmp_name'];
		$target = 'foto/kepala_sekolah/';
		$nama_file = @$_FILES['foto_kepsek']['name'];
		$pindah = move_uploaded_file($sumber, $target . $nama_file);
		if (!empty($sumber)) {
			$sql_simpan = "INSERT INTO data_kepala_sekolah (nip_kepsek, nama_kepsek, alamat_kepsek, kata_pengantar, foto_kepsek) VALUES (
            '" . $_POST['nip_kepsek'] . "',
						'" . $_POST['nama_kepsek'] . "',
						'" . $_POST['alamat_kepsek'] . "',
						'" . $_POST['kata_pengantar'] . "',
            '" . $nama_file . "')";
			$query_simpan = mysqli_query($koneksi, $sql_simpan);
			mysqli_close($koneksi);

			if ($query_simpan) {
				echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'data.php?page=data-kepala-sekolah';
          }
      })</script>";
			} else {
				echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'data.php?page=add-kepala-sekolah';
          }
      })</script>";
			}
		} elseif (empty($sumber)) {
			echo "<script>
		Swal.fire({title: 'Gagal, Foto Wajib Diisi',text: '',icon: 'error',confirmButtonText: 'OK'
		}).then((result) => {
			if (result.value) {
				window.location = 'data.php?page=add-kepala-sekolah';
			}
		})</script>";
		}
	}
	//selesai proses simpan data
	?>