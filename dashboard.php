<?php
session_start();
include "koneksi.php";
if (@$_SESSION['level'] == "admin" || @$_SESSION['level'] == "cabang") {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="assets/img/logo/logo4.png" rel="icon">
        <title>WASPAS CHIKA</title>
        <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/ruang-admin.min.css" rel="stylesheet">
        <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/ruang-admin.min.css" rel="stylesheet">
        <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

        <link href="assets/sweetalert2/sweetalert2.min.css" rel="stylesheet">

    </head>

    <body id="page-top">
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?module=home">
                    <div class="sidebar-brand-icon">
                        <img src="assets/img/logo/logo4.png">
                    </div>
                    <div class="sidebar-brand-text mx-3">Waspas Chika</div>
                </a>
                <hr class="sidebar-divider my-0">
                <li class="nav-item active">
                    <a class="nav-link" href="?module=home">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">
                    MENU
                </div>
                <?php
                if (@$_SESSION['level'] == "admin") { ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="?module=data_kriteria">
                            <i class="far fa-fw fa-window-maximize"></i>
                            <span>Data Kriteria</span>
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item active">
                    <a class="nav-link" href="?module=data_alternatif">
                        <i class="fab fa-fw fa-wpforms"></i>
                        <span>Data Alternatif</span>
                    </a>
                </li>
                <?php
                if (@$_SESSION['level'] == "admin") { ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="?module=data_nilai">
                            <i class="fas fa-fw fa-table"></i>
                            <span>Data Nilai</span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="?module=data_hasil">
                            <i class="fas fa-fw fa-poll"></i>
                            <span>Data Hasil</span>
                        </a>
                    </li>
                <?php
                } ?>
                <li class="nav-item active">
                    <a class="nav-link" href="?module=waspas">
                        <i class="fas fa-fw fa-star"></i>
                        <span>Data Perhitungan</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <?php
                if (@$_SESSION['level'] == "admin") { ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="?module=data_user">
                            <i class="fas fa-fw fa-user"></i>
                            <span>Users</span>
                        </a>
                    </li>
                <?php }
                ?>
                <li class="nav-item active">
                    <a id="btn-logout" class="nav-link" href="logout.php">
                        <i class="fas fa-fw fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
            </ul>
            <!-- Sidebar -->
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <!-- TopBar -->
                    <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                        <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                        <ul class="navbar-nav ml-auto">
                            <div class="topbar-divider d-none d-sm-block"></div>
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="ml-2 d-none d-lg-inline text-white big">Login by <b><?php echo ucwords($_SESSION["nama"]) ?></b></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- Topbar -->
                    <?php
                    $module = $_GET["module"];
                    switch ($module) {
                        default:
                    ?>
                            <!-- Container Fluid-->
                            <div class="container-fluid" id="container-wrapper">
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                                </div>

                                <div class="row mb-3">
                                    <!-- Earnings (Monthly) Card Example -->
                                    <?php
                                    if (@$_SESSION['level'] == "admin") { ?>
                                        <div class="col-xl-3 col-md-6 mb-4">
                                            <a href="?module=data_kriteria" style="text-decoration: none;">
                                                <div class="card h-100">
                                                    <div class="card-body">
                                                        <div class="row align-items-center">
                                                            <div class="col mr-2">
                                                                <?php
                                                                $mysql = mysqli_fetch_array(mysqli_query($koneksi, "select count(id_kriteria) as jumlah from kriteria"));
                                                                ?>
                                                                <div class="text-xs font-weight-bold text-uppercase mb-1">Data Kriteria</div>
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $mysql['jumlah'] ?> Data</div>
                                                            </div>
                                                            <div class="col-auto mt-3">
                                                                <i class="fas fa-window-maximize fa-2x text-primary"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <!-- Earnings (Annual) Card Example -->
                                        <div class="col-xl-3 col-md-6 mb-4">
                                            <a href="?module=data_alternatif" style="text-decoration: none;">
                                                <div class="card h-100">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <?php
                                                                $mysql = mysqli_fetch_array(mysqli_query($koneksi, "select count(id_alternatif) as jumlah from alternatif"));
                                                                ?>
                                                                <div class="text-xs font-weight-bold text-uppercase mb-1">Data Alternatif</div>
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $mysql['jumlah'] ?> Data</div>
                                                            </div>
                                                            <div class="col-auto mt-3">
                                                                <i class="fab fa-wpforms fa-2x text-success"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <!-- New User Card Example -->
                                        <div class="col-xl-3 col-md-6 mb-4">
                                            <a href="?module=data_nilai" style="text-decoration: none;">
                                                <div class="card h-100">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <?php
                                                                $mysql = mysqli_fetch_array(mysqli_query($koneksi, "select count(id_nilai) as jumlah from nilai"));
                                                                ?>
                                                                <div class="text-xs font-weight-bold text-uppercase mb-1">Data Nilai</div>
                                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $mysql['jumlah'] ?> Data</div>
                                                            </div>
                                                            <div class="col-auto mt-3">
                                                                <i class="fas fa-table fa-2x text-info"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <!-- Pending Requests Card Example -->
                                        <div class="col-xl-3 col-md-6 mb-4">
                                            <a href="?module=waspas" style="text-decoration: none;">
                                                <div class="card h-100">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <?php
                                                                $mysql = mysqli_fetch_array(mysqli_query($koneksi, "select count(id_hasil) as jumlah from hasil"));
                                                                ?>
                                                                <div class="text-xs font-weight-bold text-uppercase mb-1">Data Perhitungan</div>
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $mysql['jumlah'] ?> Data</div>
                                                            </div>
                                                            <div class="col-auto mt-3">
                                                                <i class="fas fa-star fa-2x text-warning"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php
                                    } ?>
                                    <div class="col-lg-12">
                                        <div class="card mb-4">
                                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #f8f9fc; width:100%">
                                                <h3 class="m-0 font-weight-bold text-grey-900">Ranking Akhir</h3>
                                            </div>
                                            <div class="table-responsive p-3">
                                                <table class="table align-items-center table-flush table-striped">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th class="text-center">Ranking</th>
                                                            <th class="text-center">Nama Cabang</th>
                                                            <th class="text-center">Nilai Akhir</th>
                                                            <th class="text-center">Keterangan</th>
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
                                                            </tr>
                                                        <?php
                                                            $no++;
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Row-->
                        <?php
                            break;
                        case "data_kriteria":
                            if (@$_SESSION['level'] == "admin") {
                                include "modul/kriteria/data_kriteria.php";
                            } else {
                                echo "<div class='text-center'><h1>ANDA TIDAK MEMILIKI AKSES KE HALAMAN INI!</h1>";
                                echo "<a href='?module=home' class='btn btn-danger align-items-center text-right'>Kembali</a></div><br>";
                            }
                            break;
                        case "data_hasil":
                            if (@$_SESSION['level'] == "admin") {
                                include "modul/hasil/data_hasil.php";
                            } else {
                                echo "<div class='text-center'><h1>ANDA TIDAK MEMILIKI AKSES KE HALAMAN INI!</h1>";
                                echo "<a href='?module=home' class='btn btn-danger align-items-center text-right'>Kembali</a></div><br>";
                            }
                            break;
                        case "edit_hasil":
                            if (@$_SESSION['level'] == "admin") {
                                include "modul/hasil/edit_hasil.php";
                            } else {
                                echo "<div class='text-center'><h1>ANDA TIDAK MEMILIKI AKSES KE HALAMAN INI!</h1>";
                                echo "<a href='?module=home' class='btn btn-danger align-items-center text-right'>Kembali</a></div><br>";
                            }
                            break;
                        case "data_alternatif":
                            include "modul/alternatif/data_alternatif.php";
                            break;
                        case "data_nilai":
                            if (@$_SESSION['level'] == "admin") {
                                include "modul/nilai/data_nilai.php";
                            } else {
                                echo "<div class='text-center'><h1>ANDA TIDAK MEMILIKI AKSES KE HALAMAN INI!</h1>";
                                echo "<a href='?module=home' class='btn btn-danger align-items-center text-right'>Kembali</a></div><br>";
                            }
                            break;
                        case "data_user":
                            if (@$_SESSION['level'] == "admin") {
                                include "modul/user/data_user.php";
                            } else {
                                echo "<div class='text-center'><h1>ANDA TIDAK MEMILIKI AKSES KE HALAMAN INI!</h1>";
                                echo "<a href='?module=home' class='btn btn-danger align-items-center text-right'>Kembali</a></div><br>";
                            }
                            break;
                        case "input_alternatif":
                            if (@$_SESSION['level'] == "admin") {
                                include "modul/alternatif/input_alternatif.php";
                            } else {
                                echo "<div class='text-center'><h1>ANDA TIDAK MEMILIKI AKSES KE HALAMAN INI!</h1>";
                                echo "<a href='?module=home' class='btn btn-danger align-items-center text-right'>Kembali</a></div><br>";
                            }
                            break;
                        case "input_kriteria":
                            if (@$_SESSION['level'] == "admin") {
                                include "modul/kriteria/input_kriteria.php";
                            } else {
                                echo "<div class='text-center'><h1>ANDA TIDAK MEMILIKI AKSES KE HALAMAN INI!</h1>";
                                echo "<a href='?module=home' class='btn btn-danger align-items-center text-right'>Kembali</a></div><br>";
                            }
                            break;
                        case "input_nilai":
                            if (@$_SESSION['level'] == "admin") {
                                include "modul/nilai/input_nilai.php";
                            } else {
                                echo "<div class='text-center'><h1>ANDA TIDAK MEMILIKI AKSES KE HALAMAN INI!</h1>";
                                echo "<a href='?module=home' class='btn btn-danger align-items-center text-right'>Kembali</a></div><br>";
                            }
                            break;
                        case "input_user":
                            if (@$_SESSION['level'] == "admin") {
                                include "modul/user/input_user.php";
                            } else {
                                echo "<div class='text-center'><h1>ANDA TIDAK MEMILIKI AKSES KE HALAMAN INI!</h1>";
                                echo "<a href='?module=home' class='btn btn-danger align-items-center text-right'>Kembali</a></div><br>";
                            }
                            break;
                        case "edit_alternatif":
                            if (@$_SESSION['level'] == "admin") {
                                include "modul/alternatif/edit_alternatif.php";
                            } else {
                                echo "<div class='text-center'><h1>ANDA TIDAK MEMILIKI AKSES KE HALAMAN INI!</h1>";
                                echo "<a href='?module=home' class='btn btn-danger align-items-center text-right'>Kembali</a></div><br>";
                            }
                            break;
                        case "edit_kriteria":
                            if (@$_SESSION['level'] == "admin") {
                                include "modul/kriteria/edit_kriteria.php";
                            } else {
                                echo "<div class='text-center'><h1>ANDA TIDAK MEMILIKI AKSES KE HALAMAN INI!</h1>";
                                echo "<a href='?module=home' class='btn btn-danger align-items-center text-right'>Kembali</a></div><br>";
                            }
                            break;
                        case "edit_nilai":
                            if (@$_SESSION['level'] == "admin") {
                                include "modul/nilai/edit_nilai.php";
                            } else {
                                echo "<div class='text-center'><h1>ANDA TIDAK MEMILIKI AKSES KE HALAMAN INI!</h1>";
                                echo "<a href='?module=home' class='btn btn-danger align-items-center text-right'>Kembali</a></div><br>";
                            }
                            break;
                        case "waspas":
                            include "modul/waspas/waspas.php";
                            break;
                        case "edit_user":
                            if (@$_SESSION['level'] == "admin") {
                                include "modul/user/edit_user.php";
                            } else {
                                echo "<div class='text-center'><h1>ANDA TIDAK MEMILIKI AKSES KE HALAMAN INI!</h1>";
                                echo "<a href='?module=home' class='btn btn-danger align-items-center text-right'>Kembali</a></div><br>";
                            }
                            break;
                    }
                        ?>
                            </div>
                            <!---Container Fluid-->

                            <!-- Footer -->
                            <footer class="sticky-footer bg-white">
                                <div class="container my-auto">
                                    <div class="copyright text-center my-auto">
                                        <span>copyright &copy; <script>
                                                document.write(new Date().getFullYear());
                                            </script> - developed by
                                            <b>Chika Mulya Multimedia</a></b>
                                        </span>
                                    </div>
                                </div>
                            </footer>
                            <!-- Footer -->
                </div>
            </div>

            <!-- Scroll to top -->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <script src="assets/vendor/jquery/jquery.min.js"></script>
            <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
            <script src="assets/js/ruang-admin.min.js"></script>
            <script src="assets/vendor/chart.js/Chart.min.js"></script>
            <script src="assets/js/demo/chart-area-demo.js"></script>

            <script src="assets/vendor/jquery/jquery.min.js"></script>
            <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
            <script src="assets/js/ruang-admin.min.js"></script>
            <!-- Page level plugins -->
            <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
            <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
            <script src="assets/sweetalert2/sweetalert2.min.js"></script>

            <!-- Page level custom scripts -->
            <script>
                $(document).ready(function() {
                    $('#dataTable').DataTable(); // ID From dataTable 
                    $('#dataTableHover').DataTable(); // ID From dataTable with Hover
                });
            </script>

            <script>
                $(document).on('click', '#btn-hapus', function(e) {
                    e.preventDefault();
                    var link = $(this).attr('href');

                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Data akan dihapus!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Batal',
                        confirmButtonText: 'Ya, Hapus!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = link;
                        }
                    })
                })

                $(document).on('click', '#btn-logout', function(e) {
                    e.preventDefault();
                    var link = $(this).attr('href');

                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Anda akan logout!",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Batal',
                        confirmButtonText: 'Ya, Logout!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = link;
                        }
                    })
                })

                const flashdata = $('.flash-data').data('flashdata')
                if (flashdata) {
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data berhasil dihapus!',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    })
                }
            </script>
    </body>

    </html>
<?php
} else {
    header("location:index.php");
} ?>