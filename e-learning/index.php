<!DOCTYPE html>
<html>

<head>
    <title>Login | E-Learning</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Favicons -->
    <link href="../assets/img/clients/Tutwurihandayani.png" rel="icon">
    <link href="../assets/img/clients/Tutwurihandayani.png" rel="apple-touch-icon">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <style>
        /* Center text vertically */
        .center-text {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        /* Center placeholder text */
        input::placeholder {
            text-align: center;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-md-6 {
            flex: 1;
            padding: 10px;
            box-sizing: border-box;
        }

        video {
            width: 100%;
            border-radius: 8px;
        }

        .form-horizontal {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-horizontal label,
        .form-horizontal input,
        .form-horizontal button {
            width: 100%;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .form-horizontal input {
            padding: 10px;
        }

        .form-horizontal button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        .form-horizontal button a {
            color: white;
            text-decoration: none;
        }

        @media (max-width: 600px) {
            form .kotak{
                height: 200px;
            }

            .col-md-6 {
                flex-basis: 100%;
                max-width: 100%;
                padding: 0;
            }

            .form-horizontal button {
                width: 100%;
            }

            .form-horizontal label,
            .form-horizontal input {
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <form class="kotak" action="login.php" method="post">
        <h2><strong>Masuk E-Learning <br> SD Negeri 013 Tanjungpinang Barat</strong></h2>

        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <div class="row">
            <div class="col-md-6">
                <video id="preview" width="100%"></video>
            </div>
            <div class="col-md-6">
                <form method="post" class="form-horizontal">
                    <label class="center-text">SCAN QR CODE</label>
                    <input type="text" name="qrcode_text" id="text" placeholder="Masukkan Code QR" class="form-control" readonly> <br>
                    <button align="center"><a href="../index.php">Kembali</a></button>
                </form>
            </div>
        </div>
    </form>
    <script>
        let scanner = new Instascan.Scanner({
            video: document.getElementById('preview')
        });
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                alert('Tidak ada kamera yang ditemukan');
            }
        }).catch(function(e) {
            console.error(e);
        });

        scanner.addListener('scan', function(c) {
            document.getElementById('text').value = c;
            document.forms[0].submit();
        });
    </script>
</body>

</html>
