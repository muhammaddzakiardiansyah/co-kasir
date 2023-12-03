<?php

require_once(__DIR__ . '/../function.php');


if (isset($_POST["tambah_transaksi"])) {

    $tambah = tambah_data_transaksi();

    echo $tambah > 0
        ? "<script>
            Swal.fire({
                title: 'Transaksi Berhasil!',
                text: 'Transaksi Berhasil Dilakukan',
                icon: 'success'
            }).then(function() {
                window.location.href = 'index.php';
            });
       </script>"
        : "<script>
            Swal.fire({
                title: 'Transaksi Gagal!',
                text: 'Gagal',
                icon: 'error'
            });
       </script>";

    // Pastikan untuk menghentikan eksekusi setelah mengirimkan skrip JavaScript
    exit();
}

?>

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
                        <th>Total Harga</th>
                        <th>Uang Bayar</th>
                        <th>Uang Kembalian</th>
                        <th>Alat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($menu as $m) {
                        $kode_pesanan = $m["kode_pesanan"];
                        $total_pembayaran = ambil_data("SELECT DISTINCT * FROM pesanan
                                                        JOIN transaksi ON (pesanan.kode_pesanan = transaksi.kode_pesanan)
                                                        JOIN menu ON (menu.kode_menu = pesanan.kode_menu)
                                                        WHERE transaksi.kode_pesanan = '$kode_pesanan'");
                    ?>
                        <form method="POST">

                            <tr>
                                <td><?= $i ?></td>
                                <td><input type="text" name="kode_pesanan" value="<?= $m["kode_pesanan"]; ?>" required></td>
                                <td><input type="text" name="nama_pelanggan" value="<?= $m["nama_pelanggan"]; ?>" required></td>
                                <td><input type="text" name="nama_kasir" value="<?= $m["nama_kasir"]; ?>" required></td>
                                <td><input type="text" name="tanggal_transaksi" value="<?= date("d F Y", strtotime($m["waktu"])); ?>" required></td>
                                <td>
                                    <?php
                                    $total = 0;
                                    foreach ($total_pembayaran as $tp) {
                                        $total += $tp["qty"] * $tp["harga"];
                                    }
                                    ?>
                                    <input type="text" name="total_bayar" value="<?= $total; ?>" required>
                                </td>
                                <td><input name="uang_bayar" placeholder="angka" min="0" type="number" required></td>
                                <td><input type="number" min="0" placeholder="angka" name="uang_kembalian" required></td>
                                <td>
                                    <button class="btn btn-primary btn-sm" name="tambah_transaksi"><strong>Bayar</strong></button>
                                </td>
                            </tr>
                        </form>
                    <?php $i++;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>