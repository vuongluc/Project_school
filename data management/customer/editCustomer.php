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
    
    if (empty($_POST['name'])){
        $errors[] = 'Name of Customer is required';
    }
    if (empty($_POST['phone'])){
        $errors[] = 'Phone is required';
    }
    if (empty($_POST['email'])){
        $errors[] = 'Email is required';
    }
    
    if (empty($_POST['address'])){
        $errors[] = 'Address is required';
    }
    
}


if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    checkForm();
    if (isFormValidated()){
        
        $customer = [];
        $customer['id'] = $_POST['id'];
        $customer['name'] = $_POST['name'];
        $customer['phone'] = $_POST['phone'];
        $customer['email'] = $_POST['email'];
        $customer['address'] = $_POST['address'];




        $_SESSION['msg']="Update Customer Successfuly!";
        update_customer($customer);
        redirect_to('./customer.php');
    }
} else { 
    if(!isset($_GET['id'])) {
        redirect_to('./customer.php');
    }
    $id = $_GET['id'];
    $customer = find_customer_by_id($id);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Edit Customer</title>
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
        <input type="hidden" id="id" name="id"
        value="<?php echo isFormValidated()? $customer['CustomerID']: $_POST['id'] ?>">

        <label for="name">Name</label> <!--required-->
        <input type="text" id="name" name="name" style="width:300px;"
        value="<?php echo isFormValidated()? $customer['Name']: $_POST['name'] ?>">
        <br><br>

        <label for="phone">Phone</label> <!--required-->
        <input type="text" id="phone" name="phone"  style="width:300px;"
        value="<?php echo isFormValidated()? $customer['Phone']: $_POST['phone'] ?>">
        <br><br>

        <label for="email">Email</label> <!--required-->
        <input type="email" id="email" name="email"   
        value="<?php echo isFormValidated()? $customer['Email']: $_POST['email'] ?>">
        <br><br>
        
        <label for="address">Address</label>
        <input type="text" id="address" name="address" value="<?php echo isFormValidated()? $customer['Address']: $_POST['address'] ?>">
        <br><br>
        
        

        <input type="submit" name="submit" value="Submit">
        <input type="reset" name="reset" value="Reset">
    
    </form>
    
    <br><br>
    <a href="./customer.php">Back to Customer</a> 
</body>
</html>


<?php
db_disconnect($db);
?>