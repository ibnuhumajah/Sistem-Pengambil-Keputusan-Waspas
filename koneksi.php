<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "db_waspas_wpfix";

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_errno()) {
    echo 'Gagal melakukan koneksi ke Database :  ' . mysqli_connect_error();
}
$angka = 1;
?>
<?php
$tb_user = mysqli_query($koneksi, "SELECT * FROM tb_user ORDER BY tb_user.level ASC");
// $skp = mysqli_query($koneksi, "SELECT * FROM surat_kuasa_pidana ORDER BY surat_kuasa_pidana.id ASC");
?>