<?php

    include "../layout/header.php";

    $_SESSION['title'] = 'Dishly | Tambah User';

    $message = "";
    $error = null;

    if(isset($_POST['button_addUser'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $safe_password = password_hash($password, PASSWORD_DEFAULT);

        $query = mysqli_query($conn, "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$safe_password')");

        if($query) {
            $error = False;
            $message = "Berhasil menambahkan User! Silahkan kembali ke halaman sebelumnya.";
        } else {
            $error = True;
            $message = "Gagal menambahkan User! Coba lagi.";
        }
    }

?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800 font-bold">Tambah Data Karyawan</h1>
                    <p class="mb-4">Isi data dibawah ini dengan benar untuk menambahkan data Karyawan baru.</p>

                    <?php if ($error !== null) { ?>
                        <div class="alert <?php echo $error ? 'alert-warning' : 'alert-primary'; ?>" role="alert">
                            <?php echo $message ?>
                        </div>
                    <?php } ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="text-secondary font-semibold mt-2">User Form</h5>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form method="POST" action="">
                                    <div class="mb-3 col-sm-6">
                                        <label for="exampleInputUsername1" class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control rounded-full py-3.5" id="exampleInputUsername1" aria-describedby="usernameHelp" required>
                                    </div>
                                    <div class="mb-3 col-sm-6">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control rounded-full py-3.5" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                    </div>
                                    <div class="mb-3 col-sm-6">
                                        <label for="exampleInputPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control rounded-full py-3.5" id="exampleInputPassword" aria-describedby="passwordHelp" required>
                                    </div>
                                    <button type="submit" name="button_addUser" class="mr-1 mt-2 btn btn-warning btn-sm px-4 py-2 rounded-full ml-3">Tambah</button>
                                    <a href="users.php" class="mt-2 d-none d-sm-inline-block btn btn-sm btn-outline-secondary px-4 py-2 rounded-full">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<?php include "../layout/footer.php" ?>