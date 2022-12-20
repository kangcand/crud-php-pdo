<?php
require_once './library/Connection.php';

// mulai sesi
session_start();

// cek apakah pengguna sudah masuk
if (isset($_SESSION['user_id']) || isset($_COOKIE['user_id'])) {
    // redirect ke dashboard
    header('Location: dashboard/index.php');
    exit;
}

// cek apakah form login sudah dikirim
if (isset($_POST['submit'])) {
    // ambil nama pengguna dan kata sandi dari form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // koneksi
    $db = new Connection();
    $conn = $db->connect();

    // login
    $login = new Login($conn);
    $result = $login->login($username, $password);

    // cek apakah pengguna ada
    if ($result->rowCount() == 1) {
        // ambil data pengguna
        $user = $result->fetch();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['name'] = $user['name'];

        // set cookie
        setcookie('user_id', $user['id'], time() + (86400 * 1), "/"); // 86400 = 1 hari

        // redirect ke dashboard
        header('Location: dashboard/index.php');
        exit;
    } else {
        // login gagal
        $error = "Nama pengguna atau kata sandi salah";
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap 5 Login Form Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                    <div class="text-center my-5">
                        <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo"
                            width="100">
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class=" needs-validation"
                                novalidate="" autocomplete="off">
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="username">Username</label>
                                    <input id="username" type="text" class="form-control" name="username" value=""
                                        required autofocus>
                                    <div class=" invalid-feedback">
                                        Username is invalid
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 w-100">
                                        <label class="text-muted" for="password">Password</label>
                                        <a href="#" class="float-end">
                                            Forgot Password?
                                        </a>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    <div class="invalid-feedback">
                                        Password is required
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="form-check">
                                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                        <label for="remember" class="form-check-label">Remember Me</label>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary ms-auto">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer py-3 border-0">
                            <div class="text-center">
                                Don't have an account? <a href="#" class="text-dark">Create One</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-5 text-muted">
                        Copyright &copy; <a id="cp"></a> &mdash; Candra Herdiansyah
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
    <script>
        document.getElementById("cp").innerHTML = new Date().getFullYear();
    </script>
</body>

</html>