<?php
require_once('../admin/database.php');
require_once('../admin/initialize.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST'){

    $_SESSION['msg']="Delete Pay Successfuly!";
    delete_pay($_POST['id']);
    redirect_to('./pay.php');
} 
else {
    if(!isset($_GET['id'])) {
        redirect_to('./pay.php');
    }
    $id = $_GET['id'];
    $pay = find_pay_by_id($id);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Delete Pay</title>
    <style>
        .label {
            font-weight: bold;
            font-size: large;
        }
    </style>
</head>
<body>
    <?php include('../admin/User.php'); ?>
    <h1>Delete Pay</h1>
    <h2>Are you sure you want to delete this Pay?</h2>
    <p><span class="label">CustomerID: </span><?php echo $pay['CustomerID']; ?></p>
    <p><span class="label">Pile: </span><?php echo $pay['Pile']; ?></p>
    <p><span class="label">Method: </span><?php echo $pay['Method']; ?></p>
    <p><span class="label">Bank: </span><?php echo $pay['Bank']; ?></p>
    <p><span class="label">Account_number: </span><?php echo $pay['Account_number']; ?></p>



    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <input type="hidden" name="id" value="<?php echo $pay['ID']; ?>" >
     
        <input type="submit" name="submit" value="Delete Pay">
     
    </form>
    
    <br><br>
    <a href="./pay.php">Back to Pay</a> 
</body>
</html>


<?php
db_disconnect($db);
?>