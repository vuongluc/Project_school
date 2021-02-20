<?php
define("DB_SERVER", "localhost"); //Server Database
define("DB_USER", "root"); //User database
define("DB_PASS", "linh"); //Pass database
define("DB_NAME", "eprojects"); //Name database

function db_connect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    return $connection;
}

$db = db_connect();

function db_disconnect($connection) { 
    if(isset($connection)) {
      mysqli_close($connection);
    }
}

function confirm_query_result($result){
    global $db;
    if (!$result){
        echo mysqli_error($db);
        db_disconnect($db);
        exit; 
    } else {
        return $result;
    }
}



//Search
function kt_query($query){
    global $db;
    $sql = "SELECT * FROM Tour ";
    $query = str_replace(" ", "%", $query);
    $sql .= "WHERE Name like'%" . $query . "%' ";
    $result = mysqli_query($db, $sql); 
    return confirm_query_result($result);
}

// Admin
function find_all_admin(){
    global $db;

    $sql = "SELECT * FROM Admins ";
    $sql .= "ORDER BY Name";

    $result = mysqli_query($db, $sql); 
    return confirm_query_result($result);

}

function find_not_this_admin($admin){
    global $db;

    $sql = "SELECT * FROM Admins ";
    $sql .= "WHERE AdminID not in ('" . $admin . "') ";

    $result = mysqli_query($db, $sql); 
    return confirm_query_result($result);

}

