<?php
// mysqli_query($koneksi, "DELETE FROM hasil");
function rupiah($angka)
{

    $hasil_rupiah = number_format($angka, 0, ',', ',');
    return $hasil_rupiah;
}
?>
<html>

<head>
    <link href="assets/sweetalert2/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Perhitungan Metode WASPAS</h1>
        </div>
        <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #f8f9fc;">
                        <h3 class="m-0 font-weight-bold text-primary">Matrik Nilai</h3>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Alternatif</th>
                                    <?php
                                    $kriteria = mysqli_query($koneksi, "select * from kriteria");
                                    while ($row = mysqli_fetch_array($kriteria)) {
                                    ?>
                                        <th><?php echo $row['nama_kriteria'] ?></th>
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2" class="text-center">Bobot</td>
                                    <?php
                                    $bobot = mysqli_query($koneksi, "select * from kriteria");
                                    while ($row2 = mysqli_fetch_array($bobot)) {
                                    ?>
                                        <td><?php echo $row2['bobot_kriteria'] ?> % ( <?php echo $row2['jenis_kriteria'] ?> )</td>
                                    <?php
                                    }
                                    ?>
                                </tr>
                                <?php
                                $alternatif = mysqli_query($koneksi, "select * from alternatif");
                                $no = 0;
                                $id_alternatif = array();
                                while ($row3 = mysqli_fetch_array($alternatif)) {
                                    $id_alt[$no] = $row3[0];
                                    $alt[$no] = $row3[1];
                                ?>
                                    <tr>
                                        <td><?php echo $no + 1; ?></td>
                                        <td><?php echo $row3['nama_alternatif'] ?></td>
                                        <?php
                                        $kriteria = mysqli_query($koneksi, "select * from kriteria");
                                        $nmr = 0;
                                        while ($row4 = mysqli_fetch_array($kriteria)) {
                                        ?>
                                            <td>
                                                <?php
                                                $nilai = mysqli_query($koneksi, "select * from nilai where id_kriteria='" . $row4['id_kriteria'] . "' and id_alternatif='" . $row3['id_alternatif'] . "'");
                                                while ($row5 = mysqli_fetch_array($nilai)) {
                                                    // if ($nmr == 0) {
                                                    // 	$ipa[$noxx] = $row4x['nilai'];
                                                    // }
                                                    // if ($nmr == 1) {
                                                    // 	$mm[$noxx] = $row4x['nilai'];
                                                    // 	if ($ipa[$noxx] > $mm[$noxx]) {
                                                    // 		$mapel[$noxx] = "IPA";
                                                    // 	} else {
                                                    // 		$mapel[$noxx] = "Matematika";
                                                    // 	}
                                                    // }

                                                    echo rupiah($row5['nilai']);
                                                    $nmr++;
                                                }
                                                ?>
                                            </td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2">Nilai Max</th>
                                    <?php
                                    $kriteria = mysqli_query($koneksi, "select * from kriteria");
                                    while ($row4 = mysqli_fetch_array($kriteria)) {
                                        // MENDAPAT NILAI MAX MATRIX NILAI
                                        $max = 0;
                                        $sql = mysqli_query($koneksi, "SELECT * FROM kriteria WHERE id_kriteria='$row4[id_kriteria]'");
                                        while ($r = mysqli_fetch_array($sql)) {
                                            $sql2 = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_kriteria='$r[id_kriteria]'");
                                            while ($r2 = mysqli_fetch_array($sql2)) {
                                                if ($max > $r2["nilai"]) {
                                                    $max = $max;
                                                } else {
                                                    $max = $r2["nilai"];
                                                }
                                            }
                                        }
                                    ?>
                                        <th>
                                            <?php echo rupiah($max); ?>
                                        </th>
                                    <?php
                                    }
                                    ?>
                                </tr>
                                <tr>
                                    <th colspan="2">Nilai Min</th>
                                    <?php
                                    $kriteria = mysqli_query($koneksi, "select * from kriteria");
                                    while ($row4 = mysqli_fetch_array($kriteria)) {

                                        // MENDAPAT NILAI MIN MATRIX NILAI
                                        $min = mysqli_fetch_array(mysqli_query($koneksi, "SELECT nilai FROM nilai ORDER BY id_nilai ASC LIMIT 1"));
                                        $sql2 = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_kriteria='$row4[id_kriteria]'");
                                        while ($r2 = mysqli_fetch_array($sql2)) {

                                            if ($min < $r2["nilai"]) {
                                                $min = $min;
                                            } else {
                                                $min = $r2["nilai"];
                                            }
                                        }
                                    ?>
                                        <th>
                                            <?php echo rupiah($min); ?>
                                        </th>
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #f8f9fc;">
                        <h3 class="m-0 font-weight-bold text-primary">Matrik Normalisasi</h3>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Alternatif</th>
                                    <?php
                                    $kriteria = mysqli_query($koneksi, "select * from kriteria");
                                    while ($row = mysqli_fetch_array($kriteria)) {
                                    ?>
                                        <th><?php echo $row['nama_kriteria'] ?></th>
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>-</td>
                                    <td>Bobot</td>
                                    <?php
                                    $kriteria = mysqli_query($koneksi, "select * from kriteria");
                                    while ($row2 = mysqli_fetch_array($kriteria)) {
                                    ?>
                                        <td><?php echo $row2['bobot_kriteria'] ?> % ( <?php echo $row2['jenis_kriteria'] ?> )</td>
                                    <?php
                                    }
                                    ?>
                                </tr>
                                <?php
                                $alternatif = mysqli_query($koneksi, "select * from alternatif");
                                $no = 1;
                                while ($row3 = mysqli_fetch_array($alternatif)) {
                                ?>
                                    <tr>
                                        <!-- NO -->
                                        <td><?php echo $no++ ?></td>
                                        <!-- NAMA CABANG -->
                                        <td><?php echo $row3['nama_alternatif'] ?></td>
                                        <?php
                                        $kriteria = mysqli_query($koneksi, "select * from kriteria");
                                        while ($row4 = mysqli_fetch_array($kriteria)) {
                                            // MENCARI NILAI MAX NORMALISASI
                                            $max = 0;
                                            $sql = mysqli_query($koneksi, "SELECT * FROM kriteria WHERE id_kriteria='$row4[id_kriteria]'");
                                            while ($r = mysqli_fetch_array($sql)) {
                                                $sql2 = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_kriteria='$r[id_kriteria]'");
                                                while ($r2 = mysqli_fetch_array($sql2)) {
                                                    if ($max > $r2["nilai"]) {
                                                        $max = $max;
                                                    } else {
                                                        $max = $r2["nilai"];
                                                    }
                                                }
                                                // MENCARI NILAI MIN NORMALISASI
                                                $min = mysqli_fetch_array(mysqli_query($koneksi, "SELECT nilai FROM nilai ORDER BY id_nilai ASC LIMIT 1"));
                                                $sql2 = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_kriteria='$r[id_kriteria]'");
                                                while ($r2 = mysqli_fetch_array($sql2)) {

                                                    if ($min < $r2["nilai"]) {
                                                        $min = $min;
                                                    } else {
                                                        $min = $r2["nilai"];
                                                    }
                                                }
                                            }
                                        ?>
                                            <td>
                                                <?php
                                                // MENDAPAT NILAI NORMALISASI
                                                $hasil = mysqli_query($koneksi, "select * from nilai where id_kriteria='" . $row4['id_kriteria'] . "' and id_alternatif='" . $row3['id_alternatif'] . "'");
                                                while ($row5 = mysqli_fetch_array($hasil)) {

                                                    if ($row4["jenis_kriteria"] == "Benefit") {
                                                        $nilai = $row5["nilai"] / $max;
                                                    } elseif ($row4["jenis_kriteria"] == "Cost") {
                                                        $nilai = $min / $row5["nilai"];
                                                    }
                                                    if ($nilai != 1) {
                                                        echo number_format($nilai, 4);
                                                    } else {
                                                        echo $nilai;
                                                    }
                                                }
                                                ?>
                                            </td>
                                        <?php
                                        }
                                        ?>

                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <form class="form-horizontal" method="post" id="btn_submit">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #f8f9fc;">
                            <h3 class="m-0 font-weight-bold text-primary">Perhitungan Akhir</h3>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Alternatif</th>
                                        <th>WSM</th>
                                        <th>WPM</th>
                                        <th>Qi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $alternatif = mysqli_query($koneksi, "select * from alternatif");
                                    $no = 0;
                                    while ($row = mysqli_fetch_array($alternatif)) {
                                    ?>
                                        <tr>
                                            <!-- NO -->
                                            <td><?php echo $no + 1; ?></td>
                                            <!-- NAMA CABANG -->
                                            <td><?php echo $row['nama_alternatif'] ?></td>
                                            <!-- WSM -->
                                            <td>
                                                <?php
                                                $nilai_wsm = 0.065;
                                                $kriteria = mysqli_query($koneksi, "select * from kriteria");
                                                while ($row2 = mysqli_fetch_array($kriteria)) {
                                                    $wsm = mysqli_query($koneksi, "select * from nilai where id_kriteria='" . $row2['id_kriteria'] . "' and id_alternatif='" . $row['id_alternatif'] . "'");
                                                    while ($row3 = mysqli_fetch_array($wsm)) {

                                                        if ($row2["jenis_kriteria"] == "Benefit") {
                                                            $nilai = $row3["nilai"] / $max;
                                                        } elseif ($row2["jenis_kriteria"] == "Cost") {
                                                            $nilai = $min / $row3["nilai"];
                                                        }
                                                        $i = ($nilai * ($row2["bobot_kriteria"] / 100));
                                                        $nilai_wsm += $i;
                                                    }
                                                }
                                                $hasilx = 0.5 * $nilai_wsm;
                                                echo number_format($hasilx, 4);
                                                // echo $hasilx;

                                                // WPM
                                                echo "</td><td>";
                                                $nilai_wpm = 1.072;
                                                $kriteria = mysqli_query($koneksi, "select * from kriteria");
                                                while ($row2 = mysqli_fetch_array($kriteria)) {
                                                    $wpm = mysqli_query($koneksi, "select * from nilai where id_kriteria='" . $row2['id_kriteria'] . "' and id_alternatif='" . $row['id_alternatif'] . "'");
                                                    while ($row3 = mysqli_fetch_array($wpm)) {

                                                        if ($row2["jenis_kriteria"] == "Benefit") {
                                                            $nilai = $row3["nilai"] / $max;
                                                        } elseif ($row2["jenis_kriteria"] == "Cost") {
                                                            $nilai = $min / $row3["nilai"];
                                                        }
                                                        // gajelas
                                                        $j = pow($nilai, ($row2["bobot_kriteria"] / 100));
                                                        $nilai_wpm *= $j;
                                                    }
                                                }
                                                $hasily = 0.5 * $nilai_wpm;
                                                echo number_format($hasily, 4);
                                                // echo $hasily;

                                                echo "</td><td>";
                                                // QI
                                                $hasil = ($hasilx + $hasily);
                                                // echo $hasil;
                                                echo number_format($hasil, 4);
                                                echo "</td>"
                                                ?>
                                            </td>
                                            <?php $no++ ?>
                                            <?php
                                            if (isset($_POST['add'])) {

                                                $insert = mysqli_query($koneksi, "REPLACE INTO hasil (nama_alternatif, hasil) VALUES ('$row[nama_alternatif]', '$hasil')");
                                                if ($insert) {
                                            ?>
                                                    <div class="flash-data" id="flash" data-flash="<?php echo $_POST['add'] ?>"></div>
                                        <?php
                                                } else {
                                                    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Alternatif Gagal Di simpan ! </div>';
                                                }
                                            }
                                        }
                                        ?>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                    if (@$_SESSION['level'] == "admin") { ?>
                        <div class="form-group text-right">
                            <div class="col-sm-12">
                                <button type="submit" id="btn-simpan" name="add" class="btn btn-primary btn-shadow" value="Simpan">Simpan</button>
                                <a href="?module=data_alternatif" class="btn btn-flat btn-shadow">Kembali</a>
                            </div>
                        </div>
                    <?php } ?>
                </form>

            </div>
        </div>
    </div>

    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="assets/sweetalert2/sweetalert2.min.js"></script>

    <script>
        $(document).on('click', '#btn-simpan', function(e) {
            var link = $(this).closest('form');
            var name = $(this).data('name')

            e.preventDefault();
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda akan logout!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, Simpan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    link.data(name).submit();
                }
            })
        })

        var flash = $('#flash').data('flash');
        if (flash) {
            setTimeout(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Berhasil menyimpan hasil!',
                    timer: 3000,
                    showConfirmButton: false
                });
            }, 10);
            window.setTimeout(function() {
                window.location = '?module=data_hasil';
            }, 3000);
        }
    </script>

</body>

</html>