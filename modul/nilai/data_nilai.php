<?php
if (isset($_GET['aksi']) == 'delete') {
    $id_nilai = $_GET['id_nilai'];
    $cek = mysqli_query($koneksi, "SELECT * FROM nilai  WHERE id_nilai='$id_nilai'");
    if (mysqli_num_rows($cek) == 0) {
    } else {
        $delete = mysqli_query($koneksi, "DELETE FROM nilai WHERE id_nilai='$id_nilai'");
        if ($delete) {
?>
            <div class="flash-data" data-flashdata="<?php echo $_GET['aksi'] ?>"></div>
<?php
        } else {
            echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal dihapus.</div>';
        }
    }
}

function rupiah($angka)
{

    $hasil_rupiah = number_format($angka, 0, ',', ',');
    return $hasil_rupiah;
}
?>
<?php
if (isset($_GET['aksi']) == 'delete2') {
    $delete2 = mysqli_query($koneksi, "DELETE FROM nilai");
    if ($delete2) {
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
        <h1 class="h3 mb-0 text-gray-800">Data Nilai</h1>
    </div>
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3" style="background-color: #f8f9fc;">
                    <a class="btn btn-primary btn-shadow text-white" href="?module=input_nilai"><i class="fas fa-plus fa-sm text-white-50"></i> Input Nilai</a>
                    <a id="btn-hapus" class="btn btn-danger btn-shadow text-white" href="?module=data_hasil&aksi=delete2"><i class="fas fa-trash fa-sm text-white-50"></i> Hapus Seluruh Nilai</a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-striped" id="dataTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>No.</th>
                                <th>Nama Alternatif</th>
                                <th>Kriteria</th>
                                <th>Nilai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql =  mysqli_query($koneksi, "SELECT * FROM nilai, alternatif, kriteria WHERE nilai.id_alternatif=alternatif.id_alternatif AND nilai.id_kriteria=kriteria.id_kriteria");
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($sql)) {
                            ?>
                                <tr>

                                    <td><?php echo $angka++ ?></td>
                                    <td><?php echo $row['nama_alternatif']; ?></td>
                                    <td><?php echo $row['nama_kriteria']; ?></td>
                                    <td><?php echo rupiah($row['nilai']); ?></td>
                                    <td class="text-center">
                                        <a href="?module=edit_nilai&id_nilai=<?php echo $row['id_nilai']; ?>" title="Edit Data" class="btn btn-warning btn-sm"><i class="nav-icon fas fa-edit"></i></a>
                                        <a id="btn-hapus" href="?module=data_nilai&aksi=delete&id_nilai=<?php echo $row['id_nilai']; ?>" class="btn btn-danger btn-sm"> <i class="nav-icon fas fa-trash"></i></a>
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