<?php

session_start();


if (isset($_POST['submit'])) {
    include('dbh-inc.php');
    $Eid = filter_input(INPUT_POST,'uid',FILTER_SANITIZE_STRING);
    $pwd = filter_input(INPUT_POST,'pwd', FILTER_SANITIZE_STRING);
   
    // error handler, check input empty 

    if (empty($Eid) || empty($pwd)) {
        
        header("Location: ../index2.php?login=empty");
        exit();
    } else {
        $sql = "SELECT * FROM employee WHERE Username ='$Eid'";
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
                        header("Location: ../index2.php?page=elogin");
                      
                        exit();
                    } elseif ($hashedPWDcheck == TRUE) {
                        // login the user here 
                        $_SESSION['e_id'] = $row['EmployeeID'];
                      
                        $_SESSION['e_email'] = $row['Email'];
                        $_SESSION['e_uid'] = $row['Username'];
                        $_SESSION['e_role'] = $row['Role'];
                         $_SESSION['e_fname'] = $row['FirstName'];
                        $_SESSION['e_lname'] = $row['LastName'];
                    
                        
                        header("Location: ../index2.php");
                        exit();
                    }
                }
            }
        }
    }
 else {
    header("Location: ../index2.php?elogin=error1");
    exit();
}


