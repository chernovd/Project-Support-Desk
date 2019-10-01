<?php

session_start();


if (isset($_POST['submit'])) {
    include('dbh-inc.php');
    $uid = filter_input(INPUT_POST,'uid',FILTER_SANITIZE_STRING);
    $pwd = filter_input(INPUT_POST,'pwd', FILTER_SANITIZE_STRING);
   
    // error handler, check input empty 

    if (empty($uid) || empty($pwd)) {
        
        header("Location: ../index2.php?page=login&login=empty");
        exit();
    } else {
        $sql = "SELECT * FROM customer WHERE Username ='$uid'";
        $result = mysqli_query($conn,$sql); 
        $resultCheck = mysqli_num_rows($result);
            if ($resultCheck < 1) {
                
                header("Location: ../index2.php?login=error2");
                
                exit();
            } else {
                if ($row = mysqli_fetch_assoc($result)) {
                    //de-hashing
                    $hashedPWDcheck = password_verify($pwd, $row['Password']);
                
                    if ($hashedPWDcheck == FALSE) {
                        header("Location: ../index2.php?login=error");
                      
                        exit();
                    } elseif ($hashedPWDcheck == TRUE) {
                        // login the user here 
                        $_SESSION['u_id'] = $row['CustomerID'];
                        $_SESSION['u_img'] = $row['ImagePath'];
                        $_SESSION['u_email'] = $row['Email'];
                        $_SESSION['u_uid'] = $row['Username'];
                        $_SESSION['u_main'] = $row['Maintenance'];
                        $_SESSION['u_fname'] = $row['FirstName'];
                        $_SESSION['u_lname'] = $row['LastName'];
                        $_SESSION['u_pnum']  = $row['Phone'];
                        $_SESSION['u_date']= $row['PurchaseDate'];
                        $_SESSION['u_exp'] = $row ['ExpiryDate'];
                        header("Location: ../index.php");
                        exit();
                    }
                }
            }
        }
    }
 else {
    header("Location: ../index2.php?login=error1");
    exit();
}


