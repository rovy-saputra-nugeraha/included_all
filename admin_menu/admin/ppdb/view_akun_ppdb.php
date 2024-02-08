<?php

if (isset($_GET['kode'])) {
    $sql_cek = "SELECT * FROM login_siswa WHERE id_login_siswa='" . $_GET['kode'] . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="row">
        <div class="col">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Detail Akun PPDB</h3>
                    <div class="card-tools"></div>
                </div>
                <div class="card-body p-0">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td style="width: 200px">
                                    <b>NIK</b>
                                </td>
                                <td>:
                                    <?php echo $data_cek['nik']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 200px">
                                    <b>Nama Pendek</b>
                                </td>
                                <td>:
                                    <?php echo $data_cek['nama_pendek']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 200px">
                                    <b>Email</b>
                                </td>
                                <td>:
                                    <?php echo $data_cek['email']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 200px">
                                    <b>Password</b>
                                </td>
                                <td>:
                                    <span id="password">**************</span>
                                    <span id="originalPassword" style="display:none;"><?php echo $data_cek['password']; ?></span>
                                    <button type="button" class="btn btn-sm btn-outline-primary" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="card-footer">
                        <a href="?page=data-akun-ppdb" class="btn btn-warning">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const originalPassword = document.querySelector('#originalPassword');

        togglePassword.addEventListener('click', function(e) {
            // toggle icon
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');

            // toggle password visibility
            if (password.textContent === '**************') {
                password.textContent = originalPassword.textContent;
            } else {
                password.textContent = '**************';
            }
        });
    </script>
</body>

</html>
