<?php session_start(); ?>
<?php
include('connect/connection.php');

if (isset($_POST["register"])) {
    $nama_pendek = $_POST["nama_pendek"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $nik = $_POST["nik"];

    $check_email_query = mysqli_query($connect, "SELECT * FROM login_siswa WHERE email ='$email'");
    $rowCountEmail = mysqli_num_rows($check_email_query);

    $check_nik_query = mysqli_query($connect, "SELECT * FROM login_siswa WHERE nik ='$nik'");
    $rowCountNik = mysqli_num_rows($check_nik_query);

    if (!empty($email) && !empty($password)) {
        if ($rowCountEmail > 0) {
?>
            <script>
                alert("Pengguna Dengan Email Tersebut Sudah Ada!");
            </script>
        <?php
        } elseif ($rowCountNik > 0) {
        ?>
            <script>
                alert("NIK Sudah Didaftarkan!");
            </script>
            <?php
        } else {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            $result = mysqli_query($connect, "INSERT INTO login_siswa (email, nik, nama_pendek, password, status) VALUES ('$email', '$nik', '$nama_pendek', '$password_hash', 0)");

            if ($result) {
                $otp = rand(100000, 999999);
                $_SESSION['otp'] = $otp;
                $_SESSION['mail'] = $email;
                require "Mail/phpmailer/PHPMailerAutoload.php";
                $mail = new PHPMailer;

                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';

                $mail->Username = '013sdntanjungpinangbarat@gmail.com';
                $mail->Password = 'abzrczsogizfdwtc';

                $mail->setFrom('013sdntanjungpinangbarat@gmail.com', 'Registrasi Berhasil');
                $mail->addAddress($_POST["email"]);

                $mail->isHTML(true);
                $mail->Subject = "Verifikasi Akun Anda!";
                $mail->Body = "<p>Selamat datang di SD Negeri 013 Tanjungpinang Barat!<br> Terimakasih telah melakukan pendaftaran akun PPDB SD Negeri 013 Tanjungpinang Barat. <br> Berikut Ini Adalah Kode OTP Untuk Verifikasi Akun Anda: </p> <h3>Kode OTP: $otp</h3>";

                if (!$mail->send()) {
            ?>
                    <script>
                        alert("<?php echo "Registerasi Gagal, Email Tidak Valid" ?>");
                    </script>
                <?php
                } else {
                ?>
                    <script>
                        alert("<?php echo "Registerasi Berhasil, Kode OTP Telah Dikirim! " ?>");
                        window.location.replace('otp.php');
                    </script>
                <?php
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Favicons -->
    <link href="assets/img/clients/Tutwurihandayani.png" rel="icon">
    <link href="assets/img/clients/Tutwurihandayani.png" rel="apple-touch-icon">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/login.css?= time();?>" />
    <title>Registrasi | PPDB</title>
  </head>
  <body>
    <!----------------------- Main Container -------------------------->

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
      <!----------------------- Login Container -------------------------->

      <div class="row border rounded-5 p-3 bg-white shadow box-area">
        <!--------------------------- Left Box ----------------------------->

        <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #103cbe">
          <div class="featured-image mb-3">
            <img src="assets/img/clients/ppdbnew.png" class="img-fluid" style="width: 250px" />
          </div>
          <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600">Segera Daftar</p>
          <small class="text-white text-wrap text-center" style="width: 17rem; font-family: 'Courier New', Courier, monospace">Masuk dan input berkas yang di perlukan.</small>
        </div>

        <!-------------------- ------ Right Box ---------------------------->

        <div class="col-md-6 right-box">
          <div class="row align-items-center">
            <div class="header-text mb-4">
              <h2 align="center"><strong>Dashboard Registrasi|</strong>PPDB 2024</h2>
              <p align="center">Segera daftarkan putra dan putri anda di SD Negeri 013 Tanjungpinang Barat!</p>
            </div>

            <div class="card-body">
              <form action="#" method="POST" name="register">
                <div class="input-group mb-3">
                  <input type="text" class="form-control form-control-lg bg-light fs-6" name="nama_pendek" required placeholder="Username" />
                </div>
                <div class="input-group mb-3">
                  <input type="text" class="form-control form-control-lg bg-light fs-6" name="nik" required  placeholder="NIK Siswa" />
                </div>
                <div class="input-group mb-3">
                  <input type="text" class="form-control form-control-lg bg-light fs-6" name="email" required placeholder="Alamat Email" />
                </div>
                <div class="input-group mb-1">
                  <input type="password" class="form-control form-control-lg bg-light fs-6" name="password" required  placeholder="Password" />
                </div>
                <div class="input-group mb-5 d-flex justify-content-between"></div>
                <div class="input-group mb-3">
                  <button class="btn btn-lg btn-primary w-100 fs-6" name="register" >Daftar</button>
                </div>
                <div class="row">
                  <small>Sudah punya akun? <a href="login.php">Login</a></small>
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
