<?php
require_once('../data management/admin/database.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pleasant Tours</title>

    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
 
    <style>
    div#container-fiuld{
        display: inline-block;
    }
    div#container-fiuld li{
        display: inline-table;
    }
    .box_center_top_l p
{
	padding-left:15px;
	line-height:34px;
	color:#fff;
	margin-bottom:0;
	text-transform:uppercase;
}

.box_center
{
	margin-top:15px;
}
div div.box_center_top
{
	border-bottom:5px solid #0066FF;
}
.box_center_top_l
{
	background:#0066FF;
    float:left;
    height:32px;
}
.box_center_top_r
{
	height:4px;
    width:0;
    float:left;
    border-left:32px solid #0066FF;
    border-top:32px solid transparent;
}
.box
{
	width:100%;
	border:none;
	margin-top:20px;
}
.box_top
{
	height:34px;
	background:#0066FF;
}
    </style>
</head>
<body>
<?php
include('../Web/header.php');
?>

<div class="container"> 
    <div class="row">
        <div class="box">
            <!-- <div class="box_top"> -->
                <div class="box_center" id="box_center">
                    <div class="box_center_top">
                        <div class="box_center_top_l"><p>Search</p></div>
                        <div class="box_center_top_r"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            <!-- </div> -->
        </div>
    </div>
</div>
<div class="container-fuild">
    <br>
    <?php 
         
        if(isset($_REQUEST['submit'])){
            $search = $_GET['name'];

            
            if (empty($search)){
                echo '<h2>&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Please enter the name of the Tour you are looking for</h2>';
            }else{
    ?>
                
                <?php
                // $query = "SELECT * FROM Tour where Name like '%$search%'";
                // $result = mysqli_query($db ,$query);
                
                $tour_set = kt_query($search);
                $count = mysqli_num_rows($tour_set);
                for ($i = 0; $i < $count; $i++):
                    $tour = mysqli_fetch_assoc($tour_set); 
                    if(($i == 0 ) or ($i % 4 == 0) ) echo '<div class="row" id="left">';
                ?>
            
                        <div class="col-xs-12 col-md-3 p-4" id="img">
            
                            <a href="<?php echo 'TourInfo.php?id='.$tour['TourID']; ?>">
                                <img src="<?php echo $tour['IMG_URL']; ?>">
                            </a>
            
                            <li><b><a href="<?php echo 'TourInfo.php?id='.$tour['TourID']; ?>"><?php echo $tour['Name']; ?></a></b></li>
                            <li><i class="fa fa-clock-o" aria-hidden="true"></i><b>Time:</b><?php echo $tour['Time']; ?></li>
                            <li><i class="fa fa-calendar"></i><b>Date start:</b> All Day</li>
                            <li><i class="fa fa-usd" aria-hidden="true"></i><b>Price: </b><span><?php echo $tour['Price']; ?> USD</span></li>
                            <li><i class="fa fa-plane"></i><b>Place Go: </b><span><?php echo $tour['Place_Go']; ?></span></li>
            
                        </div>
                <?php 
                    if(($i+1) %4 == 0 ) { 
                        echo '</div>';
                    };
                    endfor; 
                    mysqli_free_result($tour_set);
                }
            }
                ?>
</div>
<br>
<br>
<br>
<?php 
include('../Web/footer.php');
?>
</body>
</html>