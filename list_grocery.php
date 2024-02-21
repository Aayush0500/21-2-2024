<?php
include('layouts/header.php');
include('server/connection.php'); // Include the connection file

// Fetch product details from the 'monthly_shopping_list' table
$query = "SELECT product_id, product_weight, product_quantity FROM monthly_shopping_list";
$result = mysqli_query($conn, $query);

?>




<!-- Header section -->
<header class="list_heading">
    <h2 class="text-align-center">Monthly Grocery Pack</h2>
</header>

<!-- Cart section -->
<section id="cart" class="p-1 list">
    <table>
        <thead>
            <tr>
                <td>Remove</td>
                <td>Image</td>
                <td>Product</td>
                <td>Price per 250g/ per packet</td>
                <td>Quantity</td>
                <td>Subtotal</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalProducts = 0;
            $totalPrice = 0;

            // Check if there are any products
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Increment total products count
                    $totalProducts++;

                    $product_id = $row['product_id'];
                    $product_weight = $row['product_weight'];
                    $product_quantity = $row['product_quantity'];

                    // Initialize multiplier and quantity
                    $multiplier = 1;
                    $quantity = 1;

                    if (!empty($product_weight)) {
                        // Product is from categories_product
                        // Fetch product details from categories_product table
                        $categories_query = "SELECT * FROM categories_product WHERE product_id = $product_id";
                        $categories_result = mysqli_query($conn, $categories_query);
                        $product = mysqli_fetch_assoc($categories_result);

                        // Calculate multiplier based on product weight
                        if ($product_weight == '500g') {
                            $multiplier = 2;
                        } elseif ($product_weight == '1kg') {
                            $multiplier = 4;
                        }
                    } elseif (!empty($product_quantity)) {
                        // Product is from specific_weight_products
                        // Fetch product details from specific_weight_products table
                        $specific_query = "SELECT * FROM specific_weight_products WHERE product_id = $product_id";
                        $specific_result = mysqli_query($conn, $specific_query);
                        $product = mysqli_fetch_assoc($specific_result);

                        // Get the quantity
                        $quantity = $product_quantity;
                    }

                    // Calculate subtotal
                    $subtotal = $product['product_price'] * $multiplier * $quantity;
                    $totalPrice += $subtotal;
            ?>

                    <!-- Product row -->
                    <tr class="product-row">
                        <td><button class="remove_btn"><i class="far fa-times-circle"></i></button></td>
                        <td><img src="img/categories/<?php echo $product['product_image']; ?>.jpeg" alt=""></td>
                        <td><?php echo $product['product_name']; ?></td>
                        <td><?php echo '₹ ' . $product['product_price']; ?></td>
                        <?php if (!empty($product_weight)) : ?>
                            <td>
                                <select class="weight-select" data-product-id="<?php echo $product_id; ?>">
                                    <option value="250g" <?php if ($product_weight == '250g') echo ' selected'; ?>>250g</option>
                                    <option value="500g" <?php if ($product_weight == '500g') echo ' selected'; ?>>500g</option>
                                    <option value="1kg" <?php if ($product_weight == '1kg') echo ' selected'; ?>>1 kg</option>
                                </select>
                            </td>
                        <?php elseif (!empty($product_quantity)) : ?>
                            <td><input type="number" class="quantity-input" data-product-id="<?php echo $product_id; ?>" value="<?php echo $product_quantity; ?>" min="1"></td>
                        <?php endif; ?>
                        <td class="subtotal"><?php echo '₹ ' . $subtotal; ?></td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='6'>No products found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</section>

<!-- Divider line -->
<div class="line"></div>

<!-- Cart summary section -->
<section id="cart-summary">
    <div>
        <h2>Cart Summary</h2>
        <div id="total">
            <div class="list_items">
                <div style="margin: 5px auto;">Total Products: <strong id="total-products"><?php echo $totalProducts; ?></strong><br></div>
                <div style="margin: 5px auto;">Total Price: ₹<strong id="total-price"><?php echo $totalPrice; ?></strong></div>
            </div>
            <button class="btn-blue" onclick="addToCart()">Add to Cart</button>
        </div>
    </div>
