<?php
require_once('../admin/database.php');
require_once('../admin/initialize.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    //db delete
    $_SESSION['msg']="Delete Customer Successfuly!";
    delete_book_tour_customer($_POST['id']);
    delete_pay_customer($_POST['id']);
    delete_customer($_POST['id']);
    redirect_to('customer.php');
} 
else { // form loaded
    if(!isset($_GET['id'])) {
        redirect_to('customer.php');
    }
    $id = $_GET['id'];
    $customer = find_customer_by_id($id);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Delete Customer</title>
    <style>
        .label {
            font-weight: bold;
            font-size: large;
        }
    </style>
</head>
<body>
    <?php include('../admin/User.php'); ?>
    <h1>Delete Customer</h1>
    <h2>Are you sure you want to delete an customer?</h2>
    <p><span class="label">Name: </span><?php echo $customer['Name']; ?></p>
    <p><span class="label">Phone: </span><?php echo $customer['Phone']; ?></p>
    <p><span class="label">Email: </span><?php echo $customer['Email']; ?></p>
    <p><span class="label">Address: </span><?php echo $customer['Address']; ?></p>



    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <input type="hidden" name="id" value="<?php echo $customer['CustomerID']; ?>" >
     
        <input type="submit" name="submit" value="Delete Customer">
     
    </form>
    
    <br><br>
    <a href="./customer.php">Back to Customer</a> 
</body>
</html>


<?php
db_disconnect($db);
?>