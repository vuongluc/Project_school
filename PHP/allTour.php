<?php
require_once('../data management/admin/database.php');

?>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
    <!-- https://fontawesome.com/v4.7.0/icon/search -->
    <!-- https://getbootstrap.com/docs/4.0/components/navbar/ -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pleasant Tours</title>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
    <script>
    $(document).ready(function(){
        $('nav div ul li a#navbarDropdown').addClass('active');
    });
    </script>
</head>

<body>
    <?php include('../Web/header.php');?>

    <div class="container-fiuld">
        <div class="row" id="tour">All Tour</div>
        <div class="row"><img src="../image/banner.png" alt="" id="item"></div>
        
    <?php  
    $tour_set = find_all_tour();
    $count = mysqli_num_rows($tour_set);
    for ($i = 0; $i < $count; $i++):
        $tour = mysqli_fetch_assoc($tour_set); 
        if(($i == 0) or ($i %4 == 0) ) echo '<div class="row" id="left">';
    ?>

            <div class="col-sm-6 col-md-3 p-4" id="img">

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
    ?>


      

    </div>
    
    <?php include('../Web/footer.php');?>

    

</body>

</html>