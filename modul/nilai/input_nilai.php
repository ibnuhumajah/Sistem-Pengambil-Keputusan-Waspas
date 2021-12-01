<?php
if (isset($_POST['add'])) {
    $id_kriteria = $_POST['id_kriteria'];
    $id_alternatif = $_POST['id_alternatif'];
    $nilai = $_POST['nilai'];

    $insert = mysqli_query($koneksi, "INSERT INTO nilai(id_alternatif, id_kriteria, nilai)VALUES('$id_alternatif', '$id_kriteria', '$nilai')") or die(mysqli_error($koneksi));
    if ($insert) {
?>
        <div class="flash-data" id="flash" data-flash="<?php echo $_POST['add'] ?>"></div>
<?php
    } else {
        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Nilai Gagal Di simpan ! </div>';
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
            <h1 class="h3 mb-0 text-gray-800">Input Nilai</h1>
        </div>
        <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
                <div class="card mb-4">

                    <form class="form-horizontal" action="" method="post">
                        <div class="card-header" style="background-color:  #f8f9fc;">
                            <div class="form-group text-right">
                                <div class="col-sm-12">
                                    <input type="submit" name="add" class="btn btn-primary btn-shadow" value="Simpan">
                                    <a href="?module=data_nilai" class="btn btn-flat btn-shadow">Kembali</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nama Alternatif</label>
                                <div class="col-sm-12">
                                    <select name="id_alternatif" class="form-control" required>
                                        <option value="">Pilih Alternatif</option>
                                        <?php
                                        $sql =  mysqli_query($koneksi, "SELECT * FROM alternatif");

                                        while ($row = mysqli_fetch_assoc($sql)) {
                                        ?>
                                            <option value="<?php echo $row['id_alternatif'] ?>"><?php echo $row['nama_alternatif'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Jenis Kriteria</label>
                                <div class="col-sm-12">
                                    <select name="id_kriteria" class="form-control" required>
                                        <option value="">Pilih Kriteria</option>
                                        <?php
                                        $sql =  mysqli_query($koneksi, "SELECT * FROM kriteria");

                                        while ($row = mysqli_fetch_assoc($sql)) {
                                        ?>
                                            <option value="<?php echo $row['id_kriteria'] ?>"><?php echo $row['nama_kriteria'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nilai</label>
                                <div class="col-sm-12">
                                    <input type="text" name="nilai" class="form-control" placeholder="Masukan Nilai" required>
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
                    text: 'Data berhasil disimpan!',
                    timer: 3000,
                    showConfirmButton: false
                });
            }, 10);
            window.setTimeout(function() {
                window.location = '?module=data_nilai';
            }, 3000);
        }
    </script>
</body>

</html>