<?php
include 'partials/header.php';

if (!isset($_SESSION['user-id'])) {
    header('location:http://localhost/petStudio/signin.php');
    exit();
}

$user_id = $_SESSION['user-id'];

$query = "SELECT * FROM shopping_cart WHERE user_id=$user_id";
$result = mysqli_query($connection, $query);

$shoppingCart = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $cart_id = $row['id'];
        $post_id = $row['post_id'];
        $quantity = $row['quantity'];
        $query2 = "SELECT *FROM posts WHERE id=$post_id";
        $result2 = mysqli_query($connection, $query2);
        $post = mysqli_fetch_assoc($result2);
        $post['cart_id'] = $cart_id;
        $post['quantity'] = $quantity;
        $shoppingCart[] = $post;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="http://localhost/petStudio/css/style2.css">
</head>

<body>
    <h2>My Shopping Cart</h2>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($shoppingCart)) : ?>
                <?php foreach ($shoppingCart as $cart) : ?>
                    <tr>
                        <td><?= $cart['title'] ?></td>
                        <td>$<?= $cart['price'] ?></td>
                        <td><?= $cart['quantity'] ?></td> <!-- Use the quantity from the post array -->
                        <td class="total">$<?= $cart['price'] * $cart['quantity'] ?></td>
                        <td> <a class="remove" href="delete-item.php?id=<?= $cart['cart_id'] ?>">Delete</a> </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6">You have not added any items to your shopping cart yet.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if (!empty($shoppingCart)) : ?>
        <div class="cart-section">
            <div class="cart-total">
                <p class="cart-total-label">Cart Total:</p>
                <p id="cart-total" class="cart-total-price">$<?= array_sum(array_map(function ($item) {
                                                                    return $item['price'] * $item['quantity'];
                                                                }, $shoppingCart)) ?></p>
            </div>
            <form action="http://localhost/petStudio/order-logic.php" method="POST">
                <button class="send-order-btn">Send Order</button>
            </form>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['order-success'])) : ?>
        <div class="success">
            <p class="orders">
                <?= $_SESSION['order-success'] ?>
            </p>
            <br>
        </div>
        <?php unset($_SESSION['order-success']); ?>
    <?php endif; ?>
</body>

</html>


<script>
    const quantityInputs = document.querySelectorAll('.quantity-input');


    quantityInputs.forEach(input => {
        input.addEventListener('input', () => {

            const price = parseFloat(input.parentNode.previousElementSibling.textContent.slice(1));


            const quantity = parseInt(input.value);


            const total = price * quantity;

            input.parentNode.nextElementSibling.textContent = '$' + total.toFixed(2);


            const cartTotal = document.getElementById('cart-total');
            const currentTotal = parseFloat(cartTotal.textContent.slice(1));
            cartTotal.textContent = '$' + (currentTotal - price + total).toFixed(2);
        });
    });
</script>