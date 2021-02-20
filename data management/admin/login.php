<?php
require_once('./database.php');
require_once('./initialize.php');

$errors = [];

function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}

function checkForm(){
    global $errors;


    if (empty($_POST['username'])){
        $errors[] = 'Username is required';
    }

    if (empty($_POST['pwd'])){
        $errors[] = 'Password is required';
    }
}

if($_SERVER["REQUEST_METHOD"] == 'POST') {
    checkForm();
    if (isFormValidated()){
        $check=0;
        $admin_set = find_all_admin();
        $count = mysqli_num_rows($admin_set);
        for ($i = 0; $i < $count; $i++):
            $admin = mysqli_fetch_assoc($admin_set); 
            if(($admin['UserName'] === $_POST['username']) && ($admin['Password'] === $_POST['pwd'])){
                $check=1;
                break;
            }
            else continue;
        endfor; 
        if($check == 0)  {  $errors[]='UserName or Password incorrect';}
        mysqli_free_result($admin_set); 
        if ($check==1){
            //save username to session
            $username = isset($_POST['username'])? $_POST['username']: '';
    
            $_SESSION['username'] = $username;
            
            redirect_to('./admin.php');
        }   
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin login</title>
    <meta charset="utf-8" />
    <title>Login</title>
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
        <label for="username">Username</label> <!--required-->
        <input type="text" id="username" name="username" value="<?php echo isFormValidated()? '': $_POST['username'] ?>">
        <br><br>

        <label for="pwd">Password</label> <!--required-->
        <input type="password" id="pwd" name="pwd"  >
        <br><br>

        <input type="submit" name="submit" value="Login" />   
    </form>
</body>
</html>


