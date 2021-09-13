<?php
session_start();
include('../class/order.php');
include('../connection.php');
if (!isset($_SESSION['fullname'])) {
    header('location:../customer/login.php');
} else {
    $html = '';
    $order = new Order($conn);
    $listOrder = [];
    $listOrder = $order->getAllOrder($_SESSION['id']);
    foreach ($listOrder as $key => $item) {
        $html .= ' <tr>
    <th scope="row">' . $key + 1 . '</th>
    <td>' . $item['Date'] . '</td>
    <td> ' . $item['Total'] . '</td>
    <td><a class="btn btn-info" href="./detail.php?id=' . $item['OrderID'] . '">Detail</a></td>
    </tr>';
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
        <h1>History</h1>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Total</th>
                    <th scope="col">Detail</th>
                </tr>
            </thead>
            <tbody>

                <?php echo $html; ?>

            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</body>

</html>