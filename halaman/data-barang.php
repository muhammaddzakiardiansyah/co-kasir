<!-- Menu Masakan -->

<div class="row">

    <?php

    $i = 1;

    $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);

    foreach ($menu as $m) { ?>

        <div class="col-sm-4 mx-auto m-2">

            <div class="card" style="width: 18rem;">

                <img src="src/img/<?= $m["gambar"]; ?>" class="card-img-top" alt="<?= $m["gambar"]; ?>">

                <input type="hidden" name="kode_menu<?= $i; ?>" value="<?= $m["kode_menu"]; ?>">

                <div class="card-body">

                    <h5 class="card-title"><?= $m["nama"]; ?></h5>
                    <p class="card-text"><strong>Kategoori : </strong><?= $m["kategori"]; ?></p>
                    <p class="card-text"><strong>Status : </strong><?= $m["status"]; ?></p>
                    <p class="card-text"><strong>Kode Menu : </strong><?= $m["kode_menu"]; ?></p>
                    <p class="card-text"><strong>Harga : </strong><?= $formatter->formatCurrency($m["harga"], 'IDR'); ?></p>
                    <a class="btn btn-sm btn-warning" title="Edit" href="edit.php?id_menu=<?= $m["id_menu"]; ?>">

                        <strong>Edit</strong>

                    </a>

                    <a class="btn btn-sm btn-danger" title="Hapus" href="hapus.php?id_menu=<?= $m["id_menu"]; ?>" onclick="return confirm('Ingin Menghapus Menu?')">

                        <strong>Hapus</strong>
                    </a>
                </div>

            </div>

        </div>

    <?php $i++;
    } ?>

</div>