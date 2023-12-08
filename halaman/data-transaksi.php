<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
        <form action="" method="POST" class="d-flex align-items-center">
            <input type="month" class="rounded-2 form-control mr-2" name="month_s">
            <button type="submit" class="btn btn-primary btn-sm" name="month">Go</button>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Pesanan</th>
                            <th>Nama Pelanggan</th>
                            <th>Nama Kasir</th>
                            <th>Tanggal Transaksi</th>
                            <th>Total Belanja</th>
                            <th>Uang Bayar</th>
                            <th>Uang Kembalian</th>
                            <th>Alat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!isset($_POST["month"])) {
                            $dataTransaksi = ambil_data("SELECT * FROM data_transaksi
                                WHERE MONTH(created_at) = MONTH(CURRENT_DATE())
                                ORDER BY created_at DESC");
                        } else {
                            $month = $_POST["month_s"];
                            // Validasi dan konversi tanggal jika diperlukan
                            $validatedMonth = date('Y-m-d', strtotime($month));
                            // Pastikan $validatedMonth adalah string yang valid, misalnya "YYYY-MM"
                            // Selain itu, lakukan sanitasi nilai untuk menghindari SQL injection
                            $query = "SELECT * FROM data_transaksi
                                WHERE MONTH(created_at) = MONTH('$validatedMonth')
                                ORDER BY created_at DESC";

                            $dataTransaksi = ambil_data($query);
                        }
                        $i = 1;
                        $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                        foreach ($dataTransaksi as $dt) :
                        ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $dt["kode_pesanan"] ?></td>
                                <td><?= $dt["nama_pelanggan"] ?></td>
                                <td><?= $dt["nama_kasir"] ?></td>
                                <td><?= $dt["tanggal_transaksi"] ?></td>
                                <td><?= $formatter->formatCurrency($dt["total_bayar"], 'IDR'); ?></td>
                                <td><?= $formatter->formatCurrency($dt["uang_bayar"], 'IDR'); ?></td>
                                <td><?= $formatter->formatCurrency($dt["uang_kembalian"], 'IDR'); ?></td>
                                <td class="d-flex">
                                    <a class="btn btn-primary mr-2" href="cetak/cetak.php?kode_pesanan=<?= $dt["kode_pesanan"] ?>">Cetak</a>
                                    <a class="btn btn-danger" href="hapus.php?kode_pesanan=<?= $dt["kode_pesanan"]; ?>" onclick="return confirm('Hapus Data Transaksi?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        </div>
    </div>
    <div class="container-fluid mb-5 mt-5">
        <?php
        // data pendapatan hari ini
        $dataHariIni = ambil_data("SELECT SUM(total_bayar) AS total_value
          FROM data_transaksi
          WHERE DATE(created_at) = CURDATE();
          ");
        // data pendapatan minggu ini
        $dataMingguIni = ambil_data("SELECT SUM(total_bayar) AS total_value
          FROM data_transaksi
          WHERE YEARWEEK(created_at) = YEARWEEK(NOW());
          ");
        // data pendapatan bulan ini
        $dataBulanIni = ambil_data("SELECT SUM(total_bayar) AS total_value
          FROM data_transaksi
          WHERE YEAR(created_at) = YEAR(NOW()) AND MONTH(created_at) = MONTH(NOW());
          ");
        ?>
        <div class="row mx-auto">
            <div class="col-md-3 mx-auto">
                <div class="card border-left-success">
                    <div class="card-statistic-3 p-4">
                        <div class="mb-4">
                            <h5 class="card-title mb-0">Pendapatan Hari Ini</h5>
                        </div>
                        <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                                <h4 class="d-flex align-items-center mb-0">
                                <?= $dataHariIni[0]["total_value"] ? $formatter->formatCurrency($dataHariIni[0]["total_value"], 'IDR') : 'Rp 0,00' ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mx-auto">
                <div class="card border-left-warning">
                    <div class="card-statistic-3 p-4">
                        <div class="mb-4">
                            <h5 class="card-title mb-0">Pendapatan Minggu Ini</h5>
                        </div>
                        <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                                <h4 class="d-flex align-items-center mb-0">
                                <?= $dataMingguIni[0]["total_value"] ? $formatter->formatCurrency($dataMingguIni[0]["total_value"], 'IDR') : '0' ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mx-auto">
                <div class="card border-left-info">
                    <div class="card-statistic-3 p-4">
                        <div class="mb-4">
                            <h5 class="card-title mb-0">Pendapatan Bulan Ini</h5>
                        </div>
                        <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                                <h4 class="d-flex align-items-center mb-0">
                                <?= $dataBulanIni[0]["total_value"] ? $formatter->formatCurrency($dataBulanIni[0]["total_value"], 'IDR') : '0' ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>