<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <title>Website Resmi SDN 013 Tanjungpinang Barat</title>
  <meta content="" name="description" />
  <meta content="" name="keywords" />

  <!-- Favicons -->
  <link href="../style/img/logo.png" rel="icon" />
  <!--=============== REMIXICONS ===============-->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Tambahkan tag script ini ke dalam bagian <head> file HTML Anda -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

  <!-- Vendor CSS Files -->
  <link href="../style/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../style/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="../style/vendor/aos/aos.css" rel="stylesheet" />
  <link href="../style/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
  <link href="../style/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

  <!-- Template Main CSS File -->
  <link href="../style/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="../style/assets/css/styles.css">
  <style>
    .pengumuman {
      color: #278194;
      font-size: 40px;
      font-weight: 700;
    }

    .tulisan-bawah {
      font-size: 20px;
      font-family: 'Times New Roman', Times, serif;
    }

    .btn-kotak {
      border-radius: 20px;
      padding: 5px 15px;
      color: white;
      background-color: blue;
    }

    /* Animasi Tulisan Mengetik */
    @keyframes typing {
      from {
        width: 0;
      }

      to {
        width: 100%;
      }
    }

    .animated-text1 {
      overflow: hidden;
      white-space: nowrap;
      animation: typing 3s steps(40) infinite alternate;
      color: blue;
    }

    .animated-text1::after {
      content: "|";
      display: inline-block;
      animation: blink 0.7s infinite;
      color: whitesmoke;
    }

    @keyframes blink {

      0%,
      100% {
        opacity: 1;
      }

      50% {
        opacity: 0;
      }
    }

    .kotak {
      width: 20rem;
    }
  </style>
</head>

