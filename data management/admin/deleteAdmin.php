<?php
require_once('./database.php');
require_once('./initialize.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    //db delete
    $_SESSION['msg']="Delete Admin Successfuly!";
    delete_admin($_POST['id']);
    redirect_to('admin.php');
} 
else { // form loaded
    if(!isset($_GET['id'])) {
        redirect_to('admin.php');
    }
    $id = $_GET['id'];
    $admin = find_admin_by_id($id);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Delete Admin</title>
    <style>
        .label {
            font-weight: bold;
            font-size: large;
        }
    </style>
</head>
<body>
    <?php include('./User.php'); ?>
    <h1>Delete Admin</h1>
    <h2>Are you sure you want to delete an admin?</h2>
    <p><span class="label">Name: </span><?php echo $admin['Name']; ?></p>
    <p><span class="label">Email: </span><?php echo $admin['Email']; ?></p>
    <p><span class="label">UserName: </span><?php echo $admin['UserName']; ?></p>
    <p><span class="label">Password: </span><?php echo $admin['Password']; ?></p>



    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <input type="hidden" name="id" value="<?php echo $admin['AdminID']; ?>" >
     
        <input type="submit" name="submit" value="Delete Admin">
     
    </form>
    
    <br><br>
    <a href="./admin.php">Back to Admin</a> 
</body>
</html>


<?php
db_disconnect($db);
?>