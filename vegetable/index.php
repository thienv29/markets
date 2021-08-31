<?php
session_start();
if (!isset($_SESSION['fullname'])) {
    header('location:../customer/login.php');
}
include('../class/vegetable.php');
include('../connection.php');
$vege = new Vegetable();

$html = '';
$ListVegetable =null;

if (isset($_GET['cateId'])) {
    $listCateID = $_GET['cateId'];
    $tmp =   implode(",",$listCateID);
    $ListVegetable = $vege->getListByCateIDs($conn,$tmp);

}else{
    $ListVegetable = $vege->getAll($conn);

}
foreach ($ListVegetable as $item) {
    $html .= '
            <div class=" col-md-4 mt-4" >
                <div class="card  ">
                    <img class="card-img-top" src="../' . $item['Image'] . '" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">' . $item['VegetableName'] . ' <span class="priceText">' . $item['Price'] . '</span></h5>
                        <a href="../cart/index.php?vegeId='. $item['VegetableID'].'" class="btn btn-primary">Buy</a>
                    </div>
                </div>
            </div>
        
        ';
}

include('../class/category.php');
$cate = new Category();
$listCategoryName = $cate->getAll($conn);
$htmlCheckBox = '';
foreach($listCategoryName as $item){
    $htmlCheckBox.='<li> <input type="checkbox" name="cateId[]" id="" value="'.$item['CategoryID'].'">'.$item['Name'].'</li>';
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
    <div class="container" >
        <div class="row justify-content-between ">
            <div class="sidebar col-md-2 mt-4" >
               <form action="" method="GET">
                   <h2>Category name</h2>
                    <ul style="list-style: none;  padding:0;">
                        <?php echo $htmlCheckBox; ?>
                      
                    </ul>

                    <button type="submit" class="btn btn-info my-2 my-sm-0">Filter</button>
               </form>
            </div>
            <div class=" col-md-10 mt-4" >
                <div class="row">
                    <?php echo $html; ?>
                </div>
            </div>
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