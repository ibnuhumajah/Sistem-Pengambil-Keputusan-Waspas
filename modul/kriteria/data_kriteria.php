<?php
if (isset($_GET['aksi']) == 'delete') {
    $id_kriteria = $_GET['id_kriteria'];
    $cek = mysqli_query($koneksi, "SELECT * FROM kriteria WHERE id_kriteria='$id_kriteria'");
    if (mysqli_num_rows($cek) == 0) {
    } else {
        $delete = mysqli_query($koneksi, "DELETE FROM kriteria WHERE id_kriteria='$id_kriteria'");
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
        <h1 class="h3 mb-0 text-gray-800">Data Kriteria</h1>
    </div>
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3" style="background-color:  #f8f9fc;">
                    <a class="btn btn-primary btn-shadow text-white" href="?module=input_kriteria"><i class="fas fa-plus fa-sm text-white-50"></i> Input Kriteria</a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-striped" id="dataTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>No.</th>
                                <th>Nama Kriteria</th>
                                <th>Jenis Kriteria</th>
                                <th>Bobot Kriteria</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql =  mysqli_query($koneksi, "SELECT * FROM kriteria");
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($sql)) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $angka++ ?></td>
                                    <td><?php echo $row['nama_kriteria']; ?></td>
                                    <td><?php echo $row['jenis_kriteria']; ?></td>
                                    <td><?php echo $row['bobot_kriteria']; ?></td>
                                    <td class="text-center">
                                        <a href="?module=edit_kriteria&id_kriteria=<?php echo $row['id_kriteria']; ?>" title="Edit Data" class="btn btn-warning btn-sm "><i class="nav-icon fas fa-edit"></i></a>

                                        <a id="btn-hapus" href="?module=data_kriteria&aksi=delete&id_kriteria=<?php echo $row['id_kriteria']; ?>" class="btn btn-danger btn-sm"> <i class="nav-icon fas fa-trash"></i></a>
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