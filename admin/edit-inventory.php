<?php

    include "../layout/header.php";

    $_SESSION['title'] = 'Dishly - Edit Inventory';


    if(isset($_GET['edit'])) {
        $id = $_GET['edit'];

        $data_products = mysqli_query($conn, "SELECT * FROM products WHERE id_product = '$id'");
        $product = mysqli_fetch_assoc($data_products);

        $data_category = mysqli_query($conn, "SELECT * FROM category");

        $detailCat = mysqli_query($conn, "SELECT * FROM category WHERE id_category = '$id'");
        $cat = mysqli_fetch_assoc($detailCat);
    }


    $update_message = "";
    $update_error = null;


    if (isset($_POST['button_updateProduct'])) {
        $nama           = mysqli_real_escape_string($conn, $_POST['nama']);
        $description    = mysqli_real_escape_string($conn, $_POST['description']);
        $price          = mysqli_real_escape_string($conn, $_POST['price']);
        $category       = mysqli_real_escape_string($conn, $_POST['category']);
        $stock          = mysqli_real_escape_string($conn, $_POST['stock']);

        $target_dir = "../uploads/";
        $file_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $file_name;
        $file_tmp = $_FILES["image"]["tmp_name"];
        $upload_ok = 1;

        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ["jpg", "jpeg", "png", "gif"];

        if (!in_array($file_type, $allowed_types)) {
            echo "<script>alert('Hanya file JPG, JPEG, PNG, GIF yang diizinkan!');</script>";
            $upload_ok = 0;
        }

        if ($upload_ok && move_uploaded_file($file_tmp, $target_file)) {
            $path_in_db = "uploads/" . $file_name;
            $query = "UPDATE products SET `name` = '$nama', description = '$description', price = '$price', id_category = '$category', image = '$path_in_db', stock = '$stock' WHERE id_product = '$id'";
            mysqli_query($conn, $query);

            
            $update_error = False;
            $update_message = "Berhasil melakukan update Product!";
            echo "
                    <script>
                        window.location.href = 'inventory.php';
                    </script>
                ";
        } else {
            $update_error = True;
            $update_message = "Gagal melakukan update! Coba lagi.";
        }
    }


?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800 font-semibold">Edit Inventory</h1>
                    <p class="mb-4">Edit data dibawah ini dengan benar, kemudian lakukan Update untuk memperbarui data Inventory.</p>

                            <?php if ($update_error !== null) { ?>
                                <div class="alert <?php echo $update_error ? 'alert-warning' : 'alert-primary'; ?>" role="alert">
                                    <?php echo $update_message ?>
                                </div>
                            <?php } ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="text-secondary font-semibold text-lg">Form Edit Service</h5>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form method="POST" action="" enctype="multipart/form-data" class="mb-4 overflow-hidden">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="exampleInputNama1" class="form-label">Nama</label>
                                                <input type="text" name="nama" class="form-control rounded-full py-3.5" id="exampleInputNama1" aria-describedby="namaHelp" value="<?= $product['name'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputNama1" class="form-label">Deskripsi</label>
                                                <input type="text" name="description" class="form-control rounded-full py-3.5" id="exampleInputNama1" aria-describedby="namaHelp" value="<?= $product['description'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputAlamat" class="form-label">Harga</label>
                                                <input type="number" name="price" class="form-control rounded-full py-3.5" id="exampleInputAlamat" aria-describedby="priceHelp" value="<?= $product['price'] ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="exampleInputNamaDokter1" class="form-label">Category</label>
                                                <select name="category" id="exampleInputNamaDokter1" class="form-control rounded-full" required>
                                                    <option value="<?= $cat['id_category'] ?>"><?= $cat['nama_category'] ?></option>
                                                    <?php while($category_result = mysqli_fetch_assoc($data_category)) { ?>
                                                        <option value="<?php echo $category_result['id_category'] ?>"><?php echo $category_result['nama_category'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputAlamat" class="form-label"></label>
                                                <input type="number" name="stock" class="form-control rounded-full py-3.5" id="exampleInputAlamat" aria-describedby="priceHelp" value="<?= $product['stock'] ?>" required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="exampleInputEmail1" class="form-label">Image Product</label><br>
                                                <input type="file" name="image" class="block w-full text-sm font-light text-gray-900 border border-gray-600 rounded-full cursor-pointer bg-white focus:outline-none file:ml-1 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-light file:bg-orange-500 file:text-white hover:file:bg-orange-600 py-1" id="exampleInputEmail1" aria-describedby="imageHelp" required>
                                                <p class="mt-2 text-xs text-gray-600">Format gambar: JPG, PNG, maksimal 2 MB.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" name="button_updateProduct" class="mr-1 mt-2 btn btn-warning btn-sm px-4 py-2 rounded-full ml-3">Update</button>
                                    <a href="inventory.php" class="mt-2 d-none d-sm-inline-block btn btn-sm btn-outline-secondary px-4 py-2 rounded-full">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<?php include "../layout/footer.php" ?>