<?php
$query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id='$_GET[id]'");
$row = mysqli_fetch_assoc($query);
?>
<?php
if (isset($_POST['add'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $password = md5($_POST['password']);
    $level = $_POST['level'];
    $update = mysqli_query($koneksi, "UPDATE tb_user SET username='$username',  
																				nama='$nama', 
																				password='$password', 
                                                                                level='$level'
																				WHERE id='$id'") or die(mysqli_error($koneksi));
    if ($update) {
?>
        <div class="flash-data" id="flash" data-flash="<?php echo $_POST['add'] ?>"></div>
<?php
    } else {
        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data Pemohon salinan Gagal Di Upadate ! </div>';
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
            <h1 class="h3 mb-0 text-gray-800">Ubah Pengguna</h1>
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
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nama Lengkap</label>
                                <div class="col-sm-12">
                                    <input type="text" name="nama" class="form-control" value="<?php echo $row['nama']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Username</label>
                                <div class="col-sm-12">
                                    <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Password</label>
                                <div class="col-sm-12">
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Level</label>
                                <div class="col-sm-12">
                                    <select name="level" class="form-control">
                                        <option value="<?php echo $row['level']; ?>"><?php echo $row['level']; ?></option>
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
                    text: 'Data berhasil diubah!',
                    timer: 2000,
                    showConfirmButton: false
                });
            }, 10);
            window.setTimeout(function() {
                window.location = '?module=data_user';
            }, 2000);
        }
    </script>
</body>

</html>