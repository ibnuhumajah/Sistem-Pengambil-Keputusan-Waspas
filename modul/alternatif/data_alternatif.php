<?php
if (isset($_GET['aksi']) == 'delete') {
    $id_alternatif = $_GET['id_alternatif'];
    $cek = mysqli_query($koneksi, "SELECT * FROM alternatif WHERE id_alternatif='$id_alternatif'");
    if (mysqli_num_rows($cek) == 0) {
    } else {
        $delete = mysqli_query($koneksi, "DELETE FROM alternatif WHERE id_alternatif='$id_alternatif'");
        if ($delete) {
?>
            <div class="flash-data" data-flashdata="<?php echo $_GET['aksi'] ?>"></div>
        <?php
        } else {
        ?>
            <div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal dihapus.</div>
<?php
        }
    }
}
?>
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Alternatif</h1>
    </div>
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <?php
                if (@$_SESSION['level'] == "admin") { ?>
                    <div class="card-header py-3 text-left" style="background-color: #f8f9fc;">

                        <a class="d-none d-sm-inline-block btn btn-primary shadow-sm" href="?module=input_alternatif"><i class="fas fa-plus fa-sm text-white-50"></i> Input Alternatif</a>
                    </div>
                <?php } ?>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush table-striped" id="dataTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Alternatif</th>
                                    <th>Lokasi Alternatif</th>
                                    <?php
                                    if (@$_SESSION['level'] == "admin") { ?>
                                        <th>Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql =  mysqli_query($koneksi, "SELECT * FROM alternatif");
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($sql)) {
                                ?>

                                    <tr>

                                        <td class="text-center"><?php echo $angka++ ?></td>
                                        <td><?php echo $row['nama_alternatif']; ?></td>
                                        <td><?php echo $row['lokasi']; ?></td>
                                        <?php
                                        if (@$_SESSION['level'] == "admin") { ?>
                                            <td class="text-center">
                                                <a href="?module=edit_alternatif&id_alternatif=<?php echo $row['id_alternatif']; ?>" title="Edit Data" class="btn btn-warning btn-sm"><i class="nav-icon fas fa-edit"></i></a>

                                                <a id="btn-hapus" href="?module=data_alternatif&aksi=delete&id_alternatif=<?php echo $row['id_alternatif']; ?>" title="Hapus Data" class="btn btn-danger btn-sm"> <i class="nav-icon fas fa-trash"></i></a>
                                            </td>
                                        <?php } ?>
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
            <!-- Modal Logout -->
        </div>
        <!---Container Fluid-->
    </div>
</div>