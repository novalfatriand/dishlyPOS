<?php

    include "../layout/header.php";

    $_SESSION['title'] = 'Dishly | Order Status';

    if (isset($_POST['update_status'])) {
        $id_order = $_POST['id_order'];
        $new_status = $_POST['status'];

        $update = mysqli_query($conn, "UPDATE orders SET status = '$new_status' WHERE id_order = '$id_order'");

        if ($update) {
            echo "<script>indow.location.href='status.php';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui status');</script>";
        }
    }

    
    $delete_messageOrders = "";
    $delete_errorOrders = null;

    if(isset($_GET['delete_order'])) {
        $id_deleteOrder = $_GET['delete_order'];
        $delete_orders = mysqli_query($conn, "DELETE FROM orders WHERE id_order = '$id_deleteOrder'");
        
        if($delete_orders) {
            $delete_errorOrders = False;
            $delete_messageOrders = "Berhasil menghapus data Order!";
        } else {
            $delete_errorOrders = True;
            $delete_messageOrders = "Gagal menghapus data Order! Coba lagi.";
        }
    }

?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800 font-semibold">Order Status</h1>
                    <p class="mb-4">Kelola status Order.</p>


                            <?php if ($delete_errorOrders !== null) { ?>
                                <div class="alert <?php echo $delete_errorOrders ? 'alert-warning' : 'alert-primary'; ?>" role="alert">
                                    <?php echo $delete_messageOrders ?>
                                </div>
                            <?php } ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="flex flex-row">
                            <div class="col-md-8">
                                <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Order No.</th>
                                                <th>Atas Nama</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $data_orders = mysqli_query($conn, "SELECT * FROM orders");
                                            while ($row_order = mysqli_fetch_assoc($data_orders)) { 
                                                ?>
                                                <tr class="font-light">
                                                    <td><?= $row_order['id_order'] ?></td>
                                                    <td><?= $row_order['name'] ?></td>
                                                    <td>
                                                        <?php
                                                            $status = $row_order['status'];
                                                            $btn_class = "secondary";
                                                            if ($status == "Calling") $btn_class = "warning";
                                                            elseif ($status == "Done") $btn_class = "success";
                                                        ?>
                                                        <button class="btn btn-sm btn-<?= $btn_class ?>"><?= $status ?></button>
                                                    </td>
                                                    <td>
                                                        <form action="status.php" method="POST" style="display:inline;">
                                                            <input type="hidden" name="id_order" value="<?= $row_order['id_order'] ?>">
                                                            <input type="hidden" name="status" value="On Progress">
                                                            <button type="submit" name="update_status" class="btn btn-sm btn-outline-secondary">On Progress</button>
                                                        </form>
                                                        <form action="status.php" method="POST" style="display:inline;">
                                                            <input type="hidden" name="id_order" value="<?= $row_order['id_order'] ?>">
                                                            <input type="hidden" name="status" value="Calling">
                                                            <button type="submit" name="update_status" class="btn btn-sm btn-outline-warning">Calling</button>
                                                        </form>
                                                        <form action="status.php" method="POST" style="display:inline;">
                                                            <input type="hidden" name="id_order" value="<?= $row_order['id_order'] ?>">
                                                            <input type="hidden" name="status" value="Done">
                                                            <button type="submit" name="update_status" class="btn btn-sm btn-outline-success">Done</button>
                                                        </form>
                                                        <a href="status.php?delete_order=<?php echo $row_order['id_order'] ?>" class="btn btn-outline-danger btn-sm">Hapus</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>

                            <div class="flex-col col-md-4">
                            <div class="">
                                <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Order No.</th>
                                                <th>Atas Nama</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $data_orders = mysqli_query($conn, "SELECT * FROM orders WHERE status = 'Calling'");
                                            while ($row_order = mysqli_fetch_assoc($data_orders)) { 
                                                ?>
                                                <tr class="font-light">
                                                    <td><?= $row_order['id_order'] ?></td>
                                                    <td><?= $row_order['name'] ?></td>
                                                    <td>
                                                        <?php
                                                            $status = $row_order['status'];
                                                            $btn_class = "secondary";
                                                            if ($status == "Calling") $btn_class = "warning";
                                                            elseif ($status == "Done") $btn_class = "success";
                                                        ?>
                                                        <button class="btn btn-sm btn-<?= $btn_class ?>"><?= $status ?></button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>

                            <h2 class="mt-2 text-gray-700 font-medium">Order Selesai</h2>
                            <div class="">
                                <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Order No.</th>
                                                <th>Atas Nama</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $data_orders = mysqli_query($conn, "SELECT * FROM orders WHERE status = 'Done'");
                                            while ($row_order = mysqli_fetch_assoc($data_orders)) { 
                                                ?>
                                                <tr class="font-light">
                                                    <td><?= $row_order['id_order'] ?></td>
                                                    <td><?= $row_order['name'] ?></td>
                                                    <td>
                                                        <?php
                                                            $status = $row_order['status'];
                                                            $btn_class = "secondary";
                                                            if ($status == "Calling") $btn_class = "warning";
                                                            elseif ($status == "Done") $btn_class = "success";
                                                        ?>
                                                        <button class="btn btn-sm btn-<?= $btn_class ?>" disabled><?= $status ?></button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                            </div>

                        </div>
                            

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<?php include "../layout/footer.php" ?>