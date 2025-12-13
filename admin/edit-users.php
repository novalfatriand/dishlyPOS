<?php

    include "../layout/header.php";

    $_SESSION['title'] = 'Dishly - Edit User';


    if(isset($_GET['edit'])) {
        $id = $_GET['edit'];
        
        $data_users = mysqli_query($conn, "SELECT * FROM users WHERE id_user = '$id'");
        $user = mysqli_fetch_assoc($data_users);

    }


    $update_message = "";
    $update_error = null;

    if(isset($_POST['button_updateUser'])) {
        $update_username = $_POST['username'];
        $update_email = $_POST['email'];

        $update_dataUser = mysqli_query($conn, "UPDATE users SET username = '$update_username', email = '$update_email' WHERE id_user = '$id'");

        if($update_dataUser) {
            echo "
                    <script>
                        window.location.href = 'users.php';
                    </script>
                ";
        } else {
            $update_error = True;
            $update_message = "Gagal melakukan edit! Coba lagi.";
        }
    }

?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800 font-bold">Edit Data Karyawan</h1>
                    <p class="mb-4">Edit isi form dibawah ini dengan benar, kemudian lakukan Update untuk memperbarui data Karyawan.</p>

                            <?php if ($update_error !== null) { ?>
                                <div class="alert <?php echo $update_error ? 'alert-warning' : 'alert-primary'; ?>" role="alert">
                                    <?php echo $update_message ?>
                                </div>
                            <?php } ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="text-secondary font-semibold mt-2">Form Edit User</h5>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form method="POST" action="">

                                    <div class="mb-3 col-sm-6">
                                        <label for="exampleInputUsername1" class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control rounded-full py-3.5" id="exampleInputUsername1" aria-describedby="usernameHelp" value="<?php echo $user['username'] ?>" required>
                                    </div>
                                    <div class="mb-3 col-sm-6">
                                        <label for="exampleInputEmail" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control rounded-full py-3.5" id="exampleInputEmail" aria-describedby="emailHelp" value="<?php echo $user['email'] ?>" required>
                                    </div>
                                    <div class="mb-3 col-sm-6">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="text" name="password" class="form-control rounded-full py-3.5" id="exampleInputPassword1" aria-describedby="passwordHelp" value="Password tidak bisa diubah." disabled>
                                    </div>
                                    <button type="submit" name="button_updateUser" class="mr-1 mt-2 btn btn-warning btn-sm px-4 py-2 rounded-full ml-3">Update</button>
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