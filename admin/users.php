<?php

    include "../layout/header.php";

    $_SESSION['title'] = 'Dishly | Users';


    $delete_message = "";
    $delete_error = null;

    if(isset($_GET['delete_user'])) {
        $id_deleteUser = $_GET['delete_user'];
        $delete_user = mysqli_query($conn, "DELETE FROM users WHERE id_user = '$id_deleteUser'");
        
        if($delete_user) {
            $delete_error = False;
            $delete_message = "Berhasil menghapus data User!";
        } else {
            $delete_error = True;
            $delete_message = "Gagal menghapus data User! Coba lagi.";
        }
    }

?>    
                
                <div class="container-fluid">

                    <h1 class="h3 mb-2 text-gray-800 font-semibold">Karyawan</h1>
                    <p class="mb-4">Sistem pengelolaan Karyawan.</p>

                    <?php if ($delete_error !== null) { ?>
                        <div class="alert <?php echo $delete_error ? 'alert-warning' : 'alert-primary'; ?>" role="alert">
                            <?php echo $delete_message ?>
                        </div>
                    <?php } ?>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="tambah-users.php" class="d-none d-sm-inline-block btn btn-sm btn-warning rounded-full px-3 py-1.5">Tambah Data</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Created</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $data_users = mysqli_query($conn, "SELECT * FROM users");
                                        $angka_users = 1;
                                        while ($user = mysqli_fetch_assoc($data_users)) { ?>
                                            <tr class="font-light">
                                                <td><?php echo $angka_users++ ?></td>
                                                <td><?php echo $user['username'] ?></td>
                                                <td><?php echo $user['email'] ?></td>
                                                <td><?php echo $user['created_at'] ?></td>
                                                <td>
                                                    <a href="edit-users.php?edit=<?php echo $user['id_user'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                                    <a href="users.php?delete_user=<?php echo $user['id_user'] ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<?php include "../layout/footer.php" ?>