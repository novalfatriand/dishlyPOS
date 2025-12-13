<?php

session_start();
include "config.php";

if (!isset($_POST['cart_data'])) {
    die("Tidak ada data cart");
}

$cart = json_decode($_POST['cart_data'], true);

if (!$cart) {
    die("Cart kosong");
}

$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['qty'];
}

mysqli_query($conn, "INSERT INTO orders (order_date, total_price, status) VALUES (NOW(), '$total', 'On Progress')");
$id_order = mysqli_insert_id($conn);

foreach ($cart as $item) {

    $id_product = $item['id'];
    $qty = $item['qty'];
    $price = $item['price'];

    mysqli_query($conn, "
        INSERT INTO order_items (id_order, id_product, quantity, price) VALUES ('$id_order', '$id_product', '$qty', '$price')");

    mysqli_query($conn, "UPDATE products SET stock = stock - $qty WHERE id_product = '$id_product'");
}

echo "
        <script>
            localStorage.removeItem('cart');
            window.location.href = 'order_success.php?id=$id_order';
        </script>
    ";
?>