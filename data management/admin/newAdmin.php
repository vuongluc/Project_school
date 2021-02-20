<?php
require_once('./database.php');
require_once('./initialize.php');
$errors = [];

function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}

function checkform (){
    global $errors;
    $check=0;
    if (empty($_POST['name'])){
        $errors[] = 'Name of Admin is required';
    }
    if (empty($_POST['email'])){
        $errors[] = 'Email is required';
    }
    if (empty($_POST['username'])){
        $errors[] = 'UserName is required';
    }
    if (empty($_POST['pass'])){
        $errors[] = 'Password is required';
    }
    if (!empty($_POST['username']) && !empty($_POST['pass']) ){
        if(preg_match('/^[a-zA-Z0-9]+$/',$_POST['username'])){
            if(preg_match('/^[a-zA-Z0-9]+$/',$_POST['pass'])){
                $check=1;
            }
            else {
                $errors[] = 'PassWord contain only uppercase, lowercase and numbers';
            }
        }
        else {
            $errors[] = 'UserName contain only uppercase, lowercase and numbers';
        }

        if (preg_match('/^.{0,4}+$/',$_POST['username'])){
            $errors[] = 'UserName has at least 5 characters';
        }
        if (preg_match('/^.{0,4}+$/',$_POST['pass'])){
            $errors[] = 'PassWord has at least 5 characters';
        }
    }
    if (isFormValidated()){
        $check=1;
        $admin_set = find_all_admin();
        $count = mysqli_num_rows($admin_set);
        for ($i = 0; $i < $count; $i++):
            $admin = mysqli_fetch_assoc($admin_set); 
            if($admin['UserName'] === $_POST['username']){
                $check=0;
                break;
            }
            elseif($admin['Email'] === $_POST['email']){
                $check=2;
                break;
            }
            else continue;
        endfor; 
        if($check == 0)  {  $errors[]='Username is already taken';}
        if($check == 2)  {  $errors[]='Email is already taken';}
        mysqli_free_result($admin_set);
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
    <title>Create New Admin</title>
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
    <?php include('./User.php'); ?>
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
        

        <label for="name">Name</label> <!--required-->
        <input type="text" id="name" name="name" style="width:300px;"
        value="<?php echo isFormValidated()? '': $_POST['name'] ?>">
        <br><br>

        <label for="email">Email</label> <!--required-->
        <input type="email" id="email" name="email"  style="width:300px;"
        value="<?php echo isFormValidated()? '': $_POST['email'] ?>">
        <br><br>

        <label for="username">UserName</label> <!--required-->
        <input type="text" id="username" name="username"   
        value="<?php echo isFormValidated()? '': $_POST['username'] ?>">
        <br><br>
        
        <label for="password">Password</label>
        <input type="text" id="pass" name="pass" value="<?php echo isFormValidated()? '': $_POST['pass'] ?>">
        <br><br>
        
     


        <input type="submit" name="submit" value="Submit">
        <input type="reset" name="reset" value="Reset">
    
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && isFormValidated()): ?> 
        <?php 
        $admin = [];
        $admin['name'] = $_POST['name'];
        $admin['email'] = $_POST['email'];
        $admin['username'] = $_POST['username'];
        $admin['pass'] = $_POST['pass'];
        

        $result = insert_admin($admin);
        $newAdminId = mysqli_insert_id($db);
        ?>
        <h2>A new Admin (ID: <?php echo $newAdminId ?>) has been created:</h2>
        <ul>
        <?php 
            foreach ($_POST as $key => $value) {
                if ($key == 'submit') continue;
                if(!empty($value)) echo '<li>', $key.': '.$value, '</li>';
            }        
        ?>
        </ul>
    <?php endif; ?>
    
    <br><br>
    <a href="./admin.php">Back to Admin</a> 
</body>
</html>


<?php
db_disconnect($db);
?>