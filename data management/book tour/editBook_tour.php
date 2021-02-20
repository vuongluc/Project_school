<?php
require_once('../admin/database.php');
require_once('../admin/initialize.php');

$errors = [];

function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}

function checkForm(){
    global $errors;
    if (empty($_POST['cid'])){
        $errors[] = 'Customer ID is required';
    }
    if (empty($_POST['tid'])){
        $errors[] = 'Tour ID is required';
    }
    if (empty($_POST['noa'])){
        $errors[] = 'Number of Adult is required';
    }
    if (empty($_POST['qtv'])){
        $errors[] = 'Quantity Vehicle is required';
    }
}

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    checkForm();
    $id = $_POST['btid'];
    $book_tour = find_book_tour_by_id($id);
    if (isFormValidated()){
        
        $book_tour = [];
        $book_tour['btid'] = $_POST['btid'];
        $book_tour['cid'] = $_POST['cid'];
        $book_tour['tid'] = $_POST['tid'];
        $book_tour['noa'] = $_POST['noa'];
        $book_tour['noc'] = $_POST['noc'];
        $book_tour['dg'] = $_POST['dg'];
        $book_tour['vhc'] = $_POST['vhc'];
        $book_tour['qtv'] = $_POST['qtv'];
        $book_tour['mess'] = $_POST['mess'];




        $_SESSION['msg']="Update Book tour Successfuly!";
        update_book_tour($book_tour);
        redirect_to('./book_tour.php');
    }
} else { 
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
    <title>Edit Book Tour</title>
    <style>
        label {
            font-weight: bold;
        }
        .error {
            color: #FF0000;
        }
        div.error{
            border: thin solid red; 
            display: inline-block;
            padding: 5px;
        }
    </style>
</head>
<body>
    <?php include('../admin/User.php'); ?>
    <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && !isFormValidated()): ?> 
        <div class="error">
            <span> Please fix the following errors </span>
            <ul>
                <?php
                foreach ($errors as $key => $value){
                    if (!empty($value)){
                        echo '<li>', $value, '</li>';
                    }
                }
                ?>
            </ul>
        </div><br><br>
    <?php endif; ?>
    
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">           
        <input type="hidden" name="btid" 
        value="<?php echo isFormValidated()? $book_tour['BT_ID']: $_POST['btid'] ?>" >

        <input type="hidden" id="cid" name="cid"  
        value="<?php echo isFormValidated()? $book_tour['CustomerID']: $_POST['cid'] ?>">
        <br>

        <label for="tid">Tour ID</label> 
        <input type="text" id="tid" name="tid"  
        value="<?php echo isFormValidated()? $book_tour['TourID']: $_POST['tid'] ?>">
        <br><br>

        <label for="noa">Number of Adult</label> 
        <input type="number" id="noa" name="noa"   
        value="<?php echo isFormValidated()? $book_tour['Number_of_Adults']: $_POST['noa'] ?>">
        <br><br>
        
        <label for="noc">Number of Children</label> 
        <input type="number" id="noc" name="noc"   
        value="<?php echo isFormValidated()? $book_tour['Number_of_Children']: $_POST['noc'] ?>">
        <br><br>

        <label for="dg">Date Go</label> 
        <input type="date" id="dg" name="dg"   
        value="<?php echo isFormValidated()? $book_tour['Date_go']: $_POST['dg'] ?>">
        <br><br>
        
        <label for="vhc">Vehicle</label> <br>
        <input type="radio" name="vhc" value="Travel Car" <?php if(isset($book_tour['Vehicle']) && $book_tour['Vehicle'] == 'Travel Car' ) echo 'checked'; 
                                                                elseif(isset($_POST['vhc']) && $_POST['vhc'] == 'Travel Car' ) echo 'checked';
                                                        ?>>Travel Car <br>
        <input type="radio" name="vhc" value="Planes" <?php if(isset($book_tour['Vehicle']) && $book_tour['Vehicle'] == 'Planes' ) echo 'checked'; 
                                                            elseif(isset($_POST['vhc']) && $_POST['vhc'] == 'Planes' ) echo 'checked';
                                                    ?>>Planes <br>
        <br><br>

        <label for="qtv">Quantity Vehicle</label> 
        <input type="number" id="qtv" name="qtv" min="1"
        value="<?php echo isFormValidated()? $book_tour['Quantity_Vehicle']: $_POST['qtv'] ?>">
        <br><br>

        <label for="mess">Message</label> 
        <br>
        <textarea name="mess" id="mess" cols="80" rows="15">
        <?php echo isFormValidated()? $book_tour['Message']: $_POST['mess'] ?>
        </textarea>
        <br><br>



        <input type="submit" name="submit" value="Submit">
        <input type="reset" name="reset" value="Reset">
    
    </form>
    
    <br><br>
    <a href="./book_tour.php">Back to Book Tour</a> 
</body>
</html>


<?php
db_disconnect($db);
?>