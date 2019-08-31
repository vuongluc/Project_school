
<?php
require_once('../data management/admin/database.php');

function redirect_to($location) {
    header("Location: " . $location);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    $customer = [];
    $customer['name'] = $_POST['name'];
    $customer['phone'] = $_POST['phone'];
    $customer['email'] = $_POST['email'];
    $customer['address'] = $_POST['address'];

    $result = insert_customer($customer);
    $newCID = mysqli_insert_id($db);
    $book_tour = [];
    $book_tour['cid'] = $newCID;
    $book_tour['tid'] = $_POST['id'];
    $book_tour['noa'] = $_POST['adult'];
    $book_tour['noc'] = $_POST['children'];
    $book_tour['dg'] = $_POST['date_go'];
    $book_tour['vhc'] = $_POST['vehicle'];
    $book_tour['qtv'] = $_POST['quantity'];
    $book_tour['mess'] = $_POST['message'];
    insert_book_tour($book_tour);


    $pay = [];
    $pay['cid'] = $newCID;
    $pay['pile'] = $_POST['dep'];
    $pay['method'] = $_POST['card'];
    if($_POST['card'] == 'Credit Card'){
        $pay['bank'] = $_POST['bank'];
        $pay['acc'] = $_POST['account'];
    }
    insert_pay($pay);



    $id = $_POST['id'];
    $tour = find_tour_by_id($id);
    }
else { 
    if(!isset($_GET['id'])) {
        redirect_to('./index.php');
    }
    $id = $_GET['id'];
    $tour = find_tour_by_id($id);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="../css/bootstrap.css"> -->
  <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
  <!-- <link rel="stylesheet" href="../font-awesome/css/font-awesome.css"> -->


  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="../js/jquery.validate.js"></script>
  <script src="../js/validateForm.js"></script>



  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/mainInfo.css">
  <link rel="stylesheet" href="../css/form.css">

  <title>Pleasant Tours</title>
  <!-- <link rel="stylesheet" href="trunk/tour_details/Tour_Details.css"> -->
  <script>
    $(document).ready(function(){
        $('nav div ul li a#navbarDropdown').addClass('active');
        $('#booking').click(function(){
            $('#myModal').css('display','block');
        });

        $('.close').click(function(){
            $('#myModal').css('display', 'none');
        });
    });
    function openForm() {
        var card = document.getElementById("card").checked;
        if(card == true){
            document.getElementById("myForm").style.display = "block";

            
        }else{
            document.getElementById("myForm").style.display = "none";
        }
        
        


    }
  </script>
  <style>
      div#download{
    margin: 0 0 10px 20px;
    font-weight: bold;
    font-size:18px;
    }
        #span{
            color:blue;
        }
    div .modal-content{
        background: url('../image/bg.jpg');
    }
    label#label{
        color: blue;
        display: block;
    }
    input[type="date"]{
        width: 200px;
    }
    div#left input{
        width:200px;
    }
    textarea{
        width:200px;
    }
    div#hr{
        border-right: 3px solid #555;
        height: 30%;
    
    }
    input#submit{
        height: 40px;
        width: 300px;
        border-radius:2rem;
        background-image: linear-gradient(120deg, #a6c0fe 0%, #f68084 100%);
        color: #fff;
        border: none;
        transition: 200ms;
        box-shadow: 2px 2px 12px rgba(0, 0, 0, .3);
        outline: none;
        margin:20px 0 0 100px;
    }  
    input#card, input#cash{
        font-size: 30px;
        margin-left:50px;;
        
    }
    
    input#cash{
        margin-left:90px;
    }
    div#myForm {
        display: none;
        margin: 0 0 0 50px;
    }

    div#myForm select{
        width:195px;
        height:30px;
        /* margin-left:44px; */
        margin :10px 0 10px 43px;
    }

    label.error{
        display:block;
        color: red;
        font-size: 14px;
    }
    /* div#left1{
        margin: 0 0 0 20px;
    } */
    @media only screen and (max-width:1400px){
        div#form-center{
            width:700px;
            height:110px;
            display:block;
            margin-left:auto;
            margin-right: auto;
            background-image: linear-gradient(to right, #4facfe 0%, #00f2fe 100%);
            border-radius:15px;
        }
        button#bookticket{
        margin: 0 0 0 300px;
        
        
        }
    }
    @media only screen and (max-width:1200px){
        div#form-center{
            width:600px;
            height:110px;
            display:block;
            margin-left:auto;
            margin-right: auto;
            background-image: linear-gradient(to right, #4facfe 0%, #00f2fe 100%);
            border-radius:15px;
        }
        button#bookticket{
        margin: 0 0 0 250px;
        
        
        }
    }
    @media only screen and (max-width:992px){
        div#form-center{
            width:500px;
            height:110px;
            display:block;
            margin-left:auto;
            margin-right: auto;
            background-image: linear-gradient(to right, #4facfe 0%, #00f2fe 100%);
            border-radius:15px;
        }
        button#bookticket{
        margin: 0 0 0 200px;
        
        
        }
    }
    @media only screen and (max-width:786px){
        div#form-center{
            width:500px;
            height:110px;
            display:block;
            margin-left:auto;
            margin-right: auto;
            background-image: linear-gradient(to right, #4facfe 0%, #00f2fe 100%);
            border-radius:15px;
        }
        button#bookticket{
        margin: 0 0 0 200px;
        
        
        }
    }
    @media only screen and (max-width: 576px) {
        div#form-center{
            width:300px;
            height:110px;
            display:block;
            margin-left:auto;
            margin-right: auto;
            background-image: linear-gradient(to right, #4facfe 0%, #00f2fe 100%);
            border-radius:15px;
        }
        button#bookticket{
        margin: 0 0 0 100px;
        
        
        }
    }
    /* div#form-center{
        width:700px;
        height:100px;
        display:block;
        margin-left:auto;
        margin-right: auto;
        background-image: linear-gradient(to right, #4facfe 0%, #00f2fe 100%);
        border-radius:15px;; 
    } */
    button.btn.btn-primary{
        margin:0 0 0 45px;
    }
    form#vForm div div div div div#vehicle{
        margin: 0 0 0 0 ;
    }

    form#vForm div div div div div#vehicle input#planes{
        margin: 0 0 0 34px;
    }
    form#vForm div div div div div#vehicle input#car{
        margin: 0 0 0 44px;
    }
    button.close{
        margin: 0 0 0 1100px;
        font-size: 40px;
    
    }
    button.close:hover{
        margin: 0 0 0 1100px;
        font-size: 40px;
        color:red;
    }
    select#select{
        width:150px;
    }

    
  
