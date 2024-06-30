<?php
if (isset($_GET['kode'])) {
    $id_siswa = mysqli_real_escape_string($koneksi, $_GET['kode']); // Ambil id siswa dari parameter URL
    $sql_cek = "SELECT login_siswa.nik, biodata_siswa.* FROM login_siswa
		LEFT JOIN biodata_siswa ON login_siswa.id_login_siswa = biodata_siswa.id_login_siswa
		WHERE biodata_siswa.id_siswa='" . $id_siswa . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_assoc($query_cek); // Menggunakan mysqli_fetch_assoc untuk array asosiatif
}
?>

<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Ubah Data Siswa
        </h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <!-- Bidang input untuk data siswa -->
            <div class="form-group row">
				<label class="col-sm-2 col-form-label">NIK</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="nik_siswa" name="nik_siswa" value="<?php echo $data_cek['nik']; ?>" readonly />
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Siswa</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?php echo $data_cek['nama_siswa']; ?>" />
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Tempat Lahir</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="tempat_lahir_siswa" name="tempat_lahir_siswa" value="<?php echo $data_cek['tempat_lahir_siswa']; ?>" />
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Tanggal Lahir</label>
				<div class="col-sm-5">
					<input type="date" class="form-control" id="tgl_lahir_siswa" name="tgl_lahir_siswa" value="<?php echo $data_cek['tgl_lahir_siswa']; ?>" />
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Alamat</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="alamat_siswa" name="alamat_siswa" value="<?php echo $data_cek['alamat_siswa']; ?>" />
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Jenis Kelamin</label>
				<div class="col-sm-4">
					<select name="jk_siswa" id="jk_siswa" class="form-control">
						<option value="">-- Pilih --</option>
						<?php
						//cek data yg dipilih sebelumnya
						if ($data_cek['jk_siswa'] == "Laki-Laki") echo "<option value='Laki-Laki' selected>Laki-Laki</option>";
						else echo "<option value='Laki-Laki'>Laki-Laki</option>";

						if ($data_cek['jk_siswa'] == "Perempuan") echo "<option value='Perempuan' selected>Perempuan</option>";
						else echo "<option value='Perempuan'>Perempuan</option>";
						?>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Agama</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="agama_siswa" name="agama_siswa" value="<?php echo $data_cek['agama_siswa']; ?>" />
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Tinggi Badan</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="tb_siswa" name="tb_siswa" value="<?php echo $data_cek['tb_siswa']; ?>" />
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Berat Badan</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="bb_siswa" name="bb_siswa" value="<?php echo $data_cek['bb_siswa']; ?>" />
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Size Pakaian</label>
				<div class="col-sm-4">
					<select name="size_pakaian" id="size_pakaian" class="form-control">
						<option value="">-- Pilih --</option>
						<?php
						//cek data yg dipilih sebelumnya
						if ($data_cek['size_pakaian'] == "S") echo "<option value='S' selected>S</option>";
						else echo "<option value='S'>S</option>";

						if ($data_cek['size_pakaian'] == "M") echo "<option value='M' selected>M</option>";
						else echo "<option value='M'>M</option>";

						if ($data_cek['size_pakaian'] == "L") echo "<option value='L' selected>L</option>";
						else echo "<option value='L'>L</option>";

						if ($data_cek['size_pakaian'] == "XL") echo "<option value='XL' selected>XL</option>";
						else echo "<option value='XL'>XL</option>";

						if ($data_cek['size_pakaian'] == "XXL") echo "<option value='XXL' selected>XXL</option>";
						else echo "<option value='XXL'>XXL</option>";
						?>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Anak Ke-</label>
				<div class="col-sm-1">
					<input type="number" class="form-control" id="anak_ke" name="anak_ke" value="<?php echo $data_cek['anak_ke']; ?>" />
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Jumlah Saudara</label>
				<div class="col-sm-1">
					<input type="number" class="form-control" id="jumlah_saudara" name="jumlah_saudara" value="<?php echo $data_cek['jumlah_saudara']; ?>" />
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Status</label>
				<div class="col-sm-4">
					<select name="status_keluarga" id="status_keluarga" class="form-control">
						<option value="">-- Pilih --</option>
						<?php
						//cek data yg dipilih sebelumnya
						if ($data_cek['status_keluarga'] == "Anak Kandung") echo "<option value='Anak Kandung' selected>Anak Kandung</option>";
						else echo "<option value='Anak Kandung'>Anak Kandung</option>";

						if ($data_cek['status_keluarga'] == "Anak Angkat") echo "<option value='Anak Angkat' selected>Anak Angkat</option>";
						else echo "<option value='Anak Angkat'>Anak Angkat</option>";

						if ($data_cek['status_keluarga'] == "Lainnya") echo "<option value='Lainnya' selected>Lainnya</option>";
						else echo "<option value='Lainnya'>Lainnya</option>";
						?>
					</select>
				</div>
			</div>

        </div>
        <div class="card-footer">
            <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
            <a href="?page=data-siswa" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
if (isset($_POST['Ubah'])) {
    // Mengambil data dari formulir
    $nama_siswa = mysqli_real_escape_string($koneksi, $_POST['nama_siswa']);
    $alamat_siswa = mysqli_real_escape_string($koneksi, $_POST['alamat_siswa']);
    $tgl_lahir_siswa = $_POST['tgl_lahir_siswa'];
    $status_keluarga = $_POST['status_keluarga'];
    $tempat_lahir_siswa = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir_siswa']);
    $jk_siswa = $_POST['jk_siswa'];
    $tb_siswa = mysqli_real_escape_string($koneksi, $_POST['tb_siswa']);
	$bb_siswa = mysqli_real_escape_string($koneksi, $_POST['bb_siswa']);
	$size_pakaian = mysqli_real_escape_string($koneksi, $_POST['size_pakaian']);
	$agama_siswa = mysqli_real_escape_string($koneksi, $_POST['agama_siswa']);
    $anak_ke = $_POST['anak_ke'];
    $jumlah_saudara = $_POST['jumlah_saudara'];

    // Memperbarui data siswa
    $sql_ubah = "UPDATE biodata_siswa SET
        nama_siswa='$nama_siswa',
        alamat_siswa='$alamat_siswa',
        tgl_lahir_siswa='$tgl_lahir_siswa',
        status_keluarga='$status_keluarga',
        tempat_lahir_siswa='$tempat_lahir_siswa',
        jk_siswa='$jk_siswa',
        agama_siswa='$agama_siswa',
		tb_siswa='$tb_siswa',
		bb_siswa='$bb_siswa',
		size_pakaian='$size_pakaian',
        anak_ke='$anak_ke',
        jumlah_saudara='$jumlah_saudara'
        WHERE id_siswa='$id_siswa'";

    $query_ubah = mysqli_query($koneksi, $sql_ubah);

    if ($query_ubah) {
        echo "<script>
            Swal.fire({
                title: 'Ubah Data Berhasil',
                text: '',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'data.php?page=data-siswa';
                }
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Ubah Data Gagal',
                text: '',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'data.php?page=edit-siswa&kode=" . $_GET['kode'] . "';
                }
            });
        </script>";
    }
}
?>