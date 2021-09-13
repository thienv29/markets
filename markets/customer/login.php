<?php
    include('./checklogin.php');
    $script = "";
    if (isset($_GET['newid'])) {
        $id =$_GET['newid'];
        $script = 'alert("your id: '.$id.' ")';
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
    <div class="login">
        <form class=" p-4" action="login.php" method="POST">
            <h3>Login</h3>
            <div class="form-group">
                <label for="exampleDropdownFormEmail2">Your's ID</label>
                <input type="text" name="yourId" class="form-control" id="exampleDropdownFormEmail2" placeholder="Enter Your's ID" required>
            </div>
            <div class="form-group">
                <label for="exampleDropdownFormPassword2">Password</label>
                <input type="password" name="password" class="form-control" id="exampleDropdownFormPassword2" placeholder="Password" required>
            </div>
            <div style="color: red;"><?php echo $invalidPass ?></div>

            <button type="submit" class="btn login-btn btn-primary">Login</button>
            <a href="register.php" class="btn login-btn btn-primary">Register</a>
        </form>
    </div>
    <script>
        <?php echo $script; ?>
    </script>
</body>
</html>