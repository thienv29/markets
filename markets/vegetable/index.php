<?php
session_start();
include('../class/vegetable.php');
include('../connection.php');
include('../class/category.php');
if (!isset($_SESSION['listVegeId'])) {
    $_SESSION['listVegeId'] = [];
}
$vege = new Vegetable($conn);
$html = '';
$ListVegetable = null;
if (isset($_GET['cateId'])) {
    $listCateID = $_GET['cateId'];
    $tmp =   implode(",", $listCateID);
  
    $ListVegetable = $vege->getListByCateIDs($tmp);
} else {
    $ListVegetable = $vege->getAll();
}
if ($ListVegetable == null) {
    $html.='<img class="card-img-top" src="../images/noProduct.png" alt="Card image cap">';
}else{
    foreach ($ListVegetable as $item) {
        $amountCart = findAmountById($item['VegetableID']);
        $html .= '
                <div class=" col-md-4 mt-4 " >
                    <div class="card  " amount="' . $item['Amount'] . '"  amountCart="'.$amountCart.'" vegeId="'.$item['VegetableID'].'">
                        <img class="card-img-top" src="../' . $item['Image'] . '" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">' . $item['VegetableName'] . ' <span class="priceText">'.$item['Price'].'</span></h5>
                            <button  class="btn btn-danger buyCard">Buy</button>
                        </div>
                    </div>
                </div>
            ';
    }
}
function findAmountById($id){
    $arr = $_SESSION['listVegeId'];
    foreach ($arr as $item) {
        if ($item->id == $id) {
            return $item->amount;
        }
    }
    return 0;
}
$cate = new Category($conn);
$listCategoryName = $cate->getAll();
$htmlCheckBox = '';
foreach ($listCategoryName as $item) {
    $htmlCheckBox .= '<li> <input type="checkbox" name="cateId[]" class="inputFilter" id="" value="' . $item['CategoryID'] . '">' . $item['Name'] . '</li>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market online</title>
    <link rel="stylesheet" href="../css/booststrap.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php
    include('../menu.php');
    ?>
    <div class="container">
        <div class="row justify-content-between ">
            <div class="sidebar col-md-2 mt-4">
                <form action="" method="GET">
                    <h2>Category name</h2>
                    <ul style="list-style: none;  padding:0;">
                        <?php echo $htmlCheckBox; ?>
                    </ul>
                    <button type="submit" class="btn btn-info my-2 my-sm-0">Filter</button>
                </form>
            </div>
            <div class=" col-md-10 mt-4">
                <div class="row">
                    <?php echo $html; ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        const textList = Array.from(document.querySelectorAll('.priceText'));
        textList.forEach((e) => {
            e.innerHTML = formatNumber(e.innerHTML);
        })

        function formatNumber(num) { // định dạng giá tiền
            return Number(num).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
        }
        const listCard = Array.from(document.querySelectorAll('.card'))
        listCard.forEach(function(e) {
            const btn = e.querySelector('.buyCard')
            btn.onclick = () => {
                const amountCart = e.getAttribute('amountCart')
                const amount = e.getAttribute('amount')
                const vegeId = e.getAttribute('vegeId')
                if (amount == amountCart) {
                    alert('Out of stock');
                } else {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '../cart/index.php';
                    
                    const hiddenField = document.createElement('input');
                    hiddenField.type = 'hidden';
                    hiddenField.name = 'vegeId';
                    hiddenField.value = vegeId;
                    form.appendChild(hiddenField);
                    document.body.appendChild(form);
                    form.submit();
                    
                }
            }
        })
    </script>
</body>

</html>