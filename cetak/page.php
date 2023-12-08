<?php 
require_once "../function.php";

$kode = $_GET["kode_pesanan"];
$menu = ambil_data("SELECT DISTINCT * FROM pesanan 
                    JOIN transaksi ON (pesanan.kode_pesanan = transaksi.kode_pesanan) 
                    JOIN menu ON (menu.kode_menu = pesanan.kode_menu) 
                    JOIN data_transaksi ON (data_transaksi.kode_pesanan = transaksi.kode_pesanan)
                    WHERE transaksi.kode_pesanan = '$kode'
");
$formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $menu[0]["nama_pelanggan"]; ?></title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        .container {
            width: 60vw;
            margin: 50px auto;
            position: relative;
        }
        .daftar-pesanan, .daftar-pesanan tr > td, .daftar-pesanan tr > th {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }

        .pembayaran tr > th {
            text-align: start;
        }

        .pembayaran {
            float: right;
        }
        p {
            margin-bottom: 50px;
        }
        .ttd {
            margin-top: 90px;
            width: 100px;
            position: absolute;
            right: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 align="center">Bukti Pembayaran</h1>
        <p align="center">Koperasi 54 - SMK Syafi'i Akrom Kota Pekalongan</p>
        <table class="data-pelanggan">
            <tr>
                <td>Atas Nama</td>
                <td>:</td>
                <td><?= $menu[0]["nama_pelanggan"]; ?></td>
            </tr>
            <tr>
                <td>Nama Kasir</td>
                <td>:</td>
                <td><?= $menu[0]["nama_kasir"]; ?></td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td>:</td>
                <td><?= $menu[0]["tanggal_transaksi"]; ?></td>
            </tr>
        </table><br>
        <table class="daftar-pesanan" cellpadding="5">
            <tr>
                <th>Daftar Menu</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
            <?php 
            $total_semuanya = 0;
            foreach ($menu as $m) { ?>
                <tr>
                    <td><?= $m["nama"]; ?></td>
                    <td><?= $formatter->formatCurrency($m["harga"], 'IDR'); ?></td>
                    <td><?= $m["qty"]; ?></td>
                    <td><?= $formatter->formatCurrency($m["harga"] * $m["qty"], 'IDR'); ?></td>
                </tr>
            <?php  
            } ?>
        </table><br>
        <table class="pembayaran" cellpadding="3">
            <tr>
                <th>Total Semuanya</th>
                <th>:</th>
                <th><?= $formatter->formatCurrency($menu[0]["total_bayar"], 'IDR'); ?></th>
            </tr>
            <tr>
                <th>Uang Bayar</th>
                <th>:</th>
                <th><?= $formatter->formatCurrency($menu[0]["uang_bayar"], 'IDR'); ?></th>
            </tr>
            <tr>
                <th>Uang Kembalian</th>
                <th>:</th>
                <th><?= $formatter->formatCurrency($menu[0]["uang_kembalian"], 'IDR'); ?></th>
            </tr>
        </table>
        <div class="ttd">
            <h6 align="center">TTD Kasir</h6>
            <h4 align="center"><?= $menu[0]["nama_kasir"] ?></h4>
        </div>
    </div>
</body>
</html>