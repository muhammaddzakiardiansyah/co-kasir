<?php

session_start();

require_once "function.php";

if (!isset($_SESSION["akun-admin"])) {
    if (isset($_SESSION["akun-user"])) {
        echo "<script>
            alert('Tambah data hanya berlaku untuk admin');
            location.href = 'index.php';
        </script>";
    } else {
        header("Location: login.php");
        exit;
    }
}



if (isset($_POST["tambah"])) {

    $tambah = tambah_data_menu();

    echo $tambah > 0

        ? "<script>

        alert('Data berhasil ditambah!');

        location.href = 'index.php';

    </script>"

        : "<script>

        alert('Data gagal ditambah!');

        location.href = 'index.php';

    </script>";
}

?>

<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./src/css/bootstrap-5.2.0/css/bootstrap.min.css">


    <title>Tambah Data</title>

</head>



<body>

    <div class="container p-5 my-3 rounded-5 border">
        <h2 class="mb-4 fw-bold">Tambah Data Barang</h2>
        <form action="tambah.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama" class="form-label fw-bold">Nama Makanan</label>
                <input type="text" autocomplete="off" class="form-control" id="nama" name="nama" placeholder="Masukan nama barang" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label fw-bold">Harga</label>
                <input type="number" autocomplete="off" min="0" class="form-control" id="harga" name="harga" placeholder="Masukan harga" required>
            </div>
            <div class="mb-3">
                <label for="gambar" autocomplete="off" class="form-label fw-bold">Gambar</label>
                <input type="file" class="form-control" name="gambar" accept="image/*" id="gambar" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label fw-bold">Kategori</label>
                <input list="kategories" name="Kategori" class="form-control" placeholder="Masukan Kategori" id="kategori" required>
                <datalist id="kategories">
                    <option value="Makanan">
                    <option value="Minuman">
                    <option value="Snek">
                </datalist>
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label fw-bold">Status</label>
                <div class="d-flex gap-5">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="tersedia" checked>
                        <label class="form-check-label fw-bold" for="tersedia">
                            Tersedia
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="tidak_tersedia">
                        <label class="form-check-label fw-bold" for="tidak_tersedia">
                            Tidak Tersedia
                        </label>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary mt-4" name="tambah">Simpan</button>
            <button type="reset" class="btn btn-warning mt-4 text-white">Reset</button>
            <button class="btn btn-success mt-4"><a class="text-decoration-none text-white" href="index.php?data-barang">Kembali</a></button>
        </form>
    </div>

    <script src="./src/css/bootstrap-5.2.0/js/bootstrap.min.js"></script>

</body>



</html>