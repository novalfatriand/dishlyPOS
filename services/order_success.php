<?php

    include 'config.php';

    $id = $_GET['id'];

    $data_order = mysqli_query($conn, "SELECT * FROM orders WHERE id_order = '$id'");
    $order = mysqli_fetch_assoc($data_order);

    if(isset($_POST['submit_order'])) {
        $order_name = mysqli_real_escape_string($conn, $_POST['order_name']);

        $confirm_query = mysqli_query($conn, "UPDATE orders SET `name` = '$order_name' WHERE id_order = '$id'");

        if ($confirm_query) {
            header('Location: ../admin/status.php');
            exit;
        } else {
            echo "Gagal: " . mysqli_error($conn);
        }
    }

?>

    <!doctype html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Order Status</title>
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
                                poppins: 'Poppins', 
                                jetbrain: 'JetBrains+Mono'
                            }
                        }
                    }
                }
            </script>
        </head>
        <body class="flex font-poppins items-center justify-center">

            <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8 mt-32">
                <form class="space-y-6" action="" method="POST">
                    <h5 class="text-xl font-medium text-gray-900">Checking Order</h5>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Pesanan atas nama</label>
                        <input type="text" name="order_name" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required/>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Nomor Order</label>
                        <input type="text" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="#<?= $order['id_order'] ?>" disabled/>
                    </div>
                    <div class="flex justify-between font-semibold text-sm mt-2">
                        <span class="font-medium text-gray-700">Total</span>
                        <span class="text-gray-900">Rp <?= number_format($order['total_price'], 0, ',', '.') ?></span>
                    </div>
                    <div class="flex justify-between font-semibold text-sm">
                        <span class="font-medium text-gray-700">Payment</span>
                        <span class="text-gray-900">Cash Only</span>
                    </div>
                    <button type="submit" name="submit_order" class="w-full text-center bg-orange-500 hover:bg-orange-600 hover:cursor-pointer text-sm py-2.5 rounded-md text-white font-light">Confirm Pesanan</button>
                </form>
            </div>

        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
        </body>
    </html>