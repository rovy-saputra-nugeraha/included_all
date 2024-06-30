<?php

if(isset($_GET['kode'])){
    $sql_cek = "SELECT * FROM data_kepala_sekolah where id_kepsek='".$_GET['kode']."'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
}
?>

<?php
    $foto= $data_cek['foto_kepsek'];
    if (file_exists("foto/kepala_sekolah/$foto")){
        unlink("foto/kepala_sekolah/$foto");
    }

    $sql_hapus = "DELETE FROM data_kepala_sekolah WHERE id_kepsek='".$_GET['kode']."'";
    $query_hapus = mysqli_query($koneksi, $sql_hapus);
    if ($query_hapus) {
        echo "<script>
        Swal.fire({title: 'Hapus Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {if (result.value) {window.location = 'data.php?page=data-kepala-sekolah'
        ;}})</script>";
        }else{
            echo "<script>
            Swal.fire({title: 'Hapus Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
            }).then((result) => {if (result.value) {window.location = 'data.php?page=data-kepala-sekolah'
            ;}})</script>";
    }
