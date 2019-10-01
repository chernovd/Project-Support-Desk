<?php
if (isset($_POST['submit'])) {
    include_once('dbh-inc.php');
    include_once('upload.php');

    $Ememail =$_POST['email'];
    $Eid =  filter_input(INPUT_POST,'uid',FILTER_SANITIZE_STRING);
    $pwd =  filter_input(INPUT_POST,'pwd', FILTER_SANITIZE_STRING);
    $Emain = filter_input(INPUT_POST,'mein',FILTER_SANITIZE_STRING);
     $Efname = filter_input(INPUT_POST,'fname',FILTER_SANITIZE_STRING);
     $Elname = filter_input(INPUT_POST,'lname',FILTER_SANITIZE_STRING);
      $Epnum = filter_input(INPUT_POST,'pnum',FILTER_SANITIZE_STRING);
    include('upload.php');
    //error handler
    // check for empty
    if (empty($Ememail) || empty($Eid) || empty($pwd) || empty($Emain) || empty($Efname) || empty($Elname)   )  {
        header("Location: ../admin.php?page=signup&signup=empty");
        exit();
    } else {
        //check if input are valid 
        // check if email is valid 
        if (!filter_var($Ememail, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../admin.php?page=signup&signup=email");
            exit();
        } else {
            $sql = "SELECT * FROM employee WHERE Username='$Eid'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            
            if ($resultCheck > 0) {
                header("Location: ../admin.php?page=signup&signup=usertaken");
                exit();
            } else {
                //Hashing the password 
                $hashedPWD = password_hash($pwd, PASSWORD_DEFAULT);
                // insert the user into the database 
                $sql = "INSERT INTO employee (LastName,FirstName,Username,Password,Role,Email ) VALUES (?,?,?,?,?,?);";
                $stmt = mysqli_stmt_init($conn);
                $Edefault = 'default.png'; 
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "SQL error";
                } else {
                    
                    mysqli_stmt_bind_param($stmt, "ssssss",$Elname,$Efname,$Eid,$hashedPWD,$Emain,$Ememail);
                    mysqli_stmt_execute($stmt);
                    
                }
                header("Location: ../admin.php?page=signup&success=yes");
                exit();
            }
        }
    }
} else {
    header("Location: ../admin.php");
    exit();
}


