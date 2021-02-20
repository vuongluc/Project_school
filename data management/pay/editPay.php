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
        $errors[] = 'Customer ID pay is required';
    }
    
    if (empty($_POST['method'])){
        $errors[] = 'Method is required';
    }
    if(isset($_POST['method'])){
        if($_POST['method'] == 'Credit Card'){
            if (empty($_POST['pile'])){
                $errors[] = 'Pile is required';
            }

            if (empty($_POST['bank'])){
                $errors[] = 'Bank is required';
            }

            if (empty($_POST['acc'])){
                $errors[] = 'Account Number is required';
            }
        }
        
        else{
            if (!empty($_POST['bank'])){
                $errors[] = ' Bank must be blank ';
            }

            if (!empty($_POST['acc'])){
                $errors[] = 'Account Number must be blank';
            }

            if (!empty($_POST['pile'])){
                $errors[] = 'Pile must be blank';
            }
        }

        if (!empty($_POST['acc'])){
            if(strlen($_POST['acc']) <12 || strlen($_POST['acc']) >16)
            $errors[] = 'Account Number only 12 to 16 numbers in length';
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    checkForm();
    if (isFormValidated()){
        
        $pay = [];
        $pay['id'] = $_POST['id'];
        $pay['cid'] = $_POST['cid'];
        $pay['pile'] = $_POST['pile'];
        $pay['method'] = $_POST['method'];
        $pay['bank'] = $_POST['bank'];
        $pay['acc'] = $_POST['acc'];

        $_SESSION['msg']="Update Pay Successfuly!";
        update_pay($pay);
        redirect_to('./pay.php');
    }
} else { 
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
    <title>Edit Pay</title>
    <script src="../../js/jquery-3.3.1.min.js"></script>

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
        value="<?php echo isFormValidated()? $pay['ID']: $_POST['id'] ?>">

        <input type="hidden" id="cid" name="cid" style="width:300px;"
        value="<?php echo isFormValidated()? $pay['CustomerID']: $_POST['cid'] ?>">
        <br>

        <label for="pile">Pile</label> 
        <input type="text" id="pile" name="pile"  style="width:300px;"
        value="<?php echo isFormValidated()? $pay['Pile']: $_POST['pile'] ?>">
        <br><br>

        <label for="method">Method</label> <br>
        <input type="checkbox" name="method" id="card" value="Credit Card" <?php if(isset($pay['Method']) && $pay['Method'] == 'Credit Card' ) echo 'checked'; 
                                                                                elseif(isset($_POST['method']) && $_POST['method'] == 'Credit Card' ) echo 'checked';
                                                                        ?>>Credit Card<br>
        <input type="checkbox" name="method" id="cash" value="Cash" <?php if(isset($pay['Method']) && $pay['Method'] == 'Cash' ) echo 'checked'; 
                                                                        elseif(isset($_POST['method']) && $_POST['method'] == 'Cash' ) echo 'checked';
                                                                    ?>> Cash
        <br><br>
        
        <label for="bank">Bank</label>
        <!-- <input type="text" id="bank" name="bank" value="<?php echo isFormValidated()? $pay['Bank']: $_POST['bank'] ?>">
        <br><br> -->
        <select name="bank" id="select" >
            <option ></option>
            <option value="Agribank" <?php if(isset($pay['Bank']) && $pay['Bank'] == 'Agribank' ) echo 'selected'; 
                                            elseif(isset($_POST['bank']) && $_POST['bank'] == 'Agribank' ) echo 'selected';
                                    ?>>Agribank</option>
            <option value="Vietcombank" <?php if(isset($pay['Bank']) && $pay['Bank'] == 'Vietcombank' ) echo 'selected'; 
                                            elseif(isset($_POST['bank']) && $_POST['bank'] == 'Vietcombank' ) echo 'selected';
                                    ?>>Vietcombank</option>
            <option value="BIDV" <?php if(isset($pay['Bank']) && $pay['Bank'] == 'BIDV' ) echo 'selected'; 
                                        elseif(isset($_POST['bank']) && $_POST['bank'] == 'BIDV' ) echo 'selected';
                                ?>>BIDV</option>
        </select>
        <br><br>

        <label for="acc">Account Number</label>
        <input type="text" id="acc" name="acc" value="<?php echo isFormValidated()? $pay['Account_number']: $_POST['acc'] ?>">
        <br><br>

        <input type="submit" name="submit" value="Submit">
        <input type="reset" name="reset" value="Reset">
    
    </form>
    
    <br><br>
    <a href="./pay.php">Back to Pay</a> 
    <script>
        $(document).ready(function(){
            $('#card').click(function() {  
                if(this.checked) { 
                    $('#cash').each(function() { 
                        this.checked = false;  
                    });
                }
            });


            $('#cash').click(function() {  
                if(this.checked) { 
                    $('#card').each(function() { 
                        this.checked = false;  
                    });
            }
        });
    });

</script>
</body>
</html>


<?php
db_disconnect($db);
?>