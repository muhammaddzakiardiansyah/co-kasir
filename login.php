<?php

session_start();

require_once "function.php";


// cek ketika submit
if (isset($_POST["login"])) {
    $login = login_akun();
} 

?>
<!-- main -->
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">


    <title>Login Admin</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="src/css/bootstrap-icons-1.8.3/bootstrap-icons.css">
    <link rel="shortcut icon" href="src/img/emoji-laughing.svg" type="image/x-icon">
    <!-- sweet alert -->
    <script src="src/dist/sweetalert2.all.min.js"></script>

    <!-- Custom styles for this template-->
    <link href="src/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <!-- Jika Username & Password Login Salah -->

            <?php if (isset($_POST["login"])) {
                if (!$login) {
                    echo "<script>
                    Swal.fire({
                        title: 'Gagal Masuk!',
                        text: 'Username / Password Salah!',
                        icon: 'error'
                    });
                </script>";
                };
            } ?>

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang Kembali!</h1>
                                    </div>
                                    <form class="user" action="login.php" method="POST">
                                        <div class="form-group">
                                            <input type="text" name="username" autocomplete="off" class="form-control form-control-user" id="username" aria-describedby="username" placeholder="Masukan Username...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Masukan Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" name="remember-me" class="custom-control-input" id="customCheck">
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" name="login">Login</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <p class="small">Jika ingin membuat akun hubungi developer.</p>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="https://wa.me/62895632506450" target="_blank">Klik untuk hubungi developer</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
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

</body>

</html>