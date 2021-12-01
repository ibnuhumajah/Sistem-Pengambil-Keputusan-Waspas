<?php
$query = mysqli_query($koneksi, "SELECT * FROM hasil WHERE id_hasil='$_GET[id_hasil]'");
$row = mysqli_fetch_assoc($query);
?>

<?php
if (isset($_POST['edit'])) {
    $id_hasil = $_POST['id_hasil'];
    $nama_alternatif = $_POST['nama_alternatif'];
    $hasil = $_POST['hasil'];
    $keterangan_hasil = $_POST['keterangan_hasil'];


    $update = mysqli_query($koneksi, "UPDATE hasil SET id_hasil='$id_hasil',  
																				nama_alternatif ='$nama_alternatif', 
																				hasil ='$hasil', 
																				keterangan_hasil='$keterangan_hasil'
																				WHERE id_hasil ='$id_hasil'") or die(mysqli_error($koneksi));
    if ($update) {
?>
        <div class="flash-data" id="flash" data-flash="<?php echo $_POST['edit'] ?>"></div>
<?php
    } else {
        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data Pemohon salinan Gagal Di Upadate ! </div>';
    }
}
?>

<html>

<head>
    <link href="assets/sweetalert2/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Ubah Hasil</h1>
        </div>
        <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
                <div class="card mb-4">

                    <form class="form-horizontal" action="" method="post">
                        <div class="card-header" style="background-color:  #f8f9fc;">
                            <div class="form-group text-right">
                                <div class="col-sm-12">
                                    <input type="hidden" name="id_hasil" value="<?php echo $row['id_hasil']; ?>">
                                    <input type="submit" name="edit" class="btn btn-primary btn-shadow" value="Simpan">
                                    <a href="?module=data_hasil" class="btn btn-flat btn-shadow">Kembali</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nama Cabang</label>
                                <div class="col-sm-12">
                                    <input type="text" name="nama_alternatif" class="form-control" value="<?php echo $row['nama_alternatif']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nilai Akhir</label>
                                <div class="col-sm-12">
                                    <input type="text" name="hasil" class="form-control" value="<?php echo $row['hasil']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Jenis Kriteria</label>
                                <div class="col-sm-12">
                                    <select type="text" name="keterangan_hasil" class="form-control">
                                        <option value="<?php echo $row['keterangan_hasil']; ?>"><?php echo $row['keterangan_hasil']; ?></option>
                                        <option value="">Pilih Keterangan</option>
                                        <option value="Selamat Cabang Anda Menjadi Cabang Terbaik">Selamat Cabang Anda Menjadi Cabang Terbaik</option>
                                        <option value="Banyak Penjualan Tidak Memenuhi Syarat">Banyak Penjualan Tidak Memenuhi Syarat</option>
                                        <option value="Banyak Penjualan Tidak Memenuhi Syarat">Banyak Penjualan Tidak Memenuhi Syarat</option>
                                        <option value="Penambahan Pelanggan Baru Tidak Memenuhi Syarat">Penambahan Pelanggan Baru Tidak Memenuhi Syarat</option>
                                        <option value="Kerugian Bulanan Tidak Memenuhi Syarat">Kerugian Bulanan Tidak Memenuhi Syarat</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
        <!---Container Fluid-->
    </div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="assets/sweetalert2/sweetalert2.min.js"></script>

    <script>
        var flash = $('#flash').data('flash');
        if (flash) {
            setTimeout(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data berhasil diubah!',
                    timer: 2000,
                    showConfirmButton: false
                });
            }, 10);
            window.setTimeout(function() {
                window.location = '?module=data_hasil';
            }, 2000);
        }
    </script>
</body>

</html>