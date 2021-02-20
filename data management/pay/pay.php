<?php
require_once('../admin/database.php');
require_once('../admin/initialize.php');


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Pay</title>

    <style>
        table {
        border-collapse: collapse;
        vertical-align: top;
        white-space: nowrap;
        }

        table.list {
        width: 100%;
        }

        table.list tr td {
        border: 1px solid #999999;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis; 
            border: 1px solid #000000;
        }

        table.list tr th {
        border: 1px solid #0055DD;
        background: #0055DD;
        color: white;
        text-align: left;
        max-width: 70px; 
        }

        td.center1{
            background: #0055DD;
            text-align: center;
        }

        td.center {
            text-align: center;
        }

        .msg{
            margin: 10px auto;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #00ff00;
            width: 98%;
            text-align: center;
            color: #00ff00;
        }
        td {
            max-width:100px;
            overflow: hidden;
            word-wrap:break-word;
            white-space: nowrap;
            text-overflow:ellipsis;
        }
    </style>
</head>
<body>
    <?php include('../admin/User.php'); ?>
    
    <br>
    <?php if(isset($_SESSION['msg'])): ?>
        <div class="msg">
                <?php 
                    echo '<h3>'.$_SESSION['msg'].'</h3>'; 
                    unset($_SESSION['msg']);                 
                ?>
        </div>
    <?php endif; ?>
    <table class="list">
        <tr>
            <th>CustomerID</th>
            <th>Pile</th>
            <th>Method</th>
            <th>Bank</th>
            <th>Account_number</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
  	    </tr>

        <?php  
        $pay_set = find_all_pay();
        $count = mysqli_num_rows($pay_set);
        for ($i = 0; $i < $count; $i++):
            $pay = mysqli_fetch_assoc($pay_set); 
        ?>
            <tr>
                <td><p><?php echo $pay['CustomerID']; ?></p></td>
                <td><p><?php echo $pay['Pile']; ?></p></td>
                <td><p><?php echo $pay['Method']; ?></p></td>
                <td><p><?php echo $pay['Bank']; ?></p></td>  
                <td><p><?php echo $pay['Account_number']; ?></p></td>
                <td class="center"><a href="<?php echo 'editPay.php?id='.$pay['ID']; ?>">Edit</a></td>
                <td class="center"><a href="<?php echo 'deletePay.php?id='.$pay['ID']; ?>">Delete</a></td>
            </tr>
        <?php 
        endfor; 
        mysqli_free_result($pay_set);
        ?>
        
    </table>
</body>
</html>

<?php
db_disconnect($db);
?>