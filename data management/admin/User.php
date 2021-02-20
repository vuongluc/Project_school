<?php 

require_once('../admin/initialize.php');


    if(!isset($_SESSION['username'])) {
        redirect_to('../admin/login.php');
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['logout'])){
            UNSET($_SESSION['username']);
            redirect_to('../admin/login.php');
        }
    }
?>
<style>
    input#logout{
        border: none;
        background-color: white;
        color: blue;
    }
    input#logout:hover{
        font-weight: bold;
    }
</style>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
    <p>User: <?php echo isset($_SESSION['username'])?$_SESSION['username']: ''; ?>
    &emsp; <input type="submit" name="logout" value="Logout" id="logout">
    &emsp; <a href="<?php echo '../admin/admin.php'; ?>">ADMIN</a>
    &emsp; <a href="<?php echo '../tour/Tour.php'; ?>">TOUR</a>
    &emsp; <a href="<?php echo '../customer/customer.php'; ?>">CUSTOMER</a>
    &emsp; <a href="<?php echo '../book tour/book_tour.php'; ?>">BOOK TOUR</a>
    &emsp; <a href="<?php echo '../pay/pay.php'; ?>">PAY</a>


</p>
</form>

