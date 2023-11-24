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
                    </tr>
                </thead>
                <tbody>
                    <?php
                       $i = 1;
                       $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                       var_dump($menu, 'xixxixi')
                    ?>
                    <?php foreach($menu as $m) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $m["kode_pesanan"] ?></td>
                            <td><?= $m["nama_pelanggan"] ?></td>
                            <td><?= $m["nama_kasir"] ?></td>
                            <td><?= $m["tanggal_transaksi"] ?></td>
                            <td><?= $formatter->formatCurrency($m["total_belanja"], 'IDR'); ?></td>
                            <td><?= $formatter->formatCurrency($m["uang_bayar"], 'IDR'); ?></td>
                            <td><?= $formatter->formatCurrency($m["uang_kembalian"], 'IDR'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>