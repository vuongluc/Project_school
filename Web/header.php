

<script>
    $(document).ready(function () {
        $('nav div ul li a').attr('style', 'color: white');
        $('nav div ul li a').hover(function () {
            $(this).css('color', 'yellow');
        }).mouseout(function () {
            $(this).css('color', 'white');
        });
    });

</script>
    <div class="header-top w100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-6 col-sm-3">
                    <a href="../PHP/"><img class="myimg" src="../image/logonew.jpg" alt="vntv"></a>
                </div>
                <div class="col-xs-12  col-sm-6">
                    <br>
                    <marquee behavior="" direction="">WELCOME &nbsp;TO &nbsp;PLEASANTS TOUR</marquee>
                </div>
                <div class="col-xs-6 p-4 col-sm-3 p-4" style="text-align: center" id="logo">
                    <div class="hot-line-rh">
                        <a class="title-r1h" href="tel:0978528331 - 034499072 ">Hotline support 24/7</a>
                        <a class="hotline-r1h" href="tel:0978528331 - 034499072 ">0978528331/034499072</a>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <nav class="navbar navbar-expand-md navbar-dark bg-primary sticky-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="index.php" id="homepage">Home Page <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="About.php" id="aboutus">Abouts Us</a>
                </li>
                <li class="nav-item dropdown  " id="dropdown">
                    <a class="nav-link dropdown-toggle" href="./allTour.php" id="navbarDropdown">
                        Tour
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo 'Tour_Type.php?type=Beach_Tour'; ?>">The Beach of VietVam</a>
                        <a class="dropdown-item" href="<?php echo 'Tour_Type.php?type=Hill_Station'; ?>">The Hill Station of VietNam</a>
                        <!-- <div class="dropdown-divider"></div> -->
                        <a class="dropdown-item" href="<?php echo 'Tour_Type.php?type=Other'; ?>">The Other Tour of VietNam</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="./contact.php" id="contact">Contacts</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="get" action="search.php">
                <input class="form-control mr-sm-2" type="search" placeholder="Search..." aria-label="Search" name="name" value="<?php if(isset($_GET['name'])) echo $_GET['name']; ?>">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit" id="submit" name="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
        </div>
    </nav>

<script>
var offset = 200;
var duration = 750;
$(function(){
    $(window).scroll(function () {
        if ($(this).scrollTop() > offset)
        $('#top-up').fadeIn(duration);else
        $('#top-up').fadeOut(duration);
    });
    $('#top-up').click(function () {
        $('body,html').animate({scrollTop: 0}, duration);
    });
});
</script>
        <div title="Back To Top" onmouseover="this.style.color='#CC00CC'" onmouseout="this.style.color='#444444'" id="top-up">
            <i class="fa fa-arrow-circle-up" ></i>
        </div>  
<style>
#top-up {
background:none;
font-size: 3em;
text-shadow:0px 0px 5px #c0c0c0;
cursor: pointer;
position: fixed;
z-index: 9999;
color:#004993;
bottom: 20px;
right: 15px;
display: none;
}
</style>
