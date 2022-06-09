<?php
session_start();
include 'dbh.inc.php'
if(isset$_SESSION["email, pwd"] = "") {
    header("Location:dashboard.html");
}
if (isset($_POST['login'])) {
    include_once 'dbh.inc.php';
    session_start();
    if (isset($_SERVER["REQUEST_METHOD"])== "POST") {
        // email and password sent from 
        $email =  mysqli_real_escape_string($conn, $_POST["email"]);
        $pwd = mysqli_real_escape_string($conn, $_POST["pwd"]);
        $sql = "SELECT  id from users WHERE email = $email AND pwd = $pwd";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $active =  $row['active'];
        $count = mysqli_num_rows($result);

        // if result matched $email and $pwd table row must be 1
        if($count == 1 ) {
            session_register("email");
            $_SESSION['login'] = $email;
            header("Location:../dashbord.html")
 
        } else {
            $err = "Invalid name email or pasword"
        }

    }
    
    } 

