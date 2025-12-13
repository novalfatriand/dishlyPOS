<?php

    include '../services/config.php';
    session_start();

    $current_page = basename($_SERVER['PHP_SELF']);

    if($_SESSION['is_login'] == False) {
        header('Location: ../index.php');
    }


    if (isset($_POST['button_addProduct'])) {
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
            $query = "INSERT INTO products (name, description, price, id_category, image, stock) VALUES ('$nama', '$description', '$price', '$category','$path_in_db', '$stock')";
            mysqli_query($conn, $query);

            echo "<script>alert('Data berhasil ditambahkan!'); window.location='../admin/inventory.php';</script>";
        } else {
            echo "<script>alert('Gagal mengupload gambar.');</script>";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../img/autoturner_logo_white.png" type="image/icon type">
        <title><?php echo $_SESSION['title'] ?></title>
        <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <link href="../css/sb-admin-2.min.css" rel="stylesheet">
        <link href="../css/style-admin.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
            <script src="https://cdn.tailwindcss.com"></script>
            <script>
                tailwind.config = {
                    theme: {
                        extend: {
                            colors: {
                                clifford: '#da373d',
                            },
                            fontFamily: {
                                nunito: 'Nunito'
                            }
                        }
                    }
                }
            </script>
    </head>

<body id="page-top" class="sidebar-dashboard-admin">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar-dashboard-admin sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center mt-3 mb-3" href="order.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-utensils" style="color: #ffffff;"></i>
                </div>
                <div class="sidebar-brand-text mx-2 ml-3">Dishly</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Dashboard
            </div>

            <li class="nav-item <?= ($current_page == 'order.php') ? 'active' : '' ?>">
                <a class="nav-link" href="../admin/order.php">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Order</span></a>
            </li>

            <li class="nav-item <?= ($current_page == 'status.php') ? 'active' : '' ?>">
                <a class="nav-link" href="../admin/status.php">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Status</span></a>
            </li>

            <li class="mb-2 nav-item <?= ($current_page == 'inventory.php') ? 'active' : '' ?>">
                <a class="nav-link" href="../admin/inventory.php">
                    <i class="fas fa-dolly-flatbed"></i>
                    <span>Inventory</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading font-medium">
                Management
            </div>

            <li class="nav-item <?= ($current_page == 'users.php') ? 'active' : '' ?>">
                <a class="nav-link" href="../admin/users.php">
                    <i class="fas fa-user-cog"></i>
                    <span>Users</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block mt-2 mb-3"> 

            <li class="nav-item <?= ($current_page == 'logout.php') ? 'active' : '' ?>">
                <a class="nav-link mb-5" href="../services/logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="font-bold">Logout</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['username'] ?></span>
                                <img class="img-profile rounded-circle"
                                    src="../img/user-gray.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->