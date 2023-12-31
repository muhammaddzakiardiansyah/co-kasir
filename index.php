<?php

session_start();

require_once "function.php";

if (!isset($_SESSION["akun-admin"])) {

    header("Location: login.php");

    exit;
}

?>

<?php if (isset($_SESSION["akun-admin"]) && cekTimeoutSesi($_SESSION["akun-admin"]["timestamp"])) : ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>
            <?php
            if (isset($_GET["data-barang"])) {
                echo 'Data Barang';
            } else if (isset($_GET["data-transaksi"])) {
                echo 'Data Transaksi';
            } else if (isset($_GET["transaksi"])) {
                echo 'Transaksi';
            } else {
                echo 'Kasir';
            }
            ?>
        </title>

        <!-- Custom fonts for this template-->
        <link href="src/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="src/css/sb-admin-2.min.css" rel="stylesheet">
        <script src="src/dist/sweetalert2.all.min.js"></script>

        <link rel="shortcut icon" href="src/img/emoji-laughing.svg" type="image/x-icon">

        <!-- php function -->
        <?php

        if (isset($_GET["data-barang"])) {
            $menu = ambil_data("SELECT * FROM menu");
        }

        if (isset($_GET["data-transaksi"])) {
            $menu = ambil_data("SELECT * FROM data_transaksi");
        }

        if (isset($_GET["transaksi"])) {

            $menu = ambil_data("SELECT * FROM transaksi ORDER BY waktu DESC LIMIT 1");
        } else if (isset($_GET["pesanan"])) {

            $menu = ambil_data("SELECT p.kode_pesanan, tk.nama_pelanggan, p.kode_menu, p.qty

                            FROM pesanan AS p

                            JOIN transaksi AS tk ON (tk.kode_pesanan = p.kode_pesanan)

                        ");
        } else {

            if (!isset($_GET["search"])) {

                $menu = ambil_data("SELECT * FROM menu ORDER BY kode_menu DESC");
            } else {

                $key_search = $_GET["key-search"];

                $menu = ambil_data("SELECT * FROM menu WHERE nama LIKE '%$key_search%' OR

                                                        harga LIKE '%$key_search%' OR

                                                        kategori LIKE '%$key_search%' OR

                                                        `status` LIKE '%$key_search%' OR

                                                        kode_menu LIKE '%$key_search%'

                                                        ORDER BY kode_menu DESC

            ");
            }
        }

        $categories = ambil_data("SELECT DISTINCT kategori FROM menu");

        ?>


    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <?php

            if (isset($_POST["pesan"])) {

                $pesanan = tambah_data_pesanan();

                echo $pesanan > 0

                    ? "<script>

                            location.href = 'index.php?transaksi'

                        </script>"

                    : "<script>

                                Swal.fire({
                                    title: 'Gagal Melakukan Pembayaran',
                                    text: 'Anda belum menginputkan barang!',
                                    icon: 'error'
                                });

                        </script>";
            }

            ?>

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">Co Kasir</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Kasir</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Interface
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Menu</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Data Menu :</h6>
                            <a class="collapse-item" href="index.php?transaksi">Transaksi</a>
                            <a class="collapse-item" href="index.php?data-barang">Data Barang</a>
                            <a class="collapse-item" href="index.php?data-transaksi">Data Transaksi</a>
                        </div>
                    </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Search -->
                        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="index.php" method="GET">
                            <div class="input-group">
                                <!-- <input type="text" autocomplete="off" name="key-search" class="form-control bg-light border-0 small" placeholder="Cari barang apa ?" aria-label="Search" aria-describedby="basic-addon2"> -->
                                <input list="menues" name="key-search" class="form-control bg-light border-0 small" id="key-search" placeholder="Cari barang apa ?" aria-label="Search" aria-describedby="basic-addon2">
                                <datalist id="menues">
                                    <?php foreach($categories as $category) : ?>
                                      <option value="<?= $category["kategori"] ?>">
                                    <?php endforeach; ?>
                                </datalist>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" name="search">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['akun-admin']['username'] ?></span>
                                    <img class="img-profile rounded-circle" src="src/img/undraw_profile.svg">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">
                                <?php
                                if (isset($_GET["data-barang"])) {
                                    echo 'Data Barang';
                                } else if (isset($_GET["data-transaksi"])) {
                                    echo 'Data Transaksi';
                                } else if (isset($_GET["transaksi"])) {
                                    echo 'Transaksi';
                                } else {
                                    echo 'Kasir';
                                }
                                ?>
                            </h1>
                            <?php
                            if (isset($_GET["data-barang"])) {
                                echo '<a href="tambah.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Tambah Barang</a>';
                            } else if (isset($_GET["data-transaksi"])) {
                                echo ' ';
                            } else if (isset($_GET["transaksi"])) {
                                echo ' ';
                            } else {
                                echo ' ';
                            }
                            ?>
                        </div>

                        <!-- main -->
                        <div class="container" style="z-index: -1; margin-top: 60px;">

                            <?php

                            if (isset($_GET["pesanan"])) include "halaman/pesanan.php";

                            else if (isset($_GET["transaksi"])) include "halaman/transaksi.php";

                            elseif (isset($_GET["data-barang"])) include "halaman/data-barang.php";

                            elseif (isset($_GET["data-transaksi"])) include "halaman/data-transaksi.php";

                            else include "halaman/beranda.php";

                            ?>

                        </div>


                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Co Kasir</span>
                            <span>Codepelita x Codeauthentic</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar ?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Semua perubahan akan tetap terssimpan.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <a class="btn btn-primary" href="logout.php">Ya</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->

        <script src="src/vendor/jquery/jquery.min.js"></script>
        <script src="src/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="src/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="src/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="src/vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="src/js/demo/chart-area-demo.js"></script>
        <script src="src/js/demo/chart-pie-demo.js"></script>

    </body>

    </html>

<?php else : ?>
    <?php
    // Menghapus sesi
    session_unset();
    session_destroy();
    // lempar ke page login
    header("Location: login.php");
    ?>
<?php endif; ?>