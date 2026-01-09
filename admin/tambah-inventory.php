<?php

    include "../layout/header.php";

    $_SESSION['title'] = 'Dishly | Tambah Inventory';

    $data_category = mysqli_query($conn, "SELECT * FROM category");

?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800 font-semibold">Tambah Produk</h1>
                    <p class="mb-4">Isi data dibawah ini untuk menambahkan Produk baru.</p>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="text-secondary font-semibold text-lg">Inventory Form</h5>
                            
                        </div>
                        <div class="card-body overflow-hidden">
                            <div class="table-responsive">
                                <form method="POST" action="../layout/header.php" enctype="multipart/form-data" class="mb-4 overflow-hidden px-2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="exampleInputNama1" class="form-label">Nama</label>
                                                <input type="text" name="nama" class="form-control rounded-full py-3.5" id="exampleInputNama1" aria-describedby="namaHelp" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputNama1" class="form-label">Deskripsi</label>
                                                <input type="text" name="description" class="form-control rounded-full py-3.5" id="exampleInputNama1" aria-describedby="namaHelp" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputAlamat" class="form-label">Harga</label>
                                                <input type="number" name="price" class="form-control rounded-full py-3.5" id="exampleInputAlamat" aria-describedby="priceHelp" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="exampleInputNamaDokter1" class="form-label">Category</label>
                                                <select name="category" id="exampleInputNamaDokter1" class="form-control rounded-full" required>
                                                    <option value="">Pilih Category</option>
                                                    <?php while($category_result = mysqli_fetch_assoc($data_category)) { ?>
                                                        <option value="<?php echo $category_result['id_category'] ?>"><?php echo $category_result['nama_category'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputAlamat" class="form-label">Stock</label>
                                                <input type="number" name="stock" class="form-control rounded-full py-3.5" id="exampleInputAlamat" aria-describedby="priceHelp" required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="exampleInputEmail1" class="form-label">Image Product</label><br>
                                                <input type="file" name="image" class="block w-full text-sm font-light text-gray-900 border border-gray-600 rounded-full cursor-pointer bg-white focus:outline-none file:ml-1 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-light file:bg-orange-500 file:text-white hover:file:bg-orange-600 py-1" id="exampleInputEmail1" aria-describedby="imageHelp" required>
                                                <p class="mt-2 text-xs text-gray-600">Format gambar: JPG, PNG, maksimal 2 MB.</p>
                                            </div>
                                        </div>
                                    </div>


                                    <button type="submit" name="button_addProduct" class="mr-1 mt-2 btn btn-warning btn-sm px-4 py-2 rounded-full ml-3">Tambah</button>
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