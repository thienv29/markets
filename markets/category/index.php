<?php
session_start();
if (!isset($_SESSION['fullname'])) {
    header('location:../vegetable/index.php');
} else {
    include('./add.php');
    $scriptAlert = '';
    if (isset($_GET['addStatus'])) {
        if ($_GET['addStatus'] == 1) {
            $scriptAlert = "alert('Thêm thành công')";
        } else {
            $scriptAlert = "alert('Thêm thất bại')";
        }
    }

    $cate = new Category($conn);
    $html = '';
    $listCate = null;
    $listCate = $cate->getAll();

    foreach ($listCate as $item) {
        $html .= '<tr>
                    <td scope="col">' . $item['CategoryID'] . '</td>
                    <td scope="col">' . $item['Name'] . '</td>
                    <td scope="col">' . $item['Description'] . '</td>
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
    <div class="container" style="margin-top: 20px;">
        <div class="row ">
            <div class=" col-md-4 mt-4">
                <form class=" p-4" action="add.php" method="POST">
                    <div class="form-group">
                        <label for="exampleDropdownFormEmail2">Name:</label>
                        <input type="text" name="name" class="form-control" id="exampleDropdownFormEmail2" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleDropdownFormPassword2">Description:</label>
                        <input type="text" name="description" class="form-control" id="exampleDropdownFormPassword2" placeholder="">
                    </div>

                    <button type="submit" class="btn  btn-info">Add</button>
                </form>
            </div>
            <div class="col-md-8 mt-4">
                <div class="mt-4">
                    <h3>Category</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $html; ?>
                        </tbody>
                    </table>
                </div>
            </div>
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