<?php
if (isset($_GET['aksi']) == 'delete') {
    $delete = mysqli_query($koneksi, "DELETE FROM hasil");
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
?>

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Hasil</h1>
    </div>
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3" style="background-color:  #f8f9fc;">
                    <a class="btn btn-success btn-shadow text-white" href=""><i class="fas fa-file-excel fa-sm text-white-50"></i> Cetak Report Excel</a>
                    <a id="btn-hapus" class="btn btn-danger btn-shadow text-white" href="?module=data_hasil&aksi=delete"><i class="fas fa-trash fa-sm text-white-50"></i> Hapus Seluruh Hasil</a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-striped" id="dataTable">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">Ranking</th>
                                <th class="text-center">Nama Cabang</th>
                                <th class="text-center">Nilai Akhir</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $hasil = mysqli_query($koneksi, "SELECT * FROM hasil ORDER BY hasil DESC");
                            $no = 0;
                            while ($row = mysqli_fetch_array($hasil)) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $no + 1; ?></td>
                                    <td class="text-center"><?php echo $row['nama_alternatif'] ?></td>
                                    <td class="text-center"><?php echo number_format($row['hasil'], 4) ?></td>
                                    <td class="text-center"><?php echo $row['keterangan_hasil'] ?></td>
                                    <td class="text-center">
                                        <a href="?module=edit_hasil&id_hasil=<?php echo $row['id_hasil']; ?>" title="Edit Data" class="btn btn-warning btn-sm "><i class="nav-icon fas fa-edit"></i> Edit</a>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!---Container Fluid-->
    </div>
</div>