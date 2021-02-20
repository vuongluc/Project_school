<?php
require_once('../admin/database.php');
require_once('../admin/initialize.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    //db delete
    $_SESSION['msg']="Delete Tour Successfuly!";
    delete_tour($_POST['id']);
    redirect_to('./Tour.php');
} 
else { // form loaded
    if(!isset($_GET['id'])) {
        redirect_to('./Tour.php');
    }
    $id = $_GET['id'];
    $tour = find_tour_by_id($id);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Delete Tour</title>
    <style>
        .label {
            font-weight: bold;
            font-size: large;
        }
    </style>
</head>
<body>
    <?php include('../admin/User.php'); ?>
    <h1>Delete Tour</h1>
    <h2>Are you sure you want to delete this tour?</h2>
    <p><span class="label">IMG_URL: </span><?php echo $tour['IMG_URL']; ?></p>
    <p><span class="label">Name: </span><?php echo $tour['Name']; ?></p>
    <p><span class="label">Time: </span><?php echo $tour['Time']; ?></p>
    <p><span class="label">Price: </span><?php echo $tour['Price']; ?></p>
    <p><span class="label">Place Go: </span><?php echo $tour['Place_Go']; ?></p>
    <p><span class="label">Schedule: </span><?php echo $tour['Schedule']; ?></p>
    <p><span class="label">Introduce: </span><?php echo $tour['Introduce']; ?></p>
    <p><span class="label">Tour Type: </span><?php echo $tour['Tour_Type']; ?></p>



    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <input type="hidden" name="id" value="<?php echo $tour['TourID']; ?>" >
     
        <input type="submit" name="submit" value="Delete Tour">
     
    </form>
    
    <br><br>
    <a href="./Tour.php">Back to Tour</a> 
</body>
</html>


<?php
db_disconnect($db);
?>