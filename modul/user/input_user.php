<?php

if (isset($_POST['add'])) {
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $password = md5($_POST['password']);
    $level = $_POST['level'];

    $cek = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username='$username'");
    if (mysqli_num_rows($cek) == 0) {
        $insert = mysqli_query($koneksi, "INSERT INTO tb_user(nama, username, password, level)VALUES('$nama','$username', '$password', '$level')") or die(mysqli_error($koneksi));
        if ($insert) {
?>
            <div class="flash-data" id="flash" data-flash="<?php echo $_POST['add'] ?>"></div>
<?php
        } else {
            echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, User Gagal Di simpan ! </div>';
        }
    } else {
        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>No User Sudah Ada . . .!</div>';
    }
}
$now = strtotime(date("Y-m-d"));
$maxage = date('Y-m-d', strtotime('-16 year', $now));
$minage = date('Y-m-d', strtotime('-40 year', $now));
?>

<html>

<head>
    <link href="assets/sweetalert2/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Input Pengguna</h1>
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
                                    <a href="?module=data_user" class="btn btn-flat btn-shadow">Kembali</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nama Lengkap</label>
                                <div class="col-sm-12">
                                    <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Username</label>
                                <div class="col-sm-12">
                                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Password</label>
                                <div class="col-sm-12">
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Level</label>
                                <div class="col-sm-12">
                                    <select name="level" class="form-control" required>
                                        <option value="">--Pilih Pengguna--</option>
                                        <option value="admin">Admin</option>
                                        <option value="cabang">Kepala Cabang</option>
                                    </select>
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
                    showConfirmButton: true
                });
            }, 10);
            window.setTimeout(function() {
                window.location = '?module=data_user';
            }, 3000);
        }
    </script>

</body>

</html>