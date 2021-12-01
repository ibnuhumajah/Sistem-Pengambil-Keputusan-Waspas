<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="assets/img/logo/logo4.png" rel="icon">
    <title>Waspas Chika - Login</title>
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/ruang-admin.min.css" rel="stylesheet">
    <link href="assets/sweetalert2/sweetalert2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-login">
    <!-- Login Content -->
    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <img style="width: 200px;" src="assets/img/logo/logo4.png">
                                        <h3 class="text-gray-900">Login</h3>
                                        <h2 class="text-gray-900">Waspas Chika</h2>
                                    </div>
                                    <form action="cek_login.php" method="post">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control" id="exampleInputEmail" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                                        </div>
                                    </form>
                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="assets/js/ruang-admin.min.js"></script>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="assets/sweetalert2/sweetalert2.min.js"></script>

    <script>
        var flasht = $('#flash');
        if (flasht) {
            setTimeout(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Login!',
                    text: 'Username atau Password salah',
                    timer: 3000,
                    showConfirmButton: false
                });
            }, 10)
            window.setTimeout(function() {
                window.location = 'index.php';
            }, 3000);
        }
    </script>
</body>

</html>