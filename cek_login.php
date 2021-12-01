<?php
session_start();

include("koneksi.php");

$username = $_REQUEST['username'];
$password = md5($_REQUEST['password']);

// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username='$username' AND password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if ($cek > 0) {

    $data = mysqli_fetch_assoc($login);
    $_SESSION['nama'] = $data["nama"];

    // cek jika user login sebagai admin
    if ($data['level'] != 'cabang') {
        // buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $data["id"];
        $_SESSION['level'] = "admin";
        // alihkan ke halaman dashboard admin
        header("location:dashboard.php?module=home");
        // cek jika user login sebagai pegawai
    } elseif ($data['level'] != 'admin') {
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $data["id"];
        $_SESSION['level'] = "cabang";
        // alihkan ke halaman dashboard admin
        header("location:dashboard.php?module=home");
    }
} else {
    header("location:index=gagal_login.php");
}
