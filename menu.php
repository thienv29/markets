<?php

$headerRight = '';
$history = '';
if (isset($_SESSION['fullname'])) {
    $fullname = $_SESSION['fullname'];
    $headerRight = '<a href="/markets/customer/logout.php" class="linkLogout">Logout</a>
                    <button class="btn btn-info my-2 my-sm-0" >' . $fullname . '</button>';

    $history = '<li class="nav-item">
                    <a class="nav-link" href="/markets/cart/history.php">History</a>
                </li>';
} else {
    $headerRight = '<a href="/markets/customer/login.php" class="linkLogout">Login/Register</a>';
}

?>

<div class="header bg-dark ">
    <nav class="navbar container navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/markets/index.php">Market online</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="/markets/vegetable/index.php">Vegetable </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/markets/cart/index.php">Cart</a>
                </li>
                <?php echo $history; ?>


            </ul>
            <div class="form-inline my-2 my-lg-0">
                <?php echo $headerRight; ?>

            </div>
        </div>
    </nav>
</div>