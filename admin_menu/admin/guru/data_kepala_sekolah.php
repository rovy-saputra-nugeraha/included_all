<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Kepala Sekolah</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<?php
				$sql = $koneksi->query("SELECT * FROM data_kepala_sekolah");
				$jumlah_data = $sql->num_rows;

				if ($jumlah_data == 0) {
					echo '<p align="center">Data Kepala Sekolah Belum Tersedia <br>Klik Button dibawah ini untuk Input Data</p>';
					echo '<div class="mb-2" align="center">
						<a href="?page=add-kepala-sekolah" class="btn btn-primary">
							<i class="fa fa-edit"></i> Tambah Data</a>
					</div>';
				} else {
			?>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr class="text-center">
						<th>No</th>
						<th>Foto</th>
						<th>NIP</th>
						<th>Nama</th>
						<th>Alamat</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
							$no = 1;
							while ($data = $sql->fetch_assoc()) {
					?>

					<tr class="text-center">
						<td><?php echo $no++; ?></td>
						<td align="center">
							<img src="foto/kepala_sekolah/<?php echo $data['foto_kepsek']; ?>" width="70px" />
						</td>
						<td><?php echo $data['nip_kepsek']; ?></td>
						<td><?php echo $data['nama_kepsek']; ?></td>
						<td><?php echo $data['alamat_kepsek']; ?></td>
						<td>
							<a href="?page=view-kepala-sekolah&kode=<?php echo $data['id_kepsek']; ?>" title="Detail" class="btn btn-info btn-sm">
								<i class="fa fa-eye"></i>
							</a>
							<a href="?page=edit-kepala-sekolah&kode=<?php echo $data['id_kepsek']; ?>" title="Ubah" class="btn btn-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="?page=del-kepala-sekolah&kode=<?php echo $data['id_kepsek']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus" class="btn btn-danger btn-sm">
								<i class="fa fa-trash"></i>
							</a>
						</td>
					</tr>

					<?php
							}
					?>
				</tbody>
			</table>
			<?php
				}
			?>
		</div>
	</div>
	<!-- /.card-body -->
</div>
