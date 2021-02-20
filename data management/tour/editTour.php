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
    if (empty($_POST['iu'])){
        $errors[] = 'IMG_URL is required';
    }
    if (empty($_POST['name'])){
        $errors[] = 'Tour Name is required';
    }
    if (empty($_POST['time'])){
        $errors[] = 'Time is required';
    }
    if (empty($_POST['price'])){
        $errors[] = 'Price is required';
    }
    if (empty($_POST['plg'])){
        $errors[] = 'Place Go is required';
    }
    if (empty($_POST['shd'])){
        $errors[] = 'Schedule is required';
    }
    if (empty($_POST['intro'])){
        $errors[] = 'Introduce is required';
    }
    if (empty($_POST['type'])){
        $errors[] = 'Tour Type is required';
    }
}

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    checkForm();
    if (isFormValidated()){
        
        $tour = [];
        $tour['id'] = $_POST['id'];
        $tour['iu'] = $_POST['iu'];
        $tour['name'] = $_POST['name'];
        $tour['time'] = $_POST['time'];
        $tour['price'] = $_POST['price'];
        $tour['plg'] = $_POST['plg'];
        $tour['shd'] = $_POST['shd'];
        $tour['intro'] = $_POST['intro'];
        $tour['type'] = $_POST['type'];




        $_SESSION['msg']="Update tour Successfuly!";
        update_tour($tour);
        redirect_to('./Tour.php');
    }
} else { 
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
    <title>Edit Tour</title>
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
        <input type="hidden" name="id" 
        value="<?php echo isFormValidated()? $tour['TourID']: $_POST['id'] ?>" >
        <br><br>

        <label for="iu">IMG_URL Tour</label> <!--required-->
        <input type="text" id="iu" name="iu"  style="width:500px;"
        value="<?php echo isFormValidated()? $tour['IMG_URL']: $_POST['iu'] ?>">
        <br><br>

        <label for="name">Tour Name</label> <!--required-->
        <input type="text" id="name" name="name"  
        value="<?php echo isFormValidated()? $tour['Name']: $_POST['name'] ?>">
        <br><br>

        <label for="time">Time</label> <!--required-->
        <input type="text" id="time" name="time"   
        value="<?php echo isFormValidated()? $tour['Time']: $_POST['time'] ?>">
        <br><br>
        
        <label for="price">Price</label> <!--required-->
        <input type="number" id="price" name="price"   
        value="<?php echo isFormValidated()? $tour['Price']: $_POST['price'] ?>">
        <br><br>

        <label for="plg">Place Go</label> <!--required-->
        <input type="text" id="plg" name="plg"   
        value="<?php echo isFormValidated()? $tour['Place_Go']: $_POST['plg'] ?>">
        <br><br>

        <label for="shd">Schedule</label> <!--required-->
        <br>
        <textarea name="shd" id="shd" cols="120" rows="20">
        <?php echo isFormValidated()? $tour['Schedule']: $_POST['shd'] ?>
        </textarea>
        <br><br>

        <label for="intro">Introduce</label> <!--required-->
        <br>
        <textarea name="intro" id="intro" cols="120" rows="20">
        <?php echo isFormValidated()? $tour['Introduce']: $_POST['intro'] ?>
        </textarea>
        <br><br>

        <label for="type">Tour Type</label> <br>
        <input type="radio" name="type" value="Beach Tour" <?php if(isset($tour['Tour_Type']) && $tour['Tour_Type'] == 'Beach Tour' ) echo 'checked';
                                                                 elseif(isset($_POST['type']) && $_POST['type'] == 'Beach Tour' ) echo 'checked';
                                                            ?>>Beach Tour <br>
        <input type="radio" name="type" value="Hill Station" <?php if(isset($tour['Tour_Type']) && $tour['Tour_Type'] == 'Hill Station' ) echo 'checked'; 
                                                                   elseif(isset($_POST['type']) && $_POST['type'] == 'Hill Station' ) echo 'checked';
                                                            ?>>Hill Station <br>
        <input type="radio" name="type" value="Other" <?php if(isset($tour['Tour_Type']) && $tour['Tour_Type'] == 'Other' ) echo 'checked'; 
                                                            elseif(isset($_POST['type']) && $_POST['type'] == 'Other' ) echo 'checked';
                                                            ?>>Other
        <br><br>

        <input type="submit" name="submit" value="Submit">
        <input type="reset" name="reset" value="Reset">
    
    </form>
    
    <br><br>
    <a href="./Tour.php">Back to Tour</a> 
</body>
</html>


<?php
db_disconnect($db);
?>