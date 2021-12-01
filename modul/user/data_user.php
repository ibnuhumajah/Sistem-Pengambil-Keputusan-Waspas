<?php
if (isset($_GET['aksi']) == 'delete') {
    $id = $_GET['id'];
    $cek = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id='$id'");
    if (mysqli_num_rows($cek) == 0) {
    } else {
        $delete = mysqli_query($koneksi, "DELETE FROM tb_user WHERE id='$id'");
        if ($delete) {
?>
            <div class="flash-data" data-flashdata="<?php echo $_GET['aksi'] ?>"></div>
<?php
        } else {
            echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal dihapus.</div>';
        }
    }
}
?>
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pengguna</h1>
    </div>
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3" style="background-color:  #f8f9fc;">
                    <a class="btn btn-primary btn-shadow text-white" href="?module=input_user"><i class="fas fa-plus fa-sm text-white-50"></i> Input User</a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-striped" id="dataTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>No.</th>
                                <th>Username</th>
                                <th>Nama Lengkap</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql =  mysqli_query($koneksi, "SELECT * FROM tb_user");
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($sql)) {
                            ?>

                                <tr>

                                    <td class="text-center"><?php echo $angka++ ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo ucwords($row['nama']); ?></td>

                                    <td class="text-center">
                                        <a href="?module=edit_user&id=<?php echo $row['id']; ?>" title="Edit Data" class="btn btn-warning btn-sm"><i class="nav-icon fas fa-edit"></i></a>
                                        <a id="btn-hapus" href="?module=data_user&aksi=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"> <i class="nav-icon fas fa-trash"></i></a>
                                    </td>
                                </tr>

                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!---Container Fluid-->
    </div>
</div>