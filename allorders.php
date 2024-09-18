<?php
include 'partials/header.php';

if (!isset($_SESSION['user-id'])) {
    header('location:http://localhost/petStudio/signin.php');
    exit();
}


$query = "SELECT * FROM order_table";
$result = mysqli_query($connection, $query);


$orders = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $order_id = $row['id'];
        $post_id = $row['post_id'];
        $quantity = $row['quantity'];
        $user_id = $row['user_id'];
        $total = $row['total'];


        $query2 = "SELECT * FROM posts WHERE id=$post_id";
        $result2 = mysqli_query($connection, $query2);
        $post = mysqli_fetch_assoc($result2);

        $post['quantity'] = $quantity;
        $post['total'] = $total;

        $query3 = "SELECT * FROM users WHERE id=$user_id";
        $result3 = mysqli_query($connection, $query3);
        $user = mysqli_fetch_assoc($result3);


        $order = array(
            'order_id' => $order_id,
            'buyer_name' => $user['name'],
            'product_title' => $post['title'],
            'quantity' => $quantity,
            'total' => $total,

        );
        $orders[] = $order;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>All Orders</title>
    <link rel="stylesheet" href="http://localhost/petStudio/css/style2.css">
</head>

<body>
    <h2>All Orders</h2>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Buyer Name</th>
                <th>Product Title</th>
                <th>Quantity</th>
                <th>Total</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($orders)) : ?>
                <?php foreach ($orders as $order) : ?>
                    <tr>
                        <td><?= $order['order_id'] ?></td>
                        <td><?= $order['buyer_name'] ?></td>
                        <td><?= $order['product_title'] ?></td>
                        <td><?= $order['quantity'] ?></td>
                        <td><?= $order['total'] ?></td>

                        <td>

                            <a class="deliver" href="http://localhost/petStudio/approve-order.php?id=<?= $order['order_id'] ?>">Deliver</a>


                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6">No orders found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>