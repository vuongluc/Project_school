<?php
require_once('../data management/admin/database.php');

function redirect_to($location) {
    header("Location: " . $location);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    redirect_to('index.php');
    }
else { 
    if(!isset($_GET['type'])) {
        redirect_to('index.php');
    }
    else{
        if($_GET['type'] == 'Beach_Tour') $type='Beach Tour';
        elseif($_GET['type'] == 'Hill_Station') $type='Hill Station';
        else $type='Other';
    }
    $tour_set = find_tour_by_type($type);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/TourInfo.css">

  <title>Pleasant Tours</title>
    <style>
        div#type a img{
            width: 550px;
            height: 350px;
        }
        @media only screen and (max-width:1199px){
            div#type a img{
                display: block;
                width: 450px;
                height: 430px;
                margin-left: auto;
                margin-right: auto;
            }
        
        }
        @media only screen and (max-width:1024px){
            div#type a img{
                display: block;
                width: 420px;
                height: 400px;
                margin-left: auto;
                margin-right: auto;
            }
            
        }
        @media only screen and (max-width:992px){
            div#type a img{
                display: block;
                width: 350px;
                height: 330px;
                margin-left: auto;
                margin-right: 100px;

            }
        
        }
        @media only screen and (max-width:768px){
            div#type a img{
                display: block;
                width: 350px;
                height: 320px;
                margin-left: auto;
                margin-right: auto;
            }
            
        }

        @media only screen and (max-width:576px){
            div#type a img{
                display: block;
                width: 350px;
                height: 320px;
                margin-left: auto;
                margin-right: auto;
            }
            
        }
    </style>
    <script>
    $(document).ready(function(){
        $('nav div ul li a#navbarDropdown').addClass('active');
    });
    </script>
</head>
<body>
<?php include('../Web/header.php'); ?>
<div class="container">
    <div class="row" id="tour">The <?php echo $type; ?> of VietNam</div>
    <div class="row"><img src="../image/banner.png" alt="" id="item"></div>
    <br>
    <?php  
    $count = mysqli_num_rows($tour_set);
    for ($i = 0; $i < $count; $i++):
        $tour = mysqli_fetch_assoc($tour_set); 
        if(($i==0) or ($i % 2==0)) echo '<div class="row">';
    ?>
            <div class="col-xs-12 col-sm-6">
                <div id="type">
                    <a href="<?php echo 'TourInfo.php?id='.$tour['TourID']; ?>"><img src="<?php echo $tour['IMG_URL']; ?>"></a>
                    <li  style="text-align: center"><b><a href="<?php echo 'TourInfo.php?id='.$tour['TourID']; ?>"><h1><?php echo $tour['Name']; ?></h1></a></b></li>
                    <li><i class="fa fa-clock-o" aria-hidden="true"></i><b>Time:</b><?php echo $tour['Time']; ?></li>
                    <li><i class="fa fa-calendar"></i><b>Date start:</b> All Day</li>
                    <li><i class="fa fa-usd" aria-hidden="true"></i><b>Price: </b><span><?php echo $tour['Price']; ?> USD</span></li>
                    <li><i class="fa fa-plane"></i><b>Place Go: </b><span><?php echo $tour['Place_Go']; ?></span></li>
                    <li>&ensp;&ensp;<?php echo $tour['Introduce']; ?></li>
                </div>
            </div>
    <?php 
        if($i %2 != 0) echo '</div>';
    endfor; 
    mysqli_free_result($tour_set);
    ?>
  
  </div>
  <?php include('../Web/footer.php'); ?>

</body>
</html>