<?php
require_once('../admin/database.php');
require_once('../admin/initialize.php');


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Tour</title>
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
        }
        div.hidden { 
            max-height:40px;
            overflow-y: hidden;
            overflow-x: hidden;
            word-wrap:break-word;
            white-space: nowrap;
            text-overflow:ellipsis;
        }
        table.list tr td div.hidden div#download{
            display: none;
        }
    </style>
</head>
<body>
    <?php include('../admin/User.php'); ?>
    <a href="./NewTour.php">Create new tour</a>
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
            <th>IMG_URL</th>
            <th>Name</th>
            <th>Time</th>
            <th>Price</th>
            <th>Place Go</th>
            <th>Schedule</th>
            <th>Introduce</th>
            <th>Tour Type</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
  	    </tr>

        <?php  
        $tour_set = find_all_tour();
        $count = mysqli_num_rows($tour_set);
        for ($i = 0; $i < $count; $i++):
            $tour = mysqli_fetch_assoc($tour_set); 
        ?>
            <tr>
                <td><div class="hidden"><?php echo $tour['IMG_URL']; ?></div></td>
                <td><div class="hidden"><?php echo $tour['Name']; ?></div></td>
                <td><div class="hidden"><?php echo $tour['Time']; ?></div></td>
                <td><div class="hidden"><?php echo $tour['Price']; ?></div></td>
                <td><div class="hidden"><?php echo $tour['Place_Go']; ?></div></td> 
                <td><div class="hidden"><?php echo $tour['Schedule']; ?></div></td>
                <td><div class="hidden"><?php echo $tour['Introduce']; ?></div></td>
                <td><div class="hidden"><?php echo $tour['Tour_Type']; ?></div></td>
                <td class="center"><a href="<?php echo 'editTour.php?id='.$tour['TourID']; ?>">Edit</a></td>
                <td class="center"><a href="<?php echo 'deleteTour.php?id='.$tour['TourID']; ?>">Delete</a></td>
            </tr>
        <?php 
        endfor; 
        mysqli_free_result($tour_set);
        ?>
        
    </table>
</body>
</html>

<?php
db_disconnect($db);
?>