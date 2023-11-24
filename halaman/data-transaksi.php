<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
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
                    $dataTransaksi = ambil_data("SELECT * FROM data_transaksi");
                    $i = 1;
                    $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                    ?>
                    <?php foreach ($dataTransaksi as $dt) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $dt["kode_pesanan"] ?></td>
                            <td><?= $dt["nama_pelanggan"] ?></td>
                            <td><?= $dt["nama_kasir"] ?></td>
                            <td><?= $dt["tanggal_transaksi"] ?></td>
                            <td><?= $formatter->formatCurrency($dt["total_belanja"], 'IDR'); ?></td>
                            <td><?= $formatter->formatCurrency($dt["uang_bayar"], 'IDR'); ?></td>
                            <td><?= $formatter->formatCurrency($dt["uang_kembalian"], 'IDR'); ?></td>
                            <td class="d-flex">
                                <button class="btn btn-primary mr-2">Cetak</button>

                                <a class="btn btn-danger" href="hapus.php?kode_pesanan=<?= $dt["kode_pesanan"]; ?>" onclick="return confirm('Hapus Data Transaksi?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>