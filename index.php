<?php

    include 'services/config.php';
    session_start();

    if (isset($_POST['buttonLogin'])) {
            $login_problem = "";

            $username_login = mysqli_real_escape_string($conn, $_POST['usernameLogin']);
            $pass_login = mysqli_real_escape_string($conn, $_POST['passwordLogin']);

            $query_login = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username_login'");

            if ($row = mysqli_fetch_assoc($query_login)) {
                $hashedPass_db = $row['password'];

                if (password_verify($pass_login, $hashedPass_db)) {
                    $_SESSION['username'] = $username_login;
                    $_SESSION['is_login'] = true;

                    header('Location: admin/order.php');
                    exit;
                } else {
                    echo "Login Gagal";
                }
            } 
            else {
                echo "Login gagal";
                $login_problem = "Username or Pass wrong!";
            }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dishly | Welcome!</title>
    <link rel="icon" href="img/dishly_logo.png" type="image/icon type">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/style-login-dishly.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    },
                    fontFamily: {
                        poppins: 'Poppins',
                    }
                }
            }
        }
    </script>
</head>

 <body>
    <section class="login d-flex">

        <div class="login-left">
            <div class="service-badge">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="#e53935"/>
                </svg>
                <span>Food Ordering Service & Restaurant</span>
            </div>

            <div class="welcome-text text-left font-poppins">
                <h1 class="merkHeadin">DISHLY <br><span class="font-medium text-4xl">POINT OF SALE</span></h1>
                <p class="mt-3 font-normal">Dengan Dishly, kelola pesanan kamu menjadi lebih <br>mudah dengan bantuan manajemen Point of Sale.</p>
            </div>
        </div>

        <div class="login-right">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-6">
                    <div class="header">
                        <h1 class="font-semibold text-3xl">Selamat Datang! <span class="-mt-2">👋🏻</span></h1>
                        <p class="mt-3 mb-4 text-gray-500 font-light text-sm">Silahkan login untuk melakukan pengelolaan sistem order kamu.</p>
                    </div>

                    <div class="login-form">
                        <form action="" method="POST">
                            <label for="Username" class="form-label">Username</label>
                            <input type="text" name="usernameLogin" class="form-control inputfield text-sm" id="Username" placeholder="Masukkan username">
                        
                            <label for="Password" class="form-label">Password</label>
                            <input type="password" name="passwordLogin" class="form-control inputfield text-sm" id="Password" placeholder="Masukkan password">

                            <button type="submit" name="buttonLogin" class="btn btn-dark buttonMasuk font-medium">Masuk</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>