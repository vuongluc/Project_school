<?php
require_once('../admin/database.php');
require_once('../admin/initialize.php');


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Book Tour</title>

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
        max-width: 100px;
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
        }
        div.hidden { 
            max-height:40px;
            overflow-y: hidden;
            overflow-x: hidden;
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
            <th>TourID</th>
            <th>Date Book</th>
            <th>Number of Adults</th>
            <th>Number of Children</th>
            <th>Date Go</th>
            <th>Vehicle</th>
            <th>Quantity Vehicle</th>
            <th>Message</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
  	    </tr>

        <?php  
        $book_tour_set = find_all_book_tour();
        $count = mysqli_num_rows($book_tour_set);
        for ($i = 0; $i < $count; $i++):
            $book_tour = mysqli_fetch_assoc($book_tour_set); 
            //alternative: mysqli_fetch_row($book_tour_set) returns indexed array
        ?>
            <tr>
                <td><div class="hidden"><?php echo $book_tour['CustomerID']; ?></div></td>
                <td><div class="hidden"><?php echo $book_tour['TourID']; ?></div></td>
                <td><div class="hidden"><?php echo $book_tour['Date_Book']; ?></div></td>
                <td><div class="hidden"><?php echo $book_tour['Number_of_Adults']; ?></div></td>
                <td><div class="hidden"><?php echo $book_tour['Number_of_Children']; ?></div></td> 
                <td><div class="hidden"><?php echo $book_tour['Date_go']; ?></div></td>
                <td><div class="hidden"><?php echo $book_tour['Vehicle']; ?></div></td>
                <td><div class="hidden"><?php echo $book_tour['Quantity_Vehicle']; ?></div></td>
                <td><div class="hidden"><?php echo $book_tour['Message']; ?></div></td>
                <td class="center"><a href="<?php echo 'editBook_tour.php?id='.$book_tour['BT_ID']; ?>">Edit</a></td>
                <td class="center"><a href="<?php echo 'deleteBook_tour.php?id='.$book_tour['BT_ID']; ?>">Delete</a></td>
            </tr>
        <?php 
        endfor; 
        mysqli_free_result($book_tour_set);
        ?>
        
    </table>
</body>
</html>

<?php
db_disconnect($db);
?>