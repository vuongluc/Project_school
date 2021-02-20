<?php
require_once('../admin/database.php');
require_once('../admin/initialize.php');
$errors = [];

function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}

function checkform (){
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

if($_SERVER["REQUEST_METHOD"] == 'POST') {
    checkform();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Create New tour</title>
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

        <label for="iu">Tour IMG_URL</label> <!--required-->
        <input type="text" id="iu" name="iu" style="width:500px;"
        value="<?php echo isFormValidated()? '': $_POST['iu'] ?>">
        <br><br>

        <label for="name">Tour Name</label> <!--required-->
        <input type="text" id="name" name="name"  
        value="<?php echo isFormValidated()? '': $_POST['name'] ?>">
        <br><br>

        <label for="page">Time</label> <!--required-->
        <input type="text" id="time" name="time"   
        value="<?php echo isFormValidated()? '': $_POST['time'] ?>">
        <br><br>
        
        <label for="price">Price</label>
        <input type="text" id="price" name="price" value="<?php echo isFormValidated()? '': $_POST['price'] ?>">
        <br><br>
        
        <label for="plg">Place Go</label>
        <input type="text" id="plg" name="plg" value="<?php echo isFormValidated()? '': $_POST['plg'] ?>">
        <br><br>
        
        <label for="shd">Schedule</label>
        <br>
        <textarea name="shd" id="shd" cols="120" rows="20"><?php echo isFormValidated()? '': $_POST['shd'] ?></textarea>
        <br><br>

        <label for="intro">Introduce</label>
        <br>
        <textarea name="intro" id="intro" cols="120" rows="20"><?php echo isFormValidated()? '': $_POST['intro'] ?></textarea>
        <br><br>

        <label for="type">Tour Type</label> <br>
        <input type="radio" name="type" value="Beach Tour">Beach Tour <br>
        <input type="radio" name="type" value="Hill Station">Hill Station <br>
        <input type="radio" name="type" value="Other">Other <br>

        <input type="submit" name="submit" value="Submit">
        <input type="reset" name="reset" value="Reset">
    
    </form>
    <br><br>
    <a href="./Tour.php">Back to Tour</a> 
    <br><br>
    <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && isFormValidated()): ?> 
        <?php 
        $tour = [];
        $tour['iu'] = $_POST['iu'];
        $tour['name'] = $_POST['name'];
        $tour['time'] = $_POST['time'];
        $tour['price'] = $_POST['price'];
        $tour['plg'] = $_POST['plg'];
        $tour['shd'] = $_POST['shd'];
        $tour['intro'] = $_POST['intro'];
        $tour['type'] = $_POST['type'];


        $result = insert_tour($tour);
        $newtourId = mysqli_insert_id($db);
        ?>
        <h2>A new tour (ID: <?php echo $newtourId ?>) has been created:</h2>
        <ul>
        <?php 
            foreach ($_POST as $key => $value) {
                if ($key == 'submit') continue;
                if(!empty($value)) echo '<li>', $key.': '.$value, '</li>';
            }        
        ?>
        </ul>
    <?php endif; ?>
    
   
</body>
</html>


<?php
db_disconnect($db);
?>