<?php
session_start();
include 'connection.php';

if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = mysqli_real_escape_string($dbconnect, $_POST['username']);
    $password = mysqli_real_escape_string($dbconnect, $_POST['password']);

    $sql = mysqli_query($dbconnect, "SELECT * FROM tb_pengguna WHERE username='$username'");
    $user = mysqli_fetch_assoc($sql);

    if($user && password_verify($password, $user['password'])) {
        $_SESSION['page'] = 'dashboard';
        $_SESSION['username'] = $username;
        header("location: ../index.php?page=dashboard");
        exit();
    } else {
        $error_message = "Username atau Password salah.";
    }
} else {
    $error_message = "Username dan Password harus diisi.";
}

// Redirect back to login page with error message
header("location: ../login.php?error=true&message=".urlencode($error_message));
exit();
?>