</style>

<body>


    <?php include("../Web/header.php");?>

    <div class="container">
        <h1><p align ="left" color="blue"><?php echo $tour['Name']; ?></p></h1>
            <div class="row">
                <div class=" col-xs-12 col-sm-12  col-md-12 col-lg-8">
                    <div class="row">
                        <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <img src="<?php echo $tour['IMG_URL']; ?>" id="image1">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <hr>
                            <div class="row">
                             <div class="col-xs-6 col-sm-6 col-lg-6">Time:</div>
                             <div class="col-xs-6 col-sm-6 col-lg-6"><?php echo $tour['Time']; ?></div>
                            </div><hr>
                            <div class="row">
                             <div class="col-xs-6 col-sm-6 col-lg-6">Time Go:</div>
                             <div class="col-xs-6 col-sm-6 col-lg-6">Daily</div>
                            </div><hr>
                            <div class="row">
                             <div class="col-xs-6 col-sm-6 col-lg-6">Place Go :</div>
                             <div class="col-xs-6 col-sm-6 col-lg-6"><?php echo $tour['Place_Go']; ?></div>
                            </div><br><br>
                           
                           
                        </div>
                    </div>
                    <div id="form-center">
                        <div ><form id=from>          
                            <p align = "center" id="p0"><?php echo $tour['Price']; ?><span style="font-size:25px;"> USD</span></p>
                            <button id="bookticket" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" >
                                Book Ticket
                            </button></form>
                        </div>
                        
                            <div class="modal fade" id="myModal">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <div class="modal-body">
                                                <form id="vForm" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                                                <input type="hidden" id="id" name="id" value="<?php echo $tour['TourID']; ?>">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-6" id="hr">
                                                                <div class="row" id="left">
                                                                    <div class="col-xs-12 " id="left">
                                                                        <label for="name" id="label">Name:</label>
                                                                        <input type="text" id="name" name="name"><br><br><br>


                                                                        <label for="phone" id="label">Phone:</label>
                                                                        <input type="number" name="phone" id="phone"><br><br><br>


                                                                        <label for="email" id="label">Email:</label>
                                                                        <input type="email" name="email" id="email"><br><br><br>

                                                                        <label for="address" id="label">Address:</label>
                                                                        <input type="text" id="address" name="address"><br> <br><br>
                                                                    </div>
                                                                    <div class="col-xs-6" id="left">
                                                                        <label for="adult" id="label">Number Of Adults:</label>
                                                                        <input type="number" id="adult" name="adult"><br>
                                                                        <br>&nbsp;


                                                                        <label for="children" id="label">Number Of Children:</label>
                                                                        <input type="number" id="children" name="children"><br> <br> <br>

                                                                      
                                                                        <label for="datego" id="label">Date Go:</label>
                                                                        <input type="date" name="date_go" id="datego"><br><br><br>
                                                                        
                                                                        <label for="quantity" id="label">Quantity Vehicle:</label> 
                                                                        <input type="number" name="quantity" id="quantity">


                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-md-6" id="right">
                                                                <div class="row">
                                                                    <div class="col-xs-6 p-4">
                                                                        <label for="" id="label">Message:</label>
                                                                        <textarea id="message" name="message"></textarea>
                                                                    </div>   
                                                                    <div class="col-xs-6 p-4" id="vehicle">
                                                                       
                                                                        <label for="vehicle" id="label">Vehicle:</label>
                                                                        Planes &ensp;  &ensp; &ensp;    <input type="radio" name="vehicle" id="planes" value="Planes">&ensp;<br>
                                                                        Travel Car <input type="radio" name="vehicle" id="car" value="Travel Car">
                                                                    </div>
                                                                </div>
                                                                <p>Please choose a payment method</p><br>
                                                                <b>Total amount to be paid:</b> <span id="span"><?php echo $tour['Price']; ?> USD</span>
                                                                <br><br>

                                                                Credit card <input type="checkbox" name="card" id="card" onclick="openForm()" value="Credit Card"> <br>
                                                                <div id="myForm">
                                                                    <!-- <form action="" method="get" class="form_container" id="submit_form"> -->
                                                                        Account number &nbsp; <input type="number" name="account"><br>

                                                                        Bank name <select name="bank" id="select" >
                                                                            
                                                                            <option value="Agribank">Agribank</option>
                                                                            <option value="Vietcombank">Vietcombank</option>
                                                                            <option value="BIDV">BIDV</option>
                                                                        </select> <br>
                                                                        Deposit amount &ensp; <input type="number" name="dep" id="dep"><br><br>

                                                                    <!-- </form> -->
                                                                </div>
                                                                Cash <input type="checkbox" name="card" id="cash" value="Cash">
                                                                <br><br>
                                                               
                                                                <input type="submit" name="confirm" value="Confirm" id="submit">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            
                                        </div>
                                    

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    </div><br><br>
                        <!-- <div id="download"><a href="../Schedule_Text/bana.txt" download>Download Schedule <i class="fa fa-download" aria-hidden="true"></i></a></div> -->
                <?php echo $tour['Schedule']; ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <video width="350" height="280" controls>
                        <source src="../video/Introducing VietNam tourism 'Welcome to Vietnam'.mp4" type="video/mp4">.
                    </video>

                    <video width="350" height="280" controls>
                        <source src="../video/VietNam travel via Flycam.mp4" type="video/mp4">
                    </video>
                </div>
            </div>

    </div>
        

<?php include("../Web/footer.php");?>




    
        


</body>
</html>
