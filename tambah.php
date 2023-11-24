<?php

session_start();

require_once "function.php";

if (!isset($_SESSION["akun-admin"])) {
    if (isset($_SESSION["akun-user"])) {
        echo "<script>
            alert('Tambah data hanya berlaku untuk admin!');
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

    <div class="container">

        <h1>Tambah Data Masakan</h1>

        <a class="btn btn-success fw-bold" href="index.php">Kembali</a>

        <form action="tambah.php" method="POST" enctype="multipart/form-data">

            <div class="table-responsive-md my-3">

                <table class="table">

                    <tr>

                        <td><label for="nama">Nama Makanan</label></td>

                        <td>:</td>

                        <td><input autocomplete="off" type="text" name="nama" id="nama" required></td>

                    </tr>

                    <tr>

                        <td><label for="harga">Harga</label></td>

                        <td>:</td>

                        <td><input min="0" type="number" name="harga" id="harga" required></td>

                    </tr>

                    <tr>

                        <td><label for="gambar">Gambar</label></td>

                        <td>:</td>

                        <td>

                            <input type="file" name="gambar" accept="image/*" required>

                        </td>

                    </tr>

                    <tr>

                        <td><label for="kategori">Kategori</label></td>

                        <td>:</td>

                        <td>

                            <select name="kategori" id="kategori">

                                <option selected value="Makanan">Makanan</option>

                                <option value="Fast Food">Fast Food</option>

                                <option value="Snack">Snack</option>

                                <option value="Dessert">Dessert</option>

                                <option value="Minuman">Minuman</option>

                            </select>

                        </td>

                    </tr>

                    <tr>

                        <td><label for="status">Status</label></td>

                        <td>:</td>

                        <td>

                            <label for="tersedia"><input type="radio" name="status" id="tersedia" value="tersedia" checked>Tersedia</label>

                            <label for="tidak-tersedia"><input type="radio" name="status" id="tidak-tersedia" value="tidak tersedia">Tidak Tersedia</label>

                        </td>

                    </tr>

                    <tr>

                        <td></td>

                        <td></td>

                        <td><button class="btn btn-primary" name="tambah">Tambah</button></td>

                    </tr>

                </table>

            </div>

        </form>

    </div>

    <div class="container p-5 rounded-5 bg-info">
        <form action="">
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label fw-bold">Nama Makanan</label>
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder">
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label fw-bold">Harga</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input placeholder">
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label fw-bold">Gambar</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input placeholder">
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label fw-bold">Kategori</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input placeholder">
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label fw-bold">Status</label>
                <div class="d-flex gap-5">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label fw-bold" for="flexRadioDefault1">
                            Tersedia
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                        <label class="form-check-label fw-bold" for="flexRadioDefault2">
                            Tidak Tersedia
                        </label>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="./src/css/bootstrap-5.2.0/js/bootstrap.min.js"></script>

</body>



</html>