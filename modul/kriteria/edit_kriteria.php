<?php
$query = mysqli_query($koneksi, "SELECT * FROM kriteria WHERE id_kriteria='$_GET[id_kriteria]'");
$row = mysqli_fetch_assoc($query);
?>
<?php
if (isset($_POST['add'])) {
    $id_kriteria    = $_POST['id_kriteria'];
    $nama_kriteria    = $_POST['nama_kriteria'];
    $bobot_kriteria    = $_POST['bobot_kriteria'];
    $jenis_kriteria    = $_POST['jenis_kriteria'];

    $update = mysqli_query($koneksi, "UPDATE kriteria SET id_kriteria='$id_kriteria',  
																				nama_kriteria='$nama_kriteria', 
																				bobot_kriteria='$bobot_kriteria', 
																				jenis_kriteria='$jenis_kriteria'
																				WHERE id_kriteria='$id_kriteria'") or die(mysqli_error($koneksi));
    if ($update) {
?>
        <div class="flash-data" id="flash" data-flash="<?php echo $_POST['add'] ?>"></div>
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
            <h1 class="h3 mb-0 text-gray-800">Ubah Kriteria</h1>
        </div>
        <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
                <div class="card mb-4">

                    <form class="form-horizontal" action="" method="post">
                        <div class="card-header" style="background-color:  #f8f9fc;">
                            <div class="form-group text-right">
                                <div class="col-sm-12">
                                    <input type="hidden" name="id_kriteria" value="<?php echo $row['id_kriteria']; ?>">
                                    <input type="submit" name="add" class="btn btn-primary btn-shadow" value="Simpan">
                                    <a href="?module=data_kriteria" class="btn btn-flat btn-shadow">Kembali</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nama Kriteria</label>
                                <div class="col-sm-12">
                                    <input type="text" name="nama_kriteria" class="form-control" value="<?php echo $row['nama_kriteria']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Jenis Kriteria</label>
                                <div class="col-sm-12">
                                    <select type="text" name="jenis_kriteria" class="form-control">
                                        <option value="<?php echo $row['jenis_kriteria']; ?>"><?php echo $row['jenis_kriteria']; ?></option>
                                        <option value="">--Pilih Kepentingan--</option>
                                        <option value="Benefit">Benefit</option>
                                        <option value="Cost">Cost</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Bobot Kriteria</label>
                                <div class="col-sm-12">
                                    <input type="text" name="bobot_kriteria" class="form-control" value="<?php echo $row['bobot_kriteria']; ?>">
                                </div>
                            </div>
                            <br>
                    </form>
                </div>
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
                window.location = '?module=data_kriteria';
            }, 2000);
        }
    </script>
</body>

</html>