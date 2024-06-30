<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * from data_kepala_sekolah WHERE id_kepsek='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>
<div class="row">

	<div class="col-md-8">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">Detail Kepala Sekolah</h3>

				<div class="card-tools">
				</div>
			</div>
			<div class="card-body p-0">
				<table class="table">
					<tbody>
						<tr>
							<td style="width: 200px">
								<b>NIP</b>
							</td>
							<td>:
								<?php echo $data_cek['nip_kepsek']; ?>
							</td>
						</tr>
						<tr>
							<td style="width: 200px">
								<b>Nama Kepala Sekolah</b>
							</td>
							<td>:
								<?php echo $data_cek['nama_kepsek']; ?>
							</td>
						</tr>
						<tr>
							<td style="width: 200px">
								<b>Alamat</b>
							</td>
							<td>:
								<?php echo $data_cek['alamat_kepsek']; ?>
							</td>
						</tr>
						<tr>
							<td style="width: 200px">
								<b>Kata Pengantar</b>
							</td>
							<td>:
								<?php echo $data_cek['kata_pengantar']; ?>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="card-footer">
					<a href="?page=data-kepala-sekolah" class="btn btn-warning">Kembali</a>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="card card-success">
			<div class="card-header">
				<center>
					<h3 class="card-title">
						Foto Kepala Sekolah
					</h3>
				</center>

				<div class="card-tools">
				</div>
			</div>
			<div class="card-body">
				<div class="text-center">
					<img src="foto/kepala_sekolah/<?php echo $data_cek['foto_kepsek']; ?>" width="280px" />
				</div>

				<h3 class="profile-username text-center">
					<b class="text-danger">NIP - NAMA</b> <br>
					<?php echo $data_cek['nip_kepsek']; ?>
					-
					<?php echo $data_cek['nama_kepsek']; ?>
				</h3>
			</div>
		</div>
	</div>

</div>