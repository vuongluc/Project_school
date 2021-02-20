<?php
require_once('../admin/database.php');
require_once('../admin/initialize.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST'){

    $_SESSION['msg']="Delete Book Tour Successfuly!";
    delete_book_tour($_POST['id']);
    redirect_to('./book_tour.php');
} 
else {
    if(!isset($_GET['id'])) {
        redirect_to('./book_tour.php');
    }
    $id = $_GET['id'];
    $book_tour = find_book_tour_by_id($id);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Delete Book Tour</title>
    <style>
        .label {
            font-weight: bold;
            font-size: large;
        }
    </style>
</head>
<body>
    <?php include('../admin/User.php'); ?>
    <h1>Delete Book Tour</h1>
    <h2>Are you sure you want to delete this book tour?</h2>
    <p><span class="label">Customer ID: </span><?php echo $book_tour['CustomerID']; ?></p>
    <p><span class="label">Tour ID: </span><?php echo $book_tour['TourID']; ?></p>
    <p><span class="label">Date Book: </span><?php echo $book_tour['Date_Book']; ?></p>
    <p><span class="label">Number of Adults: </span><?php echo $book_tour['Number_of_Adults']; ?></p>
    <p><span class="label">Number of Children: </span><?php echo $book_tour['Number_of_Children']; ?></p>
    <p><span class="label">Date Go: </span><?php echo $book_tour['Date_go']; ?></p>
    <p><span class="label">Vehicle: </span><?php echo $book_tour['Vehicle']; ?></p>
    <p><span class="label">Quantity_Vehicle: </span><?php echo $book_tour['Quantity_Vehicle']; ?></p>
    <p><span class="label">Message: </span><?php echo $book_tour['Message']; ?></p>



    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <input type="hidden" name="id" value="<?php echo $book_tour['BT_ID']; ?>" >
     
        <input type="submit" name="submit" value="Delete Book Tour">
     
    </form>
    
    <br><br>
    <a href="./book_tour.php">Back to Book Tour</a> 
</body>
</html>


<?php
db_disconnect($db);
?>