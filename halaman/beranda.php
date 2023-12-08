<!-- Pemesanan -->

<form action="index.php" method="POST">

    <div class="d-flex mb-4">
        <input class="form-control mx-sm-2 my-2 w-auto" type="text" name="pelanggan" placeholder="Nama Pelanggan" required autocomplete="off">
        <input class="form-control mx-sm-2 my-2 w-auto" type="text" name="nama_kasir" placeholder="Nama Kasir" required autocomplete="off">

        <button class="btn btn-primary my-2 mx-2" name="pesan">Pembayaran</button>

    </div>

    <!-- Menu Masakan -->

    <div class="row">

        <?php

        $i = 1;

        $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);

        foreach ($menu as $m) { ?>

            <div class="row mx-auto mb-2">

                <div class="col-sm-4">
        
                    <div class="card" style="width: 14rem;">
        
                        <input type="hidden" name="kode_menu<?= $i; ?>" value="<?= $m["kode_menu"]; ?>">
        
                        <div class="card-body">
        
                            <h5 class="card-title"><?= $m["nama"]; ?></h5>
        
                            <p class="card-text">Harga : <?= $formatter->formatCurrency($m["harga"], 'IDR'); ?></p>
        
                            <p class="card-text">Jumlah beli / pcs : <input class="form-control" min="0" type="number" name="qty<?= $i; ?>"></p>
        
                        </div>
        
                    </div>
        
                </div>

            </div>

        <?php $i++;
        } ?>
    

</form>

</div>