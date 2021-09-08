<?php
session_start();
include('../class/vegetable.php');
include('../class/order.php');
include('../connection.php');

$totalPrice = 0;
$totalAmount = 0;

if (!isset($_SESSION['fullname'])) {
    header('location:../customer/login.php');
} else {
    $html = '';

    if (isset($_GET['id'])) {
        $orderID = $_GET['id'];
        $listOrderDetail = [];
        $order = new Order($conn);
        $listOrderDetail = $order->getOrderDetail($orderID);

        foreach ($listOrderDetail as $key => $item) {
            $vegetable = new Vegetable($conn);
            $vegetableItem  = $vegetable->getByID($item['VegetableID']);

            $html .= '
                <tr>
                    <th scope="row">' . $key + 1 . '</th>
                    <td>' . $vegetableItem['VegetableName'] . '</td>
                    <td><img src="../' . $vegetableItem['Image'] . '" alt="" style="width: 100px; height:100px;"></td>
                    <td>' . $item['Quantity'] . '</td>
                    <td>' . $vegetableItem['Price'] . '</td>
                </tr>';

            $totalPrice += $item['Quantity'] * $vegetableItem['Price'];
            $totalAmount += $item['Quantity'];
        }
    }
}





?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/booststrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Market online</title>
</head>

<body>
    <?php include('../menu.php') ?>
    <div class="container mt-3">
        <h1>Order detail</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $html; ?>
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td>Total</td>
                    <td><?php echo $totalAmount; ?></td>
                    <td><?php echo $totalPrice; ?></td>
                </tr>

            </tbody>
        </table>

    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</body>

</html>