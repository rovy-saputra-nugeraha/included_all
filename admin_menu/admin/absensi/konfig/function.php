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
    $sql = mysqli_query($dbconnect, "select * from tb_absen where id='$uid' and date='$hari_ini'");
    $auth = mysqli_num_rows($sql);
    if ($auth > 0) {
        if ($cek_absen == "in") {
            mysqli_query($dbconnect, "UPDATE tb_absen SET masuk='$time', status = 'BOLOS' WHERE id='$uid' AND date='$hari_ini'");
            return ("PRESENSI TEPAT WAKTU!");
        } else if ($cek_absen == "terlambat") {
            mysqli_query($dbconnect, "UPDATE tb_absen SET masuk='$time', status = 'TERLAMBAT' WHERE id='$uid' AND date='$hari_ini'");
            return ("PRESENSI TERLAMBAT!");
        } else if ($cek_absen == "out") {
            $cek_masuk = mysqli_query($dbconnect, "select * from tb_absen WHERE id='$uid' AND date='$hari_ini'");
            while ($data = mysqli_fetch_array($cek_masuk)) {
                $masuk = $data['masuk'];
                $status = $data['status'];
                if ($masuk != "" && $status != "T") {
                    mysqli_query($dbconnect, "UPDATE tb_absen SET keluar='$time', status = 'HADIR' WHERE id='$uid' AND date='$hari_ini'");
                    return ("PRESENSI TEPAT WAKTU!");
                } else if ($masuk != "" && $status == "TERLAMBAT") {
                    mysqli_query($dbconnect, "UPDATE tb_absen SET keluar='$time', status = 'TERLAMBAT' WHERE id='$uid' AND date='$hari_ini'");
                    return ("PRESENSI TERLAMBAT!");
                } else if ($masuk == "" && $status == "BOLOS") {
                    mysqli_query($dbconnect, "UPDATE tb_absen SET keluar='$time', status = 'BOLOS' WHERE id='$uid' AND date='$hari_ini'");
                    return ("PRESENSI BOLOS!");
                }
            }
        } else if ($cek_absen == "bolos") {
            mysqli_query($dbconnect, "UPDATE tb_absen SET keluar='$time', status = 'BOLOS' WHERE id='$uid' AND date='$hari_ini'");
            return ("PRESENSI SELESAI!");
        }
    } else {
        if ($cek_absen == "in") {
            mysqli_query($dbconnect, "INSERT INTO tb_absen VALUES ('$uid','$time','','$hari_ini','BOLOS','')");
            return ("PRESENSI TEPAT WAKTU!");
        } else if ($cek_absen == "terlambat") {
            mysqli_query($dbconnect, "INSERT INTO tb_absen VALUES ('$uid','$time','','$hari_ini','TERLAMBAT','')");
            return ("PRESENSI TERLAMBAT!");
        } else if ($cek_absen == "out") {
            mysqli_query($dbconnect, "INSERT INTO tb_absen VALUES ('$uid','','$time','$hari_ini','BOLOS','')");
            return ("PRESENSI KELUAR!");
        } else if ($cek_absen == "bolos") {
            mysqli_query($dbconnect, "INSERT INTO tb_absen VALUES ('$uid','','$time','$hari_ini','BOLOS','')");
            return ("PRESENSI BOLOS!");
        }
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
		$nisn = $results['nisn'];
		$tahun_masuk = $results['tahun_masuk'];
	}
	$message_text = "Halo " . $nama . "\nNISN : " . $nisn . "\nTahun Masuk : " . $tahun_masuk . "\nWaktu Absen : " . $jam_absen . ",\nPresensi anda telah berhasil disimpan. dengan status saat ini : \n" . $status;
	$url = "https://api.telegram.org/bot" . $secret_token . "/sendMessage?parse_mode=markdown&chat_id=" . $chat_id;
	$url = $url . "&text=" . urlencode($message_text);
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
