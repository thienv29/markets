
<?php
  include('./saveRegister.php');
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
  <div class="register">
    <form class=" p-4" action="register.php" method="POST">
      <h3>Register</h3>
      
      <div class="form-group">
        <label for="exampleDropdownFormPassword2">Full name</label>
        <input type="text" name="name" class="form-control" id="exampleDropdownFormPassword2" placeholder=" Your full name" required>
      </div>
      <div class="form-group">
        <label for="exampleDropdownFormEmail2">Password</label>
        <input type="text" name="password" class="form-control" id="exampleDropdownFormEmail2" placeholder="Enter Your's password" required>
      </div>
      <div class="form-group">
        <label for="exampleDropdownFormEmail2">Address</label>
        <input type="text"  name="address" class="form-control" id="exampleDropdownFormEmail2" placeholder="Enter Your's Address" required>
      </div>
      <div class="form-group">
        <label for="exampleDropdownFormEmail2">City</label>
        <input type="text" name="city" class="form-control" id="exampleDropdownFormEmail2" placeholder="Enter Your's City" required>
      </div>

      

      <div class=""><button type="submit" class="btn login-btn btn-primary">Register</button></div>
    </form>
    
    <div class="" style="width: 100%; text-align: center; padding: 15px;"><a href="../index.php" style="text-decoration: none; color: gray;" >Quay về trang chủ</a></div>
  </div>
</body>

</html>