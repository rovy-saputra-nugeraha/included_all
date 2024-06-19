<?php

include 'connection.php';
//=====================================Load Settings From Database=======================================
$sql = mysqli_query($dbconnect, "SELECT * FROM tb_settings");
while ($data = mysqli_fetch_array($sql)) {
    $masuk_mulai = $data['masuk_mulai'];
    $masuk_akhir = $data['masuk_akhir'];
    $keluar_mulai = $data['keluar_mulai'];
    $keluar_akhir = $data['keluar_akhir'];
    $libur1 = $data['libur1'];
    $libur2 = $data['libur2'];
    $timezone = $data['timezone'];
    $admin_uid = $data['admin_uid'];
    $bot_token = $data['bot_token'];
}
//====================================Load Timezone====================================================
date_default_timezone_set($timezone);
//=====================================Check Day Off================================================
function getday($tanggal)
{
    $tgl = substr($tanggal, 8, 2);
    $bln = substr($tanggal, 5, 2);
    $thn = substr($tanggal, 0, 4);
    $info = date('w', mktime(0, 0, 0, $bln, $tgl, $thn));
    switch ($info) {
        case '0':
            return "Minggu";
            break;
        case '1':
            return "Senin";
            break;
        case '2':
            return "Selasa";
            break;
        case '3':
            return "Rabu";
            break;
        case '4':
            return "Kamis";
            break;
        case '5':
            return "Jumat";
            break;
        case '6':
            return "Sabtu";
            break;
    };
}
//=====================================Check UID in DB==============================================
function uid($id)
{
    global $dbconnect;
    $sql = mysqli_query($dbconnect, "select * from tb_id where id='$id'");
    $auth = mysqli_num_rows($sql);
    if ($auth > 0) {
        return ("0");
    } else {
        return ("1");
    }
}
//=====================================Check Attendance Time==============================================
function cektime($time, $m_mulai, $m_akhir, $k_mulai, $k_akhir)
{

    if ($time > $m_mulai && $time < $m_akhir) {
        return "in"; //parameter absen masuk
    } else if ($time >  $m_akhir && $time < $k_mulai) {
        return "terlambat"; //parameter absen masuk terlambat
    } else if ($time > $k_mulai && $time < $k_akhir) {
        return "out"; //parameter absen pulang
    } else if ($time > $k_akhir) {
        return "bolos"; //parameter absen bolos
    } else {
        return "bolos"; //parameter tidak diset
    }
}

//===============================Insert or Update Database Attendance==================================
function postdata($uid, $hari_ini, $time, $cek_absen)
{
    global $dbconnect;

    // Handle check-in actions
    if ($cek_absen == "in" || $cek_absen == "terlambat") {
        $status = $cek_absen == "in" ? "BOLOS" : "TERLAMBAT";
        $query = mysqli_query($dbconnect, "SELECT * FROM data_absen_masuk WHERE id='$uid' AND date='$hari_ini'");
        $auth = mysqli_num_rows($query);

        if ($auth > 0) {
            mysqli_query($dbconnect, "UPDATE data_absen_masuk SET masuk='$time', status='$status' WHERE id='$uid' AND date='$hari_ini'");
        } else {
            mysqli_query($dbconnect, "INSERT INTO data_absen_masuk (id, masuk, date, status, keterangan, berkas) VALUES ('$uid', '$time', '$hari_ini', '$status', '', '')");
        }
        return $cek_absen == "in" ? "PRESENSI TEPAT WAKTU!" : "PRESENSI TERLAMBAT!";
    }

    // Handle check-out actions
    if ($cek_absen == "out" || $cek_absen == "bolos") {
        $query_masuk = mysqli_query($dbconnect, "SELECT * FROM data_absen_masuk WHERE id='$uid' AND date='$hari_ini'");
        $data_masuk = mysqli_fetch_array($query_masuk);
        $masuk = isset($data_masuk['masuk']) ? $data_masuk['masuk'] : "";

        $status = "BOLOS";
        if ($cek_absen == "out" && $masuk != "") {
            $status = $data_masuk['status'] == "TERLAMBAT" ? "TERLAMBAT" : "HADIR";
        }

        $query_keluar = mysqli_query($dbconnect, "SELECT * FROM data_absen_keluar WHERE id='$uid' AND date='$hari_ini'");
        $auth_keluar = mysqli_num_rows($query_keluar);

        if ($auth_keluar > 0) {
            mysqli_query($dbconnect, "UPDATE data_absen_keluar SET keluar='$time', status='$status' WHERE id='$uid' AND date='$hari_ini'");
        } else {
            mysqli_query($dbconnect, "INSERT INTO data_absen_keluar (id, keluar, date, status, keterangan, berkas) VALUES ('$uid', '$time', '$hari_ini', '$status', '', '')");
        }
        return $cek_absen == "out" ? "PRESENSI KELUAR!" : "PRESENSI BOLOS!";
    }

    mysqli_close($dbconnect);
}


function telegram($uid, $jam_absen, $status, $secret_token)
{
    global $dbconnect;
    $sql = mysqli_query($dbconnect, "SELECT * FROM tb_id WHERE id='$uid'");
    while ($results = mysqli_fetch_array($sql)) {
        $nama = $results['nama'];
        $chat_id = $results['chatid'];
        $status_kartu = $results['status_kartu'];
        $tahun_masuk = $results['tahun_masuk'];

        // Menentukan label dan identifier berdasarkan status kartu
        if ($status_kartu == 'Guru') {
            $identifier_label = 'NIP';
            $identifier_value = $results['nisn'];
        } else {
            $identifier_label = 'NISN';
            $identifier_value = $results['nisn'];
        }
    }

    // Membuat teks pesan
    $message_text = "Halo " . $nama . "\n" . $identifier_label . " : " . $identifier_value . "\nTahun Masuk : " . $tahun_masuk . "\nStatus : " . $status_kartu . "\nWaktu Absen : " . $jam_absen . ",\nPresensi anda telah berhasil disimpan. dengan status saat ini : \n" . $status;
    
    // URL untuk mengirim pesan
    $url = "https://api.telegram.org/bot" . $secret_token . "/sendMessage?parse_mode=markdown&chat_id=" . $chat_id;
    $url = $url . "&text=" . urlencode($message_text);
    
    // Mengirim pesan menggunakan curl
    $ch = curl_init();
    $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    curl_exec($ch);
    curl_close($ch);
}

?>
