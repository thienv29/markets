<?php
session_start();
require_once('../connection.php');
include('../class/category.php');

$scriptAlert = '';
if (!isset($_SESSION['fullname'])) {
    header('location:./index.php');
}

if (isset($_GET['err'])) {
    $err = $_GET['err'];
    if ($err == -1) {
        $scriptAlert = 'alert("Vui lòng nhập đúng định dạng!!")';
    } else if ($err == 0) {
        $scriptAlert = 'alert("Thêm thành công")';
    }
}

$cate = new Category($conn);
$cateName = [];
$cateName = $cate->getAll();
$html = '';
foreach ($cateName as $key => $item) {
    $html .= '<option value="' . $item['CategoryID'] . '">' . $item['Name'] . '</option>';
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
    <?php
    include("../menu.php");
    ?>
    <form action="./add.php" method="POST" enctype="multipart/form-data">
        <div class=" container">
            <h2 style="margin-left: 14px;">Add Vegetable</h2>
            <div class="vegetable__section">
                <div class="col-md-8">
                    <div class="form-group ">
                        <label for="inputEmail4">Vegetable Name</label>
                        <input required type="text" class="form-control" name="name" id="" placeholder="">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Unit</label>
                            <select id="inputState" name="unit" class="form-control">
                                <option selected>Kg</option>
                                <option>bag</option>
                                <option>per fruit</option>
                                <option>bunch</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Amount</label>
                            <input required type="" class="form-control" name="amount" id="" placeholder="">
                        </div>
                    </div>
                    <div class="input-group mb-3" style="flex-direction:column">
                        <label for="">Images</label>
                        <input type="file" name="images" class="form-control" accept="image/png, image/jpg" style="width:100%" aria-describedby="basic-addon1" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="inputAddress">Category Name</label>
                        <select id="inputState" name="cateid" class="form-control">
                            <?php echo $html; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Price</label>
                        <input required type="text" class="form-control" name="price" id="inputAddress2" placeholder="">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-info" style="margin-left: 14px;">Add</button>
        </div>
    </form>
    <script>
        <?php echo $scriptAlert; ?>
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</body>

</html>