<body>

  <?php
  include('../inc/koneksi.php');
  ?>
  <!--=============== HEADER ===============-->
  <header class="header">
    <nav class="nav container">
      <div class="nav__data">
        <a href="#" class="nav__logo">
          <img src="../style/assets/navbar_logo.png" alt="navbar_logo">
        </a>

        <div class="nav__toggle" id="nav-toggle">
          <i class="ri-menu-line nav__burger"></i>
          <i class="ri-close-line nav__close"></i>
        </div>
      </div>

      <!--=============== NAV MENU ===============-->
      <div class="nav__menu" id="nav-menu">
        <ul class="nav__list">
          <li><a href="/ppdb-sd/index.php" class="nav__link ri-home-5-line">Home</a></li>

          <!--=============== DROPDOWN 1 ===============-->
          <li class="dropdown__item">
            <div class="nav__link ri-profile-line">
              Profil <i class="ri-arrow-down-s-line dropdown__arrow"></i>
            </div>

            <ul class="dropdown__menu">
              <li>
                <a href="/ppdb-sd/index.php" class="dropdown__link">
                  <i class="ri-pie-chart-line"></i> Visi Misi
                </a>
              </li>

              <li>
                <a href="/ppdb-sd/index.php" class="dropdown__link">
                  <i class="ri-pushpin-2-line"></i> Tata Tertib
                </a>
              </li>

              <!--=============== DROPDOWN SUBMENU ===============-->
              <li class="dropdown__subitem">
                <div class="dropdown__link">
                  <i class="ri-bar-chart-line"></i> Sumberdaya <i class="ri-add-line dropdown__add"></i>
                </div>

                <ul class="dropdown__submenu">
                  <li>
                    <a href="/ppdb-sd/index.php" class="dropdown__sublink">
                      <i class="ri-user-line"></i> Data Kepala Sekolah
                    </a>
                  </li>

                  <li>
                    <a href="/ppdb-sd/index.php" class="dropdown__sublink">
                      <i class="ri-team-line"></i> Data Guru
                    </a>
                  </li>

                  <li>
                    <a href="/ppdb-sd/index.php" class="dropdown__sublink">
                      <i class="ri-building-2-line"></i> Fasilitas Sekolah
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>

          <!--=============== DROPDOWN 2 ===============-->
          <li class="dropdown__item">
            <div class="nav__link ri-school-line">
              PPDB 2023 <i class="ri-arrow-down-s-line dropdown__arrow"></i>
            </div>

            <ul class="dropdown__menu">
              <li>
                <a href="petunjuk_teknis.php" class="dropdown__link">
                  <i class="ri-search-eye-line"></i> Petunjuk Teknis
                </a>
              </li>

              <li>
                <a href="/ppdb-sd/src/login_siswa/index.php" class="dropdown__link">
                  <i class="ri-lock-line"></i> Pendaftaran Ulang
                </a>
              </li>

              <li>
                <a href="hasil_seleksi.php" class="dropdown__link">
                  <i class="ri-file-search-line"></i> Pengumuman Hasil Seleksi
                </a>
              </li>
            </ul>
          </li>

          <li><a href="/ppdb-sd/index.php" class="nav__link ri-article-line">Berita</a></li>

          <li><a href="#footer" class="nav__link ri-information-line">Informasi Resmi</a></li>

          <li><a href="/ppdb-sd/src/admin_menu/login.php" class="nav__link ri-admin-line">Admin Menu</a></li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- End Header -->

  <!-- Carousel Start -->
  <div id="header" class="container-fluid p-0 mb-5">
    <div id="blog-carousel" class="carousel slide overlay-bottom" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="w-100" src="../style/img/background.png" alt="Image" />
          <div class="carousel-caption d-flex flex-column align-items-center justify-content-center carousel-caption">
            <h1 id="animated-text1" class="display-1 text-white m-0 animated-text1 bg-danger">- PENGUMUMAN HASIL SELEKSI -</h1>
            <h2 class="text-white m-0">Selamat bergabung di SDN 013 Tanjungpinang Barat. Kami berharap anda merasa nyaman dan terinspirasi di sekolah ini.</h2>
            <a href="#cek-hasil" class="btn btn-kotak mt-3">CEK HASIL SELEKSI</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Carousel End -->

  <!-- Pengumuman Hasil Seleksi -->
  <div class="container-fluid mt-4">
    <h2 class="pengumuman text-center fw-bold" id="cek-hasil">PENGUMUMAN</h2>
    <h4 class="tulisan-bawah ml-3 text-center">Informasi hasil pengumuman pendaftaran PPDB Online SDN 013 Tanjungpinang Barat tahun Ajaran 2023/2024. Hasil Pengumuman dapat terus berubah sampai batas waktu pendaftaran berakhir sesuai jadwal yang telah ditetapkan.</h4>
    <h6 class="mt-5 ml-3"><b>Search</b></h6>
    <div class="input-group mb-4 mt-3">
      <div class="form-outline kotak ml-3">
        <input placeholder="Masukkan NIK Siswa" type="text" id="getName" class="form-control text-center">
      </div>
    </div>
    <!-- Tabel -->
    <table class="table">
      <thead>
        <tr class="text-center">
          <th>NIK Siswa</th>
          <th>Nama Siswa</th>
          <th>Jenis Kelamin</th>
          <th>Tanggal Penerimaan</th>
          <th>Jalur Penerimaan</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody id="showdata" class="text-center">
        <?php
        include('../inc/koneksi.php');

        $sql = "SELECT biodata_siswa.id_siswa, login_siswa.nik, biodata_siswa.nama_siswa, biodata_siswa.jk_siswa, hasil_seleksi.tgl_penerimaan, hasil_seleksi.jalur_penerimaan, hasil_seleksi.status_penerimaan
        FROM biodata_siswa
        LEFT JOIN login_siswa ON biodata_siswa.id_login_siswa = login_siswa.id_login_siswa
        LEFT JOIN hasil_seleksi ON biodata_siswa.id_siswa = hasil_seleksi.id_siswa
        ORDER BY login_siswa.nik ASC";

        $query = mysqli_query($koneksi, $sql);

        if (mysqli_num_rows($query) > 0) {
          while ($row = mysqli_fetch_assoc($query)) {
            $statusClass = '';
            if ($row['status_penerimaan'] == 'Sudah di Setujui') {
              $statusClass = 'table-success';
            } elseif ($row['status_penerimaan'] == 'Tidak di Setujui') {
              $statusClass = 'table-danger';
            } else {
              $statusClass = 'table-warning';
            }
            echo "<tr class='$statusClass'>";
            echo "<td><h6>" . $row['nik'] . "</h6></td>";
            echo "<td><h6>" . $row['nama_siswa'] . "</h6></td>";
            echo "<td><h6>" . $row['jk_siswa'] . "</h6></td>";
            if ($row['tgl_penerimaan']) {
              echo "<td><h6>" . $row['tgl_penerimaan'] . "</h6></td>";
            } else {
              echo "<td><h6>-</h6></td>";
            }
            if ($row['jalur_penerimaan']) {
              echo "<td><h6>" . $row['jalur_penerimaan'] . "</h6></td>";
            } else {
              echo "<td><h6>-</h6></td>";
            }
            if ($row['status_penerimaan']) {
              echo "<td><h6>" . $row['status_penerimaan'] . "</h6></td>";
            } else {
              echo "<td><h6>Belum di Setujui</h6></td>";
            }
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='6'>DATA TIDAK DITEMUKAN</td></tr>";
          echo "<tr><td colspan='6'>SILAHKAN MASUKKAN NIK SISWA YANG SESUAI</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
  <!-- Pengumuman Hasil Seleksi -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer mt-5">
    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-geo-alt icon"></i>
          <div>
            <h4>ALAMAT</h4>
            <p>
              Jl. Yos Sudarso, Tanjungpinang Barat, Kota Tanjungpinang<br />
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links d-flex">
          <i class="bi bi-telephone icon"></i>
          <div>
            <h4>Kontak</h4>
            <p>
              <strong>Phone:</strong> (0771) 315306<br />
              <strong>Email:</strong> sdn013_tpibarat@yahoo.co.id<br />
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Kunjungi Sosial Media untuk Informasi Lainnya</h4>
          <div class="social-links d-flex">
            <a title="facebook" href="https://www.facebook.com/profile.php?id=100068154853700" class="facebook"><i class="bi bi-facebook"></i></a>
            <a title="youtube" href="https://youtube.com/@sdn013tanjungpinangbarat2?si=ZXFFSBWgbQRcyJC2" class="youtube"><i class="bi bi-youtube"></i></a>
            <a title="whats-app" href="#" class="whats-app"><i class="bi bi-whatsapp"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links d-flex">
          <i class="bi bi-clock icon"></i>
          <div>
            <h4>Jam Sekolah</h4>
            <div>
              <h6 class="text-white text-uppercase">SISWA</h6>
              <p>
                - Senin-Kamis : <br />
                07.00 AM-14.30 PM
              </p>
              <p>
                - Jumat : <br />
                07.00 AM-11.00 PM
              </p>
              <h6 class="text-white text-uppercase">STAFF</h6>
              <p>
                - Senin-Kamis : <br />
                07.00 AM-15.30 PM
              </p>
              <p>
                - Jumat : <br />
                07.00 AM-11.00 PM
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>SDN 013 Tanjungpinang Barat</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by MAMANG UI PROJECT
      </div>
    </div>
  </footer>
  <!-- End Footer -->
  <!-- End Footer -->

  <!-- Template Javascript -->
  <script src="../style/js/main.js"></script>

  <script>
    $(document).ready(function() {
      $('#getName').on("keyup", function() {
        var getName = $(this).val();
        $.ajax({
          method: 'POST',
          url: 'searchajax.php', // Pastikan ini sesuai dengan path ke file searchajax.php
          data: {
            nik: getName
          },
          success: function(response) {
            $("#showdata").html(response); // Isi hasil pencarian ke dalam elemen dengan id "showdata"
          }
        });
      });
    });
  </script>

  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
  <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="../lib/tempusdominus/js/moment.min.js"></script>
  <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
  <!--=============== MAIN JS ===============-->
  <script src="../style/assets/js/main.js"></script>

</body>

</html>