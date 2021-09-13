<?php
require_once('../connection.php');
include('../class/vegetable.php');
session_start();
$html = '';
$total = 0;
$totalAmount = 0;
$scriptAlert = '';
if (isset($_GET['billStatus'])) {
    $billStatus = $_GET['billStatus'];
    if ($billStatus == 1) {
        $scriptAlert = ' alert("Thanh toán thành công")';
    } else {
        $scriptAlert = ' alert("Thanh toán thất bại")';
    }
}
if (isset($_GET['errLogin'])) {
    if ($_GET['errLogin'] == 1) {
        $scriptAlert = ' alert("Vui lòng đăng nhập")';
    }
}
$vegetable = new Vegetable($conn);
if (isset($_POST['vegeId'])) {

    $object = new stdClass();
    $object->amount = 1;
    $object->id = $_POST['vegeId'];

    if (check($object, $_SESSION['listVegeId'])) {
    } else {
        array_push($_SESSION['listVegeId'], $object);
    }
}
$_SESSION['listVegeId']  = checkAmount($vegetable);
$html = '';
if ($_SESSION['listVegeId']==[]) {
    $html='
    <tr>
    <td></td>
    <td></td>
    <td><img src="../images/noProduct.png" alt="" ></td>
    <td></td>
    <td></td>
    </tr>
    ';
}else{

    foreach ($_SESSION['listVegeId'] as $key => $item) {
        $vegetableItem = $vegetable->getByID($item->id);
    
        $name = $vegetableItem['VegetableName'];
        $image = $vegetableItem['Image'];
        $price = $vegetableItem['Price'];
        $amount = $item->amount;
    
        $total += $price * $amount;
        $totalAmount += $amount;
    
        $html .= '<tr>
                <th scope="row">' . $key + 1 . '</th>
                <td>' . $name . '</td>
                <td><img src="../' . $image . '" alt="" style="width: 100px; height:100px;"></td>
                <td>' . $amount . '</td>
                <td>' . $price . '</td>
            </tr>';
    }
}
// }
function checkAmount($vegetable)
{
    $arr = $_SESSION['listVegeId'];
    $length = count($arr);

    for ($i = 0; $i < $length; $i++) {
        $current = $vegetable->getById($arr[$i]->id);
        if ($arr[$i]->amount > $current['Amount']) {
            $arr[$i]->amount -= 1;
            if ($arr[$i]->amount == 0) {
                unset($arr[$i]);
            }

            return $arr;
        }
    }
    return $arr;
}

function check($object, $arr)
{
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i]->id == $object->id) {
            $arr[$i]->amount++;
            $_SESSION['listVegeId'] = $arr;
            return true;
        }
    }
}
$disable="";
if ($_SESSION['listVegeId']==[]) {
    $disable = "disabled";
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
                    <td>Total: </td>
                    <td><?php echo $totalAmount; ?></td>
                    <td><?php echo $total; ?></td>
                </tr>

            </tbody>
        </table>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal" <?php echo $disable;?> >
            Order
        </button>


    </div>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" action="./saveorder.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Total</label>
                            <input type="text" class="form-control " name="total" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $total; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Note</label>
                            <input type="text" class="form-control" name="note" id="exampleInputPassword1" placeholder="Your note">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" >Order</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        <?php echo $scriptAlert; ?>
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</body>

</html>