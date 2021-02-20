<?php
require_once('./database.php');
require_once('./initialize.php');


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Admin</title>
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
    <?php include('./User.php'); ?>
    <a href="./newAdmin.php">Create new admin</a>
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
            <th>Name</th>
            <th>Email</th>
            <th>UserName</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
  	    </tr>

        <?php  
        $admin_set = find_all_admin();
        $count = mysqli_num_rows($admin_set);
        for ($i = 0; $i < $count; $i++):
            $admin = mysqli_fetch_assoc($admin_set); 
            //alternative: mysqli_fetch_row($admin_set) returns indexed array
        ?>
            <tr>
                <td><p><?php echo $admin['Name']; ?></p></td>
                <td><p><?php echo $admin['Email']; ?></p></td>
                <td><p><?php echo $admin['UserName']; ?></p></td>                
                <td class="center"><a href="<?php echo 'editAdmin.php?id='.$admin['AdminID']; ?>">Edit</a></td>
                <td class="center"><a href="<?php echo 'deleteAdmin.php?id='.$admin['AdminID']; ?>">Delete</a></td>
            </tr>
        <?php 
        endfor; 
        mysqli_free_result($admin_set);
        ?>
        
    </table>
</body>
</html>

<?php
db_disconnect($db);
?>