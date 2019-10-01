<?php

if(isset($_POST['upgrade']))
{
    if(empty($_POST['usn']) || empty($_POST['password']) || empty($_POST['maintenance']))
    {
        echo "<p>Please fill in all the fields!</p>";
    }
    else
    {
        if($_POST['proceed'] == 'yes')
        {
            include ('includes/dbh-inc.php');
            $TableName = 'customer';
            
            $username = filter_input(INPUT_POST, 'usn', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $maintenance = filter_input(INPUT_POST, 'maintenance', FILTER_SANITIZE_STRING);
            $key = "MNT96578438";
            if(strcmp($key, $maintenance) != 0)
            {
                header('Location: nonmember.php?page=upgrade&success=key');
                exit();
            }
            $purchaseDate = date('Y/m/d H:i:s');
            $expiry = date("Y-m-d", time() + 30*24*60*60 );
            
            $query = 'UPDATE ' .$TableName. ' SET Maintenance=?, PurchaseDate=?, ExpiryDate=? WHERE Username=?';
            if($stmt = mysqli_prepare($conn, $query))
            {
                if(mysqli_stmt_bind_param($stmt, 'ssss', $maintenance, $purchaseDate, $expiry, $username))
                {
                    if(mysqli_stmt_execute($stmt))
                    {
                        mysqli_stmt_close($stmt);
                        mysqli_close($conn);
                        //echo "<p>Your account has been upgraded! Log out and login again to complete the process.</p>";
                        header('Location: nonmember.php?page=upgrade&success=yes');
                        
                        exit();
                    }
                    else
                    {
                        echo 'executing error';
                    }
                }
                else
                {
                    echo "binding error";
                }
            }
            else
            {
                echo "Preparation error";
            }
        }
        else
        {
            echo "<p>Your account was not upgraded.</p>";
        }
    }
}
else
{
    header('Location: nonmember.php?page=upgrade');
}

?>



