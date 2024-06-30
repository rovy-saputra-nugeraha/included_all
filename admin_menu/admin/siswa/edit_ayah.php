<?php
if (isset($_GET['kode'])) {
	$sql_cek = "SELECT biodata_siswa.*, biodata_ayah.*
        FROM biodata_siswa
        INNER JOIN biodata_ayah ON biodata_siswa.id_siswa = biodata_ayah.id_siswa WHERE id_ayah='" . $_GET['kode'] . "'";
	$query_cek = mysqli_query($koneksi, $sql_cek);

	if ($query_cek && $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH)) {
		$id_siswa = $data_cek['id_siswa'];
?>
		<div class="card card-success">
			<div class="card-header">
				<h3 class="card-title">
					<i class="fa fa-edit"></i>Ubah Data Ayah - <span style="color: white;"><?php echo $data_cek['nama_siswa']; ?></span>
				</h3>
			</div>
			<form action="" method="post" enctype="multipart/form-data">
				<div class="card-body">
					<!-- Formulir -->
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Nama Ayah</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="<?php echo $data_cek['nama_ayah']; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Tempat Lahir</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="tempat_lahir_ayah" name="tempat_lahir_ayah" value="<?php echo $data_cek['tempat_lahir_ayah']; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Tanggal Lahir</label>
						<div class="col-sm-5">
							<input type="date" class="form-control" id="tgl_lahir_ayah" name="tgl_lahir_ayah" value="<?php echo $data_cek['tgl_lahir_ayah']; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Alamat</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="alamat_ayah" name="alamat_ayah" value="<?php echo $data_cek['alamat_ayah']; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">No Hp</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="no_hp_ayah" name="no_hp_ayah" value="<?php echo $data_cek['no_hp_ayah']; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Pekerjaan Ayah</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" value="<?php echo $data_cek['pekerjaan_ayah']; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Penghasilan Ayah</label>
						<div class="col-sm-4">
							<select name="penghasilan_ayah" id="penghasilan_ayah" class="form-control">
								<option value="">-- Pilih --</option>
								<?php
								//cek data yg dipilih sebelumnya
								if ($data_cek['penghasilan_ayah'] == "< Rp. 500.000") echo "<option value='< Rp. 500.000' selected>< Rp. 500.000</option>";
								else echo "<option value='< Rp. 500.000'>< Rp. 500.000</option>";

								if ($data_cek['penghasilan_ayah'] == "Rp. 500.000-Rp. 999.000") echo "<option value='Rp. 500.000-Rp. 999.000' selected>Rp. 500.000-Rp. 999.000</option>";
								else echo "<option value='Rp. 500.000-Rp. 999.000'>Rp. 500.000-Rp. 999.000</option>";

								if ($data_cek['penghasilan_ayah'] == "Rp. 1.000.000-Rp. 1.999.999") echo "<option value='Rp. 1.000.000-Rp. 1.999.999' selected>Rp. 1.000.000-Rp. 1.999.999</option>";
								else echo "<option value='Rp. 1.000.000-Rp. 1.999.999'>Rp. 1.000.000-Rp. 1.999.999</option>";

								if ($data_cek['penghasilan_ayah'] == "Rp. 2.000.000-Rp. 4.999.999") echo "<option value='Rp. 2.000.000-Rp. 4.999.999' selected>Rp. 2.000.000-Rp. 4.999.999</option>";
								else echo "<option value='Rp. 2.000.000-Rp. 4.999.999'>Rp. 2.000.000-Rp. 4.999.999</option>";

								if ($data_cek['penghasilan_ayah'] == "Rp. 5.000.000-Rp. 20.000.000") echo "<option value='Rp. 5.000.000-Rp. 20.000.000' selected>Rp. 5.000.000-Rp. 20.000.000</option>";
								else echo "<option value='Rp. 5.000.000-Rp. 20.000.000'>Rp. 5.000.000-Rp. 20.000.000</option>";

								if ($data_cek['penghasilan_ayah'] == "> Rp. 20.000.000") echo "<option value='> Rp. 20.000.000' selected>> Rp. 20.000.000</option>";
								else echo "<option value='> Rp. 20.000.000'>> Rp. 20.000.000</option>";

								if ($data_cek['penghasilan_ayah'] == "Tidak Berpenghasilan") echo "<option value='Tidak Berpenghasilan' selected>Tidak Berpenghasilan</option>";
								else echo "<option value='Tidak Berpenghasilan'>Tidak Berpenghasilan</option>";
								?>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Pendidikan Terakhir</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="pend_terakhir_ayah" name="pend_terakhir_ayah" value="<?php echo $data_cek['pend_terakhir_ayah']; ?>" />
						</div>
					</div>
				</div>

				<div align="center" class="card-footer">
					<input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
					<a href="?page=data-siswa" title="Kembali" class="btn btn-secondary">Batal</a>
				</div>
			</form>
		</div>
<?php
		if (isset($_POST['Ubah'])) {
			// Perbarui data ayah berdasarkan id_login_siswa
			$nama_ayah = mysqli_real_escape_string($koneksi, $_POST['nama_ayah']);
			$alamat_ayah = mysqli_real_escape_string($koneksi, $_POST['alamat_ayah']);
			$tgl_lahir_ayah = $_POST['tgl_lahir_ayah'];
			$tempat_lahir_ayah = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir_ayah']);
			$no_hp_ayah = $_POST['no_hp_ayah'];
			$pekerjaan_ayah = $_POST['pekerjaan_ayah'];
			$penghasilan_ayah = mysqli_real_escape_string($koneksi, $_POST['penghasilan_ayah']);
			$pend_terakhir_ayah = $_POST['pend_terakhir_ayah'];

			$sql_ubah = "UPDATE biodata_ayah SET
										nama_ayah='$nama_ayah',
										alamat_ayah='$alamat_ayah',
										tgl_lahir_ayah='$tgl_lahir_ayah',
										tempat_lahir_ayah='$tempat_lahir_ayah',
										no_hp_ayah='$no_hp_ayah',
										pekerjaan_ayah='$pekerjaan_ayah',
										penghasilan_ayah='$penghasilan_ayah',
										pend_terakhir_ayah='$pend_terakhir_ayah'
								WHERE id_siswa='$id_siswa'";

			$query_ubah = mysqli_query($koneksi, $sql_ubah);

			if ($query_ubah) {
				echo "<script>
                Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'data.php?page=data-ayah';
                    }
                })</script>";
			} else {
				echo "<script>
                Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'data.php?page=data-ayah';
                    }
                })</script>";
			}
		}
	} else {
		echo '<div class="row text-center">';
		echo '<div align="center" class="col-md-8 mx-auto">';
		echo '<div class="card card-info">';
		echo '<div class="card-header">';
		echo '<h3 class="card-title">Ubah Data Ayah</h3>';
		echo '<div class="card-tools"></div>';
		echo '</div>';
		echo '<div class="card-body">';
		echo '<p>Data Ayah Tidak ditemukan. Silakan kembali ke halaman sebelumnya.</p>';
		echo '</div>';
		echo '<div class="card-footer">';
		echo '<a href="?page=data-siswa" class="btn btn-warning">Kembali</a>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}
}
?>