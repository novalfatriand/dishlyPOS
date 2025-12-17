<?php

    include "../layout/header.php";

    $_SESSION['title'] = 'Dishly • Order!';

?>    
                
                <div class="container-fluid">

                    <h1 class="h3 mb-2 text-gray-800 font-bold">Order</h1>
                    <p class="mb-4"><span class="font-bold">POS Dishly</span> | Order</p>

                    <div class="grid grid-cols-7 mb-5">
                        <div class="col-span-5 p-1">
                            <div class="bg-gray-100 rounded-xl p-3">
                                <div class="category-product flex flex-row">
                                    <button onclick="showSection('all', this)" class="text-white bg-orange-400 outline outline-orange-600 font-medium rounded-full text-sm px-4 py-2 me-2 mb-2 category-btn">All</button>
                                    <button onclick="showSection('makanan', this)" class="text-black bg-white outline outline-orange-400 font-medium rounded-full text-sm px-4 py-2 me-2 mb-2 category-btn">Makanan</button>
                                    <button onclick="showSection('minuman', this)" class="text-black bg-white outline outline-orange-400 font-medium rounded-full text-sm px-4 py-2 me-2 mb-2 category-btn">Minuman</button>
                                    <button onclick="showSection('sidedish', this)" class="text-black bg-white outline outline-orange-400 font-medium rounded-full text-sm px-4 py-2 me-2 mb-2 category-btn">Side Dish</button>
                                </div>

                                <!-- Section Makanan -->
                                <div class="section" id="makanan">
                                    <h2 class="mt-5 text-2xl font-semibold text-gray-800">Makanan 🍕</h2>
                                    <div class="etalase flex flex-row flex-wrap mt-3 gap-3">
                                    <?php 
                                    $queryProductEtalase = mysqli_query($conn, "SELECT * FROM products WHERE id_category = 1");
                                    while($productEtalase = mysqli_fetch_assoc($queryProductEtalase)) { ?>
                                        <div class="product bg-white rounded-md w-40 h-48 p-4 items-center flex flex-col justify-center cursor-pointer"
                                            data-id="<?= $productEtalase['id_product'] ?>"
                                            data-name="<?= $productEtalase['name'] ?>"
                                            data-price="<?= $productEtalase['price'] ?>"
                                            data-image="../<?= $productEtalase['image'] ?>">
                                            <img class="object-cover poster rounded-lg h-20 w-20 mb-4 md:mb-0 z-0" src="../<?= $productEtalase['image'] ?>" alt="Product Image">
                                            <div class="justify-start">
                                                <h1 class="font-semibold text-black"><?= $productEtalase['name'] ?></h1>
                                                <h1 class="font-semibold text-sm mt-2 text-orange-500">Rp <?= number_format($productEtalase['price'], 0, ',', '.') ?></h1>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>


                                <!-- Section Minuman -->
                                <div class="section" id="minuman">
                                    <h2 class="mt-5 text-2xl font-semibold text-gray-800">Minuman 🥤</h2>
                                    <div class="etalase flex flex-row flex-wrap mt-3 gap-3">
                                    <?php 
                                    $queryProductEtalase = mysqli_query($conn, "SELECT * FROM products WHERE id_category = 2");
                                    while($productEtalase = mysqli_fetch_assoc($queryProductEtalase)) { ?>
                                        <div class="product bg-green-500 rounded-md w-40 h-48 p-4 flex flex-col justify-center cursor-pointer" 
                                            data-id="<?= $productEtalase['id_product'] ?>"
                                            data-name="<?= $productEtalase['name'] ?>"
                                            data-price="<?= $productEtalase['price'] ?>"
                                            data-image="../<?= $productEtalase['image'] ?>">
                                            <img class="object-cover items-center poster rounded-lg h-20 w-20 mb-4 md:mb-0 z-0" src="../<?= $productEtalase['image'] ?>" alt="Product Image">
                                            <div class=" bg-pink-400">
                                                <h1 class="font-semibold text-black"><?= $productEtalase['name'] ?></h1>
                                                <h1 class="font-semibold text-sm mt-2 text-orange-500">Rp <?= number_format($productEtalase['price'], 0, ',', '.') ?></h1>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                

                                <!-- Section Side Dish -->
                                <div class="section" id="sidedish">
                                    <h2 class="mt-5 text-2xl font-semibold text-gray-800">Side Dish 🍟</h2>
                                    <div class="etalase flex flex-row flex-wrap mt-3 gap-3">
                                    <?php 
                                    $queryProductEtalase = mysqli_query($conn, "SELECT * FROM products WHERE id_category = 3");
                                    while($productEtalase = mysqli_fetch_assoc($queryProductEtalase)) { ?>
                                        <div class="product bg-white rounded-md w-40 h-48 p-4 items-center flex flex-col justify-center cursor-pointer"
                                            data-id="<?= $productEtalase['id_product'] ?>"
                                            data-name="<?= $productEtalase['name'] ?>"
                                            data-price="<?= $productEtalase['price'] ?>"
                                            data-image="../<?= $productEtalase['image'] ?>">
                                            <img class="object-cover poster rounded-lg h-20 w-20 mb-4 md:mb-0 z-0" src="../<?= $productEtalase['image'] ?>" alt="Product Image">
                                            <div class="justify-start">
                                                <h1 class="font-semibold text-black"><?= $productEtalase['name'] ?></h1>
                                                <h1 class="font-semibold text-sm mt-2 text-orange-500">Rp <?= number_format($productEtalase['price'], 0, ',', '.') ?></h1>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>


                        <!-- Panel Cart -->
                        <div class="col-span-2 p-1 h-[500px] -mt-20">
                            <div class="h-[600px] bg-white rounded-xl p-4">
                                <h1 class="font-bold text-gray-900">Order List</h1>

                                <div id="cart-list" class="mt-3 space-y-2 overflow-y-auto h-[410px] pr-2"></div>

                                <hr class="my-3">

                                <div class="flex justify-between font-semibold text-base mt-2">
                                    <span>Total</span>
                                    <span class="text-gray-900" id="cart-total">Rp 0</span>
                                </div>

                                <button id="checkout-btn" class="text-white w-full bg-orange-500 hover:bg-orange-600 font-medium rounded-xl text-sm px-4 py-2.5 me-2 mt-3 mb-2">Checkout</button>

                                <form id="checkout-form" action="../services/checkout.php" method="POST" style="display:none;">
                                    <input type="hidden" name="cart_data" id="cart-data">
                                </form>

                            </div>
                        </div>

                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<script>
    function showSection(section, btn) {
        const sections = document.querySelectorAll('.section');
        sections.forEach(sec => {
            sec.style.display = (section === 'all' || sec.id === section) ? 'block' : 'none';
        });

        const buttons = document.querySelectorAll('.category-btn');
        buttons.forEach(b => {
            b.classList.remove('bg-orange-400', 'text-white', 'outline-orange-600');
            b.classList.add('bg-white', 'text-black', 'outline-orange-400');
        });

        if (btn) {
            btn.classList.remove('bg-white', 'text-black', 'outline-orange-400');
            btn.classList.add('bg-orange-400', 'text-white', 'outline-orange-600');
        }
    }

    document.querySelectorAll('.product').forEach(card => {
        card.addEventListener('click', function () {

            let id = this.dataset.id;
            let name = this.dataset.name;
            let price = parseInt(this.dataset.price);
            let image = this.dataset.image;

            let cart = JSON.parse(localStorage.getItem("cart")) || {};

            if (cart[id]) {
                cart[id].qty++;
            } else {
                cart[id] = { id, name, price, image, qty: 1 };
            }

            localStorage.setItem("cart", JSON.stringify(cart));
            renderCart();
        });
    });

    function renderCart() {
        let cart = JSON.parse(localStorage.getItem("cart")) || {};
        let cartList = document.getElementById("cart-list");
        let total = 0;

        cartList.innerHTML = "";

        Object.values(cart).forEach(item => {
            let subtotal = item.price * item.qty;
            total += subtotal;

            cartList.innerHTML += `
                <div class="flex items-center bg-white drop-shadow-sm p-2 rounded-md">
                    <img src="${item.image}" class="h-12 w-12 rounded-md mr-3">

                    <div class="flex-1">
                        <p class="text-sm text-gray-900 font-medium">${item.name}</p>
                        <p class="text-sm text-orange-500">Rp ${item.price.toLocaleString()}</p>
                    </div>

                    <div class="flex items-center space-x-2">
                        <button class="minus bg-gray-300 px-2 rounded-sm" data-id="${item.id}">-</button>
                        <span>${item.qty}</span>
                        <button class="plus bg-orange-400 text-white px-2 rounded-sm" data-id="${item.id}">+</button>
                    </div>
                </div>
            `;
        });

        document.getElementById("cart-total").innerText = "Rp " + total.toLocaleString();

        attachQtyButtons();
    }

    function attachQtyButtons() {
        document.querySelectorAll('.plus').forEach(btn => {
            btn.addEventListener('click', function () {
                let id = this.dataset.id;
                let cart = JSON.parse(localStorage.getItem("cart"));

                cart[id].qty++;
                localStorage.setItem("cart", JSON.stringify(cart));
                renderCart();
            });
        });

        document.querySelectorAll('.minus').forEach(btn => {
            btn.addEventListener('click', function () {
                let id = this.dataset.id;
                let cart = JSON.parse(localStorage.getItem("cart"));

                cart[id].qty--;

                if (cart[id].qty <= 0) {
                    delete cart[id];
                }

                localStorage.setItem("cart", JSON.stringify(cart));
                renderCart();
            });
        });
    }

    renderCart();


    document.getElementById("checkout-btn").addEventListener("click", function () {
    let cart = localStorage.getItem("cart");

    if (!cart || cart === "{}") {
        alert("Cart masih kosong");
        return;
    }

    document.getElementById("cart-data").value = cart;
    document.getElementById("checkout-form").submit();
    });

</script>