<?php
session_start();
if (!isset($_SESSION['fullname'])) {
    header('location:../customer/login.php');
}
include('../class/vegetable.php');
include('../connection.php');
$vege = new Vegetable();
$ListVegetable = $vege->getAll($conn);

$html = '';
foreach ($ListVegetable as $item) {
    $html .= '
            <div class=" col-md-3 mt-4" >
                <div class="card  ">
                    <img class="card-img-top" src="../' . $item['Image'] . '" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">' . $item['VegetableName'] . ' <span class="priceText">' . $item['Price'] . '</span></h5>
                        <a href="#" class="btn btn-primary">Buy</a>
                    </div>
                </div>
            </div>
        
        ';
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/booststrap.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php
    include('../menu.php');

    ?>
    <div class="container" style="margin-top: 20px;">
        <div class="row justify-content-between ">

            <?php echo $html; ?>

        </div>
    </div>
    <script>
            console.log('ssss');
            const textList = Array.from(document.querySelectorAll('.priceText'));
            textList.forEach((e) => {
              e.innerHTML = formatNumber(e.innerHTML);
            })
        function formatNumber(num) { // định dạng giá tiền
            return Number(num).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
        }
    </script>
</body>

</html>