function insert_admin($admin) {
    global $db;

    $sql = "INSERT INTO Admins ";
    $sql .= "(Name, Email, UserName, PassWord) ";
    $sql .= "VALUES ("; 
    $sql .= "'" . $admin['name'] . "',"; 
    $sql .= "'" . $admin['email'] . "',";
    $sql .= "'" . $admin['username'] . "',";
    $sql .= "'" . $admin['pass'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

function update_admin($admin) {
    global $db;

    $sql = "UPDATE Admins SET ";
    $sql .= "Name='" . $admin['name'] . "', ";
    $sql .= "Email='" . $admin['email'] . "', ";
    $sql .= "UserName='" . $admin['username'] . "', ";
    $sql .= "PassWord='" . $admin['pass'] . "' ";


    $sql .= "WHERE AdminID='" . $admin['id'] . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    
    return confirm_query_result($result);
}

function find_admin_by_id($id) {
    global $db;

    $sql = "SELECT * FROM Admins ";
    $sql .= "WHERE AdminID='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $admin = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $admin;
}

function delete_admin($id) {
    global $db;

    $sql = "DELETE FROM Admins ";
    $sql .= "WHERE AdminID='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    return confirm_query_result($result);
}



//Tour
function find_all_tour(){
    global $db;

    $sql = "SELECT * FROM Tour ";
    $sql .= "ORDER BY Name";

    $result = mysqli_query($db, $sql); 
    return confirm_query_result($result);

}

function find_tour_by_type($type){
    global $db;

    $sql = "SELECT * FROM Tour ";
    $sql .= "WHERE Tour_Type='". $type . "' ";

    $result = mysqli_query($db, $sql); 
    return confirm_query_result($result);

}

function insert_tour($tour) {
    global $db;

    $sql = "INSERT INTO Tour ";
    $sql .= "(IMG_URL, Name, Time, Price, Place_Go, Schedule, Introduce, Tour_Type) ";
    $sql .= "VALUES ("; 
    $sql .= "'" . $tour['iu'] . "',"; 
    $sql .= "'" . $tour['name'] . "',";
    $sql .= "'" . $tour['plg'] . "',";
    $sql .= "'" . $tour['price'] . "',";
    $sql .= "'" . $tour['time'] . "',";
    $sql .= "'" . $tour['shd'] . "',";
    $sql .= "'" . $tour['intro'] . "',";
    $sql .= "'" . $tour['type'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

function update_tour($tour) {
    global $db;

    $sql = "UPDATE Tour SET ";
    $sql .= "IMG_URL='" . $tour['iu'] . "', ";
    $sql .= "Name='" . $tour['name'] . "', ";
    $sql .= "Time='" . $tour['time'] . "', ";
    $sql .= "Price='" . $tour['price'] . "', ";
    $sql .= "Place_Go='" . $tour['plg'] . "', ";
    $sql .= "Schedule='" . $tour['shd'] . "', ";
    $sql .= "Introduce='" . $tour['intro'] . "', ";
    $sql .= "Tour_Type='" . $tour['type'] . "' ";


    $sql .= "WHERE TourID='" . $tour['id'] . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    
    return confirm_query_result($result);
}

function find_tour_by_id($id) {
    global $db;

    $sql = "SELECT * FROM Tour ";
    $sql .= "WHERE TourID='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $tour = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $tour;
}

function delete_tour($id) {
    global $db;

    $sql = "DELETE FROM Tour ";
    $sql .= "WHERE TourID='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    return confirm_query_result($result);
}

//Book Tour
function find_all_book_tour(){
    global $db;

    $sql = "SELECT * FROM Book_Tour ";

    $result = mysqli_query($db, $sql); 
    return confirm_query_result($result);

}

function insert_book_tour($book_tour) {
    global $db;

    $sql = "INSERT INTO Book_Tour ";
    $sql .= "(CustomerID, TourID, Number_of_Adults, Number_of_Children, Date_go, Vehicle, Quantity_Vehicle, Message) ";
    $sql .= "VALUES ("; 
    $sql .= "'" . $book_tour['cid'] . "',"; 
    $sql .= "'" . $book_tour['tid'] . "',";
    $sql .= "'" . $book_tour['noa'] . "',";
    $sql .= "'" . $book_tour['noc'] . "',";
    $sql .= "'" . $book_tour['dg'] . "',";
    $sql .= "'" . $book_tour['vhc'] . "',";
    $sql .= "'" . $book_tour['qtv'] . "',";
    $sql .= "'" . $book_tour['mess'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

function update_book_tour($book_tour) {
    global $db;

    $sql = "UPDATE Book_Tour SET ";
    $sql .= "CustomerID='" . $book_tour['cid'] . "', ";
    $sql .= "TourID='" . $book_tour['tid'] . "', ";
    $sql .= "Number_of_Adults='" . $book_tour['noa'] . "', ";
    $sql .= "Number_of_Children='" . $book_tour['noc'] . "', ";
    $sql .= "Date_go='" . $book_tour['dg'] . "', ";
    $sql .= "Vehicle='" . $book_tour['vhc'] . "', ";
    $sql .= "Quantity_Vehicle='" . $book_tour['qtv'] . "', ";
    $sql .= "Message='" . $book_tour['mess'] . "' ";


    $sql .= "WHERE BT_ID='" . $book_tour['btid'] . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    
    return confirm_query_result($result);
}

function find_book_tour_by_id($id) {
    global $db;

    $sql = "SELECT * FROM Book_Tour ";
    $sql .= "WHERE BT_ID='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $book_tour = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $book_tour;
}

function delete_book_tour($id) {
    global $db;

    $sql = "DELETE FROM Book_Tour ";
    $sql .= "WHERE BT_ID='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    return confirm_query_result($result);
}

function delete_book_tour_customer($id) {
    global $db;

    $sql = "DELETE FROM Book_Tour ";
    $sql .= "WHERE CustomerID='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    return confirm_query_result($result);
}

// Customer
function find_all_customer(){
    global $db;

    $sql = "SELECT * FROM Customer ";
    

    $result = mysqli_query($db, $sql); 
    return confirm_query_result($result);

}

function find_customer_by_id($id){
    global $db;

    $sql = "SELECT * FROM Customer ";
    $sql .= "WHERE CustomerID='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $customer = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $customer;

}

function insert_customer($customer) {
    global $db;

    $sql = "INSERT INTO Customer ";
    $sql .= "(Name, Phone, Email, Address) ";
    $sql .= "VALUES ("; 
    $sql .= "'" . $customer['name'] . "',"; 
    $sql .= "'" . $customer['phone'] . "',";
    $sql .= "'" . $customer['email'] . "',";
    $sql .= "'" . $customer['address'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

function update_customer($customer) {
    global $db;

    $sql = "UPDATE Customer SET ";
    $sql .= "Name='" . $customer['name'] . "', ";
    $sql .= "Email='" . $customer['phone'] . "', ";
    $sql .= "Phone='" . $customer['email'] . "', ";
    $sql .= "Address='" . $customer['address'] . "' ";
   


    $sql .= "WHERE CustomerID='" . $customer['id'] . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    
    return confirm_query_result($result);
}

function delete_customer($id) {
    global $db;

    $sql = "DELETE FROM Customer ";
    $sql .= "WHERE CustomerID='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    return confirm_query_result($result);
}

//Pay
function find_all_pay(){
    global $db;

    $sql = "SELECT * FROM Pay ";
    

    $result = mysqli_query($db, $sql); 
    return confirm_query_result($result);

}

function find_pay_by_id($id){
    global $db;

    $sql = "SELECT * FROM Pay ";
    $sql .= "WHERE ID='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $pay = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $pay;

}

function insert_pay($pay) {
    global $db;

    $sql = "INSERT INTO Pay ";
    $sql .= "(CustomerID, Pile, Method ";
    if(isset($pay['bank']) && isset($pay['acc'])){
        $sql .= ", Bank, Account_number";
    }
    $sql .= ")"; 
    $sql .= "VALUES ("; 
    $sql .= "'" . $pay['cid'] . "',"; 
    $sql .= "'" . $pay['pile'] . "',";
    $sql .= "'" . $pay['method'] . "'";
    if(isset($pay['bank']) && isset($pay['acc'])){
        $sql .= ",'" . $pay['bank'] . "',";
        $sql .= "'" . $pay['acc'] . "'";
    }
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

function update_pay($pay) {
    global $db;

    $sql = "UPDATE Pay SET ";
    $sql .= "CustomerID='" . $pay['cid'] . "', ";
    $sql .= "Pile='" . $pay['pile'] . "', ";
    $sql .= "Method='" . $pay['method'] . "', ";
    $sql .= "Bank='" . $pay['bank'] . "', ";
    $sql .= "Account_number='" . $pay['acc'] . "' ";
   


    $sql .= "WHERE ID='" . $pay['id'] . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    
    return confirm_query_result($result);
}

function delete_pay($id) {
    global $db;

    $sql = "DELETE FROM Pay ";
    $sql .= "WHERE ID='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    return confirm_query_result($result);
}

function delete_pay_customer($id) {
    global $db;

    $sql = "DELETE FROM Pay ";
    $sql .= "WHERE CustomerID='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    return confirm_query_result($result);
}

?>