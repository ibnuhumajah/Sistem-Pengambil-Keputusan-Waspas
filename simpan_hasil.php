<?php
session_start();

if (isset($_POST['add'])) {

    $insert = mysqli_query($koneksi, "REPLACE INTO hasil (nama_alternatif, hasil) VALUES ('$row[nama_alternatif]', '$hasil')");
    if ($insert) {
?>
<?php
    } else {
        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Alternatif Gagal Di simpan ! </div>';
    }
}

?>