</section>

<!-- JavaScript code -->
<script>
    // Function to calculate total products
    function calculateTotalProducts() {
        const totalProducts = document.querySelectorAll('.product-row').length;
        document.getElementById('total-products').textContent = totalProducts;
    }

    // Function to calculate total price
    function calculateTotalPrice() {
        let totalPrice = 0;
        document.querySelectorAll('.subtotal').forEach(subtotal => {
            totalPrice += parseFloat(subtotal.textContent.replace('₹ ', ''));
        });
        document.getElementById('total-price').textContent = '₹ ' + totalPrice.toFixed(2);
    }

    // Function to update subtotal based on quantity and weight
    function update_subtotal(event) {
        const target = event.target;
        const productRow = target.closest('.product-row');

        // Check if productRow is found
        if (productRow) {
            const price = parseFloat(productRow.querySelector('td:nth-child(4)').textContent.replace('₹ ', ''));
            let quantity = 1;

            if (target.classList.contains('quantity-input')) {
                quantity = parseFloat(target.value);
            } else if (target.classList.contains('weight-select')) {
                const selectedWeight = target.value;
                const multipliers = {
                    '250g': 1,
                    '500g': 2,
                    '1kg': 4
                };
                quantity = multipliers[selectedWeight];
            }

            const subtotal = price * quantity;
            productRow.querySelector('.subtotal').textContent = '₹ ' + subtotal.toFixed(2);

            // Recalculate total price and total products
            calculateTotalPrice();
            calculateTotalProducts();
        }
    }

    // Function to remove a product row
    function removeProductRow(button) {
        const productRow = button.closest('.product-row');
        productRow.remove();
        // Recalculate total price and total products after removing the product
        calculateTotalPrice();
        calculateTotalProducts();
    }

    // Add event listener for changes in quantity input and weight select
    document.addEventListener('input', function(event) {
        if (event.target.classList.contains('quantity-input') || event.target.classList.contains('weight-select')) {
            update_subtotal(event);
        }
    });

    // Add event listener for remove button
    document.querySelectorAll('.remove_btn').forEach(button => {
        button.addEventListener('click', function() {
            removeProductRow(this);
        });
    });

    function addToCart() {
    var products = [];

    document.querySelectorAll('.product-row').forEach(row => {
        var productId = row.querySelector('.quantity-input').getAttribute('data-product-id');
        var productName = row.querySelector('td:nth-child(3)').textContent;
        var productImage = row.querySelector('img').getAttribute('src').replace('img/categories/', '').replace('.jpeg', '');

        var productType;
        var weightSelect = row.querySelector('.weight-select');
        if (weightSelect) {
            productType = 'categories_product';
        } else {
            productType = 'specific_weight_product';
        }

        var productPrice = parseFloat(row.querySelector('td:nth-child(4)').textContent.replace('₹ ', ''));
        var quantity;

        if (productType === 'categories_product') {
    var selectedWeight = row.querySelector('.weight-select').value;
    products.push({
        product_id: productId,
        product_name: productName,
        product_image: productImage,
        product_price: productPrice,
        product_type: productType,
        weight: selectedWeight
    });
} else {
    var quantity = parseFloat(row.querySelector('.quantity-input').value); // Corrected line
    products.push({
        product_id: productId,
        product_name: productName,
        product_image: productImage,
        product_price: productPrice,
        product_type: productType,
        quantity_specific_product_id: quantity
    });
}

    });

    fetch('cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(products),
    })
    .then(response => response.json())
    .then(data => {
        if (data.action === 'add') {
            alert(data.message);
        } else {
            alert('Failed to add product to cart');
        }
    })
    .catch(error => console.error('Error:', error));
}


    // Initial calculation of total price and total products
    calculateTotalPrice();
    calculateTotalProducts();
</script>


<?php include 'layouts/footer.php'; ?>