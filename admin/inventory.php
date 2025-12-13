<?php

    include "../layout/header.php";

    $_SESSION['title'] = 'Dishly | Inventory';

    $delete_message = "";
    $delete_error = null;

    if(isset($_GET['delete'])) {
        $id_deleteProduct = $_GET['delete'];
        $delete_product = mysqli_query($conn, "DELETE FROM products WHERE id_product = '$id_deleteProduct'");
        
        if($delete_product) {
            $delete_error = False;
            $delete_message = "Berhasil menghapus data Product!";
        } else {
            $delete_error = True;
            $delete_message = "Gagal menghapus data Product! Coba lagi.";
        }
    }

?>    
                
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800 font-semibold">Daftar Inventory Produk</h1>
                    <p class="mb-4">Pengelolaan inventory Dishly.</p>

                    <?php if ($delete_error !== null) { ?>
                        <div class="alert <?php echo $delete_error ? 'alert-warning' : 'alert-primary'; ?>" role="alert">
                            <?php echo $delete_message ?>
                        </div>
                    <?php } ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="tambah-inventory.php" class="d-none d-sm-inline-block btn btn-sm btn-warning rounded-full px-3 py-1.5">Tambah Produk</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Harga</th>
                                            <th>Category</th>
                                            <th>Stock</th>
                                            <th>Gambar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $data_products = mysqli_query($conn, "SELECT * FROM products");
                                        $angka_products = 1;
                                        while ($product = mysqli_fetch_assoc($data_products)) {
                                            $id_cat = $product['id_category']; 
                                            $data_category = mysqli_query($conn, "SELECT nama_category FROM category WHERE id_category = '$id_cat'");
                                            $nama_cat = mysqli_fetch_assoc($data_category);
                                            ?>
                                            <tr>
                                                <td><?php echo $angka_products++ ?></td>
                                                <td><?php echo $product['name'] ?></td>
                                                <td>Rp <?php echo number_format($product['price'], 0, ',', '.') ?></td>
                                                <td><?php echo $nama_cat['nama_category'] ?></td>
                                                <td><?php echo $product['stock'] ?></td>
                                                <td><img src="../<?php echo $product['image']; ?>" alt="Image Product" class="w-[8rem] h-[8rem] object-cover mx-auto rounded"></td>
                                                <td>
                                                    <a href="edit-inventory.php?edit=<?php echo $product['id_product'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                                    <a href="inventory.php?delete=<?php echo $product['id_product'] ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
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