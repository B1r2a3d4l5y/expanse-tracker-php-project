<?php 
if (isset($_POST['register'])) {
    
include_once 'dbh.inc.php';

$first= mysqli_real_escape_string($conn, $_POST['first']);

$last = mysqli_real_escape_string($conn, $_POST['last']);

$email = mysqli_real_escape_string($conn, $_POST['email']);

$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

#check empty
if (empty($first) || empty($last)|| empty($email) || empty($pwd) ) {
    header("Location:../index.html?signup=empty");
    exit();
}
else {
    # check name char
    if (!preg_match("/^([a-zA-Z])*$/", $first) || !preg_match("/^([a-zA-Z])*$/", $last)) {
        header("Location:../index.html?signup=invalidchar");
        exit();
    }
    # check email
    else{
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          header("Location:../index.html?signup=invalidemail");
          exit();
      } else {
          if ($_POST["pwd"]!= $_POST["cpassword"]) {
              header("Location:../index.html?signup=incorrectpassword");
              exit();
          }
          else{
              
            $sql = "INSERT INTO users(first_name, last_name , email, password)VALUES(?,?,?,?);";
        
            // create stament for prepared stament
            $stmt = mysqli_stmt_init($conn);
            // check for errors 
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "SQL error";
                // bind param
            } else {
                mysqli_stmt_bind_param($stmt, "ssss", $first, $last, $email, $pwd);
                mysqli_stmt_execute($stmt);
                echo "You have successfully registerd";
            }
    

          }
      }
    }
}

}



    
    





   