<?php
require_once('../data management/admin/database.php');

?>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

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
  
</head>

<body>
    <?php include('../Web/header.php');?>
    <div class="container">
        <div class="row">
            <div class="slide1">
                <div id="slide">
                    <img class="slide" stt="0" src="../image/hoian.jpg">
                    <img class="slide" stt="1" src="../image/sapa.jpg">
                    <img class="slide" stt="2" src="../image/a1.jpg">
                    <img class="slide" stt="3" src="../image/slide1.jpg">
                    <img class="slide" stt="4" src="../image/nhatrang.jpg">
                    <img class="slide" stt="5" src="../image/hcm.jpg">
                </div>
                <div>
                    <a  id="prev"><img src="../image/prew1.png" class="rounded-circle">
                    </a>
                    <a  id="next"><img src="../image/next1.png" class="rounded-circle"></a>

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var stt = 0;

            $('img.slide').hover(function () {
            $('div.slide1 div a').css('display', 'block');
            }).mouseout(function () {
                $('div.slide1 div a').css('display', 'none');
            });
            $('div.slide1 div a').hover(function () {
                $(this).css('display', 'inline-block');
            });

            $('#next').click(function () {
                if (stt == -6000) {
                    stt = 0;
                    $('#slide').css('margin-left', stt + 'px');
                }
                else {
                    stt -= 1200;
                    $('#slide').css('margin-left', stt + 'px');
                }
            });
            $('#prev').click(function () {
                if (stt == 0) {
                    stt = -6000;
                    $('#slide').css('margin-left', stt + 'px');
                }
                else {
                    stt += 1200;
                    $('#slide').css('margin-left', stt + 'px');
                }
            });

            var slide = setInterval(function () {
                if (stt == -6000) {
                    stt = 0;
                    $('#slide').css('margin-left', stt + 'px');
                }
                else {
                    stt -= 1200;
                    $('#slide').css('margin-left', stt + 'px');
                }
            }, 3000); 
           
            
            $('.slide1').mouseover(function(){
                clearInterval(slide);
                }).mouseout(function(){
                slide = setInterval(function () {
                        if (stt == -6000) {
                            stt = 0;
                            $('#slide').css('margin-left', stt + 'px');
                        }
                        else {
                            stt -= 1200;
                            $('#slide').css('margin-left', stt + 'px');
                        }
                    }, 3000);
                });
            });
            
            $('nav div ul li a#homepage').addClass('active');
            </script>

    <div class="container-fiuld">
        <div class="row" id="tour">Outstanding Tour</div>
        <div class="row"><img src="../image/banner.png" alt="" id="item"></div>
        
    <?php  
    $tour_set = find_all_tour();
    
    for ($i = 0; $i < 4; $i++):
        $tour = mysqli_fetch_assoc($tour_set); 
        if($i == 0 ) echo '<div class="row" id="left">';
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
        if($i == 3 ) { 
            echo '</div>';
            break;
        };
        endfor; 
        mysqli_free_result($tour_set);
    ?>
        </div>
        <div class="row" id="tour" style="width:100%;">Some Other Tours</div>
        <div class="row" style="width:100%;"><img src="../image/banner.png" alt="" id="item"></div>

    <?php  
    $tour_set = find_all_tour();
    $count = mysqli_num_rows($tour_set);
    for ($i = 0; $i < $count; $i++):
        $tour = mysqli_fetch_assoc($tour_set); 
        if( $i==5 ) echo '<div class="row" id="left">';
        if($i >= 5):
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
        endif;
        if($i == 8 ) {
            echo '</div>';
            break;
        }
        endfor; 
        mysqli_free_result($tour_set);
    ?>
            

        </div>


      

    </div>


    
    <?php include('../Web/footer.php');?>

    

</body>

</html>