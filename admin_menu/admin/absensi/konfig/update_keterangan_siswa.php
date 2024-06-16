<?php
session_start();

// Memeriksa apakah sesi telah dimulai dan variabel 'page' telah diset
if (!isset($_SESSION['page'])) {
    header("Location: ../index.php?page=dashboard&error=true");
    exit;
}

// Memeriksa apakah semua parameter POST yang diperlukan tersedia
if (!isset($_POST['id'], $_POST['tanggal'], $_POST['status'], $_POST['flag'], $_FILES['fileUpload'], $_POST['keterangan'])) {
    header("Location: ../index.php?page=dashboard&error=true");
    exit;
}

// Koneksi ke database (sesuaikan dengan pengaturan koneksi Anda)
include 'connection.php'; // Ubah sesuai dengan nama file koneksi Anda

// Mendapatkan informasi dari form
$id = mysqli_real_escape_string($dbconnect, $_POST['id']);
$tanggal = mysqli_real_escape_string($dbconnect, $_POST['tanggal']);
$status = mysqli_real_escape_string($dbconnect, $_POST['status']);
$keterangan = mysqli_real_escape_string($dbconnect, $_POST['keterangan']);
$flag = mysqli_real_escape_string($dbconnect, $_POST['flag']);

// File upload handling
$allowedFileTypes = ['image/jpeg', 'image/png', 'application/pdf'];
$uploadDir = 'berkasSiswa/'; // Pastikan direktori ini sudah ada dan dapat diakses oleh server

$fileName = $_FILES['fileUpload']['name'];
$fileTmpName = $_FILES['fileUpload']['tmp_name'];
$fileSize = $_FILES['fileUpload']['size'];
$fileType = $_FILES['fileUpload']['type'];
$fileError = $_FILES['fileUpload']['error'];

// Mengambil nama file lama dari database untuk dihapus
$sqlOldFile = "SELECT berkas FROM tb_absen WHERE id='$id' AND date='$tanggal'";
$resultOldFile = mysqli_query($dbconnect, $sqlOldFile);
if ($resultOldFile) {
    $rowOldFile = mysqli_fetch_assoc($resultOldFile);
    $oldFileName = $rowOldFile['berkas'];
    if (!empty($oldFileName)) {
        // Hapus file lama jika ada
        $oldFileFullPath = $uploadDir . $oldFileName;
        if (file_exists($oldFileFullPath)) {
            unlink($oldFileFullPath);
        }
    }
}

if (in_array($fileType, $allowedFileTypes) && $fileError === 0) {
    // Pindahkan file baru ke direktori yang ditentukan
    $fileDestination = $uploadDir . basename($fileName);
    if (move_uploaded_file($fileTmpName, $fileDestination)) {
        // File berhasil diunggah, lanjutkan dengan operasi SQL
        $fileNameInDatabase = basename($fileName); // Ambil nama file saja untuk disimpan di database

        if ($flag === '0') {
            // Jika flag adalah '0', lakukan UPDATE data
            $sql = "UPDATE tb_absen SET status='$status', berkas='$fileNameInDatabase', keterangan='$keterangan' WHERE id='$id' AND date='$tanggal'";
        } else {
            // Jika flag bukan '0', lakukan INSERT data baru
            $sql = "INSERT INTO tb_absen (id, masuk, keluar, date, status, berkas, keterangan) VALUES ('$id', '-', '-', '$tanggal', '$status', '$fileNameInDatabase', '$keterangan')";
        }

        // Eksekusi query SQL
        if (mysqli_query($dbconnect, $sql)) {
            mysqli_close($dbconnect);
            // Redirect jika berhasil
            header("Location: ../index.php?page=absensi-masuk-siswa&success=true");
            exit;
        } else {
            mysqli_close($dbconnect);
            // Redirect jika gagal
            header("Location: ../index.php?page=absensi-masuk-siswa&error=true");
            exit;
        }
    } else {
        // Jika gagal memindahkan file
        mysqli_close($dbconnect);
        header("Location: ../index.php?page=absensi-masuk-siswa&error=true");
        exit;
    }
} else {
    // Jika terjadi kesalahan pada file yang diunggah
    mysqli_close($dbconnect);
    header("Location: ../index.php?page=absensi-masuk-siswa&error=true");
    exit;
}
?>