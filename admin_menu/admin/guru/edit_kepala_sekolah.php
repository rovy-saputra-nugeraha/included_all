<?php
if (isset($_GET['kode'])) {
    $sql_cek = "SELECT * FROM data_kepala_sekolah WHERE id_kepsek='" . $_GET['kode'] . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}

$nip_kepsek = isset($_POST['nip_kepsek']) ? mysqli_real_escape_string($koneksi, $_POST['nip_kepsek']) : '';
$nama_kepsek = isset($_POST['nama_kepsek']) ? mysqli_real_escape_string($koneksi, $_POST['nama_kepsek']) : '';
$alamat_kepsek = isset($_POST['alamat_kepsek']) ? mysqli_real_escape_string($koneksi, $_POST['alamat_kepsek']) : '';
$kata_pengantar = isset($_POST['kata_pengantar']) ? mysqli_real_escape_string($koneksi, $_POST['kata_pengantar']) : '';
?>

<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Ubah Data Kepala Sekolah
        </h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <!-- Form input untuk data guru -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="nip_kepsek" name="nip_kepsek" value="<?php echo $data_cek['nip_kepsek']; ?>" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Kepala Sekolah</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="nama_kepsek" name="nama_kepsek" value="<?php echo $data_cek['nama_kepsek']; ?>" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamat_kepsek" name="alamat_kepsek" value="<?php echo $data_cek['alamat_kepsek']; ?>" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kata Pengantar</label>
                <div class="col-sm-5">
                    <textarea class="form-control" id="kata_pengantar" name="kata_pengantar" rows="5"><?php echo $data_cek['kata_pengantar']; ?></textarea>
                </div>
            </div>

            <!-- Input untuk foto guru -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-6">
                    <img src="foto/kepala_sekolah/<?php echo $data_cek['foto_kepsek']; ?>" width="160px" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Ubah Foto</label>
                <div class="col-sm-6">
                    <input type="file" id="foto_kepsek" name="foto_kepsek">
                    <p class="help-block">
                        <font color="red">"Format file Jpg/Png"</font>
                    </p>
                </div>
            </div>
            <!-- End of input foto guru -->
        </div>

        <div class="card-footer">
            <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
            <a href="?page=data-kepala-sekolah" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
if (isset($_POST['Ubah'])) {
    // Handle pengeditan data guru

    // Periksa apakah ada file foto yang diunggah
    if (!empty($_FILES['foto_kepsek']['tmp_name'])) {
        // Jika ada file foto yang diunggah, proses pemindahan foto baru ke folder 'foto/kepala_Sekolah/'

        // Nama file foto baru
        $nama_file_baru = $_FILES['foto_kepsek']['name'];
        // Path tempat foto baru disimpan
        $path_foto_baru = 'foto/kepala_sekolah/' . $nama_file_baru;
        // Pindahkan file foto baru ke folder 'foto/guru/'
        if (move_uploaded_file($_FILES['foto_kepsek']['tmp_name'], $path_foto_baru)) {
            // Jika berhasil pindah, lakukan update data guru dengan foto baru
            $sql_ubah = "UPDATE data_kepala_sekolah SET
                            nip_kepsek='$nip_kepsek',
                            nama_kepsek='$nama_kepsek',
                            alamat_kepsek='$alamat_kepsek',
                            kata_pengantar='$kata_pengantar',
                            foto_kepsek='$nama_file_baru'
                        WHERE id_kepsek='" . $_GET['kode'] . "'";
        } else {
            // Jika gagal pindah, tampilkan pesan error
            echo "<script>alert('Gagal mengunggah foto.');</script>";
        }
    } else {
        // Jika tidak ada file foto yang diunggah, lakukan update data guru tanpa mengubah foto
        $sql_ubah = "UPDATE data_kepala_sekolah SET
                        nip_kepsek='$nip_kepsek',
                        nama_kepsek='$nama_kepsek',
                        alamat_kepsek='$alamat_kepsek',
                        kata_pengantar='$kata_pengantar'
                    WHERE id_kepsek='" . $_GET['kode'] . "'";
    }

    // Eksekusi query UPDATE
    $query_ubah = mysqli_query($koneksi, $sql_ubah);

    if ($query_ubah) {
        echo "<script>
                Swal.fire({title: 'Ubah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
                }).then((result) => {
                        if (result.value) {
                                window.location = 'data.php?page=data-kepala-sekolah';
                        }
                })</script>";
    } else {
        echo "<script>
                Swal.fire({title: 'Ubah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
                }).then((result) => {
                        if (result.value) {
                                window.location = 'data.php?page=data-kepala-sekolah';
                        }
                })</script>";
    }
}
?>